<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

trait FilterableTrait
{
    public static function getFilters()
    {
        return static::$filters ?? [];
    }

    public function scopeFiltered(Builder $query, Request $request)
    {
        foreach(self::getFilters() as $filter => $options) {
            $query = resolve($filter)->setOptions($options)->apply($query, $request);
        }

        return $query;
    }
}
