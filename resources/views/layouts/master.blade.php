<!doctype html>
<html lang="en">

<head>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Custom CSS -->
    @stack('styles')

    <!-- Custom JS -->

    <!-- Laravel Notify -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@mckenziearts/laravel-notify@2.7.0/dist/css/notify.css"
        crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@mckenziearts/laravel-notify@2.7.0/dist/js/notify.js" crossorigin="anonymous">
    </script>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- CSRF Token AJAX -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name'))</title>

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('images/Bumdes.jpg') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/Bumdes.jpg') }}">

    <style>
        /* === PRELOADER STYLE === */
        #preloader {
            position: fixed;
            inset: 0;
            background: linear-gradient(135deg, #198754, #146c43);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 2000;
            transition: opacity 0.6s ease, visibility 0.6s ease;
        }

        #preloader.hide {
            opacity: 0;
            visibility: hidden;
        }

        /* From Uiverse.io by Chriskoziol */
        .spinnerContainer {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .spinner {
            width: 56px;
            height: 56px;
            display: grid;
            border: 4px solid #0000;
            border-radius: 50%;
            border-right-color: #ffffff;
            animation: tri-spinner 1s infinite linear;
        }

        .spinner::before,
        .spinner::after {
            content: "";
            grid-area: 1/1;
            margin: 2px;
            border: inherit;
            border-radius: 50%;
            animation: tri-spinner 2s infinite;
        }

        .spinner::after {
            margin: 8px;
            animation-duration: 3s;
        }

        @keyframes tri-spinner {
            100% {
                transform: rotate(1turn);
            }
        }

        .loader {
            color: #ffffff;
            font-family: "Poppins", sans-serif;
            font-weight: 500;
            font-size: 25px;
            -webkit-box-sizing: content-box;
            box-sizing: content-box;
            height: 40px;
            padding: 10px 10px;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            border-radius: 8px;
        }

        .words {
            overflow: hidden;
        }

        .word {
            display: block;
            height: 100%;
            padding-left: 6px;
            color: #eadb12;
            animation: cycle-words 5s infinite;
        }

        @keyframes cycle-words {
            10% {
                -webkit-transform: translateY(-105%);
                transform: translateY(-105%);
            }

            25% {
                -webkit-transform: translateY(-100%);
                transform: translateY(-100%);
            }

            35% {
                -webkit-transform: translateY(-205%);
                transform: translateY(-205%);
            }

            50% {
                -webkit-transform: translateY(-200%);
                transform: translateY(-200%);
            }

            60% {
                -webkit-transform: translateY(-305%);
                transform: translateY(-305%);
            }

            75% {
                -webkit-transform: translateY(-300%);
                transform: translateY(-300%);
            }

            85% {
                -webkit-transform: translateY(-405%);
                transform: translateY(-405%);
            }

            100% {
                -webkit-transform: translateY(-400%);
                transform: translateY(-400%);
            }
        }
    </style>
</head>

<body>
    <!-- === PRELOADER === -->
    <div id="preloader">
        <div class="spinnerContainer">
            <div class="spinner"></div>
            <div class="loader">
                <p>loading</p>
                <div class="words">
                    <span class="word">Pertanian</span>
                    <span class="word">Perikanan</span>
                    <span class="word">Pekembangan</span>
                    <span class="word">Pemberdayaan</span>
                    <span class="word">Edukasi</span>
                </div>
            </div>
        </div>
    </div>

    <header>
        {{-- NAVBAR --}}
        @include('layouts.navbar')
    </header>

    <main>
        {{-- KONTEN --}}
        @yield('content')

        {{-- CS Agent --}}
        <script>
            (function() {
                if (!window.chatbase || window.chatbase("getState") !== "initialized") {
                    window.chatbase = (...arguments) => {
                        if (!window.chatbase.q) {
                            window.chatbase.q = []
                        }
                        window.chatbase.q.push(arguments)
                    };
                    window.chatbase = new Proxy(window.chatbase, {
                        get(target, prop) {
                            if (prop === "q") {
                                return target.q
                            }
                            return (...args) => target(prop, ...args)
                        }
                    })
                }
                const onLoad = function() {
                    const script = document.createElement("script");
                    script.src = "https://www.chatbase.co/embed.min.js";
                    script.id = "0Yy1iZHTpDg7yNPU9LiJ6";
                    script.domain = "www.chatbase.co";
                    document.body.appendChild(script)
                };
                if (document.readyState === "complete") {
                    onLoad()
                } else {
                    window.addEventListener("load", onLoad)
                }
            })();
        </script>
    </main>

    <!-- === NIKMATI IMAGE SECTION ABOVE FOOTER === -->
    <section class="nikmati-image-section">
        <div class="container-fluid p-0">
            <img src="{{ asset('images/NIKMATI.png') }}" alt="NIKMATI" class="img-fluid w-100">
        </div>
    </section>

    <footer>
        {{-- FOOTER --}}
        @include('layouts.footer')
    </footer>

    <!-- Bootstrap Bundle + Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    <!-- Swiper -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="{{ asset('js/swiper.js') }}"></script>

    <!-- === PRELOADER HIDE === -->
    <script>
        window.addEventListener('load', () => {
            const preloader = document.getElementById('preloader');
            setTimeout(() => {
                preloader.classList.add('hide');
            }, 500);
        });
    </script>

    <!-- OneSignal Initialization -->
    <script src="https://cdn.onesignal.com/sdks/web/v16/OneSignalSDK.page.js" defer></script>
    {{-- <script>
        window.OneSignalDeferred = window.OneSignalDeferred || [];
        OneSignalDeferred.push(async function(OneSignal) {
            await OneSignal.init({
                appId: "be91d72a-0e8e-4eaa-800d-92ad1bc1c776",
            });
        });
    </script> --}}
    <script>
if ("serviceWorker" in navigator) {
    navigator.serviceWorker.register("/service-worker.js")
        .then(() => console.log("Service worker registered"));
}
</script>
<button id="subscribe">Aktifkan Notifikasi</button>

<script>
document.getElementById('subscribe').addEventListener('click', async () => {
    const permission = await Notification.requestPermission();
    if (permission !== "granted") {
        alert("Izinkan notifikasi dulu");
        return;
    }

    const reg = await navigator.serviceWorker.ready;

    const sub = await reg.pushManager.subscribe({
        userVisibleOnly: true,
applicationServerKey: "{{ config('webpush.vapid.public_key') }}"
    });

    // simpan ke server
    await fetch("/save-subscription", {
        method: "POST",
        body: JSON.stringify(sub),
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": "{{ csrf_token() }}"
        }
    });

    alert("Notifikasi browser berhasil diaktifkan!");
});
</script>



    @stack('scripts')
</body>

</html>
