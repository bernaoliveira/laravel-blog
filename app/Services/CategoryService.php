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
        $limit = $request->input('limit', 20);
        $offset = $request->input('offset', 0);

        $articles = Article::filtered($request)
            ->whereHas('categories', function ($query) use ($slug) {
                $query->where('slug', $slug);
            });

        return [
            'total' => $articles->count(),
            'result' => $articles->limit($limit)->offset($offset)->get(),
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
