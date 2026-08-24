<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BeekeeperRegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // اسمح للجميع بالتسجيل
    }

    public function rules(): array
    {
        return [
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'email', 'unique:beekeepers,email'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ];
    }
}
