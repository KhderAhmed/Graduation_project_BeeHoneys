<?php

namespace App\Livewire;
use App\Http\Controllers\Services\LangServices;
use App\Models\Order;
use Livewire\Component;

class OrdersSuccess extends Component
{
    public $order;
    protected $langServices;

    // يتم تمرير المعطى هنا من الرابط (route)
    public function mount(LangServices $langServices,$orderId)
    {
        $this->order = Order::with('items.product')->findOrFail($orderId);
        $this->langServices = $langServices;
    }

    public function render()
    {
        $this->langServices->langFunction();
        return view('livewire.orders-success', [
            'order' => $this->order,
        ]);
    }
}
