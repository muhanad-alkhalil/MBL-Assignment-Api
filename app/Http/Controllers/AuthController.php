<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {

        $user = User::where('email', $request->input("email"))->first();

        if (!$user || !Hash::check($request->input("password"), $user->password)) {
            return response(["message" => "wrong email or password !"], 401);
        }


        $token = $user->createToken("app_token");
        return ['token' => $token->plainTextToken];
    }

    public function logout(Request $request)
    {
        Auth::user()->tokens()->delete();
        return ["message" => "logged out"];
    }
}
