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
        FIELD_CONTENT = 'content';

    protected $fillable = [
        self::FIELD_SLUG,
        self::FIELD_TITLE,
        self::FIELD_CONTENT,
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

    public function rates()
    {
        return $this->hasMany(Rate::class);
    }

    public function rating()
    {
        return round($this->rates()->avg('value'), 2);
    }
}
