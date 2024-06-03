<?php

use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/google/callback', [\App\Http\Controllers\AuthController::class, 'loginByGoogle'])->middleware('guest');

Route::get('/github/redirect', function () {
    return Socialite::driver('github')->redirect();
})->name('github.redirect');

Route::get('/github/callback', [\App\Http\Controllers\AuthController::class, 'loginByGitHub']);

Route::get('/contacts', [\App\Http\Controllers\ContactsController::class, 'index'])->name('contacts.index');
Route::post('/contacts', [\App\Http\Controllers\ContactsController::class, 'store'])->name('contacts.store');

Route::prefix('/auth')->name('auth.')->group(function () {
    Route::middleware('guest')->group(function () {
        Route::get('/login', function () {
            return view('auth.index');
        })->name('index');
        Route::post('/register', [\App\Http\Controllers\AuthController::class, 'register'])->name('register');
        Route::post('/login', [\App\Http\Controllers\AuthController::class, 'login'])->name('login');
    });

    Route::middleware('auth')->group(function () {
        Route::get('/user', [\App\Http\Controllers\AuthController::class, 'user'])->name('user');
        Route::get('/logout', [\App\Http\Controllers\AuthController::class, 'logout'])->name('logout');
    });
});

Route::prefix('/link')->name('link.')->middleware('auth')->group(function () {
    Route::post('/', [\App\Http\Controllers\LinkController::class, 'store'])->name('store');
    Route::delete('/{link}/delete', [\App\Http\Controllers\LinkController::class, 'destroy'])->can('delete', 'link')->name('delete');
});





