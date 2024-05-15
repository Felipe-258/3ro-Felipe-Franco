<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "dni"=>$this->faker->unique()->numberBetween(1,100),
            "name"=> $this->faker->firstName(),
            "surname"=> $this->faker->lastName(),
            "birth"=> $this->faker->date(),
            "assist"=>$this->faker->numberBetween(0,0),
        ];
    }
}
