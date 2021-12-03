<?php

use App\Http\Controllers\AuthController;
use App\Http\Livewire\CarCreate;
use App\Http\Livewire\Explore;
use App\Http\Livewire\Garage;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('home');
})->name('home');

// Auth routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'index'])->name('auth.login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'registration'])->name('auth.register');
    Route::post('/register', [AuthController::class, 'register']);
});
Route::middleware('auth')->group(function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('auth.logout');
    Route::get('/explore', Explore::class)->name('explore.show');
    Route::get('/garage', Garage::class)->name('garage.show');
});

Route::get('/car/create', CarCreate::class)->name('car.create');
