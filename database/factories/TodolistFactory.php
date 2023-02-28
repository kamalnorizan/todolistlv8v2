<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Todolist;
class TodolistFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title'=> $this->faker->sentence(rand(4,6)),
            'description'=> $this->faker->paragraph(rand(4,6)),
            'user_id'=> rand(1,50),
            'status'=> 'pending',
        ];
    }
}
