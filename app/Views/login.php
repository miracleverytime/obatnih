<?= $this->extend('layout/TemplateLogSign'); ?>


<?= $this->Section('content'); ?>
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
</style>
  <div class="wrapper">
    <header>Masuk</header>
            <?php if(session()->getFlashdata('error')): ?>
          <div class="error-message">
          <?= session()->getFlashdata('error'); ?>
      </div>
    <?php endif; ?>
                <?php if(session()->getFlashdata('success')): ?>
                  <div class="success-message">
                  <?= session()->getFlashdata('success'); ?>
              </div>
            <?php endif; ?>
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