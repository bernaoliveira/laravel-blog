<?php

namespace App\Utils;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class FilteredList
{
    public static function get(Model $model, Request $request)
    {
        $total = $model::count();
        $collection = $model::filtered($request)->get();

        return [
            'total' => $total,
            'count' => $collection->count(),
            'result' => $collection,
        ];
    }
}
