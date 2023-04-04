<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Faker;


class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'image'         => null,
            'name'          => $this->faker->word,
            'category_id'   => rand(1,3),
            'description'   => $this->faker->sentence,
            'quantity'      => 60,
            'size'          => '15-20-30',
            'type'          => null,
            'price'         => 2500,
            'cost'          => 2000,
            'buffer'        => 10,
            'sph'           => '-5',
            'cyl'           => '15'
        ];
    }
}
