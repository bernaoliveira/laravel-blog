<?php

namespace App\Services;

use App\Enums\User\UserRole;
use App\Http\Requests\CreateArticlePostRequest;
use App\Jobs\UpdateArticleRatingJob;
use App\Models\Article;
use App\Utils\FilteredList;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ArticleService
{
    public function getFilteredList(Request $request)
    {
        return FilteredList::get(new Article, $request);
    }

    public function create(CreateArticlePostRequest $request) {
        ['title' => $title, 'content' => $content] = $request->safe()->only('title', 'content');
        $slug = $this->generateSlug($title);

        $user = Auth::user();

        return $user->articles()->create([
            'title' => $title,
            'content' => $content,
            'slug' => $slug
        ]);
    }

    public function getBySlug($slug): Article
    {
        return Article::where('slug', $slug)->firstOrFail();
    }

    public function update(CreateArticlePostRequest $request, $slug)
    {
        $article = $this->getBySlug($slug);
        $this->abortIfUserCantMutateArticle($article);

        ['title' => $title, 'content' => $content] = $request->safe()->only('title', 'content');
        $slug = $this->generateSlug($title);

        $article->update([
            'title' => $title,
            'content' => $content,
            'slug' => $slug
        ]);

        return $article;
    }

    public function softDeleteBySlug($slug)
    {
        $article = $this->getBySlug($slug);
        $this->abortIfUserCantMutateArticle($article);
        $article->delete();

        return response()->json([
            'message' => 'Article deleted successfully'
        ]);
    }

    public function updateRating($article)
    {
        UpdateArticleRatingJob::dispatch($article);
    }

    private function generateSlug($title)
    {
        return Str::slug($title);
    }

    private function abortIfUserCantMutateArticle($article)
    {
        if ($article->user_id !== Auth::id() && Auth::user()->role !== UserRole::Admin->value) {
            throw new HttpResponseException(response()->json([
                'message' => 'You are not able to update this article',
            ], 403));
        };
    }
}
