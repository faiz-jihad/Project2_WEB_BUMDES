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

    <title><?php echo $__env->yieldContent('title', config('app.name')); ?></title>

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

        .spinner {
            width: 65px;
            height: 65px;
            border: 5px solid rgba(255, 255, 255, 0.3);
            border-top-color: #ffc107;
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin-bottom: 15px;
        }

        .loading-text {
            font-size: 1rem;
            font-weight: 600;
            letter-spacing: 0.5px;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }
    </style>
</head>

<body>
    <!-- === PRELOADER === -->
    <div id="preloader">
        <div class="loader-wrapper">
            <div class="spinner"></div>
            <p class="loading-text">Memuat halaman...</p>
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