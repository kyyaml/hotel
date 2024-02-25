<?php $__env->startSection('header'); ?>
    <a href="#" class="nav-link fs-4 d-none d-lg-block">Dashboard</a>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
    <div class="row">


        <div class="col-12 col-md-6 col-lg-4">
            <div class="owl-item active">
                <div class="item">
                    <div
                        class="card border-0 zoom-in <?php echo e($validasi === 0 ? 'bg-success-subtle' : 'bg-danger-subtle'); ?> shadow-none">
                        <div class="card-body">
                            <div class="text-center">
                                <?php if($validasi !== 0): ?>
                                    <img src="https://cdn-icons-png.flaticon.com/512/5442/5442020.png" width="50"
                                        height="50" class="mb-3" alt="">
                                    <p class="fw-semibold fs-3 text-danger mb-1">Presensi Belum Tervalidasi</p>
                                    <h5 class="fw-semibold text-danger mb-0"><?php echo e($validasi); ?></h5>
                                <?php endif; ?>
                                <?php if($validasi === 0): ?>
                                    <img src="https://cdn-icons-png.flaticon.com/512/8215/8215539.png" width="50"
                                        height="50" class="mb-3" alt="">
                                    <p class="fw-semibold fs-3 text-secondary    mb-4">Semua Presensi Tervalidasi</p>
                                <?php endif; ?>
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
                                <img src="<?php echo e(asset('assets/admin/images/logos/pertemuan.svg')); ?>" width="50"
                            height="50" class="mb-3" alt="">
                        
                                <p class="fw-semibold fs-3 text-primary mb-1">Pertemuan</p>
                                <h5 class="fw-semibold text-primary mb-0"><?php echo e($pertemuan); ?></h5>
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
                                <img src="https://cdn-icons-png.flaticon.com/512/143/143438.png" width="50"
                                    height="50" class="mb-3" alt="">
                                <p class="fw-semibold fs-3 text-primary mb-1">Anggota</p>
                                <h5 class="fw-semibold text-primary mb-0"><?php echo e($member); ?></h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\final_projek\ekstra\resources\views/Admin/DashboardPelatih/index.blade.php ENDPATH**/ ?>