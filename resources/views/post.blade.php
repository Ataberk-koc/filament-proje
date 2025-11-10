@extends('layouts.app')

@section('title', $post->getTranslation('title', app()->getLocale()))

@section('content')
    <article class="container mx-auto px-4 py-12">
        <!-- Post Header -->
        <header class="mb-8">
            <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">
                {{ $post->getTranslation('title', app()->getLocale()) }}
            </h1>
            
            <div class="flex items-center text-gray-600 text-sm space-x-4 mb-6">
                <span class="flex items-center">
                    <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    {{ $post->user->name }}
                </span>
                
                <span class="flex items-center">
                    <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    {{ $post->created_at->format('d.m.Y') }}
                </span>
                
                @if($post->category)
                    <span class="flex items-center">
                        <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                        </svg>
                        {{ $post->category->getTranslation('name', app()->getLocale()) }}
                    </span>
                @endif
            </div>
        </header>
        
        <!-- Featured Image -->
        @if($post->image)
            @php
                $imagePath = str_replace('public/', '', $post->image);
            @endphp
            <div class="mb-8">
                <img src="/storage/{{ $imagePath }}" 
                     alt="{{ $post->getTranslation('title', app()->getLocale()) }}" 
                     class="w-full h-96 object-cover rounded-lg shadow-lg">
            </div>
        @endif
        
        <!-- Post Content -->
        <div class="prose prose-lg max-w-none">
            <div class="text-gray-800 leading-relaxed">
                {!! nl2br(e($post->getTranslation('body', app()->getLocale()))) !!}
            </div>
        </div>
        
        <!-- Back Button -->
        <div class="mt-12 pt-8 border-t">
            <a href="{{ url('/') }}" class="inline-flex items-center text-blue-600 hover:text-blue-800 font-semibold">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                {{ __('messages.go_back') }}
            </a>
        </div>
    </article>
@endsection
