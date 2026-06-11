@extends('layouts.app')

@section('title', 'Riwayat Transaksi')

@section('content')

<style>
:root{
    --green:#2f6b3c;
    --green-dark:#1f4d2d;
    --green-soft:#eef7f0;
    --border:#e5e7eb;
    --text:#1f2937;
    --muted:#6b7280;
    --white:#ffffff;
}

.history-wrap{
    max-width:1150px;
    margin:40px auto;
    padding:0 20px 60px;
}

.history-header{
    margin-bottom:30px;
}

.history-header h1{
    font-size:34px;
    font-weight:700;
    color:var(--green-dark);
    margin-bottom:8px;
}

.history-header p{
    color:var(--muted);
    font-size:15px;
}

.transaction-list{
    display:flex;
    flex-direction:column;
    gap:22px;
}

.transaction-card{
    background:var(--white);
    border:1px solid var(--border);
    border-radius:24px;
    overflow:hidden;
    box-shadow:0 8px 25px rgba(0,0,0,.05);
    transition:.25s;
}

.transaction-card:hover{
    transform:translateY(-3px);
    box-shadow:0 12px 30px rgba(0,0,0,.08);
}

.transaction-top{
    padding:22px 28px;
    background:linear-gradient(135deg,#1f4d2d,#2f6b3c);
    display:flex;
    justify-content:space-between;
    align-items:center;
    flex-wrap:wrap;
    gap:14px;
}

.transaction-id{
    color:white;
}

.transaction-id h3{
    margin:0;
    font-size:20px;
    font-weight:700;
}

.transaction-id span{
    font-size:13px;
    opacity:.8;
}

.status-badge{
    padding:10px 18px;
    border-radius:999px;
    background:white;
    color:var(--green-dark);
    font-weight:700;
    font-size:13px;
    letter-spacing:.5px;
}

.transaction-body{
    padding:28px;
}

.product-table{
    width:100%;
    border-collapse:collapse;
}

.product-table thead th{
    text-align:left;
    padding-bottom:14px;
    color:var(--muted);
    font-size:13px;
    border-bottom:1px solid var(--border);
}

.product-table tbody td{
    padding:18px 0;
    border-bottom:1px solid #f3f4f6;
    color:var(--text);
    font-size:14px;
}

.product-name{
    font-weight:600;
    color:var(--green-dark);
}

.subtotal{
    font-weight:700;
    color:var(--green);
}

.total-box{
    margin-top:24px;
    display:flex;
    justify-content:flex-end;
}

.total-content{
    background:var(--green-soft);
    border-radius:18px;
    padding:20px 24px;
    min-width:280px;
}

.total-row{
    display:flex;
    justify-content:space-between;
    align-items:center;
}

.total-row span{
    color:var(--muted);
    font-size:15px;
}

.total-row strong{
    color:var(--green-dark);
    font-size:28px;
}

.empty-state{
    background:white;
    border:1px solid var(--border);
    border-radius:28px;
    padding:80px 20px;
    text-align:center;
    box-shadow:0 8px 20px rgba(0,0,0,.04);
}

.empty-state img{
    width:120px;
    opacity:.9;
}

.empty-state h2{
    margin-top:20px;
    color:var(--green-dark);
    font-size:28px;
}

.empty-state p{
    margin-top:10px;
    color:var(--muted);
}

.shop-btn{
    display:inline-block;
    margin-top:28px;
    background:var(--green);
    color:white;
    text-decoration:none;
    padding:14px 26px;
    border-radius:14px;
    font-weight:600;
    transition:.2s;
}

.shop-btn:hover{
    background:var(--green-dark);
    transform:translateY(-2px);
}

@media(max-width:768px){

    .transaction-top{
        flex-direction:column;
        align-items:flex-start;
    }

    .product-table{
        display:block;
        overflow-x:auto;
    }

    .total-box{
        justify-content:stretch;
    }

    .total-content{
        width:100%;
    }
}
</style>

<div class="history-wrap">

    {{-- HEADER --}}
    <div class="history-header">
        <h1>Riwayat Transaksi</h1>
        <p>Lihat seluruh pesanan dan detail transaksi Anda.</p>
    </div>

    @if($transactions->count() > 0)

        <div class="transaction-list">

            @foreach($transactions as $transaction)

            <div class="transaction-card">

                {{-- TOP --}}
                <div class="transaction-top">

                    <div class="transaction-id">
                        <h3>
                            Transaksi #{{ $transaction->id }}
                        </h3>

                        <span>
                            {{ $transaction->created_at->format('d M Y • H:i') }}
                        </span>
                    </div>

                    <div class="status-badge">
                        {{ strtoupper($transaction->status) }}
                    </div>

                </div>

                {{-- BODY --}}
                <div class="transaction-body">

                    <table class="product-table">

                        <thead>
                            <tr>
                                <th>Produk</th>
                                <th>Harga</th>
                                <th>Qty</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach($transaction->items as $item)

                            <tr>

                                <td class="product-name">
                                    {{ $item->pupuk->nama }}
                                </td>

                                <td>
                                    Rp {{ number_format($item->harga,0,',','.') }}
                                </td>

                                <td>
                                    {{ $item->qty }}
                                </td>

                                <td class="subtotal">
                                    Rp {{ number_format($item->subtotal,0,',','.') }}
                                </td>

                            </tr>

                            @endforeach

                        </tbody>

                    </table>

                    {{-- TOTAL --}}
                    <div class="total-box">

                        <div class="total-content">

                            <div class="total-row">

                                <span>Total Pembayaran</span>

                                <strong>
                                    Rp {{ number_format($transaction->total,0,',','.') }}
                                </strong>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            @endforeach

        </div>

    @else

        {{-- EMPTY --}}
        <div class="empty-state">

            <img src="{{ asset('images/newlogo.png') }}">

            <h2>Belum Ada Transaksi</h2>

            <p>
                Kamu belum memiliki riwayat pembelian produk pupuk.
            </p>

            <a href="{{ route('pupuk.index') }}"
               class="shop-btn">
                Mulai Belanja
            </a>

        </div>

    @endif

</div>

@endsection