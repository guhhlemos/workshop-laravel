<?php

namespace Database\Seeders;

use App\Models\Car;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        /**
         * php artisan make:seeder CarSeeder
         * 
         * php artisan db:seed
         * 
         */

        DB::table('cars')->insert([
            [
                'manufacturer' => 'Tesla',
                'model' => 'Model X',
                'model_year' => '2020',
                'ownership_id' => 1,
            ],
            [
                'manufacturer' => 'Volkswagen',
                'model' => 'Fusca',
                'model_year' => '1962',
                'ownership_id' => 2,
            ],
        ]);

        Car::factory()->count(28)->create();


    }
}
