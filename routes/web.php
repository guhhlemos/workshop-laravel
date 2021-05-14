<?php

use App\Http\Controllers\CarController;
use App\Http\Controllers\OwnershipController;
use App\Http\Controllers\TicketController;
use App\Jobs\NotifyOwnershipByEmail;
use App\Models\Ownership;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

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

Route::post('notify_ownerships/{id?}', function (Request $request, $id = null) {

    // Gus - Adicionar o envio por comando artisan tb. Dessa forma é possível ver o envio síncrono e assíncrono

    if ($id) {
        NotifyOwnershipByEmail::dispatch(Ownership::find($id));
    } else {
        foreach (Ownership::all() as $ownership) {
            NotifyOwnershipByEmail::dispatch($ownership);
        }
    }
});
