<?php

namespace App\Http\Controllers\Berker;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Services\ClientProfileBeekeeperService;
use App\Http\Requests\UpdateClientProfileBeekeeperRequest;
use App\Http\Controllers\Services\LangServices;
use Illuminate\Support\Facades\Auth;

class ProfileBeekeerperController extends Controller
{

    protected LangServices $langServices;

    public function __construct(LangServices $langServices)
    {
        $this->langServices = $langServices;
    }

    public function profilebeekeer()
    {
        $this->langServices->langFunction();

        $user = Auth::guard('beekeeper')->user();

        return view('Beekeeper.auth.profile.edit', compact('user'));
    }

    public function updateProfilebeekeer(UpdateClientProfileBeekeeperRequest $request, ClientProfileBeekeeperService $profileService)
    {
        $beekeeper = auth('beekeeper')->user();

        $profileService->update($beekeeper, $request->validated());

        return redirect()->route('profile.beekeer')->with('success', __('messages.profile_updated'));
    }

    public function destroybeekeer()
    {
        $client = Auth::guard('beekeeper')->user();
        $client->delete();

        return redirect()->back()->with('success', 'Deleted Profile Successfully');
    }
}
