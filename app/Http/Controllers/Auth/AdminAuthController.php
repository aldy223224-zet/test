<?php

namespace App\Http\Controllers\Auth;
// use App\Models\Meta;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    // private function meta(){
    //     $meta = Meta::$data_meta;
    //     $meta['title'] = 'Login';
    //     return $meta;
    // }

    public function index(){
        return view('admin.login',[
            //"meta" => $this->meta(),
            "title" => "Admin Login"
        ]);
    }

    public function login(Request $request){
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);
        
        if(Auth::guard('admin')->attempt($credentials)){
            $request->session()->regenerate();
            return redirect()->intended('admin');
        }

        //$student = Student::where('nim', '=', $request->nim)->first();
        // if($student){
        //     if(Auth::guard('student')->loginUsingId($student->id)){
        //         return redirect()->intended('dashboard');
        //     }
        // }

        return back()->with('error','Login failed!');
    }

    public function logout(){
        if(Auth::guard('admin')->check()){
            Auth::guard('admin')->logout();
        }
        return redirect('/admin/login');
    }
}
