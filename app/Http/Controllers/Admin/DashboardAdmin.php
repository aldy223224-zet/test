<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Production;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardAdmin extends Controller
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
            $res = $this->verify($request, $request->id);
            return redirect()->back()->with($res['status'], $res['message']);
        } elseif ($request->submit == "store") {
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

    public function verify(Request $request, $id) {
        $production = Production::find($id);

        if ($production) {
            // Update the verification status
            $production->status = $request->status;
            $production->note = $request->note ?? '';  // Optional note

            $production->save();

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

    public function store(Request $request) {
        $validatedData = $request->validate([
            'production_date' => 'required',
            'production_result' => 'required|numeric',
            'shift' => 'required|numeric',
        ]);

        $validatedData['user_id'] = Auth::id();
        $validatedData['status'] = 0;  // Default status: waiting for verification
        $validatedData['note'] = "";

        // Create new production
        Production::create($validatedData);
        return ['status' => 'success', 'message' => 'Hasil produksi berhasil ditambahkan'];
    }

    public function update(Request $request, $id) {
        $production = Production::find($id);
        if ($production) {
            $production->production_date = $request->production_date;
            $production->shift = $request->shift;
            $production->production_result = $request->production_result;

            $production->save();

            return ['status' => 'success', 'message' => 'Hasil produksi berhasil diupdate'];
        } else {
            return ['status' => 'error', 'message' => 'Data tidak ditemukan'];
        }
    }
}
