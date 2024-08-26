<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    // Redirect users based on their role
    protected function authenticated(Request $request, $user)
    {
        if ($user->user_type === 'admin') {
            return redirect()->route('admin.dashboard');
        } elseif ($user->user_type === 'user') {
            return redirect()->route('user.dashboard');
        }

        return redirect('/home'); // Default redirection
    }

    // Customizing the login credentials to use 'username' instead of 'email'
    protected function credentials(Request $request)
    {
        return [
            'username' => $request->get('username'),
            'password' => $request->get('password'),
        ];
    }

    // Custom logout function to redirect to the login page
    public function logout(Request $request)
    {
        $this->guard()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }

    // Override the method to set the login view path if necessary
    public function showLoginForm()
    {
        return view('auth.login'); // Ensure this matches the path to your login view
    }
}
