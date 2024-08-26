<?php

namespace App\Http\Controllers\Auth;
use App\Models\Meta;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentAuthController extends Controller
{
    private function meta(){
        $meta = Meta::$data_meta;
        $meta['title'] = 'Login';
        return $meta;
    }

    public function index(){
        return view('dashboard.login',[
            "meta" => $this->meta(),
        ]);
    }

    public function login(Request $request){
        $credentials = $request->validate([
            'nim' => 'required|numeric',
            'password' => 'required',
        ]);
        
        if(Auth::guard('student')->attempt($credentials)){
            $request->session()->regenerate();
            return redirect()->intended('dashboard');
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
        if(Auth::guard('student')->check()){
            Auth::guard('student')->logout();
        }
        return redirect('/dashboard/login');
    }
}
