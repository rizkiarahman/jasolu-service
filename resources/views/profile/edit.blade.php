@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto my-6 px-4">
    
    <!-- Header -->
    <div class="mb-6">
        <h2 class="text-2xl font-black text-slate-800 tracking-tight" style="font-family: 'Outfit', sans-serif;">
            ⚙️ Pengaturan Profil
        </h2>
        <p class="text-slate-500 text-sm">
            Perbarui informasi profil akun dan kata sandi Anda.
        </p>
    </div>

    <!-- Session Status Alerts -->
    @if (session('status') === 'profile-updated')
        <div class="alert alert-success alert-dismissible fade show border-0 rounded-2xl shadow-sm mb-4" role="alert">
            <strong>Sukses!</strong> Informasi profil Anda berhasil diperbarui.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('status') === 'password-updated')
        <div class="alert alert-success alert-dismissible fade show border-0 rounded-2xl shadow-sm mb-4" role="alert">
            <strong>Sukses!</strong> Kata sandi Anda berhasil diperbarui.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="space-y-6">

        <!-- Card 1: Update Profile Information -->
        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden mb-4">
            <div class="border-b border-slate-100 px-6 py-4 bg-slate-50/50">
                <h4 class="text-slate-800 text-base font-bold mb-0">
                    Informasi Profil
                </h4>
                <p class="text-slate-500 text-xs mt-1">
                    Perbarui nama dan alamat email akun Anda.
                </p>
            </div>
            
            <div class="p-6">
                <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                    @csrf
                    @method('patch')

                    <div class="flex flex-col md:flex-row gap-6">
                        
                        <!-- Avatar Upload Panel -->
                        <div class="w-full md:w-1/3 flex flex-col items-center justify-center border-b md:border-b-0 md:border-r border-slate-100 pb-6 md:pb-0 md:pr-6">
                            <div class="relative group mb-4">
                                @if($user->profile_photo)
                                    <img src="{{ asset('storage/' . $user->profile_photo) }}" alt="Foto Profil" class="w-32 h-32 rounded-full object-cover border-4 border-slate-100 shadow-md">
                                @else
                                    <div class="w-32 h-32 rounded-full bg-indigo-600 text-white flex items-center justify-center font-bold text-3xl uppercase border-4 border-slate-100 shadow-md">
                                        {{ substr($user->name, 0, 2) }}
                                    </div>
                                @endif
                            </div>

                            <label class="block text-slate-700 text-xs font-semibold mb-2">Unggah Foto Baru</label>
                            <input type="file" name="profile_photo" 
                                   class="w-full text-xs text-slate-500 file:mr-3 file:py-1.5 file:px-3 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-indigo-50 file:text-indigo-600 hover:file:bg-indigo-100 cursor-pointer focus:outline-none" />
                            @error('profile_photo', 'updateProfileInformation')
                                <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Info Inputs Panel -->
                        <div class="w-full md:w-2/3">
                            <!-- Nama -->
                            <div class="mb-4">
                                <label for="name" class="block text-slate-700 text-sm font-semibold mb-2">
                                    Nama Lengkap
                                </label>
                                <input id="name" name="name" type="text" 
                                       class="w-full px-3 py-2 border rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500 @error('name', 'updateProfileInformation') border-red-500 @else border-gray-300 @enderror" 
                                       value="{{ old('name', $user->name) }}" required autocomplete="name" />
                                @error('name', 'updateProfileInformation')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div class="mb-5">
                                <label for="email" class="block text-slate-700 text-sm font-semibold mb-2">
                                    Alamat Email
                                </label>
                                <input id="email" name="email" type="email" 
                                       class="w-full px-3 py-2 border rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500 @error('email', 'updateProfileInformation') border-red-500 @else border-gray-300 @enderror" 
                                       value="{{ old('email', $user->email) }}" required autocomplete="username" />
                                @error('email', 'updateProfileInformation')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="flex items-center gap-3">
                                <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-xl hover:bg-indigo-700 transition font-medium text-sm border-0">
                                    Simpan Perubahan
                                </button>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
        </div>

        <!-- Card 2: Update Password -->
        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
            <div class="border-b border-slate-100 px-6 py-4 bg-slate-50/50">
                <h4 class="text-slate-800 text-base font-bold mb-0">
                    Perbarui Kata Sandi
                </h4>
                <p class="text-slate-500 text-xs mt-1">
                    Pastikan akun Anda menggunakan kata sandi yang panjang dan acak untuk menjaga keamanan.
                </p>
            </div>

            <div class="p-6">
                <form method="post" action="{{ route('password.update') }}">
                    @csrf
                    @method('put')

                    <!-- Password Saat Ini -->
                    <div class="mb-4">
                        <label for="update_password_current_password" class="block text-slate-700 text-sm font-semibold mb-2">
                            Kata Sandi Saat Ini
                        </label>
                        <input id="update_password_current_password" name="current_password" type="password" 
                               class="w-full px-3 py-2 border rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500 @error('current_password', 'updatePassword') border-red-500 @else border-gray-300 @enderror" 
                               autocomplete="current-password" required />
                        @error('current_password', 'updatePassword')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password Baru -->
                    <div class="mb-4">
                        <label for="update_password_password" class="block text-slate-700 text-sm font-semibold mb-2">
                            Kata Sandi Baru
                        </label>
                        <input id="update_password_password" name="password" type="password" 
                               class="w-full px-3 py-2 border rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500 @error('password', 'updatePassword') border-red-500 @else border-gray-300 @enderror" 
                               autocomplete="new-password" required />
                        @error('password', 'updatePassword')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Konfirmasi Password Baru -->
                    <div class="mb-5">
                        <label for="update_password_password_confirmation" class="block text-slate-700 text-sm font-semibold mb-2">
                            Konfirmasi Kata Sandi Baru
                        </label>
                        <input id="update_password_password_confirmation" name="password_confirmation" type="password" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500" 
                               autocomplete="new-password" required />
                    </div>

                    <div class="flex items-center gap-3">
                        <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-xl hover:bg-indigo-700 transition font-medium text-sm border-0">
                            Perbarui Sandi
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>
@endsection
