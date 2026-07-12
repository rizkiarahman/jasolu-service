@extends('layouts.app')

@section('content')

<div class="card shadow">

    <div class="card-header bg-primary text-white">

        <h4 class="mb-0">

            🛠 Data Service

        </h4>

    </div>

    <div class="card-body">

        <div class="row mb-3">

            <div class="col-md-4">

                <a
                    href="{{ route('services.create') }}"
                    class="btn btn-success">

                    + Tambah Service

                </a>

            </div>

            <div class="col-md-8">

                <form method="GET">

                    <div class="input-group">

                        <input
                            type="text"
                            name="keyword"
                            class="form-control"
                            placeholder="Cari Plat Nomor">

                        <button
                            class="btn btn-primary">

                            Cari

                        </button>

                    </div>

                </form>

            </div>

        </div>

        <table class="table table-bordered table-hover">

            <thead class="table-dark">

                <tr>

                    <th>No</th>

                    <th>Tanggal</th>

                    <th>Plat</th>

                    <th>Customer</th>

                    <th>Keluhan</th>

                    <th>Status</th>

                    <th width="170">Aksi</th>

                </tr>

            </thead>

            <tbody>

                @forelse($services as $service)

                <tr>

                    <td>{{ $loop->iteration }}</td>

                    <td>{{ $service->service_date }}</td>

                    <td>{{ $service->vehicle->plate_number }}</td>

                    <td>{{ $service->vehicle->customer->name }}</td>

                    <td>{{ $service->complaint }}</td>

                    <td>

                        @if($service->status=='Menunggu')

                        <span class="badge bg-secondary">

                            {{ $service->status }}

                        </span>

                        @elseif($service->status=='Diproses')

                        <span class="badge bg-warning text-dark">

                            {{ $service->status }}

                        </span>

                        @else

                        <span class="badge bg-success">

                            {{ $service->status }}

                        </span>

                        @endif

                    </td>

                    <td>

                        <div class="d-flex gap-2">

                            <a
                                href="{{ route('services.edit',$service) }}"
                                class="btn btn-warning btn-sm text-primary fw-bold">

                                Edit

                            </a>

                            <form
                                action="{{ route('services.destroy',$service) }}"
                                method="POST">

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

                    <td colspan="7" class="text-center">

                        Belum ada data service.

                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

        {{ $services->links() }}

    </div>

</div>

@endsection