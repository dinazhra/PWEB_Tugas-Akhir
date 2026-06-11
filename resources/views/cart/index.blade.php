@extends('layouts.app')

@section('title', 'Keranjang Belanja - AgroMart')

@section('content')

<style>
@import url('https://fonts.googleapis.com/css2?family=Sora:wght@400;500;600;700;800&family=DM+Sans:wght@400;500&display=swap');

*{box-sizing:border-box}

:root{
    --g:#1F5C35;
    --g2:#2E7D4F;
    --g3:#EAF4EE;

    --white:#FFFFFF;
    --bg:#F4F7F4;

    --text:#131F14;
    --muted:#627365;

    --border:#DDE8DF;

    --shadow:0 8px 28px rgba(0,0,0,.05);

    --radius-xl:28px;
    --radius-lg:20px;
    --radius-md:14px;
}

html.dark{
    --white:#17211A;
    --bg:#0F1610;

    --text:#E8F2EA;
    --muted:#8FA893;

    --border:#253029;
    --g3:#1A2E20;

    --shadow:0 8px 28px rgba(0,0,0,.3);
}

body{
    background:var(--bg);
    font-family:'DM Sans',sans-serif;
}

.cart-page{
    max-width:1240px;
    margin:auto;
    padding:36px 24px 72px;
}

/* ── HERO ── */
.cart-hero{
    background:var(--g);
    border-radius:var(--radius-xl);
    padding:44px 48px;
    margin-bottom:26px;
    position:relative;
    overflow:hidden;
    color:white;
}

.cart-hero::after{
    content:'';
    position:absolute;
    width:320px;height:320px;
    border-radius:50%;
    border:1px solid rgba(255,255,255,.07);
    right:-80px;top:-80px;
    pointer-events:none;
}

.cart-hero::before{
    content:'';
    position:absolute;
    width:180px;height:180px;
    border-radius:50%;
    border:1px solid rgba(255,255,255,.05);
    right:60px;top:60px;
    pointer-events:none;
}

.cart-badge{
    display:inline-flex;
    align-items:center;
    gap:8px;

    background:rgba(255,255,255,.1);
    border:1px solid rgba(255,255,255,.13);
    color:rgba(255,255,255,.85);

    padding:8px 16px;
    border-radius:999px;

    font-family:'Sora',sans-serif;
    font-size:12px;
    font-weight:600;
    letter-spacing:.5px;
    text-transform:uppercase;
}

.cart-title{
    font-family:'Sora',sans-serif;
    font-size:42px;
    font-weight:800;
    margin-top:18px;
    line-height:1.15;
}

.cart-subtitle{
    margin-top:10px;
    color:rgba(255,255,255,.6);
    font-size:14.5px;
    line-height:1.75;
    max-width:520px;
}

/* ── GRID ── */
.cart-grid{
    display:grid;
    grid-template-columns:1.4fr .75fr;
    gap:22px;
}

/* ── CARD ── */
.cart-card{
    background:var(--white);
    border:1px solid var(--border);
    border-radius:var(--radius-xl);
    box-shadow:var(--shadow);
    overflow:hidden;
}

.card-header{
    padding:20px 26px 18px;
    border-bottom:1px solid var(--border);
    display:flex;
    justify-content:space-between;
    align-items:center;
}

.card-header-title{
    font-family:'Sora',sans-serif;
    font-size:15px;
    font-weight:700;
    color:var(--text);
}

.item-count-badge{
    background:var(--g3);
    color:var(--g);
    font-family:'Sora',sans-serif;
    font-size:12px;
    font-weight:700;
    padding:4px 12px;
    border-radius:999px;
}

/* ── ITEM ── */
.cart-item{
    display:flex;
    align-items:center;
    gap:20px;
    padding:24px 26px;
    border-bottom:1px solid var(--border);
    flex-wrap:wrap;
    transition:.2s background;
}

.cart-item:last-child{
    border-bottom:none;
}

.cart-item:hover{
    background:rgba(31,92,53,.02);
}

.product-left{
    display:flex;
    gap:18px;
    flex:1;
    min-width:220px;
    align-items:center;
}

.product-image{
    width:92px;
    height:92px;
    border-radius:16px;
    background:var(--g3);
    border:1px solid var(--border);
    display:flex;
    align-items:center;
    justify-content:center;
    flex-shrink:0;
}

.product-image img{
    width:60px;
    object-fit:contain;
}

.product-name{
    font-family:'Sora',sans-serif;
    font-size:17px;
    font-weight:700;
    color:var(--text);
}

.product-code{
    margin-top:5px;
    color:var(--muted);
    font-size:13px;
}

.product-price{
    margin-top:12px;
    color:var(--g);
    font-family:'Sora',sans-serif;
    font-size:19px;
    font-weight:700;
}

/* ── RIGHT ── */
.item-right{
    display:flex;
    align-items:center;
    gap:12px;
    flex-wrap:wrap;
    margin-left:auto;
}

/* ── QTY ── */
.qty-wrap{
    display:flex;
    align-items:center;
    gap:6px;
    background:var(--bg);
    border:1px solid var(--border);
    border-radius:12px;
    padding:7px 12px;
}

.qty-btn{
    background:none;
    border:none;
    cursor:pointer;
    color:var(--muted);
    font-size:18px;
    line-height:1;
    padding:2px 4px;
    transition:.15s;
    font-family:'DM Sans',sans-serif;
}

.qty-btn:hover{
    color:var(--g);
}

.qty-input{
    width:46px;
    text-align:center;
    background:transparent;
    border:none;
    outline:none;
    font-weight:700;
    font-size:15px;
    color:var(--text);
    font-family:'DM Sans',sans-serif;
}

/* ── BUTTONS ── */
.btn-update{
    background:var(--g3);
    color:var(--g);
    border:1px solid #BFD9CA;
    border-radius:12px;
    padding:10px 16px;
    font-weight:600;
    font-size:13px;
    cursor:pointer;
    transition:.2s;
    font-family:'DM Sans',sans-serif;
}

.btn-update:hover{
    background:#D5EBD9;
}

html.dark .btn-update{
    background:#1B3322;
    color:#6EC991;
    border-color:#254E30;
}

.subtotal{
    font-family:'Sora',sans-serif;
    font-size:19px;
    font-weight:800;
    color:var(--g);
    min-width:120px;
    text-align:right;
}

.btn-delete{
    display:flex;
    align-items:center;
    gap:6px;

    background:#FEF2F2;
    color:#B91C1C;
    border:1px solid #FCD5D5;
    border-radius:12px;
    padding:10px 14px;
    font-weight:600;
    font-size:13px;
    cursor:pointer;
    transition:.2s;
    font-family:'DM Sans',sans-serif;
}

.btn-delete:hover{
    background:#FEE2E2;
}

html.dark .btn-delete{
    background:#2D1A1A;
    color:#FCA5A5;
    border-color:#4A2424;
}

/* ── SUMMARY ── */
.summary-card{
    background:var(--white);
    border:1px solid var(--border);
    border-radius:var(--radius-xl);
    box-shadow:var(--shadow);
    padding:28px;
    position:sticky;
    top:90px;
    height:fit-content;
}

.summary-title{
    font-family:'Sora',sans-serif;
    font-size:22px;
    font-weight:800;
    color:var(--text);
    margin-bottom:24px;
}

.summary-row{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:16px;
    font-size:14px;
}

.summary-row span{
    color:var(--muted);
}

.summary-row strong{
    color:var(--text);
    font-weight:600;
}

.summary-row .free{
    color:#15803D;
}

.summary-divider{
    border:none;
    border-top:1px dashed var(--border);
    margin:20px 0;
}

.summary-total{
    display:flex;
    justify-content:space-between;
    align-items:baseline;
}

.summary-total span{
    font-size:14px;
    color:var(--muted);
    font-weight:500;
}

.summary-total strong{
    font-family:'Sora',sans-serif;
    font-size:30px;
    font-weight:800;
    color:var(--g);
}

.checkout-btn{
    display:flex;
    align-items:center;
    justify-content:center;
    gap:10px;

    width:100%;
    margin-top:24px;

    background:var(--g);
    color:white;

    border:none;
    border-radius:16px;
    padding:16px;

    font-family:'Sora',sans-serif;
    font-size:15px;
    font-weight:700;

    text-decoration:none;
    cursor:pointer;
    transition:.2s;
}

.checkout-btn:hover{
    background:var(--g2);
}

.shop-btn{
    display:flex;
    align-items:center;
    justify-content:center;
    gap:8px;

    width:100%;
    margin-top:12px;

    background:transparent;
    border:1px solid var(--border);
    border-radius:14px;
    padding:14px;

    font-size:14px;
    font-weight:600;
    color:var(--muted);

    text-decoration:none;
    transition:.2s;
}

.shop-btn:hover{
    border-color:#B0C8B8;
    color:var(--text);
}

/* ── EMPTY ── */
.empty-box{
    background:var(--white);
    border:1px solid var(--border);
    border-radius:var(--radius-xl);
    box-shadow:var(--shadow);
    text-align:center;
    padding:80px 32px;
}

.empty-icon{
    width:72px;
    height:72px;
    background:var(--g3);
    border-radius:50%;
    display:flex;
    align-items:center;
    justify-content:center;
    margin:0 auto;
}

.empty-title{
    font-family:'Sora',sans-serif;
    font-size:28px;
    font-weight:800;
    color:var(--text);
    margin-top:20px;
}

.empty-text{
    color:var(--muted);
    margin-top:8px;
    font-size:15px;
}

.empty-btn{
    display:inline-flex;
    align-items:center;
    gap:10px;

    margin-top:24px;

    background:var(--g);
    color:white;

    padding:14px 28px;
    border-radius:16px;

    font-family:'Sora',sans-serif;
    font-size:14px;
    font-weight:700;

    text-decoration:none;
    transition:.2s;
}

.empty-btn:hover{
    background:var(--g2);
}

/* ── RESPONSIVE ── */
@media(max-width:900px){
    .cart-grid{
        grid-template-columns:1fr;
    }
    .summary-card{
        position:static;
    }
}

@media(max-width:700px){
    .cart-page{
        padding:22px 16px 56px;
    }
    .cart-hero{
        padding:30px 26px;
        border-radius:22px;
    }
    .cart-title{
        font-size:30px;
    }
    .cart-item{
        padding:20px;
    }
    .product-left{
        flex-direction:column;
        align-items:flex-start;
    }
    .product-image{
        width:80px;
        height:80px;
    }
    .item-right{
        width:100%;
        justify-content:flex-end;
    }
    .subtotal{
        font-size:17px;
    }
}
</style>

<div class="cart-page">

    {{-- HERO --}}
    <div class="cart-hero">

        <div class="cart-badge">
            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/>
                <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/>
            </svg>
            Keranjang Belanja — AgroMart
        </div>

        <div class="cart-title">Keranjang Anda</div>

        <div class="cart-subtitle">
            Periksa kembali produk pilihan Anda sebelum melanjutkan ke proses checkout dan pembayaran.
        </div>

    </div>

    @if($carts->count() > 0)

    <div class="cart-grid">

        {{-- LEFT --}}
        <div class="cart-card">

            <div class="card-header">
                <div class="card-header-title">Produk Dipilih</div>
                <div class="item-count-badge">{{ $carts->count() }} item</div>
            </div>

            @foreach($carts as $cart)

            @php
                $imageFile = 'newlogo.png';
                $namaLow   = strtolower($cart->pupuk->nama);

                if(str_contains($namaLow, 'kompos')){
                    $imageFile = 'kompos.png';
                } elseif(str_contains($namaLow, 'urea')){
                    $imageFile = 'urea.png';
                } elseif(str_contains($namaLow, 'npk')){
                    $imageFile = 'npk.png';
                }
            @endphp

            <div class="cart-item">

                <div class="product-left">

                    <div class="product-image">
                        <img src="{{ asset('images/'.$imageFile) }}" alt="{{ $cart->pupuk->nama }}">
                    </div>

                    <div>
                        <div class="product-name">{{ $cart->pupuk->nama }}</div>
                        <div class="product-code">Kode Produk: {{ $cart->pupuk->kode }}</div>
                        <div class="product-price">Rp {{ number_format($cart->pupuk->harga, 0, ',', '.') }}</div>
                    </div>

                </div>

                <div class="item-right">

                    <form
                        action="{{ route('cart.update', $cart->id) }}"
                        method="POST"
                        style="display:flex;align-items:center;gap:10px;"
                    >
                        @csrf

                        <div class="qty-wrap">
                            <button
                                type="button"
                                class="qty-btn"
                                onclick="
                                    const i=this.nextElementSibling;
                                    if(parseInt(i.value)>1) i.value=parseInt(i.value)-1;
                                "
                            >−</button>

                            <input
                                type="number"
                                name="qty"
                                min="1"
                                value="{{ $cart->qty }}"
                                class="qty-input"
                            >

                            <button
                                type="button"
                                class="qty-btn"
                                onclick="
                                    const i=this.previousElementSibling;
                                    i.value=parseInt(i.value)+1;
                                "
                            >+</button>
                        </div>

                        <button type="submit" class="btn-update">Update</button>

                    </form>

                    <div class="subtotal">
                        Rp {{ number_format($cart->qty * $cart->pupuk->harga, 0, ',', '.') }}
                    </div>

                    <form
                        action="{{ route('cart.remove', $cart->id) }}"
                        method="POST"
                    >
                        @csrf
                        @method('DELETE')

                        <button
                            type="submit"
                            class="btn-delete"
                            onclick="return confirm('Hapus produk ini dari keranjang?')"
                        >
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="3 6 5 6 21 6"/>
                                <path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/>
                                <path d="M10 11v6"/><path d="M14 11v6"/>
                                <path d="M9 6V4h6v2"/>
                            </svg>
                            Hapus
                        </button>

                    </form>

                </div>

            </div>

            @endforeach

        </div>

        {{-- RIGHT --}}
        <div class="summary-card">

            <div class="summary-title">Ringkasan Belanja</div>

            <div class="summary-row">
                <span>Total Item</span>
                <strong>{{ $carts->count() }} produk</strong>
            </div>

            <div class="summary-row">
                <span>Subtotal</span>
                <strong>Rp {{ number_format($total, 0, ',', '.') }}</strong>
            </div>

            <div class="summary-row">
                <span>Biaya Pengiriman</span>
                <strong class="free">Gratis</strong>
            </div>

            <hr class="summary-divider">

            <div class="summary-total">
                <span>Total Bayar</span>
                <strong>Rp {{ number_format($total, 0, ',', '.') }}</strong>
            </div>

            <a href="{{ route('checkout.form') }}" class="checkout-btn">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M5 12h14"/><path d="M12 5l7 7-7 7"/>
                </svg>
                Checkout Sekarang
            </a>

            <a href="{{ route('pupuk.index') }}" class="shop-btn">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="12" y1="5" x2="12" y2="19"/>
                    <line x1="5" y1="12" x2="19" y2="12"/>
                </svg>
                Tambah Produk Lain
            </a>

        </div>

    </div>

    @else

    <div class="empty-box">

        <div class="empty-icon">
            <svg width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="#2E7D4F" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/>
                <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/>
            </svg>
        </div>

        <div class="empty-title">Keranjang Masih Kosong</div>

        <div class="empty-text">
            Mulai belanja pupuk terbaik untuk kebutuhan pertanian Anda
        </div>

        <a href="{{ route('pupuk.index') }}" class="empty-btn">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>
                <polyline points="9 22 9 12 15 12 15 22"/>
            </svg>
            Mulai Belanja
        </a>

    </div>

    @endif

</div>

@endsection