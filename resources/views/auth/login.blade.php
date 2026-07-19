<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Login - Jasolu Service</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Tailwind compiled by Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
        .title-font {
            font-family: 'Outfit', sans-serif;
        }
        /* Glow animations */
        .glow-circle {
            filter: blur(120px);
            opacity: 0.15;
            animation: pulseGlow 10s ease-in-out infinite alternate;
        }
        @keyframes pulseGlow {
            0% { transform: scale(1); opacity: 0.12; }
            100% { transform: scale(1.2); opacity: 0.2; }
        }
        .float-bike {
            animation: floatBike 5s ease-in-out infinite;
        }
        @keyframes floatBike {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-15px) rotate(-1deg); }
        }
    </style>
</head>
<body class="h-full bg-slate-950 text-slate-100 antialiased overflow-x-hidden">

    <!-- Main Container -->
    <div class="min-h-screen flex">
        
        <!-- Left Side: Visual/Branding Panel (Hidden on Mobile) -->
        <div class="hidden lg:flex lg:w-1/2 bg-gradient-to-br from-indigo-950 via-slate-950 to-emerald-950 relative overflow-hidden flex-col justify-between p-12 border-r border-slate-900">
            <!-- Background Glow Circles -->
            <div class="absolute top-1/4 left-1/4 w-[400px] h-[400px] bg-blue-500 rounded-full glow-circle"></div>
            <div class="absolute bottom-1/4 right-1/4 w-[350px] h-[350px] bg-emerald-500 rounded-full glow-circle" style="animation-delay: -3s;"></div>

            <!-- Top Brand -->
            <div class="relative z-10">
                <span class="text-2xl font-extrabold tracking-tight text-white flex items-center gap-2 title-font">
                    🏍️ Jasolu Service
                </span>
            </div>

            <!-- Middle Illustration / Graphic -->
            <div class="relative z-10 flex flex-col items-center justify-center my-auto">
                <div class="float-bike mb-8 text-indigo-400">
                    <!-- Glowing Motorcycle Vector SVG -->
                    <svg class="w-80 h-auto filter drop-shadow-[0_0_30px_rgba(99,102,241,0.5)]" viewBox="0 0 512 512" fill="none" stroke="currentColor" stroke-width="12" stroke-linecap="round" stroke-linejoin="round">
                        <!-- Back Wheel -->
                        <circle cx="100" cy="350" r="80" stroke="currentColor" stroke-width="16" />
                        <circle cx="100" cy="350" r="30" stroke="currentColor" stroke-width="8" />
                        <!-- Front Wheel -->
                        <circle cx="412" cy="350" r="80" stroke="currentColor" stroke-width="16" />
                        <circle cx="412" cy="350" r="30" stroke="currentColor" stroke-width="8" />
                        
                        <!-- Frame & Main Body -->
                        <path d="M100 350L180 280H280" />
                        <path d="M412 350L350 160" />
                        <path d="M350 160L320 140M350 160L380 155" />
                        <path d="M180 280L200 370H300L350 310" />
                        <!-- Gas Tank -->
                        <path d="M220 200C220 200 240 160 300 160C350 160 360 200 320 220C280 235 230 220 220 200Z" fill="currentColor" fill-opacity="0.2" />
                        <!-- Seat -->
                        <path d="M150 220C170 200 200 200 230 210L220 240H160L150 220Z" fill="currentColor" />
                        
                        <!-- Exhaust Pipe -->
                        <path d="M180 340H320L360 320" stroke-width="16" />
                        
                        <!-- Engine Details / Cylinder head -->
                        <path d="M230 260H290M230 280H290M230 300H290" stroke-width="8" />
                        
                        <!-- Front Headlight -->
                        <path d="M365 170L395 180" stroke-width="10" />
                        <path d="M395 165C405 175 405 185 395 195" fill="currentColor" />
                    </svg>
                </div>
                
                <h1 class="text-4xl font-extrabold text-white text-center tracking-tight mb-4 title-font">
                    Pelayanan Profesional & Cepat
                </h1>
                <p class="text-slate-400 text-center max-w-md leading-relaxed">
                    Kelola data pelanggan, pantau stok suku cadang, dan cek nomor antrean service secara otomatis menggunakan integrasi kecerdasan buatan <span class="font-extrabold text-cyan-300 tracking-wide filter drop-shadow-[0_0_8px_rgba(34,211,238,0.4)]">Jasolu AI</span>.
                </p>
            </div>

            <!-- Bottom Note -->
            <div class="relative z-10 text-slate-500 text-sm">
                &copy; {{ date('Y') }} Jasolu Service. All rights reserved.
            </div>
        </div>

        <!-- Right Side: Login Form Panel -->
        <div class="w-full lg:w-1/2 flex items-center justify-center p-6 sm:p-12 bg-slate-950 relative overflow-hidden">
            <!-- Background Glow for Mobile -->
            <div class="absolute lg:hidden top-1/3 left-1/3 w-[300px] h-[300px] bg-blue-500 rounded-full glow-circle"></div>

            <!-- Form Container -->
            <div class="w-full max-w-md relative z-10">
                
                <!-- Logo & Heading for Mobile -->
                <div class="text-center lg:text-left mb-8">
                    <span class="inline-flex lg:hidden text-2xl font-extrabold text-white tracking-tight title-font mb-3">
                        🏍️ Jasolu Service
                    </span>
                    <h2 class="text-3xl font-bold text-white tracking-tight mb-2 title-font">
                        Selamat Datang Kembali
                    </h2>
                    <p class="text-slate-400 text-sm">
                        Silakan login untuk masuk ke dashboard kasir & bengkel.
                    </p>
                </div>

                <!-- Session Status Alert -->
                @if (session('status'))
                    <div class="mb-4 bg-emerald-950/50 border border-emerald-800 text-emerald-400 p-3 rounded-xl text-sm">
                        {{ session('status') }}
                    </div>
                @endif

                <!-- Login Card (Glassmorphism) -->
                <div class="bg-slate-900/40 backdrop-blur-xl border border-slate-900 rounded-3xl p-8 sm:p-10 shadow-2xl">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <!-- Email Address -->
                        <div class="mb-5">
                            <label for="email" class="block text-slate-300 text-sm font-semibold mb-2">
                                Alamat Email
                            </label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-slate-500">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                                    </svg>
                                </span>
                                <input id="email" 
                                       class="w-full pl-10 pr-3 py-2.5 bg-slate-950 border rounded-xl text-white placeholder-slate-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition duration-200 @error('email') border-red-500 focus:ring-red-500 @else border-slate-800 @enderror" 
                                       type="email" 
                                       name="email" 
                                       value="{{ old('email') }}" 
                                       placeholder="nama@email.com" 
                                       required autofocus autocomplete="username" />
                            </div>
                            @error('email')
                                <p class="text-red-500 text-xs mt-1.5 flex items-center gap-1">
                                    <i class="bi bi-exclamation-circle"></i> {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div class="mb-5">
                            <div class="flex justify-between items-center mb-2">
                                <label for="password" class="block text-slate-300 text-sm font-semibold mb-0">
                                    Password
                                </label>
                                @if (Route::has('password.request'))
                                    <a class="text-xs text-indigo-400 hover:text-indigo-300 text-decoration-none" href="{{ route('password.request') }}">
                                        Lupa Password?
                                    </a>
                                @endif
                            </div>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-slate-500">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                    </svg>
                                </span>
                                <input id="password" 
                                       class="w-full pl-10 pr-3 py-2.5 bg-slate-950 border rounded-xl text-white placeholder-slate-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition duration-200 @error('password') border-red-500 focus:ring-red-500 @else border-slate-800 @enderror" 
                                       type="password" 
                                       name="password" 
                                       placeholder="••••••••" 
                                       required autocomplete="current-password" />
                            </div>
                            @error('password')
                                <p class="text-red-500 text-xs mt-1.5 flex items-center gap-1">
                                    <i class="bi bi-exclamation-circle"></i> {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Remember Me -->
                        <div class="flex items-center mb-6">
                            <input id="remember_me" 
                                   type="checkbox" 
                                   class="w-4 h-4 rounded bg-slate-950 border-slate-800 text-indigo-600 focus:ring-indigo-500 focus:ring-offset-slate-900" 
                                   name="remember">
                            <label for="remember_me" class="ms-2 text-sm text-slate-400 select-none cursor-pointer">
                                Ingat Saya
                            </label>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" 
                                class="w-full py-3 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-500 hover:to-indigo-500 text-white font-bold rounded-xl shadow-lg hover:shadow-indigo-500/20 transition duration-300 border-0 flex items-center justify-center gap-2">
                            <span>Log in</span>
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13 5l7 7-7 7M5 5l7 7-7 7" />
                            </svg>
                        </button>
                    </form>
                </div>

                <!-- Footer for Mobile -->
                <div class="mt-8 text-center text-xs text-slate-600 lg:hidden relative z-10">
                    &copy; {{ date('Y') }} Jasolu Service. All rights reserved.
                </div>

            </div>
        </div>

    </div>

</body>
</html>
