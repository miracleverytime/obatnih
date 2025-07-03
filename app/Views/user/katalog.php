<?= $this->extend('layout/TemplateUser'); ?>
<?= $this->section('content'); ?>

<style>
  .card-obat {
    border-radius: 12px;
    border: 1px solid #e0e0e0;
    transition: all 0.3s ease-in-out;
  }

  .card-obat:hover {
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.07);
    transform: translateY(-4px);
  }

  .catalog-img {
    height: 200px;
    object-fit: contain;
    padding: 12px;
    border-bottom: 1px solid #f0f0f0;
  }

  .card-body h6 {
    font-size: 16px;
    font-weight: 600;
    margin-bottom: 8px;
    color: #333;
  }

  .card-body p {
    font-size: 14px;
    margin: 0;
  }

  .harga {
    color: #28a745;
    font-weight: 600;
    font-size: 15px;
  }

  .detail-btn {
    margin-top: 12px;
  }
</style>

<main class="container mt-4 mb-5">
  <div class="row">
    <?php if (session()->getFlashdata('success')): ?>
      <script>
        Swal.fire({
          icon: 'success',
          title: 'Berhasil!',
          text: '<?= session()->getFlashdata('success'); ?>',
          confirmButtonColor: '#3085d6',
          confirmButtonText: 'OK'
        });
      </script>
    <?php endif; ?>
    <?php if (!empty($obat)): ?>
      <?php foreach ($obat as $item): ?>
        <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
          <div class="card card-obat h-100 d-flex flex-column">
            <?php $gambar = !empty($item['gambar_obat']) ? $item['gambar_obat'] : 'default.jpg'; ?>
            <img src="<?= base_url('/assets/gambar/' . $gambar) ?>" class="catalog-img mx-auto d-block" alt="<?= esc($item['nama_obat']) ?>">
            <div class="card-body text-center d-flex flex-column">
              <h6><?= esc($item['nama_obat']) ?></h6>
              <p><strong>Kemasan:</strong> <?= esc($item['kemasan']) ?></p>
              <p class="harga">Rp <?= number_format($item['harga_satuan'], 0, ',', '.') ?></p>
              <a href="<?= base_url('user/detail_produk/' . $item['id_obat']) ?>" class="btn btn-outline-primary btn-sm detail-btn w-100">
                <i class="fas fa-info-circle"></i> Detail
              </a>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    <?php else: ?>
      <div class="col-12">
        <div class="alert alert-info text-center">
          <h5>Belum ada produk obat tersedia</h5>
          <p>Silakan coba lagi nanti.</p>
        </div>
      </div>
    <?php endif; ?>
  </div>
</main>

<?= $this->endSection(); ?>