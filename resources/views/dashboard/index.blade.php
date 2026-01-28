@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

<style>
:root {
    --main-red: #d32f2f;
    --main-red-dark: #b71c1c;
}

.text-main {
    color: var(--main-red);
}

.dashboard {
    font-size: 0.9rem;
}

.dashboard small,
.dashboard .text-muted {
    font-size: 0.8rem;
}

.dashboard-header h2 {
    font-size: 1.45rem;
    font-weight: 700;
}

.stat-card {
    border: none;
    border-radius: 14px;
    padding: 16px;
    background: #fff;
    box-shadow: 0 4px 10px rgba(0,0,0,0.08);
}

.stat-icon {
    width: 42px;
    height: 42px;
    border-radius: 10px;
    background-color: rgba(211,47,47,0.12);
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--main-red);
    font-size: 1.2rem;
}

.stat-value {
    font-size: 1.5rem;
    font-weight: 700;
}

.activity-card {
    border: none;
    border-radius: 14px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.08);
}

.activity-item {
    padding: 10px 0;
    border-bottom: 1px solid #eee;
}

.activity-item:last-child {
    border-bottom: none;
}

.badge-status {
    background-color: rgba(211,47,47,0.12);
    color: var(--main-red);
    font-weight: 500;
    border-radius: 14px;
    padding: 4px 10px;
    font-size: 0.7rem;
}


@media (max-width: 768px) {
    .dashboard {
        font-size: 0.8rem;
    }

    .dashboard-header h2 {
        font-size: 1.15rem;
    }

    .stat-value {
        font-size: 1.3rem;
    }

    .stat-icon {
        width: 38px;
        height: 38px;
        font-size: 1.05rem;
    }
}
</style>

<div class="dashboard">

    <!-- HEADER -->
    <div class="dashboard-header mb-4">
        <h2 class="text-black mb-0">Dashboard</h2>
        <small class="text-muted">
            Ringkasan aktivitas dan laporan
        </small>
    </div>

    <div class="container-fluid px-0">

        <!-- STATISTIC -->
        <div class="row g-3 mb-4">
            <div class="col-12 col-md-4">
                <div class="stat-card">
                    <div class="d-flex align-items-center gap-3">
                        <div class="stat-icon">
                            <i class="bi bi-file-earmark-text"></i>
                        </div>
                        <div>
                            <small class="text-muted">Total Laporan</small>
                            <div class="stat-value text-main">
                                {{ $totalLaporan }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="stat-card">
                    <div class="d-flex align-items-center gap-3">
                        <div class="stat-icon">
                            <i class="bi bi-hourglass-split"></i>
                        </div>
                        <div>
                            <small class="text-muted">Diproses</small>
                            <div class="stat-value text-main">
                                {{ $diproses }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="stat-card">
                    <div class="d-flex align-items-center gap-3">
                        <div class="stat-icon">
                            <i class="bi bi-check-circle"></i>
                        </div>
                        <div>
                            <small class="text-muted">Selesai</small>
                            <div class="stat-value text-main">
                                {{ $selesai }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ACTIVITY -->
        <div class="card activity-card p-4">
            <h5 class="fw-bold mb-3">Aktivitas Terbaru</h5>

            @forelse ($aktivitasTerbaru as $item)
                <div class="activity-item">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <strong>{{ $item->title }}</strong><br>
                            <small class="text-muted">
                                {{ $item->created_at->diffForHumans() }}
                            </small>
                        </div>
                        <span class="badge-status text-capitalize">
                            {{ $item->status }}
                        </span>
                    </div>
                </div>
            @empty
                <p class="text-muted mb-0">
                    Belum ada aktivitas.
                </p>
            @endforelse
        </div>

    </div>
</div>

@endsection
