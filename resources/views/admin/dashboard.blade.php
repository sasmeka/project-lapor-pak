@extends('layouts.adminside')

@section('title', 'Dashboard Admin')

@section('content')
<style>
    :root {
        --main-blue: #0d6efd;
    }

    body {
        background-color: #f5f7fb;
    }

    .admin-dashboard {
        font-size: 0.95rem;
    }

    .admin-dashboard small,
    .admin-dashboard .text-muted {
        font-size: 0.8rem;
    }

    .card-stat {
        border: none;
        border-radius: 16px;
        box-shadow: 0 6px 14px rgba(0,0,0,0.08);
        transition: .25s;
        background: #fff;
    }

    .card-stat:hover {
        transform: translateY(-4px);
    }

    .icon-box {
        width: 44px;
        height: 44px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        color: #fff;
    }

    .bg-blue {
        background: linear-gradient(135deg, #0d6efd, #4dabf7);
    }

    .card-stat h5 {
        font-size: 1.25rem;
        font-weight: 700;
        margin-bottom: 0;
    }

    .activity-item {
        padding: 10px 0;
        border-bottom: 1px solid #eee;
    }

    .activity-item:last-child {
        border-bottom: none;
    }

    .activity-item .fw-semibold {
        font-size: 0.9rem;
    }

    @media (max-width: 768px) {
        .admin-dashboard {
            font-size: 0.85rem;
        }

        .icon-box {
            width: 38px;
            height: 38px;
            font-size: 17px;
        }

        .card-stat h5 {
            font-size: 1.1rem;
        }
    }
</style>

<div class="admin-dashboard">
<div class="container-fluid px-0">

    <div class="row g-4 mb-4">

        <div class="col-12 col-md-3">
            <div class="card card-stat p-4">
                <div class="d-flex align-items-center gap-3">
                    <div class="icon-box bg-blue">
                        <i class="bi bi-people"></i>
                    </div>
                    <div>
                        <small class="text-muted">Total User</small>
                        <h5>{{ $totalUser ?? 0 }}</h5>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-3">
            <div class="card card-stat p-4">
                <div class="d-flex align-items-center gap-3">
                    <div class="icon-box bg-primary">
                        <i class="bi bi-file-earmark-text"></i>
                    </div>
                    <div>
                        <small class="text-muted">Pengaduan Baru</small>
                        <h5>{{ $baru ?? 0 }}</h5>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-3">
            <div class="card card-stat p-4">
                <div class="d-flex align-items-center gap-3">
                    <div class="icon-box bg-info">
                        <i class="bi bi-arrow-repeat"></i>
                    </div>
                    <div>
                        <small class="text-muted">Diproses</small>
                        <h5>{{ $diproses ?? 0 }}</h5>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-3">
            <div class="card card-stat p-4">
                <div class="d-flex align-items-center gap-3">
                    <div class="icon-box bg-success">
                        <i class="bi bi-check-circle"></i>
                    </div>
                    <div>
                        <small class="text-muted">Selesai</small>
                        <h5>{{ $selesai ?? 0 }}</h5>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="row">
        <div class="col-12 col-md-8">
            <div class="card card-stat p-4">
                <h6 class="fw-bold mb-3">Aktivitas Admin</h6>

                @forelse ($activities ?? [] as $activity)
                    <div class="activity-item">
                        <div class="fw-semibold">{{ $activity->judul }}</div>
                        <small class="text-muted">{{ $activity->created_at->diffForHumans() }}</small>
                    </div>
                @empty
                    <p class="text-muted mb-0">Belum ada aktivitas admin.</p>
                @endforelse

            </div>
        </div>
    </div>

</div>
</div>
@endsection
