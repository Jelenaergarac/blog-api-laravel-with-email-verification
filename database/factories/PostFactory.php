<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title'=>$this->faker->sentence(),
            'body'=>$this->faker->paragraph(2),
            'image_url'=>'https://source.unsplash.com/random',
            'user_id'=>User::inRandomOrder()->first()->id,


        ];
    }
}
