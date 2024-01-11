@extends('layouts.adm-main')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
               <div class="card border-0 shadow rounded">
                    <div class="card-body">
                        <table class="table">
                            <tr>
                                <td>Merk</td>
                                <td>{{ $rsetBarang->merk }}</td>
                            </tr>
                            <tr>
                                <td>Seri</td>
                                <td>{{ $rsetBarang->seri }}</td>
                            </tr>
                            <tr>
                                <td>Spesifikasi</td>
                                <td>{{ $rsetBarang->spesifikasi }}</td>
                            </tr>
                            <tr>
                                <td>Stok</td>
                                <td>{{ $rsetBarang->stok }}</td>
                            </tr>
                            <tr>
                                <td>Kategori</td>
                                <td>{{ $rsetBarang->kategori_id }}</td>
                            </tr>
                        </table>
                    </div>
               </div>
            </div>

            <!-- <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <img src="{{ asset('storage/foto/'.$rsetBarang->foto) }}" class="w-100 rounded">
                    </div>
                </div>
            </div> -->

        </div>
        <br>
        <div class="row">
            <div class="col-md-12  text-center">
                <a href="{{ route('barang.index') }}" class="btn btn-md btn-primary mb-3">Back</a>
            </div>
        </div>
    </div>
@endsection