<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CaptchaVerifyRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'captcha' => ['required', function ($attribute, $value, $fail) {
                $code = session('captcha_code');
                $expiry = session('captcha_expiry');

                if (!$code || !$expiry || now()->timestamp > $expiry) {
                    $fail('رمز التحقق انتهت صلاحيته، الرجاء إعادة المحاولة.');
                    return;
                }

                if ($value !== $code) {
                    $fail('رمز التحقق غير صحيح.');
                }
            }],
        ];
    }
}
