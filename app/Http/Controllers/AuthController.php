<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    // Tampilkan halaman login
    public function showLogin()
    {
        return view('login');
    }

    // Proses login
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        // Cari user dengan username & password langsung (plaintext)
        $user = User::where('username', $request->username)
                    ->where('password', $request->password)
                    ->first();

        if ($user) {
            Session::put('user', $user->id);
            return redirect('/admin')->with('success', 'Login berhasil!');
        }

        return back()->withErrors([
            'username' => 'Username atau password salah.'
        ])->withInput();
    }

    // Halaman dashboard admin
    public function dashboard()
    {
        if (!Session::has('user')) {
            return redirect('/login');
        }

        return view('admin'); // pastikan ada file resources/views/admin.blade.php
    }

    // Logout                                               
    public function logout()
    {
        Session::forget('user');
        return redirect('/login')->with('success', 'Berhasil logout');
    }
}