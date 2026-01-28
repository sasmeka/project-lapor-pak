@extends('layouts.app')

@section('title', 'Buat Pengaduan')

@section('content')

<style>
.text-main {
    color: #d32f2f;
}

.card-dashboard {
    border: none;
    border-radius: 14px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.08);
}

.btn-main {
    background-color: #d32f2f;
    color: #fff;
    border-radius: 8px;
    font-size: 0.85rem;
    padding: 7px 14px;
}

.btn-main:hover {
    background-color: #b71c1c;
    color: #fff;
}

/* PAGE SCALE */
.pengaduan-create {
    font-size: 0.9rem;
}

.pengaduan-create h2 {
    font-size: 1.45rem;
}

.pengaduan-create small,
.pengaduan-create .text-muted {
    font-size: 0.8rem;
}

.pengaduan-create label {
    font-size: 0.85rem;
}

.pengaduan-create .form-control,
.pengaduan-create .form-select {
    font-size: 0.85rem;
    border-radius: 8px;
}

/* BUTTON */
.btn-secondary-light {
    font-size: 0.8rem;
    padding: 6px 12px;
    border-radius: 8px;
}

/* MOBILE*/
@media (max-width: 768px) {
    .pengaduan-create {
        font-size: 0.8rem;
    }

    .pengaduan-create h2 {
        font-size: 1.15rem;
    }

    .pengaduan-create label {
        font-size: 0.8rem;
    }

    .pengaduan-create .form-control,
    .pengaduan-create .form-select {
        font-size: 0.8rem;
    }

    .btn-main {
        font-size: 0.75rem;
        padding: 6px 12px;
    }

    .btn-secondary-light {
        font-size: 0.75rem;
        padding: 6px 10px;
    }
}
</style>

<div class="pengaduan-create">

    <!-- HEADER -->
    <header class="navbar mb-4">
        <div>
            <h2 class="fw-bold text-black mb-0">
                Buat Laporan
            </h2>
            <small class="text-muted">
                Silakan isi formulir pengaduan dengan data yang benar.
            </small>
        </div>
    </header>

    <div class="container">
        <div class="card card-dashboard">
            <div class="card-body p-4">

                <form action="{{ route('pengaduan.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    {{-- JUDUL --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold">
                            Judul Laporan
                        </label>
                        <input type="text"
                               name="title"
                               class="form-control"
                               placeholder="Contoh: Lampu jalan mati"
                               required>
                    </div>

                    {{-- KATEGORI --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold">
                            Kategori
                        </label>
                        <select name="category" class="form-select" required>
                            <option value="" disabled selected>
                                -- Pilih Klasifikasi --
                            </option>
                            <option value="Pengaduan">Pengaduan</option>
                            <option value="Aspirasi">Aspirasi</option>
                            <option value="Administrasi">Administrasi</option>
                            <option value="Lainnya">Lainnya</option>
                        </select>
                    </div>

                    {{-- TANGGAL --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold">
                            Tanggal Kejadian
                        </label>
                        <input type="date"
                               name="tgl_pengaduan"
                               class="form-control"
                               required>
                    </div>

                    {{-- LOKASI --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold">
                            Lokasi Kejadian
                        </label>
                        <input type="text"
                               name="location"
                               class="form-control"
                               placeholder="Contoh: Jl. Mawar RT 01 RW 07"
                               required>
                    </div>

                    {{-- DESKRIPSI --}}
                    <div class="mb-4">
                        <label class="form-label fw-semibold">
                            Deskripsi Laporan
                        </label>
                        <textarea name="description"
                                  class="form-control"
                                  rows="4"
                                  placeholder="Jelaskan detail kejadian..."
                                  required></textarea>
                    </div>

                    {{-- FOTO --}}
                    <div class="mb-4">
                        <label class="form-label fw-semibold">
                            Foto Pendukung <span class="text-muted">(Opsional)</span>
                        </label>
                        
                        <input type="file"
                            name="foto"
                            class="form-control"
                            accept="image/*"
                            onchange="previewImage(event)">

                        <small class="text-muted">
                            Maksimal akan otomatis dikompres menjadi 200KB oleh sistem.
                        </small>

                        {{-- PREVIEW --}}
                        <div class="mt-3">
                            <img id="preview"
                                src="#"
                                alt="Preview Foto"
                                class="img-fluid rounded shadow-sm d-none"
                                style="max-height: 200px;">
                        </div>
                    </div>


                    {{-- ACTION --}}
                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('dashboard') }}"
                           class="btn btn-light btn-secondary-light">
                            Batal
                        </a>

                        <button type="submit" class="btn btn-main">
                            <i class="bi bi-send me-1"></i> Kirim
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>

<script>
    function previewImage(event) {
        const input = event.target;
        const preview = document.getElementById('preview');

        if (input.files && input.files[0]) {
            preview.src = URL.createObjectURL(input.files[0]);
            preview.classList.remove('d-none');
        }
    }
</script>


@endsection
