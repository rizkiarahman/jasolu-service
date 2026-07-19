@extends('layouts.app')

@section('content')

<div class="container-fluid py-2">

    <!-- Greeting Banner -->
    <div class="bg-gradient-to-r from-blue-600 via-indigo-600 to-indigo-700 text-white rounded-3xl p-6 md:p-8 shadow-sm mb-6 flex flex-col md:flex-row justify-between items-start md:items-center gap-4 relative overflow-hidden border-0">
        <!-- Ambient light glow in banner -->
        <div class="absolute -right-16 -top-16 w-48 h-48 bg-white/10 rounded-full filter blur-xl"></div>
        
        <div class="relative z-10">
            <span class="bg-white/20 text-white text-xs font-semibold px-3 py-1 rounded-full uppercase tracking-wider">
                Dashboard
            </span>
            <h2 class="text-2xl md:text-3xl font-extrabold mt-3 tracking-tight">
                Selamat Datang, {{ Auth::user()->name }}! 👋
            </h2>
            <p class="text-indigo-100 text-sm mt-1 max-w-xl">
                Pantau aktivitas bengkel, kelola transaksi pelanggan, dan gunakan kecerdasan buatan <span class="font-extrabold text-cyan-200 tracking-wide filter drop-shadow-[0_0_8px_rgba(34,211,238,0.4)]">Jasolu AI</span> untuk mempercepat operasional.
            </p>
        </div>
        <div class="bg-white/10 backdrop-blur-md border border-white/20 px-5 py-3 rounded-2xl text-left md:text-right relative z-10 self-stretch md:self-auto flex flex-col justify-center">
            <p class="text-[10px] text-indigo-200 font-bold uppercase tracking-wider mb-0.5">Hari Ini</p>
            <p class="text-sm font-extrabold text-white mb-0">
                {{ \Carbon\Carbon::now()->locale('id')->translatedFormat('l, d F Y') }}
            </p>
        </div>
    </div>

    <!-- Quick Overview Section -->
    <h5 class="text-slate-500 font-bold text-xs uppercase tracking-wider mb-4 px-1">Menu Utama & Statistik</h5>
    
    <div class="row g-4">

        <!-- Pelanggan Card -->
        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
            <a href="{{ route('customers.index') }}" class="text-decoration-none block transform hover:-translate-y-1 transition-all duration-300">
                <div class="bg-white rounded-2xl p-5 shadow-sm border border-slate-100 flex items-center justify-between h-full min-h-[145px]">
                    <div>
                        <p class="text-slate-500 text-sm font-bold uppercase tracking-wider mb-1.5">Pelanggan</p>
                        <h3 class="text-3xl font-black text-slate-800 tracking-tight mb-0">{{ $totalCustomers }}</h3>
                        <span class="text-sm text-indigo-600 font-bold flex items-center gap-1 mt-2">
                            Kelola data &rarr;
                        </span>
                    </div>
                    <div class="w-12 h-12 rounded-2xl bg-indigo-50 text-indigo-600 flex items-center justify-center text-xl">
                        👤
                    </div>
                </div>
            </a>
        </div>

        <!-- Kendaraan Card -->
        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
            <a href="{{ route('vehicles.index') }}" class="text-decoration-none block transform hover:-translate-y-1 transition-all duration-300">
                <div class="bg-white rounded-2xl p-5 shadow-sm border border-slate-100 flex items-center justify-between h-full min-h-[145px]">
                    <div>
                        <p class="text-slate-500 text-sm font-bold uppercase tracking-wider mb-1.5">Kendaraan</p>
                        <h3 class="text-3xl font-black text-slate-800 tracking-tight mb-0">{{ $totalVehicles }}</h3>
                        <span class="text-sm text-emerald-600 font-bold flex items-center gap-1 mt-2">
                            Kelola data &rarr;
                        </span>
                    </div>
                    <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-xl">
                        🏍️
                    </div>
                </div>
            </a>
        </div>

        <!-- Suku Cadang Card -->
        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
            <a href="{{ route('spareparts.index') }}" class="text-decoration-none block transform hover:-translate-y-1 transition-all duration-300">
                <div class="bg-white rounded-2xl p-5 shadow-sm border border-slate-100 flex items-center justify-between h-full min-h-[145px]">
                    <div>
                        <p class="text-slate-500 text-sm font-bold uppercase tracking-wider mb-1.5">Suku Cadang</p>
                        <h3 class="text-3xl font-black text-slate-800 tracking-tight mb-0">{{ $totalSpareparts }}</h3>
                        <span class="text-sm text-amber-600 font-bold flex items-center gap-1 mt-2">
                            Kelola stok &rarr;
                        </span>
                    </div>
                    <div class="w-12 h-12 rounded-2xl bg-amber-50 text-amber-600 flex items-center justify-center text-xl">
                        🔧
                    </div>
                </div>
            </a>
        </div>

        <!-- Service Card -->
        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
            <a href="{{ route('services.index') }}" class="text-decoration-none block transform hover:-translate-y-1 transition-all duration-300">
                <div class="bg-white rounded-2xl p-5 shadow-sm border border-slate-100 flex items-center justify-between h-full min-h-[145px]">
                    <div>
                        <p class="text-slate-500 text-sm font-bold uppercase tracking-wider mb-1.5">Service</p>
                        <h3 class="text-3xl font-black text-slate-800 tracking-tight mb-0">{{ $totalServices }}</h3>
                        <span class="text-sm text-rose-600 font-bold flex items-center gap-1 mt-2">
                            Proses service &rarr;
                        </span>
                    </div>
                    <div class="w-12 h-12 rounded-2xl bg-rose-50 text-rose-600 flex items-center justify-center text-xl">
                        🛠️
                    </div>
                </div>
            </a>
        </div>

        <!-- AI Assistant Card (Premium theme) -->
        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
            <a href="{{ route('ai.index') }}" class="text-decoration-none block transform hover:-translate-y-1 transition-all duration-300">
                <div class="bg-slate-900 rounded-2xl p-5 shadow-sm border border-slate-800 flex items-center justify-between h-full min-h-[145px]">
                    <!-- Glow effect in dark card -->
                    <div class="absolute -right-6 -bottom-6 w-24 h-24 bg-violet-600 rounded-full filter blur-xl opacity-30"></div>
                    
                    <div class="relative z-10">
                        <p class="text-slate-400 text-sm font-bold uppercase tracking-wider mb-1.5 whitespace-nowrap">Tanya AI Assistant</p>
                        <h3 class="text-3xl font-black bg-gradient-to-r from-violet-400 via-fuchsia-400 to-cyan-400 bg-clip-text text-transparent tracking-tight mb-0">Jasolu AI</h3>
                        <span class="text-sm text-indigo-300 font-bold flex items-center gap-1 mt-2">
                            Buka asisten &rarr;
                        </span>
                    </div>
                    <div class="w-12 h-12 rounded-2xl bg-slate-800 text-white flex items-center justify-center text-xl relative z-10">
                        🤖
                    </div>
                </div>
            </a>
        </div>

        @if(strtolower(Auth::user()->role) == 'admin')
            <!-- Kelola User Card (Admin Only) -->
            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                <a href="{{ route('users.index') }}" class="text-decoration-none block transform hover:-translate-y-1 transition-all duration-300">
                    <div class="bg-white rounded-2xl p-5 shadow-sm border border-slate-100 flex items-center justify-between h-full min-h-[145px]">
                        <div>
                            <p class="text-slate-500 text-sm font-bold uppercase tracking-wider mb-1.5 whitespace-nowrap">Kelola Akun Staff</p>
                            <h3 class="text-3xl font-black text-slate-800 tracking-tight mb-0">{{ $totalUsers }}</h3>
                            <span class="text-sm text-teal-600 font-bold flex items-center gap-1 mt-2">
                                Atur staff &rarr;
                            </span>
                        </div>
                        <div class="w-12 h-12 rounded-2xl bg-teal-50 text-teal-600 flex items-center justify-center text-xl">
                            👥
                        </div>
                    </div>
                </a>
            </div>

            <!-- Laporan Card (Admin Only) -->
            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                <a href="{{ route('reports.index') }}" class="text-decoration-none block transform hover:-translate-y-1 transition-all duration-300">
                    <div class="bg-white rounded-2xl p-5 shadow-sm border border-slate-100 flex items-center justify-between h-full min-h-[145px]">
                        <div>
                            <p class="text-slate-500 text-sm font-bold uppercase tracking-wider mb-1.5 whitespace-nowrap">Laporan Keuangan</p>
                            <h3 class="text-3xl font-black text-slate-800 tracking-tight mb-0">Laporan</h3>
                            <span class="text-sm text-indigo-600 font-bold flex items-center gap-1 mt-2">
                                Lihat grafik &rarr;
                            </span>
                        </div>
                        <div class="w-12 h-12 rounded-2xl bg-indigo-50 text-indigo-600 flex items-center justify-center text-xl">
                            📈
                        </div>
                    </div>
                </a>
            </div>
        @endif

    </div>

</div>

@endsection