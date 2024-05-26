<?php

namespace Database\Factories;

use App\Models\Article;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Article>
 */
class ArticleFactory extends Factory
{
    public function definition()
    {
        $title = fake()->sentence(4);
        return [
            'slug' => Str::slug($title),
            'title' => $title,
            'content' => fake()->paragraphs(3, true),
            'user_id' => 1,
        ];
    }
}
