<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Services\TranslationService;

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

    protected static function booted()
    {
        static::saving(function ($post) {
            $translationService = app(TranslationService::class);
            
            foreach (['title', 'excerpt', 'body'] as $field) {
                $translations = $post->getTranslations($field);
                
                // Sadece bir dilde veri varsa, otomatik çevir
                if (count($translations) === 1) {
                    $sourceLocale = array_key_first($translations);
                    $sourceText = $translations[$sourceLocale];
                    
                    if (!empty($sourceText)) {
                        $targetLocale = $sourceLocale === 'tr' ? 'en' : 'tr';
                        $translated = $translationService->translate($sourceText, $sourceLocale, $targetLocale);
                        
                        if ($translated) {
                            $post->setTranslation($field, $targetLocale, $translated);
                        }
                    }
                }
            }
            
            // Slug için özel işlem - çevrilmiş title'dan oluştur
            $titleTranslations = $post->getTranslations('title');
            foreach ($titleTranslations as $locale => $title) {
                if (!empty($title)) {
                    $slug = \Illuminate\Support\Str::slug($title);
                    $post->setTranslation('slug', $locale, $slug);
                }
            }
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
