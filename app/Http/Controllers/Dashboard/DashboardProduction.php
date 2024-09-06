<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Production;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardProduction extends Controller
{
    public function index(){
        $user_id = Auth::id(); // Use Auth::id() to get the authenticated user's ID
        return view('dashboard.production', [
            "title" => "Dashboard - Hasil Produksi",
            "productions" => Production::where('user_id', $user_id)->get(),
            "profil" => Auth::user(), // Use Auth::user() to get the authenticated user's details
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
        } else {
            return redirect()->back()->with("info", "Submit not found");
        }
    }

    public function destroy(Request $request) {
        
        $validatedData = $request->validate([
            'id'=>'required|numeric',
        ]);

        $production = Production::find($request->id);
    
        if ($production) {
            $production->delete();
            return ['status'=>'success','message'=>'Hasil produksi berhasil dihapus'];
        } else {
            return ['status'=>'error','message'=>'Data tidak ditemukan'];
        }
    }

    public function store(Request $request){
        $validatedData = $request->validate([
            'production_date' => 'required',
            'production_result' => 'required|numeric',
            'shift' => 'required|numeric',
        ]);

        $validatedData['user_id'] = Auth::id(); // Use Auth::id() to get the authenticated user's ID
        $validatedData['status'] = 0;
        $validatedData['note'] = "";

        // Create new production
        Production::create($validatedData);
        return ['status'=>'success','message'=>'Hasil produksi berhasil ditambahkan'];
    }

    public function update(Request $request){
        $validatedData = $request->validate([
            'id' => 'required|numeric',
            'production_date' => 'required',
            'production_result' => 'required|numeric',
            'shift' => 'required|numeric',
        ]);
        $validatedData['status'] = 0;

        $production = Production::find($request->id);
        
        //Check if production is found
        if($production){
            // Update production
            $production->update($validatedData);   
            return ['status'=>'success','message'=>'Hasil produksi berhasil diupdate']; 
        }else{
            return ['status'=>'error','message'=>'Data tidak ditemukan'];
        }
    }
}
