<?php

namespace App\Models;

use App\Filters\Articles\RatingFilter;
use App\Filters\RelationFilter;
use App\Filters\WhereLikeFilter;
use App\Filters\WhereValueFilter;
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
        FIELD_RATING = 'rating';

    protected $fillable = [
        self::FIELD_SLUG,
        self::FIELD_TITLE,
        self::FIELD_CONTENT,
        self::FIELD_RATING,
    ];

    public static array $filters = [
        RelationFilter::class => [
            'relations' => [
                'categories',
                'user',
            ],
        ],
        WhereLikeFilter::class => [
            [
                'name' => self::FIELD_TITLE,
                'column' => self::FIELD_TITLE,
            ],
        ],
        WhereValueFilter::class => [
            [
                'name' => 'user_id',
                'column' => 'user_id',
            ],
            [
                'name' => 'category_id',
                'column' => 'category_id',
            ]
        ],
        RatingFilter::class => [],
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    public function rates()
    {
        return $this->hasMany(Rate::class);
    }
}
