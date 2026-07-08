@extends('layouts.app')

@section('content')

<div class="card shadow-sm">

    <div class="card-header bg-primary text-white">

        <h4 class="mb-0">
            🚗 Data Kendaraan
        </h4>

    </div>

    <div class="card-body">

        {{-- Tombol Tambah dan Search --}}
        <div class="row mb-2 align-items-center">

            <div class="col-md-4">
                <a href="{{ route('vehicles.create') }}" class="btn btn-success">
                    + Tambah Kendaraan
                </a>
            </div>

            <div class="col-md-8">
                <form action="{{ route('vehicles.index') }}" method="GET">
                    <div class="input-group ms-auto" style="width:450px;">
                        <input type="text"
                            name="search"
                            class="form-control"
                            placeholder="Cari plat nomor atau nama pelanggan..."
                            value="{{ request('search') }}">

                        <button class="btn btn-primary">
                            <i class="bi bi-search"></i> Cari
                        </button>
                    </div>
                </form>
            </div>

        </div>

        {{-- Table --}}
        <div class="table-responsive">

            <table class="table table-bordered table-hover align-middle">

                <thead class="table-dark">

                    <tr>

                        <th width="60">No</th>
                        <th>Plat Nomor</th>
                        <th>Pelanggan</th>
                        <th>Merk</th>
                        <th>Model</th>
                        <th>Tahun</th>
                        <th width="180">Aksi</th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($vehicles as $vehicle)

                    <tr>

                        <td>
                            {{ $loop->iteration }}
                        </td>

                        <td>
                            <span class="badge bg-secondary fs-6">
                                {{ $vehicle->plate_number }}
                            </span>
                        </td>

                        <td>

                            {{ $vehicle->customer->name }}

                        </td>

                        <td>

                            {{ $vehicle->brand }}

                        </td>

                        <td>

                            {{ $vehicle->model }}

                        </td>

                        <td>

                            {{ $vehicle->year }}

                        </td>

                        <td>

                            <div class="d-flex gap-2">

                                <a
                                    href="{{ route('vehicles.edit',$vehicle) }}"
                                    class="btn btn-warning btn-sm text-white fw-bold">
                                    Edit
                                </a>

                                <form
                                    action="{{ route('vehicles.destroy',$vehicle) }}"
                                    method="POST"
                                    onsubmit="return confirm('Yakin ingin menghapus kendaraan ini?')">

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        class="btn btn-danger btn-sm">

                                        Hapus

                                    </button>

                                </form>

                            </div>

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td colspan="7" class="text-center text-muted">

                            Belum ada data kendaraan.

                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>
            {{-- Pagination --}}

            <div class="d-flex justify-content-between align-items-center mt-3">

                <small class="text-muted">

                    Showing {{ $vehicles->firstItem() ?? 0 }}
                    to {{ $vehicles->lastItem() ?? 0 }}
                    of {{ $vehicles->total() }} results

                </small>
                {{ $vehicles->links() }}
            </div>
        </div>
    </div>

</div>

@endsection