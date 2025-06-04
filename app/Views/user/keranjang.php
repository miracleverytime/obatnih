<?= $this->extend('layout/TemplateUser'); ?>

<?= $this->section('content'); ?>
<style>
    body {
        background-color: #f5f5f5;
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    }
    
    .navbar-custom {
        background-color: #fff;
        padding: 1rem 2rem;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        position: sticky;
        top: 0;
        z-index: 1000;
    }
    
    .navbar-brand {
        display: flex;
        align-items: center;
        gap: 10px;
        color: #666;
        font-weight: 500;
    }
    
    .search-box {
        flex: 1;
        max-width: 400px;
        margin: 0 2rem;
    }
    
    .search-box input {
        width: 100%;
        padding: 10px 15px;
        border: 1px solid #ddd;
        border-radius: 25px;
        background-color: #f8f9fa;
        outline: none;
    }
    
    .nav-links {
        display: flex;
        gap: 2rem;
        align-items: center;
    }
    
    .nav-links a {
        text-decoration: none;
        color: #666;
        font-weight: 500;
        transition: color 0.3s;
    }
    
    .nav-links a:hover {
        color: #333;
    }
    
    .cart-badge {
        background-color: #333;
        color: white;
        padding: 8px 16px;
        border-radius: 8px;
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    
    .main-container {
        max-width: 1200px;
        margin: 2rem auto;
        padding: 0 1rem;
    }
    
    .page-title {
        font-size: 2rem;
        font-weight: 600;
        color: #333;
        margin-bottom: 2rem;
    }
    
    .add-item-section {
        background: white;
        padding: 2rem;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        margin-bottom: 2rem;
    }
    
    .add-item-form {
        display: grid;
        grid-template-columns: 2fr 1fr auto;
        gap: 1rem;
        align-items: end;
    }
    
    .form-group {
        display: flex;
        flex-direction: column;
    }
    
    .form-group label {
        margin-bottom: 0.5rem;
        font-weight: 500;
        color: #555;
    }
    
    .form-control {
        padding: 12px;
        border: 1px solid #ddd;
        border-radius: 8px;
        font-size: 1rem;
        transition: border-color 0.3s;
    }
    
    .form-control:focus {
        outline: none;
        border-color: #007bff;
        box-shadow: 0 0 0 3px rgba(0,123,255,0.1);
    }
    
    .btn-add {
        background-color: #28a745;
        color: white;
        border: none;
        padding: 12px 24px;
        border-radius: 8px;
        font-weight: 500;
        cursor: pointer;
        transition: background-color 0.3s;
        height: fit-content;
    }
    
    .btn-add:hover {
        background-color: #218838;
    }
    
    .cart-layout {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 2rem;
    }
    
    .cart-items {
        background: white;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }
    
    .cart-item {
        display: flex;
        align-items: center;
        padding: 1.5rem;
        border-bottom: 1px solid #f0f0f0;
        transition: background-color 0.3s;
    }
    
    .cart-item:hover {
        background-color: #f8f9fa;
    }
    
    .cart-item:last-child {
        border-bottom: none;
    }
    
    .product-image {
        width: 80px;
        height: 80px;
        background-color: #f8f9fa;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 1rem;
        border: 2px solid #e9ecef;
    }
    
    .product-image .icon {
        width: 40px;
        height: 40px;
        background-color: #dee2e6;
        border-radius: 4px;
    }
    
    .product-details {
        flex: 1;
    }
    
    .product-name {
        font-weight: 600;
        color: #333;
        margin-bottom: 0.25rem;
    }
    
    .product-description {
        color: #666;
        font-size: 0.9rem;
        margin-bottom: 0.5rem;
    }
    
    .product-price {
        font-weight: 600;
        color: #333;
    }
    
    .quantity-section {
        display: flex;
        align-items: center;
        margin: 0 1rem;
    }
    
    .quantity-display {
        background-color: #f8f9fa;
        border: 1px solid #dee2e6;
        padding: 8px 12px;
        border-radius: 6px;
        min-width: 80px;
        text-align: center;
        font-weight: 500;
    }
    
    .item-actions {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    
    .action-btn {
        width: 36px;
        height: 36px;
        border: none;
        border-radius: 6px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s;
        font-size: 1rem;
    }
    
    .btn-edit {
        background-color: #007bff;
        color: white;
    }
    
    .btn-edit:hover {
        background-color: #0056b3;
    }
    
    .btn-delete {
        background-color: #dc3545;
        color: white;
    }
    
    .btn-delete:hover {
        background-color: #c82333;
    }
    
    .cart-summary {
        background: white;
        border-radius: 12px;
        padding: 1.5rem;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        height: fit-content;
        position: sticky;
        top: 100px;
    }
    
    .summary-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 1rem;
        color: #666;
    }
    
    .summary-total {
        display: flex;
        justify-content: space-between;
        font-size: 1.25rem;
        font-weight: 600;
        color: #333;
        padding-top: 1rem;
        border-top: 2px solid #f0f0f0;
        margin-top: 1rem;
    }
    
    .checkout-btn {
        width: 100%;
        background-color: #333;
        color: white;
        border: none;
        padding: 15px;
        border-radius: 8px;
        font-size: 1.1rem;
        font-weight: 600;
        cursor: pointer;
        transition: background-color 0.3s;
        margin-top: 1.5rem;
    }
    
    .checkout-btn:hover {
        background-color: #000;
    }
    
    .cancel-btn {
        width: 100%;
        background-color: transparent;
        color: #666;
        border: 1px solid #ddd;
        padding: 12px;
        border-radius: 8px;
        font-size: 1rem;
        cursor: pointer;
        transition: all 0.3s;
        margin-top: 0.5rem;
    }
    
    .cancel-btn:hover {
        background-color: #f8f9fa;
        color: #333;
    }
    
    .empty-cart {
        text-align: center;
        padding: 3rem;
        color: #666;
    }
    
    .empty-cart .icon {
        width: 80px;
        height: 80px;
        background-color: #f0f0f0;
        border-radius: 50%;
        margin: 0 auto 1rem;
    }
    
    @media (max-width: 768px) {
        .navbar-custom {
            padding: 1rem;
        }
        
        .nav-links {
            gap: 1rem;
        }
        
        .search-box {
            margin: 0 1rem;
        }
        
        .cart-layout {
            grid-template-columns: 1fr;
        }
        
        .add-item-form {
            grid-template-columns: 1fr;
            gap: 1rem;
        }
        
        .cart-item {
            flex-direction: column;
            gap: 1rem;
            align-items: flex-start;
        }
        
        .quantity-section {
            margin: 0;
        }
    }

    .error-message {
    background-color: #f8d7da;
    border: 1px solid #f5c6cb;
    color: #721c24;
    padding: 10px 15px;
    border-radius: 10px;
    margin-bottom: 1rem;
    font-size: 0.875rem;
    }
</style>

<!-- Navigation Bar -->


<div class="main-container">
    <h1 class="page-title">Keranjang</h1>
        <?php if(session()->getFlashdata('error')): ?>
        <div class="error-message">
        <?= session()->getFlashdata('error'); ?>
      </div>
    <?php endif; ?>
    
    <!-- Add Item Section -->
    <div class="add-item-section">
        <form action="<?= base_url('user/keranjang/tambah') ?>" method="post" class="add-item-form">
            <?= csrf_field() ?>
            <div class="form-group">
                <label for="nama_obat">Nama Obat:</label>
                <select class="form-control" id="nama_obat" name="nama_obat" required>
                    <option value="">Pilih Obat</option>
                    <?php foreach ($daftar_obat as $obat): ?>
                        <option value="<?= $obat['nama_obat'] ?>"><?= $obat['nama_obat'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="jumlah">Jumlah:</label>
                <input type="number" class="form-control" id="jumlah" name="jumlah" min="1" required>
            </div>
            <button type="submit" class="btn-add">Tambah</button>
        </form>
    </div>
    
    <div class="cart-layout">
        <!-- Cart Items -->
        <div class="cart-items">
            <?php if (count($keranjang) > 0): ?>
                <?php foreach ($keranjang as $item): ?>
                    <div class="cart-item">
                        <div class="product-image">
                        <?php 
                            $gambar = !empty($item['gambar_obat']) ? $item['gambar_obat'] : 'default.jpg'; 
                        ?>
                        <img src="<?= base_url('assets/gambar/' . $gambar) ?>" alt="<?= esc($item['nama_obat']) ?>" style="width: 100%; height: 100%; object-fit: contain;">
                        </div>
                        <div class="product-details">
                            <div class="product-name"><?= esc($item['nama_obat']) ?></div>
                            <div class="product-description"><?= esc($item['deskripsi']) ?></div>
                            <div class="product-price">
                                Rp <?= number_format($item['harga_satuan'], 0, ',', '.') ?> x <?= $item['jumlah'] ?> = 
                                Rp <?= number_format($item['harga_satuan'] * $item['jumlah'], 0, ',', '.') ?>
                            </div>
                        </div>
                        
                        <div class="quantity-section">
                            <div class="quantity-display"><?= $item['jumlah'] ?> pcs</div>
                        </div>
                        
                        <div class="item-actions">
                            <a href="<?= base_url('user/keranjang/edit/' . $item['id']) ?>" class="action-btn btn-edit" title="Edit">
                                📝
                            </a>
                            <a href="<?= base_url('user/keranjang/hapus/' . $item['id']) ?>" 
                               class="action-btn btn-delete" 
                               title="Hapus"
                               onclick="return confirm('Yakin ingin menghapus item ini?')">
                                🗑️
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="empty-cart">
                    <div class="icon"></div>
                    <h3>Keranjang Anda kosong</h3>
                    <p>Silakan tambahkan obat ke keranjang terlebih dahulu</p>
                </div>
            <?php endif; ?>
        </div>
        
        <!-- Cart Summary -->
        <?php if (count($keranjang) > 0): ?>
            <div class="cart-summary">
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
                <div class="summary-total">
                    <span>TOTAL</span>
                    <span>Rp <?= number_format($subtotal, 0, ',', '.') ?></span>
                </div>

                <form action="<?= base_url('user/keranjang/checkout') ?>" method="post">
                    <?= csrf_field() ?>
                    <button type="submit" class="checkout-btn">Selanjutnya</button>
                </form>
                <button class="cancel-btn" onclick="window.history.back()">Batal</button>
            </div>
        <?php endif; ?>
    </div>
</div>

<?= $this->endSection(); ?>