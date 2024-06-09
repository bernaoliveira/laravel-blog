<?php

namespace App\Filters\Articles;

use App\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class RatingFilter extends Filter
{
    public function apply(Builder $query, Request $request)
    {
        $rating = $request->integer('with_rating');
        if (!isset($rating)) {
            return $query;
        }

        return $query->where('rating', '>=', $rating - 0.5)
            ->where('rating', '<', $rating + 0.5);
    }
}
