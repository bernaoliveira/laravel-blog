<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateArticlePostRequest;
use App\Services\ArticleService;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function __construct(
        protected ArticleService $articleService
    ) {}

    public function index(Request $request)
    {
        return $this->articleService->getFilteredList($request);
    }

    public function store(CreateArticlePostRequest $request)
    {
        return $this->articleService->create($request);
    }

    public function show($slug)
    {
        return $this->articleService->getBySlug($slug);
    }

    public function update(CreateArticlePostRequest $request, $slug)
    {
        return $this->articleService->update($request, $slug);
    }

    public function destroy($slug)
    {
        return $this->articleService->softDeleteBySlug($slug);
    }
}
