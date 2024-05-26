<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class PaginationFilter extends Filter
{
    public function apply(Builder $query, Request $request)
    {
        return $query->limit($request->input('limit', 20))->offset($request->input('offset', 0));
    }
}
