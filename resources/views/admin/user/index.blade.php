@extends('layouts.adminside')

@section('title', 'Daftar User')

@section('content')
<style>
.card-user {
    background: #fff;
    border: none;
    border-radius: 14px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.08);
    padding: 16px;
    margin-bottom: 20px;
    transition: 0.3s;
}

.card-user:hover {
    transform: translateY(-4px);
}

.badge-status {
    border-radius: 20px;
    padding: 6px 14px;
    font-size: 0.75rem;
    font-weight: 600;
    color: #fff;
}

.status-active {
    background-color: #2e7d32;
}

.status-inactive {
    background-color: #c62828;
}

.btn-action {
    padding: 7px 14px;
    font-size: 0.85rem;
    border-radius: 6px;
}

.btn-action i {
    font-size: 0.8rem;
}

@media (max-width: 768px) {
    .card-user {
        padding: 12px;
    }

    .btn-action {
        padding: 4px 6px;
        font-size: 0.65rem;
    }

    .badge-status {
        padding: 4px 10px;
        font-size: 0.65rem;
    }
}
</style>

<div class="container py-3">
    @forelse ($users as $user)
        <div class="card-user">
            <div class="d-flex justify-content-between flex-wrap align-items-start">

                <div class="me-3">
                    <h5 class="fw-bold mb-1">{{ $user->name }}</h5>

                    <small class="text-muted d-block">

                        Email: {{ $user->email }}
                    </small>

                    <small class="text-muted d-block mt-1">
                        No Telepon: {{ $user->phone ?? '-' }}
                    </small>

                    <small class="text-muted d-block mt-1">
                        Alamat: {{ $user->alamat ?? '-' }}
                    </small>
                </div> 

                <div class="text-end d-flex flex-column align-items-end gap-2">
                    <span class="badge-status {{ $user->is_active ? 'status-active' : 'status-inactive' }}">
                        {{ $user->is_active ? 'Aktif' : 'Nonaktif' }}
                    </span>

                    <form action="{{ route('admin.user.toggle', $user->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <button class="btn btn-sm btn-action {{ $user->is_active ? 'btn-danger' : 'btn-success' }}">
                            <i class="bi {{ $user->is_active ? 'bi-lock' : 'bi-unlock' }}"></i>
                            {{ $user->is_active ? 'Nonaktifkan' : 'Aktifkan' }}
                        </button>
                    </form>
                </div>

            </div>
        </div>
    @empty
        <div class="card-user text-center p-5">
            <i class="bi bi-people fs-1 text-muted mb-3"></i>
            <h5 class="fw-bold text-muted">Belum ada user</h5>
            <p class="text-muted mb-0">Data user akan muncul di sini.</p>
        </div>
    @endforelse
    <div class="d-flex justify-content-between align-items-center mt-3 flex-wrap gap-2">

            @php
                $currentPage = $users->currentPage();
                $totalPages = $users->lastPage();
            @endphp

            <small class="text-muted">
                Menampilkan {{ $currentPage }} dari {{ $totalPages }} halaman
            </small>

            {{ $users->links('vendor.pagination.bootstrap-5') }}


    </div>
</div>
@endsection
