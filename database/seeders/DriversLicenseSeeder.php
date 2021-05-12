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
        for ($i = 1; $i <= 30; $i++) {
            DriversLicense::factory()->create([
                'ownership_id' => $i
            ]);
        }
    }
}
