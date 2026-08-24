<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateClientProfileRequest;
use App\Http\Controllers\Services\ClientProfileService;
use App\Http\Controllers\Services\LangServices;
use Illuminate\Support\Facades\Auth;


class ProfileController extends Controller
{
    protected LangServices $langServices;

    public function __construct(LangServices $langServices)
    {
        $this->langServices = $langServices;
    }

    public function profile()
    {
        $this->langServices->langFunction();

        $user = Auth::guard('client')->user();

        return view('auth.profile.edit', compact('user'));
    }

    public function updateProfile(UpdateClientProfileRequest $request, ClientProfileService $profileService)
    {
        $client = auth('client')->user();

        $profileService->update($client, $request->validated());

        return redirect()->route('profile')->with('success', __('messages.profile_updated'));
    }

    public function destroy()
    {
        $client = Auth::guard('client')->user();
        $client->delete();

        return redirect()->back()->with('success', 'Deleted Profile Successfully');
    }
}
