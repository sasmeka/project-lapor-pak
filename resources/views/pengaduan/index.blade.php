@extends('layouts.app')

@section('title', 'Laporan Saya')

@section('content')

<style>
:root {
    --main-red: #d32f2f;
    --main-red-dark: #b71c1c;
}

.laporan-page {
    font-size: 0.9rem;
}

.laporan-page small,
.laporan-page .text-muted {
    font-size: 0.8rem;
}


.card-laporan {
    border: none;
    border-radius: 14px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.08);
    padding: 14px;
    margin-bottom: 16px;
    background: #fff;
    transition: 0.25s;
}

.card-laporan:hover {
    transform: translateY(-3px);
}

/* TITLE & TEXT */
.card-laporan h5 {
    font-size: 1rem;
    font-weight: 700;
    margin-bottom: 2px;
}

.card-laporan p {
    font-size: 0.85rem;
    margin-bottom: 0;
}

/* BADGE STATUS */
.badge-status {
    border-radius: 14px;
    padding: 4px 10px;
    font-size: 0.7rem;
    font-weight: 600;
    color: #fff;
}

.status-baru { background-color: #e53935; }
.status-diproses { background-color: #fb8c00; }
.status-selesai { background-color: #2e7d32; }

/* BADGE CATEGORY */
.badge-category {
    border: 1px solid var(--main-red);
    color: var(--main-red);
    border-radius: 14px;
    padding: 3px 10px;
    font-size: 0.7rem;
    font-weight: 600;
    background: #fff;
}

/* BUTTON */
.btn-main {
    background-color: var(--main-red);
    color: #fff;
    border-radius: 8px;
    font-size: 0.8rem;
    padding: 6px 12px;
}

.btn-main:hover {
    background-color: var(--main-red-dark);
}

.btn-action {
    padding: 5px 10px;
    font-size: 0.75rem;
    border-radius: 6px;
}

.btn-action i {
    font-size: 0.75rem;
}

/*RESPONSIVE */
@media (max-width: 768px) {
    .laporan-page {
        font-size: 0.8rem;
    }

    .card-laporan {
        padding: 12px;
    }

    .btn-action {
        padding: 4px 8px;
        font-size: 0.7rem;
    }

    .badge-status,
    .badge-category {
        font-size: 0.65rem;
    }
}
</style>

<div class="laporan-page">

    <div class="container-fluid px-0">

        <!-- HEADER -->
        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
            <div>
                <h4 class="fw-bold mb-0">Laporan Saya</h4>
                <small class="text-muted">
                    Daftar laporan yang telah kamu buat
                </small>
            </div>

            <a href="{{ route('pengaduan.create') }}" class="btn btn-main">
                <i class="bi bi-plus-lg me-1"></i> Buat Pengaduan
            </a>
        </div>

        <!-- FILTER TANGGAL DIBUAT -->
        <form method="GET" action="{{ route('pengaduan.index') }}" class="mb-4">
            <div class="row g-2 align-items-end">

                <div class="col-md-4">
                    <label class="form-label small">Dari Tanggal Dibuat</label>
                    <input type="date"
                        name="from"
                        value="{{ request('from') }}"
                        class="form-control form-control-sm">
                </div>

                <div class="col-md-4">
                    <label class="form-label small">Sampai Tanggal Dibuat</label>
                    <input type="date"
                        name="to"
                        value="{{ request('to') }}"
                        class="form-control form-control-sm">
                </div>

                <div class="col-md-4 d-flex gap-2">
                    <button class="btn btn-main btn-sm w-100">
                        <i class="bi bi-funnel"></i> Filter
                    </button>

                    <a href="{{ route('pengaduan.index') }}"
                    class="btn btn-secondary btn-sm w-100">
                        Reset
                    </a>
                </div>

            </div>
        </form>


        <!-- LIST LAPORAN -->
        @forelse ($pengaduan as $item)
            <div class="card-laporan">
                <div class="d-flex justify-content-between align-items-start flex-wrap gap-3">

                    <!-- KIRI -->
                    <div class="flex-grow-1">
                        <h5>{{ $item->title }}</h5>

                        <small class="text-muted">
                            {{ \Carbon\Carbon::parse($item->tgl_pengaduan)->translatedFormat('d F Y') }}
                            • {{ $item->location }}
                        </small>

                        <div class="mt-2">
                            <span class="badge-category">
                                {{ $item->category }}
                            </span>
                        </div>

                        <p class="text-muted mt-2">
                            {{ Str::limit($item->description, 100) }}
                        </p>
                    </div>

                    <!-- KANAN -->
                    <div class="text-end d-flex flex-column align-items-end gap-2">
                        <span class="badge-status
                            @if ($item->status == 'baru') status-baru
                            @elseif ($item->status == 'diproses') status-diproses
                            @else status-selesai
                            @endif">
                            {{ ucfirst($item->status) }}
                        </span>

                        <a href="{{ route('pengaduan.edit', $item->id) }}"
                           class="btn btn-warning btn-action">
                            <i class="bi bi-pencil"></i> Edit
                        </a>

                        <form action="{{ route('pengaduan.destroy', $item->id) }}"
                              method="POST"
                              onsubmit="return confirm('Yakin ingin menghapus pengaduan ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-action">
                                <i class="bi bi-trash"></i> Hapus
                            </button>
                        </form>
                    </div>

                </div>
            </div>
        @empty
            <!-- EMPTY STATE -->
            <div class="card-laporan text-center p-5">
                <i class="bi bi-inbox fs-1 text-muted mb-3"></i>
                <h6 class="fw-bold text-muted">Belum ada laporan</h6>
                <p class="text-muted mb-3">
                    Kamu belum membuat laporan pengaduan.
                </p>
                <a href="{{ route('pengaduan.create') }}" class="btn btn-main">
                    <i class="bi bi-plus-lg me-1"></i> Buat Pengaduan
                </a>
            </div>
        @endforelse

        <div class="d-flex justify-content-between align-items-center mt-3 flex-wrap gap-2">

            @php
                $currentPage = $pengaduan->currentPage();
                $totalPages = $pengaduan->lastPage();
            @endphp

            <small class="text-muted">
                Menampilkan {{ $currentPage }} dari {{ $totalPages }} halaman
            </small>

            {{ $pengaduan->links('vendor.pagination.bootstrap-5') }}


        </div>

    </div>
</div>
@endsection
