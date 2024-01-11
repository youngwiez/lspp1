@extends('layouts.adm-main')

@section('content')
        <div class="container">
            <div class="row">
                <div class="col-lg-12 margin-tb">
                    <div class="pull-right">
                        <a class="btn btn-success" href="{{ route('barangkeluar.create') }}"> Tambah Data Barang Keluar</a>
                    </div>
                </div>
            </div><br>
            <table class="table table-striped table-hover">
                <tr class="table-primary">
                    <td>ID</td>
                    <td>Tanggal Keluar</td>
                    <td>QTY</td>
                    <td>Barang</td>
                    <td>Seri</td>
                    <th style="width: 15%">Aksi</th>
                </tr>
            
                @forelse ($bkeluar as $rowbkeluar)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $rowbkeluar->tgl_keluar }}</td>
                        <td>{{ $rowbkeluar->qty_keluar }}</td>
                        <td>{{ $rowbkeluar->barang->merk }}</td>
                        <td>{{ $rowbkeluar->barang->seri }}</td>
                        <td class="text-center"> 
                            <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('barangkeluar.destroy', $rowbkeluar->id) }}" method="POST">
                                <a href="{{ route('barangkeluar.show', $rowbkeluar->id) }}" class="btn btn-sm btn-dark"><i class="fa fa-eye"></i></a>
                                <a href="{{ route('barangkeluar.edit', $rowbkeluar->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-pencil-alt"></i></a>
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <div class="alert">Data Barang Keluar belum tersedia</div>
                @endforelse
            </table>
            {!! $bkeluar->links() !!}
        </div>
@endsection