<x-guest-layout>

{{-- GOOGLE FONT --}}
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

<style>
    * { font-family: 'Plus Jakarta Sans', sans-serif; }
</style>

<div class="min-h-screen flex bg-[#F2F7F2]">

    {{-- LEFT SIDE --}}
    <div class="hidden lg:flex lg:w-[55%] relative overflow-hidden">

        <div class="absolute inset-0 bg-[#17361F]"></div>

        <div class="absolute -top-24 -right-24 w-[380px] h-[380px] rounded-full bg-[#2F6B45]/40"></div>
        <div class="absolute top-1/2 -right-16 w-[220px] h-[220px] rounded-full bg-[#4a9b5f]/20"></div>
        <div class="absolute -bottom-16 -left-16 w-[300px] h-[300px] rounded-full bg-[#8bc34a]/15"></div>
        <div class="absolute bottom-1/3 right-1/4 w-[120px] h-[120px] rounded-full bg-[#2F6B45]/25"></div>

        <div class="relative z-10 flex flex-col justify-between px-16 py-14 text-white w-full">

            {{-- LOGO --}}
            <div class="flex items-center gap-4">
                <div class="w-14 h-14 rounded-2xl bg-[#8bc34a] flex items-center justify-center shadow-lg flex-shrink-0">
                    <svg viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-8 h-8">
                        <path d="M14 3C14 3 7 9 7 16a7 7 0 0 0 14 0c0-7-7-13-7-13z" fill="#17361F"/>
                        <path d="M14 10 Q17 14 14 22" stroke="white" stroke-width="1.5" stroke-linecap="round" fill="none"/>
                        <path d="M14 14 Q11 11 9 13" stroke="white" stroke-width="1.3" stroke-linecap="round" fill="none"/>
                        <path d="M14 17 Q17 14 19 16" stroke="white" stroke-width="1.3" stroke-linecap="round" fill="none"/>
                    </svg>
                </div>
                <div>
                    <h1 class="text-2xl font-bold tracking-tight">AgroMart</h1>
                    <p class="text-[#a8d5ab] text-xs tracking-wider mt-0.5">Smart Farming Store</p>
                </div>
            </div>

            {{-- HERO --}}
            <div>
                <div class="inline-flex items-center gap-2 bg-white/10 border border-white/15 rounded-full px-4 py-2 mb-8">
                    <span class="w-2 h-2 rounded-full bg-[#8bc34a]"></span>
                    <span class="text-[#b5d96a] text-xs font-semibold tracking-[1.5px] uppercase">Solusi Pertanian Modern</span>
                </div>

                <h2 class="text-6xl font-extrabold leading-[1.05] tracking-tight">
                    Bertani Lebih<br>
                    <span class="text-[#8bc34a]">Mudah</span><br>
                    Bersama AgroMart
                </h2>

                <p class="mt-6 text-[#a8d5ab] text-base leading-7 max-w-md">
                    Platform modern untuk membeli pupuk berkualitas dengan pengalaman
                    cepat, aman, dan terpercaya untuk kebutuhan pertanian Anda.
                </p>
            </div>

            {{-- FEATURE CARDS --}}
            <div class="grid grid-cols-2 gap-4 max-w-sm">
                <div class="bg-white/8 border border-white/10 rounded-2xl p-5">
                    <div class="w-9 h-9 rounded-xl bg-[#8bc34a]/20 flex items-center justify-center mb-3">
                        <svg class="w-5 h-5 text-[#8bc34a]" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 00-3.213-9.193 2.056 2.056 0 00-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 00-10.026 0 1.106 1.106 0 00-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12"/>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-sm">Pengiriman Cepat</h3>
                    <p class="text-[#a8d5ab] text-xs mt-1 leading-5">Dikirim aman ke seluruh Indonesia.</p>
                </div>

                <div class="bg-white/8 border border-white/10 rounded-2xl p-5">
                    <div class="w-9 h-9 rounded-xl bg-[#8bc34a]/20 flex items-center justify-center mb-3">
                        <svg class="w-5 h-5 text-[#8bc34a]" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 01-1.043 3.296 3.745 3.745 0 01-3.296 1.043A3.745 3.745 0 0112 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 01-3.296-1.043 3.745 3.745 0 01-1.043-3.296A3.745 3.745 0 013 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 011.043-3.296 3.746 3.746 0 013.296-1.043A3.746 3.746 0 0112 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 013.296 1.043 3.746 3.746 0 011.043 3.296A3.745 3.745 0 0121 12z"/>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-sm">Produk Bersertifikat</h3>
                    <p class="text-[#a8d5ab] text-xs mt-1 leading-5">Pupuk pilihan mutu terbaik.</p>
                </div>
            </div>

        </div>
    </div>

    {{-- RIGHT SIDE --}}
    <div class="w-full lg:w-[45%] flex justify-center items-center px-6 py-12">

        <div class="w-full max-w-[420px]">

            {{-- MOBILE LOGO --}}
            <div class="lg:hidden text-center mb-10">
                <div class="w-16 h-16 rounded-2xl bg-[#2F6B45] mx-auto flex items-center justify-center mb-4">
                    <svg viewBox="0 0 28 28" fill="none" class="w-9 h-9">
                        <path d="M14 3C14 3 7 9 7 16a7 7 0 0 0 14 0c0-7-7-13-7-13z" fill="white"/>
                        <path d="M14 10 Q17 14 14 22" stroke="#2F6B45" stroke-width="1.5" stroke-linecap="round" fill="none"/>
                        <path d="M14 14 Q11 11 9 13" stroke="#2F6B45" stroke-width="1.3" stroke-linecap="round" fill="none"/>
                        <path d="M14 17 Q17 14 19 16" stroke="#2F6B45" stroke-width="1.3" stroke-linecap="round" fill="none"/>
                    </svg>
                </div>
                <h1 class="text-3xl font-bold text-[#17361F]">AgroMart</h1>
                <p class="text-gray-400 text-sm mt-1">Smart Farming Store</p>
            </div>

            {{-- CARD --}}
            <div class="bg-white border border-[#E0EDE1] shadow-[0_8px_40px_rgba(0,0,0,0.07)] rounded-[28px] p-9">

                {{-- HEADER --}}
                <div class="text-center mb-8">
                    <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-[#EEF7EF] mb-5">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="#2F6B45" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"/>
                        </svg>
                    </div>
                    <h2 class="text-3xl font-extrabold text-[#17361F] tracking-tight">Selamat Datang</h2>
                    <p class="text-gray-400 text-sm mt-2 leading-6">
                        Login ke akun AgroMart Anda untuk melanjutkan aktivitas.
                    </p>
                </div>

                {{-- SESSION STATUS --}}
                <x-auth-session-status class="mb-5" :status="session('status')" />

                {{-- FORM --}}
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    {{-- EMAIL --}}
                    <div class="mb-5">
                        <label class="block mb-2 text-sm font-semibold text-[#17361F]">Email</label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75"/>
                                </svg>
                            </span>
                            <input
                                id="email"
                                type="email"
                                name="email"
                                value="{{ old('email') }}"
                                required
                                autofocus
                                autocomplete="username"
                                placeholder="Masukkan email"
                                class="w-full pl-11 pr-4 py-3.5 rounded-xl border border-gray-200 bg-[#FAFBFA] text-sm text-gray-800 placeholder-gray-400 focus:ring-4 focus:ring-green-100 focus:border-[#2F6B45] outline-none transition"
                            >
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    {{-- PASSWORD --}}
                    <div class="mb-5">
                        <label class="block mb-2 text-sm font-semibold text-[#17361F]">Password</label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z"/>
                                </svg>
                            </span>
                            <input
                                id="password"
                                type="password"
                                name="password"
                                required
                                autocomplete="current-password"
                                placeholder="Masukkan password"
                                class="w-full pl-11 pr-12 py-3.5 rounded-xl border border-gray-200 bg-[#FAFBFA] text-sm text-gray-800 placeholder-gray-400 focus:ring-4 focus:ring-green-100 focus:border-[#2F6B45] outline-none transition"
                            >

                            {{-- TOGGLE PASSWORD --}}
                            <button
                                type="button"
                                onclick="togglePassword()"
                                class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-[#2F6B45] transition"
                            >
                                {{-- EYE OPEN: tampil default --}}
                                <svg id="eye-open"
                                     xmlns="http://www.w3.org/2000/svg"
                                     fill="none" viewBox="0 0 24 24"
                                     stroke-width="1.8" stroke="currentColor"
                                     style="width:20px;height:20px;display:block">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.964-7.178z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>

                                {{-- EYE CLOSE: hidden default --}}
                                <svg id="eye-close"
                                     xmlns="http://www.w3.org/2000/svg"
                                     fill="none" viewBox="0 0 24 24"
                                     stroke-width="1.8" stroke="currentColor"
                                     style="width:20px;height:20px;display:none">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 3l18 18"/>
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M10.477 10.488a3 3 0 004.242 4.242"/>
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M9.88 5.09A9.953 9.953 0 0112 4.5c4.638 0 8.573 3.007 9.963 7.178a1.01 1.01 0 010 .644 10.05 10.05 0 01-4.043 5.116M6.228 6.228A10.05 10.05 0 002.037 11.68a1.01 1.01 0 000 .644C3.423 16.493 7.36 19.5 12 19.5a9.953 9.953 0 005.272-1.5"/>
                                </svg>
                            </button>

                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    {{-- REMEMBER & FORGOT --}}
                    <div class="flex items-center mb-7">
                        <label class="flex items-center gap-2.5 text-sm text-gray-500 cursor-pointer">
                            <input
                                type="checkbox"
                                name="remember"
                                class="rounded border-gray-300 text-[#2F6B45] focus:ring-[#2F6B45] w-4 h-4"
                            >
                            Ingat saya
                        </label>
                    </div>

                    {{-- SUBMIT --}}
                    <button
                        type="submit"
                        class="w-full bg-[#2F6B45] hover:bg-[#17361F] text-white font-bold py-3.5 rounded-xl shadow-md transition duration-200 text-sm tracking-wide"
                    >
                        Login Sekarang
                    </button>

                    {{-- REGISTER --}}
                    <p class="text-center text-gray-400 text-sm mt-7">
                        Belum punya akun?
                        <a href="{{ route('register') }}"
                           class="text-[#2F6B45] font-bold hover:underline">
                            Daftar sekarang
                        </a>
                    </p>

                </form>

            </div>
        </div>
    </div>

</div>

<script>
function togglePassword() {
    const password = document.getElementById('password');
    const eyeOpen  = document.getElementById('eye-open');
    const eyeClose = document.getElementById('eye-close');

    if (password.type === 'password') {
        password.type = 'text';
        eyeOpen.style.display  = 'none';
        eyeClose.style.display = 'block';
    } else {
        password.type = 'password';
        eyeOpen.style.display  = 'block';
        eyeClose.style.display = 'none';
    }
}
</script>

</x-guest-layout>