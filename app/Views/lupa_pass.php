<?= $this->extend('layout/TemplateLogSign'); ?>

<?= $this->section('content'); ?>
<style>
  .wrapper {
    width: 380px;
  }
</style>

<div class="wrapper">
  <header>Lupa Password</header>
  <form action="<?= base_url('login') ?>" method="get">
    
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
