<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Faker;

class SupplierFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->name;

        return [
            'name' => $name,
            'mobile_1' => '09484710738',
            'email' => $this->faker->unique->safeEmail,
            'address' => $this->faker->address,
            'branch' => $this->faker->state,
            'account_name' => $name,
            'account_number' => $this->faker->creditCardNumber,
        ];
    }
}
