<?php
namespace App\Http\Controllers\Services;
class LangServices
{
    public function langFunction()
    {

        $locale = session()->get('locale', 'ar');
        app()->setLocale($locale);
    }
}

