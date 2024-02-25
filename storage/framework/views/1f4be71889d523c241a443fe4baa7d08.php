<?php $__env->startSection('title', 'Ekstrakurikuler'); ?>

<?php $__env->startSection('header'); ?>
    <a href="#" class="nav-link fs-4 d-none d-lg-block">Validasi Absen Siswa</a>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid ">

        <div class="row">
            <div class="col-12 col-lg-4 col-md-5">
                <form action="<?php echo e(route('validasiAbsen', $id_pertemuan)); ?>" method="GET">
                    <div class="input-group mb-3">
                        <input type="search" name="search" placeholder="Cari nama siswa..." id="search"
                            class="form-control bg-white" />
                        <button type="submit" class="btn btn-primary"><i class="ti ti-search"></i></button>
                    </div>
                </form>
            </div>
        </div>


        <?php if(session('success')): ?>
            <div class="row">
                <div class="col-12 col-lg-6">
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?php echo e(session('success')); ?>

                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <div class="row">
            <div class="col-12 d-flex align-items-stretch ">
                <div class="card w-100 ">
                    <div class="card-body p-4">
                        <div class=" d-flex justify-content-between align-items-center ">
                            <h5 class="card-title fw-semibold mb-4 ">Validasi Absen</h5>
                            <?php if(count($presensi) > 0): ?>
                            <form action="<?php echo e(route('validasi.terimaSemua', $id_pertemuan)); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                <button id="acceptAll" type="submit" class="btn btn-success mb-2 me-2">Terima Semua</button>
                            </form>
                            <?php endif; ?>
                        </div>
                        
                        <div class="table-responsive">
                            <table class="table text-nowrap mb-0 align-middle">
                                <thead class="text-dark fs-4">
                                    <tr>
                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">Id</h6>
                                        </th>
                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">NIS</h6>
                                        </th>
                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">Nama</h6>
                                        </th>
                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">Waktu Absen</h6>
                                        </th>
                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">Keterangan</h6>
                                        </th>
                                        <th colspan="2" class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">Validasi</h6>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(count($presensi) > 0): ?>
                                        <?php $__currentLoopData = $presensi; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td class="border-bottom-0">
                                                    <p class="mb-0 fw-normal"><?php echo e($k += 1); ?></p>
                                                </td>
                                                <td class="border-bottom-0">
                                                    <p class="mb-0 fw-normal"><?php echo e($v->nis); ?></p>
                                                </td>
                                                <td class="border-bottom-0">
                                                    <p class="mb-0 fw-normal"> <?php echo e($v->siswa->nama); ?></p>
                                                </td>

                                                <td class="border-bottom-0">
                                                    <p class="mb-0 fw-normal"><?php echo e($v->formatTime()['time']); ?></p>
                                                </td>
                                                <td class="border-bottom-0">
                                                    <p class="mb-0 fw-normal"><?php echo e($v->keterangan); ?></p>
                                                </td>
                                                <td class="border-bottom-0" style="display:flex ">
                                                    <form action="<?php echo e(route('validasi.terima', $v->id_absen)); ?>"
                                                        method="POST">
                                                        <?php echo csrf_field(); ?>
                                                        <?php echo method_field('PUT'); ?>
                                                        <button type="submit" class="btn btn-success ">Terima</button>
                                                    </form>
                                                    <form action="<?php echo e(route('validasi.tolak', $v->id_absen)); ?>"
                                                        method="POST">
                                                        <?php echo csrf_field(); ?>
                                                        <?php echo method_field('PUT'); ?>
                                                        <button type="submit"
                                                            onclick="return confirm('Apakah Anda yakin ingin menolak?')"
                                                            class="btn btn-danger mx-2">Tolak</button>
                                                    </form>
                                                </td>

                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="6" class="text-center">
                                                <p class="mb-0 fw-normal ">Tidak Ada Data</p>
                                            </td>
                                        </tr>
                                    <?php endif; ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\final_projek\ekstra\resources\views/Admin/Validasi/validasi.blade.php ENDPATH**/ ?>