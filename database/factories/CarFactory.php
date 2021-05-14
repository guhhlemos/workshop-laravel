<?php

namespace Database\Factories;

use App\Models\Car;
use App\Models\Ownership;
use Illuminate\Database\Eloquent\Factories\Factory;

class CarFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Car::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $owners = Ownership::all();
        
        return [
            'manufacturer' => $this->faker->lastName(),
            'model' => $this->faker->lastName(),
            'model_year' => $this->faker->year,
            'ownership_id' => $this->faker->unique(true)->numberBetween(1, $owners->count()),
        ];
    }
}
