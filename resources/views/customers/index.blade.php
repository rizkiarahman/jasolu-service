@extends('layouts.app')

@section('content')

<h1 class="mb-4">Daftar Customer</h1>
<a href="{{ route('customers.create') }}" class="btn btn-primary btn-sm mb-1">
    Tambah Data
</a>
<div class="row mb-1">
    <div class="col-md-4">
        <form method="GET" action="{{ route('customers.index') }}" class="mb-3">
            <div class="input-group">
                <input
                    type="text"
                    name="keyword"
                    class="form-control"
                    placeholder="Cari Nama Customers..."
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
            <th width="60">No</th>
            <th>Nama</th>
            <th>No. HP</th>
            <th>Alamat</th>
            <th width="170">Aksi</th>
        </tr>
    </thead>

    <tbody>

        @forelse($customers as $customer)

        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $customer->name }}</td>
            <td>{{ $customer->phone }}</td>
            <td>{{ $customer->address }}</td>
            <td>

                <div class="d-flex gap-2">

                    {{-- Tombol Edit --}}
                    <a href="{{ route('customers.edit', $customer) }}"
                        class="btn btn-warning btn-sm text-white">
                        Edit
                    </a>

                    {{-- Tombol Hapus --}}
                    <form action="{{ route('customers.destroy', $customer) }}"
                        method="POST"
                        onsubmit="return confirm('Yakin ingin menghapus customer ini?')">

                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn btn-danger btn-sm">
                            Hapus
                        </button>
                    </form>
                </div>
            </td>
        </tr>

        @empty

        <tr>
            <td colspan="5" class="text-center">
                Belum ada data customer.
            </td>
        </tr>

        @endforelse
    </tbody>
</table>

<div class="mt-3 d-flex justify-content-center">
    {{ $customers->links() }}
</div>

@endsection