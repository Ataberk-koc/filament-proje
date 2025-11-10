<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/posts', [HomeController::class, 'posts'])->name('posts');
Route::get('/post/{id}', [HomeController::class, 'show'])->name('post.show');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::post('/contact', [HomeController::class, 'sendContact'])->name('contact.send');

// Language Switcher
Route::get('locale/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'tr'])) {
        session(['locale' => $locale]);
        app()->setLocale($locale);
    }
    return redirect()->back();
})->name('locale.switch');
