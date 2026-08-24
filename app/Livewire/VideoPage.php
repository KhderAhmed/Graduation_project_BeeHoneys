<?php

namespace App\Livewire;
use App\Models\Video;
use Livewire\Component;
use App\Http\Controllers\Services\LangServices;

class VideoPage extends Component
{
    public $videos;
    protected $langServices;

    public function mount(LangServices $langServices)
    {
        $this->videos = Video::all();
        $this->langServices = $langServices;
    }


    public function render()
    {
        $this->langServices->langFunction();
        return view('livewire.video-page');
    }
}
