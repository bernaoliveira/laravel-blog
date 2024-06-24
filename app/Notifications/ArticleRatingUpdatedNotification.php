<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class ArticleRatingUpdatedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(
        protected string $articleTitle,
        protected string $rating,
    ) {}

    public function toArray()
    {
        return [
            'message' => "The article {$this->articleTitle} has been rated {$this->rating}.",
        ];
    }

    public function via()
    {
        return ['database'];
    }
}
