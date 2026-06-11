@extends('layouts.app')

@section('title', 'Edit Produk - AgroMart')

@section('content')

<div style="
    max-width:950px;
    margin:40px auto 70px;
    padding:0 24px;
">

    {{-- HEADER --}}
    <div style="margin-bottom:30px;">

        <a href="{{ route('pupuk.index') }}"
           style="
                display:inline-flex;
                align-items:center;
                gap:8px;
                text-decoration:none;
                background:#ffffff;
                border:1px solid #dce9d5;
                color:#2F6B45;
                font-size:13.5px;
                font-weight:600;
                padding:10px 18px;
                border-radius:999px;
                margin-bottom:22px;
                box-shadow:0 2px 8px rgba(15,45,26,.06);
                transition:all .2s;
           "
           onmouseover="this.style.background='#eaf5e4'"
           onmouseout="this.style.background='#ffffff'"
        >
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <path d="M19 12H5"/><path d="M12 19l-7-7 7-7"/>
            </svg>
            Kembali ke Katalog
        </a>

        <h1 style="
            font-size:38px;
            font-weight:700;
            color:#1f2937;
            margin-bottom:10px;
            letter-spacing:-1px;
        ">
            Edit Produk
        </h1>

        <p style="
            color:#6b7280;
            font-size:15px;
            line-height:1.7;
        ">
            Perbarui informasi produk pupuk AgroMart.
        </p>

    </div>

    {{-- CARD --}}
    <div style="
        background:#ffffff;
        border:1px solid #e5e7eb;
        border-radius:28px;
        padding:40px;
        box-shadow:0 10px 30px rgba(0,0,0,0.04);
    ">

        <form action="{{ route('pupuk.update', $pupuk->id) }}"
              method="POST"
              enctype="multipart/form-data">

            @csrf
            @method('PUT')

            {{-- GRID --}}
            <div style="
                display:grid;
                grid-template-columns:1fr 1fr;
                gap:24px;
            ">

                {{-- KODE --}}
                <div>
                    <label class="form-label">Kode Produk</label>
                    <input type="text"
                           name="kode"
                           value="{{ $pupuk->kode }}"
                           class="form-input"
                           required>
                </div>

                {{-- NAMA --}}
                <div>
                    <label class="form-label">Nama Produk</label>
                    <input type="text"
                           name="nama"
                           value="{{ $pupuk->nama }}"
                           class="form-input"
                           required>
                </div>

                {{-- KATEGORI --}}
                <div>
                    <label class="form-label">Kategori</label>
                    <select name="kategori" class="form-input" required>
                        <option value="Organik"  {{ $pupuk->kategori == 'Organik' ? 'selected' : '' }}>Organik</option>
                        <option value="Kimia"    {{ $pupuk->kategori == 'Kimia'   ? 'selected' : '' }}>Kimia</option>
                        <option value="Bio"      {{ $pupuk->kategori == 'Bio'     ? 'selected' : '' }}>Bio</option>
                        <option value="Cair"     {{ $pupuk->kategori == 'Cair'    ? 'selected' : '' }}>Cair</option>
                    </select>
                </div>

                {{-- STOK --}}
                <div>
                    <label class="form-label">Stok</label>
                    <input type="number"
                           name="stok"
                           value="{{ $pupuk->stok }}"
                           class="form-input"
                           required>
                </div>

                {{-- HARGA --}}
                <div>
                    <label class="form-label">Harga</label>
                    <input type="number"
                           name="harga"
                           value="{{ $pupuk->harga }}"
                           class="form-input"
                           required>
                </div>

                {{-- TANGGAL --}}
                <div>
                    <label class="form-label">Tanggal Masuk</label>
                    <input type="date"
                           name="tanggal_masuk"
                           value="{{ $pupuk->tanggal_masuk ?? date('Y-m-d') }}"
                           class="form-input"
                           required>
                </div>

            </div>

            {{-- FOTO --}}
            <div style="margin-top:28px;">

                <label class="form-label">Foto Produk</label>

                <div style="
                    border:2px dashed #d1d5db;
                    border-radius:22px;
                    padding:30px 24px;
                    background:#fafafa;
                ">

                    {{-- PREVIEW FOTO DARI DATABASE --}}
                    <div style="
                        display:flex;
                        align-items:center;
                        gap:18px;
                        margin-bottom:20px;
                    ">

                        <div style="
                            width:90px;
                            height:90px;
                            background:white;
                            border-radius:18px;
                            display:flex;
                            align-items:center;
                            justify-content:center;
                            border:1px solid #e5e7eb;
                            overflow:hidden;
                        ">
                            @if($pupuk->foto)
                                <img
                                    src="{{ Storage::url($pupuk->foto) }}"
                                    alt="{{ $pupuk->nama }}"
                                    style="max-width:70px; max-height:70px; object-fit:contain;"
                                    onerror="this.src='{{ asset('images/tumbuhan.png') }}'"
                                >
                            @else
                                <img
                                    src="{{ asset('images/tumbuhan.png') }}"
                                    alt="{{ $pupuk->nama }}"
                                    style="max-width:70px; max-height:70px; object-fit:contain;"
                                >
                            @endif
                        </div>

                        <div>
                            <div style="
                                font-size:15px;
                                font-weight:600;
                                color:#1f2937;
                                margin-bottom:6px;
                            ">
                                {{ $pupuk->nama }}
                            </div>
                            <div style="font-size:13px; color:#9ca3af;">
                                @if($pupuk->foto)
                                    Foto sudah ada. Upload baru untuk mengganti.
                                @else
                                    Belum ada foto. Upload foto produk di bawah.
                                @endif
                            </div>
                        </div>

                    </div>

                    {{-- INPUT FILE --}}
                    <input
                        type="file"
                        name="foto"
                        accept="image/jpg,image/jpeg,image/png"
                        style="font-size:14px; color:#6b7280;"
                    >

                    <p style="margin-top:10px; font-size:13px; color:#9ca3af;">
                        JPG atau PNG • maksimal 2MB
                    </p>

                </div>

            </div>

            {{-- BUTTON --}}
            <div style="
                display:flex;
                justify-content:flex-end;
                margin-top:36px;
                gap:14px;
            ">

                <a href="{{ route('pupuk.index') }}"
                   style="
                        padding:14px 24px;
                        border-radius:14px;
                        text-decoration:none;
                        background:#f3f4f6;
                        color:#374151;
                        font-size:14px;
                        font-weight:600;
                   ">
                    Batal
                </a>

                <button type="submit"
                        class="submit-btn"
                        style="
                            background:#76944C;
                            color:white;
                            border:none;
                            padding:14px 28px;
                            border-radius:14px;
                            font-size:15px;
                            font-weight:600;
                            cursor:pointer;
                            transition:.2s;
                            box-shadow:0 10px 20px rgba(118,148,76,.18);
                        ">
                    Simpan Perubahan
                </button>

            </div>

        </form>

    </div>

</div>

<style>

.form-label{
    display:block;
    margin-bottom:10px;
    font-size:14px;
    font-weight:600;
    color:#374151;
}

.form-input{
    width:100%;
    padding:14px 16px;
    border:1px solid #e5e7eb;
    border-radius:14px;
    background:#fff;
    font-size:14px;
    transition:.2s;
    outline:none;
    box-sizing:border-box;
}

.form-input:focus{
    border-color:#76944C;
    box-shadow:0 0 0 4px rgba(118,148,76,.12);
}

.submit-btn:hover{
    transform:translateY(-2px);
    background:#698343;
}

@media(max-width:768px){
    form > div:first-child{
        grid-template-columns:1fr !important;
    }
    .submit-btn{
        width:100%;
    }
}

</style>

@endsection