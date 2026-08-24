<?php

namespace App\Livewire;
use App\Http\Controllers\Services\LangServices;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CartList extends Component
{
    protected $langServices;

    public function mount(LangServices $langServices)
    {
        $this->langServices = $langServices;
    }
    public $isProcessing = false;
    public function checkout()
    {
        if ($this->isProcessing) return;

        $this->isProcessing = true;

        if (!Auth::guard('client')->check()) {
            session()->flash('error', 'الرجاء تسجيل الدخول أولاً');
            $this->isProcessing = false;
            return;
        }

        $clientId = Auth::guard('client')->id();

        $items = Cart::where('client_id', $clientId)->with('product')->get();

        if ($items->isEmpty()) {
            session()->flash('error', 'السلة فارغة');
            $this->isProcessing = false;
            return;
        }

        $total = $items->sum(fn($item) => $item->quantity * $item->product->price);

        $order = Order::create([
            'client_id' => $clientId,
            'total_price' => $total,
        ]);

        foreach ($items as $item) {
            OrderItem::create([
                'order_id'   => $order->id,
                'product_id' => $item->product_id,
                'quantity'   => $item->quantity,
                'price'      => $item->product->price,
            ]);
        }

        Cart::where('client_id', $clientId)->delete();

        return redirect()->route('fake.pay', $order->id);
    }

    public function increase($id) {
        $cart = Cart::findOrFail($id);
        $cart->quantity++;
        $cart->save();
    }

    public function decrease($id) {
        $cart = Cart::findOrFail($id);
        if ($cart->quantity > 1) {
            $cart->quantity--;
            $cart->save();
        }
    }

    public function remove($id)
    {
        Cart::where('id', $id)
            ->where('client_id', Auth::guard('client')->id())
            ->delete();
    }





    public function render()
    {
        $this->langServices->langFunction();
        $userId = Auth::guard('client')->id();

        $items = Cart::with('product')->where('client_id', $userId)->get();
        $total = $items->sum(fn($i) => $i->quantity * $i->product->price);

        return view('livewire.cart-list', compact('items', 'total'));

    }


}
