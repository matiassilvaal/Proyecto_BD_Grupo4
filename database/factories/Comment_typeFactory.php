<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class Comment_typeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'Tipo' => $this->faker->boolean,
            'soft' => false
        ];
    }
}
