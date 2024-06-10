<?php

namespace App\Console\Commands;

use App\Models\Article;
use App\Services\ArticleService;
use Illuminate\Console\Command;

class CalculateArticlesRating extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'articles:calculate-rating';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Calculate articles rating';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $articleService = new ArticleService();
        $articles = Article::all();
        $articles->chunk(100)->each(function ($articles) use ($articleService) {
            $articles->each(function ($article) use ($articleService) {
                $articleService->updateRating($article);
            });
        });

        return Command::SUCCESS;
    }
}
