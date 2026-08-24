<?php

namespace App\Livewire;

use App\Http\Controllers\Services\LangServices;
use App\Models\Contactme;
use Livewire\Component;

class TeamWork extends Component
{
    public $phones;
    protected $langServices;

    public function mount(LangServices $langServices)
    {
        $this->phones = Contactme::select("id", "email", "phone", "name_" . app()->getLocale())
            ->where('status', 1)->get();
        $this->langServices = $langServices;
    }

    public function render()
    {
        $this->langServices->langFunction();
        return view('livewire.team-work');
    }
}
