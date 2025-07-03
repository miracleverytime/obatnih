<?= $this->extend('layout/TemplateAdpo'); ?>
<?= $this->section('content'); ?>

<style>
    /* CSS untuk Laporan Penjualan - Tema Monokrom */

    /* Main Content Styling */
    .main-content {
        background-color: #f8f9fa;
        min-height: 100vh;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .section__content {
        padding: 20px;
    }

    .section__content--p30 {
        padding: 30px;
    }

    .container-fluid {
        max-width: 100%;
        padding: 0 15px;
    }

    /* Header Styling */
    .overview-wrap {
        margin-bottom: 30px;
        padding: 20px 0;
        border-bottom: 2px solid #dee2e6;
    }

    .overview-wrap h1 {
        color: #212529;
        font-size: 2.5rem;
        font-weight: 600;
        margin: 0;
        text-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
    }

    /* Container Styling */
    .container {
        background-color: #ffffff;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        padding: 30px;
        margin-top: 20px;
        border: 1px solid #e9ecef;
    }

    /* Table Styling */
    #tableLaporan {
        width: 100%;
        border-collapse: collapse;
        background-color: #ffffff;
        margin: 0;
        font-size: 14px;
    }

    #tableLaporan thead {
        background: linear-gradient(135deg, #343a40 0%, #495057 100%);
        color: #ffffff;
    }

    #tableLaporan thead th {
        padding: 15px 12px;
        text-align: left;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 12px;
        letter-spacing: 0.5px;
        border: none;
        position: relative;
    }

    #tableLaporan thead th:first-child {
        border-top-left-radius: 6px;
    }

    #tableLaporan thead th:last-child {
        border-top-right-radius: 6px;
    }

    /* Table Body Styling */
    #tableLaporan tbody tr {
        transition: background-color 0.2s ease;
        border-bottom: 1px solid #e9ecef;
    }

    #tableLaporan tbody tr:nth-child(even) {
        background-color: #f8f9fa;
    }

    #tableLaporan tbody tr:nth-child(odd) {
        background-color: #ffffff;
    }

    #tableLaporan tbody tr:hover {
        background-color: #e9ecef;
        transform: translateY(-1px);
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    #tableLaporan tbody td {
        padding: 12px;
        color: #495057;
        vertical-align: middle;
        border: none;
    }

    /* Nomor urut styling */
    #tableLaporan tbody td:first-child {
        font-weight: 600;
        color: #6c757d;
        text-align: center;
        width: 60px;
    }

    /* Nama customer styling */
    #tableLaporan tbody td:nth-child(2) {
        font-weight: 500;
        color: #212529;
    }

    /* Tanggal styling */
    #tableLaporan tbody td:nth-child(3) {
        color: #6c757d;
        font-family: 'Courier New', monospace;
        padding-right: 30px;
        min-width: 150px;
        text-align: center;
    }

    /* Total harga styling */
    #tableLaporan tbody td:nth-child(4) {
        font-weight: 600;
        color: #212529;
        text-align: right;
        font-family: 'Courier New', monospace;
    }

    /* Empty state styling */
    .text-center {
        text-align: center;
        color: #6c757d;
        font-style: italic;
        padding: 40px 12px;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .overview-wrap h1 {
            font-size: 2rem;
        }

        .container {
            padding: 20px 15px;
            margin: 10px;
        }

        #tableLaporan {
            font-size: 12px;
        }

        #tableLaporan thead th,
        #tableLaporan tbody td {
            padding: 8px 6px;
        }

        #tableLaporan thead th {
            font-size: 11px;
        }
    }

    @media (max-width: 576px) {
        .section__content--p30 {
            padding: 15px;
        }

        .overview-wrap h1 {
            font-size: 1.5rem;
        }

        .container {
            margin: 5px;
            padding: 15px 10px;
        }

        #tableLaporan thead th,
        #tableLaporan tbody td {
            padding: 6px 4px;
        }
    }

    /* Print Styles */
    @media print {
        .main-content {
            background-color: white;
        }

        .container {
            box-shadow: none;
            border: 1px solid #000;
        }

        #tableLaporan thead {
            background: #000 !important;
            color: white !important;
        }

        #tableLaporan tbody tr:hover {
            background-color: transparent;
            transform: none;
            box-shadow: none;
        }
    }

    /* Additional utility classes */
    .table-striped tbody tr:nth-of-type(odd) {
        background-color: #f8f9fa;
    }

    .table-striped tbody tr:nth-of-type(even) {
        background-color: #ffffff;
    }

    .display {
        width: 100%;
    }
</style>

<!-- MAIN CONTENT-->
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="overview-wrap" style="margin-top: -27px;">
                        <h1>Laporan Penjualan</h1>
                    </div>

                    <div class="container mt-4">
                        <table id="tableLaporan" class="table table-striped display">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Customer</th>
                                    <th>Tanggal Transaksi</th>
                                    <th>Total Harga</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($transaksi)) : ?>
                                    <?php $i = 1;
                                    foreach ($transaksi as $t) : ?>
                                        <tr>
                                            <td><?= $i++; ?></td>
                                            <td><?= esc($t['nama_user']); ?></td>
                                            <td><?= esc($t['tanggal_transaksi']); ?></td>
                                            <td>Rp<?= number_format($t['total_harga'], 0, ',', '.'); ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <tr>
                                        <td colspan="4" class="text-center">Belum ada transaksi.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- END MAIN CONTENT-->

<?= $this->endSection(); ?>