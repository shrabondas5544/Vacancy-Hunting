<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BlogController;

// Public Routes
Route::get('/', function () { return view('welcome'); }); // or redirect to login

// Public Blog Routes
Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/my-articles', [BlogController::class, 'myArticles'])->name('blog.my-articles')->middleware('auth');
Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');

// Public Services Routes
Route::get('/services/campus-bird-internship', [App\Http\Controllers\CampusBirdController::class, 'description'])->name('services.campus-bird');
Route::get('/campus-bird/apply/{department}', [App\Http\Controllers\CampusBirdController::class, 'applicationForm'])->name('campus-bird.apply');
Route::post('/campus-bird/submit', [App\Http\Controllers\CampusBirdController::class, 'submitApplication'])->name('campus-bird.submit');

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
        
        // Blog Routes
        Route::get('/blogs', [App\Http\Controllers\HeadhuntingController::class, 'blogs'])->name('blogs');
        Route::delete('/blogs/{id}', [App\Http\Controllers\HeadhuntingController::class, 'destroyBlog'])->name('blogs.destroy');
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
    });
});