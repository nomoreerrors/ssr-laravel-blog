<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BlogPosts>
 */
class BlogPostsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = fake()->sentence();
        $content = fake()->text();


        return [
            'category_id' => rand(1, 11),
            'user_id' => rand(1,10),
            'title' => $title,
            'slug' => Str::slug($title),
            'content_raw' => $content,
            'content_html' => fake()->text(),
            'excerpt' => Str::excerpt($content),
            'published_at' => fake()->dateTimeBetween('-1 years', '-1 days'),
            'is_published' => rand(0, 1),
        ];
    }
}
