<!DOCTYPE html>
<html>

<head>
    <title>Cetak Transaksi</title>
    <style>
        @media print {
            body {
                margin: 0;
                padding: 20px;
            }

            .no-print {
                display: none;
            }
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding: 30px;
            background-color: #f8f9fa;
            color: #333;
            line-height: 1.5;
        }

        .receipt-container {
            max-width: 600px;
            margin: 0 auto;
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px;
            text-align: center;
        }

        .header h1 {
            margin: 0;
            font-size: 28px;
            font-weight: 300;
            letter-spacing: 1px;
        }

        .header .subtitle {
            margin-top: 8px;
            font-size: 14px;
            opacity: 0.9;
        }

        .content {
            padding: 40px;
        }

        .transaction-details {
            background: #f8f9fa;
            border-radius: 8px;
            padding: 25px;
            border-left: 4px solid #667eea;
        }

        .detail-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 0;
            border-bottom: 1px solid #e9ecef;
        }

        .detail-row:last-child {
            border-bottom: none;
            margin-top: 10px;
            padding-top: 20px;
            border-top: 2px solid #667eea;
        }

        .detail-label {
            font-weight: 600;
            color: #495057;
            font-size: 15px;
        }

        .detail-value {
            font-weight: 500;
            color: #212529;
            font-size: 15px;
        }

        .total-price {
            font-size: 18px !important;
            font-weight: 700 !important;
            color: #28a745 !important;
        }

        .status {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 600;
            text-transform: uppercase;
        }

        .status.lunas {
            background-color: #d4edda;
            color: #155724;
        }

        .status.pending {
            background-color: #fff3cd;
            color: #856404;
        }

        .status.batal {
            background-color: #f8d7da;
            color: #721c24;
        }

        .footer {
            text-align: center;
            padding: 20px;
            color: #6c757d;
            font-size: 13px;
            border-top: 1px solid #e9ecef;
        }

        .print-info {
            margin-top: 15px;
            font-size: 12px;
        }

        /* Print specific styles */
        @media print {
            body {
                background-color: white;
                padding: 10px;
            }

            .receipt-container {
                box-shadow: none;
                border-radius: 0;
            }

            .header {
                background: #667eea !important;
                -webkit-print-color-adjust: exact;
                color-adjust: exact;
            }
        }
    </style>
</head>

<body onload="window.print()">
    <div class="receipt-container">
        <div class="header">
            <h1>STRUK TRANSAKSI</h1>
            <div class="subtitle">Bukti Pembayaran Resmi</div>
        </div>

        <div class="content">
            <div class="transaction-details">
                <div class="detail-row">
                    <span class="detail-label">ID Transaksi</span>
                    <span class="detail-value"><?= $transaksi->id ?></span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Tanggal Transaksi</span>
                    <span class="detail-value"><?= date('d M Y', strtotime($transaksi->tanggal_transaksi)) ?></span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Nama Pelanggan</span>
                    <span class="detail-value"><?= $user->nama ?></span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Email</span>
                    <span class="detail-value"><?= $user->email ?></span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Alamat</span>
                    <span class="detail-value"><?= $user->alamat ?></span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Status Pembayaran</span>
                    <span class="detail-value">
                        <span class="status <?= strtolower($transaksi->status) ?>">
                            <?= ucfirst($transaksi->status) ?>
                        </span>
                    </span>
                </div>

                <div class="detail-row">
                    <span class="detail-label">Total Pembayaran</span>
                    <span class="detail-value total-price">
                        Rp <?= number_format($transaksi->total_harga, 0, ',', '.') ?>
                    </span>
                </div>
            </div>
        </div>

        <div class="footer">
            <div>Terima kasih atas kepercayaan Anda</div>
            <div class="print-info">
                Dicetak pada: <?= date('d M Y H:i:s') ?>
            </div>
        </div>
    </div>
</body>

</html>