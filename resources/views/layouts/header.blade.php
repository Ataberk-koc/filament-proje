<header class="shadow-md fixed top-0 left-0 right-0 z-50 backdrop-blur-sm bg-white/95">
    <nav class="container mx-auto px-4 py-4">
        <div class="flex items-center justify-between">
            <!-- Logo -->
            <div class="flex items-center">
                <a href="{{ LaravelLocalization::localizeURL('/') }}" class="text-2xl font-bold text-gray-800">
                    {{ config('app.name', 'Laravel') }}
                </a>
            </div>
            
            <!-- Navigation Menu -->
            <div class="hidden md:flex space-x-8">
                <a href="{{ LaravelLocalization::localizeURL('/') }}" class="text-gray-700 hover:text-blue-600 transition">{{ __('messages.home') }}</a>
                <a href="{{ LaravelLocalization::localizeURL('/posts') }}" class="text-gray-700 hover:text-blue-600 transition">{{ __('messages.posts') }}</a>
                <a href="{{ LaravelLocalization::localizeURL('/about') }}" class="text-gray-700 hover:text-blue-600 transition">{{ __('messages.about') }}</a>
                <a href="{{ LaravelLocalization::localizeURL('/contact') }}" class="text-gray-700 hover:text-blue-600 transition">{{ __('messages.contact') }}</a>
            </div>
            
            <!-- Language Switcher -->
            <div class="flex items-center space-x-4">
                @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                    <a href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}" 
                       class="text-sm {{ app()->getLocale() == $localeCode ? 'font-bold text-blue-600' : 'text-gray-600' }}">
                        {{ strtoupper($localeCode) }}
                    </a>
                    @if (!$loop->last)
                        <span class="text-gray-400">|</span>
                    @endif
                @endforeach
            </div>
            
            <!-- Mobile Menu Button -->
            <button class="md:hidden text-gray-700" id="mobile-menu-button">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
        </div>
        
        <!-- Mobile Menu -->
        <div class="hidden md:hidden mt-4" id="mobile-menu">
            <a href="{{ LaravelLocalization::localizeURL('/') }}" class="block py-2 text-gray-700 hover:text-blue-600">{{ __('messages.home') }}</a>
            <a href="{{ LaravelLocalization::localizeURL('/posts') }}" class="block py-2 text-gray-700 hover:text-blue-600">{{ __('messages.posts') }}</a>
            <a href="{{ LaravelLocalization::localizeURL('/about') }}" class="block py-2 text-gray-700 hover:text-blue-600">{{ __('messages.about') }}</a>
            <a href="{{ LaravelLocalization::localizeURL('/contact') }}" class="block py-2 text-gray-700 hover:text-blue-600">{{ __('messages.contact') }}</a>
        </div>
    </nav>
</header>

<script>
    // Mobile menu toggle
    document.getElementById('mobile-menu-button')?.addEventListener('click', function() {
        document.getElementById('mobile-menu')?.classList.toggle('hidden');
    });
    
    // Header scroll effect (optional)
    let lastScroll = 0;
    const header = document.querySelector('header');
    
    window.addEventListener('scroll', function() {
        const currentScroll = window.pageYOffset;
        
        if (currentScroll > 50) {
            header?.classList.add('shadow-lg');
        } else {
            header?.classList.remove('shadow-lg');
        }
        
        lastScroll = currentScroll;
    });
</script>
