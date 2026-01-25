<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BlogController;

// Public Routes
// Public Routes
Route::get('/', function () { 
    $activeJobs = \App\Models\Job::where('status', 'active')->count();
    $companies = \App\Models\Employer::count(); // Total registered companies
    $candidates = \App\Models\Candidate::count(); // Total registered candidates
    
    return view('welcome', compact('activeJobs', 'companies', 'candidates')); 
});

// Public Blog Routes
Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/my-articles', [BlogController::class, 'myArticles'])->name('blog.my-articles')->middleware('auth');
Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');

// Legal Pages
Route::view('/terms-of-service', 'terms')->name('terms');
Route::view('/privacy-policy', 'privacy')->name('privacy');
Route::view('/cookie-policy', 'cookie-policy')->name('cookie-policy');

// Public Services Routes
Route::get('/services/campus-bird-internship', [App\Http\Controllers\CampusBirdController::class, 'description'])->name('services.campus-bird');
Route::get('/services/campus-bird-internship/alumni', [App\Http\Controllers\CampusBirdController::class, 'alumni'])->name('services.campus-bird-alumni');
Route::get('/services/campus-bird-internship/alumni/{id}/{slug?}', [App\Http\Controllers\CampusBirdController::class, 'showAlumni'])->name('services.campus-bird-alumni-profile');
Route::get('/campus-bird/apply/{department}', [App\Http\Controllers\CampusBirdController::class, 'applicationForm'])->name('campus-bird.apply');
Route::post('/campus-bird/submit', [App\Http\Controllers\CampusBirdController::class, 'submitApplication'])->name('campus-bird.submit');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// Google Auth Routes
Route::get('auth/google', [App\Http\Controllers\GoogleAuthController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('auth/google/callback', [App\Http\Controllers\GoogleAuthController::class, 'handleGoogleCallback']);
Route::get('auth/google/verify/{id}/{hash}', [App\Http\Controllers\GoogleAuthController::class, 'verifyEmail'])->name('auth.google.verify');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Protected Routes
Route::middleware(['auth'])->group(function () {
    
    Route::get('/dashboard', function () {
        $activeJobs = \App\Models\Job::where('status', 'active')->count();
        $companies = \App\Models\Employer::count();
        $candidates = \App\Models\Candidate::count();
        
        return view('welcome', compact('activeJobs', 'companies', 'candidates'));
    })->name('dashboard');

    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/picture', [ProfileController::class, 'updateProfilePicture'])->name('profile.picture');
    
    // Password Change Routes
    Route::get('/change-password', [ProfileController::class, 'showChangePasswordForm'])->name('password.change');
    Route::post('/change-password', [ProfileController::class, 'updatePassword'])->name('password.update');

    // Protected Blog Routes
    Route::prefix('blog')->name('blog.')->group(function () {
        Route::get('/article/create', [BlogController::class, 'create'])->name('create');
        Route::post('/article', [BlogController::class, 'store'])->name('store');
        Route::delete('/article/{id}', [BlogController::class, 'destroy'])->name('destroy');
        
        // Reactions and comments
        Route::post('/{id}/react', [BlogController::class, 'react'])->name('react');
        Route::post('/{id}/comment', [BlogController::class, 'comment'])->name('comment');
        Route::delete('/comment/{id}', [BlogController::class, 'deleteComment'])->name('comment.delete');
    });

});

// Employer Headhunting Routes

// Public Company Profile Route (accessible to all)
Route::get('/company/{id}/profile', [App\Http\Controllers\CompanyProfileController::class, 'show'])->name('company.profile');

// Employer Headhunting Routes
Route::middleware(['auth', App\Http\Middleware\EnsureUserIsEmployer::class])->prefix('headhunting')->name('employer.')->group(function () {
    Route::get('/', [App\Http\Controllers\EmployerController::class, 'index'])->name('index');
    Route::get('/dashboard', [App\Http\Controllers\EmployerController::class, 'dashboard'])->name('dashboard');
    Route::get('/post-job', [App\Http\Controllers\EmployerController::class, 'postJob'])->name('post-job');
    Route::get('/create-job', [App\Http\Controllers\EmployerController::class, 'createJob'])->name('create-job');
    Route::get('/job/{id}', [App\Http\Controllers\EmployerController::class, 'showJob'])->name('show-job');
    Route::get('/job/{id}/edit', [App\Http\Controllers\EmployerController::class, 'editJob'])->name('edit-job');
    Route::post('/post-job', [App\Http\Controllers\EmployerController::class, 'storeJob'])->name('store-job');
    Route::put('/job/{id}', [App\Http\Controllers\EmployerController::class, 'updateJob'])->name('update-job');
    Route::post('/job/{id}/toggle-status', [App\Http\Controllers\EmployerController::class, 'toggleJobStatus'])->name('toggle-job-status');
    Route::delete('/job/{id}', [App\Http\Controllers\EmployerController::class, 'destroyJob'])->name('destroy-job');
    Route::get('/other-jobs', [App\Http\Controllers\EmployerController::class, 'otherJobs'])->name('other-jobs');
});


// Admin Routes
Route::get('/adminview/login', [App\Http\Controllers\AdminController::class, 'loginView'])->name('admin.login');
Route::post('/adminview/login', [App\Http\Controllers\AdminController::class, 'login']);

Route::middleware(['auth', 'admin'])->prefix('adminview')->name('admin.')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\AdminController::class, 'dashboardView'])->name('dashboard');
    Route::post('/logout', [App\Http\Controllers\AdminController::class, 'logout'])->name('logout');
    

    // Headhunting Routes
    Route::prefix('headhunting')->name('headhunting.')->group(function () {
        Route::get('/', [App\Http\Controllers\HeadhuntingController::class, 'index'])->name('index');
        
        // Candidate Routes
        Route::get('/candidates', [App\Http\Controllers\HeadhuntingController::class, 'candidates'])->name('candidates');
        Route::get('/candidates/export', [App\Http\Controllers\HeadhuntingController::class, 'exportCandidates'])->name('candidates.export');
        Route::get('/candidates/{id}', [App\Http\Controllers\HeadhuntingController::class, 'showCandidate'])->name('candidates.show');
        Route::post('/candidates/{id}/password', [App\Http\Controllers\HeadhuntingController::class, 'updateCandidatePassword'])->name('candidates.password');
        Route::delete('/candidates/{id}', [App\Http\Controllers\HeadhuntingController::class, 'destroyCandidate'])->name('candidates.destroy');
        
        // Employer Routes
        Route::get('/employers', [App\Http\Controllers\HeadhuntingController::class, 'employers'])->name('employers');
        Route::get('/employers/export', [App\Http\Controllers\HeadhuntingController::class, 'exportEmployers'])->name('employers.export');
        Route::get('/employers/{id}', [App\Http\Controllers\HeadhuntingController::class, 'showEmployer'])->name('employers.show');
        Route::post('/employers/{id}/approve', [App\Http\Controllers\HeadhuntingController::class, 'approveEmployer'])->name('employers.approve');
        Route::post('/employers/{id}/reject', [App\Http\Controllers\HeadhuntingController::class, 'rejectEmployer'])->name('employers.reject');
        Route::post('/employers/{id}/password', [App\Http\Controllers\HeadhuntingController::class, 'updateEmployerPassword'])->name('employers.password');
        Route::delete('/employers/{id}', [App\Http\Controllers\HeadhuntingController::class, 'destroyEmployer'])->name('employers.destroy');
        
        // Job Posts Routes
        Route::get('/jobs', [App\Http\Controllers\HeadhuntingController::class, 'jobs'])->name('jobs');
        Route::get('/jobs/export', [App\Http\Controllers\HeadhuntingController::class, 'exportJobs'])->name('jobs.export');
        Route::delete('/jobs/{id}', [App\Http\Controllers\HeadhuntingController::class, 'destroyJob'])->name('jobs.destroy');
    });

    // Corporate Workshop
    Route::get('/corporate-workshop', [App\Http\Controllers\AdminController::class, 'corporateWorkshop'])->name('corporate-workshop');
    
    // Career Counselling
    Route::get('/career-counselling', [App\Http\Controllers\AdminController::class, 'careerCounselling'])->name('career-counselling');
    
    // Skill Development
    Route::get('/skill-development', [App\Http\Controllers\AdminController::class, 'skillDevelopment'])->name('skill-development');
    
    // People Empowerment
    Route::get('/people-empowerment', [App\Http\Controllers\AdminController::class, 'peopleEmpowerment'])->name('people-empowerment');
    
    // Consultancy & Advisory
    Route::get('/consultancy-advisory', [App\Http\Controllers\AdminController::class, 'consultancyAdvisory'])->name('consultancy-advisory');

    // Blog Management Routes
    Route::prefix('blog')->name('blog.')->group(function () {
        Route::get('/', [App\Http\Controllers\AdminBlogController::class, 'dashboard'])->name('dashboard');
        Route::get('/posts', [App\Http\Controllers\AdminBlogController::class, 'index'])->name('index');
        Route::delete('/{id}', [App\Http\Controllers\AdminBlogController::class, 'destroy'])->name('destroy');
    });

    // Create Alumni
    Route::get('/alumni', [App\Http\Controllers\AlumniController::class, 'index'])->name('alumni');

    // Manage Admin Users (Super Admin Only)
    Route::prefix('manage-admins')->name('manage-admins.')->group(function () {
        Route::get('/', [App\Http\Controllers\AdminController::class, 'manageAdmins'])->name('index');
        Route::get('/create', [App\Http\Controllers\AdminController::class, 'createAdminForm'])->name('create');
        Route::post('/', [App\Http\Controllers\AdminController::class, 'storeAdmin'])->name('store');
        Route::get('/{id}/edit', [App\Http\Controllers\AdminController::class, 'editAdminForm'])->name('edit');
        Route::put('/{id}', [App\Http\Controllers\AdminController::class, 'updateAdmin'])->name('update');
        Route::post('/{id}/toggle-status', [App\Http\Controllers\AdminController::class, 'toggleAdminStatus'])->name('toggle-status');
        Route::delete('/{id}', [App\Http\Controllers\AdminController::class, 'deleteAdmin'])->name('delete');
    });

    // Campus Bird Internship
    Route::prefix('campus-bird')->name('campus-bird.')->group(function () {
        Route::get('/', [App\Http\Controllers\CampusBirdController::class, 'index'])->name('index');
        
        // Applicants Management
        Route::get('/applicants', [App\Http\Controllers\CampusBirdController::class, 'applicants'])->name('applicants');
        Route::get('/applicants/export', [App\Http\Controllers\CampusBirdController::class, 'exportApplicants'])->name('applicants.export');
        Route::get('/applicants/{id}', [App\Http\Controllers\CampusBirdController::class, 'showApplicant'])->name('applicants.show');
        Route::post('/applicants/{id}/status', [App\Http\Controllers\CampusBirdController::class, 'updateApplicantStatus'])->name('applicants.status');
        Route::delete('/applicants/{id}', [App\Http\Controllers\CampusBirdController::class, 'destroyApplicant'])->name('applicants.destroy');
        
        // Form Builder
        Route::resource('forms', App\Http\Controllers\InternshipFormController::class);
        Route::post('forms/{form}/toggle', [App\Http\Controllers\InternshipFormController::class, 'toggle'])->name('forms.toggle');

        // Alumni Management
        Route::get('alumnis/export', [App\Http\Controllers\CampusBirdAlumniController::class, 'export'])->name('alumnis.export');
        Route::resource('alumnis', App\Http\Controllers\CampusBirdAlumniController::class);
    });
});