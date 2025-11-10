<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class TranslationService
{
    /**
     * MyMemory Translation API kullanarak çeviri yap
     * Ücretsiz, limit: 10000 karakter/gün
     */
    public function translate(string $text, string $from, string $to): ?string
    {
        if (empty($text)) {
            return null;
        }

        // Aynı diller ise çevirme
        if ($from === $to) {
            return $text;
        }

        // Cache key oluştur
        $cacheKey = 'translation_' . md5($text . $from . $to);

        try {
            // Önce cache'den dene
            return Cache::remember($cacheKey, now()->addDays(30), function () use ($text, $from, $to) {
                $response = Http::timeout(10)
                    ->withoutVerifying() // SSL doğrulama problemini atla
                    ->get('https://api.mymemory.translated.net/get', [
                        'q' => $text,
                        'langpair' => "$from|$to",
                    ]);

                if ($response->successful()) {
                    $data = $response->json();
                    if (isset($data['responseData']['translatedText'])) {
                        return $data['responseData']['translatedText'];
                    }
                }

                return null;
            });
        } catch (\Exception $e) {
            Log::error('Translation error: ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Türkçe'den İngilizce'ye çevir
     */
    public function toEnglish(string $text): ?string
    {
        return $this->translate($text, 'tr', 'en');
    }

    /**
     * İngilizce'den Türkçe'ye çevir
     */
    public function toTurkish(string $text): ?string
    {
        return $this->translate($text, 'en', 'tr');
    }

    /**
     * Bir alan için her iki dilde de değer oluştur
     */
    public function createBilingual(string $text, string $sourceLocale): array
    {
        $targetLocale = $sourceLocale === 'tr' ? 'en' : 'tr';
        
        $translations = [
            $sourceLocale => $text,
        ];

        $translated = $this->translate($text, $sourceLocale, $targetLocale);
        if ($translated) {
            $translations[$targetLocale] = $translated;
        }

        return $translations;
    }
}
