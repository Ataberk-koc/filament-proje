<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Services\TranslationService;

$service = new TranslationService();

echo "Test 1: Türkçe -> İngilizce\n";
$result = $service->translate('Merhaba dünya', 'tr', 'en');
echo "Sonuç: $result\n\n";

echo "Test 2: İngilizce -> Türkçe\n";
$result2 = $service->translate('Hello world', 'en', 'tr');
echo "Sonuç: $result2\n\n";

echo "Test 3: toEnglish helper\n";
$result3 = $service->toEnglish('Drama Bölüm 1');
echo "Sonuç: $result3\n\n";
