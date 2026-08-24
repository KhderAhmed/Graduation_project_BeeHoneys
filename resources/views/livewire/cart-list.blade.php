<div class="bg-gradient-to-br from-green-50 to-green-100 min-h-screen flex flex-col">

  <main class="container mx-auto px-4 py-10 flex-grow">

    <!-- رسالة نجاح أو خطأ -->
    @if (session()->has('msg'))
      <div class="mb-6 text-green-800 bg-white/30 backdrop-blur-md border border-white/20 px-5 py-4 rounded-2xl shadow transition">
        ✅ {{ session('msg') }}
      </div>
    @endif

    <!-- عنوان الصفحة -->
    <h1 class="text-4xl font-extrabold text-green-800 mb-8 text-center">
      🧺 {{ __('messages.shopping cart') }}
    </h1>

    <!-- جدول السلة -->
    <div class="overflow-x-auto bg-white/30 backdrop-blur-lg border border-white/20 rounded-2xl shadow-lg">
      <table class="min-w-full table-auto">
    <thead class="bg-green-600 text-white/90">
  <tr>
    <th class="p-4 text-left text-sm"> {{ __('messages.product') }}</th>
    <th class="p-4 text-left text-sm"> {{ __('messages.price') }}</th>
    <th class="p-4 text-center text-sm">{{ __('messages.quantity') }}</th>
    <th class="p-4 text-left text-sm">{{ __('messages.total') }}</th>
    <th class="p-4 text-center text-sm">{{ __('messages.action') }}</th>
  </tr>
</thead>

        <tbody>
          @forelse($items as $item)
            <tr class="text-center border-t hover:bg-green-50/40 transition-colors duration-300">
              <td class="p-4 text-left">{{ $item->product->{'title_' . app()->getLocale()} }}</td>
              <td class="p-4 text-left">{{ number_format($item->product->price, 2) }} ر.س</td>
              <td class="p-4 flex justify-center items-center space-x-3">
                <button wire:click="decrease({{ $item->id }})"
                        class="text-lg px-3 py-1 rounded-full bg-white/50 backdrop-blur-sm hover:bg-white/70 transition">➖</button>
                <span class="px-3 font-semibold">{{ $item->quantity }}</span>
                <button wire:click="increase({{ $item->id }})"
                        class="text-lg px-3 py-1 rounded-full bg-white/50 backdrop-blur-sm hover:bg-white/70 transition">➕</button>
              </td>
              <td class="p-4 font-semibold text-green-700">
                {{ number_format($item->quantity * $item->product->price, 2) }} ر.س
              </td>
              <td class="p-4">
                <button wire:click="remove({{ $item->id }})"
                        class="text-red-600 hover:text-red-800 text-sm transition">
                  🗑️ {{ __('messages.delete') }}
                </button>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="5" class="p-6 text-center text-gray-600">
                {{ __('messages.cart empty') }} 😢
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    <!-- المجموع -->
    <div class="text-right text-2xl font-bold mt-8 text-green-700">
      💰 {{ __('messages.total') }}: {{ number_format($total, 2) }} ر.س
    </div>

    <!-- أزرار العودة والتنفيذ -->
    <div class="flex justify-between items-center mt-8 flex-wrap gap-4">
      <a href="/product"
         class="inline-block bg-white/50 backdrop-blur-sm hover:bg-white/70 text-green-800 font-medium py-2 px-6 rounded-full shadow-md transition">
        ⬅️ {{ __('messages.go back') }}
      </a>

      <button wire:click="checkout"
              class="bg-white/50 backdrop-blur-sm hover:bg-white/70 text-green-800 px-6 py-2 rounded-full shadow-md transition">
        ✅ {{ __('messages.execute the request') }}
      </button>
    </div>

  </main>

</div>
