@extends('layouts.adm-main')

@section('content')
        <div class="container">
            <div class="row">
                <div class="col-lg-12 margin-tb">
                    <div class="pull-right">
                        <a class="btn btn-success" href="{{ route('kategori.create') }}"> Tambah Data Kategori Baru</a>
                    </div>
                </div>
            </div><br>
            <table class="table table-striped table-hover">
                <tr class="table-primary text-center">
                    <td>ID</td>
                    <td>Deskripsi</td>
                    <td>Kategori</td>
                    <th style="width: 15%">Aksi</th>
                </tr>
            
                @foreach ($kategori as $rowkategori)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $rowkategori->deskripsi }}</td>
                        <td>{{ $rowkategori->kategori }}</td>
                        <td class="text-center"> 
                            <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('kategori.destroy', $rowkategori->id) }}" method="POST">
                                <a href="{{ route('kategori.show', $rowkategori->id) }}" class="btn btn-sm btn-dark"><i class="fa fa-eye"></i></a>
                                <a href="{{ route('kategori.edit', $rowkategori->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-pencil-alt"></i></a>
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </table>
            {!! $kategori->links() !!}
        </div>
@endsection