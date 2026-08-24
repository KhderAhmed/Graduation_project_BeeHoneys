<?php

namespace App\Http\Controllers\Berker;

use App\Http\Requests\BeekeeperLoginRequest;
use App\Http\Requests\BeekeeperRegisterRequest;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Services\LangServices;
use App\Models\Beekeeper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class BeekeeperController extends Controller
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

    /** 
     * Show login form 
     */
    public function loginbee()
    {
        $this->prepareLocale();
        return view('Beekeeper.auth.login');
    }

    /** 
     * Handle login 
     */

    public function postregisterbee(BeekeeperRegisterRequest $request)
    {
        $data = $request->validated();
        $data['password'] = Hash::make($data['password']);

        $beekeeper = Beekeeper::create($data);

        Auth::guard('beekeeper')->login($beekeeper);

        return redirect()->route('redeem.form')->with('success', __('messages.register_success'));
    }

    /** 
     * Show register form 
     */
    public function registerbee()
    {
        $this->prepareLocale();
        return view('Beekeeper.auth.register');
    }

    /** 
     * Handle register 
     */
    public function postloginbee(BeekeeperLoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('beekeeper')->attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            return redirect()->route('redeem.form')->with('success', __('messages.login_success'));
        }

        return back()->withErrors(['email' => __('auth.failed')])->onlyInput('email');
    }

    /** 
     * Handle logout 
     */
    public function logoutbeekeeper(Request $request)
    {
        Auth::guard('beekeeper')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', __('messages.logout_success'));
    }
}
