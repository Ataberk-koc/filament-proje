<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

// LaravelLocalization Group - Tüm yerelleştirilmiş route'lar bu grubun içinde olmalı
Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
], function() {
    
    // Ana sayfa - Her dilde aynı (/)
    Route::get('/', [HomeController::class, 'index'])->name('home');
    
    // Her iki dil için de route'ları tanımla (LaravelLocalization otomatik olarak doğru olanı kullanacak)
    Route::get('posts', [HomeController::class, 'posts'])->name('posts');
    Route::get('yazilar', [HomeController::class, 'posts'])->name('posts.tr');
    
    Route::get('post/{id}', [HomeController::class, 'show'])->name('post.show');
    Route::get('yazi/{id}', [HomeController::class, 'show'])->name('post.show.tr');
    
    Route::get('contact', [HomeController::class, 'contact'])->name('contact');
    Route::get('iletisim', [HomeController::class, 'contact'])->name('contact.tr');
    
    Route::post('contact', [HomeController::class, 'sendContact'])->name('contact.send');
    Route::post('iletisim', [HomeController::class, 'sendContact'])->name('contact.send.tr');
    
});

// Admin dil değiştirici
Route::post('admin/locale/switch', function () {
    $locale = request('locale');
    if (in_array($locale, ['en', 'tr'])) {
        session(['locale' => $locale]);
        app()->setLocale($locale);
    }
    return response()->json(['success' => true, 'locale' => $locale]);
})->middleware('web')->name('admin.locale.switch');
