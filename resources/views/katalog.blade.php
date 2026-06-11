@extends('layouts.app')

@section('title', 'Katalog Produk')

@section('content')

<div style="max-width:1200px; margin:40px auto; padding:20px;">
    
    <h1 style="
        font-size:32px;
        color:#1e3a1e;
        margin-bottom:10px;
        font-weight:700;
    ">
        🌿 Katalog Produk
    </h1>

    <p style="color:#666; margin-bottom:30px;">
        Pilih pupuk terbaik untuk kebutuhan pertanian Anda.
    </p>

    <div style="
        display:grid;
        grid-template-columns:repeat(auto-fit,minmax(250px,1fr));
        gap:20px;
    ">

        @foreach($dataPupuk as $pupuk)

            <div style="
                background:white;
                border-radius:20px;
                box-shadow:0 6px 20px rgba(0,0,0,0.08);
                padding:20px;
            ">

                <div style="font-size:50px;">
                    🌱
                </div>

                <h3 style="
                    font-size:20px;
                    margin:15px 0 10px;
                    color:#1e3a1e;
                ">
                    {{ $pupuk['nama'] }}
                </h3>

                <p style="color:#777;">
                    Kategori: {{ $pupuk['kategori'] }}
                </p>

                <p style="
                    font-weight:700;
                    color:#76944C;
                    margin-top:10px;
                ">
                    {{ $pupuk['harga'] }}
                </p>

                <button style="
                    margin-top:15px;
                    width:100%;
                    background:#76944C;
                    color:white;
                    border:none;
                    padding:12px;
                    border-radius:12px;
                    cursor:pointer;
                    font-weight:600;
                ">
                    Pesan Sekarang
                </button>

            </div>

        @endforeach

    </div>
</div>

@endsection