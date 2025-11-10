<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Spatie\Translatable\HasTranslations;

class Slider extends Model
{
    use HasTranslations;

    protected $fillable = [
        'title',
        'description',
        'image',
        'link',
        'button_text',
        'button_link',
        'order',
        'is_active',
        'autoplay_delay',
        'show_navigation',
        'show_pagination',
    ];

    public array $translatable = ['title', 'description', 'button_text'];

    protected $casts = [
        'title' => 'array',
        'description' => 'array',
        'button_text' => 'array',
        'is_active' => 'boolean',
        'show_navigation' => 'boolean',
        'show_pagination' => 'boolean',
        'order' => 'integer',
        'autoplay_delay' => 'integer',
    ];

    /**
     * Resim URL'sini döndürür
     */
    public function getImageUrlAttribute(): ?string
    {
        if ($this->image) {
            return asset('storage/' . $this->image);
        }
        return null;
    }
}
