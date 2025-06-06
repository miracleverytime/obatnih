<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>ObatNih - Dashboard</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    html, body {
      height: 100%;
      margin: 0;
    }

    body {
      display: flex;
      flex-direction: column;
      min-height: 100vh;
      font-family: 'Poppins', sans-serif;
      background-color: #f9f9f9;
    }

    main {
      flex: 1;
    }

    .navbar-brand img {
      height: 40px;
    }

    .card-title {
      font-size: 14px;
      margin-top: 10px;
      color: #333;
    }

    footer {
      background: #f1f1f1;
      padding: 10px 0;
      text-align: center;
    }
  </style>
</head>
<body>

<!-- Header / Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light px-4 py-2 shadow-sm">
  <a class="navbar-brand d-flex align-items-center" href="#">
    <img src="/assets/gambar/logoweb1.png" alt="Logo" class="me-2">
    <strong>ObatNih</strong>
  </a>
  <form class="d-flex mx-3" style="flex: 1; max-width: 400px;">
    <input class="form-control me-2" type="search" placeholder="Cari..." aria-label="Search">
  </form>
  <ul class="navbar-nav ms-auto">
    <li class="nav-item"><a class="nav-link" href="#">Home</a></li>
    <li class="nav-item"><a class="nav-link" href="#">Profile</a></li>
    <li class="nav-item"><a class="nav-link" href="#">Riwayat</a></li>
    <li class="nav-item"><a class="nav-link" href="#">Bantuan</a></li>
    <li class="nav-item">
      <a class="btn btn-dark" href="#"><i class="fa fa-shopping-cart"></i> Keranjang</a>
    </li>
  </ul>
</nav>

<!-- Main: Katalog Produk -->
<main class="container mt-5">
  <div class="row">
    <h1>Ini Apoteker</h1>
  </div>
</main>

<!-- Footer -->
<footer>
  <div class="container">
    <small>&copy; <?= date('Y') ?> ObatNih — Kelompok 4</small>
  </div>
</footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
