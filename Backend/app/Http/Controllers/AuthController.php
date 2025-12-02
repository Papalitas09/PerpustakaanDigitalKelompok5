<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{
    public function LoginView()
    {
        return view('auth.login');
    }

    public function RegisterView(){
        return view('auth.register');
    }

    public function Login(Request $request){
        $validasi = $request->validate([
            'email' => 'required|string|email|max:255',
            'password' => 'required|string',
        ]);
        
        if (Auth::attempt($validasi)) {
        $request->session()->regenerate();
       if(Auth::user()->role == "admin"){
          return redirect()->route('dashboard.admin');
        }else if(Auth::user()->role == "petugas"){
          return redirect()->route('dashboard.petugas');
       }else{
        return redirect()->route('dashboard.pengguna');
      }
      };

      return back()->withErrors([
        'email' => 'The provided credentials do not match our records.',
      ])->onlyInput('email');

    }

    public function Register(Request $request)
    {
        $request->validate([
        "nama" => "required|string|max:255",
        "email" => "required|string|email|max:255|unique:users",
        "password" => "required|string|confirmed",
      ]);

      
      User::create([
        "nama"=>$request->nama,
        "email"=>$request->email,
        "password"=>bcrypt($request->password),
        "role"=>"pengguna",
      ]);

      return redirect()->route('login.view')->with('success','Register Success, Please Login');
    }

    public function Logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect("/");
    }
}
