<?php $__env->startSection('content'); ?>
    <div class="container mt-3">
        <h1>selamat Datang di Halaman About</h1>
        <div class="card">
            <div class="card-body">
               <?php echo e($nama); ?>

                <br>
                <?php echo e($email); ?>

                <br>
                <?php echo e($alamat); ?>

                <br>
                <?php echo e($pekerjaan); ?>

                <br>
                <?php echo e($umur); ?>

                <br>
                <?php echo e($hobi); ?>

            </div>
        </div>

    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\belajar_laravel\resources\views/pages/about.blade.php ENDPATH**/ ?>