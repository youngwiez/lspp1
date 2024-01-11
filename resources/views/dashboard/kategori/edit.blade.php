@extends('layouts.adm-main')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('kategori.update',$rsetKategori->id) }}" method="POST" enctype="multipart/form-data">                    
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label class="font-weight-bold">Deskripsi</label>
                                <input type="text" class="form-control @error('deskripsi') is-invalid @enderror" name="deskripsi" value="{{ old('deskripsi',$rsetKategori->deskripsi) }}" placeholder="Masukkan Deskripsi Kategori">
                                <!-- error message untuk merk -->
                                @error('merk')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">Kategori</label>
                                    <div class="form-check">
                                    <input class="form-check-input" type="radio" name="kategori" id="kategori" value="M" {{ $rsetKategori->kategori == 'M' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="kategori">
                                        M - Modal
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="kategori" id="kategori" value="A" {{ $rsetKategori->kategori == 'A' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="kategori">
                                        A - Alat
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="kategori" id="kategori" value="BHP" {{ $rsetKategori->kategori == 'BHP' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="kategori">
                                        BHP - Bahan Habis Pakai
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="kategori" id="kategori" value="BTHP" {{ $rsetKategori->kategori == 'BTHP' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="kategori">
                                        BTHP - Bahan Tidak Habis Pakai
                                    </label>
                                </div>
                                @error('kategori')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>                  

                            <button type="submit" class="btn btn-md btn-primary">SIMPAN</button>
                            <button type="reset" class="btn btn-md btn-warning">RESET</button>
                        </form> 
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection