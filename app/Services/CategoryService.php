<?php

namespace App\Services;

use App\Http\Requests\CreateCategoryPostRequest;
use App\Models\Article;
use App\Models\Category;
use App\Utils\FilteredList;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryService
{
    public function getFilteredList(Request $request)
    {
        return FilteredList::get(new Category, $request);
    }

    public function getBySlug($slug): Category
    {
        return Category::where('slug', $slug)->firstOrFail();
    }

    public function getArticlesBySlug(Request $request, $slug)
    {
        $articles = Article::filtered($request)
            ->whereHas('categories', function ($query) use ($slug) {
                $query->where('slug', $slug);
            })
            ->get();

        return [
            'total' => Article::count(),
            'count' => $articles->count(),
            'result' => $articles,
        ];
    }

    public function create(CreateCategoryPostRequest $request)
    {
        ['name' => $name] = $request->safe()->only('name');
        $slug = Str::slug($name);

        return Category::create([
            'name' => $name,
            'slug' => $slug
        ]);
    }

    public function update(CreateCategoryPostRequest $request, $slug)
    {
        $category = $this->getBySlug($slug);
        ['name' => $name] = $request->safe()->only('name');
        $slug = Str::slug($name);

        $category->update([
            'name' => $name,
            'slug' => $slug
        ]);

        return $category;
    }

    public function softDeleteBySlug($slug)
    {
        $category = $this->getBySlug($slug);
        $category->delete();
    }
}
