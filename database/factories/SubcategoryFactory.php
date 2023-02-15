<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class SubcategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $category = Category::all()->random();
        return [
            'category_id' => $category->id,
            'name' => $this->faker->word,
            'slug' => Str::slug($this->faker->word),
            'color' => false,
        ];
    }
}
