@extends('layouts.app')

@section('title', 'Tentang Kami - AgroMart')

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

.about-page{
    max-width:1200px;
    margin:40px auto 70px;
    padding:0 20px;
}

/* HERO */
.about-hero{
    background:linear-gradient(135deg,#1f4d2c,#2f6b3c);
    border-radius:32px;
    padding:60px 50px;
    color:white;
    position:relative;
    overflow:hidden;
    margin-bottom:35px;
}

.about-hero::before{
    content:'';
    position:absolute;
    right:-100px;
    top:-100px;
    width:260px;
    height:260px;
    background:rgba(255,255,255,.08);
    border-radius:50%;
}

.about-badge{
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

.about-title{
    font-size:48px;
    line-height:1.2;
    font-weight:800;
    margin:0 0 16px;
    max-width:650px;
}

.about-desc{
    max-width:700px;
    line-height:1.9;
    color:rgba(255,255,255,.82);
    font-size:15px;
}

/* GRID */
.about-grid{
    display:grid;
    grid-template-columns:2fr 1fr;
    gap:28px;
    align-items:start;
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
    margin-bottom:16px;
}

.section-desc{
    color:var(--muted);
    line-height:1.9;
    margin-bottom:35px;
}

/* STATS */
.stats-row{
    display:grid;
    grid-template-columns:repeat(3,1fr);
    gap:18px;
    margin-bottom:40px;
}

.stat-card{
    background:var(--green-soft);
    border-radius:22px;
    padding:24px;
    text-align:center;
}

.stat-value{
    font-size:34px;
    font-weight:800;
    color:var(--green-dark);
}

.stat-label{
    margin-top:8px;
    color:var(--muted);
    font-size:14px;
}

/* TABLE */
.table-wrap{
    overflow:auto;
    border-radius:22px;
    border:1px solid var(--border);
}

.about-table{
    width:100%;
    border-collapse:collapse;
}

.about-table thead{
    background:var(--green);
    color:white;
}

.about-table th{
    padding:18px;
    text-align:left;
    font-size:15px;
}

.about-table td{
    padding:18px;
    border-top:1px solid #f1f5f9;
    color:var(--text);
    line-height:1.7;
}

.about-table tbody tr:hover{
    background:#fafafa;
}

/* SIDEBAR */
.sidebar{
    padding:30px;
}

.sidebar-title{
    font-size:24px;
    color:var(--green-dark);
    margin-bottom:25px;
    font-weight:800;
}

.team-box{
    background:var(--green-soft);
    padding:22px;
    border-radius:22px;
    margin-bottom:22px;
}

.team-box h4{
    margin:0 0 8px;
    color:var(--green-dark);
}

.team-box p{
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
    color:var(--text);
    font-weight:600;
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

/* BUTTON */
.sidebar-actions{
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

    .about-grid{
        grid-template-columns:1fr;
    }

    .stats-row{
        grid-template-columns:1fr;
    }

    .about-title{
        font-size:36px;
    }

    .about-hero{
        padding:45px 30px;
    }
}
</style>

<div class="about-page">

    {{-- HERO --}}
    <section class="about-hero">

        <div class="about-badge">
            🌿 Tentang AgroMart
        </div>

        <h1 class="about-title">
            Solusi Pupuk Modern untuk Pertanian Indonesia
        </h1>

        <p class="about-desc">
            AgroMart hadir membantu petani Indonesia mendapatkan pupuk berkualitas
            dengan harga terjangkau, pengiriman cepat, dan layanan terpercaya
            untuk mendukung hasil panen yang lebih maksimal.
        </p>

    </section>

    {{-- GRID --}}
    <div class="about-grid">

        {{-- CONTENT --}}
        <div class="card content-card">

            <h2 class="section-title">
                Tentang AgroMart PupukKu
            </h2>

            <p class="section-desc">
                AgroMart PupukKu adalah platform penjualan pupuk modern yang menyediakan
                berbagai jenis pupuk organik, kimia, dan bio berkualitas tinggi untuk
                kebutuhan pertanian masyarakat Indonesia. Kami percaya bahwa pertanian
                yang maju dimulai dari akses terhadap produk terbaik dan pelayanan
                yang terpercaya.
            </p>

            {{-- STATS --}}
            <div class="stats-row">

                <div class="stat-card">
                    <div class="stat-value">2020</div>
                    <div class="stat-label">
                        Tahun Berdiri
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-value">500+</div>
                    <div class="stat-label">
                        Pelanggan Setia
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-value">50+</div>
                    <div class="stat-label">
                        Produk Tersedia
                    </div>
                </div>

            </div>

            {{-- TABLE --}}
            <h2 class="section-title">
                Visi & Misi
            </h2>

            <div class="table-wrap">

                <table class="about-table">

                    <thead>
                        <tr>
                            <th>Visi</th>
                            <th>Misi</th>
                        </tr>
                    </thead>

                    <tbody>

                        <tr>
                            <td>
                                Menjadi platform pupuk terpercaya di Indonesia
                            </td>

                            <td>
                                Menyediakan pupuk berkualitas dengan harga terjangkau
                            </td>
                        </tr>

                        <tr>
                            <td>
                                Mendukung ketahanan pangan nasional
                            </td>

                            <td>
                                Membantu petani meningkatkan hasil panen
                            </td>
                        </tr>

                        <tr>
                            <td>
                                Inovasi teknologi pertanian modern
                            </td>

                            <td>
                                Memberikan edukasi penggunaan pupuk yang tepat
                            </td>
                        </tr>

                    </tbody>

                </table>

            </div>

        </div>

        {{-- SIDEBAR --}}
        <aside class="card sidebar">

            <h3 class="sidebar-title">
                Tim & Kinerja
            </h3>

            <div class="team-box">

                <h4>
                    🌱 Tim Profesional
                </h4>

                <p>
                    Tim AgroMart terdiri dari tenaga profesional yang berpengalaman
                    dalam bidang pertanian dan distribusi pupuk modern.
                </p>

            </div>

            {{-- PROGRESS --}}
            <div class="progress-item">

                <div class="progress-top">
                    <span>Kepuasan Pelanggan</span>
                    <span>84%</span>
                </div>

                <div class="progress-bar">
                    <div class="progress-fill"
                         style="
                            width:84%;
                            background:#2f6b3c;
                         ">
                    </div>
                </div>

            </div>

            <div class="progress-item">

                <div class="progress-top">
                    <span>Produk Berkualitas</span>
                    <span>90%</span>
                </div>

                <div class="progress-bar">
                    <div class="progress-fill"
                         style="
                            width:90%;
                            background:#4a8c4a;
                         ">
                    </div>
                </div>

            </div>

            <div class="progress-item">

                <div class="progress-top">
                    <span>Pengiriman Tepat Waktu</span>
                    <span>75%</span>
                </div>

                <div class="progress-bar">
                    <div class="progress-fill"
                         style="
                            width:75%;
                            background:#84cc16;
                         ">
                    </div>
                </div>

            </div>

            {{-- BUTTON --}}
            <div class="sidebar-actions">

                <a href="{{ url('/kontak') }}"
                   class="btn btn-primary">
                    📞 Hubungi Kami
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