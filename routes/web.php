<?php

declare(strict_types=1);

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| Register web routes for your application. These routes are loaded by
| the RouteServiceProvider and assigned to the "web" middleware group.
|--------------------------------------------------------------------------
*/

// Guest Routes
Route::get('/login', [AuthenticatedSessionController::class, 'login'])->name('login');
Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])->name('password.forget');
Route::post('/reset-password', [NewPasswordController::class, 'store'])->name('createNewPassword');
Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])->name('newPasswordReset');

// Public Home Page
Route::get('/', [PagesController::class, 'home'])->name('home');

// Admin Routes (Broker/Admin user only)
Route::middleware(['auth', 'userIsAdmin'])->group(function () {
    Route::get('/seller', \App\Http\Livewire\Sales\Show::class)->name('sales.show');
    Route::get('/message', \App\Http\Livewire\Message\Show::class)->name('message.show');
});

// Authenticated User Routes
Route::middleware(['auth'])->group(function () {
    // Profile & Settings
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('ProfileDestroy');
    Route::put('/profile', [ProfileController::class, 'ProfileUpdate'])->name('ProfileUpdate');
    Route::put('/password', [ProfileController::class, 'updatePassword'])->name('updatePassword');

    // Dashboard & Main Pages
    Route::get('/tickets', \App\Http\Livewire\Tickets\Show::class)->name('tickets.show');
    Route::get('/tickets/create', \App\Http\Livewire\Tickets\Create::class)->name('ticketsCreate');
    Route::get('/payoffs', \App\Http\Livewire\Payoffs\Show::class)->name('payoffs.show');
    Route::get('/payoffs/{id}', \App\Http\Livewire\Payoffs\Show::class)->name('livewire.payoffs.detail');

    // Seller Management (Admin)
    Route::get('/sellers', [PagesController::class, 'showSeller'])->name('seller');
    Route::get('/approval', [ProfileController::class, 'UserApproval'])->name('approval');
    Route::get('/imitate-user/{userID}', [PagesController::class, 'imitateUser'])->name('imitateUser.access');

    // Messages
    Route::get('/messages', \App\Http\Livewire\Message\Show::class)->name('message.show');
    Route::get('/unread-count', \App\Http\Livewire\Message\Show::class)->name('getUnreadConversationsCount');

    // Sales Management
    Route::get('/sales/reviewing', \App\Http\Livewire\Sales\Undertest::class)->name('sales.underTest');
    Route::get('/sales/pending', \App\Http\Livewire\Sales\Send::class)->name('sales.send');
    Route::get('/sales/sent', \App\Http\Livewire\Sales\Sent::class)->name('sales.sent');
    Route::get('/sales/paid', \App\Http\Livewire\Sales\Paid::class)->name('sales.paid');

    // User Settings
    Route::get('/settings', [PagesController::class, 'settings'])->name('settings');
    Route::get('/settings/account', \App\Http\Livewire\Auth\Settings::class)->name('auth.settings');
    Route::get('/settings/address', \App\Http\Livewire\Auth\Address::class)->name('auth.address');
    Route::get('/settings/bank-info', \App\Http\Livewire\Auth\Accountinfo::class)->name('auth.accountinfo');
    Route::get('/settings/notifications', \App\Http\Livewire\Auth\Notifications::class)->name('auth.notifications');
});

// Authentication Routes
require __DIR__ . '/auth.php';
