<?php $__env->startSection('header'); ?>
    <a href="#" class="nav-link fs-4 d-none d-lg-block">Dashboard</a>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>

=
        <div class="row">


        <div class="col-12 col-md-6 col-lg-4">
            <div class="owl-item active" ">
                <div class="item">
                    <div class="card border-0 zoom-in bg-primary-subtle shadow-none">
                        <div class="card-body">
                            <div class="text-center">
                                <img src="<?php echo e(asset('assets/admin/images/logos/coachlogo.png')); ?>" width="50"
                                    height="50" class="mb-3" alt="">
                                <p class="fw-semibold fs-3 text-info mb-1">Pelatih</p>
                                <h5 class="fw-semibold text-info mb-0"><?php echo e($pelatih); ?></h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-4">
            <div class="owl-item active" >
                <div class="item">
                    <div class="card border-0 zoom-in bg-primary-subtle shadow-none">
                        <div class="card-body">
                            <div class="text-center">
                                <img src="<?php echo e(asset('assets/admin/images/logos/extralogo.png')); ?>" width="50"
                                    height="50" class="mb-3" alt="">
                                <p class="fw-semibold fs-3 text-primary mb-1">Ekstra</p>
                                <h5 class="fw-semibold text-primary mb-0"><?php echo e($ekstrakurikuler); ?></h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-4">
            <div class="owl-item active">
                <div class="item">
                    <div class="card border-0 zoom-in bg-primary-subtle shadow-none">
                        <div class="card-body">
                            <div class="text-center">
                                <img src="<?php echo e(asset('assets/admin/images/logos/siswalogo.png')); ?>" width="50"
                                    height="50" class="mb-3" alt="">
                                <p class="fw-semibold fs-3 text-primary mb-1">Siswa</p>
                                <h5 class="fw-semibold text-primary mb-0"><?php echo e($siswa); ?></h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\final_projek\ekstra\resources\views/Admin/DashboardKesiswaan/index.blade.php ENDPATH**/ ?>