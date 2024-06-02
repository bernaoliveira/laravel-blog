<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCategoryPostRequest;
use App\Services\CategoryService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct(
        protected CategoryService $categoryService
    ) {}

    public function index(Request $request)
    {
        return $this->categoryService->getFilteredList($request);
    }

    public function show($slug)
    {
        return $this->categoryService->getBySlug($slug);
    }

    public function articles(Request $request, $slug)
    {
        return $this->categoryService->getArticlesBySlug($request, $slug);
    }

    public function store(CreateCategoryPostRequest $request)
    {
        return $this->categoryService->create($request);
    }

    public function update(CreateCategoryPostRequest $request, $slug)
    {
        return $this->categoryService->update($request, $slug);
    }

    public function destroy($slug)
    {
        $this->categoryService->softDeleteBySlug($slug);
    }
}
