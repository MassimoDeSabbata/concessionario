<?php

namespace Database\Factories;

use App\Models\Car;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

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
        return [
            'name' => $this->faker->name(),
            'code' => Str::random(10),
            'price' => $this->faker->numberBetween(8000, 50000),
            'matriculated_at' => $this->faker->date(),
            'color' => $this->faker->name(),
            'description' => $this->faker->realText(150),

        ];
    }
}
