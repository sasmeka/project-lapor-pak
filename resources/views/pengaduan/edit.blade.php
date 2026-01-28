@extends('layouts.app')

@section('title', 'Edit Pengaduan')

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


.pengaduan-edit {
    font-size: 0.9rem;
}

.pengaduan-edit h2 {
    font-size: 1.45rem;
}

.pengaduan-edit small,
.pengaduan-edit .text-muted {
    font-size: 0.8rem;
}

.pengaduan-edit label {
    font-size: 0.85rem;
}

.pengaduan-edit .form-control,
.pengaduan-edit .form-select {
    font-size: 0.85rem;
    border-radius: 8px;
}

/* BUTTON*/
.btn-secondary-light {
    font-size: 0.8rem;
    padding: 6px 12px;
    border-radius: 8px;
}

/* MOBILE*/
@media (max-width: 768px) {
    .pengaduan-edit {
        font-size: 0.8rem;
    }

    .pengaduan-edit h2 {
        font-size: 1.15rem;
    }

    .pengaduan-edit label {
        font-size: 0.8rem;
    }

    .pengaduan-edit .form-control,
    .pengaduan-edit .form-select {
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

<div class="pengaduan-edit">

    <!-- HEADER -->
    <header class="navbar mb-4">
        <div>
            <h2 class="fw-bold text-black mb-0">
                Edit Pengaduan
            </h2>
            <small class="text-muted">
                Perbarui data pengaduan Anda.
            </small>
        </div>
    </header>

    <div class="container">
        <div class="card card-dashboard">
            <div class="card-body p-4">

                <form action="{{ route('pengaduan.update', $pengaduan->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    {{-- JUDUL --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold">
                            Judul Pengaduan
                        </label>
                        <input type="text"
                               name="title"
                               class="form-control"
                               value="{{ old('title', $pengaduan->title) }}"
                               required>
                    </div>

                    {{-- KATEGORI --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold">
                            Kategori
                        </label>
                        <select name="category" class="form-select" required>
                            @php
                                $kategori = old('category', $pengaduan->category);
                            @endphp
                            <option value="Pengaduan" {{ $kategori == 'Pengaduan' ? 'selected' : '' }}>
                                Pengaduan
                            </option>
                            <option value="Aspirasi" {{ $kategori == 'Aspirasi' ? 'selected' : '' }}>
                                Aspirasi
                            </option>
                            <option value="Administrasi" {{ $kategori == 'Administrasi' ? 'selected' : '' }}>
                                Administrasi
                            </option>
                            <option value="Lainnya" {{ $kategori == 'Lainnya' ? 'selected' : '' }}>
                                Lainnya
                            </option>
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
                               value="{{ old('tgl_pengaduan', $pengaduan->tgl_pengaduan) }}"
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
                               value="{{ old('location', $pengaduan->location) }}"
                               required>
                    </div>

                    {{-- DESKRIPSI --}}
                    <div class="mb-4">
                        <label class="form-label fw-semibold">
                            Deskripsi Pengaduan
                        </label>
                        <textarea name="description"
                                  class="form-control"
                                  rows="4"
                                  required>{{ old('description', $pengaduan->description) }}</textarea>
                    </div>

                    {{-- ACTION --}}
                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('pengaduan.index') }}"
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
