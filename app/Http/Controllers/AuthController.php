<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * @OA\Post(
     *      path="/login",
     *      operationId="login",
     *      tags={"Auth"},
     *      summary="Authenticate the user",
     *      description="Login by email, password",
     *
     *      @OA\RequestBody(
     *          required=true,
     *          description="Pass user credentials",
     *          @OA\JsonContent(
     *              required={"email","password"},
     *              @OA\Property(property="email", type="string", format="email", example="user1@mail.com"),
     *              @OA\Property(property="password", type="string", format="password", example="1234"),
     *          ),
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Access Token",
     *          @OA\JsonContent(
     *              @OA\Property(property="token", type="string", example="2|PkFX5vnZdLdkAWUdek5L78yvHXzE0kDl0wjVIuxT")
     *          )
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="wrong email or password !")
     *          )
     *      )
     * )
     */

    public function login(Request $request)
    {

        $user = User::where('email', $request->input("email"))->first();

        if (!$user || !Hash::check($request->input("password"), $user->password)) {
            return response(["message" => "wrong email or password !"], 401);
        }


        $token = $user->createToken("app_token");
        return ['token' => $token->plainTextToken];
    }


    /**
     * @OA\Post(
     *      path="/logout",
     *      operationId="logout",
     *      tags={"Auth"},
     *      summary="sign out",
     *      description="Logout user and invalidate token",
     *      security={ {"bearer": {} }},
     *
     *      @OA\Response(
     *          response=200,
     *          description="Success",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="logged out")
     *          )
     *       ),
     *
     *      @OA\Response(
     *          response=401,
     *          description="Returns when user is not authenticated",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="Unauthenticated.")
     *          )
     *      )
     * )
     */

    public function logout(Request $request)
    {
        Auth::user()->tokens()->delete();
        return ["message" => "logged out"];
    }
}
