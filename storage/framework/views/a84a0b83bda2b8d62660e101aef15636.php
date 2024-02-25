<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="row">
            <?php $__currentLoopData = $ekstrakurikuler; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-12 col-md-6 col-lg-4 ">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title fw-semibold  ">Ekstrakurikuler</h4>
                            <h4 class="fw-semibold card-subtitle mb-3  "><?php echo e($v->nama); ?></h4>
                            <p class="card-text">Dibuat Pada : <?php echo e($v->created_at->format('d-M-y')); ?></p>
                            <a href="<?php echo e(route('member-ekstra.showMember', $v->id_ekstra)); ?>" class="btn btn-warning"> View Member</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\final_projek\ekstra\resources\views/Admin/MemberEkstra/index.blade.php ENDPATH**/ ?>