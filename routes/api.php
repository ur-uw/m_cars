<?php

use App\Models\ServicePlace;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('api')->get('/service-places', function () {
    return response()
        ->json([
            'service_places' => ServicePlace::with('servicePlaceType:id,name')->get(),
        ]);
});
