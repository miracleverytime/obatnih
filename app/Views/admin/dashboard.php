<?= $this->extend('layout/TemplateAdpo'); ?>

<!-- Tambahkan CSS di bagian atas -->
<?= $this->section('style'); ?>
<style>
    .dashboard-box {
        background: #ffffff;
        border: 2px solid #e9ecef;
        border-radius: 15px;
        padding: 40px;
        font-size: 18px;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        width: 100%;
        text-align: center;
        color: #333;
        position: relative;
        overflow: hidden;
        transition: all 0.3s ease;
        border-left: 5px solid #6c757d;
    }

    .dashboard-box::before {
        content: '👋';
        position: absolute;
        top: 20px;
        right: 20px;
        font-size: 24px;
        opacity: 0.5;
        color: #6c757d;
    }

    .dashboard-box:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 30px rgba(0, 0, 0, 0.15);
        border-left: 5px solid #495057;
        border-color: #dee2e6;
    }

    .welcome-icon {
        font-size: 48px;
        margin-bottom: 15px;
        display: block;
        filter: grayscale(0.3);
    }

    .main-content {
        background: #dee2e6;
        min-height: 100vh;
        padding: 100px 0;
        margin-top: 60px;
    }

    .welcome-text {
        font-size: 1.5rem;
        font-weight: 600;
        margin: 0;
        z-index: 1;
        position: relative;
        color: #333;
    }
</style>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<!-- MAIN CONTENT-->
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="overview-wrap" style="margin-top: -27px;">
                        <h1 style="color: #333; font-weight: 700;">Dashboard Admin</h1>
                    </div>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-12 col-md-8 col-lg-6 mt-4">
                                <div class="dashboard-box">
                                    <span class="welcome-icon">🎯</span>
                                    <p class="welcome-text">Selamat datang, Admin!</p>
                                    <small style="opacity: 0.7; color: #6c757d;">Kelola sistem dengan mudah dari dashboard ini</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END MAIN CONTENT-->
<?= $this->endSection(); ?>