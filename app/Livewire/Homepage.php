<?php

namespace App\Livewire;

use App\Http\Controllers\Services\LangServices;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class Homepage extends Component
{
    use WithPagination;
    protected $langServices;

    public function mount(LangServices $langServices)
    {
        $this->langServices = $langServices;
    }

    //public  $product;
    public function render()
    {
        $this->langServices->langFunction();
        return view('livewire.homepage');
    }
}

