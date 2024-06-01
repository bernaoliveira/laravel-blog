<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class RelationFilter extends Filter
{
    public function __construct()
    {
        $this->name_modification = 'with_relation_';
    }

    public function apply(Builder $query, Request $request)
    {
        $value = $request->boolean($this->name);
        if (!$value) {
            return $query;
        }

        return $query->with($this->column);
    }
}
