@extends('layouts.app')

@section('content')

<h1 class="mb-4">Daftar Akun User & Staff</h1>

<a href="{{ route('users.create') }}" class="btn btn-primary btn-sm mb-3">
    Tambah User
</a>

<div class="card shadow-sm">
    <div class="card-body p-0">
        <table class="table table-striped table-hover table-bordered mb-0">
            <thead class="table-dark">
                <tr>
                    <th width="60" class="text-center">No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th width="150" class="text-center">Role</th>
                    <th width="170" class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                <tr>
                    <td class="text-center">{{ $loop->iteration + ($users->currentPage() - 1) * $users->perPage() }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td class="text-center">
                        @if(strtolower($user->role) == 'admin')
                            <span class="badge bg-danger px-3 py-2">Admin</span>
                        @else
                            <span class="badge bg-success px-3 py-2">User</span>
                        @endif
                    </td>
                    <td class="text-center">
                        <div class="d-flex gap-2 justify-content-center">
                            {{-- Tombol Edit --}}
                            <a href="{{ route('users.edit', $user) }}" class="btn btn-warning btn-sm text-white">
                                Edit
                            </a>

                            {{-- Tombol Hapus --}}
                            @if(Auth::id() !== $user->id)
                                <form action="{{ route('users.destroy', $user) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus user ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                </form>
                            @else
                                <button class="btn btn-secondary btn-sm" disabled title="Anda tidak bisa menghapus akun Anda sendiri">Hapus</button>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center py-4 text-muted">
                        Belum ada data user.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-3 d-flex justify-content-center">
    {{ $users->links() }}
</div>

@endsection