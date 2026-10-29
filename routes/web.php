<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GameController;

Route::get('/', [GameController::class, 'index'])->name('games.index');
Route::get('/stock', [GameController::class, 'stock'])->name('games.stock');
Route::post('/stock', [GameController::class, 'store'])->name('games.store');
Route::get('/game/{id}', [GameController::class, 'show'])->name('games.show');
Route::post('/game/pay/{id}', [GameController::class, 'processPayment'])->name('games.pay');
Route::get('/search', [GameController::class, 'search'])->name('games.search');

Route::get('/login', [GameController::class, 'login'])->name('games.login');
Route::post('/login', [GameController::class, 'authenticate'])->name('games.authenticate');

Route::get('/customer/account', [GameController::class, 'account'])->name('customer.account');
Route::post('/logout', [GameController::class, 'logout'])->name('games.logout');