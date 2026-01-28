@extends('layouts.adminside')

@section('title', 'Profile Admin')

@section('content')
<style>
.card-profile {
    background: #fff;
    border: none;
    border-radius: 14px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.08);
    padding: 20px;
    margin-bottom: 20px;
    transition: 0.3s;
}

.card-profile:hover {
    transform: translateY(-4px);
}

.profile-label {
    font-size: 0.85rem;
    font-weight: 600;
    color: #6c757d;
    margin-bottom: 2px;
}

.profile-value {
    font-size: 0.95rem;
    font-weight: 600;
    color: #212529;
}

@media (max-width: 768px) {
    .card-profile {
        padding: 14px;
    }

    .profile-value {
        font-size: 0.85rem;
    }
}
</style>

<div class="container py-3">

    <div class="card-profile">
        <div class="mb-3">
            <div class="profile-label">Nama</div>
            <div class="profile-value">{{ auth()->user()->name }}</div>
        </div>

        <div class="mb-3">
            <div class="profile-label">Email</div>
            <div class="profile-value">{{ auth()->user()->email }}</div>
        </div>

        <div>
            <div class="profile-label">Role</div>
            <div class="profile-value">{{ auth()->user()->role }}</div>
        </div>
    </div>

</div>
@endsection
