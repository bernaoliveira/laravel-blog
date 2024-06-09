<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class WhereValueFilter extends Filter
{
    public function __construct()
    {
        $this->name_modification = 'with_';
    }

    public function apply(Builder $query, Request $request)
    {
        foreach ($this->filters as $filter) {
            $value = $request->input($this->name_modification . $filter['name']);
            if (!$value) {
                continue;
            }

            $query->where($filter['column'], '=', $value);
        }

        return $query;
    }
}
