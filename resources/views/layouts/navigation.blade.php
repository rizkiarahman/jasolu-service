<nav class="navbar navbar-expand-lg bg-white border-b border-slate-100 shadow-sm py-2.5">
    <div class="container flex justify-between items-center">
        
        <!-- Logo -->
        <a class="navbar-brand font-extrabold text-slate-800 text-lg flex items-center gap-2" href="{{ route('dashboard') }}" style="font-family: 'Outfit', sans-serif;">
            <span class="text-xl">🏍️</span> Jasolu Service
        </a>

        <!-- User Menu / Profile Dropdown (On Click) -->
        @auth
        <div class="dropdown">
            <a class="text-slate-700 text-decoration-none dropdown-toggle d-flex align-items-center gap-2 hover:bg-slate-50 p-2 rounded-xl transition"
                href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                @if(Auth::user()->profile_photo)
                    <img src="{{ asset('storage/' . Auth::user()->profile_photo) }}" alt="Foto Profil" class="w-8 h-8 rounded-full object-cover shadow-sm">
                @else
                    <div class="w-8 h-8 rounded-full bg-indigo-600 text-white flex items-center justify-center font-bold text-xs uppercase shadow-sm">
                        {{ substr(Auth::user()->name, 0, 2) }}
                    </div>
                @endif
                <div class="d-flex flex-col text-start">
                    <span class="text-xs font-bold text-slate-800 leading-none">{{ Auth::user()->name }}</span>
                    <span class="text-[10px] text-slate-400 mt-0.5 leading-none capitalize font-semibold">{{ Auth::user()->role }}</span>
                </div>
            </a>

            <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg mt-2 rounded-2xl p-2 bg-white">
                <li>
                    <a class="dropdown-item rounded-xl text-xs py-2 text-slate-600 hover:bg-slate-50 flex items-center gap-2" href="{{ route('profile.edit') }}">
                        <i class="bi bi-person me-1"></i> Edit Profil
                    </a>
                </li>
                <li><hr class="dropdown-divider border-slate-100"></li>
                <li>
                    <form action="{{ route('logout') }}" method="POST" class="mb-0">
                        @csrf
                        <button type="submit" class="dropdown-item rounded-xl text-xs py-2 text-danger hover:bg-red-50 flex items-center gap-2 border-0 w-full text-start bg-transparent">
                            <i class="bi bi-box-arrow-right me-1"></i> Logout
                        </button>
                    </form>
                </li>
            </ul>
        </div>
        @endauth

    </div>
</nav>