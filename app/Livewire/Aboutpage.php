<?php

namespace App\Livewire;

use App\Http\Controllers\Services\LangServices;
use App\Models\About;
use Livewire\Component;

class Aboutpage extends Component
{

    protected $langServices;

    public function mount(LangServices $langServices)
    {
        $this->langServices = $langServices;
    }

    public function render()
    {
        $this->langServices->langFunction();
      $abouts = About::select("id", "description_" . app()->getLocale(), "title_" . app()->getLocale())->get();
        return view('livewire.aboutpage',['abouts' => $abouts]);
    }
}
