<?php

namespace App\Models;

use App\Filters\RelationFilter;
use App\Filters\TextLikeFilter;
use App\Traits\FilterableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    use HasFactory;
    use FilterableTrait;
    use SoftDeletes;

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

    public static array $filters = [
        RelationFilter::class => [
            'relations' => [
                'categories',
                'user',
            ],
        ],
        TextLikeFilter::class => [
            'name' => self::FIELD_TITLE,
            'column' => self::FIELD_TITLE,
        ],
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
