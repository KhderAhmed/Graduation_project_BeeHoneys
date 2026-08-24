<?php

namespace App\Livewire;

use App\Http\Controllers\Services\LangServices;
use App\Models\Contact;
use Livewire\Component;

class Contactpage extends Component
{
    public $name;
    public $email;
    public $message;
    public $phone;
    public function submit()
    {
        $validatedData = $this->validate([
            'name' => 'required|min:6',
            'email' => 'required|email',
            'phone' => 'required',
            'message' => 'required|min:6',
        ]);
        Contact::create($validatedData);
        return redirect('/home');
    }


    protected $langServices;

    public function mount(LangServices $langServices)
    {
        $this->langServices = $langServices;
    }

    public function render()
    {
        $this->langServices->langFunction();
        return view('livewire.contactpage');
    }
}
