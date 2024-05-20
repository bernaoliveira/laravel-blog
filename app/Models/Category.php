<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Category extends Model
{
    use HasFactory;

    public const
        FIELD_SLUG = 'slug',
        FIELD_NAME = 'name';

    protected $fillable = [
        self::FIELD_SLUG,
        self::FIELD_NAME,
    ];

    public function articles(): BelongsToMany
    {
        return $this->belongsToMany(Article::class);
    }
}
