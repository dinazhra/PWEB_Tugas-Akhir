<nav class="navbar-clean">

    <div class="navbar-wrapper">

        {{-- BRAND --}}
        <a href="
            {{
                auth()->check()
                ? (
                    auth()->user()->role === 'admin'
                        ? route('admin.dashboard')
                        : route('customer.dashboard')
                )
                : url('/')
            }}
        "
        class="brand-wrap">

            <div class="brand-logo">
                <img src="{{ asset('images/newlogo.png') }}"
                     alt="AgroMart">
            </div>

            <div class="brand-text">
                <h2>AgroMart</h2>
                <span>Smart Farming Store</span>
            </div>

        </a>

        @auth

        {{-- MENU --}}
        <div class="nav-center">

            @if(auth()->user()->role === 'admin')

                <a href="{{ route('admin.dashboard') }}"
                   class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="fa-solid fa-chart-line"></i>
                    Dashboard
                </a>

                <a href="{{ route('pupuk.index') }}"
                   class="{{ request()->is('pupuk*') ? 'active' : '' }}">
                    <i class="fa-solid fa-seedling"></i>
                    Produk
                </a>

                <a href="{{ route('admin.pesanan') }}"
                   class="{{ request()->is('admin/pesanan*') ? 'active' : '' }}">
                    <i class="fa-solid fa-box"></i>
                    Pesanan
                </a>

                <a href="{{ route('admin.laporan') }}"
                   class="{{ request()->is('admin/laporan*') ? 'active' : '' }}">
                    <i class="fa-solid fa-file-lines"></i>
                    Laporan
                </a>

                <a href="{{ route('admin.chats') }}"
                   class="{{ request()->is('admin/chats*') ? 'active' : '' }}">
                    <i class="fa-solid fa-comments"></i>
                    Chat
                </a>

            @else

                <a href="{{ route('customer.dashboard') }}"
                   class="{{ request()->routeIs('customer.dashboard') ? 'active' : '' }}">
                    <i class="fa-solid fa-house"></i>
                    Dashboard
                </a>

                <a href="{{ route('pupuk.index') }}"
                   class="{{ request()->is('pupuk*') ? 'active' : '' }}">
                    <i class="fa-solid fa-seedling"></i>
                    Produk
                </a>

                <a href="{{ route('cart.index') }}"
                   class="{{ request()->is('cart*') ? 'active' : '' }}">
                    <i class="fa-solid fa-cart-shopping"></i>
                    Keranjang
                </a>

                <a href="{{ route('pesanan') }}"
                   class="{{ request()->is('pesanan*') ? 'active' : '' }}">
                    <i class="fa-solid fa-box-open"></i>
                    Pesanan
                </a>

                <a href="{{ route('chat.index') }}"
                   class="{{ request()->is('chat*') ? 'active' : '' }}">
                    <i class="fa-solid fa-comment"></i>
                    Chat
                </a>

            @endif

        </div>

        <div class="profile-panel">

            {{-- ── BELL NOTIFIKASI ── --}}
            <div class="notif-wrap" id="notifWrap">

                <button
                    class="notif-btn"
                    id="notifBtn"
                    onclick="toggleNotif()"
                    aria-label="Notifikasi"
                >
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"
                         stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"
                         style="width:22px;height:22px">
                        <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/>
                        <path d="M13.73 21a2 2 0 0 1-3.46 0"/>
                    </svg>
                    <div class="notif-badge" id="notifBadge"></div>
                </button>

                {{-- Dropdown --}}
                <div class="notif-dropdown" id="notifDropdown">

                    <div class="notif-header">
                        <div class="notif-header-title">Notifikasi</div>
                        <button class="notif-read-all" onclick="markAllRead()">
                            Tandai semua dibaca
                        </button>
                    </div>

                    <div class="notif-list" id="notifList">
                        <div class="notif-empty" id="notifEmpty">
                            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                 stroke-width="1.5" style="width:36px;height:36px;color:#B0C8B8;display:block;margin:0 auto 10px">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/>
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M13.73 21a2 2 0 0 1-3.46 0"/>
                            </svg>
                            Belum ada notifikasi
                        </div>
                    </div>

                </div>
            </div>
            {{-- ── END BELL ── --}}

            <button class="menu-toggle"
                    onclick="openSidebar()">
                <i class="fa-solid fa-bars"></i>
            </button>

        </div>

        <div class="sidebar-overlay"
            id="sidebarOverlay"
            onclick="closeSidebar()"></div>

        <div class="user-sidebar" id="userSidebar">

            <div class="sidebar-header">

                <div class="sidebar-avatar">
                    {{ strtoupper(substr(auth()->user()->name,0,1)) }}
                </div>

                <div>
                    <div class="sidebar-name">
                        {{ auth()->user()->name }}
                    </div>
                    <div class="sidebar-role">
                        {{ ucfirst(auth()->user()->role) }}
                    </div>
                </div>

            </div>

            <a href="{{ route('profil.index') }}" class="sidebar-link">
                <i class="fa-solid fa-user"></i>
                Profil Saya
            </a>

            <a href="{{ route('settings.index') }}" class="sidebar-link">
                <i class="fa-solid fa-gear"></i>
                Pengaturan
            </a>

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="sidebar-logout">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    Logout
                </button>
            </form>

        </div>

        @endauth

    </div>

</nav>

<style>

.navbar-clean{
    position:sticky;
    top:0;
    z-index:999;
    background:rgba(255,255,255,.88);
    backdrop-filter:blur(18px);
    border-bottom:1px solid #EAEFEA;
}

.navbar-wrapper{
    max-width:1280px;
    margin:auto;
    padding:18px 64px;
    display:flex;
    align-items:center;
    justify-content:space-between;
    gap:24px;
}

/* BRAND */
.brand-wrap{
    display:flex;
    align-items:center;
    gap:14px;
    text-decoration:none;
}

.brand-logo{
    width:54px;
    height:54px;
    border-radius:18px;
    background:#EEF5EF;
    display:flex;
    align-items:center;
    justify-content:center;
}

.brand-logo img{
    width:34px;
    object-fit:contain;
}

.brand-text h2{
    font-size:20px;
    color:#1F2937;
    font-weight:700;
    margin-bottom:2px;
}

.brand-text span{
    font-size:12px;
    color:#6B7280;
}

/* MENU */
.nav-center{
    display:flex;
    align-items:center;
    gap:12px;
}

.nav-center a{
    display:flex;
    align-items:center;
    gap:8px;
    padding:12px 18px;
    border-radius:14px;
    color:#647067;
    font-weight:500;
    font-size:14px;
    transition:.25s;
    text-decoration:none;
}

.nav-center a i{ font-size:13px; }

.nav-center a:hover{
    background:#F4F8F5;
    color:#355E3B;
}

.nav-center a.active{
    background:#355E3B;
    color:white;
    font-weight:600;
}

/* PROFILE PANEL */
.profile-panel{
    display:flex;
    align-items:center;
    gap:8px;
    background:white;
    border:1px solid #E7ECE7;
    border-radius:999px;
    padding:8px 10px 8px 8px;
    box-shadow:0 8px 20px rgba(0,0,0,.04);
}

/* ── NOTIF BELL ── */
.notif-wrap{
    position:relative;
    display:inline-flex;
}

.notif-btn{
    width:42px;
    height:42px;
    border-radius:50%;
    background:transparent;
    border:none;
    cursor:pointer;
    display:flex;
    align-items:center;
    justify-content:center;
    color:#647067;
    transition:.2s;
    position:relative;
}

.notif-btn:hover{
    background:#F4F8F5;
    color:#355E3B;
}

.notif-badge{
    position:absolute;
    top:3px;
    right:3px;
    min-width:17px;
    height:17px;
    border-radius:999px;
    background:#E24B4A;
    border:2px solid white;
    font-size:10px;
    font-weight:700;
    color:white;
    display:none;
    align-items:center;
    justify-content:center;
    padding:0 3px;
    line-height:1;
    font-family:sans-serif;
}

.notif-badge.show{ display:flex; }

.notif-dropdown{
    position:absolute;
    top:calc(100% + 12px);
    right:0;
    width:340px;
    background:white;
    border:1px solid #DDE8DF;
    border-radius:20px;
    box-shadow:0 16px 48px rgba(0,0,0,.12);
    z-index:9999;
    overflow:hidden;
    opacity:0;
    transform:translateY(8px) scale(.97);
    pointer-events:none;
    transition:opacity .2s, transform .2s;
}

html.dark .notif-dropdown{
    background:#17211A;
    border-color:#253029;
}

.notif-dropdown.open{
    opacity:1;
    transform:translateY(0) scale(1);
    pointer-events:all;
}

.notif-header{
    display:flex;
    align-items:center;
    justify-content:space-between;
    padding:16px 18px 12px;
    border-bottom:1px solid #DDE8DF;
}

html.dark .notif-header{ border-color:#253029; }

.notif-header-title{
    font-size:15px;
    font-weight:700;
    color:#131F14;
}

html.dark .notif-header-title{ color:#E8F2EA; }

.notif-read-all{
    font-size:12px;
    font-weight:600;
    color:#1F5C35;
    background:none;
    border:none;
    cursor:pointer;
    padding:4px 8px;
    border-radius:8px;
    transition:.2s;
}

.notif-read-all:hover{ background:#EAF4EE; }

.notif-list{
    max-height:340px;
    overflow-y:auto;
}

.notif-item{
    display:flex;
    gap:12px;
    align-items:flex-start;
    padding:14px 18px;
    border-bottom:1px solid #F0F4F0;
    cursor:pointer;
    transition:background .15s;
}

html.dark .notif-item{ border-color:#1E2B20; }
.notif-item:last-child{ border-bottom:none; }
.notif-item:hover{ background:#F7FAF7; }
html.dark .notif-item:hover{ background:#1A2820; }
.notif-item.unread{ background:#F0F9F2; }
html.dark .notif-item.unread{ background:#182B1E; }

.notif-icon{
    width:36px;
    height:36px;
    border-radius:10px;
    display:flex;
    align-items:center;
    justify-content:center;
    flex-shrink:0;
}

.notif-icon svg{ width:18px; height:18px; }
.notif-icon.new_order   { background:#FEF2F2; color:#E24B4A; }
.notif-icon.low_stock   { background:#FAEEDA; color:#854F0B; }
.notif-icon.order_status{ background:#EAF4EE; color:#1F5C35; }

.notif-msg{
    font-size:13px;
    color:#131F14;
    line-height:1.5;
    flex:1;
}

html.dark .notif-msg{ color:#E8F2EA; }

.notif-time{
    font-size:11px;
    color:#627365;
    margin-top:3px;
}

.notif-dot{
    width:7px;
    height:7px;
    border-radius:50%;
    background:#1F5C35;
    flex-shrink:0;
    margin-top:5px;
}

.notif-empty{
    text-align:center;
    padding:36px 20px;
    color:#627365;
    font-size:13px;
}

/* MENU TOGGLE */
.menu-toggle{
    width:42px;
    height:42px;
    border:none;
    border-radius:50%;
    background:#F5F8F5;
    color:#355E3B;
    cursor:pointer;
    font-size:16px;
    transition:.3s;
    display:flex;
    align-items:center;
    justify-content:center;
}

.menu-toggle:hover{
    background:#355E3B;
    color:white;
}

/* SIDEBAR */
.sidebar-overlay{
    position:fixed;
    inset:0;
    background:rgba(0,0,0,.35);
    opacity:0;
    visibility:hidden;
    transition:.3s;
    z-index:1998;
}

.sidebar-overlay.show{
    opacity:1;
    visibility:visible;
}

.user-sidebar{
    position:fixed;
    top:0;
    right:-340px;
    width:320px;
    height:100vh;
    background:white;
    z-index:1999;
    padding:28px;
    transition:.35s;
    box-shadow:-15px 0 40px rgba(0,0,0,.12);
}

.user-sidebar.show{ right:0; }

.sidebar-header{
    display:flex;
    align-items:center;
    gap:14px;
    margin-bottom:35px;
}

.sidebar-avatar{
    width:60px;
    height:60px;
    border-radius:50%;
    background:#355E3B;
    color:white;
    display:flex;
    justify-content:center;
    align-items:center;
    font-weight:700;
    font-size:20px;
}

.sidebar-name{ font-size:16px; font-weight:700; }
.sidebar-role{ font-size:13px; color:#6B7280; }

.sidebar-link{
    display:flex;
    align-items:center;
    gap:12px;
    padding:16px;
    border-radius:16px;
    margin-bottom:10px;
    text-decoration:none;
    color:#374151;
    transition:.25s;
}

.sidebar-link:hover{ background:#F4F8F5; }

.sidebar-logout{
    width:100%;
    margin-top:20px;
    border:none;
    border-radius:16px;
    padding:16px;
    background:#DC2626;
    color:white;
    font-weight:700;
    cursor:pointer;
    display:flex;
    align-items:center;
    justify-content:center;
    gap:10px;
    font-size:14px;
}

/* RESPONSIVE */
@media(max-width:992px){
    .navbar-wrapper{
        padding:18px 22px;
        flex-wrap:wrap;
    }
    .nav-center{
        width:100%;
        justify-content:center;
        order:3;
        gap:12px;
        flex-wrap:wrap;
    }
    .profile-panel{ margin-left:auto; }
}

@media(max-width:768px){
    .brand-text span{ display:none; }
    .nav-center{
        justify-content:flex-start;
        overflow-x:auto;
        white-space:nowrap;
    }
}

</style>

<script>

function openSidebar(){
    document.getElementById('userSidebar').classList.add('show');
    document.getElementById('sidebarOverlay').classList.add('show');
}

function closeSidebar(){
    document.getElementById('userSidebar').classList.remove('show');
    document.getElementById('sidebarOverlay').classList.remove('show');
}

// ── NOTIFIKASI ──────────────────────────────────────────────────────
(function () {
    var isOpen  = false;
    var polling = null;

    var icons = {
        new_order:    '<svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>',
        low_stock:    '<svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M10.29 3.86 1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>',
        order_status: '<svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>',
    };

    window.toggleNotif = function () {
        isOpen = !isOpen;
        document.getElementById('notifDropdown').classList.toggle('open', isOpen);
        if (isOpen) {
            loadNotifs();
            startPolling();
        } else {
            stopPolling();
        }
    };

    // Tutup kalau klik di luar
    document.addEventListener('click', function (e) {
        var wrap = document.getElementById('notifWrap');
        if (wrap && !wrap.contains(e.target)) {
            isOpen = false;
            document.getElementById('notifDropdown').classList.remove('open');
            stopPolling();
        }
    });

    function loadNotifs() {
        fetch('/notifications', {
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
        .then(function (r) { return r.json(); })
        .then(function (data) {
            renderNotifs(data);
            var unread = data.filter(function (n) { return !n.is_read; }).length;
            updateBadge(unread);
        })
        .catch(function () {});
    }

    function renderNotifs(data) {
        var list = document.getElementById('notifList');
        if (!data.length) {
            list.innerHTML = '<div class="notif-empty"><svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" style="width:36px;height:36px;color:#B0C8B8;display:block;margin:0 auto 10px"><path stroke-linecap="round" stroke-linejoin="round" d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/><path stroke-linecap="round" stroke-linejoin="round" d="M13.73 21a2 2 0 0 1-3.46 0"/></svg>Belum ada notifikasi</div>';
            return;
        }
        list.innerHTML = data.map(function (n) {
            var icon   = icons[n.type] || icons['order_status'];
            var unread = n.is_read ? '' : 'unread';
            var dot    = n.is_read ? '' : '<div class="notif-dot"></div>';
            return '<div class="notif-item ' + unread + '" onclick="markRead(' + n.id + ', this)">' +
                '<div class="notif-icon ' + n.type + '">' + icon + '</div>' +
                '<div style="flex:1">' +
                    '<div class="notif-msg">' + esc(n.message) + '</div>' +
                    '<div class="notif-time">' + n.time + '</div>' +
                '</div>' + dot +
            '</div>';
        }).join('');
    }

    window.markRead = function (id, el) {
        el.classList.remove('unread');
        var dot = el.querySelector('.notif-dot');
        if (dot) dot.remove();
        fetch('/notifications/read/' + id, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]') ? document.querySelector('meta[name="csrf-token"]').content : '',
                'X-Requested-With': 'XMLHttpRequest',
            }
        })
        .then(function () { checkUnread(); })
        .catch(function () {});
    };

    window.markAllRead = function () {
        fetch('/notifications/read-all', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]') ? document.querySelector('meta[name="csrf-token"]').content : '',
                'X-Requested-With': 'XMLHttpRequest',
            }
        })
        .then(function () {
            document.querySelectorAll('.notif-item').forEach(function (el) {
                el.classList.remove('unread');
                var dot = el.querySelector('.notif-dot');
                if (dot) dot.remove();
            });
            updateBadge(0);
        })
        .catch(function () {});
    };

    function checkUnread() {
        fetch('/notifications/unread-count', {
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
        .then(function (r) { return r.json(); })
        .then(function (data) { updateBadge(data.count); })
        .catch(function () {});
    }

    function updateBadge(count) {
        var badge = document.getElementById('notifBadge');
        if (!badge) return;
        if (count > 0) {
            badge.textContent = count > 9 ? '9+' : count;
            badge.classList.add('show');
        } else {
            badge.classList.remove('show');
        }
    }

    function startPolling() {
        stopPolling();
        polling = setInterval(loadNotifs, 10000);
    }

    function stopPolling() {
        if (polling) clearInterval(polling);
    }

    function esc(str) {
        return String(str).replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;');
    }

    // Cek badge tiap 15 detik walau dropdown tertutup
    setInterval(checkUnread, 15000);
    checkUnread();
})();

</script>