<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//menggunakan model barang untuk mengambil struktur tabel barang
use App\Models\Barang;
//menggunakan model barang untuk mengambil struktur tabel barangmasuk
use App\Models\BarangMasuk;
use Illuminate\Support\Facades\Validator;

class BarangMasukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // max jumlah data yang ditampilkan (10 baris),
        // dimulai dari yang paling pertama dimasukkan datanya
        $bmasuk = BarangMasuk::oldest()->paginate(10);
        // mengarahkan ke view index.blade.php
        return view('dashboard.barangmasuk.index',compact('bmasuk'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // mengambil data nama kategori untuk di kolom input kategori
        // pada form create barang
        $barang = Barang::all();
        // mengarahkan ke view create.blade.php
        return view('dashboard.barangmasuk.create',compact('barang'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // memastikan data yang diinput sesuai dengan kolom & tipe datanya
        $validator = Validator::make($request->all(), [
            'tgl_masuk' => 'required|date',
            'qty_masuk' => 'required|integer',
            'barang_id' => 'required|exists:barang,id',
        ]);
        // apabila validator tersebut ada yang salah,
        // maka tidak berhasil menyimpan data barang baru
        if ($validator->fails()) {
            return redirect()->route('barangmasuk.create')
                ->withErrors($validator)
                ->withInput();
        }
        // apabila validator sesuai, maka data akan tersimpan di tabel barangmasuk
        BarangMasuk::create([
            'tgl_masuk'  => $request->tgl_masuk,
            'qty_masuk'  => $request->qty_masuk,
            'barang_id'  => $request->barang_id
        ]);
        // mengarahkan ke class controller index, lalu memunculkan alert sukses
        return redirect()->route('barangmasuk.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // variabel untuk mendapatkan ID barangmasuk yang akan di-show
        $rsetBmasuk = BarangMasuk::find($id);
        // mengarahkan ke view show.blade.php dengan data dari $rsetBmasuk
        return view('dashboard.barangmasuk.show', compact('rsetBmasuk'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // variabel untuk mendapatkan ID barangmasuk yang akan di-show
        $rsetBmasuk = BarangMasuk::find($id);
        // mengambil data nama kategori untuk di kolom input barang_id
        // pada form edit barangmasuk
        $barang = Barang::all();
        // mengarahkan ke view edit.blade.php 
        // sesuai data dari variabel $rsetBmasuk dan $kategori_id
        return view('dashboard.barangmasuk.edit', compact('rsetBmasuk','barang'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // memastikan data yang diinput sesuai dengan kolom & tipe datanya
        $this->validate($request, [
            'tgl_masuk'  => 'required',
            'qty_masuk'  => 'required',
            'barang_id'   => 'required'
        ]);
        // variabel untuk mendapatkan ID barangmasuk yang akan diupdate
        $rsetBmasuk = BarangMasuk::find($id);
        // mengupdate data barang masuk sesuai ID barangmasuk yang dipilih
        $rsetBmasuk->update([
            'tgl_masuk'  => $request->tgl_masuk,
            'qty_masuk'  => $request->qty_masuk,
            'barang_id'   => $request->barang_id
        ]);
        //mengarahkan ke class controller index, lalu memunculkan alert sukses
        return redirect()->route('barangmasuk.index')->with(['success' => 'Data Barang Masuk Berhasil Diubah!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // variabel untuk mendapatkan ID barangmasuk yang akan dihapus
        $rsetBmasuk = BarangMasuk::find($id);
        $rsetBmasuk->delete();
        //mengarahkan ke class controller index, lalu memunculkan alert sukses
        return redirect()->route('barangmasuk.index')->with(['success' => 'Data Barang Masuk Berhasil Dihapus!']);
    }
}
