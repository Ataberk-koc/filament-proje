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
    
    public function contact()
    {
        return view('contact');
    }
    
    public function sendContact(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:5000',
        ]);
        
        // TODO: E-posta gönderme işlemi burada yapılabilir
        // Mail::to('info@example.com')->send(new ContactMail($validated));
        
        return redirect()->route('contact')->with('success', __('messages.contact_success'));
    }
}
