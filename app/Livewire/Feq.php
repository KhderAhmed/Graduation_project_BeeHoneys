<?php

namespace App\Livewire;

use App\Http\Controllers\Services\LangServices;
use App\Models\BeeQuestion;
use Livewire\Component;

class Feq extends Component
{
    protected $langServices;

    public function mount(LangServices $langServices)
    {
        $this->langServices = $langServices;
    }



    public function render()
    {
        $this->langServices->langFunction();
        $faqs = BeeQuestion::select("id", "question_" . app()->getLocale(), "answer_" . app()->getLocale())->get();
        return view('livewire.feq', ['faqs' => $faqs]);
    }
}
