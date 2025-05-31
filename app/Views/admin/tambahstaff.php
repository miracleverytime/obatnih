<?= $this->extend('layout/TemplateAdpo'); ?>

<?= $this->section('content'); ?>
<!-- MAIN CONTENT-->
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">

                    <div class="overview-wrap mb-4" style="margin-top: -27px;">
                        <h1>Data Staff</h1>
                        <a href="<?= base_url('admin/ke_staff') ?>" class="btn btn-primary ms-auto">Tambah Staff</a>
                    </div>

                    <div class="table-responsive">
                        <table id="tableStaff" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Peran</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($admin as $a) : ?>
                                    <tr>
                                        <td><?= $i++ ?></td>
                                        <td><?= esc($a['nama']) ?></td>
                                        <td><?= esc($a['email']) ?></td>
                                        <td>Admin</td>
                                        <td><a href="<?= base_url('admin/delete_admin/' . $a['id']); ?>" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');">Hapus</a></td>
                                    </tr>
                                <?php endforeach; ?>
                                <?php foreach ($apoteker as $p) : ?>
                                    <tr>
                                        <td><?= $i++ ?></td>
                                        <td><?= esc($p['nama']) ?></td>
                                        <td><?= esc($p['email']) ?></td>
                                        <td>Apoteker</td>
                                        <td><a href="<?= base_url('admin/delete_apoteker/' . $p['id']); ?>" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');">Hapus</a></td>
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
<?= $this->endsection(); ?>