@extends('layouts.app')

@section('title', 'Laporan Penjualan - AgroMart')

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
    --shadow:
        0 10px 30px rgba(0,0,0,.05);
}

.laporan-page{
    max-width:1400px;
    margin:auto;
    padding:30px;
}

/* HERO */
.hero{
    background:
    linear-gradient(
        135deg,
        #1f4d2b,
        #2f6b3c
    );
    border-radius:30px;
    padding:42px;
    color:white;
    margin-bottom:28px;
    position:relative;
    overflow:hidden;
}

.hero::before{
    content:'';
    position:absolute;
    width:280px;
    height:280px;
    border-radius:50%;
    background:rgba(255,255,255,.07);
    right:-90px;
    top:-90px;
}

.hero h1{
    font-size:38px;
    font-weight:800;
    margin:0;
}

.hero p{
    margin-top:10px;
    max-width:720px;
    opacity:.92;
    font-size:15px;
}

/* STATS */
.stats-grid{
    display:grid;
    grid-template-columns:
        repeat(auto-fit,minmax(250px,1fr));
    gap:20px;
    margin-bottom:28px;
}

.stat-card{
    background:white;
    border:1px solid var(--border);
    border-radius:28px;
    padding:26px;
    box-shadow:var(--shadow);
    transition:.25s;
}

.stat-card:hover{
    transform:translateY(-4px);
}

.stat-label{
    color:var(--muted);
    font-size:14px;
    margin-bottom:14px;
}

.stat-value{
    font-size:34px;
    font-weight:800;
    color:var(--green-dark);
}

/* CHART */
.chart-card{
    background:white;
    border-radius:30px;
    border:1px solid var(--border);
    padding:30px;
    box-shadow:var(--shadow);
    margin-bottom:28px;
}

.section-title{
    display:flex;
    align-items:center;
    justify-content:space-between;
    margin-bottom:24px;
}

.section-title h2{
    font-size:24px;
    color:var(--green-dark);
    font-weight:800;
    margin:0;
}

.chart-container{
    height:380px;
}

/* TABLE */
.table-card{
    background:white;
    border-radius:30px;
    border:1px solid var(--border);
    overflow:hidden;
    box-shadow:var(--shadow);
}

.table-header{
    padding:28px;
    border-bottom:1px solid #eef1ef;
}

.table-header h2{
    margin:0;
    color:var(--green-dark);
    font-size:24px;
    font-weight:800;
}

.table-wrapper{
    overflow-x:auto;
}

table{
    width:100%;
    border-collapse:collapse;
}

thead{
    background:#f9fbf8;
}

th{
    padding:20px;
    text-align:left;
    font-size:14px;
    color:#374151;
    font-weight:700;
}

td{
    padding:20px;
    border-top:1px solid #f2f4f3;
    color:var(--text);
}

tbody tr{
    transition:.2s;
}

tbody tr:hover{
    background:#fafdfb;
}

.order-id{
    background:var(--green-soft);
    color:var(--green-dark);
    font-weight:700;
    padding:8px 14px;
    border-radius:999px;
    display:inline-flex;
}

.total-price{
    font-weight:700;
    color:var(--green-dark);
}

.status{
    padding:8px 14px;
    border-radius:999px;
    font-size:13px;
    font-weight:700;
    display:inline-flex;
}

.status.diproses{
    background:#FEF3C7;
    color:#B45309;
}

.status.dikirim{
    background:#DBEAFE;
    color:#1D4ED8;
}

.status.selesai{
    background:#DCFCE7;
    color:#166534;
}

.empty{
    text-align:center;
    padding:50px;
    color:#9ca3af;
}

@media(max-width:768px){

    .laporan-page{
        padding:18px;
    }

    .hero{
        padding:28px;
    }

    .hero h1{
        font-size:30px;
    }

    .stat-value{
        font-size:28px;
    }

}
</style>

<div class="laporan-page">

    {{-- HERO --}}
    <div class="hero">

        <h1>
            Laporan Penjualan 
        </h1>

        <p>
            Pantau performa penjualan AgroMart,
            total pendapatan, produk terjual,
            serta histori transaksi secara real-time.
        </p>

    </div>

    {{-- STATISTIK --}}
    <div class="stats-grid">

        <div class="stat-card">
            <div class="stat-label">
                Total Pendapatan
            </div>

            <div class="stat-value">
                Rp {{ number_format($totalPendapatan,0,',','.') }}
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-label">
                Total Pesanan
            </div>

            <div class="stat-value">
                {{ $totalPesanan }}
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-label">
                Produk Terjual
            </div>

            <div class="stat-value">
                {{ $totalProduk }}
            </div>
        </div>

    </div>

    {{-- GRAFIK --}}
    <div class="chart-card">

        <div class="section-title">
            <h2>
                Grafik Penjualan Bulanan
            </h2>
        </div>

        <div class="chart-container">
            <canvas id="salesChart"></canvas>
        </div>

    </div>

    {{-- TABLE --}}
    <div class="table-card">

        <div class="table-header">
            <h2>
                Riwayat Transaksi
            </h2>
        </div>

        <div class="table-wrapper">

            <table>

                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Customer</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($transactions as $trx)

                    <tr>

                        <td>
                            <span class="order-id">
                                #{{ $trx->id }}
                            </span>
                        </td>

                        <td>
                            {{ $trx->user->name ?? '-' }}
                        </td>

                        <td class="total-price">
                            Rp {{ number_format($trx->total,0,',','.') }}
                        </td>

                        <td>

                            <span class="status {{ $trx->status }}">
                                {{ ucfirst($trx->status) }}
                            </span>

                        </td>

                        <td>
                            {{ $trx->created_at->format('d M Y') }}
                        </td>

                    </tr>

                    @empty

                    <tr>
                        <td colspan="5" class="empty">
                            Belum ada data transaksi.
                        </td>
                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

const ctx =
document.getElementById('salesChart');

new Chart(ctx, {

    type: 'line',

    data: {

        labels:
        @json($labels),

        datasets: [{

            label:
            'Pendapatan',

            data:
            @json($data),

            borderWidth:3,
            tension:.4,
            fill:true,
            pointRadius:5,

            backgroundColor:
            'rgba(47,107,60,.12)',

            borderColor:
            '#2f6b3c',

            pointBackgroundColor:
            '#2f6b3c',
        }]
    },

    options: {

        responsive:true,
        maintainAspectRatio:false,

        plugins:{
            legend:{
                display:false
            }
        },

        scales:{

            y:{
                beginAtZero:true,
                grid:{
                    color:'#eef2ef'
                }
            },

            x:{
                grid:{
                    display:false
                }
            }
        }
    }
});

</script>

@endsection