<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Production;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminProduction extends Controller
{
    public function index() {
        // Fetch all production data with related user details
        $productions = Production::with('user')->get();

        return view('admin.adminproduction', [
            "title" => "Hasil Produksi",
            "productions" => $productions,  // Passing all production data to the view
            "profil" => Auth::user(),
        ]);
    }

    public function postHandler(Request $request) {
        if ($request->submit == "verify") {
            $res = $this->verify($request);
            return redirect()->back()->with($res['status'], $res['message']);
        }elseif ($request->submit == "store") {
            $res = $this->store($request);
            return redirect()->back()->with($res['status'], $res['message']);
        } elseif ($request->submit == "update") {
            $res = $this->update($request, $request->id);
            return redirect()->back()->with($res['status'], $res['message']);
        } elseif ($request->submit == "destroy") {
            $res = $this->destroy($request);
            return redirect()->back()->with($res['status'], $res['message']);
        } else {
            return redirect()->back()->with("info", "Submit action not found");
        }
    }

    public function verify(Request $request) {
        $validatedData = $request->validate([
            'id' => 'required|numeric',
            'status' => 'required|numeric',
        ]);
        $validatedData['note'] = $request->note ?? '';
        
        $production = Production::find($request->id);

        if ($production) {
            // Update the verification status
            $production->update($validatedData); 

            return ['status' => 'success', 'message' => 'Hasil produksi berhasil diverifikasi'];
        } else {
            return ['status' => 'error', 'message' => 'Data tidak ditemukan'];
        }
    }

    public function destroy(Request $request) {
        $production = Production::find($request->id);

        if ($production) {
            $production->delete();
            return ['status' => 'success', 'message' => 'Hasil produksi berhasil dihapus'];
        } else {
            return ['status' => 'error', 'message' => 'Data tidak ditemukan'];
        }
    }

}
