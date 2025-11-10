@extends('layouts.app')

@section('title', __('messages.posts'))

@section('content')
    <section class="container mx-auto px-4 py-12">
        <!-- Page Header -->
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-gray-800 mb-4">{{ __('messages.posts') }}</h1>
            <p class="text-gray-600 text-lg">{{ __('messages.all_posts_description') }}</p>
        </div>
        
        <!-- Posts Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Debug: Total Posts: {{ $posts->total() }} -->
            @forelse($posts as $post)
                <article class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition">
                    @if($post->image)
                        @php
                            $imagePath = str_replace('public/', '', $post->image);
                        @endphp
                        <a href="{{ route('post.show', $post->id) }}">
                            <img src="/storage/{{ $imagePath }}" 
                                 alt="{{ $post->getTranslation('title', app()->getLocale()) }}" 
                                 class="w-full h-48 object-cover hover:opacity-90 transition">
                        </a>
                    @else
                        <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                            <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                    @endif
                    
                    <div class="p-6">
                        <!-- Category & Date -->
                        <div class="flex items-center text-sm text-gray-500 mb-3 space-x-3">
                            @if($post->category)
                                <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded text-xs font-semibold">
                                    {{ $post->category->getTranslation('name', app()->getLocale()) }}
                                </span>
                            @endif
                            <span>{{ $post->created_at->format('d.m.Y') }}</span>
                        </div>
                        
                        <!-- Title -->
                        <h3 class="text-xl font-bold text-gray-800 mb-2 line-clamp-2">
                            <a href="{{ route('post.show', $post->id) }}" class="hover:text-blue-600 transition">
                                {{ $post->getTranslation('title', app()->getLocale()) }}
                            </a>
                        </h3>
                        
                        <!-- Excerpt -->
                        <p class="text-gray-600 mb-4 line-clamp-3">
                            {{ Str::limit(strip_tags($post->getTranslation('body', app()->getLocale())), 120) }}
                        </p>
                        
                        <!-- Author -->
                        <div class="flex items-center justify-between pt-4 border-t">
                            <div class="flex items-center text-sm text-gray-600">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                {{ $post->user->name }}
                            </div>
                            
                            <a href="{{ route('post.show', $post->id) }}" class="text-blue-600 hover:text-blue-800 font-semibold text-sm">
                                {{ __('messages.read_more') }} →
                            </a>
                        </div>
                    </div>
                </article>
            @empty
                <div class="col-span-3 text-center py-12">
                    <svg class="w-24 h-24 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    <p class="text-gray-500 text-lg">{{ __('messages.no_posts_found') }}</p>
                </div>
            @endforelse
        </div>
        
        <!-- Pagination -->
        <div class="mt-12">
            {{ $posts->links() }}
        </div>
    </section>
@endsection
