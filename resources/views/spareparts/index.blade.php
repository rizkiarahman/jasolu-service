@extends('layouts.app')

@section('content')

<h1 class="mb-4">Daftar Sparepart</h1>
<a href="{{ route('spareparts.create') }}" class="btn btn-primary btn-sm mb-1">
    Tambah Data
</a>
<div class="row mb-1">
    <div class="col-md-4">
        <form method="GET" action="{{ route('spareparts.index') }}" class="mb-3">
            <div class="input-group">
                <input
                    type="text"
                    name="keyword"
                    class="form-control"
                    placeholder="Cari Kode atau Nama Sparepart..."
                    value="{{ request('keyword') }}">

                <button class="btn btn-success" type="submit">
                    Cari
                </button>
            </div>
        </form>
    </div>
</div>

<table class="table table-striped table-bordered">

    <thead class="table-dark">
        <tr>
            <th>Kode</th>
            <th>Nama</th>
            <th>Stok</th>
            <th>Harga Jual</th>
            <th width="170">Aksi</th>
        </tr>

    </thead>

    <tbody>
        @foreach($spareparts as $item)
        <tr>
            <td>{{ $item->code }}</td>
            <td>{{ $item->name }}</td>
            <td>{{ $item->stock }}</td>
            <td>{{ number_format($item->selling_price) }}</td>
            <td>

                <div class="d-flex gap-2">

                    <!-- Tombol Edit -->
                    <a href="{{ route('spareparts.edit', $item) }}"
                        class="btn btn-warning btn-sm text-white">
                        Edit
                    </a>

                    <!-- Tombol Hapus -->
                    <form action="{{ route('spareparts.destroy', $item) }}" method="POST"
                        onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn btn-danger btn-sm">
                            Hapus
                        </button>
                    </form>

                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<div class="mt-4">
    {{ $spareparts->links() }}
</div>
@endsection