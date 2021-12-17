<?php

use App\Http\Controllers\AuthController;
use App\Utility\DirectoryUtils;
use App\Http\Livewire\CarCreate;
use App\Http\Livewire\Explore;
use App\Http\Livewire\Garage;
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
    Route::get('/car/create', CarCreate::class)->name('car.create');
    Route::get('/spare-types', SpareTypesList::class)->name('spare_types.show');

    Route::get('/spare-types/{spare_type}', SparePartsList::class)->name('spare_part.show');

    Route::get('/testing', function () {
        $sparePartsImages = Storage::allFiles("public/spare_parts/" . Str::snake('abs_sensor'));
        $arr = array();
        foreach ($sparePartsImages as $sparePartImage) {
            $con = preg_match('~\.(jpeg|jpg|png)$~', $sparePartImage);
            array_push($arr, $con);
            if ($con) {
                echo "fuck \n";
            }
        }

        return $arr;
    });
});
