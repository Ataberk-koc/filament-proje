<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use App\Services\TranslationService;

class category extends Model
{
    use HasTranslations;

    protected $fillable = ['name', 'slug', 'description'];
    
    public array $translatable = ['name', 'slug', 'description'];

    protected static function booted()
    {
        static::saving(function ($category) {
            $translationService = app(TranslationService::class);
            
            foreach (['name', 'description'] as $field) {
                $translations = $category->getTranslations($field);
                
                // Sadece bir dilde veri varsa, otomatik çevir
                if (count($translations) === 1) {
                    $sourceLocale = array_key_first($translations);
                    $sourceText = $translations[$sourceLocale];
                    
                    if (!empty($sourceText)) {
                        $targetLocale = $sourceLocale === 'tr' ? 'en' : 'tr';
                        $translated = $translationService->translate($sourceText, $sourceLocale, $targetLocale);
                        
                        if ($translated) {
                            $category->setTranslation($field, $targetLocale, $translated);
                        }
                    }
                }
            }
            
            // Slug için özel işlem - çevrilmiş name'den oluştur
            $nameTranslations = $category->getTranslations('name');
            foreach ($nameTranslations as $locale => $name) {
                if (!empty($name)) {
                    $slug = \Illuminate\Support\Str::slug($name);
                    $category->setTranslation('slug', $locale, $slug);
                }
            }
        });
    }
}
