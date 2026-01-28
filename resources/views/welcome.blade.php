<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LAPOR PAK! - Sistem Pengaduan Masyarakat RT 1 RW 7</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <!-- Google Fonts (Poppins) -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary-red: #D32F2F; /* Merah Indonesia */
            --dark-red: #B71C1C;
            --light-red: #ffcdd2;
            --gradient-red: linear-gradient(135deg, #D32F2F 0%, #B71C1C 100%);
            --light-gray: #f8f9fa;
        }

        .wa-bubble-container {
            position: fixed;
            bottom: 30px;
            right: 15px;
            display: flex;
            align-items: center;
            gap: 6px;
            z-index: 999999 !important;
        }

        /* Bubble putih */
        .wa-bubble {
            background: white;
            padding: 5px 5px;
            border-radius: 5px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.15);
            font-size: 15px;
            font-weight: 400;
            color: #000;
            position: relative;
            display: flex;
            align-items: center;
        }


        /* Segitiga kanan */
        .wa-bubble::after {
            content: "";
            position: absolute;
            right: -8px;
            top: 50%;
            transform: translateY(-50%);
            width: 0;
            height: 0;
            border-top: 8px solid transparent;
            border-bottom: 8px solid transparent;
            border-left: 10px solid white;
        }

        /* Ikon WA bulat */
        .wa-icon {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: #25D366;
            display: flex;
            justify-content: center;
            align-items: center;
            box-shadow: 0 4px 10px rgba(0,0,0,0.25);
        }

        .wa-icon img {
            width: 35px;
            height: 35px;
        }

        body {
            font-family: 'Poppins', sans-serif;
            overflow-x: hidden;
            color: #333;
        }

        /* --- NAVBAR STYLING --- */
        .navbar {
            box-shadow: 0 4px 20px rgba(0,0,0,0.05);
            padding: 12px 0;
            background-color: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
        }
        
        .navbar-brand {
            font-weight: 800;
            color: var(--primary-red) !important;
            font-size: 1.4rem;
            letter-spacing: 0.5px;
        }

        .nav-link {
            font-weight: 500;
            color: #555;
            margin: 0 8px;
            font-size: 0.95rem;
            transition: all 0.3s;
        }

        .nav-link:hover, .nav-link.active {
            color: var(--primary-red);
        }

        /* --- BUTTONS REFINED --- */
        .btn-custom-red {
            background: var(--gradient-red);
            color: white;
            border: none;
            padding: 8px 24px; /* Ukuran lebih compact */
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(211, 47, 47, 0.3);
        }

        .btn-custom-red:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(211, 47, 47, 0.4);
            color: white;
        }

        .btn-outline-red {
            border: 2px solid var(--primary-red);
            color: var(--primary-red);
            padding: 8px 24px; /* Ukuran lebih compact */
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            background: transparent;
        }

        .btn-outline-red:hover {
            background-color: var(--primary-red);
            color: white;
            box-shadow: 0 4px 15px rgba(211, 47, 47, 0.2);
        }

        /* --- HERO SECTION WITH DECORATION --- */
        .hero-section {
            padding-top: 140px;
            padding-bottom: 100px;
            background: #fff;
            position: relative;
            overflow: hidden;
        }

        /* Dekorasi background abstrak */
        .hero-section::before {
            content: '';
            position: absolute;
            top: -10%;
            right: -5%;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, var(--light-red) 0%, rgba(255,255,255,0) 70%);
            opacity: 0.5;
            z-index: 0;
            border-radius: 50%;
        }

        .hero-section::after {
            content: '';
            position: absolute;
            bottom: -10%;
            left: -10%;
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, #f0f0f0 0%, rgba(255,255,255,0) 70%);
            z-index: 0;
            border-radius: 50%;
        }
        
        .hero-content {
            position: relative;
            z-index: 1;
        }
        
        .hero-img {
            max-width: 100%;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
            animation: float 6s ease-in-out infinite;
            position: relative;
            z-index: 1;
        }

        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-15px); }
            100% { transform: translateY(0px); }
        }

        /* --- CARDS & ICON STYLES --- */
        .hover-card {
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            border: none;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
            background: white;
            overflow: hidden;
            position: relative;
        }

        .hover-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: var(--gradient-red);
            transform: scaleX(0);
            transition: transform 0.4s ease;
            transform-origin: left;
        }

        .hover-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        }

        .hover-card:hover::before {
            transform: scaleX(1);
        }

        .icon-box {
            width: 70px;
            height: 70px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #fff5f5 0%, #ffebee 100%);
            color: var(--primary-red);
            border-radius: 50%;
            margin-bottom: 25px;
            font-size: 1.8rem;
            transition: all 0.3s ease;
        }
        
        .hover-card:hover .icon-box {
            background: var(--gradient-red);
            color: white;
            transform: rotateY(360deg);
        }

        /* --- ALUR (Timeline) --- */
        .step-card {
            position: relative;
            z-index: 1;
            background: white;
            border-radius: 16px;
            padding: 35px 25px;
            height: 100%;
            border: 1px solid #eee;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(0,0,0,0.03);
        }

        .step-card:hover {
            border-color: transparent;
            box-shadow: 0 15px 30px rgba(211, 47, 47, 0.1);
            transform: translateY(-5px);
        }
        
        .step-number {
            font-size: 3.5rem;
            font-weight: 800;
            color: rgba(211, 47, 47, 0.05); /* Very transparent red */
            position: absolute;
            top: 10px;
            right: 20px;
            z-index: -1;
            line-height: 1;
        }

        .word-space {
            word-spacing: 3px;
        }

        @media (min-width: 992px) {
            .steps-container {
                position: relative;
            }
            .steps-container::before {
                content: '';
                position: absolute;
                top: 50px;
                left: 10%;
                right: 10%;
                height: 2px;
                background-image: linear-gradient(to right, #ddd 50%, transparent 50%);
                background-size: 20px 100%;
                z-index: 0;
            }
        }

        /* --- STATS / KEUNGGULAN (Breaking the monotony) --- */
        .stats-section {
            background: var(--gradient-red);
            color: white;
            position: relative;
            overflow: hidden;
        }

        .stats-section::before {
            content: '';
            position: absolute;
            top: 0; left: 0; width: 100%; height: 100%;
            background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }

        /* --- CTA SECTION --- */
        .cta-section {
            background: url('https://images.unsplash.com/photo-1557683316-973673baf926?auto=format&fit=crop&w=1920&q=80') no-repeat center center;
            background-size: cover;
            position: relative;
            padding: 100px 0;
            background-attachment: fixed; /* Parallax effect */
        }
        
        .cta-overlay {
            background: linear-gradient(to right, rgba(211, 47, 47, 0.95), rgba(183, 28, 28, 0.85));
            position: absolute;
            top: 0; left: 0; width: 100%; height: 100%;
        }

        /* --- FOOTER --- */
        footer {
            background-color: #1a1a1a;
            color: white;
            padding: 60px 0 30px;
        }

        /* Utilities */
        .section-padding { padding: 100px 0; }
        .text-gradient {
            background: var(--gradient-red);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        
        html { scroll-behavior: smooth; }
    </style>
</head>
<body>

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">
                <i class="bi bi-megaphone-fill me-2"></i>LAPOR PAK!
            </a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item"><a class="nav-link" href="#beranda">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link" href="#tentang">Tentang</a></li>
                    <li class="nav-item"><a class="nav-link" href="#jenis">Kategori</a></li>
                    <li class="nav-item"><a class="nav-link" href="#alur">Alur</a></li>
                    <li class="nav-item"><a class="nav-link" href="#kontak">Kontak</a></li>
                    <li class="nav-item ms-lg-3 mt-3 mt-lg-0">
                        <a href="{{ route('login') }}" class="btn btn-custom-red px-4">Masuk / Daftar</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- MAIN CONTENT -->
    <main>
        <!-- HERO SECTION -->
        <section id="beranda" class="hero-section d-flex align-items-center">
            <div class="container hero-content">
                <div class="row align-items-center">
                    <div class="col-lg-6 mb-5 mb-lg-0">
                        <div class="d-inline-flex align-items-center bg-light border border-danger border-opacity-25 rounded-pill px-3 py-2 mb-4">
                            <i class="bi bi-patch-check-fill text-danger me-2"></i>
                            <span class="text-danger fw-medium small">Sistem Resmi RT 1 RW 7</span>
                        </div>
                        <h1 class="display-4 fw-bold mb-3 text-dark lh-base">
                            Layanan Pengaduan <br>
                            <span class="text-gradient">Warga Online</span>
                        </h1>
                        <h2 class="h6 word-space text-secondary fw-normal mb-4 col-lg-10 ps-0">
                            Sampaikan aspirasi dan keluhan lingkungan Anda dengan mudah, cepat, dan transparan melalui platform digital kami.
                        </h2>
                        <div class="d-flex gap-3 flex-column flex-sm-row">
                            @guest
                                <button class="btn">
                                    <a href="{{ route('login') }}" class="btn btn-custom-red px-4 py-2 shadow">
                                    <i class="bi bi-send-fill me-2"></i> Laporkan
                                    </a>
                                </button>
                            @endguest
                        </div>
                    </div>
                    <div class="col-lg-6 text-center">
                        <img src="https://images.unsplash.com/photo-1521791136064-7986c2920216?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" 
                             alt="Ilustrasi Pelayanan Masyarakat" 
                             class="hero-img img-fluid">
                    </div>
                </div>
            </div>
        </section>
    
        <!-- TENTANG APLIKASI -->
        <section id="tentang" class="section-padding bg-white">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 mb-5 mb-lg-0 order-lg-2">
                        <div class="ps-lg-4">
                            <h6 class="text-danger fw-bold text-uppercase mb-3 tracking-wide">Tentang Aplikasi</h6>
                            <h2 class="fw-bold mb-4 display-6">Digitalisasi Layanan <br>Lingkungan Kita</h2>
                            <p class="text-secondary mb-4 lh-lg">
                                <strong>LAPOR PAK!</strong> hadir untuk memangkas birokrasi dan mempermudah komunikasi antara warga RT 1 RW 7 dengan pengurus. Kami percaya transparansi adalah kunci kerukunan warga.
                            </p>
                            <div class="row g-3">
                                <div class="col-sm-6">
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-clock-history text-danger fs-4 me-3"></i>
                                        <div>
                                            <h6 class="fw-bold mb-0">Akses 24 Jam</h6>
                                            <small class="text-muted">Kapanpun Dimanapun</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-shield-check text-danger fs-4 me-3"></i>
                                        <div>
                                            <h6 class="fw-bold mb-0">Privasi Aman</h6>
                                            <small class="text-muted">Data Terlindungi</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 order-lg-1">
                        <div class="position-relative">
                            <img src="https://images.unsplash.com/photo-1556761175-5973dc0f32e7?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" 
                                 alt="Tentang Lapor Pak" 
                                 class="img-fluid rounded-4 shadow-lg position-relative z-2">
                            <!-- Dekorasi kotak di belakang gambar -->
                            <div class="position-absolute bg-danger rounded-4 z-1" style="width: 100%; height: 100%; top: 20px; left: -20px; opacity: 0.1;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    
        <!-- JENIS PENGADUAN -->
        <section id="jenis" class="section-padding" style="background-color: #fcfcfc;">
            <div class="container">
                <div class="text-center mb-5">
                    <h6 class="text-danger fw-bold text-uppercase">Kategori</h6>
                    <h2 class="fw-bold display-6">Jenis Pengaduan</h2>
                    <p class="text-secondary col-lg-6 mx-auto">Pilih kategori yang sesuai agar laporan Anda dapat segera ditindaklanjuti oleh tim terkait.</p>
                </div>
    
                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                    <!-- Card 1 -->
                    <div class="col">
                        <div class="card hover-card h-100 p-4 text-center">
                            <div class="card-body">
                                <div class="icon-box mx-auto shadow-sm">
                                    <i class="bi bi-shield-lock-fill"></i>
                                </div>
                                <h5 class="card-title fw-bold mb-3">Keamanan</h5>
                                <p class="card-text text-secondary small">Laporan siskamling, tamu mencurigakan, atau gangguan ketertiban.</p>
                            </div>
                        </div>
                    </div>
                    <!-- Card 2 -->
                    <div class="col">
                        <div class="card hover-card h-100 p-4 text-center">
                            <div class="card-body">
                                <div class="icon-box mx-auto shadow-sm">
                                    <i class="bi bi-trash3-fill"></i>
                                </div>
                                <h5 class="card-title fw-bold mb-3">Kebersihan</h5>
                                <p class="card-text text-secondary small">Pengangkutan sampah, saluran air mampet, atau kerja bakti.</p>
                            </div>
                        </div>
                    </div>
                    <!-- Card 3 -->
                    <div class="col">
                        <div class="card hover-card h-100 p-4 text-center">
                            <div class="card-body">
                                <div class="icon-box mx-auto shadow-sm">
                                    <i class="bi bi-lamp-fill"></i>
                                </div>
                                <h5 class="card-title fw-bold mb-3">Fasilitas</h5>
                                <p class="card-text text-secondary small">Lampu jalan mati, jalan rusak, atau fasilitas umum lainnya di lingkungan RT 1 RW 7.</p>
                            </div>
                        </div>
                    </div>
                    <!-- Card 4 -->
                    <div class="col-lg-6 mx-auto">
                        <div class="card hover-card h-100 p-4 text-center">
                            <div class="card-body">
                                <div class="icon-box mx-auto shadow-sm">
                                    <i class="bi bi-file-earmark-text-fill"></i>
                                </div>
                                <h5 class="card-title fw-bold mb-3">Administrasi</h5>
                                <p class="card-text text-secondary small">Surat pengantar, KTP/KK, dan kebutuhan dokumen kependudukan.</p>
                            </div>
                        </div>
                    </div>
                    <!-- Card 5 -->
                    <div class="col-lg-6 mx-auto">
                        <div class="card hover-card h-100 p-4 text-center">
                            <div class="card-body">
                                <div class="icon-box mx-auto shadow-sm">
                                    <i class="bi bi-chat-heart-fill"></i>
                                </div>
                                <h5 class="card-title fw-bold mb-3">Aspirasi</h5>
                                <p class="card-text text-secondary small">Usulan program kerja atau ide kreatif untuk kemajuan RT.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- KEUNGGULAN (Stats/Feature) - BREAK THE MONOTONY -->
        <section class="section-padding stats-section">
            <div class="container position-relative z-1">
                <div class="row text-center">
                    <div class="col-md-3 mb-5 mb-md-0">
                        <div class="display-4 fw-bold mb-2"><i class="bi bi-lightning-charge-fill"></i></div>
                        <h4 class="fw-bold">Respon Cepat</h4>
                        <p class="text-white-50">Tindak lanjut segera</p>
                    </div>
                    <div class="col-md-3 mb-5 mb-md-0">
                        <div class="display-4 fw-bold mb-2"><i class="bi bi-eye-fill"></i></div>
                        <h4 class="fw-bold">Transparan</h4>
                        <p class="text-white-50">Pantau progres laporan</p>
                    </div>
                    <div class="col-md-3 mb-5 mb-md-0">
                        <div class="display-4 fw-bold mb-2"><i class="bi bi-archive-fill"></i></div>
                        <h4 class="fw-bold">Terdata</h4>
                        <p class="text-white-50">Arsip digital rapi</p>
                    </div>
                    <div class="col-md-3">
                        <div class="display-4 fw-bold mb-2"><i class="bi bi-emoji-smile-fill"></i></div>
                        <h4 class="fw-bold">Mudah</h4>
                        <p class="text-white-50">User friendly</p>
                    </div>
                </div>
            </div>
        </section>
    
        <!-- ALUR PENGADUAN -->
        <section id="alur" class="section-padding bg-white">
            <div class="container">
                <div class="text-center mb-5">
                    <h6 class="text-danger fw-bold text-uppercase">Workflow</h6>
                    <h2 class="fw-bold display-6">Alur Penyelesaian</h2>
                </div>
                
                <div class="row g-4 steps-container">
                    <div class="col-md-6 col-lg-3">
                        <div class="step-card bg-white">
                            <span class="step-number">01</span>
                            <div class="mb-4 text-danger bg-danger bg-opacity-10 d-inline-block p-3 rounded-circle">
                                <i class="bi bi-pencil-square fs-3"></i>
                            </div>
                            <h5 class="fw-bold mb-3">Tulis Laporan</h5>
                            <p class="text-secondary small">Isi formulir dengan detail masalah, lokasi, dan lampirkan bukti foto jika ada.</p>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="step-card bg-white">
                            <span class="step-number">02</span>
                            <div class="mb-4 text-danger bg-danger bg-opacity-10 d-inline-block p-3 rounded-circle">
                                <i class="bi bi-inbox-fill fs-3"></i>
                            </div>
                            <h5 class="fw-bold mb-3">Verifikasi</h5>
                            <p class="text-secondary small">Admin/RT menerima notifikasi dan memvalidasi kebenaran data laporan.</p>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="step-card bg-white">
                            <span class="step-number">03</span>
                            <div class="mb-4 text-danger bg-danger bg-opacity-10 d-inline-block p-3 rounded-circle">
                                <i class="bi bi-gear-fill fs-3"></i>
                            </div>
                            <h5 class="fw-bold mb-3">Tindak Lanjut</h5>
                            <p class="text-secondary small">Petugas turun ke lapangan atau masalah dibahas dalam rapat koordinasi.</p>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="step-card bg-white">
                            <span class="step-number">04</span>
                            <div class="mb-4 text-danger bg-danger bg-opacity-10 d-inline-block p-3 rounded-circle">
                                <i class="bi bi-check-lg fs-3"></i>
                            </div>
                            <h5 class="fw-bold mb-3">Selesai</h5>
                            <p class="text-secondary small">Laporan dinyatakan selesai. Pelapor mendapat notifikasi hasil penanganan.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    
        <!-- CTA SECTION -->
        <section id="kontak" class="cta-section text-white text-center">
            <div class="cta-overlay"></div>
            <div class="container position-relative" style="z-index: 2;">
                <h2 class="display-5 fw-bold mb-3">Ada Keluhan Lingkungan?</h2>
                <p class="h6 word-space mb-4 col-lg-7 mx-auto opacity-75">
                    Jangan ragu untuk melapor. Partisipasi Anda sangat berarti untuk kenyamanan bersama di RT 1 RW 7.
                </p>
            </div>
        </section>
    </main>

    <!-- FOOTER -->
    <footer>
        <div class="container text-center">
            <div class="mb-4">
                <div class="d-inline-flex align-items-center justify-content-center bg-white rounded-circle p-3 mb-3" style="width: 60px; height: 60px;">
                    <i class="bi bi-megaphone-fill fs-3 text-danger"></i>
                </div>
                <h4 class="fw-bold">LAPOR PAK!</h4>
            </div>
            <p class="mb-1 text-white-50">Sistem Pengaduan Masyarakat RT 1 RW 7</p>
            <p class="text-secondary small mb-4">Jl. Salak 1, Perumahan Kamal, Banyu Ajuh, Kec. Kamal, Kabupaten Bangkalan, Jawa Timur</p>
            
            <div class="d-flex justify-content-center gap-3 mb-4">
                <a href="https://api.whatsapp.com/send?phone=6285850369909&text=Halo,%20%20saya%20ingin%20LAPOR!%20"
                    target="_blank" class="text-white-50 hover-text-white"><i class="bi bi-whatsapp fs-5"></i></a>
            </div>

            <hr class="border-secondary opacity-25 my-4 w-75 mx-auto">
            <p class="mb-0 text-secondary small">Copyright &copy; 2026 RT 1 RW 7. Developed with Nasywa Dyah Putri.</p>
        </div>
    </footer>

    <div class="wa-bubble-container">
        <div class="wa-bubble">
            Hubungi WA Kami!
        </div>

        <a href="https://api.whatsapp.com/send?phone=6285850369909&text=Halo%20Lapor%20Pak!%20saya%20ingin%20lapor!%20" 
        target="_blank" 
        class="wa-icon">
            <img src="https://img.icons8.com/?size=100&id=16712&format=png&color=FFFFFF" alt="WA">
        </a>
    </div>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>