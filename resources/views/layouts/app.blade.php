<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>{{ config('app.name', 'Laravel') }} - @yield('title')</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <style>
        /* Fixed header scroll effect */
        header {
            transition: all 0.3s ease;
        }
        
        /* Slider section - header'ın hemen altında */
        .slider-section {
            width: 100%;
            overflow: hidden;
            margin-top: -72px; /* Header yüksekliği kadar yukarı çek */
        }
        
        .swiper {
            width: 100%;
            height: calc(70vh + 72px); /* Header yüksekliğini ekle */
            min-height: 572px; /* 500px + 72px */
            max-height: 872px; /* 800px + 72px */
        }
        
        .swiper-slide {
            background-position: center center;
            background-size: cover; /* Resmi tam kaplat */
            background-repeat: no-repeat;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: flex-start; /* İçeriği sola hizala */
            width: 100%;
            height: 100%;
        }
        
        /* Resmi slider'ın tam boyutuna sığdır */
        .swiper-slide img {
            width: 100%;
            height: 100%;
            object-fit: cover; /* Resmi kırpmadan doldur */
            object-position: center; /* Resmi ortala */
        }
        
        /* Resim üzerine koyu katman */
        .swiper-slide::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(
                to bottom,
                rgba(0, 0, 0, 0.3) 0%,
                rgba(0, 0, 0, 0.5) 100%
            );
            z-index: 1;
        }
        
        .swiper-slide-content {
            position: relative;
            text-align: left; /* Sola hizala */
            color: white;
            z-index: 10;
            width: 90%;
            max-width: 1200px;
            padding: 2rem;
            margin-left: 5%; /* Sol taraftan boşluk bırak */
        }
        
        .slider-title {
            font-size: clamp(2rem, 5vw, 4rem);
            font-weight: bold;
            margin-bottom: 1rem;
            text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.7);
            line-height: 1.2;
        }
        
        .slider-description {
            font-size: clamp(1rem, 2vw, 1.5rem);
            margin-bottom: 2rem;
            text-shadow: 1px 1px 4px rgba(0, 0, 0, 0.7);
            line-height: 1.6;
            max-width: 700px; /* Açıklama çok uzun olmasın */
        }
        
        .slider-button {
            display: inline-block;
            padding: 14px 40px;
            background-color: #3b82f6;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 600;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(59, 130, 246, 0.4);
        }
        
        .slider-button:hover {
            background-color: #2563eb;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(59, 130, 246, 0.6);
        }
        
        .swiper-button-next,
        .swiper-button-prev {
            color: white !important;
            background: rgba(0, 0, 0, 0.5);
            width: 50px !important;
            height: 50px !important;
            border-radius: 50%;
            backdrop-filter: blur(5px);
        }
        
        .swiper-button-next:hover,
        .swiper-button-prev:hover {
            background: rgba(0, 0, 0, 0.7);
        }
        
        .swiper-button-next:after,
        .swiper-button-prev:after {
            font-size: 20px !important;
        }
        
        .swiper-pagination-bullet {
            background: white !important;
            opacity: 0.7;
            width: 12px !important;
            height: 12px !important;
        }
        
        .swiper-pagination-bullet-active {
            opacity: 1 !important;
            background: #3b82f6 !important;
        }
        
        /* Responsive düzenlemeler */
        @media (max-width: 768px) {
            .swiper {
                height: 60vh;
                min-height: 400px;
            }
            
            .swiper-slide-content {
                margin-left: 0;
                width: 95%;
                padding: 1.5rem;
                text-align: center; /* Mobilde ortala */
            }
            
            .slider-description {
                max-width: 100%;
            }
        }
            
            .swiper-slide-content {
                width: 95%;
                padding: 1rem;
            }
            
            .slider-button {
                padding: 12px 30px;
                font-size: 1rem;
            }
        }
    </style>
    
    @stack('styles')
</head>
<body class="antialiased">
    <!-- Header -->
    @include('layouts.header')
    
    <!-- Main Content -->
    <main>
        @yield('content')
    </main>
    
    <!-- Footer -->
    @include('layouts.footer')
    
    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    
    @stack('scripts')
</body>
</html>
