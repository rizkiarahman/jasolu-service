<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow">

    <div class="container">

        {{-- Logo --}}
        <a class="navbar-brand fw-bold" href="{{ route('dashboard') }}">
            🏍 Jasolu Service
        </a>

        {{-- Profil --}}
        @auth
        <div class="dropdown ms-auto">

            <a class="text-white text-decoration-none dropdown-toggle d-flex align-items-center"
                href="#"
                data-bs-toggle="dropdown">

                <i class="bi bi-person-circle fs-3 me-2"></i>

                {{ Auth::user()->name }}

            </a>

            <ul class="dropdown-menu dropdown-menu-end">

                <li>

                    <form action="{{ route('logout') }}" method="POST">
                        @csrf

                        <button type="submit" class="dropdown-item text-danger">

                            <i class="bi bi-box-arrow-right me-2"></i>

                            Logout

                        </button>

                    </form>

                </li>

            </ul>

        </div>
        @endauth

    </div>

</nav>