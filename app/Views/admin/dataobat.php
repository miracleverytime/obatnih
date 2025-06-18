<?= $this->extend('layout/TemplateAdpo'); ?>

<?= $this->section('style'); ?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style>
    /* Main Content Styling */
    .main-content {
        background: #f8f9fa;
        min-height: 100vh;
        padding: 30px 25px;
        margin-top: 120px; /* Naikkan dari 100px ke 120px untuk memberikan space lebih */
        transition: all 0.3s ease;
    }

    @media (max-width: 992px) {
        .main-content {
            margin-left: 0; /* sidebar collapse mode */
            margin-top: 100px; /* Untuk mobile, sedikit lebih kecil */
            padding: 20px;
        }
    }

    /* Header Section */
    .overview-wrap {
        background: #ffffff;
        padding: 25px;
        border-radius: 15px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        border: 1px solid #e9ecef;
        margin-bottom: 25px;
        margin-top: 0; /* Hapus margin-top negatif yang menyebabkan masalah */
        display: flex;
        justify-content: space-between;
        align-items: center;
        position: relative; /* Pastikan positioning normal */
    }

    .overview-wrap h1 {
        color: #333;
        font-weight: 700;
        font-size: 2rem;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .overview-wrap h1::before {
        content: '💊';
        font-size: 1.8rem;
    }

    /* Custom Button Styling */
    .btn-primary {
        background: linear-gradient(135deg, #6c757d 0%, #495057 100%);
        border: none;
        border-radius: 10px;
        padding: 12px 25px;
        font-weight: 600;
        transition: all 0.3s ease;
        box-shadow: 0 4px 10px rgba(108, 117, 125, 0.3);
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(108, 117, 125, 0.4);
        background: linear-gradient(135deg, #495057 0%, #343a40 100%);
    }

    /* Table Container */
    .table-container {
        background: #ffffff;
        border-radius: 15px;
        padding: 25px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        border: 1px solid #e9ecef;
        overflow: hidden;
    }

    /* Table Styling */
    #tableObat {
        width: 100% !important;
        border-collapse: separate;
        border-spacing: 0;
    }

    #tableObat thead {
        background: linear-gradient(135deg, #6c757d 0%, #495057 100%);
    }

    #tableObat thead th {
        color: white;
        font-weight: 600;
        text-align: center;
        padding: 15px 12px;
        border: none;
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    #tableObat thead th:first-child {
        border-top-left-radius: 10px;
    }

    #tableObat thead th:last-child {
        border-top-right-radius: 10px;
    }

    #tableObat tbody tr {
        transition: all 0.3s ease;
        border-bottom: 1px solid #f1f3f4;
    }

    #tableObat tbody tr:hover {
        background-color: #f8f9fa;
        transform: scale(1.01);
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    #tableObat tbody td {
        padding: 15px 12px;
        text-align: center;
        vertical-align: middle;
        border: none;
        color: #333;
    }

    #tableObat tbody tr:last-child td:first-child {
        border-bottom-left-radius: 10px;
    }

    #tableObat tbody tr:last-child td:last-child {
        border-bottom-right-radius: 10px;
    }

    /* Action Buttons */
    .btn-warning {
        background: linear-gradient(135deg, #ffc107 0%, #e0a800 100%);
        border: none;
        border-radius: 8px;
        padding: 8px 15px;
        font-size: 0.85rem;
        font-weight: 600;
        margin: 2px;
        transition: all 0.3s ease;
        color: #212529;
    }

    .btn-warning:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(255, 193, 7, 0.4);
        color: #212529;
    }

    .btn-danger {
        background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
        border: none;
        border-radius: 8px;
        padding: 8px 15px;
        font-size: 0.85rem;
        font-weight: 600;
        margin: 2px;
        transition: all 0.3s ease;
    }

    .btn-danger:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(220, 53, 69, 0.4);
    }

    .btn-info {
        background: linear-gradient(135deg, #17a2b8 0%, #138496 100%);
        border: none;
        border-radius: 8px;
        padding: 8px 15px;
        font-size: 0.85rem;
        font-weight: 600;
        margin: 2px;
        transition: all 0.3s ease;
    }

    .btn-info:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(23, 162, 184, 0.4);
    }

    /* Stock Badge Styling */
    .stock-badge {
        display: inline-block;
        padding: 6px 12px;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.85rem;
    }

    .stock-high {
        background: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
    }

    .stock-medium {
        background: #fff3cd;
        color: #856404;
        border: 1px solid #ffeaa7;
    }

    .stock-low {
        background: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
    }

    /* DataTables Custom Styling */
    .dataTables_wrapper .dataTables_length,
    .dataTables_wrapper .dataTables_filter,
    .dataTables_wrapper .dataTables_info,
    .dataTables_wrapper .dataTables_paginate {
        margin: 15px 0;
    }

    .dataTables_wrapper .dataTables_filter input {
        border: 2px solid #e9ecef;
        border-radius: 10px;
        padding: 8px 15px;
        margin-left: 10px;
        transition: all 0.3s ease;
    }

    .dataTables_wrapper .dataTables_filter input:focus {
        border-color: #6c757d;
        box-shadow: 0 0 0 0.2rem rgba(108, 117, 125, 0.25);
        outline: none;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button {
        border-radius: 8px !important;
        margin: 0 2px;
        transition: all 0.3s ease;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button.current {
        background: linear-gradient(135deg, #6c757d 0%, #495057 100%) !important;
        border: 1px solid #6c757d !important;
        color: white !important;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .main-content {
            margin-top: 90px; /* Lebih kecil untuk mobile */
            padding: 15px;
        }

        .overview-wrap {
            flex-direction: column;
            gap: 15px;
            text-align: center;
            padding: 20px;
        }

        .overview-wrap h1 {
            font-size: 1.5rem;
        }

        .table-container {
            padding: 15px;
            overflow-x: auto;
        }

        #tableObat {
            font-size: 0.85rem;
        }

        #tableObat thead th,
        #tableObat tbody td {
            padding: 10px 8px;
        }

        .btn-warning, .btn-danger, .btn-info {
            font-size: 0.75rem;
            padding: 6px 10px;
            margin: 1px;
        }
    }

    @media (max-width: 480px) {
        .main-content {
            margin-top: 80px;
            padding: 10px;
        }

        .overview-wrap {
            padding: 15px;
        }

        .overview-wrap h1 {
            font-size: 1.3rem;
        }
    }

    /* Loading Animation */
    .table-loading {
        text-align: center;
        padding: 50px;
        color: #6c757d;
    }

    .table-loading::before {
        content: '⏳';
        font-size: 2rem;
        display: block;
        margin-bottom: 10px;
    }

    /* Tambahan untuk memastikan tidak overlap dengan navbar fixed */
    .section__content {
        position: relative;
        z-index: 1;
    }
</style>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<!-- MAIN CONTENT-->
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <!-- Hapus style="margin-top: -27px;" yang menyebabkan overlap -->
                    <div class="overview-wrap">
                        <h1>Data Obat</h1>
                        <a href="<?= base_url('admin/ke_obat')?>" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Tambah Obat
                        </a>
                    </div>

                    <div class="table-container">
                        <table id="tableObat" class="table table-striped display">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Obat</th>
                                    <th>Kemasan</th>
                                    <th>Golongan Obat</th>
                                    <th>Stok</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($obat as $o) : ?>
                                <tr>
                                    <td><?= $i++; ?></td>
                                    <td><strong><?= esc($o['nama_obat']); ?></strong></td>
                                    <td><?= esc($o['kemasan']); ?></td>
                                    <td><?= esc($o['golongan_obat']); ?></td>
                                    <td>
                                        <?php 
                                        $stok = (int)$o['stok'];
                                        $class = '';
                                        if ($stok > 50) $class = 'stock-high';
                                        elseif ($stok > 20) $class = 'stock-medium';
                                        else $class = 'stock-low';
                                        ?>
                                        <span class="stock-badge <?= $class ?>"><?= esc($o['stok']); ?></span>
                                    </td>
                                    <td>
                                        <a href="<?= base_url('admin/edit_obat/' . $o['id_obat']); ?>" class="btn btn-warning">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <a href="<?= base_url('admin/delete_obat/' . $o['id_obat']); ?>" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                            <i class="fas fa-trash"></i> Hapus
                                        </a>

                                        <a href="<?= base_url('admin/detail_obat/' . $o['id_obat']); ?>" class="btn btn-info">
                                            <i class="fas fa-eye"></i> Detail
                                        </a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
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

<?= $this->section('script'); ?>
<script>
$(document).ready(function() {
    $('#tableObat').DataTable({
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Indonesian.json"
        },
        "responsive": true,
        "pageLength": 10,
        "order": [[ 0, "asc" ]],
        "columnDefs": [
            { "orderable": false, "targets": 5 }
        ]
    });
});


</script>
<?= $this->endSection(); ?>