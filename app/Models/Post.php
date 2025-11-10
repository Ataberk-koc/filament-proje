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
        "excerpt",
        "body",
        'status', 
        'user_id', 
        'category_id',
        'image',
    ];
    
    public array $translatable = ['title', 'slug', 'excerpt', 'body'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
