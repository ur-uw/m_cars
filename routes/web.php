<?php

use App\Http\Controllers\AuthController;
use App\Http\Livewire\AccessoriesList;
use App\Http\Livewire\AccessoriesTypesList;
use App\Http\Livewire\AdminDashboard;
use App\Http\Livewire\CarCreate;
use App\Http\Livewire\CarDetails;
use App\Http\Livewire\CreateAccessory;
use App\Http\Livewire\CreateSparePart;
use App\Http\Livewire\Explore;
use App\Http\Livewire\Garage;
use App\Http\Livewire\Profile;
use App\Http\Livewire\SparePartsList;
use App\Http\Livewire\SpareTypesList;
use App\Models\Accessory;
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

// Guest routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'index'])->name('auth.login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'registration'])->name('auth.register');
    Route::post('/register', [AuthController::class, 'register']);
});

// General Routes
Route::get('/explore', Explore::class)->name('explore.show');
Route::get('/car-details/{car}', CarDetails::class)->name('car_details.show');
Route::get('/spare-parts', SpareTypesList::class)->name('spare_types.show');
Route::get('/spare-parts/{spare_type}', SparePartsList::class)->name('spare_part.show');
Route::get('/accessories', AccessoriesTypesList::class)->name('accessories.show');
Route::get('/accessories/{accessory_type}', AccessoriesList::class)->name('accessory.show');

// Auth Routes
Route::middleware('auth')->group(function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('auth.logout');
    Route::get('/car/create', CarCreate::class)->name('car.create');
    Route::get('/garage', Garage::class)->name('garage.show');
    Route::get('/profile', Profile::class)->name('profile.show');

    // Admin Routes
    Route::middleware('admin')->group(function () {
        Route::get('/admin-dashboard', AdminDashboard::class)
            ->name('admin-dashboard');

        Route::get('/spare-part/create', CreateSparePart::class)
            ->name('spare-part.create');

        Route::get('/accessory/create', CreateAccessory::class)
            ->name('accessory.create');
    });
    Route::get('/testing', function () {
    });
});
