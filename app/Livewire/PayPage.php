<?php
namespace App\Livewire;

use Livewire\Component;
use App\Models\Order;

class PayPage extends Component
{
    public $orderId;
    public $order;

    public function mount($orderId)
    {
        $this->orderId = $orderId;
        $this->order = Order::findOrFail($orderId);
    }

    public function pay()
    {
        $this->order->update(['status' => 'paid']);

        session()->flash('message', '✅ تم الدفع بنجاح.');

        return redirect()->route('order.success', $this->order->id);
    }

    public function render()
    {
        return view('livewire.pay-page');
    }
}
