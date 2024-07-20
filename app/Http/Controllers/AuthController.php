<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function proses_login(Request $request)
    {
        request()->validate(
            [
                'email' => 'required|exists:users',
                'password' => 'required',
            ],[
                'email.required' => 'Email harus diisi',
                'email.exists' => 'Email belum didaftarkan',
                'password.required' => 'Password harus diisi',
            ]);

        $otentifikasi = $request->only('email','password');

            if (Auth::attempt($otentifikasi)) {
                $user = Auth::user();
                    return redirect()->route('data_pegawai');
                }
                return redirect('/')->with('eror','Masukkan email dan password yang benar')->withInput();
    }
    
    public function logout(Request $request)
    {
        $request->session()->flush();
        Auth::logout();
        return Redirect('/');
    }
}
