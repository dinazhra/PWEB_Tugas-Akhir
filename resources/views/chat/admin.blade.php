@extends('layouts.app')

@section('title', 'Chat Masuk - AgroMart')

@section('content')

<link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;500;600;700;800&family=DM+Sans:wght@400;500;600&display=swap" rel="stylesheet">

<style>
*, *::before, *::after { box-sizing: border-box; }
:root {
    --g900:#0f2d1a; --g800:#17361F; --g700:#1e4a2b;
    --g600:#2F6B45; --g100:#eaf5e4; --g50:#f4faf1;
    --text:#0f1f14; --muted:#5a7362; --border:#dce9d5;
    --bg:#f0f5ee; --white:#ffffff;
    --shadow:0 2px 8px rgba(15,45,26,.06);
}
body { font-family:'DM Sans',sans-serif; background:var(--bg); color:var(--text); }

/* ── LAYOUT ── */
.wa-wrap {
    max-width:1200px;
    margin:0 auto;
    height:calc(100vh - 120px);
    display:grid;
    grid-template-columns:340px 1fr;
    background:var(--white);
    border:1px solid var(--border);
    border-radius:28px;
    overflow:hidden;
    box-shadow:0 8px 32px rgba(15,45,26,.08);
}

/* ── LEFT PANEL ── */
.wa-left {
    display:flex;
    flex-direction:column;
    border-right:1px solid var(--border);
    background:var(--white);
}

.wa-left-header {
    padding:20px 20px 14px;
    border-bottom:1px solid var(--border);
    background:var(--g50);
    flex-shrink:0;
}

.wa-left-title {
    font-family:'Sora',sans-serif;
    font-size:20px;
    font-weight:800;
    color:var(--g800);
    margin-bottom:12px;
}

.wa-search {
    position:relative;
}

.wa-search input {
    width:100%;
    background:var(--white);
    border:1px solid var(--border);
    border-radius:12px;
    padding:9px 12px 9px 36px;
    font-size:13.5px;
    color:var(--text);
    outline:none;
    font-family:'DM Sans',sans-serif;
    transition:border-color .2s;
}

.wa-search input:focus { border-color:var(--g600); }

.wa-search svg {
    position:absolute;
    left:10px;
    top:50%;
    transform:translateY(-50%);
    color:var(--muted);
    pointer-events:none;
}

.wa-contact-list {
    flex:1;
    overflow-y:auto;
}

.wa-contact-list::-webkit-scrollbar { width:3px; }
.wa-contact-list::-webkit-scrollbar-thumb { background:var(--border); border-radius:99px; }

.wa-contact {
    display:flex;
    align-items:center;
    gap:12px;
    padding:14px 18px;
    cursor:pointer;
    border-bottom:1px solid #f5f8f5;
    transition:background .15s;
    text-decoration:none;
    color:inherit;
    position:relative;
}

.wa-contact:hover { background:var(--g50); }
.wa-contact.active { background:var(--g100); border-right:3px solid var(--g600); }
.wa-contact.has-unread { background:#f0faf3; }

.wa-avatar {
    width:46px; height:46px;
    border-radius:50%;
    background:var(--g100);
    display:flex; align-items:center; justify-content:center;
    font-family:'Sora',sans-serif;
    font-weight:800; font-size:17px;
    color:var(--g600);
    flex-shrink:0;
}

.wa-contact.active .wa-avatar {
    background:var(--g600);
    color:white;
}

.wa-contact-info { flex:1; min-width:0; }

.wa-contact-name {
    font-family:'Sora',sans-serif;
    font-size:14px;
    font-weight:700;
    color:var(--text);
    margin-bottom:2px;
}

.wa-contact-preview {
    font-size:12.5px;
    color:var(--muted);
    white-space:nowrap;
    overflow:hidden;
    text-overflow:ellipsis;
}

.wa-contact-right {
    display:flex;
    flex-direction:column;
    align-items:flex-end;
    gap:4px;
    flex-shrink:0;
}

.wa-contact-time { font-size:11px; color:var(--muted); }

.wa-unread {
    background:var(--g600);
    color:white;
    font-size:11px;
    font-weight:700;
    min-width:20px;
    height:20px;
    border-radius:999px;
    display:flex;
    align-items:center;
    justify-content:center;
    padding:0 5px;
}

/* ── RIGHT PANEL ── */
.wa-right {
    display:flex;
    flex-direction:column;
    background:var(--bg);
}

/* Empty state kanan */
.wa-empty-right {
    flex:1;
    display:flex;
    flex-direction:column;
    align-items:center;
    justify-content:center;
    gap:14px;
    color:var(--muted);
    text-align:center;
    padding:40px;
}

.wa-empty-right svg { opacity:.25; }
.wa-empty-right h3 { font-family:'Sora',sans-serif; font-size:20px; font-weight:700; color:var(--g800); }
.wa-empty-right p { font-size:14px; max-width:280px; line-height:1.6; }

/* Chat header kanan */
.wa-chat-header {
    padding:14px 22px;
    border-bottom:1px solid var(--border);
    display:flex;
    align-items:center;
    gap:14px;
    background:var(--white);
    flex-shrink:0;
}

.wa-chat-header-avatar {
    width:42px; height:42px;
    border-radius:50%;
    background:var(--g600);
    color:white;
    display:flex; align-items:center; justify-content:center;
    font-family:'Sora',sans-serif;
    font-weight:800; font-size:16px;
    flex-shrink:0;
}

.wa-chat-header-name {
    font-family:'Sora',sans-serif;
    font-size:15px;
    font-weight:700;
    color:var(--text);
}

.wa-chat-header-email {
    font-size:12.5px;
    color:var(--muted);
    margin-top:1px;
}

/* Messages */
.wa-messages {
    flex:1;
    overflow-y:auto;
    padding:20px 24px;
    display:flex;
    flex-direction:column;
    gap:10px;
    scroll-behavior:smooth;
}

.wa-messages::-webkit-scrollbar { width:4px; }
.wa-messages::-webkit-scrollbar-thumb { background:var(--border); border-radius:99px; }

.bubble-wrap { display:flex; flex-direction:column; max-width:68%; }
.bubble-wrap.mine { align-self:flex-end; align-items:flex-end; }
.bubble-wrap.theirs { align-self:flex-start; align-items:flex-start; }

.bubble-sender { font-size:11.5px; color:var(--muted); margin-bottom:3px; font-weight:600; }

.bubble {
    padding:10px 15px;
    border-radius:18px;
    font-size:14px;
    line-height:1.6;
    word-break:break-word;
}

.bubble.mine {
    background:var(--g600);
    color:white;
    border-bottom-right-radius:5px;
}

.bubble.theirs {
    background:var(--white);
    border:1px solid var(--border);
    color:var(--text);
    border-bottom-left-radius:5px;
}

.bubble-time { font-size:10.5px; color:var(--muted); margin-top:3px; }

.msg-empty {
    flex:1;
    display:flex;
    flex-direction:column;
    align-items:center;
    justify-content:center;
    gap:8px;
    color:var(--muted);
    text-align:center;
}

.msg-empty svg { opacity:.3; }
.msg-empty p { font-size:13.5px; }

/* Input area */
.wa-input-area {
    padding:14px 18px;
    border-top:1px solid var(--border);
    display:flex;
    gap:10px;
    align-items:flex-end;
    background:var(--white);
    flex-shrink:0;
}

.wa-textarea {
    flex:1;
    border:1px solid var(--border);
    border-radius:14px;
    padding:11px 15px;
    font-size:14px;
    font-family:'DM Sans',sans-serif;
    resize:none;
    outline:none;
    background:var(--g50);
    color:var(--text);
    max-height:110px;
    transition:border-color .2s;
    line-height:1.5;
}

.wa-textarea:focus { border-color:var(--g600); }

.wa-send-btn {
    width:44px; height:44px;
    background:var(--g600);
    border:none;
    border-radius:50%;
    display:flex; align-items:center; justify-content:center;
    cursor:pointer;
    flex-shrink:0;
    transition:background .2s, transform .15s;
}

.wa-send-btn:hover { background:var(--g800); transform:scale(1.07); }
.wa-send-btn:disabled { opacity:.5; cursor:not-allowed; transform:none; }

/* date separator */
.date-sep {
    text-align:center;
    font-size:11.5px;
    color:var(--muted);
    background:rgba(220,233,213,.5);
    border-radius:999px;
    padding:4px 14px;
    align-self:center;
    margin:4px 0;
}

/* ── RESPONSIVE ── */
@media(max-width:700px){
    .wa-wrap { grid-template-columns:1fr; height:auto; }
    .wa-left { display: none; }
    .wa-right { height:calc(100vh - 140px); }
}
</style>

<div class="wa-wrap">

    {{-- ── LEFT: CONTACT LIST ── --}}
    <div class="wa-left">

        <div class="wa-left-header">
            <div class="wa-left-title">Pesan Masuk</div>
            <div class="wa-search">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
                </svg>
                <input type="text" id="searchInput" placeholder="Cari customer..." oninput="filterContacts(this.value)">
            </div>
        </div>

        <div class="wa-contact-list" id="contactList">
            @forelse($chats as $chat)
            <a
                href="javascript:void(0)"
                class="wa-contact {{ $chat->unread_count > 0 ? 'has-unread' : '' }}"
                data-id="{{ $chat->id }}"
                data-name="{{ $chat->customer->name }}"
                data-email="{{ $chat->customer->email }}"
                data-search="{{ strtolower($chat->customer->name) }}"
                onclick="openChat({{ $chat->id }}, '{{ addslashes($chat->customer->name) }}', '{{ $chat->customer->email }}')"
            >
                <div class="wa-avatar">{{ strtoupper(substr($chat->customer->name, 0, 1)) }}</div>
                <div class="wa-contact-info">
                    <div class="wa-contact-name">{{ $chat->customer->name }}</div>
                    <div class="wa-contact-preview">
                        {{ Str::limit($chat->messages->first()?->message ?? 'Belum ada pesan', 40) }}
                    </div>
                </div>
                <div class="wa-contact-right">
                    <span class="wa-contact-time">{{ $chat->updated_at->diffForHumans() }}</span>
                    @if($chat->unread_count > 0)
                        <span class="wa-unread" id="badge-{{ $chat->id }}">{{ $chat->unread_count }}</span>
                    @endif
                </div>
            </a>
            @empty
            <div style="padding:40px 20px;text-align:center;color:var(--muted);font-size:13.5px;">
                Belum ada chat masuk.
            </div>
            @endforelse
        </div>

    </div>

    {{-- ── RIGHT: CHAT ROOM ── --}}
    <div class="wa-right" id="waRight">

        {{-- Empty state (belum pilih chat) --}}
        <div class="wa-empty-right" id="emptyRight">
            <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="#2F6B45" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>
            </svg>
            <h3>Pilih percakapan</h3>
            <p>Klik salah satu nama customer di kiri untuk membuka chat.</p>
        </div>

        {{-- Chat room (hidden dulu) --}}
        <div id="chatRoom" style="display:none;flex-direction:column;flex:1;overflow:hidden;">

            <div class="wa-chat-header" id="chatHeader">
                <div class="wa-chat-header-avatar" id="chatAvatar"></div>
                <div>
                    <div class="wa-chat-header-name" id="chatName"></div>
                    <div class="wa-chat-header-email" id="chatEmail"></div>
                </div>
            </div>

            <div class="wa-messages" id="chatMessages"></div>

            <div class="wa-input-area">
                <textarea
                    id="chatInput"
                    class="wa-textarea"
                    placeholder="Ketik balasan..."
                    rows="1"
                    onkeydown="handleKey(event)"
                    oninput="autoResize(this)"
                ></textarea>
                <button class="wa-send-btn" id="sendBtn" onclick="sendMessage()">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="22" y1="2" x2="11" y2="13"/>
                        <polygon points="22 2 15 22 11 13 2 9 22 2"/>
                    </svg>
                </button>
            </div>

        </div>

    </div>

</div>

<script>
var activeChatId   = null;
var polling        = null;
var lastMsgId      = 0;
var csrfToken      = '{{ csrf_token() }}';

// ── Buka chat ────────────────────────────────────────────────────
function openChat(chatId, name, email) {
    // Update active state di kontak list
    document.querySelectorAll('.wa-contact').forEach(function(el) {
        el.classList.toggle('active', el.dataset.id == chatId);
    });

    activeChatId = chatId;
    lastMsgId    = 0;

    // Update header
    document.getElementById('chatAvatar').textContent = name.charAt(0).toUpperCase();
    document.getElementById('chatName').textContent   = name;
    document.getElementById('chatEmail').textContent  = email;

    // Tampilkan chat room
    document.getElementById('emptyRight').style.display  = 'none';
    var room = document.getElementById('chatRoom');
    room.style.display = 'flex';

    // Reset messages
    document.getElementById('chatMessages').innerHTML = '';

    // Hilangkan badge unread
    var badge = document.getElementById('badge-' + chatId);
    if (badge) badge.remove();

    // Load pesan
    loadMessages(true);

    // Start polling
    if (polling) clearInterval(polling);
    polling = setInterval(function() { loadMessages(false); }, 3000);
}

// ── Load messages ────────────────────────────────────────────────
function loadMessages(scrollBottom) {
    if (!activeChatId) return;

    fetch('/admin/chats/' + activeChatId + '/poll?last_id=' + lastMsgId, {
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
    })
    .then(function(r) { return r.json(); })
    .then(function(data) {
        var msgs   = data.messages || [];
        var wrap   = document.getElementById('chatMessages');

        if (msgs.length === 0 && lastMsgId === 0) {
            wrap.innerHTML = '<div class="msg-empty"><svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg><p>Belum ada pesan.</p></div>';
            return;
        }

        // Hapus empty state kalau ada
        var empty = wrap.querySelector('.msg-empty');
        if (empty) empty.remove();

        msgs.forEach(function(m) {
            lastMsgId = Math.max(lastMsgId, m.id);
            appendBubble(m, wrap);
        });

        if (scrollBottom || msgs.length > 0) {
            wrap.scrollTop = wrap.scrollHeight;
        }
    })
    .catch(function() {});
}

// ── Render bubble ────────────────────────────────────────────────
function appendBubble(m, wrap) {
    var div  = document.createElement('div');
    div.className = 'bubble-wrap ' + (m.is_mine ? 'mine' : 'theirs');
    var html = '';
    if (!m.is_mine) html += '<span class="bubble-sender">' + esc(m.sender) + '</span>';
    html += '<div class="bubble ' + (m.is_mine ? 'mine' : 'theirs') + '">' + esc(m.message) + '</div>';
    html += '<span class="bubble-time">' + m.time + '</span>';
    div.innerHTML = html;
    wrap.appendChild(div);
}

// ── Kirim pesan ──────────────────────────────────────────────────
function sendMessage() {
    var input = document.getElementById('chatInput');
    var msg   = input.value.trim();
    if (!msg || !activeChatId) return;

    var btn = document.getElementById('sendBtn');
    btn.disabled = true;
    input.value  = '';
    input.style.height = '';

    fetch('/admin/chats/' + activeChatId + '/send', {
        method: 'POST',
        headers: {
            'Content-Type':     'application/json',
            'X-CSRF-TOKEN':     csrfToken,
            'X-Requested-With': 'XMLHttpRequest',
        },
        body: JSON.stringify({ message: msg })
    })
    .then(function(r) { return r.json(); })
    .then(function(data) {
        if (data.id) {
            lastMsgId = Math.max(lastMsgId, data.id);
            var wrap  = document.getElementById('chatMessages');
            var empty = wrap.querySelector('.msg-empty');
            if (empty) empty.remove();
            appendBubble({ id: data.id, is_mine: true, message: msg, time: data.time, sender: 'Admin' }, wrap);
            wrap.scrollTop = wrap.scrollHeight;
        }
    })
    .catch(function() {})
    .finally(function() { btn.disabled = false; document.getElementById('chatInput').focus(); });
}

// ── Helpers ──────────────────────────────────────────────────────
function handleKey(e) {
    if (e.key === 'Enter' && !e.shiftKey) { e.preventDefault(); sendMessage(); }
}

function autoResize(el) {
    el.style.height = '';
    el.style.height = Math.min(el.scrollHeight, 110) + 'px';
}

function filterContacts(q) {
    document.querySelectorAll('.wa-contact').forEach(function(el) {
        var match = el.dataset.search.includes(q.toLowerCase());
        el.style.display = match ? '' : 'none';
    });
}

function esc(str) {
    return String(str).replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;').replace(/\n/g,'<br>');
}
</script>

@endsection