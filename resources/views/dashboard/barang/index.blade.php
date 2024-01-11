@extends('layouts.adm-main')

@section('content')
        <div class="container">
            <div class="row">
                <div class="col-lg-12 margin-tb">
                    <div class="pull-right">
                        <a class="btn btn-success" href="{{ route('barang.create') }}"> Tambah Data Barang Baru</a>
                    </div>
                </div>
            </div><br>
            <table class="table table-striped table-hover">
                <tr class="table-primary">
                    <td>ID</td>
                    <td>Merk</td>
                    <td>Seri</td>
                    <td>Spesifikasi</td>
                    <td>Stok</td>
                    <td>Kategori</td>
                    <th style="width: 15%">Aksi</th>
                </tr>
            
                @forelse ($barang as $rowbarang)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $rowbarang->merk }}</td>
                        <td>{{ $rowbarang->seri }}</td>
                        <td>{{ $rowbarang->spesifikasi }}</td>
                        <td>{{ $rowbarang->stok }}</td>
                        <td>{{ $rowbarang->kategori->deskripsi }}</td>
                        <td class="text-center"> 
                            <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('barang.destroy', $rowbarang->id) }}" method="POST">
                                <a href="{{ route('barang.show', $rowbarang->id) }}" class="btn btn-sm btn-dark"><i class="fa fa-eye"></i></a>
                                <a href="{{ route('barang.edit', $rowbarang->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-pencil-alt"></i></a>
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <div class="alert">Data kategori belum tersedia</div>
                @endforelse
            </table>
            {{-- {{ $barang->links() }} --}}
        </div>
@endsection