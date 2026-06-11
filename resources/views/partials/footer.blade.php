<footer class="footer-clean">

    <div class="footer-wrapper">

        {{-- TOP --}}
        <div class="footer-grid">

            {{-- BRAND --}}
            <div class="footer-brand">

                <div class="footer-brand-head">

                    <div class="footer-logo">
                        <img src="{{ asset('images/newlogo.png') }}"
                             alt="AgroMart">
                    </div>

                    <div>
                        <h3>AgroMart</h3>
                        <span>Smart Farming Store</span>
                    </div>

                </div>

                <p>
                    Platform pertanian modern untuk membantu petani
                    menemukan pupuk berkualitas dengan pengalaman
                    belanja yang lebih mudah, cepat, dan nyaman.
                </p>

            </div>

            {{-- NAVIGATION --}}
            <div>

                <h4>Menu</h4>

                <div class="footer-links">

                    @auth

                        @if(auth()->user()->role === 'admin')

                            <a href="{{ route('admin.dashboard') }}">
                                Dashboard
                            </a>

                            <a href="{{ route('pupuk.index') }}">
                                Produk
                            </a>

                            <a href="{{ route('admin.pesanan') }}">
                                Pesanan
                            </a>

                            <a href="{{ route('settings.index') }}">
                                Pengaturan
                            </a>

                        @else

                            <a href="{{ route('customer.dashboard') }}">
                                Dashboard
                            </a>

                            <a href="{{ route('pupuk.index') }}">
                                Produk
                            </a>

                            <a href="{{ route('cart.index') }}">
                                Keranjang
                            </a>

                            <a href="{{ route('pesanan') }}">
                                Pesanan
                            </a>

                        @endif

                    @endauth

                </div>
            </div>

            {{-- CONTACT --}}
            <div>

                <h4>Kontak</h4>

                <div class="footer-contact">

                    <span>AgroMart@mail.com</span>
                    <span>Jember, Indonesia</span>
                    <span>+62 812-3456-7890</span>

                </div>
            </div>

        </div>

        {{-- BOTTOM --}}
        <div class="footer-bottom">

            <p>
                © 2026 AgroMart. All rights reserved.
            </p>

            <div class="footer-policy">

                <a href="#">
                    Privacy
                </a>

                <a href="#">
                    Terms
                </a>

            </div>

        </div>

    </div>

</footer>

<style>

.footer-clean{
    margin-top:100px;
    background:white;
    border-top:1px solid #EAEFEA;
}

.footer-wrapper{
    max-width:1280px;
    margin:auto;
    padding:72px 64px 28px;
}

/* GRID */

.footer-grid{
    display:grid;
    grid-template-columns:
    1.4fr
    1fr
    1fr;

    gap:60px;
    margin-bottom:50px;
}

/* BRAND */

.footer-brand-head{
    display:flex;
    align-items:center;
    gap:14px;
    margin-bottom:18px;
}

.footer-logo{
    width:58px;
    height:58px;
    border-radius:20px;
    background:#EEF5EF;

    display:flex;
    align-items:center;
    justify-content:center;
}

.footer-logo img{
    width:36px;
    object-fit:contain;
}

.footer-brand h3{
    font-size:22px;
    color:#1F2937;
    font-weight:700;
}

.footer-brand span{
    font-size:12px;
    color:#6B7280;
}

.footer-brand p{
    color:#6B7280;
    font-size:14px;
    line-height:1.9;
    max-width:420px;
}

/* SECTION */

.footer-grid h4{
    font-size:16px;
    margin-bottom:18px;
    color:#1F2937;
    font-weight:600;
}

.footer-links,
.footer-contact{
    display:flex;
    flex-direction:column;
    gap:14px;
}

.footer-links a,
.footer-contact span{
    color:#6B7280;
    font-size:14px;
    transition:.25s;
}

.footer-links a:hover{
    color:#355E3B;
    transform:translateX(4px);
}

/* BOTTOM */

.footer-bottom{
    border-top:1px solid #EEF2EE;
    padding-top:24px;

    display:flex;
    align-items:center;
    justify-content:space-between;
    gap:16px;
    flex-wrap:wrap;
}

.footer-bottom p{
    color:#9CA3AF;
    font-size:13px;
}

.footer-policy{
    display:flex;
    align-items:center;
    gap:18px;
}

.footer-policy a{
    color:#9CA3AF;
    font-size:13px;
    transition:.25s;
}

.footer-policy a:hover{
    color:#355E3B;
}

/* RESPONSIVE */

@media(max-width:992px){

    .footer-wrapper{
        padding:54px 22px 24px;
    }

    .footer-grid{
        grid-template-columns:1fr;
        gap:40px;
    }
}

</style>