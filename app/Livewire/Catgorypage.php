<?php

namespace App\Livewire;

use App\Http\Controllers\Services\LangServices;
use App\Models\Catgory;
use Livewire\Component;

class Catgorypage extends Component
{
    protected $langServices;

    public function mount(LangServices $langServices)
    {
        $this->langServices = $langServices;
    }
    public function render()
    {
     
        return view('livewire.catgorypage');
    }
}
