    {{-- Navbar --}}
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow">

        <div class="container">

            {{-- Logo --}}
            <a class="navbar-brand fw-bold" href="{{ route('dashboard') }}">
                🏍 Jasolu Service
            </a>

            {{-- Hamburger --}}
            <button class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbar"
                aria-controls="navbar"
                aria-expanded="false"
                aria-label="Toggle navigation">

                <span class="navbar-toggler-icon"></span>

            </button>

            <div class="collapse navbar-collapse" id="navbar">


                {{-- Profil --}}
                @auth

                <ul class="navbar-nav">

                    <li class="nav-item dropdown">

                        <a class="nav-link dropdown-toggle text-white"
                            href="#"
                            role="button"
                            data-bs-toggle="dropdown">

                            <i class="bi bi-person-circle"></i>

                            {{ Auth::user()->name }}

                        </a>

                        <ul class="dropdown-menu dropdown-menu-end shadow">

                            <li>
                                <span class="dropdown-item-text fw-bold">
                                    👋 Halo, {{ Auth::user()->name }}
                                </span>
                            </li>

                            <li>
                                <hr class="dropdown-divider">
                            </li>

                            <li>

                                <form method="POST" action="{{ route('logout') }}">

                                    @csrf

                                    <button type="submit"
                                        class="dropdown-item text-danger">

                                        <i class="bi bi-box-arrow-right"></i>

                                        Logout

                                    </button>

                                </form>

                            </li>

                        </ul>

                    </li>

                </ul>

                @endauth

            </div>

        </div>

    </nav>