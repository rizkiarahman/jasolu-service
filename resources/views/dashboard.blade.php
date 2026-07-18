@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <div class="mb-4">

        <h2 class="fw-bold">
            📊 Dashboard
        </h2>

        <p class="text-muted">
            Selamat datang, {{ Auth::user()->name }}
        </p>

    </div>

    <div class="row g-4">

        {{-- Customer --}}
        <div class="col-md-3">
            <a href="{{ route('customers.index') }}"
                class="text-decoration-none">
                <div class="card shadow border-0">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <small class="text-muted">
                                    Pelanggan
                                </small>
                                <h2 class="fw-bold">
                                    {{ $totalCustomers }}
                                </h2>
                            </div>
                            <div class="fs-1">
                                👤
                            </div>
                        </div>

                    </div>

                </div>
            </a>
        </div>

        {{-- Vehicle --}}
        <div class="col-md-3">
            <a href="{{ route('vehicles.index') }}"
                class="text-decoration-none">
                <div class="card shadow border-0">

                    <div class="card-body">

                        <div class="d-flex justify-content-between">

                            <div>

                                <small class="text-muted">
                                    Kendaraan
                                </small>

                                <h2 class="fw-bold">
                                    {{ $totalVehicles }}
                                </h2>

                            </div>

                            <div class="fs-1">
                                🏍️
                            </div>

                        </div>

                    </div>

                </div>
            </a>
        </div>

        {{-- Sparepart --}}
        <div class="col-md-3">
            <a href="{{ route('spareparts.index') }}"
                class="text-decoration-none">
                <div class="card shadow border-0">

                    <div class="card-body">

                        <div class="d-flex justify-content-between">

                            <div>

                                <small class="text-muted">
                                    Suku Cadang
                                </small>

                                <h2 class="fw-bold">
                                    {{ $totalSpareparts }}
                                </h2>

                            </div>

                            <div class="fs-1">
                                🔧
                            </div>

                        </div>

                    </div>

                </div>
            </a>
        </div>

        {{-- Service --}}
        <div class="col-md-3">
            <a href="{{ route('services.index') }}"
                class="text-decoration-none">
                <div class="card shadow border-0">

                    <div class="card-body">

                        <div class="d-flex justify-content-between">

                            <div>

                                <small class="text-muted">
                                    Service
                                </small>

                                <h2 class="fw-bold">
                                    {{ $totalServices }}
                                </h2>

                            </div>

                            <div class="fs-1">
                                🛠️
                            </div>

                        </div>

                    </div>

                </div>
            </a>
        </div>

        {{-- AI Assistant --}}
        <div class="col-md-3">
            <a href="{{ route('ai.index') }}"
                class="text-decoration-none">
                <div class="card shadow border-0 bg-dark text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <small class="text-white-50">
                                    Tanya AI Assistant
                                </small>
                                <h2 class="fw-bold text-warning">
                                    Asisten AI
                                </h2>
                            </div>
                            <div class="fs-1">
                                🤖
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        @if(strtolower(Auth::user()->role) == 'admin')
        {{-- Kelola User --}}
        <div class="col-md-3">
            <a href="{{ route('users.index') }}"
                class="text-decoration-none">
                <div class="card shadow border-0">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <small class="text-muted">
                                    Kelola Akun Staff
                                </small>
                                <h2 class="fw-bold">
                                    {{ $totalUsers }}
                                </h2>
                            </div>
                            <div class="fs-1">
                                👥
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        {{-- Laporan --}}
        <div class="col-md-3">
            <a href="{{ route('reports.index') }}"
                class="text-decoration-none">
                <div class="card shadow border-0">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <small class="text-muted">
                                    Laporan Keuangan
                                </small>
                                <h2 class="fw-bold">
                                    Rekap
                                </h2>
                            </div>
                            <div class="fs-1">
                                📈
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        @endif

    </div>

</div>

@endsection