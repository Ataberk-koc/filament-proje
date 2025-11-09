<header class="bg-white shadow-md">
    <nav class="container mx-auto px-4 py-4">
        <div class="flex items-center justify-between">
            <!-- Logo -->
            <div class="flex items-center">
                <a href="{{ url('/') }}" class="text-2xl font-bold text-gray-800">
                    {{ config('app.name', 'Laravel') }}
                </a>
            </div>
            
            <!-- Navigation Menu -->
            <div class="hidden md:flex space-x-8">
                <a href="{{ route('home') }}" class="text-gray-700 hover:text-blue-600 transition">{{ __('messages.home') }}</a>
                <a href="{{ route('posts') }}" class="text-gray-700 hover:text-blue-600 transition">{{ __('messages.posts') }}</a>
                <a href="{{ url('/about') }}" class="text-gray-700 hover:text-blue-600 transition">{{ __('messages.about') }}</a>
                <a href="{{ url('/contact') }}" class="text-gray-700 hover:text-blue-600 transition">{{ __('messages.contact') }}</a>
            </div>
            
            <!-- Language Switcher -->
            <div class="flex items-center space-x-4">
                <a href="{{ url('locale/tr') }}" class="text-sm {{ app()->getLocale() == 'tr' ? 'font-bold text-blue-600' : 'text-gray-600' }}">TR</a>
                <span class="text-gray-400">|</span>
                <a href="{{ url('locale/en') }}" class="text-sm {{ app()->getLocale() == 'en' ? 'font-bold text-blue-600' : 'text-gray-600' }}">EN</a>
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
            <a href="{{ route('home') }}" class="block py-2 text-gray-700 hover:text-blue-600">{{ __('messages.home') }}</a>
            <a href="{{ route('posts') }}" class="block py-2 text-gray-700 hover:text-blue-600">{{ __('messages.posts') }}</a>
            <a href="{{ url('/about') }}" class="block py-2 text-gray-700 hover:text-blue-600">{{ __('messages.about') }}</a>
            <a href="{{ url('/contact') }}" class="block py-2 text-gray-700 hover:text-blue-600">{{ __('messages.contact') }}</a>
        </div>
    </nav>
</header>

<script>
    document.getElementById('mobile-menu-button')?.addEventListener('click', function() {
        document.getElementById('mobile-menu')?.classList.toggle('hidden');
    });
</script>
