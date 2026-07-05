<h1>Dashboard Bengkel Motor</h1>

<h3>Selamat Datang, {{ $nama }}</h3>

<h4>Daftar Merk Motor</h4>

<ul>
    @foreach($motor as $m)
    <li>{{ $m }}</li>
    @endforeach
</ul>