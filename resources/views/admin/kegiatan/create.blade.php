@extends('layouts.adminside')

@section('title', 'Buat Kegiatan')

@section('content')

<style>
    .text-main {
        color: #0d6efd;
    }

    /* CONTAINER UTAMA */
    .kegiatan-create {
        font-size: 0.95rem; /* ⬅️ dibesarkan */
    }

    .kegiatan-create h2 {
        font-size: 1.6rem;
        font-weight: 700;
    }

    .kegiatan-create label {
        font-size: 0.9rem;
        font-weight: 600;
    }

    .kegiatan-create small,
    .kegiatan-create .text-muted {
        font-size: 0.85rem;
    }

    /* CARD */
    .card-dashboard {
        border: none;
        border-radius: 14px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    }

    .card-dashboard .card-body {
        padding: 24px; /* ⬅️ lebih lega */
    }

    /* INPUT */
    .kegiatan-create .form-control {
        font-size: 0.9rem;
        padding: 10px 14px;
        border-radius: 8px;
    }

    textarea.form-control {
        resize: none;
    }

    /* BUTTON */
    .btn-main {
        background-color: #0d6efd;
        color: #fff;
        border-radius: 8px;
        font-size: 0.9rem;
        padding: 8px 18px;
    }

    .btn-main:hover {
        background-color: #084298;
        color: #fff;
    }

    .btn-secondary-light {
        font-size: 0.85rem;
        padding: 8px 16px;
        border-radius: 8px;
    }

    /* RESPONSIVE */
    @media (max-width: 768px) {
        .kegiatan-create {
            font-size: 0.85rem;
        }

        .kegiatan-create h2 {
            font-size: 1.3rem;
        }

        .kegiatan-create .form-control {
            font-size: 0.85rem;
            padding: 8px 12px;
        }

        .btn-main {
            font-size: 0.8rem;
            padding: 7px 14px;
        }

        .btn-secondary-light {
            font-size: 0.8rem;
            padding: 7px 12px;
        }
    }

</style>

<div class="kegiatan-create">

    <div class="container">
        <div class="card card-dashboard">
            <div class="card-body p-4">

                <form action="{{ route('admin.kegiatan.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label fw-semibold">
                            Nama Kegiatan
                        </label>
                        <input type="text"
                               name="nama_kegiatan"
                               class="form-control"
                               placeholder="Contoh: Kerja Bakti Lingkungan"
                               required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">
                            Tempat Kegiatan
                        </label>
                        <input type="text"
                               name="tempat_kegiatan"
                               class="form-control"
                               placeholder="Contoh: Balai RT"
                               required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">
                            Jam Kegiatan
                        </label>
                        <input type="time"
                            name="jam_kegiatan"
                            class="form-control"
                            required>
                    </div>


                    <div class="mb-3">
                        <label class="form-label fw-semibold">
                            Tanggal Kegiatan
                        </label>
                        <input type="date"
                               name="tgl_kegiatan"
                               class="form-control"
                               required>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold">
                            Deskripsi Kegiatan
                        </label>
                        <textarea name="deskripsi"
                                  class="form-control"
                                  rows="4"
                                  placeholder="Jelaskan detail kegiatan..."
                                  required></textarea>
                    </div>

                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('admin.kegiatan.index') }}"
                           class="btn btn-light btn-secondary-light">
                            Batal
                        </a>

                        <button type="submit" class="btn btn-main">
                            <i class="bi bi-save me-1"></i> Simpan
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>

@endsection
