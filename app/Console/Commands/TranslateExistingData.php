<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Slider;
use App\Models\Category;
use App\Models\Post;
use App\Services\TranslationService;

class TranslateExistingData extends Command
{
    protected $signature = 'translate:existing-data';
    protected $description = 'Mevcut verileri otomatik çevir (Türkçe <-> İngilizce)';

    public function handle()
    {
        $this->info('Mevcut veriler çevriliyor...');
        
        $translationService = app(TranslationService::class);

        // Sliders
        $this->info('Slider\'lar çevriliyor...');
        $sliders = Slider::all();
        foreach ($sliders as $slider) {
            $this->translateModel($slider, ['title', 'description', 'button_text'], $translationService);
        }
        $this->info('✓ ' . $sliders->count() . ' slider çevrildi');

        // Categories
        $this->info('Kategoriler çevriliyor...');
        $categories = Category::all();
        foreach ($categories as $category) {
            $this->translateModel($category, ['name', 'description'], $translationService);
            // Slug'ları güncelle
            $nameTranslations = $category->getTranslations('name');
            foreach ($nameTranslations as $locale => $name) {
                if (!empty($name)) {
                    $slug = \Illuminate\Support\Str::slug($name);
                    $category->setTranslation('slug', $locale, $slug);
                }
            }
            $category->save();
        }
        $this->info('✓ ' . $categories->count() . ' kategori çevrildi');

        // Posts
        $this->info('Yazılar çevriliyor...');
        $posts = Post::all();
        $bar = $this->output->createProgressBar($posts->count());
        $bar->start();
        
        foreach ($posts as $post) {
            $this->translateModel($post, ['title', 'excerpt', 'body'], $translationService);
            // Slug'ları güncelle
            $titleTranslations = $post->getTranslations('title');
            foreach ($titleTranslations as $locale => $title) {
                if (!empty($title)) {
                    $slug = \Illuminate\Support\Str::slug($title);
                    $post->setTranslation('slug', $locale, $slug);
                }
            }
            $post->save();
            $bar->advance();
        }
        
        $bar->finish();
        $this->newLine();
        $this->info('✓ ' . $posts->count() . ' yazı çevrildi');

        $this->newLine();
        $this->info('✅ Tüm veriler başarıyla çevrildi!');
        
        return Command::SUCCESS;
    }

    private function translateModel($model, array $fields, TranslationService $translationService)
    {
        foreach ($fields as $field) {
            $translations = $model->getTranslations($field);
            
            // Her iki dilde de veri varsa atla
            if (isset($translations['tr']) && isset($translations['en'])) {
                continue;
            }
            
            // Sadece bir dilde veri varsa, çevir
            if (count($translations) === 1) {
                $sourceLocale = array_key_first($translations);
                $sourceText = $translations[$sourceLocale];
                
                if (!empty($sourceText)) {
                    $targetLocale = $sourceLocale === 'tr' ? 'en' : 'tr';
                    $translated = $translationService->translate($sourceText, $sourceLocale, $targetLocale);
                    
                    if ($translated) {
                        $model->setTranslation($field, $targetLocale, $translated);
                    }
                }
            }
        }
        
        $model->save();
    }
}

