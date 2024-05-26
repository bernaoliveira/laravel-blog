<?php

namespace App\Services;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleService
{
    public function getFilteredList(Request $request)
    {
        return Article::filtered($request)->get();
    }

    public function create() {}
}
