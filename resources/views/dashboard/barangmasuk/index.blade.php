@extends('layouts.adm-main')

@section('content')
        <div class="container">
            <div class="row">
                <div class="col-lg-12 margin-tb">
                    <div class="pull-right">
                        <a class="btn btn-success" href="{{ route('barangmasuk.create') }}"> Tambah Data Barang Masuk</a>
                    </div>
                </div>
            </div><br>
            <table class="table table-striped table-hover">
                <tr class="table-primary">
                    <td>ID</td>
                    <td>Tanggal Masuk</td>
                    <td>QTY</td>
                    <td>Barang</td>
                    <td>Seri</td>
                    <th style="width: 15%">Aksi</th>
                </tr>
            
                @forelse ($bmasuk as $rowbmasuk)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $rowbmasuk->tgl_masuk }}</td>
                        <td>{{ $rowbmasuk->qty_masuk }}</td>
                        <td>{{ $rowbmasuk->barang->merk }}</td>
                        <td>{{ $rowbmasuk->barang->seri }}</td>
                        <td class="text-center"> 
                            <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('barangmasuk.destroy', $rowbmasuk->id) }}" method="POST">
                                <a href="{{ route('barangmasuk.show', $rowbmasuk->id) }}" class="btn btn-sm btn-dark"><i class="fa fa-eye"></i></a>
                                <a href="{{ route('barangmasuk.edit', $rowbmasuk->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-pencil-alt"></i></a>
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <div class="alert">Data Barang Masuk belum tersedia</div>
                @endforelse
            </table>
            {!! $bmasuk->links() !!}
        </div>
@endsection