<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class apiAuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'max:255'],

            'email' => ['required', 'max:255', 'email', 'unique:clients'],

            'password' => ['required', 'min:5', 'confirmed'],
        ]);

        if ($validator->fails()) {

            $errorMessage = $validator->errors()->first();
            $response = [
                'status' => false,
                'message' => $errorMessage
            ];
            return response()->json($response, 401);
        }
        Client::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
        return response()->json([
            "status" => true,
            "message" => "User Register Successfully"
        ]);
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) {

            $errorMessage = $validator->errors()->first();
            $response = [
                'status' => false,
                'message' => $errorMessage
            ];
            return response()->json($response, 401);
        }
        $client = Client::where("email", $request->email)->first();
        if (!empty($client)) {
            if (Hash::check($request->password, $client->password)) {
                $tokenInfo = $client->createToken("Client_Token");
                $token = $tokenInfo->plainTextToken;
                return response()->json([
                    "status" => true,
                    "message" => "Logging Successfully",
                    "token" => $token,
                ]);
            } else {
                return response()->json([
                    "status" => false,
                    "message" => "Password Didnt Match"
                ]);
            }
        } else {
            return response()->json([
                "status" => false,
                "message" => "Field"
            ]);
        }
    }
    public function profile()
    {
        $profile = auth()->user();
        return response()->json([
            "status" => true,
            "message" => "Profile Information",
            "data" => $profile,
        ]);

    }

    public function logout()
    {
        \request()->user()->tokens()->delete();
        return response()->json([
            "status" => true,
            "message" => "User Logged Out",

        ]);
    }

    public function refreshToken()
    {
        $tokenInfo = \request()->user()->createToken("New_Client_Token");
        $newToken = $tokenInfo->plainTextToken;
        return response()->json([
            "status" => true,
            "message" => "Logging Successfully",
            "access_token" => $newToken,
        ]);

    }

}
