@extends('layouts.app')

@section('title', __('messages.home'))

@section('content')
    <!-- Slider Section -->
    <section class="slider-section">
        <div class="swiper mySwiper">
            <div class="swiper-wrapper">
                @foreach($sliders as $slider)
                    @php
                        // Debug: Image path
                        $imagePath = $slider->image;
                        // Remove 'public/' if it exists
                        $imagePath = str_replace('public/', '', $imagePath);
                    @endphp
                    <!-- Debug: {{ $slider->image }} -> /storage/{{ $imagePath }} -->
                    <div class="swiper-slide" style="background-image: url('/storage/{{ $imagePath }}')">
                        <div class="swiper-slide-content">
                            <h1 class="slider-title">
                                {{ $slider->getTranslation('title', app()->getLocale()) }}
                            </h1>
                            
                            @if($slider->getTranslation('description', app()->getLocale()))
                                <p class="slider-description">
                                    {{ $slider->getTranslation('description', app()->getLocale()) }}
                                </p>
                            @endif
                            
                            @if($slider->button_link && $slider->getTranslation('button_text', app()->getLocale()))
                                <a href="{{ $slider->button_link }}" class="slider-button">
                                    {{ $slider->getTranslation('button_text', app()->getLocale()) }}
                                </a>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
            
            @if($sliders->first() && $sliders->first()->show_pagination)
                <div class="swiper-pagination"></div>
            @endif
            
            @if($sliders->first() && $sliders->first()->show_navigation)
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
            @endif
        </div>
    </section>

    <!-- Content Section -->
    <section class="container mx-auto px-4 py-16">
        <div class="text-center mb-12">
            <h2 class="text-4xl font-bold text-gray-800 mb-4">{{ __('messages.welcome') }}</h2>
            <p class="text-gray-600 text-lg">{{ __('messages.welcome_description') }}</p>
        </div>
        
        <!-- Latest Posts -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($posts as $post)
                <article class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition">
                    @if($post->image)
                        @php
                            $postImagePath = str_replace('public/', '', $post->image);
                        @endphp
                        <!-- Debug: {{ $post->image }} -> /storage/{{ $postImagePath }} -->
                        <img src="/storage/{{ $postImagePath }}" 
                             alt="{{ $post->getTranslation('title', app()->getLocale()) }}" 
                             class="w-full h-48 object-cover"
                             onerror="console.log('Image failed to load: /storage/{{ $postImagePath }}'); this.style.display='none';">
                    @else
                        <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                            <span class="text-gray-500">Resim yok</span>
                        </div>
                    @endif
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-2">
                            {{ $post->getTranslation('title', app()->getLocale()) }}
                        </h3>
                        <p class="text-gray-600 mb-4">
                            {{ Str::limit(strip_tags($post->getTranslation('body', app()->getLocale())), 100) }}
                        </p>
                        <a href="{{ route('post.show', $post->id) }}" class="text-blue-600 hover:text-blue-800 font-semibold">
                            {{ __('messages.read_more') }} →
                        </a>
                    </div>
                </article>
            @endforeach
        </div>
    </section>
@endsection

@push('scripts')
<script>
    var swiper = new Swiper(".mySwiper", {
        spaceBetween: 0,
        centeredSlides: true,
        autoplay: {
            delay: {{ $sliders->first()->autoplay_delay ?? 5000 }},
            disableOnInteraction: false,
        },
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        loop: true,
    });
</script>
@endpush
