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
            "title" => "Hasil Produksi",
            "productions" => Production::where('user_id', $user_id)->get(),
            "profil" => Auth::user(), // Use Auth::user() to get the authenticated user's details
        ]);
    }

    public function postHandler(Request $request) {
        if ($request->submit == "store") {
            $res = $this->store($request);
            return redirect()->back()->with($res['status'], $res['message']);
        } elseif ($request->submit == "update") {
            $res = $this->update($request, $request->id);
            return redirect()->back()->with($res['status'], $res['message']);
        } elseif ($request->submit == "destroy") {
            $res = $this->destroy($request);
            return redirect()->back()->with($res['status'], $res['message']);
        } else {
            return redirect()->back()->with("info", "Submit not found");
        }
    }

    public function destroy(Request $request) {
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

    // Update method
    public function update(Request $request, $id) {
        $production = Production::find($id);
        if ($production) {
            $production->production_date = $request->production_date;
            $production->shift = $request->shift;
            $production->production_result = $request->production_result;
        
            $production->save();
        
            return ['status'=>'success','message'=>'Hasil produksi berhasil diupdate'];
        } else {
            return ['status'=>'error','message'=>'Data tidak ditemukan'];
        }
    }
}
