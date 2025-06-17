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
  <header>Reset Password</header>
  <p class="text-muted mb-3" style="font-size: 14px;">Masukkan password baru Anda</p>

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

  <form action="<?= base_url('proses/reset-password') ?>" method="post">
    <?= csrf_field() ?>
    <input type="hidden" name="token" value="<?= $token ?>">

    <div class="field password">
      <div class="input-area position-relative">
        <input type="password" id="password" name="password" placeholder="Password Baru" required minlength="6">
        <span class="password-toggle" onclick="togglePasswordVisibility('password')">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
            <path d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zM12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z"/>
          </svg>
        </span>
      </div>
    </div>

    <div class="field password mt-3">
      <div class="input-area position-relative">
        <input type="password" id="confirm_password" name="confirm_password" placeholder="Konfirmasi Password" required minlength="6">
        <span class="password-toggle" onclick="togglePasswordVisibility('confirm_password')">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
            <path d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zM12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z"/>
          </svg>
        </span>
      </div>
    </div>

    <input type="submit" value="Reset Password" class="mt-3" />

    <div class="sign-txt mt-3">
      <a href="<?= base_url('login') ?>"><i class="fas fa-arrow-left"></i> Kembali ke Login</a>
    </div>
  </form>
</div>

<script>
function togglePasswordVisibility(fieldId) {
  const field = document.getElementById(fieldId);
  field.type = field.type === 'password' ? 'text' : 'password';
}
</script>

<?= $this->endSection(); ?>
