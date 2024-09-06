<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
//use App\Models\Meta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminHome extends Controller
{
    // private function meta(){
    //     $meta = Meta::$data_meta;
    //     $meta['title'] = 'Dashboard | Home';
    //     return $meta;
    // }

    public function index(){
        return view('admin.home',[
            //"meta" => $this->meta(),
            "title" => "Admin - Home",
            "profil" => Auth::guard('admin')->user(),
        ]);
    }
}
