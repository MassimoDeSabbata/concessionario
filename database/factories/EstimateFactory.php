<?php

namespace Database\Factories;

use App\Models\Car;
use App\Models\Estimate;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class EstimateFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Estimate::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $car = Car::inRandomOrder()->first();
        $author = User::inRandomOrder()->first();
        $customer = User::inRandomOrder()->first();

        return [
            'price' => $car->price + $this->faker->numberBetween(500, 1000),
            'description' => $this->faker->realText(150),
            'car_id' => $car->id,
            'author_id' => $author->id,
            'customer_id' => $customer->id
        ];
    }
}
