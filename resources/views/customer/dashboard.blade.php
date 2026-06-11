@extends('layouts.app')

@section('title', 'Dashboard Customer')

@section('content')

<link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;500;600;700;800&family=DM+Sans:wght@400;500;600&display=swap" rel="stylesheet">

<style>
*, *::before, *::after { box-sizing: border-box; }

:root {
    --green-900: #0f2d1a; --green-800: #17361F; --green-700: #1e4a2b;
    --green-600: #2F6B45; --green-500: #3d8a57; --green-400: #6B9A45;
    --green-100: #eaf5e4; --green-50:  #f4faf1;
    --amber: #D97706; --amber-bg: #FFFBEB;
    --blue: #2563EB; --blue-bg: #EFF6FF;
    --text-main: #0f1f14; --text-muted: #5a7362;
    --border: #dce9d5; --white: #ffffff;
    --radius-xl: 28px; --radius-2xl: 36px;
    --shadow-sm: 0 2px 8px rgba(15,45,26,.06);
    --shadow-md: 0 8px 28px rgba(15,45,26,.09);
    --shadow-lg: 0 16px 48px rgba(15,45,26,.12);
}

body { font-family: 'DM Sans', sans-serif; background: #f0f5ee; color: var(--text-main); }

.dw { max-width: 1360px; margin: auto; padding: 28px 24px; }

/* ── HERO ── */
.hero {
    background: linear-gradient(130deg, var(--green-900) 0%, var(--green-700) 50%, var(--green-600) 100%);
    border-radius: var(--radius-2xl); padding: 44px 48px;
    color: #fff; position: relative; overflow: hidden; margin-bottom: 26px;
}
.hero::before {
    content: ''; position: absolute; inset: 0;
    background:
        radial-gradient(ellipse 60% 80% at 110% 20%, rgba(107,154,69,.25) 0%, transparent 60%),
        radial-gradient(ellipse 40% 60% at -10% 80%, rgba(47,107,69,.30) 0%, transparent 55%);
    pointer-events: none;
}
.hero-inner { display: flex; justify-content: space-between; align-items: center; gap: 32px; flex-wrap: wrap; position: relative; z-index: 1; }
.hero-label {
    display: inline-flex; align-items: center; gap: 8px;
    background: rgba(255,255,255,.12); border: 1px solid rgba(255,255,255,.18);
    border-radius: 999px; padding: 6px 14px; font-size: 13px; font-weight: 600;
    letter-spacing: .4px; margin-bottom: 16px; color: #c8e8be;
}
.hero-title { font-family: 'Sora', sans-serif; font-size: 40px; font-weight: 800; line-height: 1.15; margin-bottom: 14px; letter-spacing: -.5px; }
.hero-sub { color: #b8d9b0; max-width: 580px; line-height: 1.75; font-size: 15px; }

/* ── WEATHER ── */
.weather {
    background: rgba(255,255,255,.10); border: 1px solid rgba(255,255,255,.16);
    backdrop-filter: blur(16px); border-radius: 24px; padding: 28px 32px;
    min-width: 240px; flex-shrink: 0;
}
.weather-top { display: flex; align-items: center; gap: 10px; margin-bottom: 6px; }
.weather-city-name { font-family: 'Sora', sans-serif; font-size: 15px; font-weight: 600; color: #d5eece; }
.weather-temp { font-family: 'Sora', sans-serif; font-size: 52px; font-weight: 800; line-height: 1; margin-bottom: 10px; letter-spacing: -2px; }
.weather-desc { font-size: 13.5px; color: #c0deba; line-height: 1.9; }
.weather-desc span { display: flex; align-items: center; gap: 7px; }

/* ── STATS ── */
.stats-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; margin-bottom: 24px; }
.stat-link { text-decoration: none; color: inherit; display: block; }
.stat-card {
    background: var(--white); border-radius: var(--radius-xl); padding: 28px 28px 26px;
    border: 1px solid var(--border); box-shadow: var(--shadow-sm);
    transition: transform .25s ease, box-shadow .25s ease; position: relative; overflow: hidden;
}
.stat-card::after {
    content: ''; position: absolute; bottom: 0; right: 0;
    width: 80px; height: 80px; border-radius: 50%;
    opacity: .04; background: var(--green-600); transform: translate(20px, 20px);
}
.stat-card:hover { transform: translateY(-5px); box-shadow: var(--shadow-lg); }
.stat-icon { width: 52px; height: 52px; border-radius: 16px; display: flex; align-items: center; justify-content: center; margin-bottom: 18px; }
.stat-label { font-size: 13px; font-weight: 500; color: var(--text-muted); margin-bottom: 6px; letter-spacing: .2px; }
.stat-value { font-family: 'Sora', sans-serif; font-size: 36px; font-weight: 800; color: var(--green-800); line-height: 1; }
.stat-value.small { font-size: 26px; }

/* ── BOTTOM GRID ── */
.bottom-grid { display: grid; grid-template-columns: 1.35fr .65fr; gap: 22px; }

/* ── ORDER CARD ── */
.card { background: var(--white); border-radius: var(--radius-xl); padding: 30px; border: 1px solid var(--border); box-shadow: var(--shadow-sm); }
.card-title { font-family: 'Sora', sans-serif; font-size: 20px; font-weight: 700; color: var(--green-800); margin-bottom: 6px; }
.card-sub { font-size: 13px; color: var(--text-muted); margin-bottom: 22px; }

.order-row { display: flex; justify-content: space-between; align-items: center; padding: 16px 0; border-bottom: 1px solid #eff4ec; gap: 12px; }
.order-row:last-child { border-bottom: none; }
.order-left { display: flex; align-items: center; gap: 14px; }
.order-icon { width: 42px; height: 42px; background: var(--green-50); border: 1px solid var(--border); border-radius: 14px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
.order-name { font-weight: 600; font-size: 14.5px; color: var(--green-800); margin-bottom: 3px; }
.order-date { font-size: 12.5px; color: var(--text-muted); }

.badge { padding: 7px 14px; border-radius: 999px; font-size: 12.5px; font-weight: 700; white-space: nowrap; flex-shrink: 0; }
.badge-selesai   { background: #ECFDF3; color: #166534; }
.badge-diproses  { background: #FEF3C7; color: #92400E; }
.badge-dikirim   { background: #EFF6FF; color: #1D4ED8; }
.badge-menunggu_verifikasi { background: #F3F4F6; color: #374151; }
.badge-dibatalkan { background: #FEF2F2; color: #991B1B; }

.empty-orders { text-align: center; color: var(--text-muted); padding: 40px 20px; font-size: 14px; }
.empty-orders svg { opacity: .4; margin-bottom: 10px; }

/* ── TIPS ── */
.tips-card {
    background: linear-gradient(145deg, #f0faea, #fafff7);
    border-radius: var(--radius-xl); padding: 30px;
    border: 1px solid #d3e8ca; display: flex; flex-direction: column;
}
.tips-icon-wrap { width: 56px; height: 56px; background: var(--green-600); border-radius: 18px; display: flex; align-items: center; justify-content: center; margin-bottom: 20px; }
.tips-title { font-family: 'Sora', sans-serif; font-size: 18px; font-weight: 700; color: var(--green-800); margin-bottom: 12px; }
.tips-divider { width: 36px; height: 3px; background: var(--green-400); border-radius: 99px; margin-bottom: 14px; }
.tips-text { font-size: 14px; color: #4a6b52; line-height: 1.85; flex: 1; }
.tips-tag { display: inline-flex; align-items: center; gap: 6px; margin-top: 22px; background: rgba(47,107,69,.10); color: var(--green-600); border-radius: 999px; padding: 6px 12px; font-size: 12px; font-weight: 600; }

/* ── RESPONSIVE ── */
@media(max-width:1100px){ .stats-grid { grid-template-columns: repeat(2,1fr); } .bottom-grid { grid-template-columns: 1fr; } }
@media(max-width:768px){ .hero { padding: 28px 24px; } .hero-title { font-size: 28px; } .stats-grid { grid-template-columns: 1fr; } .dw { padding: 16px; } }
</style>

<div class="dw">

    {{-- HERO --}}
    <div class="hero">
        <div class="hero-inner">
            <div>
                <div class="hero-label">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 2L2 7l10 5 10-5-10-5z"/><path d="M2 17l10 5 10-5"/><path d="M2 12l10 5 10-5"/></svg>
                    AgroMart Dashboard
                </div>
                <h1 class="hero-title">Halo, {{ auth()->user()->name }}</h1>
                <p class="hero-sub">Selamat datang kembali. Kelola kebutuhan pertanian Anda dengan lebih mudah, cepat, dan modern hari ini.</p>
            </div>

            <div class="weather">
                <div class="weather-top">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#f0c040" stroke-width="2" stroke-linecap="round">
                        <circle cx="12" cy="12" r="5"/><line x1="12" y1="1" x2="12" y2="3"/>
                        <line x1="12" y1="21" x2="12" y2="23"/><line x1="4.22" y1="4.22" x2="5.64" y2="5.64"/>
                        <line x1="18.36" y1="18.36" x2="19.78" y2="19.78"/><line x1="1" y1="12" x2="3" y2="12"/>
                        <line x1="21" y1="12" x2="23" y2="12"/><line x1="4.22" y1="19.78" x2="5.64" y2="18.36"/>
                        <line x1="18.36" y1="5.64" x2="19.78" y2="4.22"/>
                    </svg>
                    <span class="weather-city-name">{{ $city ?? 'Jember' }}</span>
                </div>
                <div class="weather-temp">30°C</div>
                <div class="weather-desc">
                    <span>
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 10h-1.26A8 8 0 1 0 9 20h9a5 5 0 0 0 0-10z"/></svg>
                        Cerah Berawan
                    </span>
                    <span>
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2.69l5.66 5.66a8 8 0 1 1-11.31 0z"/></svg>
                        Kelembaban 72%
                    </span>
                    <span>
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9.59 4.59A2 2 0 1 1 11 8H2m10.59 11.41A2 2 0 1 0 14 16H2m15.73-8.27A2.5 2.5 0 1 1 19.5 12H2"/></svg>
                        Angin 12 km/jam
                    </span>
                </div>
            </div>
        </div>
    </div>

    {{-- STATS --}}
    <div class="stats-grid">

        <div class="stat-card">
            <div class="stat-icon" style="background:#e6f4ec;">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#2F6B45" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/>
                    <polyline points="3.27 6.96 12 12.01 20.73 6.96"/><line x1="12" y1="22.08" x2="12" y2="12"/>
                </svg>
            </div>
            <div class="stat-label">Total Pesanan</div>
            <div class="stat-value">{{ $totalPesanan }}</div>
        </div>

        <a href="{{ route('cart.index') }}" class="stat-link">
            <div class="stat-card">
                <div class="stat-icon" style="background:#FFF7E7;">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#D97706" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/>
                        <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/>
                    </svg>
                </div>
                <div class="stat-label">Keranjang</div>
                <div class="stat-value">{{ $totalKeranjang }}</div>
            </div>
        </a>

        <div class="stat-card">
            <div class="stat-icon" style="background:#EFF6FF;">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#2563EB" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/>
                </svg>
            </div>
            <div class="stat-label">Total Pengeluaran</div>
            <div class="stat-value small">Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}</div>
        </div>

    </div>

    {{-- BOTTOM --}}
    <div class="bottom-grid">

        {{-- RECENT ORDERS --}}
        <div class="card">
            <div class="card-title">Pesanan Terbaru</div>
            <div class="card-sub">Riwayat transaksi terakhir Anda</div>

            @forelse($pesananTerbaru as $transaksi)
                <div class="order-row">
                    <div class="order-left">
                        <div class="order-icon">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#2F6B45" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/>
                            </svg>
                        </div>
                        <div>
                            <div class="order-name">
                                {{ $transaksi->items->first()?->pupuk->nama ?? 'Pesanan #'.$transaksi->id }}
                                @if($transaksi->items->count() > 1)
                                    <span style="font-size:12px;color:#9CA3AF;font-weight:400;">+{{ $transaksi->items->count() - 1 }} produk lain</span>
                                @endif
                            </div>
                            <div class="order-date">{{ $transaksi->created_at->format('d M Y') }}</div>
                        </div>
                    </div>
                    <span class="badge badge-{{ str_replace(' ', '_', $transaksi->status) }}">
                        {{ ucfirst(str_replace('_', ' ', $transaksi->status)) }}
                    </span>
                </div>
            @empty
                <div class="empty-orders">
                    <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" style="display:block;margin:0 auto 10px">
                        <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/>
                    </svg>
                    Belum ada pesanan.
                </div>
            @endforelse
        </div>

        {{-- TIPS --}}
        <div class="tips-card">
            <div class="tips-icon-wrap">
                <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M12 22V12M12 12C12 12 7 9.5 5 6c-1-1.6-.5-4 2-4 1.5 0 3 1 5 5z"/>
                    <path d="M12 12c0 0 5-2.5 7-6 1-1.6.5-4-2-4-1.5 0-3 1-5 5z"/>
                    <path d="M5 22h14"/>
                </svg>
            </div>
            <div class="tips-title">Tips Pertanian Hari Ini</div>
            <div class="tips-divider"></div>
            <p class="tips-text">
                Pemupukan paling efektif dilakukan pada pagi atau sore hari
                agar nutrisi terserap maksimal oleh tanaman dan tidak cepat
                menguap karena terik matahari.
            </p>
            <div class="tips-tag">
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
                Agronomi Dasar
            </div>
        </div>

    </div>

</div>

@endsection