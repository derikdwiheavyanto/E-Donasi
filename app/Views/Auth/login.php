<?= $this->extend('Auth/layout'); ?>
<?= $this->section('content'); ?>
<div class="login-wrapper my-auto">
  <h2 class="login-title mb-4">Log in</h2>

  <!-- GLOBAL ERROR MESSAGE -->
  <?= view('Auth/_message_block') ?>

  <form action="<?= url_to('login') ?>" method="post">
    <?= csrf_field() ?>

    <div class="form-group">
      <label for="login"><?= $config->validFields === ['email'] ? 'Email' : 'Email or Username' ?></label>
      <input type="<?= $config->validFields === ['email'] ? 'email' : 'text' ?>" name="login" id="login"
        class="form-control <?= session('errors.login') ? 'is-invalid' : '' ?>"
        placeholder="Enter <?= $config->validFields === ['email'] ? 'email' : 'email or username' ?>"
        value="<?= old('login') ?>" autocomplete="off">
      <?php if (session('errors.login')): ?>
        <div class="invalid-feedback"><?= session('errors.login') ?></div>
      <?php endif; ?>
    </div>

    <div class="form-group mb-4">
      <label for="password">Password</label>
      <input type="password" name="password" id="password"
        class="form-control <?= session('errors.password') ? 'is-invalid' : '' ?>" placeholder="Enter your password"
        autocomplete="off">
      <?php if (session('errors.password')): ?>
        <div class="invalid-feedback"><?= session('errors.password') ?></div>
      <?php endif; ?>
    </div>

    <button type="submit" class="btn btn-block login-btn">Login</button>
  </form>

  <?php if ($config->activeResetter): ?>
    <a href="<?= url_to('forgot') ?>" class="forgot-password-link mt-3 d-block">Forgot password?</a>
  <?php endif; ?>

  <?php if ($config->allowRegistration): ?>
    <p class="login-wrapper-footer-text mt-3">Don't have an account?
      <a href="<?= url_to('register') ?>" class="text-reset">Register here</a>
    </p>
  <?php endif; ?>
</div>
<?= $this->endSection(); ?>