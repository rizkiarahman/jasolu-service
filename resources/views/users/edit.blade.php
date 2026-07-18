@extends('layouts.app')

@section('content')

<h1 class="mb-4">Edit User</h1>

<div class="card shadow-sm">
    <div class="card-header bg-warning text-white">
        Form Edit User
    </div>
    <div class="card-body">
        <form action="{{ route('users.update', $user) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- Nama --}}
            <div class="mb-3">
                <label class="form-label fw-bold">Nama Lengkap</label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $user->name) }}" required>
                @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Email --}}
            <div class="mb-3">
                <label class="form-label fw-bold">Alamat Email</label>
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $user->email) }}" required>
                @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Password --}}
            <div class="mb-3">
                <label class="form-label fw-bold">Password Baru (Opsional)</label>
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Biarkan kosong jika tidak ingin mengubah password">
                <small class="text-muted">Isi minimal 6 karakter hanya jika ingin mengganti password user.</small>
                @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Role --}}
            <div class="mb-3">
                <label class="form-label fw-bold">Role Akses</label>
                <select name="role" class="form-select @error('role') is-invalid @enderror" required>
                    <option value="admin" {{ old('role', strtolower($user->role)) == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="user" {{ old('role', strtolower($user->role)) == 'user' ? 'selected' : '' }}>User/Staff</option>
                </select>
                @error('role')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex gap-2 mt-4">
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('users.index') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </form>
    </div>
</div>

@endsection
