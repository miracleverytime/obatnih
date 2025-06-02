<?= $this->extend('layout/templateUser'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col">
            <h3>Edit Obat di Keranjang</h3>
            <form action="<?= base_url('user/keranjang/update/' . $item['id']) ?>" method="post">
                <?= csrf_field() ?>
                <div class="form-group">
                    <label for="nama_obat">Nama Obat:</label>
                    <select class="form-control" id="nama_obat" name="nama_obat" required>
                        <option value="">Pilih Obat</option>
                        <?php foreach ($daftar_obat as $obat): ?>
                            <option value="<?= esc($obat['nama_obat']) ?>"
                                <?= esc($obat['nama_obat']) == ($item['nama_obat'] ?? '') ? 'selected' : '' ?>>
                                <?= esc($obat['nama_obat']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="jumlah">Jumlah:</label>
                    <input type="number" class="form-control" id="jumlah" name="jumlah"
                           value="<?= esc($item['jumlah'] ?? '') ?>" required>
                </div>
                <button type="submit" class="btn btn-primary my-3">Simpan Perubahan</button>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>
