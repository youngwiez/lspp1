@extends('layouts.adm-main')

@section('content')
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('barangkeluar.store') }}" method="POST" enctype="multipart/form-data">                    
                                @csrf
                                <div class="form-group">
                                    <label class="font-weight-bold">Tanggal keluar</label>
                                    <input type="date" class="form-control @error('tgl_keluar') is-invalid @enderror" name="tgl_keluar" value="{{ old('tgl_keluar') }}" placeholder="Masukkan Tanggal Keluar Barang">
                                    <!-- error message untuk tgl_keluar -->
                                    @error('tgl_keluar')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="font-weight-bold">QTY</label>
                                    <input type="number" class="form-control @error('qty_keluar') is-invalid @enderror" name="qty_keluar" value="{{ old('qty_keluar') }}" placeholder="Masukkan Jumlah Barang Keluar">
                                    <!-- error message untuk qty_keluar -->
                                    @error('qty_keluar')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="font-weight-bold">Barang</label>
                                    <select class="form-control @error('barang_id') is-invalid @enderror" name="barang_id">
                                        <option value="">Pilih Barang</option>
                                        @foreach($barang as $rowbarang)
                                            <option value="{{ $rowbarang->id }}" {{ old('barang_id') == $rowbarang->id ? 'selected' : '' }}>{{ $rowbarang->merk . ' ' . $rowbarang->seri }}</option>
                                        @endforeach
                                    </select>
                                    <!-- error message untuk barang_id -->
                                    @error('barang_id')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-md btn-primary">Simpan</button>
                                <button type="reset" class="btn btn-md btn-warning">Reset</button>
                            </form> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endsection