@extends('layouts.app')

@section('title', 'Checkout - AgroMart')

@section('content')

<style>
:root{
    --green:#2f6b3c;
    --green-dark:#1f4d2b;
    --green-soft:#edf7ef;
    --border:#e5e7eb;
    --text:#1f2937;
    --muted:#6b7280;
    --white:#ffffff;
    --shadow:0 12px 35px rgba(0,0,0,.06);
}

body{
    background:#f8faf8;
}

/* PAGE */
.checkout-page{
    max-width:1250px;
    margin:40px auto 80px;
    padding:0 24px;
}

/* HEADER */
.checkout-header{
    margin-bottom:34px;
}

.checkout-badge{
    display:inline-flex;
    align-items:center;
    gap:8px;
    background:var(--green-soft);
    color:var(--green);
    padding:10px 18px;
    border-radius:999px;
    font-size:13px;
    font-weight:700;
    margin-bottom:18px;
}

.checkout-title{
    font-size:42px;
    font-weight:800;
    color:var(--green-dark);
    margin-bottom:10px;
}

.checkout-subtitle{
    color:var(--muted);
    font-size:15px;
}

/* STEP */
.checkout-step{
    display:flex;
    align-items:center;
    justify-content:center;
    gap:20px;
    margin-bottom:35px;
    flex-wrap:wrap;
}

.step{
    display:flex;
    align-items:center;
    gap:10px;
}

.step-circle{
    width:42px;
    height:42px;
    border-radius:50%;
    background:var(--green);
    color:white;
    display:flex;
    align-items:center;
    justify-content:center;
    font-weight:700;
}

.step-text{
    font-weight:700;
    color:var(--green-dark);
}

.step-line{
    width:70px;
    height:2px;
    background:#d1d5db;
}

/* GRID */
.checkout-grid{
    display:grid;
    grid-template-columns:1.3fr .8fr;
    gap:28px;
}

/* CARD */
.card{
    background:white;
    border-radius:28px;
    box-shadow:var(--shadow);
    border:1px solid #eef2ef;
}

.form-card{
    padding:35px;
}

.summary-card{
    padding:30px;
    position:sticky;
    top:100px;
    height:fit-content;
}

.card-title{
    font-size:22px;
    font-weight:800;
    color:var(--green-dark);
    margin-bottom:24px;
}

/* INPUT */
.form-group{
    margin-bottom:22px;
}

.form-label{
    display:block;
    margin-bottom:10px;
    font-weight:700;
    color:var(--text);
    font-size:14px;
}

.form-control{
    width:100%;
    padding:16px 18px;
    border-radius:16px;
    border:1px solid var(--border);
    outline:none;
    font-size:15px;
    transition:.25s;
    box-sizing:border-box;
    background:#fbfdfb;
}

.form-control:focus{
    border-color:var(--green);
    box-shadow:0 0 0 5px rgba(47,107,60,.08);
}

/* PAYMENT */
.payment-option{
    border:2px solid #eef2ef;
    border-radius:18px;
    padding:18px;
    margin-bottom:14px;
    cursor:pointer;
    transition:.25s;
}

.payment-option:hover{
    border-color:var(--green);
    background:var(--green-soft);
}

.payment-option input{
    margin-right:10px;
}

/* PRODUCT */
.product-box{
    display:flex;
    gap:16px;
    background:var(--green-soft);
    border-radius:20px;
    padding:18px;
    margin-bottom:22px;
}

.product-image{
    width:80px;
    height:80px;
    border-radius:18px;
    background:white;
    display:flex;
    align-items:center;
    justify-content:center;
}

.product-image img{
    width:100%;
    height:100%;
    object-fit:cover;
    border-radius:18px;
}

.product-name{
    font-size:16px;
    font-weight:700;
    color:var(--green-dark);
}

.product-price{
    margin-top:6px;
    color:var(--green);
    font-weight:700;
}

/* SUMMARY */
.summary-row{
    display:flex;
    justify-content:space-between;
    margin-bottom:18px;
    color:var(--muted);
}

.summary-total{
    border-top:1px dashed #d1d5db;
    margin-top:18px;
    padding-top:22px;
    display:flex;
    justify-content:space-between;
    align-items:center;
}

.summary-total h2{
    color:var(--green-dark);
    font-size:32px;
    margin:0;
}

/* BUTTON */
.checkout-btn{
    width:100%;
    margin-top:28px;
    border:none;
    background:linear-gradient(135deg,#2f6b3c,#1f4d2b);
    color:white;
    padding:18px;
    border-radius:18px;
    font-size:16px;
    font-weight:700;
    cursor:pointer;
    transition:.25s;
}

.checkout-btn:hover{
    transform:translateY(-3px);
}

.secure-box{
    margin-top:18px;
    text-align:center;
    color:var(--muted);
    font-size:13px;
}

/* MOBILE */
@media(max-width:950px){

    .checkout-grid{
        grid-template-columns:1fr;
    }

    .summary-card{
        position:static;
    }

    .checkout-title{
        font-size:34px;
    }
}
</style>

<div class="checkout-page">

    {{-- HEADER --}}
    <div class="checkout-header">

        <div class="checkout-badge">
            🛒 Checkout AgroMart
        </div>

        <div class="checkout-title">
            Selesaikan Pesanan Anda
        </div>

        <div class="checkout-subtitle">
            Lengkapi data pengiriman dan pilih metode pembayaran
        </div>

    </div>

    {{-- STEP --}}
    <div class="checkout-step">

        <div class="step">
            <div class="step-circle">1</div>
            <div class="step-text">Keranjang</div>
        </div>

        <div class="step-line"></div>

        <div class="step">
            <div class="step-circle">2</div>
            <div class="step-text">Checkout</div>
        </div>

        <div class="step-line"></div>

        <div class="step">
            <div class="step-circle">3</div>
            <div class="step-text">Pembayaran</div>
        </div>

    </div>

    <form action="{{ route('checkout') }}" method="POST">
        @csrf

        @if(isset($pupuk))
            <input type="hidden" name="buy_now" value="1">
            <input type="hidden" name="pupuk_id" value="{{ $pupuk->id }}">
        @endif

        <div class="checkout-grid">

            {{-- LEFT --}}
            <div class="card form-card">

                <div class="card-title">
                    Informasi Pengiriman
                </div>

                <div class="form-group">
                    <label class="form-label">
                        Nama Penerima
                    </label>

                    <input
                        type="text"
                        name="nama_penerima"
                        class="form-control"
                        placeholder="Masukkan nama penerima"
                        required
                    >
                </div>

                <div class="form-group">
                    <label class="form-label">
                        Nomor HP
                    </label>

                    <input
                        type="text"
                        name="no_hp"
                        class="form-control"
                        placeholder="08xxxxxxxxxx"
                        required
                    >
                </div>

                <div class="form-group">
                    <label class="form-label">
                        Alamat Lengkap
                    </label>

                    <textarea
                        name="alamat"
                        rows="5"
                        class="form-control"
                        placeholder="Masukkan alamat lengkap pengiriman"
                        required
                    ></textarea>
                </div>

                <div class="card-title" style="margin-top:40px;">
                    Metode Pembayaran
                </div>

                <label class="payment-option">
                    <input type="radio"
                           name="metode_pembayaran"
                           value="COD"
                           required>

                    🚚 Bayar di Tempat (COD)
                </label>

                <label class="payment-option">
                    <input type="radio"
                           name="metode_pembayaran"
                           value="Transfer Bank">

                    🏦 Transfer Bank
                </label>

                <div class="form-group" style="margin-top:25px;">
                    <label class="form-label">
                        Catatan Tambahan
                    </label>

                    <textarea
                        name="catatan"
                        rows="4"
                        class="form-control"
                        placeholder="Tambahkan catatan jika diperlukan"
                    ></textarea>
                </div>

            </div>

            {{-- RIGHT --}}
            <div class="card summary-card">

                <div class="card-title">
                    Ringkasan Pesanan
                </div>

                @if(isset($pupuk))

                    <div class="product-box">

                        <div class="product-image">

                            @if($pupuk->foto)

                                <img src="{{ asset('storage/'.$pupuk->foto) }}"
                                    alt="{{ $pupuk->nama }}">

                            @else

                                <img src="{{ asset('images/newlogo.png') }}"
                                    alt="AgroMart">

                            @endif

                        </div>

                        <div>
                            <div class="product-name">
                                {{ $pupuk->nama }}
                            </div>

                            <div class="product-price">
                                Rp {{ number_format($pupuk->harga,0,',','.') }}
                            </div>
                        </div>

                    </div>

                @else

                    <div class="product-box">
                        <div>
                            <div class="product-name">
                                {{ $carts->count() }} Produk Dipilih
                            </div>

                            <div class="product-price">
                                Siap untuk checkout
                            </div>
                        </div>
                    </div>

                @endif

                <div class="summary-row">
                    <span>Subtotal</span>
                    <strong>
                        Rp {{ number_format($total,0,',','.') }}
                    </strong>
                </div>

                <div class="summary-row">
                    <span>Ongkir</span>
                    <strong>Gratis</strong>
                </div>

                <div class="summary-total">

                    <div>
                        <small style="color:gray;">
                            Total Bayar
                        </small>

                        <h2>
                            Rp {{ number_format($total,0,',','.') }}
                        </h2>
                    </div>

                </div>

                <button type="submit"
                        class="checkout-btn">

                    Bayar Sekarang 

                </button>

                <a href="{{ route('checkout.cancel') }}"
                    style="
                        display:flex;
                        justify-content:center;
                        align-items:center;

                        width:100%;
                        height:56px;

                        border-radius:18px;

                        text-decoration:none;

                        background:
                        linear-gradient(
                            135deg,
                            #dc2626,
                            #b91c1c
                        );

                        color:white;
                        font-weight:800;
                        font-size:16px;

                        margin-bottom:20px;
                        margin-top:20px;

                        box-shadow:
                        0 10px 20px rgba(220,38,38,.25);

                        transition:.3s;
                    ">
                        Batal Checkout
                </a>

                <div class="secure-box">
                    🔒 Pembayaran aman & terenkripsi
                </div>

            </div>

        </div>

    </form>

</div>

@endsection