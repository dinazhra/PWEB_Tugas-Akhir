@extends('layouts.app')

@section('title', 'Pesanan Saya - AgroMart')

@section('content')

<link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;500;600;700;800&family=DM+Sans:wght@400;500;600&display=swap" rel="stylesheet">

<style>

*, *::before, *::after { box-sizing: border-box; }

:root {
    --green-900: #0f2d1a;
    --green-800: #17361F;
    --green-700: #1e4a2b;
    --green-600: #2F6B45;
    --green-100: #eaf5e4;
    --green-50:  #f4faf1;
    --text-main: #0f1f14;
    --text-muted:#5a7362;
    --border:    #dce9d5;
    --bg:        #f0f5ee;
    --white:     #ffffff;
    --shadow-sm: 0 2px 8px rgba(15,45,26,.06);
    --shadow-md: 0 8px 28px rgba(15,45,26,.09);
    --radius-xl: 28px;
    --radius-2xl:36px;
}

body { font-family: 'DM Sans', sans-serif; background: var(--bg); color: var(--text-main); }

.orders-page { max-width: 1000px; margin: auto; padding: 28px 24px 80px; }

.orders-hero {
    background: linear-gradient(130deg, var(--green-900) 0%, var(--green-700) 50%, var(--green-600) 100%);
    border-radius: var(--radius-2xl); padding: 44px 48px; color: #fff;
    position: relative; overflow: hidden; margin-bottom: 26px;
}

.orders-hero::before {
    content: ''; position: absolute; inset: 0;
    background:
        radial-gradient(ellipse 60% 80% at 110% 20%, rgba(107,154,69,.25) 0%, transparent 60%),
        radial-gradient(ellipse 40% 60% at -10% 80%, rgba(47,107,69,.30) 0%, transparent 55%);
    pointer-events: none;
}

.hero-inner { position: relative; z-index: 1; }

.hero-label {
    display: inline-flex; align-items: center; gap: 8px;
    background: rgba(255,255,255,.12); border: 1px solid rgba(255,255,255,.18);
    border-radius: 999px; padding: 6px 14px; font-size: 13px; font-weight: 600;
    color: #c8e8be; margin-bottom: 16px;
}

.hero-title { font-family: 'Sora', sans-serif; font-size: 38px; font-weight: 800; letter-spacing: -.5px; margin-bottom: 10px; }
.hero-sub { color: #b8d9b0; font-size: 15px; line-height: 1.75; }

.order-card {
    background: var(--white); border: 1px solid var(--border);
    border-radius: var(--radius-xl); box-shadow: var(--shadow-sm);
    margin-bottom: 20px; overflow: hidden;
}

.order-top {
    padding: 20px 26px; display: flex; justify-content: space-between;
    align-items: center; gap: 16px; flex-wrap: wrap; border-bottom: 1px solid #eff4ec;
}

.order-num { font-family: 'Sora', sans-serif; font-size: 17px; font-weight: 700; color: var(--text-main); }

.order-date { font-size: 13px; color: var(--text-muted); display: flex; align-items: center; gap: 5px; }

.status-badge { padding: 7px 16px; border-radius: 999px; font-size: 12.5px; font-weight: 700; white-space: nowrap; }

.order-body { padding: 22px 26px; }

.info-box {
    background: var(--green-50); border: 1px solid var(--border);
    border-radius: 18px; padding: 18px 22px; margin-bottom: 18px;
}

.info-box-title {
    font-family: 'Sora', sans-serif; font-size: 13px; font-weight: 700;
    color: var(--text-muted); text-transform: uppercase; letter-spacing: .6px; margin-bottom: 14px;
}

.info-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 14px 20px; }
.info-item-label { font-size: 12px; color: var(--text-muted); margin-bottom: 3px; }
.info-item-value { font-size: 14px; font-weight: 600; color: var(--text-main); }

.product-row {
    display: flex; align-items: center; gap: 14px;
    padding: 12px 0; border-bottom: 1px solid #eff4ec;
}
.product-row:last-child { border-bottom: none; }

.product-img-wrap {
    width: 56px; height: 56px; border-radius: 14px; background: var(--green-50);
    border: 1px solid var(--border); display: flex; align-items: center;
    justify-content: center; flex-shrink: 0; overflow: hidden;
}
.product-img-wrap img { width: 40px; height: 40px; object-fit: contain; }

.product-info { flex: 1; }
.product-name { font-size: 14.5px; font-weight: 600; color: var(--text-main); margin-bottom: 2px; }
.product-qty { font-size: 12.5px; color: var(--text-muted); }
.product-subtotal { font-family: 'Sora', sans-serif; font-size: 15px; font-weight: 700; color: var(--green-600); white-space: nowrap; }

.order-footer {
    display: flex; justify-content: space-between; align-items: center;
    gap: 16px; flex-wrap: wrap; padding-top: 16px; margin-top: 4px; border-top: 1px solid #eff4ec;
}

.total-label { font-size: 13px; color: var(--text-muted); margin-bottom: 2px; }
.total-value { font-family: 'Sora', sans-serif; font-size: 22px; font-weight: 800; color: var(--green-800); }

.action-group { display: flex; gap: 10px; flex-wrap: wrap; }

.btn {
    display: inline-flex; align-items: center; gap: 7px; text-decoration: none;
    border: none; padding: 10px 18px; border-radius: 12px; font-size: 13.5px;
    font-weight: 700; cursor: pointer; transition: transform .2s, box-shadow .2s;
    font-family: 'DM Sans', sans-serif;
}
.btn:hover { transform: translateY(-2px); }

.btn-primary { background: linear-gradient(135deg, var(--green-600), var(--green-900)); color: white; }
.btn-primary:hover { box-shadow: 0 8px 20px rgba(47,107,69,.22); }

.btn-warning { background: #FEF3C7; color: #92400E; }
.btn-warning:hover { background: #FDE68A; }

.btn-success { background: #DCFCE7; color: #166534; cursor: default; }
.btn-success:hover { transform: none; }

/* ── TOMBOL KONFIRMASI ── */
.btn-confirm { background: #EFF6FF; color: #1D4ED8; border: 1px solid #BFDBFE; }
.btn-confirm:hover { background: #DBEAFE; box-shadow: 0 6px 16px rgba(29,78,216,.15); }

/* ── EMPTY ── */
.empty-box {
    background: var(--white); border: 1px solid var(--border);
    border-radius: var(--radius-2xl); text-align: center; padding: 80px 24px; box-shadow: var(--shadow-sm);
}

.empty-icon-wrap {
    width: 88px; height: 88px; background: var(--green-50); border: 1px solid var(--border);
    border-radius: 26px; display: flex; align-items: center; justify-content: center; margin: 0 auto 24px;
}

.empty-title { font-family: 'Sora', sans-serif; font-size: 26px; font-weight: 800; color: var(--text-main); margin-bottom: 8px; }
.empty-text { color: var(--text-muted); font-size: 15px; margin-bottom: 28px; }

.empty-btn {
    display: inline-flex; align-items: center; gap: 8px;
    background: linear-gradient(135deg, var(--green-600), var(--green-900));
    color: white; text-decoration: none; padding: 13px 26px; border-radius: 14px;
    font-weight: 700; font-size: 14.5px; transition: transform .25s, box-shadow .25s;
}
.empty-btn:hover { transform: translateY(-3px); box-shadow: 0 12px 24px rgba(47,107,69,.22); }

@media(max-width:768px){
    .orders-page { padding: 16px 16px 60px; }
    .orders-hero { padding: 28px 24px; }
    .hero-title { font-size: 28px; }
    .order-top { padding: 16px 20px; }
    .order-body { padding: 16px 20px; }
    .product-row { flex-wrap: wrap; }
    .order-footer { flex-direction: column; align-items: flex-start; }
}

</style>

<div class="orders-page">

    {{-- HERO --}}
    <div class="orders-hero">
        <div class="hero-inner">
            <div class="hero-label">
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/>
                </svg>
                Riwayat Pesanan AgroMart
            </div>
            <h1 class="hero-title">Pesanan Saya</h1>
            <p class="hero-sub">Pantau status transaksi, pembayaran, dan detail pesanan Anda dengan mudah dan cepat.</p>
        </div>
    </div>

    {{-- ALERT --}}
    @if(session('success'))
        <div style="background:#ECFDF3;border:1px solid #BBF7D0;color:#166534;padding:14px 20px;border-radius:16px;margin-bottom:20px;font-weight:600;font-size:14px;display:flex;align-items:center;gap:10px;">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
            {{ session('success') }}
        </div>
    @endif

    {{-- LIST --}}
    @if($transactions->count() > 0)

        @foreach($transactions as $transaction)

        @php
            $statusColor = '#166534'; $statusBg = '#DCFCE7';
            if($transaction->status == 'menunggu_pembayaran')  { $statusColor = '#B45309'; $statusBg = '#FEF3C7'; }
            if($transaction->status == 'menunggu_verifikasi')  { $statusColor = '#92400E'; $statusBg = '#FFF7ED'; }
            if($transaction->status == 'diproses')             { $statusColor = '#1D4ED8'; $statusBg = '#EFF6FF'; }
            if($transaction->status == 'dikirim')              { $statusColor = '#7C3AED'; $statusBg = '#F3E8FF'; }
            if($transaction->status == 'selesai')              { $statusColor = '#166534'; $statusBg = '#DCFCE7'; }
        @endphp

        <div class="order-card">

            {{-- TOP --}}
            <div class="order-top">
                <div>
                    <div class="order-num">Pesanan #{{ $transaction->id }}</div>
                    <div class="order-date">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/>
                        </svg>
                        {{ $transaction->created_at->format('d M Y • H:i') }}
                    </div>
                </div>
                <div class="status-badge" style="background:{{ $statusBg }}; color:{{ $statusColor }};">
                    {{ ucwords(str_replace('_', ' ', $transaction->status)) }}
                </div>
            </div>

            {{-- BODY --}}
            <div class="order-body">

                {{-- INFO PENGIRIMAN --}}
                <div class="info-box">
                    <div class="info-box-title">Informasi Pengiriman</div>
                    <div class="info-grid">
                        <div>
                            <div class="info-item-label">Penerima</div>
                            <div class="info-item-value">{{ $transaction->nama_penerima }}</div>
                        </div>
                        <div>
                            <div class="info-item-label">No HP</div>
                            <div class="info-item-value">{{ $transaction->no_hp }}</div>
                        </div>
                        <div>
                            <div class="info-item-label">Pembayaran</div>
                            <div class="info-item-value">{{ $transaction->metode_pembayaran }}</div>
                        </div>
                        <div>
                            <div class="info-item-label">Alamat</div>
                            <div class="info-item-value">{{ $transaction->alamat }}</div>
                        </div>
                    </div>
                </div>

                {{-- PRODUK --}}
                <div>
                    @foreach($transaction->items as $item)
                    <div class="product-row">
                        <div class="product-img-wrap">
                            @if($item->pupuk->foto)
                                <img src="{{ Storage::url($item->pupuk->foto) }}" alt="{{ $item->pupuk->nama }}" onerror="this.src='{{ asset('images/tumbuhan.png') }}'">
                            @else
                                <img src="{{ asset('images/tumbuhan.png') }}" alt="{{ $item->pupuk->nama }}">
                            @endif
                        </div>
                        <div class="product-info">
                            <div class="product-name">{{ $item->pupuk->nama }}</div>
                            <div class="product-qty">{{ $item->qty }} item</div>
                        </div>
                        <div class="product-subtotal">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</div>
                    </div>
                    @endforeach
                </div>

                {{-- FOOTER --}}
                <div class="order-footer">

                    <div>
                        <div class="total-label">Total Pembayaran</div>
                        <div class="total-value">Rp {{ number_format($transaction->total, 0, ',', '.') }}</div>
                    </div>

                    <div class="action-group">

                        {{-- INVOICE --}}
                        <a href="{{ route('invoice', $transaction->id) }}" class="btn btn-primary">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                                <polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/>
                            </svg>
                            Invoice
                        </a>

                        {{-- UPLOAD BUKTI --}}
                        @if($transaction->status == 'menunggu_pembayaran' && $transaction->metode_pembayaran == 'Transfer Bank')
                            <a href="{{ route('payment.form', $transaction->id) }}" class="btn btn-warning">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="1" y="4" width="22" height="16" rx="2"/><line x1="1" y1="10" x2="23" y2="10"/>
                                </svg>
                                Upload Bukti
                            </a>
                        @elseif($transaction->bukti_transfer)
                            <div class="btn btn-success">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="20 6 9 17 4 12"/>
                                </svg>
                                Bukti Terkirim
                            </div>
                        @endif

                        {{-- KONFIRMASI DITERIMA — hanya saat status dikirim --}}
                        @if($transaction->status === 'dikirim')
                            <form action="{{ route('pesanan.konfirmasi', $transaction->id) }}" method="POST" style="display:contents;">
                                @csrf
                                <button
                                    type="submit"
                                    class="btn btn-confirm"
                                    onclick="return confirm('Konfirmasi pesanan sudah diterima?')"
                                >
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                        <polyline points="20 6 9 17 4 12"/>
                                    </svg>
                                    Konfirmasi Diterima
                                </button>
                            </form>
                        @endif

                    </div>

                </div>

            </div>

        </div>

        @endforeach

    @else

    <div class="empty-box">
        <div class="empty-icon-wrap">
            <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="#2F6B45" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
                <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/>
                <polyline points="3.27 6.96 12 12.01 20.73 6.96"/><line x1="12" y1="22.08" x2="12" y2="12"/>
            </svg>
        </div>
        <div class="empty-title">Belum Ada Pesanan</div>
        <p class="empty-text">Mulai belanja pupuk terbaik dari AgroMart sekarang.</p>
        <a href="{{ route('pupuk.index') }}" class="empty-btn">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/>
                <path d="M16 10a4 4 0 0 1-8 0"/>
            </svg>
            Belanja Sekarang
        </a>
    </div>

    @endif

</div>

@endsection