<?= $this->extend('layout/TemplateAdpo'); ?>

<?= $this->section('content'); ?>

<style>
/* CSS untuk Form Edit Obat - Tema Monokrom */

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
    text-shadow: 0 1px 2px rgba(0,0,0,0.1);
}

/* Container Styling */
.container {
    background-color: #ffffff;
    border-radius: 12px;
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
    padding: 40px;
    margin-top: 20px;
    border: 1px solid #e9ecef;
}

/* Form Styling */
form {
    max-width: 800px;
    margin: 0 auto;
}

/* Label Styling */
label {
    display: block;
    margin-bottom: 8px;
    color: #495057;
    font-weight: 600;
    font-size: 14px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

/* Input Styling */
.form-control {
    width: 100%;
    padding: 12px 16px;
    border: 1px solid #adb5bd;
    border-radius: 4px;
    font-size: 14px;
    color: #212529;
    background-color: #f8f9fa;
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    box-sizing: border-box;
}

.form-control:focus {
    outline: none;
    border-color: #6c757d;
    box-shadow: 0 0 0 2px rgba(108, 117, 125, 0.2);
    background-color: #e9ecef;
}

.form-control:hover {
    border-color: #6c757d;
    background-color: #e9ecef;
}

/* Textarea Styling */
textarea.form-control {
    resize: vertical;
    min-height: 100px;
    font-family: inherit;
}

/* Input File Styling */
input[type="file"].form-control {
    padding: 8px 12px;
    border: 1px solid #adb5bd;
    background-color: #f8f9fa;
    cursor: pointer;
}

input[type="file"].form-control:hover {
    border-color: #6c757d;
    background-color: #e9ecef;
}

/* Input Number Styling */
input[type="number"].form-control {
    -moz-appearance: textfield;
}

input[type="number"].form-control::-webkit-outer-spin-button,
input[type="number"].form-control::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
}

/* Form Group Styling */
.mb-3 {
    margin-bottom: 24px;
}

/* Button Styling */
.btn {
    padding: 12px 24px;
    border: none;
    border-radius: 6px;
    font-size: 14px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    cursor: pointer;
    transition: all 0.3s ease;
    text-decoration: none;
    display: inline-block;
    margin-right: 12px;
    margin-top: 20px;
}

.btn-primary {
    background: linear-gradient(135deg, #495057 0%, #343a40 100%);
    color: #ffffff;
    box-shadow: 0 4px 8px rgba(52, 58, 64, 0.3);
}

.btn-primary:hover {
    background: linear-gradient(135deg, #343a40 0%, #212529 100%);
    transform: translateY(-2px);
    box-shadow: 0 6px 12px rgba(52, 58, 64, 0.4);
}

.btn-secondary {
    background-color: #6c757d;
    color: #ffffff;
    box-shadow: 0 4px 8px rgba(108, 117, 125, 0.3);
}

.btn-secondary:hover {
    background-color: #5a6268;
    transform: translateY(-2px);
    box-shadow: 0 6px 12px rgba(108, 117, 125, 0.4);
    text-decoration: none;
    color: #ffffff;
}

.btn:active {
    transform: translateY(0);
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
}

/* Form Animation */
form {
    animation: fadeInUp 0.6s ease-out;
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Input Focus Animation */
.form-control {
    position: relative;
}

.form-control:focus + label,
.form-control:not(:placeholder-shown) + label {
    transform: translateY(-8px);
    font-size: 12px;
    color: #6c757d;
}

/* Responsive Design */
@media (max-width: 768px) {
    .overview-wrap h1 {
        font-size: 2rem;
    }
    
    .container {
        padding: 25px 20px;
        margin: 10px;
    }
    
    form {
        max-width: 100%;
    }
    
    .btn {
        width: 100%;
        margin-bottom: 10px;
        margin-right: 0;
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
        padding: 20px 15px;
    }
    
    .form-control {
        padding: 10px 12px;
        font-size: 13px;
    }
    
    label {
        font-size: 13px;
    }
}

/* Error State */
.form-control:invalid {
    border-color: #6c757d;
}

.form-control:invalid:focus {
    border-color: #495057;
    box-shadow: 0 0 0 2px rgba(108, 117, 125, 0.2);
}

/* Success State */
.form-control:valid {
    border-color: #adb5bd;
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
    
    .btn {
        display: none;
    }
}

/* Additional Form Enhancements */
.form-control::placeholder {
    color: #adb5bd;
    opacity: 1;
}

.form-control:disabled {
    background-color: #e9ecef;
    opacity: 1;
    cursor: not-allowed;
}

/* Grid Layout for Buttons */
.button-group {
    display: flex;
    gap: 12px;
    justify-content: flex-start;
    margin-top: 30px;
}

@media (max-width: 576px) {
    .button-group {
        flex-direction: column;
        gap: 8px;
    }
}
</style>

<!-- MAIN CONTENT -->
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="overview-wrap" style="margin-top: -27px;">
                        <h1>Edit Obat</h1>
                    </div> 

                    <div class="container mt-4">
                        <form action="<?= base_url('admin/update/' . $obat['id_obat']) ?>" method="post" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="nama_obat">Nama Obat</label>
                                <input type="text" name="nama_obat" id="nama_obat" class="form-control" value="<?= esc($obat['nama_obat']) ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="deskripsi">Deskripsi</label>
                                <textarea name="deskripsi" id="deskripsi" class="form-control" required><?= esc($obat['deskripsi']) ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="dosis">Dosis</label>
                                <input type="text" name="dosis" id="dosis" class="form-control" value="<?= esc($obat['dosis']) ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="komposisi">Komposisi</label>
                                <input type="text" name="komposisi" id="komposisi" class="form-control" value="<?= esc($obat['komposisi']) ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="cara_pakai">Cara Pakai</label>
                                <input type="text" name="cara_pakai" id="cara_pakai" class="form-control" value="<?= esc($obat['cara_pakai']) ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="kemasan">Kemasan</label>
                                <input type="text" name="kemasan" id="kemasan" class="form-control" value="<?= esc($obat['kemasan']) ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="golongan_obat">Golongan Obat</label>
                                <input type="text" name="golongan_obat" id="golongan_obat" class="form-control" value="<?= esc($obat['golongan_obat']) ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="kontra_indikasi">Kontraindikasi</label>
                                <input type="text" name="kontra_indikasi" id="kontra_indikasi" class="form-control" value="<?= esc($obat['kontra_indikasi']) ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="efek_samping">Efek Samping</label>
                                <input type="text" name="efek_samping" id="efek_samping" class="form-control" value="<?= esc($obat['efek_samping']) ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="stok">Stok</label>
                                <input type="number" name="stok" id="stok" class="form-control" value="<?= esc($obat['stok']) ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="gambar_obat">Ganti Gambar (kosongkan jika tidak ingin diubah)</label>
                                <input type="file" name="gambar_obat" id="gambar_obat" class="form-control" accept="image/*">
                            </div>
                            
                            <div class="button-group">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <a href="<?= base_url('admin/dataobat') ?>" class="btn btn-secondary">Batal</a>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- END MAIN CONTENT -->

<?= $this->endSection(); ?>