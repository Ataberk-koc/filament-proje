<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Spatie\Translatable\HasTranslations;
use App\Services\TranslationService;

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
        'is_active' => 'boolean',
        'show_navigation' => 'boolean',
        'show_pagination' => 'boolean',
        'order' => 'integer',
        'autoplay_delay' => 'integer',
    ];

    protected static function booted()
    {
        static::saving(function ($slider) {
            $translationService = app(TranslationService::class);
            
            foreach ($slider->translatable as $field) {
                $translations = $slider->getTranslations($field);
                
                // Sadece bir dilde veri varsa, otomatik çevir
                if (count($translations) === 1) {
                    $sourceLocale = array_key_first($translations);
                    $sourceText = $translations[$sourceLocale];
                    
                    if (!empty($sourceText)) {
                        $targetLocale = $sourceLocale === 'tr' ? 'en' : 'tr';
                        $translated = $translationService->translate($sourceText, $sourceLocale, $targetLocale);
                        
                        if ($translated) {
                            $slider->setTranslation($field, $targetLocale, $translated);
                        }
                    }
                }
            }
        });
    }

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
