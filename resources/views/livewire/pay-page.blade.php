<div class="max-w-xl mx-auto bg-white/80 backdrop-blur-md shadow-lg p-8 mt-12 mb-20 rounded-xl border border-gray-200">
    <h2 class="text-3xl font-extrabold mb-6 text-gray-900 flex items-center gap-3">
      <span>💳</span> الدفع للطلب رقم: <span class="text-blue-600">{{ $order->id }}</span>
    </h2>
    
    <p class="mb-6 text-xl text-gray-800">
      المبلغ المطلوب: 
      <span class="font-bold text-green-700 text-2xl">{{ $order->total_price }} ر.س</span>
    </p>
    
    <button 
      wire:click="pay" 
      class="w-full bg-green-600 text-white text-lg font-semibold py-3 rounded-xl shadow-md transition-transform hover:bg-green-700 hover:scale-105 active:scale-95"
    >
      💰 دفع الآن 
    </button>
</div>
