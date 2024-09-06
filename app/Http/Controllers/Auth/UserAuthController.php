<?php

namespace App\Http\Controllers\Auth;
//use App\Models\Meta;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



class UserAuthController extends Controller
{
    // private function meta(){
    //     $meta = Meta::$data_meta;
    //     $meta['title'] = 'Login User';
    //     return $meta;
    // }


    public function index(){
        return view('dashboard.login',[
            //"meta" => $this->meta(),
        ]);
    }

    public function login(Request $request){
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);
        $remember = $request->has('remember');

        if(Auth::guard('user')->attempt($credentials)){
            //$status = Auth::guard('user')->user()->status;
            //if($status=="nonactive"){
                //return back()->with('error','Akun anda dinonaktifkan!');
            //}
            $request->session()->regenerate();
            return redirect()->intended('/dashboard/');
        }
        if (Auth::attempt($credentials, $remember)) {
            // Authentication passed...
            return redirect()->intended('dashboard');
        }
    
        return redirect()->back()->withErrors([
            'username' => 'The provided credentials do not match our records.',
        ]);

        // return view('admin.login',[
        //     "meta" => $this->meta(),
        // ]);

        return back()->with('error','Login failed!');
    }

    public function logout(){
        if(Auth::guard('user')->check()){
            Auth::guard('user')->logout();
        }
        return redirect('/login');
    }
}
