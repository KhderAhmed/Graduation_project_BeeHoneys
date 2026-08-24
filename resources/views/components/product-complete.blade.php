@props(['product', 'full' => false])

<div class="mt-6">
  @if ($full)
    <p class="text-gray-700 leading-relaxed text-base bg-white/50 backdrop-blur-md p-5 rounded-2xl shadow-lg border border-green-100">
      <strong class="text-green-800">{{ __('messages.description') }}:</strong>
      {{ $product->{'description_' . app()->getLocale()} }}
    </p>
  @else
    <div class="bg-white/50 backdrop-blur-md p-4 rounded-2xl border border-green-100 shadow-md">
      <span class="block text-gray-700 mb-3 line-clamp-3">
        <strong class="text-green-800">{{ __('messages.description') }}:</strong>
        {{ $product->{'description_' . app()->getLocale()} }}
      </span>
      <a wire:navigate href="{{ route('desc.index', $product) }}"
         class="inline-block mt-2 px-5 py-2 bg-green-700 text-white font-semibold rounded-xl shadow-md hover:bg-green-800 hover:shadow-lg transition transform hover:scale-105">
        {{ __('messages.read more') }}
      </a>
    </div>
  @endif
</div>
