{{--
    resources/views/components/notification-widget.blade.php
    
    Include di layouts/app.blade.php di bagian navbar, contoh:
    <x-notification-widget />
--}}

@auth
<style>
.notif-wrap {
    position: relative;
    display: inline-flex;
}

/* Bell button */
.notif-btn {
    width: 40px;
    height: 40px;
    border-radius: 12px;
    background: transparent;
    border: none;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--notif-icon-color, #627365);
    transition: background .2s, color .2s;
    position: relative;
}

.notif-btn:hover {
    background: rgba(31,92,53,.08);
    color: #1F5C35;
}

.notif-btn svg {
    width: 22px;
    height: 22px;
}

/* Badge */
.notif-badge {
    position: absolute;
    top: 4px;
    right: 4px;
    min-width: 17px;
    height: 17px;
    border-radius: 999px;
    background: #E24B4A;
    border: 2px solid white;
    font-size: 10px;
    font-weight: 700;
    color: white;
    display: none;
    align-items: center;
    justify-content: center;
    padding: 0 3px;
    font-family: sans-serif;
    line-height: 1;
}

.notif-badge.show {
    display: flex;
}

/* Dropdown */
.notif-dropdown {
    position: absolute;
    top: calc(100% + 10px);
    right: 0;
    width: 340px;
    background: white;
    border: 1px solid #DDE8DF;
    border-radius: 20px;
    box-shadow: 0 16px 48px rgba(0,0,0,.12);
    z-index: 9999;
    overflow: hidden;

    opacity: 0;
    transform: translateY(8px) scale(.97);
    pointer-events: none;
    transition: opacity .2s, transform .2s;
}

html.dark .notif-dropdown {
    background: #17211A;
    border-color: #253029;
}

.notif-dropdown.open {
    opacity: 1;
    transform: translateY(0) scale(1);
    pointer-events: all;
}

/* Header dropdown */
.notif-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 16px 18px 12px;
    border-bottom: 1px solid #DDE8DF;
}

html.dark .notif-header {
    border-color: #253029;
}

.notif-header-title {
    font-size: 15px;
    font-weight: 700;
    color: #131F14;
    font-family: 'Plus Jakarta Sans', sans-serif;
}

html.dark .notif-header-title {
    color: #E8F2EA;
}

.notif-read-all {
    font-size: 12px;
    font-weight: 600;
    color: #1F5C35;
    background: none;
    border: none;
    cursor: pointer;
    padding: 4px 8px;
    border-radius: 8px;
    transition: background .2s;
}

.notif-read-all:hover {
    background: #EAF4EE;
}

/* List */
.notif-list {
    max-height: 340px;
    overflow-y: auto;
}

.notif-item {
    display: flex;
    gap: 12px;
    align-items: flex-start;
    padding: 14px 18px;
    border-bottom: 1px solid #F0F4F0;
    cursor: pointer;
    transition: background .15s;
    text-decoration: none;
}

html.dark .notif-item {
    border-color: #1E2B20;
}

.notif-item:last-child {
    border-bottom: none;
}

.notif-item:hover {
    background: #F7FAF7;
}

html.dark .notif-item:hover {
    background: #1A2820;
}

.notif-item.unread {
    background: #F0F9F2;
}

html.dark .notif-item.unread {
    background: #182B1E;
}

/* Icon per tipe */
.notif-icon {
    width: 36px;
    height: 36px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.notif-icon.new_order    { background: #FEF2F2; color: #E24B4A; }
.notif-icon.low_stock    { background: #FAEEDA; color: #854F0B; }
.notif-icon.order_status { background: #EAF4EE; color: #1F5C35; }

.notif-icon svg {
    width: 18px;
    height: 18px;
}

.notif-msg {
    font-size: 13px;
    color: #131F14;
    line-height: 1.5;
    flex: 1;
}

html.dark .notif-msg {
    color: #E8F2EA;
}

.notif-time {
    font-size: 11px;
    color: #627365;
    margin-top: 3px;
}

.notif-dot {
    width: 7px;
    height: 7px;
    border-radius: 50%;
    background: #1F5C35;
    flex-shrink: 0;
    margin-top: 5px;
}

/* Empty */
.notif-empty {
    text-align: center;
    padding: 36px 20px;
    color: #627365;
    font-size: 13px;
}

.notif-empty svg {
    width: 36px;
    height: 36px;
    color: #B0C8B8;
    margin: 0 auto 10px;
    display: block;
}
</style>

<div class="notif-wrap" id="notifWrap">

    {{-- Bell button --}}
    <button
        class="notif-btn"
        id="notifBtn"
        onclick="toggleNotif()"
        aria-label="Notifikasi"
    >
        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
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
            <div class="notif-empty">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/>
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.73 21a2 2 0 0 1-3.46 0"/>
                </svg>
                Belum ada notifikasi
            </div>
        </div>

    </div>
</div>

<script>
(function () {
    var isOpen   = false;
    var polling  = null;

    // Icon per tipe notifikasi
    var icons = {
        new_order: '<svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>',
        low_stock: '<svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M10.29 3.86 1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>',
        order_status: '<svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>',
    };

    // ── Toggle buka/tutup ────────────────────────────────────────
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
        if (!document.getElementById('notifWrap').contains(e.target)) {
            isOpen = false;
            document.getElementById('notifDropdown').classList.remove('open');
            stopPolling();
        }
    });

    // ── Load notifikasi ──────────────────────────────────────────
    function loadNotifs() {
        fetch('{{ route("notifications.index") }}', {
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
        .then(r => r.json())
        .then(data => {
            renderNotifs(data);
            var unread = data.filter(n => !n.is_read).length;
            updateBadge(unread);
        })
        .catch(() => {});
    }

    // ── Render notifikasi ke dropdown ────────────────────────────
    function renderNotifs(data) {
        var list = document.getElementById('notifList');

        if (!data.length) {
            list.innerHTML = '<div class="notif-empty"><svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/><path stroke-linecap="round" stroke-linejoin="round" d="M13.73 21a2 2 0 0 1-3.46 0"/></svg>Belum ada notifikasi</div>';
            return;
        }

        list.innerHTML = data.map(function (n) {
            var icon    = icons[n.type] || icons['order_status'];
            var unread  = n.is_read ? '' : 'unread';
            var dot     = n.is_read ? '' : '<div class="notif-dot"></div>';

            return '<div class="notif-item ' + unread + '" onclick="markRead(' + n.id + ', this)">' +
                '<div class="notif-icon ' + n.type + '">' + icon + '</div>' +
                '<div style="flex:1">' +
                    '<div class="notif-msg">' + escHtml(n.message) + '</div>' +
                    '<div class="notif-time">' + n.time + '</div>' +
                '</div>' +
                dot +
            '</div>';
        }).join('');
    }

    // ── Tandai satu notif dibaca ─────────────────────────────────
    window.markRead = function (id, el) {
        el.classList.remove('unread');
        var dot = el.querySelector('.notif-dot');
        if (dot) dot.remove();

        fetch('{{ route("notifications.read", ":id") }}'.replace(':id', id), {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN':     '{{ csrf_token() }}',
                'X-Requested-With': 'XMLHttpRequest',
            }
        })
        .then(() => checkUnread())
        .catch(() => {});
    };

    // ── Tandai semua dibaca ──────────────────────────────────────
    window.markAllRead = function () {
        fetch('{{ route("notifications.readAll") }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN':     '{{ csrf_token() }}',
                'X-Requested-With': 'XMLHttpRequest',
            }
        })
        .then(() => {
            document.querySelectorAll('.notif-item').forEach(function (el) {
                el.classList.remove('unread');
                var dot = el.querySelector('.notif-dot');
                if (dot) dot.remove();
            });
            updateBadge(0);
        })
        .catch(() => {});
    };

    // ── Cek unread count (badge) ─────────────────────────────────
    function checkUnread() {
        fetch('{{ route("notifications.unread") }}', {
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
        .then(r => r.json())
        .then(data => updateBadge(data.count))
        .catch(() => {});
    }

    function updateBadge(count) {
        var badge = document.getElementById('notifBadge');
        if (count > 0) {
            badge.textContent = count > 9 ? '9+' : count;
            badge.classList.add('show');
        } else {
            badge.classList.remove('show');
        }
    }

    // ── Polling ──────────────────────────────────────────────────
    function startPolling() {
        stopPolling();
        polling = setInterval(loadNotifs, 10000);
    }

    function stopPolling() {
        if (polling) clearInterval(polling);
    }

    // Cek badge tiap 15 detik walau dropdown tertutup
    setInterval(checkUnread, 15000);
    checkUnread();

    function escHtml(str) {
        return String(str)
            .replace(/&/g, '&amp;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;');
    }
})();
</script>
@endauth