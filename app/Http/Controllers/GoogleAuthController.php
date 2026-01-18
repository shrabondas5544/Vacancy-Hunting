<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Candidate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;
use App\Mail\WelcomeGoogleCandidate;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use Carbon\Carbon;

class GoogleAuthController extends Controller
{
    public function redirectToGoogle(Request $request)
    {
        $intention = $request->query('intention', 'login'); // 'login' or 'register'
        session(['google_auth_intention' => $intention]);
        
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->stateless()->user();
            $intention = session('google_auth_intention', 'login'); // Default to login if lost
            
            // Check if user exists by email
            $user = User::where('email', $googleUser->getEmail())->first();

            if ($intention === 'login') {
                if (!$user) {
                    return redirect('/login')->withErrors(['email' => 'No account found with this email. Please sign up first.']);
                }

                // Enforce Candidate Role
                if ($user->role !== 'candidate') {
                    return redirect('/login')->withErrors(['email' => 'This account is not a candidate account.']);
                }

                // Check verification
                if (!$user->email_verified_at) {
                    return redirect('/login')->withErrors(['email' => 'Please verify your email before logging in. Check your inbox.']);
                }

                // Update google_id if missing (for legacy users merging)
                if (!$user->google_id) {
                    $user->update(['google_id' => $googleUser->getId()]);
                }

                Auth::login($user);
                return redirect('/dashboard');

            } else { // intention === 'register'
                
                if ($user) {
                    return redirect('/login')->withErrors(['email' => 'Account already exists. Please sign in.']);
                }

                // Create new user (Unverified)
                $user = User::create([
                    'email' => $googleUser->getEmail(),
                    'password' => Hash::make(Str::random(16)),
                    'role' => 'candidate',
                    'google_id' => $googleUser->getId(),
                    'email_verified_at' => null, // Unverified initially
                ]);

                // Create Candidate Profile
                Candidate::create([
                    'user_id' => $user->id,
                    'name' => $googleUser->getName(),
                    'experience_years' => null,
                    'skills' => null,
                    'interested_in' => [],
                ]);

                // Generate Verification URL
                $verificationUrl = URL::signedRoute('auth.google.verify', [
                    'id' => $user->id,
                    'hash' => sha1($user->email),
                ]);

                // Send Welcome Email
                Mail::to($user->email)->send(new WelcomeGoogleCandidate($verificationUrl));

                // Redirect to a thank you page (or login with message)
                return redirect('/login')->with('status', 'Registration successful! Please check your email to verify your account.');
            }

        } catch (\Exception $e) {
            return redirect('/login')->withErrors(['email' => 'Google Login failed. Please try again. reason: '. $e->getMessage()]);
        }
    }

    public function verifyEmail(Request $request, $id, $hash)
    {
        $user = User::findOrFail($id);

        if (! hash_equals((string) $hash, sha1($user->getEmailForVerification()))) {
            abort(403);
        }

        if (! $request->hasValidSignature()) {
            abort(403);
        }

        if (!$user->hasVerifiedEmail()) {
            $user->markEmailAsVerified();
        }

        Auth::login($user);

        return redirect('/dashboard')->with('success', 'Email verified! You are now logged in.');
    }
}
