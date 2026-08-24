<?php

namespace App\Livewire;

use App\Http\Controllers\Services\LangServices;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Productpage extends Component
{
    use WithPagination;

    protected $langServices;

    public function mount(LangServices $langServices)
    {
        $this->langServices = $langServices;
    }

    public function addToCart($pId)
    {
        if (!Auth::guard('client')->check()) {
            return redirect()->route('login')->with('msg', 'الرجاء تسجيل الدخول أولاً');
        }

        $userId = Auth::guard('client')->id();

        $c = Cart::firstOrNew([
            'client_id' => $userId,
            'product_id' => $pId
        ]);

        $c->quantity += 1;
        $c->save();

        session()->flash('msg', 'أضيف للسلة');
        return back();
    }



    public function render()
    {

        // $this->langServices->langFunction();
        $products = Product::select(
            "id",
            "price",
            "image",
            "description_" . app()->getLocale(),
            "title_" . app()->getLocale()
        )->where('status', 1)->get();

        return view('livewire.productpage', ['products' => $products]);
    }
}
