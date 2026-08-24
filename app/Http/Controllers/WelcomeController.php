<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Services\LangServices;
use App\Models\Video;

class WelcomeController extends Controller
{
    public function __construct(protected LangServices $langServices)
    {
    }

    public function index()
    {
        $this->langServices->langFunction();

        return view('welcome');
    }
    public function staticPage()
    {
        $this->langServices->langFunction();

        return view('staticpage');
    }

    public function languish(string $lang)
    {
        session()->put('locale', $lang);

        return back();
    }
}