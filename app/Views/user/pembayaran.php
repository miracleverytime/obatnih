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
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .form-title {
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 30px;
            color: #2c3e50;
        }

        .payment-options {
            display: flex;
            flex-direction: column;
            gap: 15px;
            margin-bottom: 30px;
        }

        .payment-option {
            position: relative;
            border: 2px solid #e1e5e9;
            border-radius: 8px;
            padding: 20px;
            cursor: pointer;
            transition: all 0.2s;
        }

        .payment-option:hover {
            border-color: #4a90e2;
        }

        .payment-option input[type="radio"] {
            position: absolute;
            opacity: 0;
            cursor: pointer;
        }

        .payment-option.selected {
            border-color: #4a90e2;
            background-color: #f8fbff;
        }

        .payment-option-content {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .payment-icon {
            width: 40px;
            height: 40px;
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            background: #f8f9fa;
        }

        .payment-info {
            flex: 1;
        }

        .payment-name {
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 4px;
            color: #2c3e50;
        }

        .payment-description {
            font-size: 14px;
            color: #666;
        }

        .radio-indicator {
            width: 20px;
            height: 20px;
            border: 2px solid #ddd;
            border-radius: 50%;
            position: relative;
            transition: all 0.2s;
        }

        .payment-option.selected .radio-indicator {
            border-color: #4a90e2;
        }

        .payment-option.selected .radio-indicator::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 10px;
            height: 10px;
            background: #4a90e2;
            border-radius: 50%;
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
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            height: fit-content;
        }

        .summary-title {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 20px;
            color: #2c3e50;
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

            .nav-links {
                display: none;
            }

            .payment-option-content {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }

            .radio-indicator {
                position: absolute;
                top: 20px;
                right: 20px;
            }
        }
    </style>

<main>
    <div class="container">
        <div class="form-section">
            <h1 class="form-title">Metode Pembayaran</h1>
            <form action="<?= base_url('user/pembayaran/proses') ?>" method="post" id="formPembayaran">
                <?= csrf_field() ?>
                
                <div class="payment-options">
                    <label class="payment-option" for="tunai">
                        <input type="radio" id="tunai" name="metode_pembayaran" value="tunai" required>
                        <div class="payment-option-content">
                            <div class="payment-icon">💵</div>
                            <div class="payment-info">
                                <div class="payment-name">Tunai</div>
                                <div class="payment-description">Bayar saat barang diterima (COD)</div>
                            </div>
                            <div class="radio-indicator"></div>
                        </div>
                    </label>

                    <label class="payment-option" for="transfer">
                        <input type="radio" id="transfer" name="metode_pembayaran" value="transfer_bank" required>
                        <div class="payment-option-content">
                            <div class="payment-icon">🏦</div>
                            <div class="payment-info">
                                <div class="payment-name">Transfer Bank</div>
                                <div class="payment-description">Transfer ke rekening toko</div>
                            </div>
                            <div class="radio-indicator"></div>
                        </div>
                    </label>

                    <label class="payment-option selected" for="ewallet">
                        <input type="radio" id="ewallet" name="metode_pembayaran" value="e_wallet" checked required>
                        <div class="payment-option-content">
                            <div class="payment-icon">📱</div>
                            <div class="payment-info">
                                <div class="payment-name">e-Wallet</div>
                                <div class="payment-description">Bayar menggunakan OVO, GoPay, DANA, LinkAja</div>
                            </div>
                            <div class="radio-indicator"></div>
                        </div>
                    </label>
                </div>

                <div class="button-row">
                    <button type="submit" class="btn btn-primary">Bayar</button>
                    <a href="<?= base_url('user/pembayaran/back') ?>" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>

        <div class="cart-summary">
            <h3 class="summary-title">Ringkasan Belanja</h3>
            
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

<script>
document.addEventListener('DOMContentLoaded', function() {
    const paymentOptions = document.querySelectorAll('.payment-option');
    const radioInputs = document.querySelectorAll('input[name="metode_pembayaran"]');

    paymentOptions.forEach(option => {
        option.addEventListener('click', function() {
            // Remove selected class from all options
            paymentOptions.forEach(opt => opt.classList.remove('selected'));
            
            // Add selected class to clicked option
            this.classList.add('selected');
            
            // Check the radio input
            const radioInput = this.querySelector('input[type="radio"]');
            if (radioInput) {
                radioInput.checked = true;
            }
        });
    });

    // Handle radio button changes
    radioInputs.forEach(radio => {
        radio.addEventListener('change', function() {
            // Remove selected class from all options
            paymentOptions.forEach(opt => opt.classList.remove('selected'));
            
            // Add selected class to parent option
            const parentOption = this.closest('.payment-option');
            if (parentOption) {
                parentOption.classList.add('selected');
            }
        });
    });
});

document.addEventListener('DOMContentLoaded', function () {
    const bayarForm = document.getElementById('formPembayaran');

    bayarForm.addEventListener('submit', function(e) {
        e.preventDefault(); // Cegah submit langsung

        Swal.fire({
            title: 'Konfirmasi Pembayaran',
            text: "Apakah kamu yakin ingin melakukan pembayaran?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#aaa',
            confirmButtonText: 'Ya, Bayar Sekarang',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                bayarForm.submit(); // Baru submit di sini
            }
        });
    });
});


</script>

<?= $this->endSection(); ?>