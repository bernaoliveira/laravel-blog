<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    use HasFactory;

    public const
        FIELD_VALUE = 'value';

    protected $fillable = [
        self::FIELD_VALUE,
    ];

    public function article()
    {
        return $this->belongsTo(Article::class);
    }
}
