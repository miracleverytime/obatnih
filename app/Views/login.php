<?= $this->extend('layout/TemplateLogSign'); ?>


<?= $this->Section('content'); ?>
<style>
  .wrapper {
  width: 380px;
}
</style>
  <div class="wrapper">
    <header>Masuk</header>
    <form action="<?= base_url('login/cek') ?>" method="post">
      <div class="field email">
        <div class="input-area">
          <input type="email" placeholder="Masukan Email" name="email" autocomplete="off" />
        </div>
        <div class="error error-txt">Email tidak boleh kosong</div>
      </div>
    
      <div class="field password">
        <div class="input-area">
          <input type="password" placeholder="Masukan Password" name="password" id="password" autocomplete="off"/>
          <span class="password-toggle" id="togglePassword">
            <i class="fas fa-eye"></i>
          </span>
        </div>
        <div class="error error-txt">Password tidak boleh kosong</div>
      </div>

      <div class="pass-txt"><a href="<?= base_url('forgot') ?>">Lupa Password?</a></div>
      <input type="submit" value="Log in" />
    </form>
    <div class="sign-txt">
      Belum Punya Akun? <a href="<?= base_url('signup') ?>">Buat Sekarang</a>
    </div>
  </div>
<?= $this->endSection(''); ?>