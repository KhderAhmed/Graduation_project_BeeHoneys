<div class="bg-gradient-to-br from-green-50 to-green-100 min-h-screen flex flex-col">
  <main class="flex-grow container mx-auto px-4 py-12">
    <section class="max-w-lg mx-auto">
      <div class="bg-white/30 backdrop-blur-md rounded-3xl shadow-lg hover:shadow-2xl transition duration-300 p-8 text-center border border-white/20">

        <h3 class="text-3xl font-extrabold text-green-800 mb-6">
          {{ __('messages.title') }}:
          <span class="text-gray-900 font-normal">{{ $product->{'title_' . app()->getLocale()} }}</span>
        </h3>

        <p class="text-gray-700 text-lg leading-relaxed mb-8">
          <span class="font-semibold text-green-700">{{ __('messages.description') }}:</span>
          {{ $product->{'description_' . app()->getLocale()} }}
        </p>

        <a wire:navigate href="{{ route('product.index') }}"
           class="inline-block text-white bg-green-600 hover:bg-green-700 transition px-6 py-3 rounded-full text-sm shadow-md hover:shadow-lg">
          ← {{ __('messages.go back') }}
        </a>

      </div>
    </section>
  </main>
</div>
