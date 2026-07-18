@extends('layouts.app')

@section('content')

<div class="max-w-2xl mx-auto my-6">
    <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100">
        <!-- Header -->
        <div class="bg-gradient-to-r from-blue-600 to-indigo-600 px-6 py-4">
            <h4 class="text-white text-lg font-bold mb-0 flex items-center gap-2">
                🚗 Edit Data Kendaraan
            </h4>
        </div>

        <!-- Body -->
        <div class="p-6">
            <form action="{{ route('vehicles.update', $vehicle) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Customer -->
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-semibold mb-2">
                        Customer
                    </label>
                    <select
                        name="customer_id"
                        class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('customer_id') border-red-500 @else border-gray-300 @enderror">
                        <option value="">-- Pilih Customer --</option>
                        @foreach($customers as $customer)
                        <option
                            value="{{ $customer->id }}"
                            {{ old('customer_id', $vehicle->customer_id) == $customer->id ? 'selected' : '' }}>
                            {{ $customer->name }}
                        </option>
                        @endforeach
                    </select>
                    @error('customer_id')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Plat Nomor -->
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-semibold mb-2">
                        Plat Nomor
                    </label>
                    <input
                        type="text"
                        name="plate_number"
                        class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('plate_number') border-red-500 @else border-gray-300 @enderror"
                        value="{{ old('plate_number', $vehicle->plate_number) }}"
                        placeholder="Contoh : B 1234 ABC">
                    @error('plate_number')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Merk -->
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-semibold mb-2">
                        Merk
                    </label>
                    <input
                        type="text"
                        name="brand"
                        class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('brand') border-red-500 @else border-gray-300 @enderror"
                        value="{{ old('brand', $vehicle->brand) }}"
                        placeholder="Honda, Yamaha, Suzuki">
                    @error('brand')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Model -->
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-semibold mb-2">
                        Model
                    </label>
                    <input
                        type="text"
                        name="model"
                        class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('model') border-red-500 @else border-gray-300 @enderror"
                        value="{{ old('model', $vehicle->model) }}"
                        placeholder="Vario 160, NMAX, Beat">
                    @error('model')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Tahun -->
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-semibold mb-2">
                        Tahun
                    </label>
                    <input
                        type="number"
                        name="year"
                        class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('year') border-red-500 @else border-gray-300 @enderror"
                        value="{{ old('year', $vehicle->year) }}"
                        placeholder="2024">
                    @error('year')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Buttons -->
                <div class="border-t border-gray-100 pt-4 flex justify-end gap-3">
                    <a href="{{ route('vehicles.index') }}"
                        class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition font-medium text-decoration-none">
                        Kembali
                    </a>
                    <button
                        type="submit"
                        class="px-4 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 transition font-medium flex items-center gap-1 border-0">
                        💾 Update
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>

@endsection
