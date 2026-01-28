@extends('layouts.adminside')

@section('title', 'Daftar Admin')

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

.status-active { background-color: #2e7d32; }
.status-inactive { background-color: #c62828; }

.btn-action {
    padding: 7px 14px;
    font-size: 0.85rem;
    border-radius: 6px;
}

@media (max-width: 768px) {
    .card-user { padding: 12px; }
    .btn-action { font-size: 0.65rem; padding: 4px 6px; }
    .badge-status { font-size: 0.65rem; padding: 4px 10px; }
}
</style>

<div class="container py-4">

    <div class="d-flex justify-content-start mb-3">
        <a href="{{ route('admin.admins.create') }}" class="btn btn-primary">
            <i class="bi bi-person-plus"></i> Tambah Admin
        </a>
    </div>

    @forelse ($admins as $admin)
        <div class="card-user">
            <div class="d-flex justify-content-between flex-wrap align-items-start">

                <div>
                    <h5 class="fw-bold mb-1">{{ $admin->name }}</h5>
                    <small class="text-muted d-block">Email: {{ $admin->email }}</small>
                    <small class="text-muted d-block mt-1">Role: {{ $admin->role }}</small>
                </div>

                <div class="text-end d-flex flex-column align-items-end gap-2">
                    <span class="badge-status {{ $admin->is_active ? 'status-active' : 'status-inactive' }}">
                        {{ $admin->is_active ? 'Aktif' : 'Nonaktif' }}
                    </span>

                    <div class="d-flex gap-2">
                        <a href="{{ route('admin.admins.edit', $admin->id) }}"
                           class="btn btn-warning btn-action">
                            <i class="bi bi-pencil"></i> Edit
                        </a>

                        <form action="{{ route('admin.admins.toggle', $admin->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button class="btn btn-action {{ $admin->is_active ? 'btn-danger' : 'btn-success' }}">
                                <i class="bi {{ $admin->is_active ? 'bi-lock' : 'bi-unlock' }}"></i>
                            </button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    @empty
        <div class="card-user text-center p-5">
            <i class="bi bi-shield-lock fs-1 text-muted mb-3"></i>
            <h5 class="fw-bold text-muted">Belum ada admin</h5>
        </div>
    @endforelse

</div>
@endsection
