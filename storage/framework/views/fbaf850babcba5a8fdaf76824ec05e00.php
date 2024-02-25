<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ekstrakurikuler</title>
    <?php echo $__env->yieldContent('css'); ?>
    <link rel="shortcut icon" type="image/png" href="<?php echo e(asset('assets/admin/images/logos/fav.png')); ?>" />


    <link rel="stylesheet" href="<?php echo e(asset('assets/admin/css/styles.min.css')); ?>" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@2.47.0/tabler-icons.min.css">
</head>

<body class="bg-light">
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <!-- Sidebar Start -->
        <aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div>
                <div class="brand-logo d-flex align-items-center justify-content-between border-bottom">
                    <a href="#" class="text-nowrap logo-img">
                        <img src="<?php echo e(asset('assets/admin/images/logos/mainlogo.png')); ?>" width="180" alt="">
                    </a>
                    <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                        <i class="ti ti-x fs-8"></i>
                    </div>
                </div>
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
                    <ul id="sidebarnav">
                        


                        <?php if(Auth::guard('admin')->check()): ?>
                            
                            <?php if(Auth::guard('admin')->user()->role == 'kesiswaan'): ?>
                                <li class="sidebar-item mt-2">
                                    <a class="sidebar-link" href="<?php echo e(route('dashboard.kesiswaan')); ?>"
                                        aria-expanded="false">
                                        <span>
                                            <i class="ti ti-layout-dashboard"></i>
                                        </span>
                                        <span class="hide-menu">Dashboard</span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a class="sidebar-link" href="<?php echo e(route('pelatih.index')); ?>" aria-expanded="false">
                                        <span>
                                            <i class="ti ti-command"></i>
                                        </span>
                                        <span class="hide-menu">Pelatih</span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a class="sidebar-link" href="<?php echo e(route('ekstrakurikuler.index')); ?>"
                                        aria-expanded="false">
                                        <span>
                                            <i class="ti ti-apps-filled"></i>
                                        </span>
                                        <span class="hide-menu">Ekstrakurikuler</span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a class="sidebar-link" href="<?php echo e(route('member-ekstra.index')); ?>"
                                        aria-expanded="false">
                                        <span>
                                            <i class="ti ti-users-group"></i>
                                        </span>
                                        <span class="hide-menu">Member Ekstrakurikuler</span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a class="sidebar-link" href="<?php echo e(route('siswa.index')); ?>" aria-expanded="false">
                                        <span>
                                            <i class="ti ti-user-circle"></i>
                                        </span>
                                        <span class="hide-menu">Siswa</span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a class="sidebar-link" href="<?php echo e(route('laporan.index')); ?>" aria-expanded="false">
                                        <span>
                                            <i class="ti ti-report-analytics"></i>
                                        </span>
                                        <span class="hide-menu">Laporan</span>
                                    </a>
                                </li>
                            <?php else: ?>
                                <li class="sidebar-item mt-2">
                                    <a class="sidebar-link" href="<?php echo e(route('dashboard.pelatih')); ?>"
                                        aria-expanded="false">
                                        <span>
                                            <i class="ti ti-layout-dashboard"></i>
                                        </span>
                                        <span class="hide-menu">Dashboard</span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a class="sidebar-link" href="<?php echo e(route('anggota.index')); ?>" aria-expanded="false">
                                        <span>
                                            <i class="ti ti-users-group"></i>
                                        </span>
                                        <span class="hide-menu">Member Ekstrakurikuler</span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a class="sidebar-link" href="<?php echo e(route('pertemuan.index')); ?>"
                                        aria-expanded="false">
                                        <span>
                                            <i class="ti ti-replace-filled"></i>
                                        </span>
                                        <span class="hide-menu">Pertemuan</span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a class="sidebar-link" href="<?php echo e(route('absensi.index')); ?>" aria-expanded="false">
                                        <span>
                                            <i class="ti ti-browser-check   "></i>
                                        </span>
                                        <span class="hide-menu">Data Kehadiran</span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a class="sidebar-link" href="<?php echo e(route('validasi.index')); ?>"
                                        aria-expanded="false">
                                        <span>
                                            <i class="ti ti-copy-check"></i>
                                        </span>
                                        <span class="hide-menu">Validasi Absen</span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a class="sidebar-link" href="<?php echo e(route('laporanPelatih.index')); ?>"
                                        aria-expanded="false">
                                        <span>
                                            <i class="ti ti-report-analytics"></i>
                                        </span>
                                        <span class="hide-menu">Laporan</span>
                                    </a>
                                </li>
                            <?php endif; ?>
                        <?php endif; ?>

                        
                        
                        
                    </ul>

                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <!--  Sidebar End -->
        <!--  Main wrapper -->
        <div class="body-wrapper">
            <!--  Header Start -->
            <header class="app-header">
                <nav class="navbar navbar-expand-lg navbar-light border-bottom">
                    <ul class="navbar-nav">
                        <li class="nav-item d-block d-xl-none">
                            <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse"
                                href="javascript:void(0)">
                                <i class="ti ti-menu-2"></i>
                            </a>
                        </li>
                    </ul>


                    <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
                        <?php echo $__env->yieldContent('header'); ?>

                        <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
                            

                            <li class="nav-item dropdown">
                                <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <img src="<?php echo e(asset('assets/admin/images/profile/user-1.jpg')); ?>" alt=""
                                        width="35" height="35" class="rounded-circle">
                                </a>
                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up"
                                    aria-labelledby="drop2">
                                    <div class="message-body">
                                        <a href="javascript:void(0)"
                                            class="d-flex align-items-center gap-2 dropdown-item">
                                            <i class="ti ti-user fs-6"></i>
                                            <p class="mb-0 fs-3"> <?php echo e(Auth::guard('admin')->user()->username); ?></p>
                                        </a>

                                        <a href="<?php echo e(route('admin.logout')); ?>"
                                            class="btn btn-outline-primary mx-3 mt-2 d-block">Logout</a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>
            <!--  Header End -->
            <div class="container-fluid ">
                <?php echo $__env->yieldContent('content'); ?>

            </div>
        </div>
    </div>
    <?php echo $__env->yieldContent('js'); ?>
    <script>
        $(document).ready(function() {
            $('#file_export').DataTable();
        });
    </script>
    <script src="<?php echo e(asset('assets/admin/libs/jquery/dist/jquery.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/admin/libs/bootstrap/dist/js/bootstrap.bundle.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/admin/js/sidebarmenu.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/admin/js/app.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/admin/libs/apexcharts/dist/apexcharts.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/admin/libs/simplebar/dist/simplebar.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/admin/js/dashboard.js')); ?>"></script>
    
</body>

</html>
<?php /**PATH D:\final_projek\ekstra\resources\views/layouts/admin.blade.php ENDPATH**/ ?>