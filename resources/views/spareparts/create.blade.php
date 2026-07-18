@extends('layouts.app')

@section('content')

<h1 class="mb-4">Tambah Sparepart</h1>

<div class="card">
    <div class="card-header bg-primary text-white">
        Form Tambah Sparepart
    </div>

    <div class="card-body">

        <form action="{{ route('spareparts.store') }}" method="POST">
            @csrf

            {{-- Kode Sparepart --}}
            <div class="mb-3">
                <label class="form-label">Kode Sparepart</label>
                <input
                    type="text"
                    name="code"
                    class="form-control @error('code') is-invalid @enderror"
                    value="{{ old('code') }}"
                    placeholder="Masukkan kode sparepart">

                @error('code')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            {{-- Nama Sparepart --}}
            <div class="mb-3">
                <label class="form-label">Nama Sparepart</label>
                <input
                    type="text"
                    name="name"
                    class="form-control @error('name') is-invalid @enderror"
                    value="{{ old('name') }}"
                    placeholder="Masukkan nama sparepart">

                @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            {{-- Merk --}}
            <div class="mb-3">
                <label class="form-label">Merk / Brand (Opsional)</label>
                <input
                    type="text"
                    name="brand"
                    class="form-control @error('brand') is-invalid @enderror"
                    value="{{ old('brand') }}"
                    placeholder="Contoh: Honda, Federal, Yamaha">
                @error('brand')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            {{-- Stok --}}
            <div class="mb-3">
                <label class="form-label">Stok</label>
                <input
                    type="number"
                    name="stock"
                    class="form-control @error('stock') is-invalid @enderror"
                    value="{{ old('stock') }}"
                    placeholder="Masukkan jumlah stok">

                @error('stock')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            {{-- Harga Beli --}}
            <div class="mb-3">
                <label class="form-label">Harga Beli</label>
                <input
                    type="number"
                    name="purchase_price"
                    class="form-control @error('purchase_price') is-invalid @enderror"
                    value="{{ old('purchase_price') }}"
                    placeholder="Masukkan harga beli">

                @error('purchase_price')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            {{-- Harga Jual --}}
            <div class="mb-3">
                <label class="form-label">Harga Jual</label>
                <input
                    type="number"
                    name="selling_price"
                    class="form-control @error('selling_price') is-invalid @enderror"
                    value="{{ old('selling_price') }}"
                    placeholder="Masukkan harga jual">

                @error('selling_price')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            {{-- Satuan --}}
            <div class="mb-3">
                <label class="form-label">Satuan</label>
                <input
                    type="text"
                    name="unit"
                    class="form-control @error('unit') is-invalid @enderror"
                    value="{{ old('unit', 'pcs') }}"
                    placeholder="Contoh: pcs, set, botol">

                @error('unit')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    Simpan
                </button>

                <a href="{{ route('spareparts.index') }}" class="btn btn-secondary">
                    Kembali
                </a>
            </div>

        </form>

    </div>
</div>

@endsection