<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientLoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        return [
            'email' => ['required', 'email', 'exists:clients,email'],
            'password' => ['required', 'string'],

        ];
    }

    public function messages()
    {
        return [
            'email.required' => __('messages.email_required'),
            'email.email' => __('messages.email_email'),
            'email.exists' => __('messages.email_exists'),
            'password.required' => __('messages.password_required'),
        ];
    }
}
