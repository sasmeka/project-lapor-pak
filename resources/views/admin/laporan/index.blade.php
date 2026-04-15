@extends('layouts.adminside')

@section('title', 'Daftar Laporan')

@section('content')
<style>
    :root {
        --main-red: #1420c8;
    }
    .admin-laporan {
        font-size: 0.95rem;
    }

    .admin-laporan small,
    .admin-laporan .text-muted {
        font-size: 0.8rem;
    }

    .card-laporan {
        border: none;
        border-radius: 14px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        padding: 18px;
        margin-bottom: 18px;
        transition: 0.25s;
        background: #fff;
    }

    .card-laporan:hover {
        transform: translateY(-4px);
    }

    .badge-status {
        border-radius: 20px;
        padding: 6px 14px;
        font-size: 0.75rem;
        font-weight: 600;
        color: #fff;
    }
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

    .status-baru { background-color: #e53935; }
    .status-diproses { background-color: #fb8c00; }
    .status-selesai { background-color: #2e7d32; }

    .btn-main {
        color: #fff;
        border-radius: 8px;
        font-size: 0.8rem;
        padding: 6px 14px;
    }

    .btn-action {
        padding: 6px 12px;
        font-size: 0.8rem;
        border-radius: 6px;
    }

    .form-select-sm {
        font-size: 0.8rem;
        padding: 6px 10px;
    }

    @media (max-width: 768px) {

        .admin-laporan {
            font-size: 0.85rem;
        }

        .card-laporan {
            padding: 14px;
            word-break: break-word;
        }

        .card-laporan h5 {
            font-size: 0.95rem;
            margin-bottom: 4px;
        }

        .card-laporan small {
            display: block;
            line-height: 1.4;
        }

        /* Layout utama jadi vertical */
        .card-laporan > .d-flex {
            flex-direction: column;
            align-items: stretch !important;
            gap: 14px;
        }

        /* Kolom kanan turun ke bawah */
        .card-laporan .text-end {
            align-items: stretch !important;
            text-align: left !important;
            gap: 8px;
        }

        /* Badge status */
        .badge-status {
            width: fit-content;
            font-size: 0.7rem;
            padding: 5px 12px;
        }

        /* Form update status */
        .laporan-status-form {
            flex-direction: column;
            align-items: stretch;
            gap: 6px;
        }

        .laporan-status-form select,
        .laporan-status-form button {
            width: 100%;
            font-size: 0.75rem;
        }

        /* Tombol aksi */
        .btn-action {
            width: 100%;
            font-size: 0.75rem;
            padding: 6px 10px;
        }

        /* Deskripsi */
        .card-laporan p {
            font-size: 0.8rem;
        }

        /* Badge kategori */
        .badge-category {
            font-size: 0.65rem;
            padding: 3px 8px;
        }
    }
</style> 

<div class="admin-laporan">
<div class="container py-3">

    <form method="GET"
      action="{{ route('admin.laporan.index') }}"
      class="row g-3 align-items-end mb-4">

        {{-- SEARCH NAMA --}}
        <div class="col-lg-4 col-md-6">
            <label class="form-label">Nama Pelapor</label>
            <input type="text"
                name="nama"
                value="{{ request('nama') }}"
                class="form-control form-control-sm"
                placeholder="Cari nama pelapor...">
        </div>

        {{-- DARI TANGGAL --}}
        <div class="col-lg-3 col-md-6">
            <label class="form-label">Dari Tanggal</label>
            <input type="date"
                name="dari_tanggal"
                value="{{ request('dari_tanggal') }}"
                class="form-control form-control-sm">
        </div>

        {{-- SAMPAI TANGGAL --}}
        <div class="col-lg-3 col-md-6">
            <label class="form-label">Sampai Tanggal</label>
            <input type="date"
                name="sampai_tanggal"
                value="{{ request('sampai_tanggal') }}"
                class="form-control form-control-sm">
        </div>

        {{-- BUTTON --}}
        <div class="col-lg-2 col-md-6 d-flex gap-2">
            <button class="btn btn-primary btn-sm w-100">
                <i class="bi bi-funnel"></i> Filter
            </button>

            <a href="{{ route('admin.laporan.index') }}"
            class="btn btn-secondary btn-sm w-100">
                Reset
            </a>
        </div>
    </form>

    <form method="GET" class="mb-3 d-flex gap-2 flex-wrap">

    <input type="hidden" name="nama" value="{{ request('nama') }}">
    <input type="hidden" name="dari_tanggal" value="{{ request('dari_tanggal') }}">
    <input type="hidden" name="sampai_tanggal" value="{{ request('sampai_tanggal') }}">

    <button name="status" value=""
        class="btn btn-sm {{ request('status') == '' ? 'btn-dark' : 'btn-outline-dark' }}">
        Semua
    </button>

    <button name="status" value="baru"
        class="btn btn-sm {{ request('status') == 'baru' ? 'btn-danger' : 'btn-outline-danger' }}">
        Baru
    </button>

    <button name="status" value="diproses"
        class="btn btn-sm {{ request('status') == 'diproses' ? 'btn-warning text-dark' : 'btn-outline-warning' }}">
        Diproses
    </button>

    <button name="status" value="selesai"
        class="btn btn-sm {{ request('status') == 'selesai' ? 'btn-success' : 'btn-outline-success' }}">
        Selesai
    </button>

</form>


    {{-- ALERT --}}
    @if(session('error'))
        <div class="alert alert-warning alert-dismissible fade show">
            <i class="bi bi-exclamation-triangle"></i>
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @forelse ($laporans as $laporan)
        <div class="card-laporan">
            <div class="d-flex justify-content-between flex-wrap align-items-start">

                <div class="me-3">
                    <h5 class="mb-1">{{ $laporan->title }}</h5>
                    <small class="text-muted">
                        {{ $laporan->user->name }} •
                        {{ \Carbon\Carbon::parse($laporan->tgl_pengaduan)->translatedFormat('d F Y') }} •
                        {{ $laporan->location }}
                    </small>
                    <div class="mt-2">
                        <span class="badge-category">
                            {{ $laporan->category }}
                        </span>
                    </div>
                    <p class="text-muted mt-2 mb-0">
                        {{ Str::limit($laporan->description, 120) }}
                    </p>
                </div>

                <div class="text-end d-flex flex-column align-items-end gap-2">

                    {{-- BADGE STATUS --}}
                    @if($laporan->trashed())
                        <span class="badge bg-secondary">Terhapus</span>
                    @else
                        <span class="badge-status
                            @if($laporan->status == 'baru') status-baru
                            @elseif($laporan->status == 'diproses') status-diproses
                            @else status-selesai
                            @endif">
                            {{ ucfirst($laporan->status) }}
                        </span>
                    @endif


                    {{-- UPDATE STATUS (HANYA DATA AKTIF) --}}
                    @if(!$laporan->trashed() && in_array(Auth::user()->role, ['admin','superAdmin']))
                        <form action="{{ route('admin.laporan.updateStatus', $laporan->id) }}"
                            method="POST"
                            class="d-flex align-items-center gap-2 laporan-status-form"
                            data-status="{{ $laporan->status }}">
                            @csrf
                            @method('PATCH')

                            <select name="status"
                                    class="form-select form-select-sm laporan-status-select pe-5">
                                <option value="baru" {{ $laporan->status == 'baru' ? 'selected' : '' }}>Baru</option>
                                <option value="diproses" {{ $laporan->status == 'diproses' ? 'selected' : '' }}>Diproses</option>
                                <option value="selesai" {{ $laporan->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                            </select>

                            <button class="btn btn-primary btn-main">Update</button>
                        </form>
                    @endif

                    <a href="{{ route('admin.laporan.show', $laporan->id) }}" class="btn btn-warning btn-action">
                        <i class="bi bi-eye"></i> Detail
                    </a>


                    {{-- AKSI DATA TERHAPUS (SUPER ADMIN) --}}
                    @if(Auth::user()->role === 'superAdmin' && $laporan->trashed())

                        <form action="{{ route('admin.laporan.restore', $laporan->id) }}"
                            method="POST">
                            @csrf
                            <button class="btn btn-success btn-action">
                                <i class="bi bi-arrow-counterclockwise"></i> Pulihkan
                            </button>
                        </form>

                        <form action="{{ route('admin.laporan.forcedelete', $laporan->id) }}"
                            method="POST"
                            onsubmit="return confirm('Hapus permanen laporan ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-action">
                                <i class="bi bi-trash3"></i> Hapus Permanen
                            </button>
                        </form>

                    {{-- AKSI DATA AKTIF --}}
                   @elseif(Auth::user()->role === 'superAdmin')

                        <form action="{{ route('admin.laporan.destroy', $laporan->id) }}"
                            method="POST"
                            onsubmit="return confirm('Yakin ingin menghapus laporan ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-action">
                                <i class="bi bi-trash"></i> Hapus
                            </button>
                        </form>

                    @endif
                </div>


            </div>
        </div>
    @empty
        <div class="card-laporan text-center py-5">
            <i class="bi bi-inbox fs-2 text-muted mb-2"></i>
            <h6 class="fw-bold text-muted mb-1">Belum ada laporan</h6>
            <small class="text-muted">Tidak ada laporan yang dibuat oleh user.</small>
        </div>
    @endforelse

    <div class="d-flex justify-content-between align-items-center mt-3 flex-wrap gap-2">

        @php
            $currentPage = $laporans->currentPage();
            $totalPages = $laporans->lastPage();
        @endphp

        <small class="text-muted">
            Menampilkan {{ $currentPage }} dari {{ $totalPages }} halaman
        </small>

        {{ $laporans->links('vendor.pagination.bootstrap-5') }}

    </div>

    

</div>
</div>

{{-- SCRIPT --}}
<script>
document.querySelectorAll('.laporan-status-select').forEach(select => {
    select.addEventListener('change', function () {
        const form = this.closest('.laporan-status-form')
        const currentStatus = form.dataset.status

        if (currentStatus === 'selesai') {
            alert('Status tidak dapat diubah')
            this.value = 'selesai'
        }
    })
})
</script>
@endsection
