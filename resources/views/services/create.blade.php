@extends('layouts.app')

@section('content')

<div class="card shadow-sm">

    <div class="card-header bg-primary text-white">
        <h4 class="mb-0">
            🛠 Tambah Data Service
        </h4>
    </div>

    <div class="card-body">

        <form action="{{ route('services.store') }}" method="POST">

            @csrf

            {{-- Kendaraan --}}
            <div class="mb-3">

                <label class="form-label">
                    Kendaraan
                </label>

                <select
                    name="vehicle_id"
                    class="form-select @error('vehicle_id') is-invalid @enderror">

                    <option value="">-- Pilih Kendaraan --</option>

                    @foreach($vehicles as $vehicle)

                    <option
                        value="{{ $vehicle->id }}"
                        {{ old('vehicle_id')==$vehicle->id?'selected':'' }}>

                        {{ $vehicle->plate_number }}
                        -
                        {{ $vehicle->customer->name }}

                    </option>

                    @endforeach

                </select>

                @error('vehicle_id')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror

            </div>

            {{-- Tanggal Service --}}
            <div class="mb-3">

                <label class="form-label">
                    Tanggal Service
                </label>

                <input
                    type="date"
                    name="service_date"
                    value="{{ old('service_date') }}"
                    class="form-control @error('service_date') is-invalid @enderror">

                @error('service_date')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror

            </div>

            {{-- Keluhan --}}
            <div class="mb-3">

                <label class="form-label">
                    Keluhan
                </label>

                <textarea
                    name="complaint"
                    rows="4"
                    class="form-control @error('complaint') is-invalid @enderror"
                    placeholder="Masukkan keluhan kendaraan">{{ old('complaint') }}</textarea>

                @error('complaint')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror

            </div>

            {{-- Status --}}
            <div class="mb-3">

                <label class="form-label">
                    Status
                </label>

                <select
                    name="status"
                    class="form-select">

                    <option value="Menunggu">Menunggu</option>

                    <option value="Diproses">Diproses</option>

                    <option value="Selesai">Selesai</option>

                </select>

            </div>

            <div class="d-flex gap-2">

                <button class="btn btn-success">

                    Simpan

                </button>

                <a
                    href="{{ route('services.index') }}"
                    class="btn btn-secondary">

                    Kembali

                </a>

            </div>

        </form>

    </div>

</div>

@endsection