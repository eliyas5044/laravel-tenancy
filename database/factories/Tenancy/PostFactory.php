<?php

namespace Database\Factories\Tenancy;

use App\Models\Tenancy\Post;
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
            'user_id' => 2, // john@doe.com
            'title' => $this->faker->sentence(),
            'description' => $this->faker->realText(),
        ];
    }

    /**
     * @return PostFactory
     */
    public function unpublished()
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => 0,
            ];
        });
    }
}
