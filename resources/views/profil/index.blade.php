@extends('layouts.app')

@section('title', 'Profil Saya')

@section('content')

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

<style>
    .profil-wrap * { font-family: 'Plus Jakarta Sans', sans-serif; box-sizing: border-box; }

    .profil-wrap {
        max-width: 900px;
        margin: 36px auto;
        padding: 0 20px 60px;
    }

    /* ── HERO BANNER ── */
    .profil-hero {
        background: #17361F;
        border-radius: 24px;
        padding: 36px 40px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 24px;
        flex-wrap: wrap;
        margin-bottom: 20px;
        position: relative;
        overflow: hidden;
    }

    .profil-hero::before {
        content: '';
        position: absolute;
        top: -60px; right: -60px;
        width: 260px; height: 260px;
        border-radius: 50%;
        background: #2F6B45;
        opacity: 0.5;
    }

    .profil-hero::after {
        content: '';
        position: absolute;
        bottom: -40px; left: 30%;
        width: 160px; height: 160px;
        border-radius: 50%;
        background: #8bc34a;
        opacity: 0.1;
    }

    .profil-hero-left {
        display: flex;
        align-items: center;
        gap: 22px;
        position: relative;
        z-index: 2;
    }

    .profil-avatar {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        background: white;
        color: #2F6B45;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 30px;
        font-weight: 800;
        flex-shrink: 0;
        border: 3px solid rgba(255,255,255,0.3);
    }

    .profil-hero-name {
        font-size: 24px;
        font-weight: 800;
        color: white;
        letter-spacing: -0.3px;
    }

    .profil-hero-role {
        margin-top: 4px;
        font-size: 13px;
        font-weight: 500;
        color: #a8d5ab;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .role-badge {
        background: rgba(139, 195, 74, 0.2);
        border: 1px solid rgba(139, 195, 74, 0.35);
        color: #b5d96a;
        font-size: 11px;
        font-weight: 600;
        letter-spacing: 0.8px;
        text-transform: uppercase;
        padding: 3px 10px;
        border-radius: 100px;
    }

    .edit-btn {
        position: relative;
        z-index: 2;
        background: white;
        color: #17361F;
        border: none;
        padding: 11px 22px;
        border-radius: 12px;
        font-weight: 700;
        font-size: 13.5px;
        cursor: pointer;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: background 0.15s, transform 0.1s;
        flex-shrink: 0;
    }

    .edit-btn:hover { background: #f0faf1; }
    .edit-btn:active { transform: scale(0.97); }

    .edit-btn svg { width: 15px; height: 15px; }

    /* ── CARD ── */
    .profil-card {
        background: white;
        border-radius: 20px;
        border: 1px solid #E6EEE8;
        padding: 36px 40px;
        box-shadow: 0 4px 24px rgba(0,0,0,0.05);
    }

    /* ── SECTION HEADER ── */
    .section-head {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 24px;
    }

    .section-head-icon {
        width: 34px;
        height: 34px;
        background: #EEF7EF;
        border-radius: 9px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .section-head-icon svg { width: 17px; height: 17px; }

    .section-title {
        font-size: 16px;
        font-weight: 700;
        color: #17361F;
        letter-spacing: -0.2px;
    }

    /* ── DIVIDER ── */
    .section-divider {
        border: none;
        border-top: 1px solid #EEF0EB;
        margin: 28px 0;
    }

    /* ── FORM GRID ── */
    .form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 18px;
    }

    .form-group {
        display: flex;
        flex-direction: column;
    }

    .form-group.full { grid-column: 1 / -1; }

    .form-label {
        font-size: 12.5px;
        font-weight: 600;
        color: #6B7280;
        margin-bottom: 7px;
        letter-spacing: 0.3px;
        text-transform: uppercase;
    }

    .form-input {
        padding: 12px 14px;
        border: 1.5px solid #E5E7EB;
        border-radius: 12px;
        font-size: 14px;
        font-family: 'Plus Jakarta Sans', sans-serif;
        color: #111827;
        outline: none;
        background: #FAFBFA;
        transition: border-color 0.15s, box-shadow 0.15s;
        resize: none;
    }

    .form-input:disabled {
        background: #F3F4F6;
        color: #6B7280;
        cursor: not-allowed;
        border-color: #E5E7EB;
    }

    .form-input:focus {
        border-color: #2F6B45;
        box-shadow: 0 0 0 3px rgba(47, 107, 69, 0.1);
        background: white;
    }

    /* ── ACTION BUTTONS ── */
    .action-buttons {
        margin-top: 24px;
        display: none;
        gap: 10px;
        flex-wrap: wrap;
    }

    .save-btn {
        border: none;
        background: #2F6B45;
        color: white;
        padding: 12px 28px;
        border-radius: 12px;
        font-size: 14px;
        font-weight: 700;
        font-family: 'Plus Jakarta Sans', sans-serif;
        cursor: pointer;
        transition: background 0.15s;
    }

    .save-btn:hover { background: #17361F; }

    .cancel-btn {
        border: 1.5px solid #E5E7EB;
        background: white;
        color: #6B7280;
        padding: 12px 28px;
        border-radius: 12px;
        font-size: 14px;
        font-weight: 600;
        font-family: 'Plus Jakarta Sans', sans-serif;
        cursor: pointer;
        transition: background 0.15s;
    }

    .cancel-btn:hover { background: #F9FAFB; }

    /* ── SUCCESS ALERT ── */
    .alert-success {
        background: #EEF7EF;
        border: 1px solid #c3dfc6;
        color: #1f4d2b;
        border-radius: 12px;
        padding: 13px 18px;
        font-size: 14px;
        font-weight: 500;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    @media (max-width: 680px) {
        .profil-hero { flex-direction: column; text-align: center; }
        .profil-hero-left { flex-direction: column; }
        .form-grid { grid-template-columns: 1fr; }
        .profil-card { padding: 24px 20px; }
    }
</style>

<div class="profil-wrap">

    {{-- SUCCESS MESSAGE --}}
    @if(session('success'))
        <div class="alert-success">
            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width:18px;height:18px;flex-shrink:0">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            {{ session('success') }}
        </div>
    @endif

    {{-- HERO BANNER --}}
    <div class="profil-hero">

        <div class="profil-hero-left">

            <div class="profil-avatar">
                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
            </div>

            <div>
                <div class="profil-hero-name">{{ auth()->user()->name }}</div>
                <div class="profil-hero-role">
                    <span class="role-badge">{{ ucfirst(auth()->user()->role) }}</span>
                    {{ auth()->user()->email }}
                </div>
            </div>

        </div>

        <button class="edit-btn" onclick="enableEdit()">
            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125"/>
            </svg>
            Edit Profil
        </button>

    </div>

    {{-- FORM CARD --}}
    <div class="profil-card">

        <form action="{{ route('profil.update') }}" method="POST">
            @csrf
            @method('PATCH')

            {{-- INFORMASI AKUN --}}
            <div class="section-head">
                <div class="section-head-icon">
                    <svg fill="none" stroke="#2F6B45" stroke-width="1.8" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"/>
                    </svg>
                </div>
                <span class="section-title">Informasi Akun</span>
            </div>

            <div class="form-grid">

                <div class="form-group">
                    <label class="form-label">Nama</label>
                    <input type="text" name="name" class="form-input edit-field"
                           value="{{ auth()->user()->name }}" disabled>
                    @error('name')
                        <span style="color:#dc2626;font-size:12px;margin-top:5px;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Username</label>
                    <input type="text" name="username" class="form-input edit-field"
                           value="{{ auth()->user()->username }}" disabled>
                    @error('username')
                        <span style="color:#dc2626;font-size:12px;margin-top:5px;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-input edit-field"
                           value="{{ auth()->user()->email }}" disabled>
                    @error('email')
                        <span style="color:#dc2626;font-size:12px;margin-top:5px;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Nomor HP</label>
                    <input type="text" name="no_hp" class="form-input edit-field"
                           value="{{ auth()->user()->no_hp }}" disabled>
                    @error('no_hp')
                        <span style="color:#dc2626;font-size:12px;margin-top:5px;">{{ $message }}</span>
                    @enderror
                </div>

                @if(auth()->user()->role !== 'admin')
                <div class="form-group full">
                    <label class="form-label">Alamat</label>
                    <textarea name="alamat" rows="3"
                              class="form-input edit-field" disabled>{{ auth()->user()->alamat }}</textarea>
                    @error('alamat')
                        <span style="color:#dc2626;font-size:12px;margin-top:5px;">{{ $message }}</span>
                    @enderror
                </div>
                @endif

            </div>

            <hr class="section-divider">

            {{-- GANTI PASSWORD --}}
            <div class="section-head">
                <div class="section-head-icon">
                    <svg fill="none" stroke="#2F6B45" stroke-width="1.8" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z"/>
                    </svg>
                </div>
                <span class="section-title">Ganti Password <span style="font-weight:500;color:#9CA3AF;font-size:13px;">(Opsional)</span></span>
            </div>

            <div class="form-grid">

                <div class="form-group">
                    <label class="form-label">Password Baru</label>
                    <input type="password" name="password"
                           class="form-input edit-field"
                           placeholder="Kosongkan jika tidak ingin ganti"
                           disabled>
                    @error('password')
                        <span style="color:#dc2626;font-size:12px;margin-top:5px;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation"
                           class="form-input edit-field"
                           placeholder="Ulangi password baru"
                           disabled>
                </div>

            </div>

            {{-- ACTION BUTTONS --}}
            <div class="action-buttons" id="actionButtons">
                <button type="submit" class="save-btn">Simpan Perubahan</button>
                <button type="button" class="cancel-btn" onclick="location.reload()">Batal</button>
            </div>

        </form>

    </div>

</div>

<script>
function enableEdit() {
    document.querySelectorAll('.edit-field').forEach(function(field) {
        field.disabled = false;
    });
    document.getElementById('actionButtons').style.display = 'flex';
    // scroll ke form
    document.querySelector('.profil-card').scrollIntoView({ behavior: 'smooth', block: 'start' });
}
</script>

@endsection