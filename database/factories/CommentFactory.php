<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Comment;
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'comment'=>$this->faker->sentence(rand(5,9)),
            'todolist_id'=>rand(1,50),
            'user_id'=>rand(1,50)
        ];
    }
}
