<?php

namespace Database\Factories;

use App\Models\CategoryPost;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryPostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CategoryPost::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'post_id' => $this->faker->numberBetween($min = 1, $max = 20),
            'category_id' => $this->faker->randomDigitNotNull
        ];
    }
}
