<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateClientRequest extends FormRequest
{
    public function authorize()
    {
        return true; // عدل حسب سياساتك
    }

    public function rules()
    {
        return [
            'title_ar' => 'required|min:3',
            'title_en' => 'required|min:3',
            'description_ar' => 'required|min:5',
            'description_en' => 'required|min:5',
            'image' => 'nullable|image',
        ];
    }
}
