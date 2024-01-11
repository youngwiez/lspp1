<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
//menggunakan model barang untuk mengambil struktur tabel barang
use App\Models\Barang;
//menggunakan model kategori untuk mengambil struktur tabel kategori
use App\Models\Kategori;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // max jumlah data yang ditampilkan (10 baris),
        // dimulai dari yang paling pertama dimasukkan datanya
        $barang = Barang::oldest()->paginate(10);
        // mengambil daftar kategori untuk di kolom kategori_id
        $barang = Barang::with('kategori')->get();
        // mengarahkan ke view index.blade.php
        return view('dashboard.barang.index',compact('barang'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // mengambil data nama kategori untuk di kolom input kategori
        // pada form create barang
        $kategori_id = Kategori::all();
        // mengarahkan ke view create.blade.php 
        return view('dashboard.barang.create',compact('kategori_id'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // memastikan data yang diinput sesuai dengan kolom & tipe datanya
        $validator = Validator::make($request->all(), [
            'merk'          => 'required|string|max:50',
            'seri'          => 'nullable|string|max:50',
            'spesifikasi'   => 'nullable|string',
            'stok'          => 'nullable|integer',
            'kategori_id'   => 'required|exists:kategori,id',
        ]);

        // apabila validator tersebut ada yang salah,
        // maka tidak berhasil menyimpan data barang baru
        if ($validator->fails()) {
            return redirect()->route('barang.create')
                ->withErrors($validator)
                ->withInput();
        }

        // apabila validator sesuai, maka data akan tersimpan di tabel barang
        Barang::create([
            'merk'          => $request->merk,
            'seri'          => $request->seri,
            'spesifikasi'   => $request->spesifikasi,
            'stok'          => $request->stok,
            'kategori_id'   => $request->kategori_id,
        ]);

        // mengarahkan ke class controller index, lalu memunculkan alert sukses
        return redirect()->route('barang.index')->with(['success' => 'Data Barang Berhasil Disimpan!']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // variabel untuk mendapatkan ID barang yang akan di-show
        $rsetBarang = Barang::find($id);
        // mengarahkan ke view show.blade.php dengan data dari $rsetBarang
        return view('dashboard.barang.show', compact('rsetBarang'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // variabel untuk mendapatkan ID barang yang akan diedit
        $rsetBarang = Barang::find($id);
        // mengambil data nama kategori untuk di kolom input kategori
        // pada form edit barang
        $kategori_id = Kategori::all();
        // mengarahkan ke view edit.blade.php 
        // sesuai data dari variabel $rsetBarang dan $kategori_id
        return view('dashboard.barang.edit', compact('rsetBarang','kategori_id'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // memastikan data yang diinput sesuai dengan kolom & tipe datanya
        $validator = Validator::make($request->all(), [
            'merk'          => 'required|string|max:50',
            'seri'          => 'nullable|string|max:50',
            'spesifikasi'   => 'nullable|string',
            'stok'          => 'nullable|integer',
            'kategori_id'   => 'required|exists:kategori,id',
        ]);

        // apabila validator tersebut ada yang salah,
        // maka tidak berhasil menyimpan data barang baru
        if ($validator->fails()) {
            return redirect()->route('barang.edit', $id)
                ->withErrors($validator)
                ->withInput();
        }

        // variabel untuk mendapatkan ID barang yang akan diedit
        $rsetBarang = Barang::find($id);
        // mengupdate data barang sesuai ID barang yang dipilih
        $rsetBarang->update([
            'merk'          => $request->merk,
            'seri'          => $request->seri,
            'spesifikasi'   => $request->spesifikasi,
            'stok'          => $request->stok,
            'kategori_id'   => $request->kategori_id,
        ]);

        // mengarahkan ke class controller index, lalu memunculkan alert sukses
        return redirect()->route('barang.index')->with(['success' => 'Data Barang Berhasil Diubah!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // apabila data pada tabel barang digunakan juga di tabel-tabel lainnya,
        // maka data barang tidak bisa dihapus, dan mengeluarkan alert gagal
        if (DB::table('barangmasuk')->where('barang_id', $id)->exists() || DB::table('barangkeluar')
            ->where('barang_id', $id)->exists()){
            return redirect()->route('barang.index')->with(['Gagal' => 'Data Gagal Dihapus!']);
        } 
        
        // namun bila data barang tidak digunakan di tabel lainnya,
        // maka data barang bisa dihapus, dan mengeluarkan alert sukses
        else {
            $rsetKategori = Barang::find($id);
            $rsetKategori->delete();
            return redirect()->route('barang.index')->with(['success' => 'Data Berhasil Dihapus!']);
        }
    }
}