<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClientLoginRequest;
use App\Http\Requests\ClientRegisterRequest;
use App\Http\Controllers\Services\LangServices;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ClientController extends Controller
{
    protected LangServices $langServices;

    public function __construct(LangServices $langServices)
    {
        $this->langServices = $langServices;
    }

    private function prepareLocale(): void
    {
        $this->langServices->langFunction();
    }

    public function login()
    {
        $this->prepareLocale();
        session(['captcha_code' => rand(1000, 9999)]);
        return view('auth.login');
    }

    public function postlogin(ClientLoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('client')->attempt($credentials, $request->boolean('remember'))) {
            session(['pending_user_id' => Auth::guard('client')->id()]);
            return redirect()->route('verify-captcha.get');
        }

        return back()->withErrors(['email' => __('auth.failed')])->withInput();
    }

    public function register()
    {
        $this->prepareLocale();
        return view('auth.register');
    }

    public function postregister(ClientRegisterRequest $request)
    {
        $data = $request->validated();
        $data['password'] = Hash::make($data['password']);
        Client::create($data);

        return redirect()->route('login')->with('success', __('messages.register_success'));
    }


    public function logout()
    {
        Auth::guard('client')->logout();

        return redirect('/')->with('success', 'Logged out successfully.');
    }
}
