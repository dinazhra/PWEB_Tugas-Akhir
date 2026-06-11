@extends('layouts.app')

@section('title', 'Kontak - AgroMart')

@section('content')

<style>
:root{
    --green:#2f6b3c;
    --green-dark:#1f4d2c;
    --green-soft:#eef7f0;
    --border:#e5e7eb;
    --text:#1f2937;
    --muted:#6b7280;
}

.contact-page{
    max-width:1200px;
    margin:40px auto 70px;
    padding:0 20px;
}

/* HERO */
.contact-hero{
    background:linear-gradient(135deg,#1f4d2c,#2f6b3c);
    border-radius:32px;
    padding:60px 50px;
    color:white;
    margin-bottom:35px;
    position:relative;
    overflow:hidden;
}

.contact-hero::before{
    content:'';
    position:absolute;
    width:260px;
    height:260px;
    background:rgba(255,255,255,.08);
    border-radius:50%;
    top:-100px;
    right:-100px;
}

.hero-badge{
    display:inline-flex;
    align-items:center;
    gap:8px;
    padding:8px 16px;
    border-radius:999px;
    background:rgba(255,255,255,.12);
    border:1px solid rgba(255,255,255,.15);
    font-size:12px;
    font-weight:700;
    margin-bottom:18px;
}

.hero-title{
    font-size:46px;
    font-weight:800;
    margin:0 0 16px;
}

.hero-desc{
    max-width:700px;
    line-height:1.9;
    color:rgba(255,255,255,.82);
}

/* GRID */
.contact-grid{
    display:grid;
    grid-template-columns:2fr 1fr;
    gap:28px;
}

/* CARD */
.card{
    background:white;
    border-radius:28px;
    border:1px solid var(--border);
    box-shadow:0 10px 30px rgba(0,0,0,.05);
}

/* CONTENT */
.content-card{
    padding:35px;
}

.section-title{
    font-size:28px;
    font-weight:800;
    color:var(--green-dark);
    margin-bottom:15px;
}

.section-desc{
    color:var(--muted);
    line-height:1.8;
    margin-bottom:30px;
}

/* TABLE */
.table-wrap{
    overflow:auto;
    border-radius:22px;
    border:1px solid var(--border);
}

.contact-table{
    width:100%;
    border-collapse:collapse;
}

.contact-table thead{
    background:var(--green);
    color:white;
}

.contact-table th{
    padding:18px;
    text-align:left;
}

.contact-table td{
    padding:18px;
    border-top:1px solid #f1f5f9;
    color:var(--text);
}

.contact-table tbody tr:hover{
    background:#fafafa;
}

/* SIDEBAR */
.sidebar{
    padding:30px;
}

.sidebar-title{
    font-size:24px;
    font-weight:800;
    color:var(--green-dark);
    margin-bottom:25px;
}

/* INFO BOX */
.info-box{
    background:var(--green-soft);
    padding:22px;
    border-radius:22px;
    margin-bottom:25px;
}

.info-box h4{
    margin:0 0 10px;
    color:var(--green-dark);
}

.info-box p{
    margin:0;
    color:var(--muted);
    line-height:1.7;
    font-size:14px;
}

/* PROGRESS */
.progress-item{
    margin-bottom:24px;
}

.progress-top{
    display:flex;
    justify-content:space-between;
    margin-bottom:10px;
    font-size:14px;
    font-weight:600;
    color:var(--text);
}

.progress-bar{
    height:12px;
    background:#edf2f7;
    border-radius:999px;
    overflow:hidden;
}

.progress-fill{
    height:100%;
    border-radius:999px;
}

/* BUTTONS */
.sidebar-links{
    margin-top:30px;
    display:flex;
    flex-direction:column;
    gap:14px;
}

.btn{
    display:flex;
    align-items:center;
    justify-content:center;
    padding:14px 18px;
    border-radius:16px;
    text-decoration:none;
    font-weight:700;
    transition:.2s;
}

.btn-primary{
    background:linear-gradient(135deg,var(--green),var(--green-dark));
    color:white;
}

.btn-secondary{
    background:#f8fafc;
    color:var(--text);
    border:1px solid var(--border);
}

.btn:hover{
    transform:translateY(-2px);
}

@media(max-width:900px){

    .contact-grid{
        grid-template-columns:1fr;
    }

    .contact-hero{
        padding:45px 30px;
    }

    .hero-title{
        font-size:36px;
    }
}
</style>

<div class="contact-page">

    {{-- HERO --}}
    <section class="contact-hero">

        <div class="hero-badge">
            📞 Kontak AgroMart
        </div>

        <h1 class="hero-title">
            Kami Siap Membantu Anda
        </h1>

        <p class="hero-desc">
            Hubungi tim AgroMart untuk pertanyaan produk, pemesanan,
            konsultasi pertanian, atau bantuan lainnya.
            Kami siap melayani kebutuhan pertanian Anda.
        </p>

    </section>

    {{-- GRID --}}
    <div class="contact-grid">

        {{-- LEFT --}}
        <div class="card content-card">

            <h2 class="section-title">
                Informasi Kontak
            </h2>

            <p class="section-desc">
                Anda dapat menghubungi AgroMart melalui beberapa
                kontak berikut untuk mendapatkan bantuan lebih lanjut.
            </p>

            <div class="table-wrap">

                <table class="contact-table">

                    <thead>
                        <tr>
                            <th>Jenis</th>
                            <th>Detail</th>
                        </tr>
                    </thead>

                    <tbody>

                        <tr>
                            <td>📧 Email</td>
                            <td>AgroMart@mail.com</td>
                        </tr>

                        <tr>
                            <td>📍 Alamat</td>
                            <td>Jember, Jawa Timur</td>
                        </tr>

                        <tr>
                            <td>📞 Telepon</td>
                            <td>+62 812-3456-7890</td>
                        </tr>

                        <tr>
                            <td>🕐 Jam Operasional</td>
                            <td>Senin - Sabtu, 08.00 - 17.00 WIB</td>
                        </tr>

                    </tbody>

                </table>

            </div>

        </div>

        {{-- SIDEBAR --}}
        <aside class="card sidebar">

            <h3 class="sidebar-title">
                Pelayanan Kami
            </h3>

            <div class="info-box">

                <h4>
                    🌱 Konsultasi Pertanian
                </h4>

                <p>
                    Tim AgroMart siap membantu memberikan rekomendasi
                    pupuk terbaik sesuai kebutuhan tanaman Anda.
                </p>

            </div>

            {{-- PROGRESS --}}
            <div class="progress-item">

                <div class="progress-top">
                    <span>Respon Email</span>
                    <span>95%</span>
                </div>

                <div class="progress-bar">
                    <div class="progress-fill"
                         style="
                            width:95%;
                            background:#2f6b3c;
                         ">
                    </div>
                </div>

            </div>

            <div class="progress-item">

                <div class="progress-top">
                    <span>Kepuasan Layanan</span>
                    <span>88%</span>
                </div>

                <div class="progress-bar">
                    <div class="progress-fill"
                         style="
                            width:88%;
                            background:#4a8c4a;
                         ">
                    </div>
                </div>

            </div>

            {{-- BUTTON --}}
            <div class="sidebar-links">

                <a href="{{ url('/tentang') }}"
                   class="btn btn-primary">
                    🌿 Tentang Kami
                </a>

                <a href="{{ url('/') }}"
                   class="btn btn-secondary">
                    ← Kembali ke Beranda
                </a>

            </div>

        </aside>

    </div>

</div>

@endsection