@extends('layouts.app')

@section('title', 'Kelola Pesanan - AgroMart')

@section('content')

<style>
:root{
    --green:#2f6b3c;
    --green-dark:#1f4d2b;
    --green-soft:#edf7ef;
    --border:#e5e7eb;
    --text:#1f2937;
    --muted:#6b7280;
    --danger:#dc2626;
    --warning:#f59e0b;
    --blue:#2563eb;
}

.page-wrap{
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
    border-radius:28px;
    padding:38px;
    color:white;
    margin-bottom:28px;
}

.hero h1{
    font-size:36px;
    font-weight:800;
    margin:0;
}

.hero p{
    margin-top:10px;
    opacity:.9;
}

/* CARD */
.card-box{
    background:white;
    border-radius:28px;
    border:1px solid var(--border);
    overflow:hidden;
    box-shadow:
        0 8px 25px rgba(0,0,0,.04);
}

/* HEADER */
.table-header{
    padding:24px 28px;
    border-bottom:1px solid var(--border);
}

.table-header h2{
    margin:0;
    font-size:24px;
    font-weight:800;
    color:var(--green-dark);
}

/* TABLE */
.table-wrap{
    overflow-x:auto;
}

table{
    width:100%;
    border-collapse:collapse;
}

th{
    background:#f9fafb;
    padding:18px;
    text-align:left;
    font-size:14px;
    color:#374151;
}

td{
    padding:18px;
    border-top:1px solid #f3f4f6;
    vertical-align:top;
}

/* CUSTOMER */
.customer{
    font-weight:700;
    color:var(--text);
}

.customer small{
    display:block;
    color:var(--muted);
    margin-top:4px;
}

/* STATUS */
.status{
    display:inline-flex;
    padding:8px 14px;
    border-radius:999px;
    font-size:13px;
    font-weight:700;
}

.menunggu_verifikasi{
    background:#fff7ed;
    color:#c2410c;
}

.diproses{
    background:#eff6ff;
    color:#1d4ed8;
}

.dikirim{
    background:#ecfeff;
    color:#0f766e;
}

.selesai{
    background:#ecfdf3;
    color:#166534;
}

.dibatalkan{
    background:#fef2f2;
    color:#b91c1c;
}

/* BUTTON */
.btn{
    border:none;
    border-radius:12px;
    padding:11px 16px;
    font-weight:600;
    cursor:pointer;
    transition:.2s;
    text-decoration:none;
    display:inline-flex;
    align-items:center;
    justify-content:center;
}

.btn-proof{
    background:#eff6ff;
    color:var(--blue);
}

.btn-proof:hover{
    background:#dbeafe;
}

.select-status{
    width:100%;
    border:1px solid var(--border);
    border-radius:12px;
    padding:10px;
    outline:none;
    margin-bottom:8px;
}

.btn-save{
    background:var(--green);
    color:white;
    width:100%;
}

.btn-save:hover{
    background:var(--green-dark);
}

/* EMPTY */
.empty{
    text-align:center;
    padding:60px;
    color:var(--muted);
}

@media(max-width:768px){

    .page-wrap{
        padding:18px;
    }

    .hero h1{
        font-size:28px;
    }

}
</style>

<div class="page-wrap">

    {{-- HERO --}}
    <div class="hero">

        <h1>Kelola Pesanan </h1>

        <p>
            Kelola pesanan customer, verifikasi pembayaran,
            dan update status pengiriman.
        </p>

    </div>

    {{-- TABLE --}}
    <div class="card-box">

        <div class="table-header">
            <h2>Daftar Pesanan</h2>
        </div>

        <div class="table-wrap">

            <table>

                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Pelanggan</th>
                        <th>Total</th>
                        <th>Pembayaran</th>
                        <th>Bukti TF</th>
                        <th>Status</th>
                        <th>Update</th>
                    </tr>
                </thead>

                <tbody>

                @forelse($transactions as $pesanan)

                    <tr>

                        <td>
                            <strong>
                                #{{ $pesanan->id }}
                            </strong>
                        </td>

                        <td>
                            <div class="customer">
                                {{ $pesanan->user->name ?? '-' }}

                                <small>
                                    {{ $pesanan->nama_penerima }}
                                </small>
                            </div>
                        </td>

                        <td>
                            <strong>
                                Rp {{ number_format($pesanan->total,0,',','.') }}
                            </strong>
                        </td>

                        <td>
                            {{ $pesanan->metode_pembayaran }}
                        </td>

                        <td>

                            @if($pesanan->bukti_transfer)

                                <a href="{{ asset('uploads/bukti-transfer/'.$pesanan->bukti_transfer) }}"
                                   target="_blank"
                                   class="btn btn-proof">

                                    Lihat Bukti

                                </a>

                            @else

                                <span style="color:#9ca3af;">
                                    Tidak ada
                                </span>

                            @endif

                        </td>

                        <td>

                            <span class="status {{ $pesanan->status }}">
                                {{ ucwords(str_replace('_',' ', $pesanan->status)) }}
                            </span>

                        </td>

                        <td>

                            <form method="POST"
                                  action="{{ route('admin.pesanan.update', $pesanan->id) }}">

                                @csrf

                                <select
                                    name="status"
                                    class="select-status">

                                    <option value="menunggu_verifikasi"
                                        {{ $pesanan->status == 'menunggu_verifikasi' ? 'selected' : '' }}>
                                        Menunggu Verifikasi
                                    </option>

                                    <option value="diproses"
                                        {{ $pesanan->status == 'diproses' ? 'selected' : '' }}>
                                        Diproses
                                    </option>

                                    <option value="dikirim"
                                        {{ $pesanan->status == 'dikirim' ? 'selected' : '' }}>
                                        Dikirim
                                    </option>

                                    <option value="selesai"
                                        {{ $pesanan->status == 'selesai' ? 'selected' : '' }}>
                                        Selesai
                                    </option>

                                    <option value="dibatalkan"
                                        {{ $pesanan->status == 'dibatalkan' ? 'selected' : '' }}>
                                        Dibatalkan
                                    </option>

                                </select>

                                <button
                                    type="submit"
                                    class="btn btn-save">

                                    Simpan

                                </button>

                            </form>

                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="7">

                            <div class="empty">
                                Belum ada pesanan.
                            </div>

                        </td>
                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection