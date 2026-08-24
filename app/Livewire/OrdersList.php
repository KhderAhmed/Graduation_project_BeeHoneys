<?php

namespace App\Livewire;
use App\Http\Controllers\Services\LangServices;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class OrdersList extends Component
{
    protected $langServices;

    public function mount(LangServices $langServices)
    {
        $this->langServices = $langServices;
    }

    public function render()
    {
        $this->langServices->langFunction();
        $userId = Auth::guard('client')->id();

        $orders = Order::with('items.product')
            ->where('client_id', $userId)
            ->latest()
            ->get();

        return view('livewire.orders-list', compact('orders'));
    }
}
