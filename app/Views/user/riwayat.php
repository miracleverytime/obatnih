<?= $this->extend('layout/templateUser') ?>
<?= $this->section('content'); ?>
  <!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Pembelian</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
        }

        .wrapper {
    min-height: 100%;
    display: flex;
    flex-direction: column;
}

.container {
    flex: 1;
}

.footer {
    background-color: #333;
    color: white;
    text-align: center;
    padding: 15px 0;
    font-size: 14px;
}

        .header {
            background-color: white;
            padding: 10px 20px;
            border-bottom: 1px solid #ddd;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .logo-icon {
            width: 30px;
            height: 30px;
            background-color: #ccc;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .search-bar {
            padding: 8px 15px;
            border: 1px solid #ddd;
            border-radius: 20px;
            width: 250px;
            outline: none;
        }

        .nav-menu {
            display: flex;
            gap: 20px;
            align-items: center;
        }

        .nav-item {
            color: #666;
            text-decoration: none;
            padding: 5px 10px;
            transition: color 0.3s;
        }

        .nav-item:hover {
            color: #333;
        }

        .nav-item.active {
            color: #333;
            font-weight: bold;
        }

        .cart-btn {
            background-color: #666;
            color: white;
            padding: 8px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .container {
            max-width: 800px;
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
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
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

        @media (max-width: 768px) {
            .header {
                flex-wrap: wrap;
                gap: 10px;
            }
            
            .nav-menu {
                display: none;
            }
            
            .search-bar {
                width: 200px;
            }
            
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
</head>
<body>
    <div class="container">
        <h1 class="page-title">Riwayat Pembelian</h1>
        
        <div class="history-container">
            <div class="transaction-item">
                <span class="transaction-detail">DETAIL TRANSAKSI.....</span>
                <button class="cetak-btn" onclick="printTransaction(1)">Cetak</button>
            </div>
            
            <div class="transaction-item">
                <span class="transaction-detail">DETAIL TRANSAKSI.....</span>
                <button class="cetak-btn" onclick="printTransaction(2)">Cetak</button>
            </div>
            
            <div class="transaction-item">
                <span class="transaction-detail">DETAIL TRANSAKSI.....</span>
                <button class="cetak-btn" onclick="printTransaction(3)">Cetak</button>
            </div>
            
            <div class="transaction-item">
                <span class="transaction-detail">DETAIL TRANSAKSI.....</span>
                <button class="cetak-btn" onclick="printTransaction(4)">Cetak</button>
            </div>
        </div>
    </div>

<?= $this->endSection(); ?>
