<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Detail Produk - ObatNih</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #f9f9f9;
      padding-top: 70px;
    }

    .product-image {
      width: 100%;
      max-height: 400px;
      object-fit: contain;
      padding: 10px;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }

    .product-info h2 {
      font-weight: 700;
      margin-bottom: 20px;
    }

    .product-info p {
      margin-bottom: 8px;
      font-size: 15px;
      color: #555;
    }

    .price {
      font-size: 24px;
      font-weight: 700;
      margin-top: 20px;
    }

    .badge-stock {
      font-size: 14px;
      padding: 8px 12px;
    }

    .btn-full {
      width: 100%;
    }

    @media (min-width: 768px) {
      .btn-full {
        max-width: 300px;
      }
    }
  </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top shadow-sm px-4">
  <a class="navbar-brand d-flex align-items-center" href="<?= base_url('/') ?>">
    <img src="<?= base_url('/assets/gambar/logoweb1.png');?>" alt="Logo" style="height: 40px;" class="me-2" />
    ObatNih
  </a>
</nav>

<div class="container mt-5">
  <div class="row align-items-stretch">
    <!-- Gambar Produk -->
    <div class="col-md-6 d-flex justify-content-center">
      <?php $gambar = !empty($obat['gambar_obat']) ? $obat['gambar_obat'] : 'default.jpg'; ?>
      <div class="w-100 h-100 d-flex align-items-center justify-content-center">
        <img src="<?= base_url('/assets/gambar/' . $gambar) ?>" 
             class="img-fluid h-100" 
             style="object-fit: contain; border-radius: 8px; padding: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.1);" 
             alt="<?= esc($obat['nama_obat']) ?>">
      </div>
    </div>

    <!-- Info Produk -->
    <div class="col-md-6 d-flex flex-column justify-content-between">
      <?php if (isset($obat) && $obat): ?>
        <div>
          <h2><?= esc($obat['nama_obat']) ?></h2>

          <!-- Status Stok -->
          <div class="mb-3">
            <?php if($obat['stok'] > 0): ?>
              <span class="badge bg-success badge-stock">
                <i class="fas fa-check-circle"></i> Tersedia (<?= $obat['stok'] ?> unit)
              </span>
            <?php else: ?>
              <span class="badge bg-danger badge-stock">
                <i class="fas fa-times-circle"></i> Stok Habis
              </span>
            <?php endif; ?>
          </div>

          <p><strong>Deskripsi:</strong> <?= esc($obat['deskripsi'] ?? 'Tidak ada deskripsi') ?></p>
          <p><strong>Dosis:</strong> <?= esc($obat['dosis'] ?? 'Tidak tersedia') ?></p>
          <p><strong>Komposisi:</strong> <?= esc($obat['komposisi'] ?? 'Tidak tersedia') ?></p>
          <p><strong>Cara Pakai:</strong> <?= esc($obat['cara_pakai'] ?? 'Tidak tersedia') ?></p>
          <p><strong>Kemasan:</strong> <?= esc($obat['kemasan'] ?? 'Tidak tersedia') ?></p>
          <p><strong>Golongan:</strong> <?= esc($obat['golongan_obat'] ?? 'Tidak tersedia') ?></p>
          <p><strong>Kontraindikasi:</strong> <?= esc($obat['kontra_indikasi'] ?? 'Tidak tersedia') ?></p>
          <p><strong>Efek Samping:</strong> <?= esc($obat['efek_samping'] ?? 'Tidak tersedia') ?></p>

          <div class="price text-success">Rp <?= number_format($obat['harga_satuan'], 0, ',', '.') ?> / pcs</div>
        </div>

        <!-- Form Tambahkan ke Keranjang -->
        <div class="mt-4">
          <?php if($obat['stok'] > 0): ?>
            <form action="<?= base_url('keranjang/tambah') ?>" method="post" class="d-grid gap-2">
              <input type="hidden" name="id_obat" value="<?= $obat['id_obat'] ?>">
              <label for="jumlah" class="form-label">Jumlah:</label>
              <input type="number" name="jumlah" id="jumlah" value="1" min="1" max="<?= $obat['stok'] ?>" class="form-control mb-2" required>

              <button type="submit" class="btn btn-primary w-100">
                <i class="fas fa-shopping-cart"></i> Tambahkan ke Keranjang
              </button>
            </form>
          <?php else: ?>
            <button class="btn btn-secondary w-100" disabled>
              <i class="fas fa-ban"></i> Stok Habis
            </button>
          <?php endif; ?>

          <a href="<?= base_url('user/katalog') ?>" class="btn btn-outline-secondary mt-2 w-100">
            <i class="fas fa-arrow-left"></i> Kembali ke Katalog
          </a>
        </div>
      <?php else: ?>
        <div class="alert alert-danger">
          <h4>Produk Tidak Ditemukan</h4>
          <p>Maaf, produk yang Anda cari tidak tersedia atau telah dihapus.</p>
          <a href="<?= base_url('user/katalog') ?>" class="btn btn-primary">Kembali ke Katalog</a>
        </div>
      <?php endif; ?>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
