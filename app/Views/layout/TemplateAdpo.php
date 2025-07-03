<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="shortcut icon" type="image/icon" href="<?= base_url('assets/gambar/logoweb1.png') ?>" />
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>ObatNih</title>

    <!-- Fontfaces CSS-->
    <link rel="stylesheet" href="<?= base_url('/assets/css/fontawesome v6/css/all.min.css') ?>">

    <!-- Bootstrap CSS-->
    <link href="<?= base_url('/assets/css/css2/bootstrap.min.css') ?>" rel="stylesheet" media="all">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Main CSS-->
    <link href="<?= base_url('/assets/css/theme.css') ?>" rel="stylesheet" media="all">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


</head>

<body class="animsition">
    <div class="page-wrapper">
        <!-- HEADER MOBILE-->
        <header class="header-mobile d-block d-lg-none">
            <div class="header-mobile__bar">
                <div class="container-fluid">
                    <div class="header-mobile-inner">
                        <a class="" href="#">
                        </a>
                        <button class="hamburger hamburger--slider" type="button">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>

        </header>
        <!-- END HEADER MOBILE-->

        <!-- MENU SIDEBAR-->
        <aside class="menu-sidebar d-none d-lg-block">
            <div class="logo">
                <a href="#">
                    <h1 class="user" style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">Admin</h1>
                </a>
            </div>
            <div class="menu-sidebar__content js-scrollbar1">
                <nav class="navbar-sidebar">
                    <ul class="list-unstyled navbar__list">
                        <li>
                            <a class="js-arrow" href="<?= base_url('admin/dashboard') ?>">
                                <i class="fas fa-home"></i>Beranda<i style="margin-left: 100px;"></i></a>
                        </li>
                        <li>
                            <a href="<?= base_url('admin/dataobat') ?>">
                                <i class="fas fa-pills"></i> Data Obat
                            </a>
                        </li>
                        <li>
                            <a href="<?= base_url('admin/laporanpenjualan') ?>">
                                <i class="fas fa-file-invoice-dollar"></i> Laporan Penjualan
                            </a>
                        </li>
                        <li>
                            <a href="<?= base_url('admin/tambahstaff') ?>">
                                <i class="fas fa-users"></i> Data Staff
                            </a>
                        </li>
                        <li>
                            <a href="#" class="logout-link" onclick="confirmLogout(event)">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </a>

                        </li>


                    </ul>
                    <hr class="custom-hr">
                </nav>
            </div>
        </aside>
        <!-- END MENU SIDEBAR-->

        <!-- PAGE CONTAINER-->
        <div class="page-container">
            <!-- HEADER DESKTOP-->
            <header class="header-desktop">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="header-wrap">
                            <h1 style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">ObatNih</h1>

                        </div>
                    </div>
                </div>
            </header>
            <!-- HEADER DESKTOP-->


            <?= $this->renderSection('content'); ?>
            <?= $this->renderSection('style'); ?>

            <!-- Jquery JS-->
            <script src="vendor/jquery-3.2.1.min.js"></script>
            <!-- Bootstrap JS-->
            <script src="vendor/bootstrap-4.1/popper.min.js"></script>
            <script src="vendor/bootstrap-4.1/bootstrap.min.js"></script>
            <!-- Vendor JS       -->
            <script src="vendor/slick/slick.min.js">
            </script>
            <script src="vendor/wow/wow.min.js"></script>
            <script src="vendor/animsition/animsition.min.js"></script>
            <script src="vendor/bootstrap-progressbar/bootstrap-progressbar.min.js">
            </script>
            <script src="vendor/counter-up/jquery.waypoints.min.js"></script>
            <script src="vendor/counter-up/jquery.counterup.min.js">
            </script>
            <script src="vendor/circle-progress/circle-progress.min.js"></script>
            <script src="vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
            <script src="vendor/chartjs/Chart.bundle.min.js"></script>
            <script src="vendor/select2/select2.min.js">
            </script>

            <!-- Main JS-->
            <script src="<?= base_url('assets/js/script.js') ?>"></script>
            <!-- DataTables CSS & JS -->
            <link rel="stylesheet" href="https://cdn.datatables.net/2.3.1/css/dataTables.dataTables.min.css">
            <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
            <script src="https://cdn.datatables.net/2.3.1/js/dataTables.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


            <!-- Inisialisasi DataTables -->
            <script>
                $(document).ready(function() {
                    $('#tableObat').DataTable();
                    $('#tableStaff').DataTable();
                    $('#tableLaporan').DataTable();
                });

                function confirmLogout(event) {
                    event.preventDefault(); // Cegah link langsung dijalankan

                    Swal.fire({
                        title: 'Konfirmasi Logout',
                        text: 'Apakah Anda yakin ingin logout?',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Ya, Logout',
                        cancelButtonText: 'Batal',
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = "<?= base_url('login') ?>"; // Ganti dengan route logout sesungguhnya jika ada
                        }
                    });
                }

                function confirmHapus(event) {
                    event.preventDefault(); // Cegah link langsung dijalankan

                    Swal.fire({
                        title: 'Konfirmasi Hapus',
                        text: 'Apakah Anda yakin Hapus?',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Ya, Hapus',
                        cancelButtonText: 'Batal',
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = "<?= base_url('dataobat') ?>"; // Ganti dengan route logout sesungguhnya jika ada
                        }
                    });
                }
            </script>

</body>

</html>
<!-- end document-->