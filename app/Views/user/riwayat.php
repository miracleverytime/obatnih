<?= $this->extend('layout/templateUser') ?>
<?= $this->section('content'); ?>

<style>
    .container {
        max-width: 1000px;
        margin: 40px auto;
        padding: 0 20px;
    }

    .page-title {
        font-size: 24px;
        color: #333;
        margin-bottom: 30px;
        font-weight: normal;
    }

    .history-container {
        background-color: white;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }

    .transaction-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 20px 25px;
        border-bottom: 1px solid #eee;
        transition: background-color 0.3s;
    }

    .transaction-item:last-child {
        border-bottom: none;
    }

    .transaction-item:hover {
        background-color: #f9f9f9;
    }

    .transaction-detail {
        color: #666;
        font-size: 14px;
        margin-bottom: 5px;
    }

    .cetak-btn {
        background-color: #666;
        color: white;
        border: none;
        padding: 8px 20px;
        border-radius: 4px;
        cursor: pointer;
        font-size: 14px;
        transition: background-color 0.3s;
    }

    .cetak-btn:hover {
        background-color: #555;
    }

    .empty-state {
        text-align: center;
        padding: 60px 20px;
        color: #999;
    }

    .empty-state-icon {
        font-size: 48px;
        margin-bottom: 20px;
    }

    .status-badge {
        padding: 4px 10px;
        border-radius: 12px;
        font-size: 12px;
        font-weight: bold;
        color: white;
        display: inline-block;
    }

    .status-badge.selesai {
        background-color: #4CAF50;
    }

    .status-badge.pending {
        background-color: #FFC107;
        color: #333;
    }

    .status-badge.dibatalkan {
        background-color: #F44336;
    }

    @media (max-width: 768px) {
        .transaction-item {
            flex-direction: column;
            align-items: stretch;
            gap: 15px;
        }

        .cetak-btn {
            align-self: flex-end;
        }
    }
</style>

<div class="container">
    <h1 class="page-title">Riwayat Pembelian</h1>

    <?php if (!empty($riwayat)): ?>
        <div class="history-container">
            <?php foreach ($riwayat as $r): ?>
                <div class="transaction-item">
                    <div>
                        <div class="transaction-detail">
                            <strong>Tanggal:</strong> <?= date('d M Y', strtotime($r['tanggal_transaksi'])) ?>
                        </div>
                        <div class="transaction-detail">
                            <strong>Total:</strong> Rp<?= number_format($r['total_harga'], 0, ',', '.') ?>
                        </div>
                        <div class="transaction-detail">
                            <strong>Status:</strong>
                            <span class="status-badge <?= strtolower($r['status']) ?>">
                                <?= esc(ucfirst($r['status'])) ?>
                            </span>
                        </div>
                    </div>
                    <button class="cetak-btn" onclick="printTransaction(<?= $r['id'] ?>)">Cetak</button>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <div class="empty-state">
            <div class="empty-state-icon">🛒</div>
            <p>Belum ada transaksi yang dilakukan.</p>
        </div>
    <?php endif; ?>
</div>

<script>
    function printTransaction(idTransaksi) {
        Swal.fire({
            title: 'Cetak Transaksi?',
            text: "PDF akan diunduh setelah konfirmasi.",
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Cetak',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                window.open(`/user/cetak/${idTransaksi}`, '_blank');
            }
        });
    }
</script>


<?= $this->endSection(); ?>