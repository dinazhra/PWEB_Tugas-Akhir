@extends('layouts.app')

@section('title', 'Pengaturan - AgroMart')

@section('content')

<style>
.settings-page{
    max-width:1000px;
    margin:auto;
    padding:20px 0 60px;
}

.settings-hero{
    background:linear-gradient(135deg,#1F4D2B,#355E3B);
    border-radius:28px;
    padding:40px 44px;
    color:white;
    position:relative;
    overflow:hidden;
    margin-bottom:24px;
}

.settings-hero::before{
    content:'';
    position:absolute;
    right:-80px;top:-80px;
    width:240px;height:240px;
    border-radius:50%;
    background:rgba(255,255,255,.06);
    pointer-events:none;
}

.hero-tag{
    display:inline-flex;
    align-items:center;
    gap:8px;
    background:rgba(255,255,255,.1);
    border:1px solid rgba(255,255,255,.15);
    color:rgba(255,255,255,.85);
    padding:7px 14px;
    border-radius:999px;
    font-size:12px;
    font-weight:600;
    letter-spacing:.5px;
    text-transform:uppercase;
    margin-bottom:16px;
}

.settings-hero h1{
    font-size:36px;
    font-weight:800;
    margin:0 0 10px;
    line-height:1.15;
}

.settings-hero p{
    opacity:.7;
    font-size:14.5px;
    line-height:1.7;
    max-width:500px;
    margin:0;
}

.settings-grid{
    display:grid;
    grid-template-columns:1.3fr .9fr;
    gap:20px;
    align-items:start;
}

.settings-card{
    background:var(--white);
    border:1px solid var(--border);
    border-radius:24px;
    padding:30px;
    box-shadow:var(--shadow-sm);
}

.card-title{
    font-size:18px;
    font-weight:700;
    color:var(--text);
    margin-bottom:24px;
    display:flex;
    align-items:center;
    gap:10px;
}

.card-title svg{ width:20px;height:20px;color:var(--primary);flex-shrink:0; }

.form-group{ margin-bottom:22px; }

.form-label{
    display:flex;
    align-items:center;
    gap:8px;
    font-size:13.5px;
    font-weight:600;
    color:var(--text);
    margin-bottom:10px;
}

.form-label svg{ width:16px;height:16px;color:var(--primary);flex-shrink:0; }

.option-group{ display:flex;gap:10px;flex-wrap:wrap; }

.option-btn{
    flex:1;
    min-width:90px;
    padding:12px 16px;
    border-radius:14px;
    border:1.5px solid var(--border);
    background:var(--bg);
    color:var(--muted);
    font-size:13.5px;
    font-weight:600;
    cursor:pointer;
    transition:.2s;
    display:flex;
    align-items:center;
    justify-content:center;
    gap:8px;
    font-family:'Inter',sans-serif;
}

.option-btn:hover{ border-color:var(--primary);color:var(--primary);background:var(--primary-soft); }

.option-btn.active{ border-color:var(--primary);background:var(--primary);color:white; }

.save-btn{
    width:100%;
    border:none;
    border-radius:16px;
    padding:16px;
    cursor:pointer;
    background:var(--primary);
    color:white;
    font-size:14px;
    font-weight:700;
    font-family:'Inter',sans-serif;
    transition:.25s;
    display:flex;
    align-items:center;
    justify-content:center;
    gap:10px;
    margin-top:8px;
}

.save-btn:hover{ background:var(--primary-hover);transform:translateY(-2px);box-shadow:0 10px 24px rgba(53,94,59,.2); }
.save-btn:active{ transform:translateY(0); }

.toast{
    display:none;
    align-items:center;
    gap:10px;
    margin-top:16px;
    padding:14px 18px;
    border-radius:14px;
    background:#ECFDF3;
    border:1px solid #BBF7D0;
    color:#166534;
    font-size:13.5px;
    font-weight:600;
}

html.dark .toast{ background:#172E1E;border-color:#265C32;color:#6EE7A0; }
.toast.show{ display:flex; }

.preview-card{
    background:var(--white);
    border:1px solid var(--border);
    border-radius:24px;
    overflow:hidden;
    box-shadow:var(--shadow-sm);
    position:sticky;
    top:100px;
}

.preview-header{ background:linear-gradient(135deg,#1F4D2B,#355E3B);padding:20px 22px;color:white; }
.preview-header-title{ font-size:13px;font-weight:700;opacity:.8;letter-spacing:.5px;text-transform:uppercase;margin-bottom:4px; }
.preview-header-name{ font-size:20px;font-weight:800; }
.preview-body{ padding:20px 22px; }

.preview-label{ font-size:11px;font-weight:600;text-transform:uppercase;letter-spacing:.5px;color:var(--muted);margin-bottom:10px; }

.preview-sample{ padding:14px 16px;background:var(--bg);border:1px solid var(--border);border-radius:12px;margin-bottom:10px;transition:.2s; }
.preview-sample-title{ font-weight:700;color:var(--text);margin-bottom:4px;transition:font-size .2s; }
.preview-sample-sub{ color:var(--muted);line-height:1.6;transition:font-size .2s; }

.theme-pills{ display:flex;gap:8px;margin-top:12px; }
.theme-pill{ flex:1;padding:10px;border-radius:10px;border:1px solid var(--border);text-align:center;font-size:12px;font-weight:600;color:var(--muted); }
.theme-pill.current{ border-color:var(--primary);color:var(--primary);background:var(--primary-soft); }

.divider{ border:none;border-top:1px solid var(--border);margin:20px 0; }

@media(max-width:860px){ .settings-grid{ grid-template-columns:1fr; } .preview-card{ position:static; } }
@media(max-width:600px){ .settings-hero{ padding:28px 24px;border-radius:22px; } .settings-hero h1{ font-size:26px; } .option-btn{ min-width:70px;font-size:12.5px;padding:10px 12px; } }
</style>

<div class="settings-page">

    <div class="settings-hero">
        <div class="hero-tag">
            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="3"/><path d="M19.07 4.93a10 10 0 0 1 0 14.14M4.93 4.93a10 10 0 0 0 0 14.14"/>
            </svg>
            Preferensi Pengguna
        </div>
        <h1>Pengaturan AgroMart</h1>
        <p>Atur preferensi tampilan dashboard agar lebih nyaman digunakan sesuai kebutuhan Anda.</p>
    </div>

    <div class="settings-grid">

        <div class="settings-card">

            <div class="card-title">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M12 20h9"/><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"/>
                </svg>
                Preferensi Tampilan
            </div>

            <div class="form-group">
                <div class="form-label">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"/>
                    </svg>
                    Tema Tampilan
                </div>
                <div class="option-group" id="theme-group">
                    <button type="button" class="option-btn" data-value="light" onclick="selectOption('theme','light')">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="5"/><line x1="12" y1="1" x2="12" y2="3"/><line x1="12" y1="21" x2="12" y2="23"/><line x1="4.22" y1="4.22" x2="5.64" y2="5.64"/><line x1="18.36" y1="18.36" x2="19.78" y2="19.78"/><line x1="1" y1="12" x2="3" y2="12"/><line x1="21" y1="12" x2="23" y2="12"/><line x1="4.22" y1="19.78" x2="5.64" y2="18.36"/><line x1="18.36" y1="5.64" x2="19.78" y2="4.22"/>
                        </svg>
                        Light Mode
                    </button>
                    <button type="button" class="option-btn" data-value="dark" onclick="selectOption('theme','dark')">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"/>
                        </svg>
                        Dark Mode
                    </button>
                </div>
            </div>

            <hr class="divider">

            <div class="form-group">
                <div class="form-label">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="4 7 4 4 20 4 20 7"/><line x1="9" y1="20" x2="15" y2="20"/><line x1="12" y1="4" x2="12" y2="20"/>
                    </svg>
                    Ukuran Teks
                </div>
                <div class="option-group" id="font-group">
                    <button type="button" class="option-btn" data-value="small" onclick="selectOption('font','small')" style="font-size:12px">Kecil</button>
                    <button type="button" class="option-btn" data-value="medium" onclick="selectOption('font','medium')" style="font-size:14px">Sedang</button>
                    <button type="button" class="option-btn" data-value="large" onclick="selectOption('font','large')" style="font-size:16px">Besar</button>
                </div>
            </div>

            <button class="save-btn" onclick="saveSettings()">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/>
                </svg>
                Simpan Pengaturan
            </button>

            <div class="toast" id="toast">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="20 6 9 17 4 12"/>
                </svg>
                Pengaturan berhasil disimpan!
            </div>

        </div>

        <div class="preview-card">
            <div class="preview-header">
                <div class="preview-header-title">Live Preview</div>
                <div class="preview-header-name">Dashboard AgroMart</div>
            </div>
            <div class="preview-body">
                <div class="preview-label">Tampilan Teks</div>
                <div class="preview-sample">
                    <div class="preview-sample-title" id="prev-title">Judul Halaman</div>
                    <div class="preview-sample-sub" id="prev-sub">Ini contoh teks paragraf dengan ukuran yang kamu pilih. Teks akan menyesuaikan ukuran secara langsung.</div>
                </div>
                <div class="preview-label" style="margin-top:16px">Tema Aktif</div>
                <div class="theme-pills">
                    <div class="theme-pill" id="pill-light">Light Mode</div>
                    <div class="theme-pill" id="pill-dark">Dark Mode</div>
                </div>
            </div>
        </div>

    </div>

</div>

<script>
(function () {

    // ── Cookie helpers (didefinisikan di dalam IIFE supaya pasti tersedia) ──
    function getCookie(name) {
        var value = '; ' + document.cookie;
        var parts = value.split('; ' + name + '=');
        if (parts.length === 2) return parts.pop().split(';').shift();
        return null;
    }

    function setCookie(name, value, days) {
        var expires = '';
        if (days) {
            var date = new Date();
            date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
            expires = '; expires=' + date.toUTCString();
        }
        document.cookie = name + '=' + value + expires + '; path=/';
    }

    // ── State ──────────────────────────────────────────────────────
    var currentTheme = getCookie('theme_pref') || 'light';
    var currentFont  = getCookie('font_pref')  || 'medium';

    var fontSizeMap    = { small: '13px',   medium: '15px',   large: '17px'   };
    var previewTitleMap= { small: '15px',   medium: '18px',   large: '22px'   };
    var previewSubMap  = { small: '12px',   medium: '13.5px', large: '15px'   };

    // ── Init ───────────────────────────────────────────────────────
    function init() {
        setTheme(currentTheme);
        setFont(currentFont);
        markActive('theme-group', currentTheme);
        markActive('font-group',  currentFont);
        updatePreview();
    }

    // ── Pilih opsi ─────────────────────────────────────────────────
    window.selectOption = function (type, value) {
        if (type === 'theme') {
            currentTheme = value;
            setTheme(value);
            markActive('theme-group', value);
        } else {
            currentFont = value;
            setFont(value);
            markActive('font-group', value);
        }
        updatePreview();
        hideToast();
    };

    // ── Apply tema ─────────────────────────────────────────────────
    function setTheme(theme) {
        if (theme === 'dark') {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    }

    // ── Apply font ─────────────────────────────────────────────────
    function setFont(size) {
        document.body.style.fontSize = fontSizeMap[size] || '15px';
        document.documentElement.classList.remove('font-small', 'font-medium', 'font-large');
        document.documentElement.classList.add('font-' + size);
    }

    // ── Active button ──────────────────────────────────────────────
    function markActive(groupId, value) {
        var btns = document.querySelectorAll('#' + groupId + ' .option-btn');
        btns.forEach(function (btn) {
            btn.classList.toggle('active', btn.dataset.value === value);
        });
    }

    // ── Update preview ─────────────────────────────────────────────
    function updatePreview() {
        var title = document.getElementById('prev-title');
        var sub   = document.getElementById('prev-sub');
        if (title) title.style.fontSize = previewTitleMap[currentFont] || '18px';
        if (sub)   sub.style.fontSize   = previewSubMap[currentFont]   || '13.5px';

        var pillLight = document.getElementById('pill-light');
        var pillDark  = document.getElementById('pill-dark');
        if (pillLight && pillDark) {
            pillLight.classList.toggle('current', currentTheme === 'light');
            pillDark.classList.toggle('current',  currentTheme === 'dark');
        }
    }

    // ── Simpan ─────────────────────────────────────────────────────
    window.saveSettings = function () {
        setCookie('theme_pref', currentTheme, 30);
        setCookie('font_pref',  currentFont,  30);

        fetch("{{ route('settings.save') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            },
            body: JSON.stringify({
                theme:     currentTheme,
                font_size: currentFont,
            })
        })
        .then(function (r) { return r.json(); })
        .then(function () { showToast(); })
        .catch(function () { showToast(); });
    };

    function showToast() {
        var t = document.getElementById('toast');
        if (!t) return;
        t.classList.add('show');
        setTimeout(function () { t.classList.remove('show'); }, 3000);
    }

    function hideToast() {
        var t = document.getElementById('toast');
        if (t) t.classList.remove('show');
    }

    document.addEventListener('DOMContentLoaded', init);

})();
</script>

@endsection