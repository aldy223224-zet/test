<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class UserAuthController extends Controller
{
    public function index(){
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
            // Regenerasi session untuk mencegah session fixation attacks
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
        // Hapus session
        request()->session()->invalidate();
        // Regenerasi session ID
        request()->session()->regenerateToken();
        return redirect('/login');
    }
}
