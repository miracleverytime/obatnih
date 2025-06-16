<?= $this->extend('layout/TemplateApoteker'); ?>
<?= $this->section('content'); ?>
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


<!-- Main: Katalog Produk -->
<main class="container mt-5">
  <div class="row">
    <h1>Ini Apoteker</h1>
  </div>
</main>

<?= $this->endSection(); ?>
