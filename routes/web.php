<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PagesController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------|
| Web Routes                                                                 |
|--------------------------------------------------------------------------|
| Here is where you can register web routes for your application. These    |
| routes are loaded by the RouteServiceProvider and all of them will be     |
| assigned to the "web" middleware group. Make something great!             |
|--------------------------------------------------------------------------|
*/

// Auth Routes
Route::get('/login', [AuthenticatedSessionController::class, 'login'])->name('login');
Route::get('/register', [RegisteredUserController::class, 'create'])->name('register'); // Corrected to 'create' instead of 'store'
Route::get('/forgetPass', [PasswordResetLinkController::class, 'create'])->name('password.forget');
Route::get('/', [PagesController::class, 'home'])->name('home');
Route::post('/createNewPassword', [NewPasswordController::class, 'store'])->name('createNewPassword');

// Password Reset Routes
Route::get('/newPasswordReset/{token}', [NewPasswordController::class, 'create'])->name('newPasswordReset');
Route::post('/createNewPassword', [NewPasswordController::class, 'store'])->name('createNewPassword');

// Seller & Admin Routes - Middleware: Auth + User Is Admin
Route::middleware(['auth', 'userIsAdmin'])->group(function () {
    Route::get('/seller', \App\Http\Livewire\Sales\Show::class)->name('sales.show');
    Route::get('/message', \App\Http\Livewire\Message\Show::class)->name('message.show');
});

// Authenticated Routes
Route::middleware(['auth'])->group(function () {

    // General Pages
    Route::get('/', [PagesController::class, 'home'])->name('home');
    Route::get('/Profileinstellungen', [ProfileController::class, 'edit'])->name('profile');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::delete('/ProfileDestroy', [ProfileController::class, 'destroy'])->name('ProfileDestroy');
    Route::put('/ProfileUpdate', [ProfileController::class, 'ProfileUpdate'])->name('ProfileUpdate');
    Route::put('/updatePassword', [ProfileController::class, 'updatePassword'])->name('updatePassword');
    Route::get('/meine-auszahlungen', [PagesController::class, 'payoffs'])->name('payoffs');
    Route::get('/verkaeufer', [PagesController::class, 'showSeller'])->name('seller');
    Route::get('/approval', [ProfileController::class, 'UserApproval'])->name('approval');
    Route::get('/meine-tickets', \App\Http\Livewire\Tickets\Show::class)->name('tickets.show');
    Route::get('/ticketsCreate', \App\Http\Livewire\Tickets\Create::class)->name('ticketsCreate');
    Route::get('/einstellungen', [PagesController::class, 'settings'])->name('settings');

    // Dynamic Pages
    Route::get('/get-unread-conversations-count', \App\Http\Livewire\Message\Show::class)->name('getUnreadConversationsCount');
    Route::get('/undertest', \App\Http\Livewire\Sales\Undertest::class)->name('sales.underTest');
    Route::get('/send', \App\Http\Livewire\Sales\Send::class)->name('sales.send');
    Route::get('/sent', \App\Http\Livewire\Sales\Sent::class)->name('sales.sent');
    Route::get('/paid', \App\Http\Livewire\Sales\Paid::class)->name('sales.paid');
    Route::get('/selleraccount', \App\Http\Livewire\Auth\Settings::class)->name('auth.settings');
    Route::get('/address', \App\Http\Livewire\Auth\Address::class)->name('auth.address');
    Route::get('/accountinfo', \App\Http\Livewire\Auth\Accountinfo::class)->name('auth.accountinfo');
    Route::get('/notifications', \App\Http\Livewire\Auth\Notifications::class)->name('auth.notifications');
    Route::get('/imitate-user/{userID}', [PagesController::class, 'imitateUser'])->name('imitateUser.access');
    Route::get('/payoffs', \App\Http\Livewire\Payoffs\Show::class)->name('payoffs.show');
    Route::get('/payoffsDetailsById/{getDetails}', \App\Http\Livewire\Payoffs\Show::class)->name('livewire.payoffs.detail');
});

// Auth Routes (for login, registration, etc.)
require __DIR__ . '/auth.php';
