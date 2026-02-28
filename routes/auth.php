<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Employee\EmployeeHomeController;
use App\Http\Controllers\DocumentsController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    if (Auth::check()) {
        if (Auth::user()->usertype == 1) {
            return redirect()->route('admin.home');
        }
        return redirect()->route('employee.home');
    }
    return view('welcome');
});

Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('register', [RegisteredUserController::class, 'store'])->name('register.store');
    Route::get('Signin', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('Signin', [AuthenticatedSessionController::class, 'store'])->name('login.store');
    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])->name('password.request');
    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])->name('password.email');
    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])->name('password.reset');
    Route::post('reset-password', [NewPasswordController::class, 'store'])->name('password.store');
});

Route::middleware('auth')->group(function () {
    Route::get('verify-email', EmailVerificationPromptController::class)->name('verification.notice');
    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');
    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');
    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])->name('password.confirm');
    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);
    Route::put('password', [PasswordController::class, 'update'])->name('password.update');
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

    // Profile & Settings Updates
    Route::put('/profile/password', [ProfileController::class, 'passwordUpdate'])->name('profile.password.update');

    Route::post('/profile/photo', [ProfileController::class, 'photoUpdate'])->name('profile.photo.update');
    Route::get('/profile/photo/{filename}', [ProfileController::class, 'showPhoto'])->name('profile.photo.show');

    // Document Routes
    Route::get('/compose', [DocumentsController::class, 'compose'])->name('compose');
    Route::resource('documents', DocumentsController::class);
    Route::get('/documents/outgoing', [DocumentsController::class, 'outgoing'])->name('documents.outgoing');
    Route::get('/documents/incoming', [DocumentsController::class, 'incoming'])->name('documents.incoming');
    Route::get('/documents/{document}/download', [DocumentsController::class, 'download'])->name('documents.download');
    Route::get('/documents/{document}/moveToPending', [DocumentsController::class, 'moveToPending'])->name('documents.moveToPending');
    Route::get('/documents/{document}/moveToArchive', [DocumentsController::class, 'moveToArchive'])->name('documents.moveToArchive');
    Route::get('/documents/new', [DocumentsController::class, 'newDocuments'])->name('documents.new');
});

// For Admin Authentication   
Route::middleware(['auth', 'verified', 'admin'])->group(function () {
    Route::get('admin/home', [HomeController::class, 'index'])->name('admin.home');
    Route::get('admin/profile', [HomeController::class, 'profile'])->name('admin.profile');
    Route::get('admin/settings', [HomeController::class, 'settings'])->name('admin.settings');
    Route::get('admin/compose', [HomeController::class, 'compose'])->name('admin.compose');
    Route::get('admin/incoming', [HomeController::class, 'incoming'])->name('admin.incoming');
    Route::get('admin/received', [HomeController::class, 'received'])->name('admin.received');
    Route::get('admin/outgoing', [HomeController::class, 'outgoing'])->name('admin.outgoing');
    Route::get('admin/pending', [HomeController::class, 'pending'])->name('admin.pending');
    Route::get('admin/archive', [HomeController::class, 'archive'])->name('admin.archive');
    Route::get('admin/drafts', [DocumentsController::class, 'drafts'])->name('admin.drafts');
    Route::post('admin/compose', [DocumentsController::class, 'store'])->name('admin.compose.store');
    Route::get('admin/view-document/{document}', [DocumentsController::class, 'show'])->name('admin.view-document');
});

// For Employee Authentication   
Route::middleware(['auth', 'verified', 'employee'])->group(function () {
    Route::get('employee/home', [EmployeeHomeController::class, 'index'])->name('employee.home');
    Route::get('employee/compose', [EmployeeHomeController::class, 'compose'])->name('employee.compose');
    Route::get('employee/profile', [EmployeeHomeController::class, 'profile'])->name('employee.profile');
    Route::get('employee/settings', [EmployeeHomeController::class, 'settings'])->name('employee.settings');
    Route::get('employee/incoming', [EmployeeHomeController::class, 'incoming'])->name('employee.incoming');
    Route::get('employee/received', [EmployeeHomeController::class, 'received'])->name('employee.received');
    Route::get('employee/outgoing', [EmployeeHomeController::class, 'outgoing'])->name('employee.outgoing');
    Route::get('employee/pending', [EmployeeHomeController::class, 'pending'])->name('employee.pending');
    Route::get('employee/archive', [EmployeeHomeController::class, 'archive'])->name('employee.archive');
    Route::get('employee/drafts', [DocumentsController::class, 'drafts'])->name('employee.drafts');
    Route::post('employee/compose', [DocumentsController::class, 'store'])->name('employee.compose.store');
    Route::get('employee/view-document/{document}', [DocumentsController::class, 'show'])->name('employee.view-document');
});
