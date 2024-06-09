<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class WhereBooleanFilter extends Filter
{
    public function __construct()
    {
        $this->name_modification = 'is_';
    }

    public function apply(Builder $query, Request $request)
    {
        foreach ($this->filters as $filter) {
            $value = $request->boolean($this->name_modification . $filter['name']);
            if ($value === null) {
                continue;
            }

            $query->where($filter['column'], $value);
        }

        return $query;
    }
}
