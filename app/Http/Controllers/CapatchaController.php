<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Services\LangServices;
use App\Http\Controllers\Services\CaptchaService;
use App\Http\Requests\CaptchaVerifyRequest;

class CapatchaController extends Controller
{
    protected LangServices $langServices;
    protected CaptchaService $captchaService;

    public function __construct(LangServices $langServices, CaptchaService $captchaService)
    {
        $this->langServices = $langServices;
        $this->captchaService = $captchaService;
    }

    public function CapatchaImage()
    {
        $code = $this->captchaService->generateCode();
        $this->captchaService->storeCaptchaInSession($code, 300); // صلاحية 5 دقائق

        $data = $this->captchaService->createCaptchaImage($code);

        return response($data)->header('Content-Type', 'image/png');
    }
    public function CapatchaVerify()
    {
        $this->langServices->langFunction();

        if (!session()->has('pending_user_id')) {
            return redirect('/login');
        }
        return view('auth.verify-captcha');
    }



    public function CapatchaVerifySend(CaptchaVerifyRequest $request)
    {
        if (!session()->has('pending_user_id')) {
            return redirect('/login');
        }

        // إذا وصل هنا، الكابتشا صح لأن الطلب تم التحقق منه
        $user = \App\Models\Client::find(session('pending_user_id'));
        session()->forget('pending_user_id');
        session()->forget('captcha_code');
        session()->forget('captcha_expiry');

        return redirect()->route('home.index');
    }
}
