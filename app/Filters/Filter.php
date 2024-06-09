<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

abstract class Filter
{
    public array $filters = [];

    public array $relations = [];

    public string $name_modification = '';

    abstract public function apply(Builder $query, Request $request);

    public function setOptions($options)
    {
        if (isset($options['relations'])) {
            $this->relations = $options['relations'];
        } else {
            $this->filters = array_map(function ($option) {
                return [
                    'name' => $option['name'],
                    'column' => $option['column'],
                ];
            }, $options);
        }

        return $this;
    }
}
