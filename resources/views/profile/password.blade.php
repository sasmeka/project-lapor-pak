@extends('layouts.app')

@section('title', 'Ubah Password')

@section('content')

<style>
:root {
    --main-red: #d32f2f;
    --main-red-dark: #b71c1c;
}

.edit-profile {
    font-size: 0.9rem;
}

.edit-profile small,
.edit-profile .text-muted {
    font-size: 0.8rem;
}

.card-dashboard {
    border: none;
    border-radius: 14px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.08);
}

.btn-main {
    background-color: var(--main-red);
    color: #fff;
    border-radius: 10px;
    font-size: 0.85rem;
    padding: 8px 16px;
}

.btn-main:hover {
    background-color: var(--main-red-dark);
    color: #fff;
}

.edit-profile h2 {
    font-size: 1.45rem;
    font-weight: 700;
}

.form-label {
    font-size: 0.8rem;
    font-weight: 600;
}

.form-control {
    font-size: 0.9rem;
    border-radius: 10px;
}

@media (max-width: 768px) {
    .edit-profile {
        font-size: 0.85rem;
    }

    .edit-profile h2 {
        font-size: 1.2rem;
    }

    .btn-main {
        font-size: 0.8rem;
        padding: 6px 14px;
    }
}
</style>

<div class="edit-profile">

    <header class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="mb-0">Ubah Password</h2>
            <small class="text-muted">Perbarui password akun Anda</small>
        </div>
    </header>

    <div class="container px-0">
        <div class="card card-dashboard p-4">

            <form action="{{ route('profile.password.update') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Password Lama</label>
                    <input type="password" name="current_password" class="form-control" required>
                    @error('current_password')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Password Baru</label>
                    <input type="password" name="new_password" class="form-control" required>
                </div>

                <div class="mb-4">
                    <label class="form-label">Konfirmasi Password Baru</label>
                    <input type="password" name="new_password_confirmation" class="form-control" required>
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('profile.index') }}" class="btn btn-light btn-sm">
                        Batal
                    </a>
                    <button type="submit" class="btn btn-main">
                        <i class="bi bi-save me-1"></i> Simpan
                    </button>
                </div>

            </form>

        </div>
    </div>

</div>

@endsection