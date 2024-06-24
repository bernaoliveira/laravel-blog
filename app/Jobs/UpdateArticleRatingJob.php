<?php

namespace App\Jobs;

use App\Models\Article;
use App\Models\Rate;
use App\Models\User;
use App\Notifications\ArticleRatingUpdatedNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class UpdateArticleRatingJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(
        protected Article $article,
    ) {}

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $rating = round($this->article->rates()->avg(Rate::FIELD_VALUE), 1);
        $this->article->update([
            Article::FIELD_RATING => $rating,
        ]);

        $user = User::find($this->article->user_id);

        $user->notify(new ArticleRatingUpdatedNotification(
            $this->article[Article::FIELD_TITLE],
            $rating,
        ));
    }
}
