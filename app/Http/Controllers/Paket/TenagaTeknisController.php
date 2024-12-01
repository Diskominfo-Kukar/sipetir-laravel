<?php

namespace App\Http\Controllers\Paket;

use App\Http\Controllers\Controller;
use App\Models\Paket\TenagaTeknis;
use Illuminate\Http\Request;

class TenagaTeknisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $paketId = $request->input('pktId');
        $nama    = $request->input('tt');

        $tt = TenagaTeknis::create([
            'paket_id' => $paketId,
            'nama'     => $nama,
        ]);

        session()->flash('success', 'Berhasil menambahkan tim teknis untuk paket ini');

        return response()->json([
            'success' => true,
            //'message' => 'Berhasil menambahkan tim teknis untuk paket ini.',
            'tt' => $tt,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $tenagaTeknis = TenagaTeknis::findOrFail($id);
        $tenagaTeknis->delete();

        //return redirect()->back()->with('success', 'Berhasil menghapus tim teknis');
        return redirect()->back();
        //return response()->json(['success' => true]);
    }

    public function addTenagaTeknis(Request $request)
    {
    }

    public function deleteTenagaTeknis($id)
    {
    }
}
