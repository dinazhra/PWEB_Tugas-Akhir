@extends('layouts.app')

@section('title', 'Chat - AgroMart')

@section('content')

<link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;500;600;700;800&family=DM+Sans:wght@400;500;600&display=swap" rel="stylesheet">

<style>
*, *::before, *::after { box-sizing: border-box; }

:root {
    --green-900: #0f2d1a; --green-800: #17361F; --green-700: #1e4a2b;
    --green-600: #2F6B45; --green-100: #eaf5e4; --green-50: #f4faf1;
    --text-main: #0f1f14; --text-muted: #5a7362; --border: #dce9d5;
    --bg: #f0f5ee; --white: #ffffff;
    --shadow-sm: 0 2px 8px rgba(15,45,26,.06);
}

body { font-family: 'DM Sans', sans-serif; background: var(--bg); color: var(--text-main); }

.chat-page { max-width: 100%; margin: auto; padding: 28px 24px 60px; }

.chat-hero {
    background: linear-gradient(130deg, var(--green-900) 0%, var(--green-700) 50%, var(--green-600) 100%);
    border-radius: 36px; padding: 40px 44px; color: #fff;
    position: relative; overflow: hidden; margin-bottom: 24px;
}
.chat-hero::before {
    content: ''; position: absolute; inset: 0;
    background: radial-gradient(ellipse 60% 80% at 110% 20%, rgba(107,154,69,.25) 0%, transparent 60%);
    pointer-events: none;
}
.hero-inner { position: relative; z-index: 1; }
.hero-label {
    display: inline-flex; align-items: center; gap: 8px;
    background: rgba(255,255,255,.12); border: 1px solid rgba(255,255,255,.18);
    border-radius: 999px; padding: 6px 14px; font-size: 13px; font-weight: 600;
    color: #c8e8be; margin-bottom: 14px;
}
.hero-title { font-family: 'Sora', sans-serif; font-size: 32px; font-weight: 800; letter-spacing: -.5px; margin-bottom: 8px; }
.hero-sub { color: #b8d9b0; font-size: 14px; line-height: 1.7; }

.chat-box {
    background: var(--white); border: 1px solid var(--border);
    border-radius: 28px; box-shadow: var(--shadow-sm);
    display: flex; flex-direction: column; height: calc(100vh - 320px); overflow: hidden;
}

.chat-header {
    padding: 18px 24px; border-bottom: 1px solid var(--border);
    display: flex; align-items: center; gap: 12px; background: var(--green-50);
}
.admin-avatar {
    width: 42px; height: 42px; background: var(--green-600); border-radius: 14px;
    display: flex; align-items: center; justify-content: center; flex-shrink: 0;
}
.chat-header-info strong { font-family: 'Sora', sans-serif; font-size: 15px; font-weight: 700; color: var(--text-main); display: block; }
.chat-header-info span { font-size: 12.5px; color: var(--text-muted); display: flex; align-items: center; gap: 5px; }
.online-dot { width: 7px; height: 7px; background: #22c55e; border-radius: 50%; display: inline-block; }

.chat-messages {
    flex: 1; overflow-y: auto; padding: 20px 24px;
    display: flex; flex-direction: column; gap: 12px; scroll-behavior: smooth;
}
.chat-messages::-webkit-scrollbar { width: 4px; }
.chat-messages::-webkit-scrollbar-thumb { background: var(--border); border-radius: 99px; }

.bubble-wrap { display: flex; flex-direction: column; max-width: 72%; }
.bubble-wrap.mine { align-self: flex-end; align-items: flex-end; }
.bubble-wrap.theirs { align-self: flex-start; align-items: flex-start; }
.bubble-sender { font-size: 11.5px; color: var(--text-muted); margin-bottom: 4px; font-weight: 600; }
.bubble { padding: 11px 16px; border-radius: 18px; font-size: 14.5px; line-height: 1.6; word-break: break-word; }
.bubble.mine { background: var(--green-600); color: white; border-bottom-right-radius: 6px; }
.bubble.theirs { background: var(--green-50); border: 1px solid var(--border); color: var(--text-main); border-bottom-left-radius: 6px; }
.bubble-time { font-size: 11px; color: var(--text-muted); margin-top: 4px; }

.chat-empty {
    flex: 1; display: flex; flex-direction: column; align-items: center;
    justify-content: center; gap: 10px; color: var(--text-muted); text-align: center; padding: 40px;
}
.chat-empty svg { opacity: .4; }
.chat-empty p { font-size: 14px; line-height: 1.6; }

.chat-input-area {
    padding: 16px 20px; border-top: 1px solid var(--border);
    display: flex; gap: 10px; align-items: flex-end; background: var(--white);
}
.chat-input {
    flex: 1; border: 1px solid var(--border); border-radius: 16px; padding: 12px 16px;
    font-size: 14px; font-family: 'DM Sans', sans-serif; resize: none; outline: none;
    background: var(--green-50); color: var(--text-main); max-height: 120px;
    transition: border-color .2s; line-height: 1.5;
}
.chat-input:focus { border-color: var(--green-600); }
.send-btn {
    width: 44px; height: 44px; background: var(--green-600); border: none;
    border-radius: 14px; display: flex; align-items: center; justify-content: center;
    cursor: pointer; flex-shrink: 0; transition: background .2s, transform .2s;
}
.send-btn:hover { background: var(--green-800); transform: translateY(-2px); }
.send-btn:disabled { opacity: .5; cursor: not-allowed; transform: none; }

@media(max-width:768px){
    .chat-page { padding: 16px 16px 40px; }
    .chat-hero { padding: 28px 24px; }
    .hero-title { font-size: 24px; }
    .chat-box { height: 500px; }
    .bubble-wrap { max-width: 85%; }
}
</style>

<div class="chat-page">

    <div class="chat-hero">
        <div class="hero-inner">
            <div class="hero-label">
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>
                </svg>
                Hubungi Kami
            </div>
            <h1 class="hero-title">Chat dengan Admin</h1>
            <p class="hero-sub">Tanya seputar produk, pesanan, atau kebutuhan pertanian Anda langsung ke tim AgroMart.</p>
        </div>
    </div>

    <div class="chat-box">

        <div class="chat-header">
            <div class="admin-avatar">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/>
                </svg>
            </div>
            <div class="chat-header-info">
                <strong>Admin AgroMart</strong>
                <span><span class="online-dot"></span> Tim Support</span>
            </div>
        </div>

        <div class="chat-messages" id="chatMessages">

            @if($messages->count() === 0)
                <div class="chat-empty" id="emptyState">
                    <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>
                    </svg>
                    <p>Belum ada pesan.<br>Mulai chat dengan admin AgroMart!</p>
                </div>
            @else
                @foreach($messages as $msg)
                @php $isMine = $msg->sender_id === auth()->id(); @endphp
                <div class="bubble-wrap {{ $isMine ? 'mine' : 'theirs' }}">
                    @if(!$isMine)<span class="bubble-sender">{{ $msg->sender->name }}</span>@endif
                    <div class="bubble {{ $isMine ? 'mine' : 'theirs' }}">{{ $msg->message }}</div>
                    <span class="bubble-time">{{ $msg->created_at->format('H:i') }}</span>
                </div>
                @endforeach
            @endif

        </div>

        <div class="chat-input-area">
            <textarea id="chatInput" class="chat-input" placeholder="Ketik pesan..." rows="1"></textarea>
            <button class="send-btn" id="sendBtn">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/>
                </svg>
            </button>
        </div>

    </div>

</div>

<script>
const chatMessages = document.getElementById('chatMessages');
const chatInput    = document.getElementById('chatInput');
const sendBtn      = document.getElementById('sendBtn');
let   emptyState   = document.getElementById('emptyState');
let   lastId       = {{ $messages->count() > 0 ? $messages->last()->id : 0 }};

chatInput.addEventListener('input', function () {
    this.style.height = 'auto';
    this.style.height = Math.min(this.scrollHeight, 120) + 'px';
});

chatInput.addEventListener('keydown', function (e) {
    if (e.key === 'Enter' && !e.shiftKey) { e.preventDefault(); sendMessage(); }
});

sendBtn.addEventListener('click', sendMessage);

function sendMessage() {
    const msg = chatInput.value.trim();
    if (!msg) return;
    sendBtn.disabled = true;
    chatInput.value  = '';
    chatInput.style.height = 'auto';

    fetch('{{ route('chat.send') }}', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
        body: JSON.stringify({ chat_id: {{ $chat->id }}, message: msg }),
    })
    .then(r => r.json())
    .then(() => pollMessages())
    .finally(() => { sendBtn.disabled = false; chatInput.focus(); });
}

function appendBubble(m) {
    if (emptyState) { emptyState.remove(); emptyState = null; }
    const wrap = document.createElement('div');
    wrap.className = 'bubble-wrap ' + (m.is_mine ? 'mine' : 'theirs');
    let html = '';
    if (!m.is_mine) html += `<span class="bubble-sender">${m.sender}</span>`;
    html += `<div class="bubble ${m.is_mine ? 'mine' : 'theirs'}">${escapeHtml(m.message)}</div>`;
    html += `<span class="bubble-time">${m.time}</span>`;
    wrap.innerHTML = html;
    chatMessages.appendChild(wrap);
    chatMessages.scrollTop = chatMessages.scrollHeight;
}

function escapeHtml(text) {
    const d = document.createElement('div');
    d.appendChild(document.createTextNode(text));
    return d.innerHTML;
}

function pollMessages() {
    fetch(`{{ route('chat.poll') }}?last_id=${lastId}`)
        .then(r => r.json())
        .then(data => {
            data.messages.forEach(m => { appendBubble(m); lastId = Math.max(lastId, m.id); });
        });
}

chatMessages.scrollTop = chatMessages.scrollHeight;
setInterval(pollMessages, 3000);
</script>

@endsection