<?= $this->extend('layout/TemplateUser'); ?>
<?= $this->section('content'); ?>

<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        background-color: #f8f9fa;
        color: #333;
    }

    .header {
        background: white;
        padding: 12px 20px;
        border-bottom: 1px solid #e1e5e9;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .logo {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 18px;
        font-weight: 600;
        color: #2c3e50;
    }

    .logo::before {
        content: "🏥";
        font-size: 20px;
    }

    .search-bar {
        flex: 1;
        max-width: 400px;
        margin: 0 20px;
    }

    .search-bar input {
        width: 100%;
        padding: 8px 15px;
        border: 1px solid #ddd;
        border-radius: 20px;
        font-size: 14px;
    }

    .nav-links {
        display: flex;
        gap: 20px;
        align-items: center;
    }

    .nav-links a {
        text-decoration: none;
        color: #666;
        font-size: 14px;
        padding: 8px 12px;
        border-radius: 4px;
        transition: color 0.2s;
    }

    .nav-links a:hover {
        color: #2c3e50;
    }

    .cart-btn {
        background: #333 !important;
        color: white !important;
        padding: 8px 15px;
        border-radius: 4px;
        font-size: 14px;
    }

    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
        display: grid;
        grid-template-columns: 1fr 400px;
        gap: 30px;
    }

    .form-section {
        background: white;
        padding: 30px;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .form-title {
        font-size: 24px;
        font-weight: 600;
        margin-bottom: 30px;
        color: #2c3e50;
    }

    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 15px;
        margin-bottom: 20px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group.full-width {
        grid-column: 1 / -1;
    }

    .form-group label {
        display: block;
        margin-bottom: 5px;
        font-size: 14px;
        color: #555;
        font-weight: 500;
    }

    .form-group input,
    .form-group textarea {
        width: 100%;
        padding: 12px 15px;
        border: 1px solid #ddd;
        border-radius: 6px;
        font-size: 14px;
        transition: border-color 0.2s;
    }

    .form-group input:focus,
    .form-group textarea:focus {
        outline: none;
        border-color: #4a90e2;
        box-shadow: 0 0 0 3px rgba(74, 144, 226, 0.1);
    }

    .form-group textarea {
        resize: vertical;
        min-height: 80px;
    }

    .button-row {
        display: flex;
        gap: 15px;
        margin-top: 30px;
    }

    .btn {
        padding: 12px 30px;
        border: none;
        border-radius: 6px;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s;
        text-decoration: none;
        display: inline-block;
        text-align: center;
    }

    .btn-primary {
        background: #333;
        color: white;
        flex: 1;
    }

    .btn-primary:hover {
        background: #444;
    }

    .btn-secondary {
        background: #f8f9fa;
        color: #666;
        border: 1px solid #ddd;
        flex: 1;
    }

    .btn-secondary:hover {
        background: #e9ecef;
    }

    .cart-summary {
        background: white;
        padding: 25px;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        height: fit-content;
    }

    .cart-item {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 15px;
        padding-bottom: 15px;
        border-bottom: 1px solid #f0f0f0;
    }

    .cart-item:last-child {
        border-bottom: none;
        margin-bottom: 20px;
    }

    .item-image {
        width: 50px;
        height: 50px;
        background: #f8f9fa;
        border-radius: 6px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        overflow: hidden;
    }

    .item-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .item-details {
        flex: 1;
    }

    .item-name {
        font-size: 14px;
        font-weight: 600;
        margin-bottom: 4px;
    }

    .item-price {
        font-size: 13px;
        color: #666;
    }

    .summary-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 8px;
        font-size: 14px;
    }

    .summary-row.total {
        font-weight: 600;
        font-size: 16px;
        margin-top: 15px;
        padding-top: 15px;
        border-top: 1px solid #f0f0f0;
    }

    .placeholder-image {
        background: #f0f0f0;
        color: #999;
        font-size: 24px;
    }

    @media (max-width: 768px) {
        .container {
            grid-template-columns: 1fr;
            padding: 15px;
        }

        .form-row {
            grid-template-columns: 1fr;
        }

        .nav-links {
            display: none;
        }
    }
</style>
<main>
    <div class="container">
        <div class="form-section">
            <h1 class="form-title">Detail Pengiriman</h1>
            <form action="<?= base_url('user/proses-pengiriman') ?>" method="post">
                <?= csrf_field() ?>
                <div class="form-group">
                    <label for="nama_awal">Nama</label>
                    <input type="text" id="nama" name="nama" placeholder="Masukkan nama" value="<?= esc($data['user']['nama']) ?>" required disabled>
                </div>

                <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <input type="text" id="alamat" name="alamat" placeholder="Masukkan alamat lengkap" value="<?= esc($data['user']['alamat']) ?>" required disabled>
                </div>

                <div class="form-group">
                    <label for="detail_alamat">Detail alamat</label>
                    <textarea id="detail_alamat" name="detail_alamat" placeholder="Masukkan detail alamat (opsional)"></textarea>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="provinsi">Provinsi</label>
                        <input type="text" id="provinsi" name="provinsi" placeholder="Pilih provinsi" required>
                    </div>
                    <div class="form-group">
                        <label for="kota">Kota</label>
                        <input type="text" id="kota" name="kota" placeholder="Pilih kota" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="kode_pos">Kode pos</label>
                        <input type="text" id="kode_pos" name="kode_pos" placeholder="Masukkan kode pos" required>
                    </div>
                    <div class="form-group">
                        <label for="no_hp">No HP</label>
                        <input type="tel" id="no_hp" name="no_hp" placeholder="Masukkan nomor HP" value="<?= esc($data['user']['no_hp']) ?>" required>
                    </div>
                </div>

                <div class="button-row">
                    <button type="submit" class="btn btn-primary">Selanjutnya</button>
                    <a href="<?= base_url('user/keranjang') ?>" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>

        <div class="cart-summary">
            <?php foreach ($keranjang as $item): ?>
                <div class="cart-item">
                    <div class="item-image">
                        <?php if (!empty($item['gambar_obat'])): ?>
                            <img src="<?= base_url('assets/gambar/' . $item['gambar_obat']) ?>" alt="<?= esc($item['nama_obat']) ?>">
                        <?php else: ?>
                            <span class="placeholder-image">📦</span>
                        <?php endif; ?>
                    </div>
                    <div class="item-details">
                        <div class="item-name"><?= esc($item['nama_obat']) ?></div>
                        <div class="item-price">
                            <span class="price-per-unit">Rp <?= number_format($item['harga_satuan'], 0, ',', '.') ?></span> x
                            <span class="quantity-display"><?= $item['jumlah'] ?></span> =
                            <span class="total-price">Rp <?= number_format($item['harga_satuan'] * $item['jumlah'], 0, ',', '.') ?></span>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>

            <div class="summary-row">
                <span>SUBTOTAL</span>
                <span>Rp <?= number_format($subtotal, 0, ',', '.') ?></span>
            </div>
            <div class="summary-row">
                <span>PENGIRIMAN</span>
                <span>Rp 0</span>
            </div>
            <div class="summary-row">
                <span>PAJAK</span>
                <span>Rp 0</span>
            </div>
            <div class="summary-row total">
                <span>TOTAL</span>
                <span>Rp <?= number_format($subtotal, 0, ',', '.') ?></span>
            </div>
        </div>
    </div>
</main>
<?= $this->endSection(); ?>