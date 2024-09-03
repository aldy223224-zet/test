<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use App\Models\Production;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardProduction extends Controller
{
    public function index(){
        $user_id = auth()->user()->id;
        return view('dashboard.production',[
            "title" => "Hasil Produksi",
            "productions" => Production::where('user_id',$user_id)->get(),
            "profil" => Auth::guard('user')->user(),
        ]);
    }

    public function postHandler(Request $request) {
        if ($request->submit == "store") {
            $res = $this->store($request);
            return redirect()->back()->with($res['status'], $res['message']);
        } elseif ($request->submit == "update") {
            $res = $this->update($request);
            return redirect()->back()->with($res['status'], $res['message']);
        } elseif ($request->submit == "destroy") {
            $res = $this->destroy($request);
            return redirect()->back()->with($res['status'], $res['message']);
            // return redirect()->back()->with("info","Fitur hapus sementara dinonaktifkan");
        } else {
            return redirect()->back()->with("info", "Submit not found");
        }
    }

    public function store(Request $request){
        $validatedData = $request->validate([
            'production_date' => 'required',
            'production_result' => 'required|numeric',
            'shift' => 'required|numeric',
        ]);

        $validatedData['user_id'] = auth()->user()->id;
        $validatedData['status'] = 0;
        $validatedData['note'] = "";

        // Create new production
        Production::create($validatedData);
        return ['status'=>'success','message'=>'Hasil produksi berhasil ditambahkan'];
    }
    
}
