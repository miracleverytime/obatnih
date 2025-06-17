<?= $this->extend('layout/TemplateAdpo'); ?>
<?= $this->section('content'); ?>

<!-- MAIN CONTENT-->
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="overview-wrap" style="margin-top: -27px;">
                        <h1>Laporan Penjualan</h1>
                    </div>

                    <div class="container mt-4">
                        <table id="tableLaporan" class="table table-striped display">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Customer</th>
                                    <th>Tanggal Transaksi</th>
                                    <th>Total Harga</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($transaksi)) : ?>
                                    <?php $i = 1; foreach ($transaksi as $t) : ?>
                                        <tr>
                                            <td><?= $i++; ?></td>
                                            <td><?= esc($t['nama_user']); ?></td>
                                            <td><?= esc($t['tanggal_transaksi']); ?></td>
                                            <td>Rp<?= number_format($t['total_harga'], 0, ',', '.'); ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <tr>
                                        <td colspan="4" class="text-center">Belum ada transaksi.</td>
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
<!-- END MAIN CONTENT-->

<?= $this->endSection(); ?>
