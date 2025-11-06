<!doctype html>
<html lang="en">

<head>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- Tailwind CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('css/output.css')); ?>">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('css/navbar.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/input.css')); ?>">

    <!-- Custom JS -->
    <script src="<?php echo e(asset('js/navbar.js')); ?>" defer></script>

    <!-- Laravel Notify -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@mckenziearts/laravel-notify@2.7.0/dist/css/notify.css">
    <script src="https://cdn.jsdelivr.net/npm/@mckenziearts/laravel-notify@2.7.0/dist/js/notify.js"></script>

    <!-- CSRF Token for AJAX -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo $__env->yieldContent('title', config('app.name')); ?></title>

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="<?php echo e(asset('images/Bumdes.jpg')); ?>">
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo e(asset('images/Bumdes.jpg')); ?>">

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

        .loader-wrapper {
            display: flex;
            flex-direction: column;
            align-items: center;
            color: white;
        }

        /* From Uiverse.io by uxRakhal */
        .typewriter {
            --blue: #5cbbff;
            --blue-dark: #162d72;
            --key: #fff;
            --paper: #eef0fd;
            --text: #00000049;
            --tool: #ffbb00;
            --duration: 3s;
            position: relative;
            -webkit-animation: bounce05 var(--duration) linear infinite;
            animation: bounce05 var(--duration) linear infinite;
        }

        .typewriter .slide {
            width: 92px;
            height: 20px;
            border-radius: 3px;
            margin-left: 14px;
            transform: translateX(14px);
            background: linear-gradient(var(--blue), var(--blue-dark));
            -webkit-animation: slide05 var(--duration) ease infinite;
            animation: slide05 var(--duration) ease infinite;
        }

        .typewriter .slide:before,
        .typewriter .slide:after,
        .typewriter .slide i:before {
            content: "";
            position: absolute;
            background: var(--tool);
        }

        .typewriter .slide:before {
            width: 2px;
            height: 8px;
            top: 6px;
            left: 100%;
        }

        .typewriter .slide:after {
            left: 94px;
            top: 3px;
            height: 14px;
            width: 6px;
            border-radius: 3px;
        }

        .typewriter .slide i {
            display: block;
            position: absolute;
            right: 100%;
            width: 6px;
            height: 4px;
            top: 4px;
            background: var(--tool);
        }

        .typewriter .slide i:before {
            right: 100%;
            top: -2px;
            width: 4px;
            border-radius: 2px;
            height: 14px;
        }

        .typewriter .paper {
            position: absolute;
            left: 24px;
            top: -26px;
            width: 40px;
            height: 46px;
            border-radius: 5px;
            background: var(--paper);
            transform: translateY(46px);
            -webkit-animation: paper05 var(--duration) linear infinite;
            animation: paper05 var(--duration) linear infinite;
        }

        .typewriter .paper:before {
            content: "";
            position: absolute;
            left: 6px;
            right: 6px;
            top: 7px;
            border-radius: 2px;
            height: 4px;
            transform: scaleY(0.8);
            background: var(--text);
            box-shadow: 0 12px 0 var(--text), 0 24px 0 var(--text), 0 36px 0 var(--text);
        }

        .typewriter .keyboard {
            width: 120px;
            height: 56px;
            margin-top: -10px;
            z-index: 1;
            position: relative;
        }

        .typewriter .keyboard:before,
        .typewriter .keyboard:after {
            content: "";
            position: absolute;
        }

        .typewriter .keyboard:before {
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            border-radius: 7px;
            background: linear-gradient(135deg, var(--blue), var(--blue-dark));
            transform: perspective(10px) rotateX(2deg);
            transform-origin: 50% 100%;
        }

        .typewriter .keyboard:after {
            left: 2px;
            top: 25px;
            width: 11px;
            height: 4px;
            border-radius: 2px;
            box-shadow: 15px 0 0 var(--key), 30px 0 0 var(--key), 45px 0 0 var(--key), 60px 0 0 var(--key), 75px 0 0 var(--key), 90px 0 0 var(--key), 22px 10px 0 var(--key), 37px 10px 0 var(--key), 52px 10px 0 var(--key), 60px 10px 0 var(--key), 68px 10px 0 var(--key), 83px 10px 0 var(--key);
            -webkit-animation: keyboard05 var(--duration) linear infinite;
            animation: keyboard05 var(--duration) linear infinite;
        }

        @keyframes bounce05 {

            85%,
            92%,
            100% {
                transform: translateY(0);
            }

            89% {
                transform: translateY(-4px);
            }

            95% {
                transform: translateY(2px);
            }
        }

        @keyframes slide05 {
            5% {
                transform: translateX(14px);
            }

            15%,
            30% {
                transform: translateX(6px);
            }

            40%,
            55% {
                transform: translateX(0);
            }

            65%,
            70% {
                transform: translateX(-4px);
            }

            80%,
            89% {
                transform: translateX(-12px);
            }

            100% {
                transform: translateX(14px);
            }
        }

        @keyframes paper05 {
            5% {
                transform: translateY(46px);
            }

            20%,
            30% {
                transform: translateY(34px);
            }

            40%,
            55% {
                transform: translateY(22px);
            }

            65%,
            70% {
                transform: translateY(10px);
            }

            80%,
            85% {
                transform: translateY(0);
            }

            92%,
            100% {
                transform: translateY(46px);
            }
        }

        @keyframes keyboard05 {

            5%,
            12%,
            21%,
            30%,
            39%,
            48%,
            57%,
            66%,
            75%,
            84% {
                box-shadow: 15px 0 0 var(--key), 30px 0 0 var(--key), 45px 0 0 var(--key), 60px 0 0 var(--key), 75px 0 0 var(--key), 90px 0 0 var(--key), 22px 10px 0 var(--key), 37px 10px 0 var(--key), 52px 10px 0 var(--key), 60px 10px 0 var(--key), 68px 10px 0 var(--key), 83px 10px 0 var(--key);
            }

            9% {
                box-shadow: 15px 2px 0 var(--key), 30px 0 0 var(--key), 45px 0 0 var(--key), 60px 0 0 var(--key), 75px 0 0 var(--key), 90px 0 0 var(--key), 22px 10px 0 var(--key), 37px 10px 0 var(--key), 52px 10px 0 var(--key), 60px 10px 0 var(--key), 68px 10px 0 var(--key), 83px 10px 0 var(--key);
            }

            18% {
                box-shadow: 15px 0 0 var(--key), 30px 0 0 var(--key), 45px 0 0 var(--key), 60px 2px 0 var(--key), 75px 0 0 var(--key), 90px 0 0 var(--key), 22px 10px 0 var(--key), 37px 10px 0 var(--key), 52px 10px 0 var(--key), 60px 10px 0 var(--key), 68px 10px 0 var(--key), 83px 10px 0 var(--key);
            }

            27% {
                box-shadow: 15px 0 0 var(--key), 30px 0 0 var(--key), 45px 0 0 var(--key), 60px 0 0 var(--key), 75px 0 0 var(--key), 90px 0 0 var(--key), 22px 12px 0 var(--key), 37px 10px 0 var(--key), 52px 10px 0 var(--key), 60px 10px 0 var(--key), 68px 10px 0 var(--key), 83px 10px 0 var(--key);
            }

            36% {
                box-shadow: 15px 0 0 var(--key), 30px 0 0 var(--key), 45px 0 0 var(--key), 60px 0 0 var(--key), 75px 0 0 var(--key), 90px 0 0 var(--key), 22px 10px 0 var(--key), 37px 10px 0 var(--key), 52px 12px 0 var(--key), 60px 12px 0 var(--key), 68px 12px 0 var(--key), 83px 10px 0 var(--key);
            }

            45% {
                box-shadow: 15px 0 0 var(--key), 30px 0 0 var(--key), 45px 0 0 var(--key), 60px 0 0 var(--key), 75px 0 0 var(--key), 90px 2px 0 var(--key), 22px 10px 0 var(--key), 37px 10px 0 var(--key), 52px 10px 0 var(--key), 60px 10px 0 var(--key), 68px 10px 0 var(--key), 83px 10px 0 var(--key);
            }

            54% {
                box-shadow: 15px 0 0 var(--key), 30px 2px 0 var(--key), 45px 0 0 var(--key), 60px 0 0 var(--key), 75px 0 0 var(--key), 90px 0 0 var(--key), 22px 10px 0 var(--key), 37px 10px 0 var(--key), 52px 10px 0 var(--key), 60px 10px 0 var(--key), 68px 10px 0 var(--key), 83px 10px 0 var(--key);
            }

            63% {
                box-shadow: 15px 0 0 var(--key), 30px 0 0 var(--key), 45px 0 0 var(--key), 60px 0 0 var(--key), 75px 0 0 var(--key), 90px 0 0 var(--key), 22px 10px 0 var(--key), 37px 10px 0 var(--key), 52px 10px 0 var(--key), 60px 10px 0 var(--key), 68px 10px 0 var(--key), 83px 12px 0 var(--key);
            }

            72% {
                box-shadow: 15px 0 0 var(--key), 30px 0 0 var(--key), 45px 2px 0 var(--key), 60px 0 0 var(--key), 75px 0 0 var(--key), 90px 0 0 var(--key), 22px 10px 0 var(--key), 37px 10px 0 var(--key), 52px 10px 0 var(--key), 60px 10px 0 var(--key), 68px 10px 0 var(--key), 83px 10px 0 var(--key);
            }

            81% {
                box-shadow: 15px 0 0 var(--key), 30px 0 0 var(--key), 45px 0 0 var(--key), 60px 0 0 var(--key), 75px 0 0 var(--key), 90px 0 0 var(--key), 22px 10px 0 var(--key), 37px 12px 0 var(--key), 52px 10px 0 var(--key), 60px 10px 0 var(--key), 68px 10px 0 var(--key), 83px 10px 0 var(--key);
            }
        }
    </style>
</head>

<body>
    <!-- === PRELOADER === -->
    <div id="preloader">
        <div class="loader-wrapper">
            <div class="typewriter">
                <div class="slide"><i></i></div>
                <div class="paper"></div>
                <div class="keyboard"></div>
            </div><br>
            <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap" rel="stylesheet">
            <p class="loading-text" id="loadingText" style="font-size: 20px; text-decoration: none; color: #fff; font-family: 'Poppins', sans-serif;"></p>

            <script>
                const text = "Sebentar Yaa...";
                const loadingText = document.getElementById('loadingText');
                let index = 0;

                function typeText() {
                    if (index < text.length) {
                        loadingText.textContent += text.charAt(index);
                        index++;
                        setTimeout(typeText, 100);
                    }
                }
                typeText();
            </script>
        </div>
    </div>

    <header>
        
        <?php echo $__env->make('layouts.navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    </header>

    <main>
        
        <?php echo $__env->yieldContent('content'); ?>

        
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

    <footer class="mt-5">
        
        <?php echo $__env->make('layouts.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    </footer>

    <!-- Bootstrap Bundle + Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    <!-- Swiper -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="<?php echo e(asset('js/swiper.js')); ?>"></script>

    <!-- === PRELOADER HIDE === -->
    <script>
        window.addEventListener('load', () => {
            const preloader = document.getElementById('preloader');
            setTimeout(() => {
                preloader.classList.add('hide');
            }, 500);
        });
    </script>
</body>

</html>
<?php /**PATH C:\laragon\www\belajar_laravel\resources\views/layouts/master.blade.php ENDPATH**/ ?>