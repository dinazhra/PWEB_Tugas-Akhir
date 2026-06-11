@extends('layouts.app')

@section('title', 'Beranda - AgroMart')

@section('content')

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

<style>
    .homepage * { font-family: 'Plus Jakarta Sans', sans-serif; box-sizing: border-box; }
    .homepage { margin-top: -42px; }
    .homepage a { text-decoration: none; }

    /* ── HERO ── */
    .hero-section {
        position: relative;
        overflow: hidden;
        background: #17361F;
        border-radius: 0 0 40px 40px;
        padding: 130px 80px 110px;
    }

    .hero-section::before {
        content: '';
        position: absolute;
        width: 480px; height: 480px;
        border-radius: 50%;
        background: #2F6B45;
        opacity: 0.5;
        top: -160px; right: -120px;
    }

    .hero-section::after {
        content: '';
        position: absolute;
        width: 280px; height: 280px;
        border-radius: 50%;
        background: #8bc34a;
        opacity: 0.08;
        bottom: -100px; left: -80px;
    }

    .hero-grid {
        position: relative;
        z-index: 2;
        max-width: 1200px;
        margin: auto;
        display: grid;
        grid-template-columns: 1.1fr 0.9fr;
        align-items: center;
        gap: 60px;
    }

    .hero-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 9px 18px;
        background: rgba(255,255,255,0.1);
        border: 1px solid rgba(255,255,255,0.15);
        border-radius: 100px;
        color: #b5d96a;
        font-size: 12px;
        font-weight: 600;
        letter-spacing: 1px;
        text-transform: uppercase;
        margin-bottom: 24px;
    }

    .hero-badge-dot {
        width: 7px; height: 7px;
        border-radius: 50%;
        background: #8bc34a;
        flex-shrink: 0;
    }

    .hero-title {
        font-size: 64px;
        line-height: 1.06;
        color: white;
        font-weight: 800;
        letter-spacing: -1.5px;
        margin-bottom: 22px;
    }

    .hero-title .accent { color: #8bc34a; }

    .hero-desc {
        font-size: 17px;
        line-height: 1.85;
        color: #a8d5ab;
        max-width: 520px;
        margin-bottom: 38px;
    }

    .hero-buttons {
        display: flex;
        align-items: center;
        gap: 14px;
        flex-wrap: wrap;
    }

    .btn-primary {
        background: white;
        color: #17361F;
        padding: 15px 30px;
        border-radius: 14px;
        font-weight: 700;
        font-size: 14px;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: transform 0.2s, background 0.2s;
    }

    .btn-primary:hover { transform: translateY(-2px); background: #f0faf1; }
    .btn-primary svg { width: 16px; height: 16px; }

    .btn-secondary {
        background: rgba(255,255,255,0.1);
        color: white;
        border: 1px solid rgba(255,255,255,0.2);
        padding: 15px 30px;
        border-radius: 14px;
        font-weight: 600;
        font-size: 14px;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: background 0.2s;
    }

    .btn-secondary:hover { background: rgba(255,255,255,0.16); }
    .btn-secondary svg { width: 16px; height: 16px; }

    /* HERO CARD */
    .hero-visual { position: relative; }

    .hero-card {
        background: rgba(255,255,255,0.08);
        backdrop-filter: blur(16px);
        border: 1px solid rgba(255,255,255,0.12);
        border-radius: 28px;
        padding: 28px;
        box-shadow: 0 20px 60px rgba(0,0,0,0.2);
    }

    .hero-image {
        width: 100%;
        border-radius: 18px;
        object-fit: cover;
        height: 300px;
    }

    .hero-mini-stats {
        display: grid;
        grid-template-columns: repeat(3,1fr);
        gap: 12px;
        margin-top: 16px;
    }

    .hero-stat {
        background: rgba(255,255,255,0.08);
        border-radius: 14px;
        padding: 14px;
        text-align: center;
    }

    .hero-stat h3 {
        color: white;
        font-size: 22px;
        font-weight: 800;
        margin-bottom: 3px;
        letter-spacing: -0.5px;
    }

    .hero-stat p { color: #a8d5ab; font-size: 11px; font-weight: 500; }

    /* ── STATS ── */
    .stats-section {
        margin-top: -48px;
        position: relative;
        z-index: 5;
        padding: 0 20px;
    }

    .stats-wrapper {
        max-width: 1000px;
        margin: auto;
        background: white;
        border-radius: 24px;
        padding: 32px 40px;
        box-shadow: 0 8px 40px rgba(0,0,0,0.08);
        display: grid;
        grid-template-columns: repeat(4,1fr);
        gap: 20px;
        border: 1px solid #E6EEE8;
    }

    .stats-item { text-align: center; }

    .stats-item h2 {
        font-size: 36px;
        font-weight: 800;
        color: #2F6B45;
        margin-bottom: 6px;
        letter-spacing: -1px;
    }

    .stats-item p { color: #9CA3AF; font-size: 13px; font-weight: 500; }

    .stats-divider {
        width: 1px;
        background: #E6EEE8;
        margin: auto;
    }

    /* ── FEATURES ── */
    .feature-section {
        padding: 100px 20px;
    }

    .section-header {
        text-align: center;
        margin-bottom: 56px;
    }

    .section-tag {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: #EEF7EF;
        color: #2F6B45;
        font-size: 12px;
        font-weight: 600;
        letter-spacing: 1px;
        text-transform: uppercase;
        padding: 6px 14px;
        border-radius: 100px;
        margin-bottom: 16px;
    }

    .section-tag svg { width: 13px; height: 13px; }

    .section-header h2 {
        font-size: 38px;
        font-weight: 800;
        color: #17361F;
        letter-spacing: -0.8px;
        margin-bottom: 14px;
    }

    .section-header p {
        max-width: 560px;
        margin: auto;
        color: #6B7280;
        line-height: 1.8;
        font-size: 15px;
    }

    .feature-grid {
        max-width: 1100px;
        margin: auto;
        display: grid;
        grid-template-columns: repeat(3,1fr);
        gap: 24px;
    }

    .feature-card {
        background: white;
        border-radius: 22px;
        padding: 34px 28px;
        border: 1px solid #E7EEE8;
        box-shadow: 0 4px 20px rgba(0,0,0,0.04);
        transition: transform 0.2s, box-shadow 0.2s;
    }

    .feature-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 12px 36px rgba(0,0,0,0.08);
    }

    .feature-icon {
        width: 56px; height: 56px;
        border-radius: 16px;
        background: #EEF7EF;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 20px;
    }

    .feature-icon svg { width: 26px; height: 26px; }

    .feature-card h3 {
        font-size: 18px;
        font-weight: 700;
        color: #17361F;
        margin-bottom: 10px;
        letter-spacing: -0.2px;
    }

    .feature-card p {
        color: #6B7280;
        line-height: 1.8;
        font-size: 14px;
    }

    /* ── CTA ── */
    .cta-section { padding: 0 20px 100px; }

    .cta-box {
        max-width: 1100px;
        margin: auto;
        background: #17361F;
        border-radius: 32px;
        padding: 72px 60px;
        text-align: center;
        position: relative;
        overflow: hidden;
    }

    .cta-box::before {
        content: '';
        position: absolute;
        width: 300px; height: 300px;
        background: #2F6B45;
        border-radius: 50%;
        right: -80px; top: -80px;
        opacity: 0.6;
    }

    .cta-box::after {
        content: '';
        position: absolute;
        width: 200px; height: 200px;
        background: #8bc34a;
        border-radius: 50%;
        left: -60px; bottom: -60px;
        opacity: 0.1;
    }

    .cta-box h2 {
        position: relative;
        z-index: 2;
        font-size: 42px;
        font-weight: 800;
        color: white;
        letter-spacing: -1px;
        margin-bottom: 14px;
    }

    .cta-box p {
        position: relative;
        z-index: 2;
        color: #a8d5ab;
        font-size: 16px;
        line-height: 1.8;
        max-width: 580px;
        margin: 0 auto 32px;
    }

    .cta-btn {
        position: relative;
        z-index: 2;
        display: inline-flex;
        align-items: center;
        gap: 10px;
        background: white;
        color: #17361F;
        padding: 15px 32px;
        border-radius: 14px;
        font-weight: 700;
        font-size: 14px;
        transition: transform 0.2s, background 0.2s;
    }

    .cta-btn:hover { transform: translateY(-2px); background: #f0faf1; }
    .cta-btn svg { width: 16px; height: 16px; }

    /* ── RESPONSIVE ── */
    @media (max-width: 992px) {
        .hero-grid { grid-template-columns: 1fr; }
        .feature-grid { grid-template-columns: 1fr 1fr; }
        .stats-wrapper { grid-template-columns: repeat(2,1fr); }
        .hero-title { font-size: 48px; }
    }

    @media (max-width: 768px) {
        .hero-section { padding: 110px 24px 90px; }
        .hero-title { font-size: 38px; }
        .feature-grid { grid-template-columns: 1fr; }
        .stats-wrapper { grid-template-columns: 1fr 1fr; }
        .cta-box { padding: 48px 28px; }
        .cta-box h2 { font-size: 30px; }
        .section-header h2 { font-size: 30px; }
    }
</style>

<div class="homepage">

    {{-- HERO --}}
    <section class="hero-section">
        <div class="hero-grid">

            <div>
                <div class="hero-badge">
                    <span class="hero-badge-dot"></span>
                    Solusi Pertanian Modern Indonesia
                </div>

                <h1 class="hero-title">
                    AgroMart<br>
                    <span class="accent">PupukKu</span>
                </h1>

                <p class="hero-desc">
                    Platform digital penjualan pupuk modern untuk
                    membantu petani mendapatkan produk berkualitas,
                    harga terbaik, dan distribusi lebih cepat.
                </p>

                <div class="hero-buttons">
                    <a href="{{ route('pupuk.index') }}" class="btn-primary">
                        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 21v-7.5a.75.75 0 01.75-.75h3a.75.75 0 01.75.75V21m-4.5 0H2.36m11.14 0H18m0 0h3.64m-1.39 0V9.349m-16.5 11.65V9.35m0 0a3.001 3.001 0 003.75-.615A2.993 2.993 0 009.75 9.75c.896 0 1.7-.393 2.25-1.016a2.993 2.993 0 002.25 1.016c.896 0 1.7-.393 2.25-1.016a3.001 3.001 0 003.75.614m-16.5 0a3.004 3.004 0 01-.621-4.72L4.318 3.44A1.5 1.5 0 015.378 3h13.243a1.5 1.5 0 011.06.44l1.19 1.189a3 3 0 01-.621 4.72m-13.5 8.65h3.75a.75.75 0 00.75-.75V13.5a.75.75 0 00-.75-.75H6.75a.75.75 0 00-.75.75v3.75c0 .415.336.75.75.75z"/>
                        </svg>
                        Jelajahi Produk
                    </a>
                    <a href="#features" class="btn-secondary">
                        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z"/>
                        </svg>
                        Pelajari Lebih Lanjut
                    </a>
                </div>
            </div>

            <div class="hero-visual">
                <div class="hero-card">
                    <img
                        src="https://images.unsplash.com/photo-1625246333195-78d9c38ad449?q=80&w=1200&auto=format&fit=crop"
                        class="hero-image"
                        alt="Pertanian Modern"
                    >
                    <div class="hero-mini-stats">
                        <div class="hero-stat">
                            <h3>500+</h3>
                            <p>Pelanggan</p>
                        </div>
                        <div class="hero-stat">
                            <h3>50+</h3>
                            <p>Produk</p>
                        </div>
                        <div class="hero-stat">
                            <h3>24/7</h3>
                            <p>Layanan</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

    {{-- STATS --}}
    <section class="stats-section">
        <div class="stats-wrapper">
            <div class="stats-item">
                <h2>2025</h2>
                <p>Tahun Berdiri</p>
            </div>
            <div class="stats-item">
                <h2>500+</h2>
                <p>Pelanggan Aktif</p>
            </div>
            <div class="stats-item">
                <h2>50+</h2>
                <p>Produk Berkualitas</p>
            </div>
            <div class="stats-item">
                <h2>98%</h2>
                <p>Kepuasan Customer</p>
            </div>
        </div>
    </section>

    {{-- FEATURES --}}
    <section class="feature-section" id="features">

        <div class="section-header">
            <div class="section-tag">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 00-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 003.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 003.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 00-3.09 3.09z"/>
                </svg>
                Keunggulan Kami
            </div>
            <h2>Kenapa Memilih AgroMart?</h2>
            <p>Kami menghadirkan solusi pertanian modern dengan produk berkualitas tinggi dan pelayanan terbaik untuk petani Indonesia.</p>
        </div>

        <div class="feature-grid">

            <div class="feature-card">
                <div class="feature-icon">
                    <svg fill="none" stroke="#2F6B45" stroke-width="1.8" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 01-1.043 3.296 3.745 3.745 0 01-3.296 1.043A3.745 3.745 0 0112 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 01-3.296-1.043 3.745 3.745 0 01-1.043-3.296A3.745 3.745 0 013 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 011.043-3.296 3.746 3.746 0 013.296-1.043A3.746 3.746 0 0112 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 013.296 1.043 3.746 3.746 0 011.043 3.296A3.745 3.745 0 0121 12z"/>
                    </svg>
                </div>
                <h3>Produk Berkualitas</h3>
                <p>Semua produk pupuk telah melalui proses seleksi kualitas terbaik untuk hasil panen yang optimal dan konsisten.</p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">
                    <svg fill="none" stroke="#2F6B45" stroke-width="1.8" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 00-3.213-9.193 2.056 2.056 0 00-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 00-10.026 0 1.106 1.106 0 00-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12"/>
                    </svg>
                </div>
                <h3>Pengiriman Cepat</h3>
                <p>Sistem distribusi cepat dan aman ke seluruh Indonesia untuk memastikan produk sampai tepat waktu dan kondisi baik.</p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">
                    <svg fill="none" stroke="#2F6B45" stroke-width="1.8" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75"/>
                    </svg>
                </div>
                <h3>Harga Terjangkau</h3>
                <p>Harga kompetitif langsung dari supplier terpercaya untuk membantu petani Indonesia mendapat produk terbaik.</p>
            </div>

        </div>

    </section>

    {{-- CTA --}}
    <section class="cta-section">
        <div class="cta-box">
            <h2>Siap Memulai Pertanian Modern?</h2>
            <p>Bergabung bersama ribuan pelanggan AgroMart dan tingkatkan hasil pertanian Anda sekarang juga.</p>

            @guest
                <a href="{{ route('login') }}" class="cta-btn">
                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75"/>
                    </svg>
                    Masuk Sekarang
                </a>
            @else
                <a href="{{ route('pupuk.index') }}" class="cta-btn">
                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 21v-7.5a.75.75 0 01.75-.75h3a.75.75 0 01.75.75V21m-4.5 0H2.36m11.14 0H18m0 0h3.64m-1.39 0V9.349m-16.5 11.65V9.35m0 0a3.001 3.001 0 003.75-.615A2.993 2.993 0 009.75 9.75c.896 0 1.7-.393 2.25-1.016a2.993 2.993 0 002.25 1.016c.896 0 1.7-.393 2.25-1.016a3.001 3.001 0 003.75.614m-16.5 0a3.004 3.004 0 01-.621-4.72L4.318 3.44A1.5 1.5 0 015.378 3h13.243a1.5 1.5 0 011.06.44l1.19 1.189a3 3 0 01-.621 4.72m-13.5 8.65h3.75a.75.75 0 00.75-.75V13.5a.75.75 0 00-.75-.75H6.75a.75.75 0 00-.75.75v3.75c0 .415.336.75.75.75z"/>
                    </svg>
                    Buka Katalog
                </a>
            @endguest
        </div>
    </section>

</div>

@endsection