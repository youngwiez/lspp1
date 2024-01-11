<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
//menggunakan model kategori untuk mengambil struktur tabel kategori
use App\Models\Kategori;
use Illuminate\Support\Facades\Storage;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // max jumlah data yang ditampilkan (10 baris),
        // dimulai dari yang paling pertama dimasukkan datanya
        $kategori = Kategori::oldest()->paginate(10);
        // mengarahkan ke view index.blade.php
        return view('dashboard.kategori.index',compact('kategori'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // mengarahkan ke view create.blade.php
        return view('dashboard.kategori.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // memastikan data yang diinput sesuai dengan kolom & tipe datanya
        $this->validate($request, [
            'deskripsi'  => 'required',
            'kategori'   => 'required'
        ]);

        // apabila data sesuai, maka data akan tersimpan di tabel kategori
        Kategori::create([
            'deskripsi'  => $request->deskripsi,
            'kategori'   => $request->kategori
        ]);

        //mengarahkan ke class controller index, lalu memunculkan alert sukses
        return redirect()->route('kategori.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(string $id)
    {
        // variabel untuk mendapatkan ID kategori yang akan di-show
        $rsetKategori = Kategori::find($id);
        //return view ke show.blade.php
        return view('dashboard.kategori.show', compact('rsetKategori'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(string $id)
    {
        // variabel untuk mendapatkan ID kategori yang akan diedit
        $rsetKategori = Kategori::find($id);
        //return view ke edit.blade.php
        return view('dashboard.kategori.edit', compact('rsetKategori'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, string $id)
    {
        // memastikan data yang diinput sesuai dengan kolom & tipe datanya
        $this->validate($request, [
            'deskripsi'  => 'required',
            'kategori'   => 'required|in:M,A,BHP,BTHP'
        ]);
        // variabel untuk mendapatkan ID kategori yang akan diupdate
        $rsetKategori = Kategori::find($id);
        // mengupdate data kategori sesuai ID kategori yang dipilih
        $rsetKategori->update([
            'deskripsi'    => $request->deskripsi,
            'kategori'     => $request->kategori
        ]);
        //mengarahkan ke class controller index, lalu memunculkan alert sukses
        return redirect()->route('kategori.index')->with(['success' => 'Data Kategori Berhasil Diubah!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(string $id)
    {
        // apabila data pada tabel kategori digunakan juga di tabel-tabel lainnya,
        // maka data kategori tidak bisa dihapus, dan mengeluarkan alert gagal
        if (DB::table('barang')->where('kategori_id', $id)->exists()){
            return redirect()->route('kategori.index')->with(['Gagal' => 'Data Gagal Dihapus!']);
        } 
        // namun bila data kategori tidak digunakan di tabel lainnya,
        // maka data kategori bisa dihapus, dan mengeluarkan alert sukses
        else {
            $rsetKategori = Kategori::find($id);
            $rsetKategori->delete();
            return redirect()->route('kategori.index')->with(['success' => 'Data Berhasil Dihapus!']);
        }
    }
}
