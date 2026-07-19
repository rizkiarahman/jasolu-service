@extends('layouts.app')

@section('content')

<div class="container-fluid">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h2 class="fw-bold mb-1">
                <i class="bi bi-bar-chart-line-fill text-primary"></i>
                Laporan Bengkel
            </h2>
            <p class="text-muted mb-0">
                Rekapitulasi data service, pelanggan, kendaraan, dan sparepart.
            </p>
        </div>

        <a href="{{ route('reports.index', array_merge(request()->all(), ['export' => 'excel'])) }}" class="btn btn-success">
            <i class="bi bi-file-earmark-excel"></i>
            Export Excel
        </a>

    </div>

    {{-- Card Statistik --}}
    <div class="row g-4 mb-4">

        <div class="col-md-3">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <i class="bi bi-people-fill text-primary fs-1"></i>
                    <h3 class="fw-bold mt-2">{{ $totalCustomers }}</h3>
                    <p class="text-muted mb-0">Total Pelanggan</p>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <i class="bi bi-truck text-success fs-1"></i>
                    <h3 class="fw-bold mt-2">{{ $totalVehicles }}</h3>
                    <p class="text-muted mb-0">Total Kendaraan</p>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <i class="bi bi-tools text-warning fs-1"></i>
                    <h3 class="fw-bold mt-2">{{ $totalServices }}</h3>
                    <p class="text-muted mb-0">Total Service</p>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <i class="bi bi-cash-stack text-danger fs-1"></i>
                    <h3 class="fw-bold mt-2">Rp {{ number_format($totalIncome, 0, ',', '.') }}</h3>
                    <p class="text-muted mb-0">Pendapatan</p>
                </div>
            </div>
        </div>

    </div>

    {{-- Filter --}}
    <div class="card shadow-sm border-0 mb-4">

        <div class="card-header bg-primary text-white">

            <h5 class="mb-0">
                <i class="bi bi-funnel-fill"></i>
                Filter Laporan
            </h5>

        </div>

        <div class="card-body">

            <form method="GET" action="{{ route('reports.index') }}">

                <div class="row">

                    <div class="col-md-4 mb-3">

                        <label class="form-label">Tanggal Awal</label>

                        <input type="date" name="start_date" class="form-control" value="{{ $startDate }}">

                    </div>

                    <div class="col-md-4 mb-3">

                        <label class="form-label">Tanggal Akhir</label>

                        <input type="date" name="end_date" class="form-control" value="{{ $endDate }}">

                    </div>

                    <div class="col-md-4 mb-3">

                        <label class="form-label d-none d-md-block">&nbsp;</label>

                        <div class="d-flex gap-2">

                            <button class="btn btn-primary" type="submit">

                                <i class="bi bi-search"></i>

                                Tampilkan

                            </button>

                            <a href="{{ route('reports.index') }}" class="btn btn-secondary">

                                Reset

                            </a>

                        </div>

                    </div>

                </div>

            </form>

        </div>

    </div>

    {{-- Data --}}
    <div class="card shadow-sm border-0">

        <div class="card-header bg-white">

            <h5 class="mb-0">

                <i class="bi bi-table"></i>

                Data Laporan

            </h5>

        </div>

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-bordered table-hover align-middle">

                    <thead class="table-primary">

                        <tr>

                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Pelanggan</th>
                            <th>Kendaraan</th>
                            <th>Service</th>
                            <th>Total</th>

                        </tr>

                    </thead>

                    <tbody>
                        @forelse($services as $service)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ \Carbon\Carbon::parse($service->service_date)->format('d-m-Y') }}</td>
                            <td>{{ $service->vehicle->customer->name ?? '-' }}</td>
                            <td>{{ $service->vehicle->plate_number ?? '-' }}</td>
                            <td>{{ $service->complaint }}</td>
                            <td>
                                @php
                                    $total = 50000;
                                    if (\Illuminate\Support\Facades\Schema::hasTable('service_details')) {
                                        $total = $service->serviceDetails->sum('subtotal') ?: 50000;
                                    }
                                @endphp
                                Rp {{ number_format($total, 0, ',', '.') }}
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-5">
                                <i class="bi bi-inbox fs-1 d-block mb-3"></i>
                                Belum ada data laporan.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

@endsection