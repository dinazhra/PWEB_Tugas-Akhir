<!DOCTYPE html>
<html lang="id"
      class="
        {{ request()->cookie('theme_pref') === 'dark' ? 'dark' : '' }}
        font-{{ request()->cookie('font_pref', 'medium') }}
      ">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>
        @yield('title', 'AgroMart')
    </title>

    <link rel="stylesheet"
          href="{{ asset('css/style.css') }}">

    {{-- FONT --}}
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
          rel="stylesheet">

    {{-- ICON --}}
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"/>

    <style>

        /* ==========================
           ROOT THEME
        ========================== */

        :root{
            --bg:#F8FBF7;
            --white:#FFFFFF;

            --primary:#2F6B45;
            --primary-hover:#255638;
            --primary-soft:#EEF7EF;

            --text:#182218;
            --muted:#7A857A;

            --border:#E7EEE8;

            --danger:#DC3545;
            --danger-soft:#FFF3F4;

            --radius-xl:32px;
            --radius-lg:24px;
            --radius-md:18px;
            --radius-sm:14px;

            --shadow-sm:
                0 4px 12px rgba(0,0,0,.04);

            --shadow-md:
                0 10px 30px rgba(20,40,20,.06);

            --transition:.28s ease;
        }

        /* ==========================
           DARK MODE
        ========================== */

        html.dark{
            --bg:#0F1411;
            --white:#18201A;

            --primary:#4E9A63;
            --primary-hover:#5EAE74;
            --primary-soft:#223126;

            --text:#EAF4EC;
            --muted:#A8B5AA;

            --border:#28352D;

            --danger:#ef4444;
            --danger-soft:#351a1a;

            --shadow-sm:
                0 4px 16px rgba(0,0,0,.35);

            --shadow-md:
                0 12px 28px rgba(0,0,0,.45);
        }

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
        }

        html{
            scroll-behavior:smooth;
        }

        body{
            font-family:'Inter',sans-serif;
            background:var(--bg);
            color:var(--text);
            overflow-x:hidden;
            min-height:100vh;
            transition:
                background .25s ease,
                color .25s ease;
        }

        a{
            text-decoration:none;
            color:inherit;
        }

        button,
        input,
        textarea,
        select{
            font-family:'Inter',sans-serif;
        }

        input,
        textarea,
        select{
            background:var(--white);
            color:var(--text);
            border:1px solid var(--border);
        }

        .layout-wrapper{
            min-height:100vh;
            display:flex;
            flex-direction:column;
            position:relative;
        }

        .main-wrapper{
            flex:1;
            display:flex;
            flex-direction:column;
        }

        main{
            flex:1;
            width:100%;
            padding:
                42px
                64px
                64px;

            animation:
                fadePage .45s ease;
        }

        /* ==========================
           BACKGROUND
        ========================== */

        .bg-gradient{
            position:fixed;
            inset:0;
            z-index:-2;

            background:
                linear-gradient(
                    180deg,
                    #F7FAF5 0%,
                    #FCFDFC 100%
                );

            transition:.3s ease;
        }

        html.dark .bg-gradient{
            background:
                linear-gradient(
                    180deg,
                    #0D120F 0%,
                    #151C17 100%
                );
        }

        .bg-circle{
            position:fixed;
            border-radius:999px;
            filter:blur(90px);
            z-index:-1;
            opacity:.08;
            pointer-events:none;
        }

        .circle-1{
            width:380px;
            height:380px;
            background:#4F8A5B;
            top:-140px;
            left:-120px;
        }

        .circle-2{
            width:420px;
            height:420px;
            background:#A8D5BA;
            right:-160px;
            bottom:-160px;
        }

        .circle-3{
            width:280px;
            height:280px;
            background:#DDEEDD;
            top:35%;
            right:18%;
        }

        html.dark .circle-1{
            background:#29553A;
        }

        html.dark .circle-2{
            background:#1F3326;
        }

        html.dark .circle-3{
            background:#213127;
        }

        /* ==========================
           FLASH
        ========================== */

        .flash-container{
            width:100%;
            max-width:1320px;
            margin:24px auto 0;
            padding:0 64px;
        }

        .alert{
            display:flex;
            align-items:center;
            gap:14px;

            padding:18px 22px;
            border-radius:22px;

            font-size:14px;
            font-weight:500;

            backdrop-filter:blur(10px);

            box-shadow:var(--shadow-sm);

            animation:
                slideDown .35s ease;
        }

        .alert-success{
            background:#F0F9F1;
            border:1px solid #D8EEDB;
            color:#2F6B45;
        }

        .alert-error{
            background:#FFF5F5;
            border:1px solid #F2D4D7;
            color:#C0392B;
        }

        html.dark .alert-success{
            background:#183121;
            border:1px solid #29553A;
            color:#9EE6B1;
        }

        html.dark .alert-error{
            background:#351B1B;
            border:1px solid #5C2B2B;
            color:#FCA5A5;
        }

        /* ==========================
           CONTAINER
        ========================== */

        .container-clean{
            max-width:1280px;
            margin:0 auto;
        }

        /* ==========================
           CARD
        ========================== */

        .clean-card{
            background:var(--white);
            border:1px solid var(--border);
            border-radius:var(--radius-lg);
            box-shadow:var(--shadow-sm);
            transition:var(--transition);
        }

        .clean-card:hover{
            transform:translateY(-4px);
            box-shadow:var(--shadow-md);
        }

        /* ==========================
           BUTTON
        ========================== */

        .btn-primary{
            background:var(--primary);
            color:white;
            border:none;
            border-radius:16px;
            padding:14px 24px;
            font-size:14px;
            font-weight:600;
            cursor:pointer;
            transition:var(--transition);
        }

        .btn-primary:hover{
            background:var(--primary-hover);
            transform:translateY(-2px);
        }

        .btn-outline{
            background:var(--white);
            border:1px solid var(--border);
            color:var(--text);
            border-radius:16px;
            padding:14px 24px;
            font-size:14px;
            font-weight:600;
            cursor:pointer;
            transition:var(--transition);
        }

        .btn-outline:hover{
            background:var(--primary-soft);
        }

        /* ==========================
           INPUT
        ========================== */

        .input-clean{
            width:100%;
            background:var(--white);
            border:1px solid var(--border);
            color:var(--text);
            border-radius:18px;
            padding:15px 18px;
            outline:none;
            transition:var(--transition);
        }

        .input-clean:focus{
            border-color:#8BBE95;

            box-shadow:
                0 0 0 4px
                rgba(47,107,69,.08);
        }

        /* ==========================
           FONT SIZE
        ========================== */

        html.font-small{
            font-size:14px;
        }

        html.font-medium{
            font-size:16px;
        }

        html.font-large{
            font-size:18px;
        }

        /* ==========================
           ANIMATION
        ========================== */

        @keyframes slideDown{

            from{
                opacity:0;
                transform:translateY(-14px);
            }

            to{
                opacity:1;
                transform:translateY(0);
            }
        }

        @keyframes fadePage{

            from{
                opacity:0;
                transform:translateY(8px);
            }

            to{
                opacity:1;
                transform:translateY(0);
            }
        }

        /* ==========================
           RESPONSIVE
        ========================== */

        @media(max-width:992px){

            main{
                padding:28px 24px 40px;
            }

            .flash-container{
                padding:0 24px;
            }
        }

        @media(max-width:768px){

            main{
                padding:22px 18px 36px;
            }

            .flash-container{
                padding:0 18px;
            }

            .alert{
                border-radius:18px;
                padding:16px;
            }
        }

    </style>

    @stack('styles')

</head>

<body>

    {{-- BACKGROUND --}}
    <div class="bg-gradient"></div>

    <div class="bg-circle circle-1"></div>
    <div class="bg-circle circle-2"></div>
    <div class="bg-circle circle-3"></div>

    <div class="layout-wrapper">

        {{-- NAVBAR --}}
        @include('partials.navbar')

        <div class="main-wrapper">

            {{-- FLASH MESSAGE --}}
            @if(session('success') || session('error'))

                <div class="flash-container">

                    @if(session('success'))

                        <div class="alert alert-success">

                            <i class="fa-solid fa-circle-check"></i>

                            <span>
                                {{ session('success') }}
                            </span>

                        </div>

                    @endif

                    @if(session('error'))

                        <div class="alert alert-error">

                            <i class="fa-solid fa-circle-xmark"></i>

                            <span>
                                {{ session('error') }}
                            </span>

                        </div>

                    @endif

                </div>

            @endif

            <main>
                @yield('content')
            </main>

            {{-- FOOTER --}}
            @include('partials.footer')

        </div>

    </div>

    {{-- AUTO APPLY SETTINGS --}}
    <script>

        function setCookie(name, value, days) {

            let expires = "";

            if (days) {

                const date = new Date();

                date.setTime(
                    date.getTime()
                    + (days * 24 * 60 * 60 * 1000)
                );

                expires =
                    "; expires=" +
                    date.toUTCString();
            }

            document.cookie =
                name + "=" + value +
                expires +
                "; path=/";
        }

        function getCookie(name) {

            const value =
                "; " + document.cookie;

            const parts =
                value.split("; " + name + "=");

            if (parts.length === 2)

                return parts
                    .pop()
                    .split(";")
                    .shift();
        }

        function applySettings() {

            const theme =
                getCookie('theme_pref')
                || 'light';

            const font =
                getCookie('font_pref')
                || 'medium';

            // RESET
            document.documentElement
                .classList.remove(
                    'dark',
                    'font-small',
                    'font-medium',
                    'font-large'
                );

            // DARK MODE
            if(theme === 'dark') {

                document.documentElement
                    .classList.add('dark');
            }

            // FONT
            document.documentElement
                .classList.add(
                    'font-' + font
                );
        }

        // APPLY LANGSUNG
        applySettings();

        // AUTO LOAD
        document.addEventListener(
            'DOMContentLoaded',
            function () {

                applySettings();
            }
        );
</body>
</html>