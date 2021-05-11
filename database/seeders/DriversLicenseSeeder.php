<?php

namespace Database\Seeders;

use App\Models\DriversLicense;
use App\Models\Ownership;
use Illuminate\Database\Seeder;

class DriversLicenseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DriversLicense::factory()->count(30)->create();
    }
}
