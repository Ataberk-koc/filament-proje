<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Slider;
use App\Services\TranslationService;

$translationService = app(TranslationService::class);

// İlk slider'ı al
$slider = Slider::first();

echo "Mevcut veri:\n";
echo "Title (TR): " . $slider->getTranslation('title', 'tr') . "\n";
echo "Title (EN): " . ($slider->getTranslation('title', 'en', false) ?? 'YOK') . "\n\n";

// Türkçe'den İngilizce'ye çevir
$turkishTitle = $slider->getTranslation('title', 'tr');
$englishTitle = $translationService->toEnglish($turkishTitle);

echo "Çeviri:\n";
echo "TR: $turkishTitle\n";
echo "EN: $englishTitle\n\n";

// Veritabanına kaydet
$slider->setTranslation('title', 'en', $englishTitle);
$slider->setTranslation('description', 'en', $translationService->toEnglish($slider->getTranslation('description', 'tr')));
$slider->setTranslation('button_text', 'en', $translationService->toEnglish($slider->getTranslation('button_text', 'tr')));
$slider->save();

echo "Kaydedildi!\n\n";

// Kontrol et
$slider = Slider::first();
echo "Güncellenmiş veri:\n";
echo json_encode($slider->only(['title', 'description', 'button_text']), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
