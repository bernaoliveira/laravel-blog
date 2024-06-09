<?php

namespace Database\Factories;

use App\Models\Article;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Article>
 */
class RateFactory extends Factory
{
    public function definition()
    {
        $articlesCount = Article::count();

        return [
            'value' => random_int(1, 5),
            'article_id' => random_int(1, $articlesCount),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

    public function bad()
    {
        return $this->state(fn (array $attributes) => [
            'article_id' => random_int(1, 20),
            'value' => random_int(1, 2),
        ]);
    }

    public function average()
    {
        return $this->state(fn (array $attributes) => [
            'article_id' => random_int(21, 150),
            'value' => random_int(3, 4),
        ]);
    }

    public function good()
    {
        return $this->state(fn (array $attributes) => [
            'article_id' => random_int(151, 200),
            'value' => random_int(4, 5),
        ]);
    }
}
