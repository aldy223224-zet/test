<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Production;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminReport extends Controller
{
    public function print() {
        
        return view('admin.print-report', [
            "title" => "Print Laporan",
            "productions" => Production::where('status', 1)->get(),
            "profil" => Auth::user(),
        ]);
    }

}
