<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jasolu Service</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
        <div class="container">
            <a class="navbar-brand" href="#">
                Jasolu Service
            </a>
            <div>
                <ul class="navbar-nav flex-row gap-3">
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('spareparts.index') }}">
                            Suku Cadang / Onderdil
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('customers.index') }}">
                            Pelanggan
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('vehicles.index') }}">
                            Kendaraan
                        </a>
                    </li>
                </ul>

            </div>

        </div>

    </nav>
    <div class="container mt-5">
        <table class="table table-striped table-hover align-middle">
            {{-- Flash Message --}}
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}

                <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert">
                </button>
            </div>
            @endif

            @yield('content')
        </table>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>