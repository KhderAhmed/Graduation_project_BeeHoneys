<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use App\Http\Controllers\Services\LangServices;

class ResentPasswordController extends Controller
{
    protected LangServices $langServices;

    public function __construct(LangServices $langServices)
    {
        $this->langServices = $langServices;
    }
    public function forgot()
    {
        $this->langServices->langFunction();
        return view('auth.forgot-password');
    }
    public function postforgot(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(

            $request->only('email')

        );


        return $status === Password::ResetLinkSent

            ? back()->with(['status' => __($status)])

            : back()->withErrors(['email' => __($status)]);
    }
    public function resent(string $token)
    {
        return view('auth.reset-password', ['token' => $token]);
    }

    public function postresent(Request $request)
    {
        $request->validate([

            'token' => 'required',

            'email' => 'required|email',

            'password' => 'required|min:8|confirmed',

        ]);



        $status = Password::reset(

            $request->only('email', 'password', 'password_confirmation', 'token'),

            function (Client $user, string $password) {

                $user->forceFill([

                    'password' => Hash::make($password)

                ])->setRememberToken(Str::random(60));



                $user->save();



                event(new PasswordReset($user));
            }

        );


        return $status === Password::PasswordReset

            ? redirect()->route('login')->with('status', __($status))

            : back()->withErrors(['email' => [__($status)]]);
    }

    public function verieyemail()
    {
        return view('auth.verify-email');
    }

    public function veriey(EmailVerificationRequest $request)
    {
        $request->fulfill();

        return redirect('/home');
    }
    public function sendEmail(Request $request)
    {
        $request->user()->sendEmailVerificationNotification();

        return back()->with('message', 'Verification link sent!');
    }
}
