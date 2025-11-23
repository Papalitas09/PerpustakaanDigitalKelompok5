<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    public function Login(Request $request)
    {
        if(!Auth::attempt($request->only('email', 'password'))){
            return response()->json([
                'message' => 'Invalid akun'
            ], 201);
        }

        $token = Auth::user()->createToken('api')->plainTextToken;

        return response()->json([
            'token' => $token,
            'message' => 'success'
        ], 200);
    }

    public function Register(Request $request)
    {
        
    }

    public function Logout(Request $request)
    {

    }
}
