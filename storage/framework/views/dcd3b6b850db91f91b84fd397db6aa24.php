<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        
        <?php if(isset($start) && isset($end)): ?>
            <a href="<?php echo e(route('laporanPelatih.exportAbsen', ['id_ekstra' => $id_ekstra, 'start' => $start, 'end' => $end])); ?>"
                class="btn btn-success mb-3"><img
                    src="https://upload.wikimedia.org/wikipedia/commons/3/34/Microsoft_Office_Excel_%282019%E2%80%93present%29.svg"
                    alt="" width="25" height="25" /><br />
                Cetak Excel</a>
        <?php endif; ?>
        <div class="row">
            <div class="col-12 col-lg-6 col-md-6 mb-3">
                <form action="<?php echo e(route('laporanPelatih.cariAbsen')); ?>" method="GET">
                    <div class="input-daterange input-group" id="date-range">
                        <input type="hidden" name="id_ekstra" value="<?php echo e($id_ekstra); ?>">
                        <input type="date" class="form-control bg-white" name="start"
                            value="<?php echo e(isset($start) ? $start : ''); ?>" />
                        <span class="input-group-text bg-primary b-0 text-white">TO</span>
                        <input type="date" class="form-control bg-white" name="end"
                            value="<?php echo e(isset($end) ? $end : ''); ?>" />
                        <button type="submit" class="btn btn-primary">Cari</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-12 d-flex align-items-stretch">
                <div class="card w-100">
                    <div class="card-body p-4">
                        <h5 class="card-title fw-semibold mb-4">Data Absen</h5>
                        <div class="table-responsive">
                            <table class="table text-nowrap mb-0 align-middle">
                                <thead class="text-dark fs-4">
                                    <tr>
                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">No</h6>
                                        </th>
                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">Nama</h6>
                                        </th>
                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">Jumlah Hadir</h6>
                                        </th>
                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">Jumlah Pertemuan</h6>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(isset($siswa) && isset($jumlahKehadiran) && isset($jumlahPertemuan)): ?>
                                        <?php $__empty_1 = true; $__currentLoopData = $siswa; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                            <tr>
                                                <td class="border-bottom-0">
                                                    <p class="mb-0 fw-normal"><?php echo e($index + 1); ?></p>
                                                </td>
                                                <td class="border-bottom-0">
                                                    <p class="mb-0 fw-normal"><?php echo e($student->nama); ?></p>
                                                </td>
                                                <td class="border-bottom-0">
                                                    <p class="mb-0 fw-normal">
                                                        <?php echo e(isset($jumlahKehadiran[$student->nama]) ? $jumlahKehadiran[$student->nama] : 0); ?>

                                                    </p>
                                                </td>
                                                <td class="border-bottom-0">
                                                    <p class="mb-0 fw-normal"><?php echo e($jumlahPertemuan); ?></p>
                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                            <tr>
                                                <td colspan="4" class="text-center">Tidak ada Absen ditemukan</td>
                                            </tr>
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="4" class="text-center">Silakan cari data Absen sesuai
                                                tanggal</td>
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

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\final_projek\ekstra\resources\views/Admin/LaporanPelatih/laporanAbsen.blade.php ENDPATH**/ ?>