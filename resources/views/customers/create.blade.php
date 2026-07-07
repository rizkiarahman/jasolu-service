@extends('layouts.app')

@section('content')

<h1 class="mb-4">Tambah Customer</h1>

<div class="card">

    <div class="card-header bg-primary text-white">
        Form Tambah Customer
    </div>

    <div class="card-body">

        <form action="{{ route('customers.store') }}" method="POST">
            @csrf

            {{-- Nama Customer --}}
            <div class="mb-3">
                <label class="form-label">Nama Customer</label>

                <input
                    type="text"
                    name="name"
                    class="form-control @error('name') is-invalid @enderror"
                    value="{{ old('name') }}"
                    placeholder="Masukkan nama customer">

                @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror

            </div>

            {{-- Nomor HP --}}
            <div class="mb-3">
                <label class="form-label">Nomor HP</label>

                <input
                    type="text"
                    name="phone"
                    class="form-control @error('phone') is-invalid @enderror"
                    value="{{ old('phone') }}"
                    placeholder="Masukkan nomor HP">

                @error('phone')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror

            </div>

            {{-- Alamat --}}
            <div class="mb-3">
                <label class="form-label">Alamat</label>

                <textarea
                    name="address"
                    rows="4"
                    class="form-control @error('address') is-invalid @enderror"
                    placeholder="Masukkan alamat customer">{{ old('address') }}</textarea>

                @error('address')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror

            </div>

            <div class="d-flex gap-2">

                <button type="submit" class="btn btn-primary">
                    Simpan
                </button>

                <a href="{{ route('customers.index') }}" class="btn btn-secondary">
                    Kembali
                </a>

            </div>

        </form>

    </div>

</div>

@endsection