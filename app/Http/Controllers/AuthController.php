<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index(){
        return view ('login');
    }
    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ],
        [
            'username.required' => 'Username wajib diisi',
            'password.required' => 'Password wajib diisi',
        ]);
        $infologin = [
            'username'=>$request->username,
            'password'=>$request->password,
        ];
        // Cek apakah kredensial valid
        if (Auth::attempt($infologin)) {
            // Jika berhasil login, arahkan ke dashboard
            return redirect('dashboard');
        }else{
            return redirect('')->withErrors('Username dan Password yang dimasukkan tidak sesuai')->withInput();
        }
    }
    public function logout(){
        Auth::logout();
        return redirect('');
    }
}


