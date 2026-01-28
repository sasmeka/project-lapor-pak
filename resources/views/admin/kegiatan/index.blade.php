@extends('layouts.adminside')

@section('title', 'Daftar Kegiatan')

@section('content')
<style>
    .admin-kegiatan {
        font-size: 0.95rem; /* ⬅️ NAIK dikit */
    }

    .admin-kegiatan small,
    .admin-kegiatan .text-muted {
        font-size: 0.85rem;
    }

    .admin-kegiatan .card {
        border: none;
        border-radius: 14px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        transition: 0.25s;
        background: #fff;
    }

    .admin-kegiatan .card:hover {
        transform: translateY(-4px);
    }

    .admin-kegiatan .card-body {
        padding: 16px; /* ⬅️ NAIK dikit */
    }

    .admin-kegiatan h5 {
        font-size: 1.05rem; /* ⬅️ JUDUL LEBIH JELAS */
        margin-bottom: 6px;
    }

    .admin-kegiatan p {
        font-size: 0.85rem;
        margin-bottom: 6px;
    }

    .admin-kegiatan .badge {
        font-size: 0.75rem;
        padding: 6px 14px;
        border-radius: 20px;
        font-weight: 600;
    }

    .admin-kegiatan .form-select-sm {
        font-size: 0.8rem;
        padding: 6px 10px;
    }

    .admin-kegiatan .card-footer {
        padding: 12px 16px;
        background: #fff;
        border-top: none;
    }

    .admin-kegiatan .btn-sm {
        font-size: 0.8rem;
        padding: 6px 12px;
        border-radius: 8px;
    }

    @media (max-width: 768px) {
        .admin-kegiatan {
            font-size: 0.9rem;
        }

        .admin-kegiatan h5 {
            font-size: 1rem;
        }

        .admin-kegiatan .card-footer {
            flex-direction: column;
            gap: 8px;
        }

        .admin-kegiatan .btn-sm {
            width: 100%;
        }
    }
</style>

<div class="admin-kegiatan">
<div class="container py-3">

    {{-- ALERT --}}
    @if(session('error'))
        <div class="alert alert-warning alert-dismissible fade show">
            <i class="bi bi-exclamation-triangle"></i>
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <form method="GET" action="{{ route('admin.kegiatan.index') }}" class="row g-3 mb-4">
        <div class="col-md-4">
            <label class="form-label">Dari Tanggal Dibuat</label>
            <input type="date"
                name="dari_tanggal"
                value="{{ request('dari_tanggal') }}"
                class="form-control form-control-sm">
        </div>

        <div class="col-md-4">
            <label class="form-label">Sampai Tanggal Dibuat</label>
            <input type="date"
                name="sampai_tanggal"
                value="{{ request('sampai_tanggal') }}"
                class="form-control form-control-sm">
        </div>

        <div class="col-md-4 d-flex align-items-end gap-2">
            <button class="btn btn-primary btn-sm w-100">
                <i class="bi bi-funnel"></i> Filter
            </button>

            <a href="{{ route('admin.kegiatan.index') }}"
            class="btn btn-secondary btn-sm">
                Reset
            </a>
        </div>
    </form>

    @if(request('dari_tanggal') || request('sampai_tanggal'))
        <div class="alert alert-light border small mb-3">
            Menampilkan kegiatan yang dibuat
            <strong>
                {{ request('dari_tanggal') ? 'dari ' . request('dari_tanggal') : '' }}
                {{ request('sampai_tanggal') ? ' sampai ' . request('sampai_tanggal') : '' }}
            </strong>
        </div>
    @endif



    <div class="d-flex justify-content-between align-items-center mb-3">
        <a href="{{ route('admin.kegiatan.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Tambah Kegiatan
        </a>
    </div>

    <div class="row g-3">
        @foreach ($kegiatans as $item)
        <div class="col-md-6 col-lg-4">
            <div class="card h-100">

                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-start flex-wrap gap-1">
                        <h5 class="fw-bold text-danger mb-0">
                            {{ $item->nama_kegiatan }}
                        </h5>

                        <span class="badge
                            @if($item->status == 'Akan Datang') bg-primary
                            @elseif($item->status == 'Selesai') bg-success
                            @else bg-danger @endif">
                            {{ $item->status }}
                        </span>
                    </div>

                    <p class="mt-1 mb-1">
                        <i class="bi bi-geo-alt"></i> {{ $item->tempat_kegiatan }}
                    </p>

                    <p class="mb-1">
                        <i class="bi bi-calendar-event"></i>
                        {{ \Carbon\Carbon::parse($item->tgl_kegiatan)->format('d M Y') }}
                        • {{ \Carbon\Carbon::parse($item->jam_kegiatan)->format('H:i') }}
                    </p>

                    <p class="text-muted mt-2 mb-0">
                        {{ Str::limit($item->deskripsi, 100) }}
                    </p>

                    {{-- FORM STATUS --}}
                    <form action="{{ route('admin.kegiatan.updateStatus', $item->id) }}"
                          method="POST"
                          class="mt-3 status-form"
                          data-status="{{ $item->status }}">
                        @csrf
                        @method('PATCH')

                        <select name="status"
                                class="form-select form-select-sm status-select">
                            <option {{ $item->status == 'Akan Datang' ? 'selected' : '' }}>Akan Datang</option>
                            <option {{ $item->status == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                            <option {{ $item->status == 'Batal' ? 'selected' : '' }}>Batal</option>
                        </select>
                    </form>

                </div>

                <div class="card-footer d-flex gap-2">
                    @if(in_array($item->status, ['Selesai','Batal']))
                        <button class="btn btn-sm btn-outline-secondary w-100" disabled>
                            Edit
                        </button>
                    @else
                        <a href="{{ route('admin.kegiatan.edit', $item->id) }}"
                           class="btn btn-sm btn-outline-warning w-100">
                            Edit
                        </a>
                    @endif

                    <form action="{{ route('admin.kegiatan.destroy', $item->id) }}"
                          method="POST" class="w-100">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-outline-danger w-100"
                                onclick="return confirm('Hapus kegiatan ini?')">
                            Hapus
                        </button>
                    </form>
                </div>

            </div>
        </div>
        @endforeach

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

<script>
document.querySelectorAll('.status-select').forEach(select => {
    select.addEventListener('change', function () {
        const form = this.closest('.status-form')
        const currentStatus = form.dataset.status

        if (currentStatus === 'Selesai' || currentStatus === 'Batal') {
            alert('Status tidak dapat diubah')
            this.value = currentStatus
            return
        }

        form.submit()
    })
})
</script>
@endsection
