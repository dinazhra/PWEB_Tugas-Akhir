@extends('layouts.app')

@section('title', 'Dashboard Admin - AgroMart')

@section('content')

<link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;500;600;700;800&family=DM+Sans:wght@400;500;600&display=swap" rel="stylesheet">

<style>

*, *::before, *::after { box-sizing: border-box; }

:root {
    --green-900: #0f2d1a;
    --green-800: #17361F;
    --green-700: #1e4a2b;
    --green-600: #2F6B45;
    --green-400: #6B9A45;
    --green-100: #eaf5e4;
    --green-50:  #f4faf1;
    --text-main: #0f1f14;
    --text-muted:#5a7362;
    --border:    #dce9d5;
    --bg:        #f0f5ee;
    --white:     #ffffff;
    --warning:   #D97706;
    --warning-bg:#FFFBEB;
    --danger:    #DC2626;
    --shadow-sm: 0 2px 8px rgba(15,45,26,.06);
    --shadow-md: 0 8px 28px rgba(15,45,26,.09);
    --shadow-lg: 0 16px 48px rgba(15,45,26,.12);
    --radius-xl: 28px;
    --radius-2xl:36px;
}

body { font-family: 'DM Sans', sans-serif; background: var(--bg); color: var(--text-main); }

.dashboard-page { max-width: 1360px; margin: auto; }

/* ── HERO ─────────────────────────────── */

.hero-grid {
    display: grid;
    grid-template-columns: 1.5fr .8fr;
    gap: 22px;
    margin-bottom: 24px;
}

.dashboard-hero {
    background: linear-gradient(130deg, var(--green-900) 0%, var(--green-700) 50%, var(--green-600) 100%);
    border-radius: var(--radius-2xl);
    padding: 44px 48px;
    color: #fff;
    position: relative;
    overflow: hidden;
}

.dashboard-hero::before {
    content: '';
    position: absolute;
    inset: 0;
    background:
        radial-gradient(ellipse 60% 80% at 110% 20%, rgba(107,154,69,.25) 0%, transparent 60%),
        radial-gradient(ellipse 40% 60% at -10% 80%, rgba(47,107,69,.30) 0%, transparent 55%);
    pointer-events: none;
}

.hero-inner { position: relative; z-index: 1; }

.hero-label {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: rgba(255,255,255,.12);
    border: 1px solid rgba(255,255,255,.18);
    border-radius: 999px;
    padding: 6px 14px;
    font-size: 13px;
    font-weight: 600;
    color: #c8e8be;
    margin-bottom: 16px;
}

.dashboard-title {
    font-family: 'Sora', sans-serif;
    font-size: 38px;
    font-weight: 800;
    line-height: 1.15;
    letter-spacing: -.5px;
    margin-bottom: 12px;
}

.dashboard-subtitle {
    color: #b8d9b0;
    font-size: 15px;
    line-height: 1.75;
    max-width: 580px;
}

/* ── WEATHER ──────────────────────────── */

.weather-card {
    background: linear-gradient(130deg, var(--green-900) 0%, var(--green-700) 50%, var(--green-600) 100%);
    border-radius: var(--radius-2xl);
    padding: 28px 32px;
    color: white;
    position: relative;
    overflow: hidden;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

.weather-card::before {
    content: '';
    position: absolute;
    inset: 0;
    background: radial-gradient(ellipse 80% 80% at 110% -10%, rgba(107,154,69,.3) 0%, transparent 60%);
    pointer-events: none;
}

.weather-inner { position: relative; z-index: 1; height: 100%; display: flex; flex-direction: column; justify-content: space-between; }

.weather-top {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 8px;
}

.weather-city-name {
    font-family: 'Sora', sans-serif;
    font-size: 15px;
    font-weight: 600;
    color: #d5eece;
}

.weather-label-text {
    font-size: 12px;
    color: #a8d0a0;
    margin-bottom: 12px;
}

.weather-temp-row {
    display: flex;
    align-items: flex-end;
    gap: 14px;
    margin-bottom: 14px;
}

.weather-temp {
    font-family: 'Sora', sans-serif;
    font-size: 52px;
    font-weight: 800;
    line-height: 1;
    letter-spacing: -2px;
}

.weather-desc-text {
    font-size: 14px;
    color: #c0deba;
    margin-bottom: 16px;
}

.weather-details {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 10px;
}

.weather-detail-item {
    display: flex;
    align-items: center;
    gap: 7px;
    font-size: 13px;
    color: #c0deba;
}

/* ── STATS ────────────────────────────── */

.stats-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 20px;
    margin-bottom: 24px;
}

.stat-card {
    background: var(--white);
    border-radius: var(--radius-xl);
    padding: 26px 28px;
    border: 1px solid var(--border);
    box-shadow: var(--shadow-sm);
    transition: transform .25s, box-shadow .25s;
    position: relative;
    overflow: hidden;
}

.stat-card::after {
    content: '';
    position: absolute;
    bottom: 0; right: 0;
    width: 80px; height: 80px;
    border-radius: 50%;
    background: var(--green-600);
    opacity: .03;
    transform: translate(20px, 20px);
}

.stat-card:hover { transform: translateY(-4px); box-shadow: var(--shadow-lg); }

.stat-icon {
    width: 48px; height: 48px;
    border-radius: 14px;
    display: flex; align-items: center; justify-content: center;
    margin-bottom: 16px;
}

.stat-label {
    font-size: 13px;
    font-weight: 500;
    color: var(--text-muted);
    margin-bottom: 6px;
}

.stat-value {
    font-family: 'Sora', sans-serif;
    font-size: 32px;
    font-weight: 800;
    color: var(--green-800);
    line-height: 1;
}

.stat-value.warn { color: var(--warning); }

/* ── VISIT CARD ───────────────────────── */

.visit-card {
    background: var(--white);
    border-radius: var(--radius-xl);
    border: 1px solid var(--border);
    padding: 28px 30px;
    margin-bottom: 24px;
    box-shadow: var(--shadow-sm);
}

.visit-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 14px;
    margin-bottom: 22px;
}

.visit-title {
    font-family: 'Sora', sans-serif;
    font-size: 20px;
    font-weight: 700;
    color: var(--green-800);
}

.visit-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 16px;
}

.visit-box {
    background: var(--green-50);
    border: 1px solid var(--border);
    border-radius: 18px;
    padding: 20px 22px;
}

.visit-box span {
    display: block;
    font-size: 12.5px;
    color: var(--text-muted);
    margin-bottom: 6px;
    font-weight: 500;
}

.visit-box strong {
    font-family: 'Sora', sans-serif;
    font-size: 20px;
    font-weight: 700;
    color: var(--green-800);
}

.reset-btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: #FEF2F2;
    color: var(--danger);
    border: 1px solid #FECACA;
    padding: 11px 20px;
    border-radius: 14px;
    font-weight: 700;
    font-size: 13.5px;
    cursor: pointer;
    transition: background .2s;
    font-family: 'DM Sans', sans-serif;
}

.reset-btn:hover { background: #FEE2E2; }

/* ── TABLE ────────────────────────────── */

.table-card {
    background: var(--white);
    border-radius: var(--radius-xl);
    border: 1px solid var(--border);
    overflow: hidden;
    box-shadow: var(--shadow-sm);
}

.table-header {
    padding: 22px 28px;
    border-bottom: 1px solid var(--border);
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.table-header h2 {
    font-family: 'Sora', sans-serif;
    font-size: 18px;
    font-weight: 700;
    color: var(--green-800);
    margin: 0;
}

.table-count {
    background: var(--green-100);
    color: var(--green-600);
    font-size: 12.5px;
    font-weight: 700;
    padding: 4px 12px;
    border-radius: 999px;
}

.table-wrapper { overflow-x: auto; }

table { width: 100%; border-collapse: collapse; }

th {
    background: var(--green-50);
    padding: 14px 18px;
    text-align: left;
    color: var(--text-muted);
    font-size: 12.5px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: .4px;
    border-bottom: 1px solid var(--border);
}

td {
    padding: 16px 18px;
    border-bottom: 1px solid #f0f5ee;
    font-size: 14px;
    color: var(--text-main);
}

tr:last-child td { border-bottom: none; }
tr:hover td { background: #fafdf9; }

.badge-code {
    background: var(--green-100);
    color: var(--green-700);
    padding: 5px 12px;
    border-radius: 8px;
    font-size: 12px;
    font-weight: 700;
    font-family: 'Sora', sans-serif;
}

.stock-low  { color: var(--danger);  font-weight: 700; }
.stock-good { color: var(--green-600); font-weight: 700; }

.alert-success {
    background: #ECFDF3;
    border: 1px solid #BBF7D0;
    color: #166534;
    padding: 14px 20px;
    border-radius: 16px;
    margin-bottom: 20px;
    font-size: 14px;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 10px;
}

/* ── RESPONSIVE ───────────────────────── */

@media(max-width:1100px){
    .hero-grid { grid-template-columns: 1fr; }
    .stats-grid { grid-template-columns: repeat(2, 1fr); }
}

@media(max-width:768px){
    .dashboard-title { font-size: 28px; }
    .stats-grid { grid-template-columns: 1fr; }
    .weather-details { grid-template-columns: 1fr 1fr; }
}

</style>

<div class="dashboard-page">

    {{-- ALERT --}}
    @if(session('success_reset'))
        <div class="alert-success">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="20 6 9 17 4 12"/>
            </svg>
            {{ session('success_reset') }}
        </div>
    @endif

    {{-- HERO + WEATHER --}}
    <div class="hero-grid">

        <div class="dashboard-hero">
            <div class="hero-inner">
                <div class="hero-label">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 2L2 7l10 5 10-5-10-5z"/><path d="M2 17l10 5 10-5"/><path d="M2 12l10 5 10-5"/></svg>
                    AgroMart Admin
                </div>
                <h1 class="dashboard-title">Dashboard Admin</h1>
                <p class="dashboard-subtitle">
                    Kelola produk, inventaris pupuk, dan pantau statistik AgroMart dalam satu dashboard modern.
                </p>
            </div>
        </div>

        {{-- CUACA --}}
        <div class="weather-card">
            <div class="weather-inner">

                <div>
                    <div class="weather-top">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#f0c040" stroke-width="2" stroke-linecap="round">
                            <circle cx="12" cy="12" r="5"/>
                            <line x1="12" y1="1" x2="12" y2="3"/><line x1="12" y1="21" x2="12" y2="23"/>
                            <line x1="4.22" y1="4.22" x2="5.64" y2="5.64"/><line x1="18.36" y1="18.36" x2="19.78" y2="19.78"/>
                            <line x1="1" y1="12" x2="3" y2="12"/><line x1="21" y1="12" x2="23" y2="12"/>
                            <line x1="4.22" y1="19.78" x2="5.64" y2="18.36"/><line x1="18.36" y1="5.64" x2="19.78" y2="4.22"/>
                        </svg>
                        <span class="weather-city-name">Jember</span>
                    </div>
                    <div class="weather-label-text">Cuaca Hari Ini</div>

                    <div class="weather-temp-row">
                        <div class="weather-temp" id="temp">--</div>
                    </div>

                    <div class="weather-desc-text" id="desc">Memuat cuaca...</div>
                </div>

                <div class="weather-details">
                    <div class="weather-detail-item">
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 2.69l5.66 5.66a8 8 0 1 1-11.31 0z"/>
                        </svg>
                        <span id="humidity">Kelembaban --</span>
                    </div>
                    <div class="weather-detail-item">
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M9.59 4.59A2 2 0 1 1 11 8H2m10.59 11.41A2 2 0 1 0 14 16H2m15.73-8.27A2.5 2.5 0 1 1 19.5 12H2"/>
                        </svg>
                        <span id="wind">Angin --</span>
                    </div>
                    <div class="weather-detail-item">
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M18 10h-1.26A8 8 0 1 0 9 20h9a5 5 0 0 0 0-10z"/>
                        </svg>
                        <span id="cloud">Awan --</span>
                    </div>
                    <div class="weather-detail-item">
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/>
                        </svg>
                        <span id="feels">Terasa --</span>
                    </div>
                </div>

            </div>
        </div>

    </div>

    {{-- STATS --}}
    <div class="stats-grid">

        @foreach($statsData as $stat)
        <div class="stat-card">
            <div class="stat-icon" style="background:{{ $stat['warna'] == 'warn' ? '#FFFBEB' : '#e6f4ec' }};">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="{{ $stat['warna'] == 'warn' ? '#D97706' : '#2F6B45' }}" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    @if($stat['warna'] == 'warn')
                        <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/>
                    @else
                        <path d="M12 2L2 7l10 5 10-5-10-5z"/><path d="M2 17l10 5 10-5"/><path d="M2 12l10 5 10-5"/>
                    @endif
                </svg>
            </div>
            <div class="stat-label">{{ $stat['label'] }}</div>
            <div class="stat-value {{ $stat['warna'] == 'warn' ? 'warn' : '' }}">{{ $stat['nilai'] }}</div>
        </div>
        @endforeach

    </div>

    {{-- VISIT --}}
    <div class="visit-card">

        <div class="visit-header">
            <div class="visit-title">Statistik Kunjungan</div>
            <form method="POST" action="{{ route('dashboard.reset_counter') }}">
                @csrf
                <button type="submit" class="reset-btn" onclick="return confirm('Reset statistik kunjungan?')">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="1 4 1 10 7 10"/><path d="M3.51 15a9 9 0 1 0 .49-3.5"/>
                    </svg>
                    Reset Statistik
                </button>
            </form>
        </div>

        <div class="visit-grid">
            <div class="visit-box">
                <span>Total Kunjungan</span>
                <strong>{{ $visits }}</strong>
            </div>
            <div class="visit-box">
                <span>Kunjungan Pertama</span>
                <strong>{{ $firstVisit }}</strong>
            </div>
            <div class="visit-box">
                <span>Kunjungan Terakhir</span>
                <strong>{{ $lastVisit }}</strong>
            </div>
        </div>

    </div>

    {{-- TABLE --}}
    <div class="table-card">

        <div class="table-header">
            <h2>Data Produk Pupuk</h2>
            <span class="table-count">{{ count($dataPupuk) }} produk</span>
        </div>

        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>Kode</th>
                        <th>Nama Produk</th>
                        <th>Kategori</th>
                        <th>Stok</th>
                        <th>Harga</th>
                        <th>Tanggal Masuk</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($dataPupuk as $item)
                    <tr>
                        <td><span class="badge-code">{{ $item['kode'] }}</span></td>
                        <td style="font-weight:600;">{{ $item['nama'] }}</td>
                        <td>{{ $item['kategori'] }}</td>
                        <td>
                            <span class="{{ $item['stok'] < 10 ? 'stock-low' : 'stock-good' }}">
                                {{ $item['stok'] }}
                            </span>
                        </td>
                        <td>{{ $item['harga'] }}</td>
                        <td style="color:var(--text-muted);">{{ $item['tanggal'] }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>

</div>

<script>
fetch('/api/cuaca')
    .then(r => r.json())
    .then(data => {
        const c = data.current_condition[0];
        document.getElementById('temp').innerText     = c.temp_C + '°C';
        document.getElementById('desc').innerText     = c.weatherDesc[0].value;
        document.getElementById('humidity').innerText = 'Kelembaban ' + c.humidity + '%';
        document.getElementById('wind').innerText     = 'Angin ' + c.windspeedKmph + ' km/j';
        document.getElementById('cloud').innerText    = 'Awan ' + c.cloudcover + '%';
        document.getElementById('feels').innerText    = 'Terasa ' + c.FeelsLikeC + '°C';
    })
    .catch(() => {
        document.getElementById('desc').innerText = 'Data cuaca tidak tersedia';
    });
</script>

@endsection