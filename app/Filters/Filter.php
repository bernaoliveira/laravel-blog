<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

abstract class Filter
{
    public string $name;

    public string $column;

    public string $name_modification = '';

    public array $relations = [];

    abstract public function apply(Builder $query, Request $request);

    public function setOptions($options)
    {
        $this->name = $this->name_modification . ($options['name'] ?? '');
        $this->column = $options['column'] ?? '';
        $this->relations = $options['relations'] ?? [];

        return $this;
    }
}
