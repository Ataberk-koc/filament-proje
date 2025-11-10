<?php

require __DIR__.'/vendor/autoload.php';

use Stichoza\GoogleTranslate\GoogleTranslate;

$tr = new GoogleTranslate('en');
$tr->setSource('tr');

try {
    echo "Test çevirisi yapılıyor...\n";
    $result = $tr->translate('Merhaba dünya');
    echo "Sonuç: $result\n";
} catch (\Exception $e) {
    echo "Hata: " . $e->getMessage() . "\n";
    echo "Kod: " . $e->getCode() . "\n";
    echo "Trace: " . $e->getTraceAsString() . "\n";
}
