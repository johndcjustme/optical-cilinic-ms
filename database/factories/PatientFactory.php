<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Faker;

class PatientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'          => $this->faker->name,
            'age'           => $this->faker->randomNumber(2, true),
            'address'       => $this->faker->address,
            'occupation'    => $this->faker->jobTitle,
            'mobile_1'      => '09484710731',
            'mobile_2'      => '09484710731',
            'email'         => $this->faker->unique->safeEmail,
            'gender'        => true,
        ];
    }
}
