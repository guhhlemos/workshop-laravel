<?php

namespace Database\Factories;

use App\Models\Ownership;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class OwnershipFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Ownership::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $cpf = rand(0, 9) . rand(0, 9) . rand(0, 9) . '.' . rand(0, 9) . rand(0, 9) . rand(0, 9) . '.' . rand(0, 9) . rand(0, 9) . rand(0, 9) . '-' . rand(0, 9) . rand(0, 9);
        // Log::debug($cpf);

        return [
            'firstname' => $this->faker->firstName(),
            'lastname' => $this->faker->lastName(),
            'cpf' => $cpf
        ];
    }
}
