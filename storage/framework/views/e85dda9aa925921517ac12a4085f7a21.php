<?php $__env->startSection('content'); ?>
<div class="row mt-5">
    <div class="col-lg-6">
      <div class="card text-center ">
        <div class="card-body">
          <h5 class="card-title">Laporan Absen</h5>
          <p class="card-text">
            Untuk Melihat Laporan Absen
          </p>
          <a href="<?php echo e(route('laporanPelatih.absen')); ?>" class="btn btn-primary">Lihat</a>
        </div>
      </div>
    </div>
    <div class="col-lg-6">
      <div class="card text-center">
        <div class="card-body">
          <h5 class="card-title">Laporan Kegiatan</h5>
          <p class="card-text">
            Untuk Melihat Laporan  Kegiatan
          </p>
          <a href="<?php echo e(route('laporanPelatih.kegiatan')); ?>" class="btn btn-primary">Lihat</a>
        </div>
      </div>
    </div>
    </div> 
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\final_projek\ekstra\resources\views/Admin/LaporanPelatih/index.blade.php ENDPATH**/ ?>