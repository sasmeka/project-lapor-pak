@extends('layouts.app')

@section('title', 'Kegiatan RT')

@section('content')
<style>
    .user-kegiatan {
        font-size: 0.95rem;
    }

    .card-kegiatan {
        border: none;
        border-radius: 14px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        padding: 18px;
        transition: 0.25s;
        background: #fff;
        height: 100%;
    }

    .card-kegiatan:hover {
        transform: translateY(-4px);
    }

    .card-kegiatan h5 {
        font-size: 1.1rem;
        font-weight: 700;
    }

    .badge-status {
        border-radius: 20px;
        padding: 6px 14px;
        font-size: 0.75rem;
        font-weight: 600;
        color: #fff;
    }

    .status-datang { background-color: #0d6efd; }
    .status-selesai { background-color: #2e7d32; }
    .status-batal { background-color: #c62828; }

    @media (max-width: 768px) {
        .user-kegiatan {
            font-size: 0.85rem;
        }

        .card-kegiatan {
            padding: 14px;
        }

        .badge-status {
            font-size: 0.7rem;
            padding: 5px 12px;
        }
    }
</style>

<div class="user-kegiatan">
<div class="container-fluid px-0">
    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
        <div>
            <h4 class="fw-bold mb-0">Kegiatan RT</h4>
            <small class="text-muted">
                Daftar kegiatan yang diselenggarakan oleh RT
            </small>
        </div>
    </div>

    <form method="GET"
      action="{{ route('kegiatan.user') }}"
      class="row g-2 mb-4 align-items-end">

        <div class="col-md-4">
            <label class="form-label small mb-1">Dari Tanggal</label>
            <input type="date"
                name="dari_tanggal"
                value="{{ request('dari_tanggal') }}"
                class="form-control form-control-sm">
        </div>

        <div class="col-md-4">
            <label class="form-label small mb-1">Sampai Tanggal</label>
            <input type="date"
                name="sampai_tanggal"
                value="{{ request('sampai_tanggal') }}"
                class="form-control form-control-sm">
        </div>

        <div class="col-md-4 d-flex gap-2">
            <button class="btn btn-danger btn-sm w-100">
                <i class="bi bi-funnel"></i> Filter
            </button>

            <a href="{{ route('kegiatan.user') }}"
            class="btn btn-secondary btn-sm w-100">
                Reset
            </a>
        </div>
    </form>



    <div class="row g-4">
        @forelse ($kegiatans as $item)
        <div class="col-md-6 col-lg-4">
            <div class="card-kegiatan">

                <div class="d-flex justify-content-between align-items-start mb-1 flex-wrap gap-1">
                    <h5 class="text-danger mb-0">
                        {{ $item->nama_kegiatan }}
                    </h5>

                    <span class="badge-status
                        @if($item->status == 'Akan Datang') status-datang
                        @elseif($item->status == 'Selesai') status-selesai
                        @else status-batal @endif">
                        {{ $item->status }}
                    </span>
                </div>

                <small class="text-muted d-block mb-2">
                    <i class="bi bi-calendar-event"></i>
                    {{ \Carbon\Carbon::parse($item->tgl_kegiatan)->translatedFormat('d F Y') }}
                    • {{ \Carbon\Carbon::parse($item->jam_kegiatan)->format('H:i') }}
                </small>

                <p class="mb-1">
                    <i class="bi bi-geo-alt"></i>
                    {{ $item->tempat_kegiatan }}
                </p>

                <p class="text-muted small mt-2 mb-0 text-break">
                    {{ Str::limit($item->deskripsi, 120) }}
                </p>

            </div>
        </div>
        @empty
        <div class="col-12">
            <div class="card-kegiatan text-center py-5">
                <i class="bi bi-calendar-x fs-2 text-muted mb-2"></i>
                <h6 class="fw-bold text-muted mb-1">Belum ada kegiatan</h6>
                <small class="text-muted">
                    Kegiatan RT belum tersedia saat ini.
                </small>
            </div>
        </div>
        @endforelse

        <div class="d-flex justify-content-between align-items-center mt-3 flex-wrap gap-2">

            @php
                $currentPage = $kegiatans->currentPage();
                $totalPages = $kegiatans->lastPage();
            @endphp

            <small class="text-muted">
                Menampilkan {{ $currentPage }} dari {{ $totalPages }} halaman
            </small>

            {{ $kegiatans->links('vendor.pagination.bootstrap-5') }}


        </div>
    </div>

</div>
</div>
@endsection
