<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;
use App\Http\Controllers\Services\LangServices;
class Descpage extends Component
{
    public Product $product;
    protected $langServices;


    public function mount(Product $product,LangServices $langServices)
    {
        $this->product = $product;
        $this->langServices = $langServices;
    }

    public function render()
    {
        $this->langServices->langFunction();
        return view('livewire.descpage');
    }
}
