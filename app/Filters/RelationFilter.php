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
        foreach ($this->relations as $relation) {
            if ($request->boolean($this->name_modification . $relation)) {
                $query->with($relation);
            }
        }

        return $query;
    }
}
