<section class="bg-gradient-to-br from-green-50 to-green-100 py-12">
    <h2 class="text-4xl font-extrabold text-green-800 text-center mb-12">
        {{ __('messages.product') }}
    </h2>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach ($products as $product)
            <div
                class="bg-white/90 backdrop-blur-md rounded-3xl shadow-md hover:shadow-2xl transition p-5 flex flex-col justify-between border border-green-100">

                <!-- صورة المنتج -->
                <div class="relative">
                    <img src="{{ asset('storage/' . $product->image) }}"
                        alt="{{ $product->{'title_' . app()->getLocale()} }}"
                        class="w-full h-52 object-cover rounded-xl mb-4 shadow-lg transition-transform duration-500 hover:scale-105"
                        loading="lazy" />
                </div>

                <!-- عنوان المنتج -->
                <h3 class="text-xl font-bold text-gray-900 mb-2">
                    {{ __('messages.nameproduct') }}:
                    <span class="text-green-700">{{ $product->{'title_' . app()->getLocale()} }}</span>
                </h3>

                <!-- الوصف أو حالة المنتج (مكون مستقل) -->
                <x-product-complete :product="$product" />

                <!-- السعر -->
                <p class="text-green-700 text-lg font-bold mt-3">
                    {{ __('messages.price') }}: {{ $product->price }} $
                </p>

                <!-- زر الإضافة للسلة -->
                <button wire:click="addToCart({{ $product->id }})"
                    class="mt-6 w-full py-3 px-4 bg-green-700 hover:bg-green-800 text-white font-semibold rounded-xl shadow-lg transition transform hover:scale-105">
                    🛍️ {{ __('messages.added_to_cart') }}
                </button>
            </div>
        @endforeach
    </div>

    <!-- رابط السلة -->
    <div class="text-center mt-12">
        <a href="/cart"
            class="inline-block bg-yellow-500 hover:bg-yellow-600 text-white text-lg font-medium py-3 px-6 rounded-full shadow-md transition transform hover:scale-105">
            🛒 {{ __('messages.cart') }}
        </a>
    </div>
</section>
