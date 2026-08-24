<div x-data="{ open: false }" class="w-full">
    <nav class="bg-green-600 p-4 shadow-md">
        <div class="container mx-auto flex justify-between items-center">
            <!-- Logo -->
            <a wire:navigate href="/" class="text-white text-lg font-bold tracking-wide">
                {{ __('messages.Bee Honey') }}
            </a>

            <!-- زر القائمة للموبايل -->
            <button @click="open = !open" class="text-white md:hidden focus:outline-none">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path x-show="!open" stroke-linecap="round" stroke-linejoin="round"
                        d="M4 6h16M4 12h16M4 18h16" />
                    <path x-show="open" stroke-linecap="round" stroke-linejoin="round"
                        d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>

            <!-- القائمة العادية على الشاشات الكبيرة -->
            <ul class="hidden md:flex space-x-6 items-center text-white text-sm md:text-base">
                <li><a wire:navigate href="/home" class="hover:text-gray-200 transition">{{ __('messages.home') }}</a></li>
                <li><a wire:navigate href="/about" class="hover:text-gray-200 transition">{{ __('messages.about') }}</a></li>
                <li><a wire:navigate href="/product" class="hover:text-gray-200 transition">{{ __('messages.products') }}</a></li>
                <li><a wire:navigate href="/contact" class="hover:text-gray-200 transition">{{ __('messages.contact') }}</a></li>

                @if (Auth::guard('client')->check())
                    <li><a wire:navigate href="/profile" class="hover:text-gray-200 transition">
                            {{ Auth::guard('client')->user()->name }}</a></li>
                @else
                    <li><a wire:navigate href="/login" class="hover:text-gray-200 transition">
                            {{ __('messages.login') }}</a></li>
                @endif

                <li>
                    <select onchange="window.location.href = this.value"
                        class="bg-green-600 border border-green-400 text-white rounded px-2 py-1 focus:outline-none">
                        <option value="{{ route('lang.switch', 'ar') }}" @if (session('locale') == 'ar') selected @endif>العربية</option>
                        <option value="{{ route('lang.switch', 'en') }}" @if (session('locale') == 'en') selected @endif>English</option>
                    </select>
                </li>
            </ul>
        </div>

        <!-- القائمة المنسدلة للموبايل -->
        <div x-show="open" @click.outside="open = false" class="md:hidden mt-4 space-y-2" x-transition>
            <a @click="open = false" wire:navigate href="/home" class="block text-white px-4 hover:bg-green-700">{{ __('messages.home') }}</a>
            <a @click="open = false" wire:navigate href="/about" class="block text-white px-4 hover:bg-green-700">{{ __('messages.about') }}</a>
            <a @click="open = false" wire:navigate href="/product" class="block text-white px-4 hover:bg-green-700">{{ __('messages.products') }}</a>
            <a @click="open = false" wire:navigate href="/contact" class="block text-white px-4 hover:bg-green-700">{{ __('messages.contact') }}</a>

            @if (Auth::guard('client')->check())
                <a @click="open = false" wire:navigate href="/profile" class="block text-white px-4 hover:bg-green-700">
                    {{ Auth::guard('client')->user()->name }}
                </a>
            @else
                <a @click="open = false" wire:navigate href="/login" class="block text-white px-4 hover:bg-green-700">
                    {{ __('messages.login') }}
                </a>
            @endif

            <div class="px-4">
                <select onchange="window.location.href = this.value"
                    class="w-full bg-white text-black rounded px-2 py-1">
                    <option value="{{ route('lang.switch', 'ar') }}" @if (session('locale') == 'ar') selected @endif>العربية</option>
                    <option value="{{ route('lang.switch', 'en') }}" @if (session('locale') == 'en') selected @endif>English</option>
                </select>
            </div>
        </div>
    </nav>
</div>

<!-- Alpine.js لتفعيل التفاعل -->
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
