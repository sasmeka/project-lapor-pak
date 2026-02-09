@extends('layouts.adminside')

@section('title', 'Edit Admin')

@section('content')
<div class="container py-4">
    <div class="card-user">
        <form action="{{ route('admin.admins.update', $admin->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Nama</label>
                <input type="text" name="name"
                       value="{{ $admin->name }}"
                       class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email"
                       value="{{ $admin->email }}"
                       class="form-control" required>
            </div>

            <hr>

            <small class="text-muted d-block mb-2">
                Kosongkan password jika tidak ingin mengubah
            </small>

            <div class="mb-3">
                <label class="form-label">Password Baru</label>
                <input type="password" name="password" class="form-control">
            </div>

            <div class="mb-4">
                <label class="form-label">Confirm Password</label>
                <input type="password" name="password_confirmation" class="form-control">
            </div>
            <div class="d-flex justify-content-end gap-2">
                <a href="{{ route('admin.admins.index') }}" class="btn btn-light btn-secondary-light ms-2">
                    Batal
                </a>

                <button class="btn btn-primary">
                    <i class="bi bi-save"></i> Update
                </button>

            </div>
            
        </form>
    </div>
</div>
@endsection
