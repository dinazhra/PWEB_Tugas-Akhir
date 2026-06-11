@extends('layouts.app')

@section('title', 'Invoice')

@section('content')

<div style="
    max-width:1000px;
    margin:40px auto;
    padding:20px;
">

    <div style="
        background:white;
        border-radius:24px;
        padding:40px;
        box-shadow:0 5px 25px rgba(0,0,0,.08);
    ">

        {{-- HEADER --}}
        <div style="
            display:flex;
            justify-content:space-between;
            align-items:center;
            margin-bottom:30px;
            border-bottom:2px dashed #ddd;
            padding-bottom:20px;
            flex-wrap:wrap;
            gap:20px;
        ">

            <div>
                <h1 style="
                    margin:0;
                    color:#1e3a1e;
                    font-size:36px;
                ">
                    🌿 AgroMart
                </h1>

                <p style="
                    color:#777;
                    margin-top:8px;
                ">
                    Invoice Pembelian
                </p>
            </div>

            <div style="text-align:right;">

                <div style="
                    font-size:28px;
                    font-weight:700;
                    color:#2d5a1b;
                ">
                    INV-{{ str_pad($transaction->id,4,'0',STR_PAD_LEFT) }}
                </div>

                <div style="color:#777;">
                    {{ $transaction->created_at->format('d M Y H:i') }}
                </div>

            </div>

        </div>

        {{-- INFO --}}
        <div style="
            display:grid;
            grid-template-columns:1fr 1fr;
            gap:30px;
            margin-bottom:30px;
        ">

            <div>

                <h3 style="color:#1e3a1e;">
                    Data Penerima
                </h3>

                <p>
                    <strong>Nama:</strong><br>
                    {{ $transaction->nama_penerima }}
                </p>

                <p>
                    <strong>No HP:</strong><br>
                    {{ $transaction->no_hp }}
                </p>

                <p>
                    <strong>Alamat:</strong><br>
                    {{ $transaction->alamat }}
                </p>

            </div>

            <div>

                <h3 style="color:#1e3a1e;">
                    Detail Pesanan
                </h3>

                <p>
                    <strong>Metode Bayar:</strong><br>
                    {{ $transaction->metode_pembayaran }}
                </p>

                <p>
                    <strong>Status:</strong><br>
                    {{ ucfirst($transaction->status) }}
                </p>

                <p>
                    <strong>Total:</strong><br>
                    Rp {{ number_format($transaction->total,0,',','.') }}
                </p>

            </div>

        </div>

        {{-- TABLE --}}
        <table style="
            width:100%;
            border-collapse:collapse;
            margin-top:20px;
        ">

            <thead>
                <tr style="
                    background:#f4f8ef;
                    color:#1e3a1e;
                ">
                    <th style="padding:15px;">Produk</th>
                    <th>Qty</th>
                    <th>Harga</th>
                    <th>Subtotal</th>
                </tr>
            </thead>

            <tbody>

                @foreach($transaction->items as $item)

                <tr style="
                    border-bottom:1px solid #eee;
                    text-align:center;
                ">

                    <td style="
                        padding:15px;
                        text-align:left;
                    ">
                        {{ $item->pupuk->nama }}
                    </td>

                    <td>
                        {{ $item->qty }}
                    </td>

                    <td>
                        Rp {{ number_format($item->harga,0,',','.') }}
                    </td>

                    <td>
                        Rp {{ number_format($item->subtotal,0,',','.') }}
                    </td>

                </tr>

                @endforeach

            </tbody>
        </table>

        {{-- TOTAL --}}
        <div style="
            margin-top:30px;
            text-align:right;
        ">

            <div style="
                font-size:30px;
                font-weight:700;
                color:#2d5a1b;
            ">
                Total:
                Rp {{ number_format($transaction->total,0,',','.') }}
            </div>

        </div>

        {{-- BUTTON --}}
        <div style="
            margin-top:40px;
            display:flex;
            gap:10px;
            justify-content:flex-end;
        ">

            <a href="{{ route('pesanan') }}"
               style="
                padding:12px 20px;
                border-radius:12px;
                background:#eee;
                color:#333;
                text-decoration:none;
                font-weight:600;
               ">
                Kembali
            </a>

            <button onclick="window.print()"
                style="
                    border:none;
                    background:#2d5a1b;
                    color:white;
                    padding:12px 22px;
                    border-radius:12px;
                    font-weight:700;
                    cursor:pointer;
                ">
                🖨 Print Invoice
            </button>

        </div>

    </div>

</div>

@endsection