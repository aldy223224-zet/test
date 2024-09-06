<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
//use App\Models\Meta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardHome extends Controller
{
    // private function meta(){
    //     $meta = Meta::$data_meta;
    //     $meta['title'] = 'Dashboard | Home';
    //     return $meta;
    // }

    public function index(){
        return view('dashboard.home',[
            "title" => "Dashboard - Home",
            "profil" => Auth::guard('user')->user(),
        ]);
    }
}
