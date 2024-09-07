<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class UserAuthController extends Controller
{
    public function index() {
        return view('dashboard.login');
    }

    public function login(Request $request) {
        // Validasi input
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        // Periksa apakah "remember me" dicentang
        $remember = $request->has('remember');

        // Coba login dengan kredensial dan opsi remember
        if (Auth::guard('user')->attempt($credentials, $remember)) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard/');
        }

        // Jika login gagal, kembali dengan error
        return redirect()->back()->withErrors([
            'username' => 'The provided credentials do not match our records.',
        ])->onlyInput('username'); // Tetap tampilkan input yang sudah dimasukkan
    }

    public function logout() {
        // Logout user
        Auth::guard('user')->logout();
        return redirect('/login');
    }
}
