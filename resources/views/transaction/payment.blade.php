@extends('layouts.app')

@section('title', 'Pembayaran Transfer - AgroMart')

@section('content')

<style>
:root{
    --green:#2f6b3c;
    --green-dark:#1f4d2c;
    --green-soft:#eef7f0;
    --border:#e5e7eb;
    --text:#1f2937;
    --muted:#6b7280;
    --danger:#dc2626;
}

.payment-page{
    max-width:1100px;
    margin:40px auto 70px;
    padding:0 20px;
}

.payment-grid{
    display:grid;
    grid-template-columns:1.1fr .9fr;
    gap:24px;
}

.payment-card{
    background:white;
    border:1px solid var(--border);
    border-radius:24px;
    overflow:hidden;
    box-shadow:0 8px 25px rgba(0,0,0,.06);
}

.payment-header{
    padding:28px;
    border-bottom:1px solid #f3f4f6;
}

.payment-badge{
    display:inline-flex;
    align-items:center;
    gap:6px;
    padding:6px 14px;
    border-radius:999px;
    background:var(--green-soft);
    color:var(--green);
    font-size:12px;
    font-weight:700;
    margin-bottom:16px;
}

.payment-title{
    font-size:32px;
    font-weight:800;
    color:var(--green-dark);
    margin:0;
}

.payment-subtitle{
    margin-top:10px;
    color:var(--muted);
    line-height:1.7;
}

.alert-error{
    background:#fff5f5;
    color:var(--danger);
    border:1px solid #fecaca;
    padding:16px 18px;
    border-radius:14px;
    margin-bottom:20px;
    font-weight:600;
}

.form-body{
    padding:28px;
}

.form-group{
    margin-bottom:22px;
}

.form-label{
    display:block;
    margin-bottom:10px;
    font-size:14px;
    font-weight:700;
    color:var(--text);
}

.form-input,
.form-select{
    width:100%;
    padding:14px 16px;
    border-radius:14px;
    border:1px solid var(--border);
    background:white;
    outline:none;
    transition:.2s;
    box-sizing:border-box;
}

.form-input:focus,
.form-select:focus{
    border-color:var(--green);
    box-shadow:0 0 0 4px rgba(47,107,60,.1);
}

.upload-box{
    border:2px dashed #cbd5e1;
    border-radius:18px;
    padding:26px;
    text-align:center;
    background:#fafafa;
}

.upload-box input{
    margin-top:14px;
}

.submit-btn{
    width:100%;
    border:none;
    background:linear-gradient(135deg,var(--green),var(--green-dark));
    color:white;
    padding:16px;
    border-radius:16px;
    font-size:16px;
    font-weight:700;
    cursor:pointer;
    transition:.2s;
}

.submit-btn:hover{
    transform:translateY(-2px);
    box-shadow:0 10px 20px rgba(47,107,60,.25);
}

.info-card{
    background:white;
    border:1px solid var(--border);
    border-radius:24px;
    overflow:hidden;
    box-shadow:0 8px 25px rgba(0,0,0,.05);
    height:fit-content;
}

.info-top{
    padding:28px;
    background:linear-gradient(135deg,#1f4d2c,#2f6b3c);
    color:white;
}

.info-top h3{
    margin:0 0 10px;
    font-size:24px;
}

.info-top p{
    margin:0;
    opacity:.85;
    line-height:1.7;
    font-size:14px;
}

.bank-box{
    padding:24px 28px;
    border-bottom:1px solid #f3f4f6;
}

.bank-item{
    display:flex;
    justify-content:space-between;
    margin-bottom:16px;
    gap:15px;
}

.bank-item:last-child{
    margin-bottom:0;
}

.bank-label{
    color:var(--muted);
    font-size:14px;
}

.bank-value{
    font-weight:700;
    color:var(--text);
    text-align:right;
}

.total-box{
    margin:24px 28px 28px;
    padding:24px;
    border-radius:20px;
    background:var(--green-soft);
}

.total-box span{
    display:block;
    color:var(--muted);
    margin-bottom:8px;
}

.total-box strong{
    font-size:34px;
    color:var(--green-dark);
}

.payment-steps{
    padding:0 28px 28px;
}

.payment-steps h4{
    margin-bottom:16px;
    color:var(--green-dark);
}

.payment-steps ol{
    padding-left:18px;
    margin:0;
    color:#4b5563;
    line-height:1.8;
}

@media(max-width:900px){

    .payment-grid{
        grid-template-columns:1fr;
    }

    .payment-title{
        font-size:26px;
    }
}
</style>

<div class="payment-page">

    @if(session('error'))
        <div class="alert-error">
            ❌ {{ session('error') }}
        </div>
    @endif

    <div class="payment-grid">

        {{-- LEFT --}}
        <div class="payment-card">

            <div class="payment-header">

                <div class="payment-badge">
                    💳 Pembayaran Transfer
                </div>

                <h1 class="payment-title">
                    Upload Bukti Pembayaran
                </h1>

                <p class="payment-subtitle">
                    Silakan transfer sesuai nominal yang tertera lalu upload bukti pembayaran agar pesanan dapat segera diproses oleh tim AgroMart.
                </p>

            </div>

            <div class="form-body">

                <form action="{{ route('payment.process', $transaction->id) }}"
                      method="POST"
                      enctype="multipart/form-data">

                    @csrf

                    {{-- NAMA --}}
                    <div class="form-group">

                        <label class="form-label">
                            Nama Pengirim
                        </label>

                        <input type="text"
                               name="nama_pengirim"
                               class="form-input"
                               placeholder="Masukkan nama rekening pengirim"
                               required>

                    </div>

                    {{-- BANK --}}
                    <div class="form-group">

                        <label class="form-label">
                            Bank Pengirim
                        </label>

                        <select name="bank_pengirim"
                                class="form-select"
                                required>

                            <option value="">
                                Pilih Bank
                            </option>

                            <option value="BCA">BCA</option>
                            <option value="BRI">BRI</option>
                            <option value="BNI">BNI</option>
                            <option value="Mandiri">Mandiri</option>
                            <option value="BSI">BSI</option>

                        </select>

                    </div>

                    {{-- NOMINAL --}}
                    <div class="form-group">

                        <label class="form-label">
                            Nominal Transfer
                        </label>

                        <input type="number"
                               name="nominal_transfer"
                               value="{{ $transaction->total }}"
                               class="form-input"
                               required>

                    </div>

                    {{-- BUKTI --}}
                    <div class="form-group">

                        <label class="form-label">
                            Bukti Transfer
                        </label>

                        <div class="upload-box">

                            <div style="font-size:50px;">
                                🧾
                            </div>

                            <div style="
                                font-weight:700;
                                margin-top:10px;
                                color:#374151;
                            ">
                                Upload Screenshot / Foto Bukti Transfer
                            </div>

                            <div style="
                                color:#6b7280;
                                font-size:13px;
                                margin-top:6px;
                            ">
                                Format JPG / PNG maksimal 2MB
                            </div>

                            <input type="file"
                                   name="bukti_transfer"
                                   accept="image/*"
                                   required>

                        </div>

                    </div>

                    <button type="submit"
                            class="submit-btn">

                        ✅ Kirim Bukti Pembayaran

                    </button>

                </form>

            </div>

        </div>

        {{-- RIGHT --}}
        <div class="info-card">

            <div class="info-top">

                <h3>
                    🏦 Rekening AgroMart
                </h3>

                <p>
                    Transfer sesuai nominal total pembayaran berikut ini.
                </p>

            </div>

            <div class="bank-box">

                <div class="bank-item">

                    <div class="bank-label">
                        Bank
                    </div>

                    <div class="bank-value">
                        BCA
                    </div>

                </div>

                <div class="bank-item">

                    <div class="bank-label">
                        Nomor Rekening
                    </div>

                    <div class="bank-value">
                        1234567890
                    </div>

                </div>

                <div class="bank-item">

                    <div class="bank-label">
                        Atas Nama
                    </div>

                    <div class="bank-value">
                        AgroMart Indonesia
                    </div>

                </div>

            </div>

            <div class="total-box">

                <span>Total Pembayaran</span>

                <strong>
                    Rp {{ number_format($transaction->total,0,',','.') }}
                </strong>

            </div>

            <div class="payment-steps">

                <h4>
                    Cara Pembayaran
                </h4>

                <ol>
                    <li>Transfer ke rekening AgroMart.</li>
                    <li>Pastikan nominal sesuai total tagihan.</li>
                    <li>Upload bukti transfer.</li>
                    <li>Tunggu verifikasi admin.</li>
                </ol>

            </div>

        </div>

    </div>

</div>

@endsection