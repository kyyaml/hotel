<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Ekstrakurikuler</title>
  <link rel="shortcut icon" type="image/png" href="<?php echo e(asset('assets/admin/images/logos/fav.png')); ?>" />
  <link rel="stylesheet" href="<?php echo e(asset('assets/admin/css/styles.min.css')); ?>"" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

</head>

<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <div
      class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
      <div class="d-flex align-items-center justify-content-center w-100">
        <div class="row justify-content-center w-100">
          <div class="col-md-8 col-lg-6 col-xxl-3">
            <div class="card mb-0">
              <div class="card-body">
                <a href="#" class="text-nowrap logo-img text-center d-block py-3 w-100">
                  <img src="<?php echo e(asset('assets/admin/images/logos/mainlogo.png')); ?>" width="250" alt="">
                </a>
                <p class="text-center">Login Admin</p>

                <?php if(session('pesan')): ?>
                <div class="alert alert-danger" role="alert">
                  <?php echo e(session('pesan')); ?>

                </div>
              <?php endif; ?>

                <form action="<?php echo e(route('admin.login')); ?>" method="POST">
                    <?php echo csrf_field(); ?>

                  <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Username</label>
                    <input type="text"  class="form-control" name="username" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                  </div>
                  <div class="mb-4">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <div class="input-group">
                        <input type="password" name="password" class="form-control" id="exampleInputPassword1">
                        <button class="btn btn-outline-primary" type="button" id="togglePassword">
                            <i class="bi bi-eye"></i>
                        </button>
                    </div>
                </div>
                  
                  <button class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2">Sign In</button>
                  
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="<?php echo e(asset('assets/admin/libs/jquery/dist/jquery.min.js')); ?>"></script>
  <script src="<?php echo e(asset('assets/admin/libs/bootstrap/dist/js/bootstrap.bundle.min.js')); ?>"></script>
  <script src="<?php echo e(asset('assets/admin/js/app.min.js')); ?>"></script>
</body>

</html><?php /**PATH D:\final_projek\ekstra\resources\views/Admin/login.blade.php ENDPATH**/ ?>