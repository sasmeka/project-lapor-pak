@extends('layouts.adminside')

@section('title', 'Detail Laporan')

@section('content')

<style>
:root {
    --main-blue: #0d6efd;
    --soft-blue: #eef2ff;
}

.admin-detail { font-size: 0.9rem; }

/* CARD */
.card-detail {
    border: none;
    border-radius: 16px;
    box-shadow: 0 6px 16px rgba(0,0,0,0.06);
}

/* JUDUL ATAS */
.page-title {
    font-weight: 700;
    font-size: 1.3rem;
    margin-bottom: 2px;
}

.page-subtitle {
    font-size: 0.85rem;
    color: #777;
    margin-bottom: 16px;
}

/* LABEL */
.form-label {
    font-size: 0.75rem;
    font-weight: 600;
    color: #777;
    margin-bottom: 4px;
    text-transform: uppercase;
    letter-spacing: .5px;
}

/* FIELD LOOK */
.form-control,
textarea {
    font-size: 0.85rem;
    border-radius: 10px;
    background: #f8f9fa;
    border: none;
}

/* BADGE KATEGORI */
.badge-category {
    border: 1px solid var(--main-blue);
    color: var(--main-blue);
    border-radius: 14px;
    padding: 4px 12px;
    font-size: 0.7rem;
    font-weight: 600;
    background: #fff;
}

/* STATUS BADGE */
.status-badge {
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 600;
}

.status-baru { background: #e3f2fd; color: #1565c0; }
.status-diproses { background: #fff8e1; color: #ef6c00; }
.status-selesai { background: #e8f5e9; color: #2e7d32; }

/* FOTO */
.foto-box {
    padding: 10px;
    border-radius: 14px;
    text-align: center;
}

.foto-box img {
    max-height: 240px;
    object-fit: cover;
    border-radius: 12px;
}

/* BUTTON */
.btn-back {
    font-size: 0.8rem;
    padding: 7px 16px;
    border-radius: 10px;
}
</style>

<div class="admin-detail py-3">

    <div class="card card-detail">
        <div class="card-body p-4">

            <div class="row">
                {{-- KIRI --}}
                <div class="col-md-6">

                    <div class="mb-3">
                        <label class="form-label">Judul Laporan</label>
                        <input type="text" class="form-control" value="{{ $laporan->title }}" readonly>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Kategori</label>
                        <div class="mt-1">
                            <span class="badge-category">{{ $laporan->category }}</span>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tanggal Kejadian</label>
                        <input type="text" class="form-control"
                               value="{{ \Carbon\Carbon::parse($laporan->tgl_pengaduan)->translatedFormat('d F Y') }}" readonly>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Lokasi</label>
                        <input type="text" class="form-control" value="{{ $laporan->location }}" readonly>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Pelapor</label>
                        <input type="text" class="form-control" value="{{ $laporan->user->name }}" readonly>
                    </div>

                </div>

                {{-- KANAN --}}
                <div class="col-md-6">

                    <div class="mb-3">
                        <label class="form-label">Status</label><br>
                        <span class="status-badge status-{{ $laporan->status }}">
                            {{ ucfirst($laporan->status) }}
                        </span>
                    </div>

                    <div class="mt-3">
                        <label class="form-label">Deskripsi Laporan</label>
                        <textarea class="form-control" rows="4" readonly>{{ $laporan->description }}</textarea>
                    </div>

                    @if($laporan->foto)
                    <div class="mb-3">
                        <label class="form-label">Foto Bukti</label>
                        <div class="foto-box">
                            <img src="{{ asset('storage/'.$laporan->foto) }}" class="img-fluid">
                        </div>
                    </div>
                    @endif

                </div>
            </div>

            <div class="d-flex justify-content-end mt-4">
                <a href="{{ route('admin.laporan.index') }}" class="btn btn-primary btn-back">
                    Kembali
                </a>
            </div>

        </div>
    </div>
</div>

@endsection
