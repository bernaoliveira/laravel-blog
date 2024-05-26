<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class TextLikeFilter extends Filter
{
    public function __construct()
    {
        $this->name_modification = 'with_';
    }

    public function apply(Builder $query, Request $request)
    {
        $value = $request->input($this->name);
        if (!$value) {
            return $query;
        }

        return $query->where($this->column, 'LIKE', "%{$value}%");
    }
}
