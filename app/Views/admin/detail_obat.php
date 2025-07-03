<?= $this->extend('layout/TemplateAdpo'); ?>



<?= $this->Section('content'); ?>
<style>
    .product-container {
        margin-top: 30px;
    }

    .product-image {
        max-width: 100%;
        height: auto;
    }

    .product-info h2 {
        margin-bottom: 20px;
    }

    .product-info p {
        margin-bottom: 10px;
    }

    body {
        font-family: 'Poppins', sans-serif;
        background-color: #f9f9f9;
        padding-top: 70px;
    }

    .product-image {
        max-width: 100%;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .product-info h2 {
        font-weight: 700;
        margin-bottom: 20px;
    }

    .product-info p {
        margin-bottom: 8px;
        font-size: 15px;
        color: #555;
    }

    .price {
        font-size: 24px;
        font-weight: 700;
        margin-top: 20px;
    }

    .btn-add-cart {
        margin-top: 15px;
    }

    .back-button {
        margin-bottom: 20px;
    }

    .badge-stock {
        font-size: 14px;
        padding: 8px 12px;
    }
</style>
</head>
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="overview-wrap" style="margin-top: -90px;">
                        <h1>Detail Obat</h1>
                    </div>

                    <div class="row">

                        <!-- Gambar Produk -->
                        <div class="col-md-6 d-flex justify-content-center">
                            <?php $gambar = !empty($obat['gambar_obat']) ? $obat['gambar_obat'] : 'default.jpg'; ?>
                            <div class="w-100 h-100 d-flex align-items-center justify-content-center">
                                <img src="<?= base_url('/assets/gambar/' . $gambar) ?>"
                                    class="img-fluid h-100"
                                    style="object-fit: contain; border-radius: 8px; padding: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.1);"
                                    alt="<?= esc($obat['nama_obat']) ?>">
                            </div>
                        </div>

                        <!-- Info Produk -->
                        <div class="col-md-6 product-info">
                            <h2><?= $obat['nama_obat'] ?></h2>
                            <p><strong>Deskripsi:</strong> <?= esc($obat['deskripsi']) ?></p>
                            <p><strong>Dosis:</strong> <?= esc($obat['dosis']) ?></p>
                            <p><strong>Komposisi:</strong> <?= esc($obat['komposisi']) ?></p>
                            <p><strong>Cara Pakai:</strong> <?= esc($obat['cara_pakai']) ?></p>
                            <p><strong>Kemasan:</strong> <?= esc($obat['kemasan']) ?></p>
                            <p><strong>Golongan:</strong> <?= esc($obat['golongan_obat']) ?></p>
                            <p><strong>Kontraindikasi:</strong> <?= esc($obat['kontra_indikasi']) ?></p>
                            <p><strong>Efek Samping:</strong> <?= esc($obat['efek_samping']) ?></p>
                            <div class="mb-3">
                                <?php if ($obat['stok'] > 0): ?>
                                    <span class="badge bg-success badge-stock text-white">
                                        <i class="fas fa-check-circle"></i> Tersedia (<?= $obat['stok'] ?> unit)
                                    </span>
                                <?php else: ?>
                                    <span class="badge bg-danger badge-stock text-white">
                                        <i class="fas fa-times-circle"></i> Stok Habis
                                    </span>
                                <?php endif; ?>
                            </div>

                            <a href="<?= base_url('admin/dataobat') ?>" class="btn btn-primary btn-add-cart text-white text-decoration-none">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<?= $this->endSection(); ?>