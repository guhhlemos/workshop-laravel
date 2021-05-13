<?php

use App\Http\Controllers\CarController;
use App\Http\Controllers\OwnershipController;
use App\Http\Controllers\TicketController;
use App\Jobs\NotifyOwnershipByEmail;
use App\Models\Ownership;
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

Route::resources([
    'ownerships' => OwnershipController::class,
    'cars' => CarController::class,
    'tickets' => TicketController::class
]);

Route::get('dispatch_job', function () {

    $ownerships = Ownership::all();

    foreach ($ownerships as $ownership) {
        NotifyOwnershipByEmail::dispatch($ownership);
    }
});
