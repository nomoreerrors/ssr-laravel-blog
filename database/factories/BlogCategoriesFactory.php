<?php

namespace Database\Factories;

use App\Models\BlogCategories;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BlogCategories>
 */
class BlogCategoriesFactory extends Factory
{

    protected $model = BlogCategories::class;
    private static $increment = 0;   
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $categoryIncrement = self::$increment ++;
        $categoryName = $categoryIncrement ? 'Категория #' .$categoryIncrement : 'Без категории' ;

        return [
            'parent_id' => rand(1,4),
            'slug' => Str::slug($categoryName),
            'title' => $categoryName
        ];

    }
}
