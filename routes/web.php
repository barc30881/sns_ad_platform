<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdvertiserController;
use App\Http\Controllers\FreelancerController;
use App\Http\Controllers\FreelancerAuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminAuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Authentication routes
Route::group(['middleware' => ['web']], function () {
    Auth::routes();
});

// Home
Route::get('/', [HomeController::class, 'index'])->name('home');

// Freelancer Routes
Route::get('/freelancer/register', [FreelancerAuthController::class, 'showRegister'])->name('freelancer.register.form');
Route::post('/freelancer/register', [FreelancerAuthController::class, 'register'])->name('freelancer.register');
Route::get('/freelancer/login', [FreelancerAuthController::class, 'showLogin'])->name('freelancer.login.form');
Route::post('/freelancer/login', [FreelancerAuthController::class, 'login'])->name('freelancer.login');
Route::get('/freelancer/ads', [FreelancerController::class, 'showFreelancerAds'])->name('freelancer.ads');
Route::get('/freelancer/claim/{ad}', [FreelancerController::class, 'claimAd'])->name('freelancer.claim');

Route::middleware(['freelancer'])->group(function () {
    Route::get('/freelancer/dashboard', [FreelancerController::class, 'dashboard'])->name('freelancer.dashboard');
    Route::get('/freelancer/payment-settings', [FreelancerController::class, 'paymentSettings'])->name('freelancer.payment-settings');
    Route::post('/freelancer/payment-settings', [FreelancerController::class, 'savePaymentSettings'])->name('freelancer.save-payment-settings');
    Route::get('/freelancer/payment-history', [FreelancerController::class, 'paymentHistory'])->name('freelancer.payment-history');
    Route::post('/freelancer/signout', [FreelancerController::class, 'signout'])->name('freelancer.signout');
    Route::post('/freelancer/submit-links', [FreelancerController::class, 'submitLinks'])->name('freelancer.submitLinks');
    Route::delete('/freelancer/submission/{id}', [FreelancerController::class, 'deleteSubmission'])->name('freelancer.delete-submission');
    Route::get('/freelancer/promotional-center', [FreelancerController::class, 'promotionalCenter'])->name('freelancer.promotional-center');
});

// Advertiser Routes
Route::get('/ad-application-page', [AdvertiserController::class, 'adApplicationPage'])->name('adApplicationPage');
Route::post('/ad-application-page', [AdvertiserController::class, 'storeAdApplicationPage'])->name('storeAdApplicationPage');
Route::get('/ad-store-introduction', [AdvertiserController::class, 'storeIntroductionSection'])->name('storeIntroductionSection');
Route::post('/ad-store-introduction', [AdvertiserController::class, 'storeIntroductionSectionPost'])->name('storeIntroductionSection.post');
Route::get('/ad-payment-section', [AdvertiserController::class, 'showAdPaymentSection'])->name('adPaymentSection');
Route::post('/ad-payment-section', [AdvertiserController::class, 'processAdPayment'])->name('adPaymentSection.post');
Route::get('/paypal/success', [AdvertiserController::class, 'paypalSuccess'])->name('paypal.success');
Route::get('/paypal/cancel', [AdvertiserController::class, 'paypalCancel'])->name('paypal.cancel');

// Advertiser Authentication Routes
Route::get('/advertiser/register', [\App\Http\Controllers\Auth\RegisterController::class, 'showRegistrationForm'])->name('advertiser.register.form');
Route::post('/advertiser/register', [\App\Http\Controllers\Auth\RegisterController::class, 'register'])->name('advertiser.register');
Route::get('/advertiser/login', [\App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('advertiser.login.form');
Route::post('/advertiser/login', [\App\Http\Controllers\Auth\LoginController::class, 'login'])->name('advertiser.login');

Route::middleware(['advertiser'])->group(function () {
    Route::post('/advertiser/signout', [AdvertiserController::class, 'signout'])->name('advertiser.signout');
    Route::get('/dashboard', [AdvertiserController::class, 'showDashboard'])->name('dashboard');
});





// Admin Authentication Routes
Route::get('/admin/login', [AdminAuthController::class, 'showLogin'])->name('admin.login.form');
Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login');

// Admin Routes
Route::middleware(['admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/ads', [AdminController::class, 'manageAds'])->name('admin.ads');
    Route::post('/admin/ads/{id}/approve', [AdminController::class, 'approveAd'])->name('admin.ads.approve');
    Route::post('/admin/ads/{id}/reject', [AdminController::class, 'rejectAd'])->name('admin.ads.reject');
    Route::get('/admin/submissions', [AdminController::class, 'manageSubmissions'])->name('admin.submissions');
    Route::post('/admin/submissions/{id}/approve', [AdminController::class, 'approveSubmission'])->name('admin.submissions.approve');
    Route::post('/admin/submissions/{id}/reject', [AdminController::class, 'rejectSubmission'])->name('admin.submissions.reject');
    Route::get('/admin/users', [AdminController::class, 'manageUsers'])->name('admin.users');
    Route::post('/admin/users/{id}/update-role', [AdminController::class, 'updateUserRole'])->name('admin.users.update-role');
    Route::get('/admin/payments', [AdminController::class, 'managePayments'])->name('admin.payments');
    Route::post('/admin/signout', [AdminController::class, 'signout'])->name('admin.signout');
    Route::get('/admin/referral-settings', [AdminController::class, 'referralSettings'])->name('admin.referral-settings');
    Route::post('/admin/update-referral-bonus', [AdminController::class, 'updateReferralBonus'])->name('admin.update-referral-bonus');

});