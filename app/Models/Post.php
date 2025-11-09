<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    use HasTranslations;
    protected $fillable = [
        "title",
        "slug",
        "body",
        'status', 
        'user_id', 
        'category_id',
        'image',
    ];
    public array $translatable = ['title', 'slug', 'body'];
    protected $casts = [
        'title' => 'array',
        'slug' => 'array', 
        'body' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
