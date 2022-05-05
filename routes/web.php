<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\HomeController;
use App\Http\Livewire\AccessoriesList;
use App\Http\Livewire\AccessoriesTypesList;
use App\Http\Livewire\AdminDashboard;
use App\Http\Livewire\CarDetails;
use App\Http\Livewire\CarProducts;
use App\Http\Livewire\Cart\CartView;
use App\Http\Livewire\CreateAccessory;
use App\Http\Livewire\CreateCar;
use App\Http\Livewire\CreatePlace;
use App\Http\Livewire\CreateSparePart;
use App\Http\Livewire\Explore;
use App\Http\Livewire\Garage;
use App\Http\Livewire\Map\MapView;
use App\Http\Livewire\Profile;
use App\Http\Livewire\SparePartsList;
use App\Http\Livewire\SpareTypesList;
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

Route::get('/', [HomeController::class, 'index'])->name('home');

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
Route::get('/spare-parts/{category}', SparePartsList::class)->name('spare_part.show');
Route::get('/accessories', AccessoriesTypesList::class)->name('accessories.show');
Route::get('/accessories/{category}', AccessoriesList::class)->name('accessory.show');
Route::get('/map', MapView::class)->name('map.show');
Route::get('/{manufacturer_name}/{model}/{type}/products', CarProducts::class)
    ->name('car_products.show');
// Auth Routes
Route::middleware('auth')->group(function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('auth.logout');
    Route::get('/car/create', CreateCar::class)->name('car.create');
    Route::get('/garage/{page}', Garage::class)
        ->where('page', '[1-2]+')
        ->name('garage.show');
    Route::get('/profile', Profile::class)->name('profile.show');
    Route::get('/cart', CartView::class)->name('cart.show');
    Route::get('/checkout', [CheckoutController::class, 'checkout'])->name('checkout.show');
    Route::get('/checkout/car/{car}', [CheckoutController::class, 'carCheckout'])->name('checkout.car.show');
    Route::post('/checkout', [CheckoutController::class, 'chargeProducts'])->name('checkout.charge');
    Route::post('/checkout/{car}', [CheckoutController::class, 'chargeCar'])->name('checkout.charge_car');
    // Admin Routes
    Route::middleware('admin')->group(function () {
        Route::get('/admin-dashboard', AdminDashboard::class)
            ->name('admin-dashboard');

        Route::get('/spare-part/create', CreateSparePart::class)
            ->name('spare-part.create');

        Route::get('/accessory/create', CreateAccessory::class)
            ->name('accessory.create');

        Route::get('/place/create', CreatePlace::class)
            ->name('place.create');
    });
    Route::get('/testing', function () {
    });
});
