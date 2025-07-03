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
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
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
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
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
        box-shadow: 0 0 0 3px rgba(0, 123, 255, 0.1);
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
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
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
        border: 1px solid #ddd;
        border-radius: 8px;
        overflow: hidden;
        background-color: white;
    }

    .quantity-btn {
        width: 35px;
        height: 35px;
        border: none;
        background-color: #f8f9fa;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        color: #666;
        transition: all 0.2s;
    }

    .quantity-btn:hover {
        background-color: #e9ecef;
        color: #333;
    }

    .quantity-btn:disabled {
        background-color: #f8f9fa;
        color: #ccc;
        cursor: not-allowed;
    }

    .quantity-input {
        width: 50px;
        height: 35px;
        border: none;
        text-align: center;
        font-weight: 500;
        outline: none;
        background-color: white;
        font-size: 14px;
    }

    .quantity-input::-webkit-outer-spin-button,
    .quantity-input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    .quantity-input[type=number] {
        appearance: textfield;
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
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
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

    .loading {
        opacity: 0.6;
        pointer-events: none;
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

    .success-message {
        background-color: #d4edda;
        border: 1px solid #c3e6cb;
        color: #155724;
        padding: 10px 15px;
        border-radius: 10px;
        margin-bottom: 1rem;
        font-size: 0.875rem;
    }
</style>
<main>
    <div class="main-container">
        <?php if (session()->getFlashdata('error')): ?>
            <div class="error-message">
                <?= session()->getFlashdata('error'); ?>
            </div>
        <?php endif; ?>

        <div class="cart-layout">
            <!-- Cart Items -->
            <div class="cart-items">
                <?php if (count($keranjang) > 0): ?>
                    <?php foreach ($keranjang as $item): ?>
                        <div class="cart-item" data-item-id="<?= $item['id'] ?>">
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
                                    <span class="price-per-unit">Rp <?= number_format($item['harga_satuan'], 0, ',', '.') ?></span> x
                                    <span class="quantity-display"><?= $item['jumlah'] ?></span> =
                                    <span class="total-price">Rp <?= number_format($item['harga_satuan'] * $item['jumlah'], 0, ',', '.') ?></span>
                                </div>
                            </div>

                            <div class="quantity-section">
                                <button class="quantity-btn decrease-btn" data-item-id="<?= $item['id'] ?>" data-price="<?= $item['harga_satuan'] ?>">−</button>
                                <input type="number"
                                    class="quantity-input"
                                    value="<?= $item['jumlah'] ?>"
                                    min="1"
                                    max="99999"
                                    data-item-id="<?= $item['id'] ?>"
                                    data-price="<?= $item['harga_satuan'] ?>">
                                <button class="quantity-btn increase-btn" data-item-id="<?= $item['id'] ?>" data-price="<?= $item['harga_satuan'] ?>">+</button>
                            </div>

                            <div class="item-actions">
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
                        <span id="subtotal-display">Rp <?= number_format($subtotal, 0, ',', '.') ?></span>
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
                        <span id="total-display">Rp <?= number_format($subtotal, 0, ',', '.') ?></span>
                    </div>

                    <form action="<?= base_url('user/keranjang/dpengiriman') ?>" method="post">
                        <?= csrf_field() ?>
                        <button type="submit" class="checkout-btn">Selanjutnya</button>
                    </form>
                    <button class="cancel-btn" onclick="window.history.back()">Batal</button>
                </div>
            <?php endif; ?>
        </div>
    </div>
</main>

<script>
    // Definisi variabel global yang diperlukan
    const baseUrl = '<?= base_url() ?>';
    const csrfToken = '<?= csrf_token() ?>';
    const csrfHash = '<?= csrf_hash() ?>';

    // Script untuk menangani perubahan quantity di keranjang
    document.addEventListener('DOMContentLoaded', function() {
        // Function untuk format rupiah
        function formatRupiah(angka) {
            return new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0,
                maximumFractionDigits: 0
            }).format(angka).replace('IDR', 'Rp');
        }

        // Function untuk update quantity
        function updateQuantity(itemId, newQuantity) {
            // Disable semua tombol sementara
            const buttons = document.querySelectorAll('.quantity-btn');
            const inputs = document.querySelectorAll('.quantity-input');

            buttons.forEach(btn => btn.disabled = true);
            inputs.forEach(input => input.disabled = true);

            // Tampilkan loading state
            const cartItem = document.querySelector(`[data-item-id="${itemId}"]`);
            cartItem.classList.add('loading');

            // Siapkan data untuk dikirim
            const formData = new FormData();
            formData.append('id', itemId);
            formData.append('jumlah', newQuantity);
            formData.append(csrfToken, csrfHash);

            // Kirim request AJAX
            fetch(baseUrl + 'user/keranjang/updateQuantity', {
                    method: 'POST',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: formData
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        // Update tampilan quantity
                        const quantityDisplay = cartItem.querySelector('.quantity-display');
                        const totalPriceDisplay = cartItem.querySelector('.total-price');
                        const quantityInput = cartItem.querySelector('.quantity-input');

                        quantityDisplay.textContent = data.data.jumlah;
                        quantityInput.value = data.data.jumlah;
                        totalPriceDisplay.textContent = formatRupiah(data.data.total_item);

                        // Update subtotal dan total
                        document.getElementById('subtotal-display').textContent = formatRupiah(data.data.subtotal);
                        document.getElementById('total-display').textContent = formatRupiah(data.data.subtotal);

                        // Update tombol decrease state
                        const decreaseBtn = cartItem.querySelector('.decrease-btn');
                        decreaseBtn.disabled = data.data.jumlah <= 1;

                    } else {
                        // Tampilkan pesan error
                        showMessage(data.message, 'error');

                        // Kembalikan nilai input ke nilai sebelumnya
                        const quantityInput = cartItem.querySelector('.quantity-input');
                        quantityInput.value = quantityInput.dataset.originalValue || 1;
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showMessage('Terjadi kesalahan. Silakan coba lagi.', 'error');

                    // Kembalikan nilai input ke nilai sebelumnya
                    const quantityInput = cartItem.querySelector('.quantity-input');
                    quantityInput.value = quantityInput.dataset.originalValue || 1;
                })
                .finally(() => {
                    // Enable kembali semua tombol
                    buttons.forEach(btn => btn.disabled = false);
                    inputs.forEach(input => input.disabled = false);

                    // Update disable state untuk tombol decrease
                    document.querySelectorAll('.quantity-input').forEach(input => {
                        const itemId = input.dataset.itemId;
                        const decreaseBtn = document.querySelector(`.decrease-btn[data-item-id="${itemId}"]`);
                        if (parseInt(input.value) <= 1) {
                            decreaseBtn.disabled = true;
                        } else {
                            decreaseBtn.disabled = false;
                        }
                    });

                    // Hilangkan loading state
                    cartItem.classList.remove('loading');
                });
        }

        // Function untuk menampilkan pesan
        function showMessage(message, type) {
            // Hapus pesan sebelumnya jika ada
            const existingMessage = document.querySelector('.alert-message');
            if (existingMessage) {
                existingMessage.remove();
            }

            // Buat elemen pesan baru
            const messageDiv = document.createElement('div');
            messageDiv.className = `alert-message ${type === 'success' ? 'success-message' : 'error-message'}`;
            messageDiv.textContent = message;

            // Tambahkan ke halaman
            const mainContainer = document.querySelector('.main-container');
            mainContainer.insertBefore(messageDiv, mainContainer.firstChild);

            // Hilangkan pesan 
            setTimeout(() => {
                if (messageDiv.parentNode) {
                    messageDiv.remove();
                }
            }, 2500);
        }

        // Event listener untuk tombol decrease
        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('decrease-btn')) {
                e.preventDefault();

                const itemId = e.target.dataset.itemId;
                const quantityInput = document.querySelector(`input[data-item-id="${itemId}"]`);
                const currentQuantity = parseInt(quantityInput.value);

                if (currentQuantity > 1) {
                    const newQuantity = currentQuantity - 1;
                    quantityInput.dataset.originalValue = currentQuantity;
                    updateQuantity(itemId, newQuantity);
                }
            }
        });

        // Event listener untuk tombol increase
        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('increase-btn')) {
                e.preventDefault();

                const itemId = e.target.dataset.itemId;
                const quantityInput = document.querySelector(`input[data-item-id="${itemId}"]`);
                const currentQuantity = parseInt(quantityInput.value);

                if (currentQuantity < 99999) {
                    const newQuantity = currentQuantity + 1;
                    quantityInput.dataset.originalValue = currentQuantity;
                    updateQuantity(itemId, newQuantity);
                } else {
                    showMessage('Quantity maksimal adalah 99999', 'error');
                }
            }
        });

        // Event listener untuk input quantity langsung
        document.addEventListener('change', function(e) {
            if (e.target.classList.contains('quantity-input')) {
                const itemId = e.target.dataset.itemId;
                const newQuantity = parseInt(e.target.value);
                const originalValue = parseInt(e.target.dataset.originalValue) || 1;

                // Validasi input
                if (isNaN(newQuantity) || newQuantity < 1) {
                    e.target.value = originalValue;
                    showMessage('Quantity minimal adalah 1', 'error');
                    return;
                }

                if (newQuantity > 99999) {
                    e.target.value = originalValue;
                    showMessage('Quantity maksimal adalah 99999', 'error');
                    return;
                }

                // Jika nilai tidak berubah, tidak perlu update
                if (newQuantity === originalValue) {
                    return;
                }

                // Simpan nilai original untuk rollback jika gagal
                e.target.dataset.originalValue = originalValue;
                updateQuantity(itemId, newQuantity);
            }
        });

        // Event listener untuk focus pada input quantity (simpan nilai original)
        document.addEventListener('focus', function(e) {
            if (e.target.classList.contains('quantity-input')) {
                e.target.dataset.originalValue = e.target.value;
            }
        }, true);

        // Set nilai original untuk semua input quantity saat halaman dimuat
        document.querySelectorAll('.quantity-input').forEach(input => {
            input.dataset.originalValue = input.value;
        });

        // Disable tombol decrease untuk quantity = 1 saat halaman dimuat
        document.querySelectorAll('.quantity-input').forEach(input => {
            const itemId = input.dataset.itemId;
            const decreaseBtn = document.querySelector(`.decrease-btn[data-item-id="${itemId}"]`);
            if (parseInt(input.value) <= 1) {
                decreaseBtn.disabled = true;
            }
        });

        // Validasi input hanya angka
        document.addEventListener('keypress', function(e) {
            if (e.target.classList.contains('quantity-input')) {
                // Hanya izinkan angka
                if (!/[0-9]/.test(e.key) && !['Backspace', 'Delete', 'ArrowLeft', 'ArrowRight', 'Tab'].includes(e.key)) {
                    e.preventDefault();
                }
            }
        });

        // Prevent paste non-numeric content
        document.addEventListener('paste', function(e) {
            if (e.target.classList.contains('quantity-input')) {
                e.preventDefault();
                const paste = (e.clipboardData || window.clipboardData).getData('text');
                if (/^\d+$/.test(paste)) {
                    const value = parseInt(paste);
                    if (value >= 1 && value <= 99999) {
                        e.target.value = value;
                        e.target.dispatchEvent(new Event('change'));
                    }
                }
            }
        });
    });
</script>
<?= $this->endSection(); ?>