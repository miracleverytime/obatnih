<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <title>ObatNih</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="<?= base_url('assets/gambar/logoweb1.png') ?>" type="image/icon">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url('/assets/css/fontawesome v6/css/all.min.css') ?>">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?= base_url('/assets/css/css2/bootstrap.min.css') ?>" media="all">

    <!-- Main Theme CSS -->
    <link rel="stylesheet" href="<?= base_url('/assets/css/theme.css') ?>" media="all">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="animsition">
    <div class="page-wrapper">

        <!-- HEADER MOBILE -->
        <header class="header-mobile d-block d-lg-none">
            <div class="header-mobile__bar">
                <div class="container-fluid">
                    <div class="header-mobile-inner">
                        <button class="hamburger hamburger--slider" type="button">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
        </header>
        <!-- END HEADER MOBILE -->

        <!-- MENU SIDEBAR -->
        <aside class="menu-sidebar d-none d-lg-block">
            <div class="logo text-center">
                <h1 class="user" style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">Apoteker</h1>
            </div>
            <div class="menu-sidebar__content js-scrollbar1">
                <nav class="navbar-sidebar">
                    <ul class="list-unstyled navbar__list">
                        <li>
                            <a href="<?= base_url('apoteker/dashboard') ?>">
                                <i class="fas fa-clipboard-check"></i> Konfirmasi Pembelian
                            </a>
                        </li>
                        <li>
                            <a href="<?= base_url('apoteker/bantuan') ?>">
                                <i class="fas fa-circle-question"></i> Bantuan
                            </a>
                        </li>
                        <li>
                            <a href="<?= base_url('apoteker/logout') ?>" onclick="logout(event)">
                                <i class="fas fa-arrow-right-from-bracket"></i> Logout
                            </a>
                        </li>
                       
                    </ul>
                    <hr class="custom-hr">
                </nav>
            </div>
        </aside>
        <!-- END MENU SIDEBAR -->

        <!-- PAGE CONTAINER -->
        <div class="page-container">

            <!-- HEADER DESKTOP -->
            <header class="header-desktop">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="header-wrap">
                            <h1 style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">ObatNih</h1>
                        </div>
                    </div>
                </div>
            </header>
            <!-- END HEADER DESKTOP -->

<?= $this->renderSection('content'); ?>


            <!-- FOOTER -->
            <footer>
                <div class="containerr text-center py-3">
                    <small>&copy; <?= date('Y') ?> ObatNih — Kelompok 4</small>
                </div>
            </footer>

        </div>
        <!-- END PAGE CONTAINER -->

    </div>

    <!-- Bootstrap Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Main JS-->
    <script src="<?= base_url('assets/js/script.js') ?>"></script>
    <!-- DataTables CSS & JS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.1/css/dataTables.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/2.3.1/js/dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#tableTransaksi').DataTable();
        });
        // Menambahkan interaktivitas sederhana
        document.querySelectorAll('.form-input').forEach(input => {
            input.addEventListener('focus', function() {
                this.style.borderColor = '#666';
            });
            
            input.addEventListener('blur', function() {
                this.style.borderColor = '#ddd';
            });
        });

        function logout(event) {
    event.preventDefault(); // Mencegah link berjalan langsung

    Swal.fire({
        title: 'Konfirmasi Logout',
        text: 'Apakah Anda yakin ingin logout?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Logout',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = '<?= base_url('apoteker/logout') ?>';
        }
    });
}

    </script>
</body>

</html>
