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

    // Gus - Adicionar o envio por comando artisan tb. Dessa forma é possível ver o envio síncrono e assíncrono

    // if ($id) {
    //     $exitCode = Artisan::call('notifications:ownership-simplified', [
    //         'ownerships' => [$id],
    //     ]);
    // } else {
    //     $exitCode = Artisan::call('notifications:ownership-simplified', [
    //         '--all' => true,
    //     ]);
    // }

    // dd($exitCode);

    if ($id) {
        NotifyOwnershipJob::dispatch(Ownership::find($id));
    } else {
        foreach (Ownership::all() as $ownership) {
            NotifyOwnershipJob::dispatch($ownership);
        }
    }
});

/**
 * rota só pra apresentação
 */
Route::get('teste', function () {

    $ownership = new Ownership();
    $ownership->firstname = "Nome";
    $ownership->lastname = "Sobrenome";
    $ownership->cpf = "022.848.431-66";
    $ownership->save(); // vai dar erro pq cpf não tem default

    dump($ownership);

    /**
     * Atualizar fillable
     */
    $ownership = Ownership::create([
        'firstname' => "Bla",
        'lastname' => 'ble',
        'cpf' => '123'
    ]);

    dump($ownership);
    die;

    /*********/
    $ownerships = Ownership::all();

    dump($ownerships);

    foreach ($ownerships as $ownership) {
        print($ownership->lastname . " ");
    }

    /*********/
    $ownerships_with_ticket = Ownership::select('firstname', 'lastname')->where('traffic_ticket', '1')->orderBy('firstname', 'ASC');
    dump($ownerships_with_ticket->toSql());
    dump($ownerships_with_ticket->get());

    $ownerships_with_no_ticket = Ownership::where('traffic_ticket', '0')->orderBy('firstname', 'ASC')->take(10); // ->limit(10)
    dump($ownerships_with_no_ticket->toSql());
    dump($ownerships_with_no_ticket->get());

    /*********/
    $car = Car::find(1);
    dump($car);

    $car = Car::where('model_year', '>', 2000)->get();
    dump($car);

    $car = Car::where('manufacturer', 'Tesla')->first();
    // $car = Car::firstWhere('manufacturer', 'Tesla');
    dump($car);

    $traffic_tickets = Ownership::where('traffic_ticket', '1')->count();
    dump($traffic_tickets);
});
