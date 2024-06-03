<?php

namespace App\Models;

use App\Filters\TextLikeFilter;
use App\Traits\FilterableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory;
    use SoftDeletes;
    use FilterableTrait;

    public const
        FIELD_SLUG = 'slug',
        FIELD_NAME = 'name';

    protected $fillable = [
        self::FIELD_SLUG,
        self::FIELD_NAME,
    ];

    public static array $filters = [
        TextLikeFilter::class => [
            'name' => self::FIELD_NAME,
            'column' => self::FIELD_NAME,
        ],
    ];

    public function articles(): BelongsToMany
    {
        return $this->belongsToMany(Article::class);
    }
}
