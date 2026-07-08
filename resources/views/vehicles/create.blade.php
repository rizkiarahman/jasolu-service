@extends('layouts.app')

@section('content')

<div class="card shadow">

    <div class="card-header bg-primary text-white">
        <h4 class="mb-0">
            🚗 Form Tambah Kendaraan
        </h4>
    </div>

    <div class="card-body">

        <form action="{{ route('vehicles.store') }}" method="POST">

            @csrf

            {{-- Customer --}}
            <div class="mb-3">

                <label class="form-label fw-semibold">
                    Customer
                </label>

                <select
                    name="customer_id"
                    class="form-select @error('customer_id') is-invalid @enderror">

                    <option value="">-- Pilih Customer --</option>

                    @foreach($customers as $customer)

                    <option
                        value="{{ $customer->id }}"
                        {{ old('customer_id') == $customer->id ? 'selected' : '' }}>

                        {{ $customer->name }}

                    </option>

                    @endforeach

                </select>

                @error('customer_id')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror

            </div>

            {{-- Plat Nomor --}}
            <div class="mb-3">

                <label class="form-label fw-semibold">
                    Plat Nomor
                </label>

                <input
                    type="text"
                    name="plate_number"
                    class="form-control @error('plate_number') is-invalid @enderror"
                    value="{{ old('plate_number') }}"
                    placeholder="Contoh : B 1234 ABC">

                @error('plate_number')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror

            </div>

            {{-- Merk --}}
            <div class="mb-3">

                <label class="form-label fw-semibold">
                    Merk
                </label>

                <input
                    type="text"
                    name="brand"
                    class="form-control @error('brand') is-invalid @enderror"
                    value="{{ old('brand') }}"
                    placeholder="Honda, Yamaha, Suzuki">

                @error('brand')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror

            </div>

            {{-- Model --}}
            <div class="mb-3">

                <label class="form-label fw-semibold">
                    Model
                </label>

                <input
                    type="text"
                    name="model"
                    class="form-control @error('model') is-invalid @enderror"
                    value="{{ old('model') }}"
                    placeholder="Vario 160, NMAX, Beat">

                @error('model')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror

            </div>

            {{-- Tahun --}}
            <div class="mb-3">

                <label class="form-label fw-semibold">
                    Tahun
                </label>

                <input
                    type="number"
                    name="year"
                    class="form-control @error('year') is-invalid @enderror"
                    value="{{ old('year') }}"
                    placeholder="2024">

                @error('year')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror

            </div>

            <hr>

            <div class="d-flex justify-content-end gap-2">

                <a href="{{ route('vehicles.index') }}"
                    class="btn btn-secondary">

                    Kembali

                </a>

                <button
                    type="submit"
                    class="btn btn-success">

                    💾 Simpan

                </button>

            </div>

        </form>

    </div>

</div>

@endsection