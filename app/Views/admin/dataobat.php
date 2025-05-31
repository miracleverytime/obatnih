<?= $this->extend('layout/TemplateAdpo'); ?>



<?= $this->Section('content'); ?>
            <!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="overview-wrap" style="margin-top: -27px;">
                                    <h1>Data Obat</h1>
                                     <a href="<?= base_url('admin/ke_obat')?>" class="btn btn-primary">Tambah Obat</a>
                                </div> 
                                <div class="container mt-4">
                                    <table id="tableObat" class="table table-striped display">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Obat</th>
                                                <th>Kemasan</th>
                                                <th>Golongan Obat</th>
                                                <th>Stok</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 1; ?>
                                            <?php foreach ($obat as $o) : ?>
                                            <tr>
                                                <td><?= $i++; ?></td>
                                                <td><?= esc($o['nama_obat']); ?></td>
                                                <td><?= esc($o['kemasan']); ?></td>
                                                <td><?= esc($o['golongan_obat']); ?></td>
                                                <td><?= esc($o['stok']); ?></td>
                                                <td>
                                                    <a href="<?= base_url('admin/edit_obat/' . $o['id_obat']); ?>" class="btn btn-warning">Edit</a>
                                                    <a href="<?= base_url('admin/delete_obat/' . $o['id_obat']); ?>" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');">Hapus</a>
                                                    <a href="<?= base_url('admin/detail_obat/' . $o['id_obat']); ?>" class="btn btn-info">Detail</a>
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
            <!-- END MAIN CONTENT-->
            <!-- END PAGE CONTAINER-->
        </div>

    </div>
<?= $this->endSection(); ?>
