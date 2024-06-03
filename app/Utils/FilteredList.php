<?php

namespace App\Utils;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class FilteredList
{
    public static function get(Model $model, Request $request)
    {
        $limit = $request->input('limit', 20);
        $offset = $request->input('offset', 0);

        $filtered = $model::filtered($request);

        return [
            'total' => $filtered->count(),
            'result' => $filtered->limit($limit)->offset($offset)->get(),
        ];
    }
}
