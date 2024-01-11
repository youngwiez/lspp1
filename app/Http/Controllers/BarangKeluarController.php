<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\BarangKeluar;
use Illuminate\Support\Facades\Validator;

class BarangKeluarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bkeluar = BarangKeluar::oldest()->paginate(10); 
        return view('dashboard.barangkeluar.index',compact('bkeluar'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $barang = Barang::all();
        return view('dashboard.barangkeluar.create',compact('barang'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tgl_keluar' => 'required|date',
            'qty_keluar' => 'required|integer',
            'barang_id' => 'required|exists:barang,id',
        ]);

        if ($validator->fails()) {
            return redirect()->route('barangkeluar.create')
                ->withErrors($validator)
                ->withInput();
        }

        //create post
        BarangKeluar::create([
            'tgl_keluar'  => $request->tgl_keluar,
            'qty_keluar'  => $request->qty_keluar,
            'barang_id'  => $request->barang_id
        ]);

        //redirect to index
        return redirect()->route('barangkeluar.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $rsetBkeluar = BarangKeluar::find($id);
        //return view
        return view('dashboard.barangkeluar.show', compact('rsetBkeluar'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $rsetBkeluar = BarangKeluar::find($id);
        $barang = Barang::all();
        return view('dashboard.barangkeluar.edit', compact('rsetBkeluar','barang'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'tgl_keluar'  => 'required',
            'qty_keluar'  => 'required',
            'barang_id'   => 'required'
        ]);

        $rsetBkeluar = BarangKeluar::find($id);

        $rsetBkeluar->update([
            'tgl_keluar'  => $request->tgl_keluar,
            'qty_keluar'  => $request->qty_keluar,
            'barang_id'   => $request->barang_id
        ]);

        //redirect to index
        return redirect()->route('barangkeluar.index')->with(['success' => 'Data Barang Keluar Berhasil Diubah!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $rsetBkeluar = BarangKeluar::find($id);

        //delete post
        $rsetBkeluar->delete();

        //redirect to index
        return redirect()->route('barangkeluar.index')->with(['success' => 'Data Barang Keluar Berhasil Dihapus!']);
    }
}
