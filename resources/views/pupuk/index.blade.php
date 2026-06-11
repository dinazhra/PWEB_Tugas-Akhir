@extends('layouts.app')

@section('title', auth()->user()->role === 'admin'
    ? 'Kelola Produk - AgroMart'
    : 'Katalog Produk - AgroMart')

@section('content')

<style>
:root{
    --green:#2f6b3c;
    --green-dark:#1d4b29;
    --green-soft:#eef7ef;
    --bg:#f7faf7;
    --border:#e8ece8;
    --text:#1f2937;
    --muted:#6b7280;
    --danger:#dc2626;
    --white:#ffffff;
}

.catalog-page{
    max-width:1400px;
    margin:auto;
    padding:10px 10px 50px;
}

/* HERO */

.catalog-hero{
    background:
    linear-gradient(
        135deg,
        #1d4b29,
        #2f6b3c
    );
    border-radius:34px;
    padding:50px;
    color:white;
    position:relative;
    overflow:hidden;
    margin-bottom:30px;
}

.catalog-hero::before{
    content:'';
    position:absolute;
    right:-70px;
    top:-70px;
    width:250px;
    height:250px;
    border-radius:50%;
    background:rgba(255,255,255,.08);
}

.catalog-hero::after{
    content:'';
    position:absolute;
    left:-60px;
    bottom:-60px;
    width:200px;
    height:200px;
    border-radius:50%;
    background:rgba(255,255,255,.05);
}

.hero-flex{
    display:flex;
    justify-content:space-between;
    align-items:center;
    gap:20px;
    flex-wrap:wrap;
}

.hero-title{
    font-size:42px;
    font-weight:800;
    margin-bottom:10px;
}

.hero-subtitle{
    max-width:700px;
    opacity:.9;
    line-height:1.7;
}

.hero-action{
    display:flex;
    gap:14px;
}

.hero-btn{
    background:white;
    color:var(--green);
    border:none;
    padding:16px 22px;
    border-radius:18px;
    font-weight:700;
    text-decoration:none;
    transition:.25s;
}

.hero-btn:hover{
    transform:translateY(-3px);
}

/* TOOLBAR */

.catalog-toolbar{
    background:white;
    border-radius:28px;
    border:1px solid var(--border);
    padding:22px;
    display:flex;
    justify-content:space-between;
    gap:20px;
    align-items:center;
    flex-wrap:wrap;
    margin-bottom:28px;

    box-shadow:
    0 8px 30px rgba(0,0,0,.04);
}

.search-box{
    flex:1;
    min-width:280px;
    position:relative;
}

.search-box input{
    width:100%;
    border:none;
    background:#f5f8f5;
    border-radius:18px;
    padding:18px 22px 18px 56px;
    font-size:15px;
    outline:none;
}

.search-box i{
    position:absolute;
    left:22px;
    top:50%;
    transform:translateY(-50%);
    color:#94a3b8;
}

.total-product{
    font-size:15px;
    color:var(--muted);
}

.total-product strong{
    color:var(--green-dark);
}

/* GRID */

.catalog-grid{
    display:grid;
    grid-template-columns:
    repeat(auto-fill,minmax(280px,1fr));
    gap:26px;
}

/* CARD */

.product-card{
    background:white;
    border-radius:30px;
    border:1px solid var(--border);
    overflow:hidden;
    transition:.28s;
    position:relative;

    box-shadow:
    0 10px 25px rgba(0,0,0,.04);
}

.product-card:hover{
    transform:translateY(-8px);
    box-shadow:
    0 18px 40px rgba(0,0,0,.08);
}

.product-image{
    height:260px;
    background:
    linear-gradient(
        180deg,
        #edf7ef,
        #ffffff
    );

    display:flex;
    align-items:center;
    justify-content:center;
    padding:30px;
}

.product-img{
    width:100%;
    height:100%;
    max-width:220px;
    max-height:220px;
    object-fit:contain;
    transition:.3s;
}

.product-card:hover img{
    transform:scale(1.08);
}

.stock-badge{
    position:absolute;
    top:18px;
    right:18px;

    padding:10px 14px;
    border-radius:999px;
    background:white;
    border:1px solid var(--border);

    font-size:12px;
    font-weight:700;
}

.stock-low{
    color:var(--danger);
}

.stock-good{
    color:var(--green);
}

.product-content{
    padding:24px;
}

.product-code{
    color:#94a3b8;
    font-size:12px;
    font-weight:700;
    letter-spacing:1px;
}

.product-name{
    font-size:21px;
    font-weight:700;
    margin-top:8px;
    color:var(--text);
}

.product-category{
    margin-top:8px;
    display:inline-flex;
    padding:8px 14px;
    background:var(--green-soft);
    border-radius:999px;
    color:var(--green-dark);
    font-size:13px;
    font-weight:600;
}

.product-price{
    margin-top:18px;
    font-size:28px;
    font-weight:800;
    color:var(--green-dark);
}

/* ACTION */

.action-group{
    display:grid;
    grid-template-columns:1fr 1fr;
    gap:10px;
    margin-top:22px;
}

.btn-action{
    width:100%;
    border:none;
    border-radius:14px;
    padding:13px;
    font-size:13.5px;
    font-weight:700;
    cursor:pointer;
    transition:.25s;
    text-align:center;
    display:flex;
    align-items:center;
    justify-content:center;
    gap:6px;
}

.btn-primary{
    background:var(--green);
    color:white;
}

.btn-primary:hover{
    background:#245531;
}

.btn-soft{
    background:#f5f8f5;
    color:var(--green);
}

.btn-soft:hover{
    background:#edf7ef;
}

.btn-danger{
    background:#fff1f1;
    color:#b91c1c;
}

.btn-danger:hover{
    background:#fee2e2;
}

/* EMPTY */

.empty-state{
    grid-column:1/-1;
    text-align:center;
    padding:80px;
    background:white;
    border-radius:30px;
}

.empty-state i{
    font-size:52px;
    color:#d1d5db;
    margin-bottom:20px;
}

@media(max-width:768px){

    .catalog-hero{
        padding:30px;
    }

    .hero-title{
        font-size:32px;
    }

    .catalog-grid{
        grid-template-columns:1fr;
    }
}
</style>

<div class="catalog-page">

    {{-- HERO --}}
    <div class="catalog-hero">

        <div class="hero-flex">

            <div>

                <div class="hero-title">
                    {{
                        auth()->user()->role === 'admin'
                        ? 'Kelola Produk'
                        : 'Katalog Pupuk'
                    }}
                </div>

                <div class="hero-subtitle">
                    {{
                        auth()->user()->role === 'admin'
                        ? 'Kelola seluruh produk pupuk AgroMart dengan tampilan modern dan lebih nyaman.'
                        : 'Temukan pupuk terbaik untuk hasil panen maksimal dan pertanian yang lebih sehat.'
                    }}
                </div>

            </div>

            <div class="hero-action">

                @if(auth()->user()->role === 'admin')

                    <a href="{{ route('pupuk.create') }}"
                       class="hero-btn">
                        + Tambah Produk
                    </a>

                @else

                    <a href="{{ route('cart.index') }}"
                       class="hero-btn">
                        Keranjang
                    </a>

                @endif

            </div>

        </div>

    </div>

    {{-- TOOLBAR --}}
    <div class="catalog-toolbar">

        <div class="search-box">
            <i class="fa-solid fa-magnifying-glass"></i>

            <input
                type="text"
                id="live-search"
                placeholder="Cari nama atau kode produk..."
            >
        </div>

        <div class="total-product">
            Total Produk :
            <strong>{{ $pupuks->count() }}</strong>
        </div>

    </div>

    {{-- GRID --}}
    <div class="catalog-grid"
         id="produk-container">

        @forelse($pupuks as $pupuk)

        <div class="product-card">

            <div class="stock-badge {{ $pupuk->stok < 10 ? 'stock-low' : 'stock-good' }}">
                Stok: {{ $pupuk->stok }}
            </div>

            <div class="product-image">
                @if($pupuk->foto)
                    <img
                        src="{{ Storage::url($pupuk->foto) }}"
                        alt="{{ $pupuk->nama }}"
                        class="product-img"
                        onerror="this.src='{{ asset('images/tumbuhan.png') }}'"
                    >
                @else
                    <img
                        src="{{ asset('images/tumbuhan.png') }}"
                        alt="{{ $pupuk->nama }}"
                        class="product-img"
                    >
                @endif
            </div>

            <div class="product-content">

                <div class="product-code">
                    {{ $pupuk->kode }}
                </div>

                <div class="product-name">
                    {{ $pupuk->nama }}
                </div>

                <div class="product-category">
                    {{ $pupuk->kategori }}
                </div>

                <div class="product-price">
                    Rp {{ number_format($pupuk->harga,0,',','.') }}
                </div>

                @if(auth()->user()->role === 'admin')

                <div class="action-group">

                    <a href="{{ route('pupuk.edit',$pupuk->id) }}"
                       class="btn-action btn-soft">
                        Edit
                    </a>

                    <form action="{{ route('pupuk.destroy',$pupuk->id) }}"
                          method="POST"
                          style="display:contents;">
                        @csrf
                        @method('DELETE')

                        <button
                            class="btn-action btn-danger"
                            onclick="return confirm('Hapus produk ini?')">
                            Hapus
                        </button>

                    </form>

                </div>

                @else

                <div class="action-group">

                    <form action="{{ route('cart.add',$pupuk->id) }}"
                          method="POST"
                          style="display:contents;">
                        @csrf

                        <button class="btn-action btn-primary">
                            Keranjang
                        </button>
                    </form>

                    <form action="{{ route('buy.now',$pupuk->id) }}"
                          method="POST"
                          style="display:contents;">
                        @csrf

                        <button class="btn-action btn-soft">
                            Beli
                        </button>
                    </form>

                </div>

                @endif

            </div>

        </div>

        @empty

        <div class="empty-state">
            <i class="fa-solid fa-seedling"></i>
            <h3>Produk tidak ditemukan</h3>
        </div>

        @endforelse

    </div>

</div>

@endsection