<?php $__env->startSection('title', 'Ekstrakurikuler'); ?>

<?php $__env->startSection('header'); ?>
    <a href="#" class="nav-link fs-4 d-none d-lg-block">Data Ekstrakurikuler</a>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <a href="<?php echo e(route('ekstrakurikuler.create')); ?>" class="btn btn-primary mb-3">Tambah Ekstrakurikuler</a>
        <div class="row">
            <div class="col-12 col-lg-4 col-md-5 ">
                <form action="<?php echo e(route('ekstrakurikuler.search')); ?>" method="GET">
                    <div class="input-group mb-3">
                        <input type="search" name="searchEkstra" placeholder="cari nama ekstra..." id="form1"
                            class="form-control bg-white" />
                            <button type="submit" class="btn btn-primary"><i class="ti ti-search"></i></button>                      </div>
                        </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-12 d-flex align-items-stretch ">
                <div class="card w-100">
                    <div class="card-body p-4">
                        <h5 class="card-title fw-semibold mb-4">Data Ekstrakurikuler</h5>
                        <div class="table-responsive">
                            <table class="table text-nowrap mb-0 align-middle">
                                <thead class="text-dark fs-4">
                                    <tr>
                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">Id</h6>
                                        </th>
                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">Nama Ekstrakurikuler</h6>
                                        </th>
                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">Pelatih</h6>
                                        </th>
                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">Detail</h6>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(count($ekstrakurikuler) > 0): ?>
                                        <?php $__currentLoopData = $ekstrakurikuler; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td class="border-bottom-0">
                                                    <p class="mb-0 fw-normal"><?php echo e($k += 1); ?></p>
                                                </td>
                                                <td class="border-bottom-0">
                                                    <p class="mb-0 fw-normal"><?php echo e($v->nama); ?></p>
                                                </td>
                                                <td class="border-bottom-0">
                                                    <p class="mb-0 fw-normal"><?php echo e($v->pelatih->nama); ?></p>
                                                </td>
                                                <td class="border-bottom-0">
                                                    <a href="<?php echo e(route('ekstrakurikuler.edit', $v->id_ekstra)); ?>"
                                                        class="text-muted"><u>
                                                            <p class="mb-0 fw-normal ">Lihat</p>
                                                        </u></a>
                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="5" class="text-center">
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

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\final_projek\ekstra\resources\views/Admin/Ekstrakurikuler/index.blade.php ENDPATH**/ ?>