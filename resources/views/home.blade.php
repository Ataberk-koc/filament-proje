@extends('layouts.app')

@section('title', __('messages.home'))

@section('content')
    <!-- Slider Section -->
    <section class="slider-section">
        <div class="swiper mySwiper">
            <div class="swiper-wrapper">
                @foreach($sliders as $slider)
                    @php
                        $imagePath = str_replace('public/', '', $slider->image);
                    @endphp
                    <div class="swiper-slide" style="background-image: url('/storage/{{ $imagePath }}')">
                        <div class="swiper-slide-content">
                            <h1 class="slider-title">
                                @php
                                    $locale = app()->getLocale();
                                    $title = $slider->getTranslation('title', $locale, false);
                                    if (!$title) {
                                        $title = $slider->getTranslation('title', 'tr', false) ?: $slider->getTranslation('title', 'en', false) ?: '';
                                    }
                                @endphp
                                {{ $title }}
                            </h1>
                            
                            @php
                                $description = $slider->getTranslation('description', $locale, false);
                                if (!$description) {
                                    $description = $slider->getTranslation('description', 'tr', false) ?: $slider->getTranslation('description', 'en', false);
                                }
                            @endphp
                            
                            @if($description)
                                <p class="slider-description">
                                    {{ $description }}
                                </p>
                            @endif
                            
                            @php
                                $buttonText = $slider->getTranslation('button_text', $locale, false);
                                if (!$buttonText) {
                                    $buttonText = $slider->getTranslation('button_text', 'tr', false) ?: $slider->getTranslation('button_text', 'en', false);
                                }
                            @endphp
                            
                            @if($slider->button_link && $buttonText)
                                <a href="{{ $slider->button_link }}" class="slider-button">
                                    {{ $buttonText }}
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
                        <img src="/storage/{{ $postImagePath }}" 
                             alt="{{ $post->getTranslation('title', app()->getLocale()) }}" 
                             class="w-full h-48 object-cover">
                    @else
                        <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                            <span class="text-gray-500">Resim yok</span>
                        </div>
                    @endif
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-3">
                            {{ $post->getTranslation('title', app()->getLocale()) }}
                        </h3>
                        @php
                            // Önce excerpt varsa onu kullan, yoksa body'den al
                            if (!empty($post->getTranslation('excerpt', app()->getLocale()))) {
                                $description = strip_tags($post->getTranslation('excerpt', app()->getLocale()));
                            } else {
                                $description = strip_tags($post->getTranslation('body', app()->getLocale()));
                            }
                            $description = preg_replace('/\s+/', ' ', $description);
                            $description = trim($description);
                        @endphp
                        <p class="text-gray-600 mb-4 line-clamp-3 leading-relaxed">
                            {{ Str::limit($description, 120, '...') }}
                        </p>
                        <a href="{{ route('post.show', $post->id) }}" class="text-blue-600 hover:text-blue-800 font-semibold inline-flex items-center">
                            {{ __('messages.read_more') }}
                            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
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
