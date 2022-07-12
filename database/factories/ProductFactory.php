<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $category = Category::inRandomOrder()->first();
        return [
            'name' => implode(' ', fake()->unique()->words(5)),
            'description' => fake()->text(),
            'price' => fake()->randomFloat(2, 2000),
            'image' => null,
            'category_id' => $category->id
        ];
    }
}
