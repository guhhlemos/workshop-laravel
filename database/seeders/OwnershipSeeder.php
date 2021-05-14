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
        DB::table('ownerships')->insert([
            [
                'firstname' => 'Douglas',
                'lastname' => 'Silva',
                'cpf' => '11122233344'
            ],
            [
                'firstname' => 'Gustavo',
                'lastname' => 'Lemos',
                'cpf' => '55566677788'
            ],
        ]);

        Ownership::factory()->count(28)->create();
    }
}
