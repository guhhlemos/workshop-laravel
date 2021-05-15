<?php

use App\Http\Controllers\CarController;
use App\Http\Controllers\OwnershipController;
use App\Jobs\NotifyOwnershipJob;
use App\Models\Car;
use App\Models\DriversLicense;
use App\Models\Ownership;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

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

Route::resources([
    'ownerships' => OwnershipController::class,
    'cars' => CarController::class
]);

Route::post('notify_ownerships/{id?}', function (Request $request, $id = null) {
    
    dd('rota não implementada ainda');
});