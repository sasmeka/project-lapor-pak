@extends('layouts.adminside')

@section('title', 'Tambah Admin')

@section('content')

<style>
    .text-main {
        color: #0d6efd;
    }

    /* CONTAINER UTAMA */
    .admin-create {
        font-size: 0.95rem;
    }

    .admin-create h2 {
        font-size: 1.6rem;
        font-weight: 700;
    }

    .admin-create label {
        font-size: 0.9rem;
        font-weight: 600;
    }

    .admin-create small,
    .admin-create .text-muted {
        font-size: 0.85rem;
    }

    /* CARD */
    .card-dashboard {
        border: none;
        border-radius: 14px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    }

    .card-dashboard .card-body {
        padding: 24px;
    }

    /* INPUT */
    .admin-create .form-control {
        font-size: 0.9rem;
        padding: 10px 14px;
        border-radius: 8px;
    }

    /* BUTTON */
    .btn-main {
        background-color: #0d6efd;
        color: #fff;
        border-radius: 8px;
        font-size: 0.9rem;
        padding: 8px 18px;
    }

    .btn-main:hover {
        background-color: #084298;
        color: #fff;
    }

    .btn-secondary-light {
        font-size: 0.85rem;
        padding: 8px 16px;
        border-radius: 8px;
    }

    /* RESPONSIVE */
    @media (max-width: 768px) {
        .admin-create {
            font-size: 0.85rem;
        }

        .admin-create h2 {
            font-size: 1.3rem;
        }

        .admin-create .form-control {
            font-size: 0.85rem;
            padding: 8px 12px;
        }

        .btn-main {
            font-size: 0.8rem;
            padding: 7px 14px;
        }

        .btn-secondary-light {
            font-size: 0.8rem;
            padding: 7px 12px;
        }
    }
</style>

<div class="admin-create">

    <div class="container">
        <div class="card card-dashboard">
            <div class="card-body p-4">

                <form action="{{ route('admin.admins.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">
                            Nama Admin
                        </label>
                        <input type="text"
                               name="name"
                               class="form-control @error('name') is-invalid @enderror"
                               placeholder="Contoh: Admin RT 01"
                               value="{{ old('name') }}"
                               required>
                        @error('name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">
                            Email Admin
                        </label>
                        <input type="email"
                               name="email"
                               class="form-control @error('email') is-invalid @enderror"
                               placeholder="admin@email.com"
                               value="{{ old('email') }}"
                               required>
                        @error('email')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">
                            Password
                        </label>
                        <input type="password"
                               name="password"
                               class="form-control @error('password') is-invalid @enderror"
                               placeholder="Minimal 6 karakter"
                               required>
                        @error('password')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label">
                            Konfirmasi Password
                        </label>
                        <input type="password"
                               name="password_confirmation"
                               class="form-control"
                               placeholder="Ulangi password"
                               required>
                    </div>

                    {{-- INFO ROLE --}}
                    <div class="alert alert-info small">
                        <i class="bi bi-info-circle"></i>
                        Akun ini akan dibuat sebagai <strong>Admin</strong> secara default.
                    </div>

                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('admin.admins.index') }}"
                           class="btn btn-light btn-secondary-light">
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

</div>

@endsection
