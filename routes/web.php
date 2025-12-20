<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;

// Public Routes
Route::get('/', function () { return view('welcome'); }); // or redirect to login

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Protected Routes
Route::middleware(['auth'])->group(function () {
    
    Route::get('/dashboard', function () {
        return view('welcome');
    })->name('dashboard');

    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/picture', [ProfileController::class, 'updateProfilePicture'])->name('profile.picture');


});


// Admin Routes
Route::get('/adminview/login', [App\Http\Controllers\AdminController::class, 'loginView'])->name('admin.login');
Route::post('/adminview/login', [App\Http\Controllers\AdminController::class, 'login']);

Route::middleware(['auth', 'admin'])->prefix('adminview')->name('admin.')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\AdminController::class, 'dashboardView'])->name('dashboard');
    Route::post('/logout', [App\Http\Controllers\AdminController::class, 'logout'])->name('logout');
    
    // Profile Routes
    Route::get('/profile', [App\Http\Controllers\AdminController::class, 'profileView'])->name('profile');
    Route::post('/profile/password', [App\Http\Controllers\AdminController::class, 'updatePassword'])->name('profile.password');

    // Headhunting Routes
    Route::prefix('headhunting')->name('headhunting.')->group(function () {
        Route::get('/', [App\Http\Controllers\HeadhuntingController::class, 'index'])->name('index');
        
        // Candidate Routes
        Route::get('/candidates', [App\Http\Controllers\HeadhuntingController::class, 'candidates'])->name('candidates');
        Route::get('/candidates/{id}', [App\Http\Controllers\HeadhuntingController::class, 'showCandidate'])->name('candidates.show');
        Route::post('/candidates/{id}/password', [App\Http\Controllers\HeadhuntingController::class, 'updateCandidatePassword'])->name('candidates.password');
        Route::delete('/candidates/{id}', [App\Http\Controllers\HeadhuntingController::class, 'destroyCandidate'])->name('candidates.destroy');
        
        // Employer Routes
        Route::get('/employers', [App\Http\Controllers\HeadhuntingController::class, 'employers'])->name('employers');
        Route::get('/employers/{id}', [App\Http\Controllers\HeadhuntingController::class, 'showEmployer'])->name('employers.show');
        Route::post('/employers/{id}/approve', [App\Http\Controllers\HeadhuntingController::class, 'approveEmployer'])->name('employers.approve');
        Route::post('/employers/{id}/reject', [App\Http\Controllers\HeadhuntingController::class, 'rejectEmployer'])->name('employers.reject');
        Route::post('/employers/{id}/password', [App\Http\Controllers\HeadhuntingController::class, 'updateEmployerPassword'])->name('employers.password');
        Route::delete('/employers/{id}', [App\Http\Controllers\HeadhuntingController::class, 'destroyEmployer'])->name('employers.destroy');
    });
});