<?= $this->extend('layout/TemplateLogSign'); ?>

<?= $this->section('content'); ?>
<style>
  .wrapper {
    width: 380px;
  }

  .error-message {
    background-color: #f8d7da;
    border: 1px solid #f5c6cb;
    color: #721c24;
    padding: 10px 15px;
    border-radius: 10px;
    margin-bottom: 1rem;
    font-size: 0.875rem;
  }

  .success-message {
    background-color: #d4edda;
    border: 1px solid #c3e6cb;
    color: #155724;
    padding: 10px 15px;
    border-radius: 10px;
    margin-bottom: 1rem;
    font-size: 0.875rem;
  }
</style>

<div class="wrapper">
  <header>Lupa Password</header>
  <form action="<?= base_url('proses/forgot') ?>" method="post">
    <?= csrf_field() ?>

    <?php if (session()->getFlashdata('error')): ?>
      <div class="error-message">
        <?= session()->getFlashdata('error'); ?>
      </div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('success')): ?>
      <div class="success-message">
        <?= session()->getFlashdata('success'); ?>
      </div>
    <?php endif; ?>

    <div class="field email">
      <div class="input-area">
        <input type="email" name="email" placeholder="Masukkan Email" autocomplete="off" required />
      </div>
      <div class="error error-txt">Email tidak boleh kosong</div>
    </div>

    <input type="submit" value="Kirim Link Reset" />

    <div class="sign-txt mt-3">
      <a href="<?= base_url('login') ?>"><i class="fas fa-arrow-left"></i> Kembali ke Login</a>
    </div>

  </form>
</div>

<?= $this->endSection(); ?>