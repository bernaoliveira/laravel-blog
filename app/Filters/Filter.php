<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

abstract class Filter
{
    public string $name;

    public string $column;

    public string $name_modification = '';

    abstract public function apply(Builder $query, Request $request);

    public function setOptions($options)
    {
        if (isset($options['name']) && isset($options['column'])) {
            $this->name = $this->name_modification . $options['name'];
            $this->column = $options['column'];
        }

        return $this;
    }
}
