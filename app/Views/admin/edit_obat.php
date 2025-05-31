<?= $this->extend('layout/TemplateAdpo'); ?>

<?= $this->section('content'); ?>

<!-- MAIN CONTENT -->
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="overview-wrap" style="margin-top: -27px;">
                        <h1>Edit Obat</h1>
                    </div> 

                    <div class="container mt-4">
                        <form action="<?= base_url('admin/update/' . $obat['id_obat']) ?>" method="post" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="nama_obat">Nama Obat</label>
                                <input type="text" name="nama_obat" id="nama_obat" class="form-control" value="<?= esc($obat['nama_obat']) ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="deskripsi">Deskripsi</label>
                                <textarea name="deskripsi" id="deskripsi" class="form-control" required><?= esc($obat['deskripsi']) ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="dosis">Dosis</label>
                                <input type="text" name="dosis" id="dosis" class="form-control" value="<?= esc($obat['dosis']) ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="komposisi">Komposisi</label>
                                <input type="text" name="komposisi" id="komposisi" class="form-control" value="<?= esc($obat['komposisi']) ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="cara_pakai">Cara Pakai</label>
                                <input type="text" name="cara_pakai" id="cara_pakai" class="form-control" value="<?= esc($obat['cara_pakai']) ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="kemasan">Kemasan</label>
                                <input type="text" name="kemasan" id="kemasan" class="form-control" value="<?= esc($obat['kemasan']) ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="golongan_obat">Golongan Obat</label>
                                <input type="text" name="golongan_obat" id="golongan_obat" class="form-control" value="<?= esc($obat['golongan_obat']) ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="kontra_indikasi">Kontraindikasi</label>
                                <input type="text" name="kontra_indikasi" id="kontra_indikasi" class="form-control" value="<?= esc($obat['kontra_indikasi']) ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="efek_samping">Efek Samping</label>
                                <input type="text" name="efek_samping" id="efek_samping" class="form-control" value="<?= esc($obat['efek_samping']) ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="stok">Stok</label>
                                <input type="number" name="stok" id="stok" class="form-control" value="<?= esc($obat['stok']) ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="gambar_obat">Ganti Gambar (kosongkan jika tidak ingin diubah)</label>
                                <input type="file" name="gambar_obat" id="gambar_obat" class="form-control" accept="image/*">
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="<?= base_url('admin/dataobat') ?>" class="btn btn-secondary">Batal</a>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- END MAIN CONTENT -->

<?= $this->endSection(); ?>
