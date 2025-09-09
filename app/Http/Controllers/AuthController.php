<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Tampilkan halaman login
    public function showLogin()
    {
        return view('login'); // pastikan file ada di resources/views/auth/login.blade.php
    }

    // Proses login
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        // Cari user berdasarkan username
        $user = User::where('username', $request->username)->first();

        // Cek password pakai hash
        if ($user && Hash::check($request->password, $user->password)) {
            // Simpan ke session
            Session::put('user_id', $user->id);
            Session::put('username', $user->username);
            Session::put('role', $user->role);

            // Redirect sesuai role
            if ($user->role === 'admin') {
                return redirect()->route('chart.admin')->with('success', 'Login berhasil sebagai Admin!');
            } else {
                return redirect()->route('chart.user')->with('success', 'Login berhasil sebagai User!');
            }
        }

        return back()->withErrors([
            'username' => 'Username atau password salah.'
        ])->withInput();
    }

    // Dashboard Admin
    public function adminDashboard(Request $request)
    {
        if (!Session::has('user_id') || Session::get('role') !== 'admin') {
            return redirect('/login')->with('error', 'Silakan login kembali!');
        }

        // Set header no-cache agar tidak bisa kembali setelah logout
        $this->noCache($request);

        return view('admin');
    }

    // Dashboard User
    public function userDashboard(Request $request)
    {
        if (!Session::has('user_id') || Session::get('role') !== 'user') {
            return redirect('/login')->with('error', 'Silakan login kembali!');
        }

        $this->noCache($request);

        return view('welcome');
    }

    // 🔹 Chart untuk User
    public function chartUser(Request $request)
    {
        if (!Session::has('user_id') || Session::get('role') !== 'user') {
            return redirect('/login')->with('error', 'Silakan login kembali!');
        }

        $this->noCache($request);

        return view('chartuser');
    }

    // 🔹 Chart untuk Admin
    public function chartAdmin(Request $request)
    {
        if (!Session::has('user_id') || Session::get('role') !== 'admin') {
            return redirect('/login')->with('error', 'Silakan login kembali!');
        }

        $this->noCache($request);

        return view('chartadmin');
    }

    // Logout
    public function logout()
    {
        Session::flush(); 
        return redirect('/login')->with('success', 'Berhasil logout');
    }

    // Fungsi untuk set no-cache
    private function noCache(Request $request)
    {
        $request->headers->set('Cache-Control','no-cache, no-store, must-revalidate');
        $request->headers->set('Pragma','no-cache');
        $request->headers->set('Expires','0');
    }
}