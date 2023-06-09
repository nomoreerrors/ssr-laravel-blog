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
        $movies = [ 
                    'Без категории',
                    'Боевики',
                    'Комедии',
                    'Драмы',
                    'Фантастика',
                    'Приключения',
                    'Ужасы',
                    'Фильмы-катастрофы',
                    'Романтические',
                    'Мультфильмы',
                    'Топ 250'
    ];

        $categoryIncrement = self::$increment ++;
        $categoryName = $movies[$categoryIncrement];

        return [
            'parent_id' => rand(1,4),
            'slug' => Str::slug($categoryName),
            'title' => $categoryName
        ];

    }
}
