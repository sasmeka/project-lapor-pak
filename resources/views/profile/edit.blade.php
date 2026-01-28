@extends('layouts.app')

@section('title', 'Edit Profil')

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

.form-control,
textarea.form-control {
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
            <h2 class="mb-0">Edit Profil</h2>
            <small class="text-muted">Perbarui data akun Anda</small>
        </div>
    </header>

    <div class="container px-0">
        <div class="card card-dashboard p-4">

            <form action="{{ route('profile.update') }}" method="POST">
                @csrf
                @method('PATCH')

                <div class="mb-3">
                    <label class="form-label">Nama</label>
                    <input type="text" name="name" class="form-control"
                        value="{{ old('name', $user->name) }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control"
                        value="{{ old('email', $user->email) }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">No. Telepon</label>
                    <input type="text" name="phone" class="form-control"
                        value="{{ old('phone', $user->phone) }}">
                </div>

                <div class="mb-4">
                    <label class="form-label">Alamat</label>
                    <textarea name="alamat" class="form-control" rows="3">{{ old('alamat', $user->alamat) }}</textarea>
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
