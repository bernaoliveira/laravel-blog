<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Article extends Model
{
    use HasFactory;

    public const
        FIELD_SLUG = 'slug',
        FIELD_TITLE = 'title',
        FIELD_CONTENT = 'content',
        FIELD_RATING = 'rating',
        FIELD_VOTES = 'votes';

    protected $fillable = [
        self::FIELD_SLUG,
        self::FIELD_TITLE,
        self::FIELD_CONTENT,
        self::FIELD_RATING,
        self::FIELD_VOTES,
    ];

    protected $casts = [
        self::FIELD_RATING => 'double',
        self::FIELD_VOTES => 'integer',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }
}
