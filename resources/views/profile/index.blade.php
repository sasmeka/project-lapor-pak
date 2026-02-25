@extends('layouts.app')

@section('title', 'Profil Saya')

@section('content')

<style>
:root {
    --main-red: #d32f2f;
    --main-red-dark: #b71c1c;
}

.profile {
    font-size: 0.9rem;
}

.profile small,
.profile .text-muted {
    font-size: 0.8rem;
}

.text-main {
    color: var(--main-red);
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
    padding: 8px 14px;
}

.btn-main:hover {
    background-color: var(--main-red-dark);
    color: #fff;
}

.profile-header h2 {
    font-size: 1.45rem;
    font-weight: 700;
}

.profile-item label {
    font-size: 0.75rem;
    margin-bottom: 2px;
}

.profile-item h6 {
    font-size: 0.95rem;
    font-weight: 600;
}

@media (max-width: 768px) {
    .profile {
        font-size: 0.85rem;
    }

    .profile-header h2 {
        font-size: 1.2rem;
    }

    .btn-main {
        font-size: 0.8rem;
        padding: 6px 12px;
    }

    .profile-item h6 {
        font-size: 0.9rem;
    }
}
</style>

<div class="profile">

    <!-- HEADER -->
    <header class="profile-header d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="mb-0">Profil Saya</h2>
            <small class="text-muted">
                Informasi akun pengguna
            </small>
        </div>

        <div class="d-flex gap-2">
            <a href="{{ route('profile.password') }}" class="btn btn-warning">
                <i class="bi bi-key me-1"></i> Ubah Password
            </a>

            <a href="{{ route('profile.edit') }}" class="btn btn-main">
                <i class="bi bi-pencil me-1"></i> Edit Profil
            </a>
        </div>
    </header>

    <!-- CONTENT -->
    <div class="container px-0">
        <div class="card card-dashboard p-4">

            <div class="profile-item mb-3">
                <label class="text-muted">Nama</label>
                <h6>{{ $user->name }}</h6>
            </div>

            <div class="profile-item mb-3">
                <label class="text-muted">Email</label>
                <h6>{{ $user->email }}</h6>
            </div>

            <div class="profile-item mb-3">
                <label class="text-muted">No. Telepon</label>
                <h6>{{ $user->phone ?? '-' }}</h6>
            </div>

            <div class="profile-item">
                <label class="text-muted">Alamat</label>
                <h6>{{ $user->alamat ?? '-' }}</h6>
            </div>

        </div>
    </div>

</div>


@if(session('password_success'))

<!-- Modal -->
<div class="modal fade" id="passwordSuccessModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content text-center p-4" style="border-radius:14px">

            <div class="mb-3">
                <i class="bi bi-check-circle-fill text-success" style="font-size:60px;"></i>
            </div>

            <h5 class="fw-bold mb-2">Berhasil</h5>
            <p class="text-muted mb-3">
                Password berhasil diperbaharui
            </p>

            <button type="button" class="btn btn-main" data-bs-dismiss="modal">
                OK
            </button>

        </div>
    </div>
</div>

@endif

@if(session('password_success'))
<script>
window.onload = function () {
    var modalElement = document.getElementById('passwordSuccessModal');
    if (modalElement) {
        var modal = new bootstrap.Modal(modalElement);
        modal.show();
    }
};
</script>
@endif

@endsection
