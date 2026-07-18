@extends('layouts.app')

@section('content')

<div class="max-w-2xl mx-auto my-6">
    <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100">
        <!-- Header -->
        <div class="bg-gradient-to-r from-blue-600 to-indigo-600 px-6 py-4">
            <h4 class="text-white text-lg font-bold mb-0 flex items-center gap-2">
                🛠 Edit Data Service
            </h4>
        </div>

        <!-- Body -->
        <div class="p-6">
            <form action="{{ route('services.update', $service) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Kendaraan -->
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-semibold mb-2">
                        Kendaraan
                    </label>
                    <select
                        name="vehicle_id"
                        class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('vehicle_id') border-red-500 @else border-gray-300 @enderror" required>
                        <option value="">-- Pilih Kendaraan --</option>
                        @foreach($vehicles as $vehicle)
                        <option
                            value="{{ $vehicle->id }}"
                            {{ old('vehicle_id', $service->vehicle_id) == $vehicle->id ? 'selected' : '' }}>
                            {{ $vehicle->plate_number }} - {{ $vehicle->customer->name }}
                        </option>
                        @endforeach
                    </select>
                    @error('vehicle_id')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Tanggal Service -->
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-semibold mb-2">
                        Tanggal Service
                    </label>
                    <input
                        type="date"
                        name="service_date"
                        class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('service_date') border-red-500 @else border-gray-300 @enderror"
                        value="{{ old('service_date', $service->service_date) }}" required>
                    @error('service_date')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Keluhan -->
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-semibold mb-2">
                        Keluhan
                    </label>
                    <textarea
                        name="complaint"
                        rows="4"
                        class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('complaint') border-red-500 @else border-gray-300 @enderror"
                        placeholder="Masukkan keluhan kendaraan" required>{{ old('complaint', $service->complaint) }}</textarea>
                    @error('complaint')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Status -->
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-semibold mb-2">
                        Status
                    </label>
                    <select
                        name="status"
                        class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('status') border-red-500 @else border-gray-300 @enderror" required>
                        <option value="Menunggu" {{ old('status', $service->status) == 'Menunggu' ? 'selected' : '' }}>Menunggu</option>
                        <option value="Diproses" {{ old('status', $service->status) == 'Diproses' ? 'selected' : '' }}>Diproses</option>
                        <option value="Selesai" {{ old('status', $service->status) == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                    </select>
                    @error('status')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Buttons -->
                <div class="border-t border-gray-100 pt-4 flex justify-end gap-3">
                    <a href="{{ route('services.index') }}"
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
