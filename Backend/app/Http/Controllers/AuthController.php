<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{
    public function Login(Request $request)
    {
        if(!Auth::attempt($request->only('email', 'password'))){
            return response()->json([
                'message' => 'Invalid akun'
            ], 401);
        }

        $token = Auth::user()->createToken('api')->plainTextToken;

        return response()->json([
            'token' => $token,
            'message' => 'success'
        ], 200);
    }

    public function Register(Request $request)
    {
         $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string',
        ]);

        
        $hashedPassword = Hash::make($request->password);
        $akun = User::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => $hashedPassword,
            'role' => 'pengguna'
        ]);
        if($akun){
           return response()->json([
               'message' => 'Berhasil',
               'data' => $akun
           ]);
        } else{
            return response()->json([
               'message' => 'Error'
           ]);
        }
    }

    public function Logout(Request $request)
    {

    }
}
