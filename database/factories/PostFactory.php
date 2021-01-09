<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
    * The name of the factory's corresponding model.
    *
    * @var string
    */
    protected $model = Post::class;
    
    /**
    * Define the model's default state.
    *
    * @return array
    */
    public function definition()
    {
        return [
            'header' => ucfirst($this->faker->word),
            'text' => $this->faker->text,
            // 'user_id' => $this->faker->randomDigitNotNull,
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
