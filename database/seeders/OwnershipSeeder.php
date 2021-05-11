<?php

namespace Database\Seeders;

use App\Models\Ownership;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OwnershipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Ownership::factory()->count(30)->create();
    }
}
