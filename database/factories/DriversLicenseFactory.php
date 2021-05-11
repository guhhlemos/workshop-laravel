<?php

namespace Database\Factories;

use App\Models\DriversLicense;
use App\Models\Ownership;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class DriversLicenseFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = DriversLicense::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $owners = Ownership::all();

        return [
            'cnh' => str_pad(mt_rand(1,99999999999),11,'0',STR_PAD_LEFT),
            'issue_date' => date('Y-m-d H:i:s', mt_rand(1, time())),
            'ownership_id' => $this->faker->unique(true)->numberBetween(1, $owners->count())
        ];
    }
}
