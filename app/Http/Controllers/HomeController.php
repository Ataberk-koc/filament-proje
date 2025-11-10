<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $sliders = Slider::where('is_active', true)
            ->orderBy('order', 'asc')
            ->get();
        
        $posts = Post::with(['category', 'user'])
            ->latest()
            ->take(6)
            ->get();


        
        return view('home', compact('sliders', 'posts'));
    }
    
    public function posts()
    {
        // Tüm postları getir (status kontrolü kaldırıldı)
        $posts = Post::with(['category', 'user'])
            ->latest()
            ->paginate(9);
        
        return view('posts', compact('posts'));
    }
    
    public function show($id)
    {
        $post = Post::with(['category', 'user'])->findOrFail($id);
        
        return view('post', compact('post'));
    }
}
