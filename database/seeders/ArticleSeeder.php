<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Article::factory()
            ->count(200)
            ->create();

        $articles = Article::all();
        $categories = Category::all();

        $articles->each(function ($article) use ($categories) {
            // Attach 1 to 3 random categories to each article
            $article->categories()->attach(
                $categories->random(rand(1, 3))->pluck('id')->toArray()
            );

            // Set the article's user_id to a random user
            $article->update([
                'user_id' => rand(1, User::all()->count()),
            ]);
        });
    }
}
