<?= $this->extend('layout/TemplateApoteker'); ?>
<?= $this->section('content'); ?>

<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="overview-wrap" style="margin-top: -27px;">
                        <h1>Validasi Transaksi</h1>
                    </div>

                    <?php if (session()->getFlashdata('success')): ?>
                        <div class="alert alert-success">
                            <?= session()->getFlashdata('success'); ?>
                        </div>
                    <?php elseif (session()->getFlashdata('error')): ?>
                        <div class="alert alert-danger">
                            <?= session()->getFlashdata('error'); ?>
                        </div>
                    <?php endif; ?>

                    <div class="container mt-4">
                        <table id="tableTransaksi" class="table table-striped display">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Pengguna</th>
                                    <th>Tanggal</th>
                                    <th>Total Harga</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($transaksi as $t) : ?>
                                <tr>
                                    <td><?= $i++; ?></td>
                                    <td><?= esc($t['nama']); ?></td>
                                    <td><?= date('d-m-Y', strtotime($t['tanggal_transaksi'])); ?></td>
                                    <td>Rp <?= number_format($t['total_harga'], 0, ',', '.'); ?></td>
                                    <td><?= esc($t['status']); ?></td>
                                    <td>
                                        <?php if ($t['status'] === 'pending') : ?>
                                            <a href="<?= base_url('apoteker/validasi_transaksi/' . $t['id']); ?>" class="btn btn-success" onclick="return confirm('Validasi transaksi ini?')">Validasi</a>
                                            <a href="<?= base_url('apoteker/batalkan_transaksi/' . $t['id']); ?>" class="btn btn-danger" onclick="return confirm('Batalkan transaksi ini?')">Batalkan</a>
                                        <?php else : ?>
                                            <span class="text-muted">Tidak ada aksi</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>
