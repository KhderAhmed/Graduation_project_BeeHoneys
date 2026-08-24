<?php

namespace App\Http\Controllers\Berker;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Code;
use Illuminate\Http\Request;

class RedeemCodeController extends Controller
{
  
    public function redeem(Request $request)
    {
        // التحقق من المدخلات
        $request->validate([
            'codeInput' => 'required|string',
        ]);

        $client = Auth::guard('beekeeper')->user();
        $code = Code::where('code', strtoupper(trim($request->input('codeInput'))))->first();

        if (!$code) {
            return back()->with('message', '❌ الكود غير صحيح');
        }

        if ($code->is_redeemed) {
            return back()->with('message', '⚠️ الكود مستخدم مسبقاً');
        }

        if ($code->expires_at && now()->gt($code->expires_at)) {
            return back()->with('message', '⏰ انتهت صلاحية الكود');
        }

        $code->update([
            'is_redeemed' => true,
            'beekeeper_id'   => $client->id,
            'redeemed_at' => now(),
        ]);

        session()->put('has_code_access', true);

        return redirect()->route('hives.dashboard');
    }
        public function showForm()
    {
        return view('Beekeeper.auth.redeemC');
    }
}
