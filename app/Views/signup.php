<?= $this->extend('layout/TemplateLogSign'); ?>


<?= $this->Section('content'); ?>
<style>
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
    background-color: #f8d7da;
    border: 1px solid #f5c6cb;
    color:rgb(44, 140, 31);
    padding: 10px 15px;
    border-radius: 10px;
    margin-bottom: 1rem;
    font-size: 0.875rem;
    }
</style>
  <div class="wrapper">
    <header>Buat Akun</header>
        <?php if(session()->getFlashdata('error')): ?>
          <div class="error-message">
          <?= session()->getFlashdata('error'); ?>
      </div>
    <?php endif; ?>
    <form action="<?= base_url('signup/submit') ?>" method="post">
      <div class="field nama">
        <div class="input-area">
          <input type="text" placeholder="Nama Lengkap" name="nama"/>
        </div>
        <div class="error error-txt">Nama tidak boleh kosong</div>
      </div>

      <div class="field phone">
        <div class="input-area">
          <input type="number" name="no_hp" placeholder="No. Telepon" />
        </div>
        <div class="error error-txt">No. telepon tidak boleh kosong</div>
      </div>

      <div class="field email">
        <div class="input-area">
          <input type="email" placeholder="Email" name="email" />
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

      <!-- Field Verify Password Baru -->
      <div class="field verify-password">
        <div class="input-area">
          <input type="password" placeholder="Konfirmasi Password" name="verify_password" id="verify-password" autocomplete="off"/>
          <span class="password-toggle" id="toggleVerifyPassword">
            <i class="fas fa-eye"></i>
          </span>
        </div>
        <div class="error error-txt">Konfirmasi password tidak boleh kosong</div>
      </div>

      <div class="field dob">
        <label for="dob-input" style="padding-right: 300px;">Tanggal Lahir</label>
        <div class="input-area">
          <input type="date" id="dob-input" name="tanggal_lahir" style="color: #d1c6c6;" />
        </div>
        <div class="error error-txt">Tanggal Lahir tidak boleh kosong</div>
      </div>
      <input type="submit" value="Sign up" />
    </form>

    <div class="sign-txt">
      Sudah Punya Akun? <a href="<?= base_url('login') ?>">Masuk Sekarang</a>
    </div>
  </div>
<?= $this->endSection(); ?>