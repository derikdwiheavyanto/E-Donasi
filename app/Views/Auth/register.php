<?= $this->extend('Auth/layout'); ?>
<?= $this->section('content'); ?>

<div class="login-wrapper my-auto">
    <h2 class="login-title mb-4">Register</h2>

    <!-- GLOBAL ERROR MESSAGE -->
    <?php if (session()->getFlashdata('error')) : ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('errors')) : ?>
        <div class="alert alert-danger">
            <ul class="mb-0">
                <?php foreach (session()->getFlashdata('errors') as $error) : ?>
                    <li><?= esc($error) ?></li>
                <?php endforeach ?>
            </ul>
        </div>
    <?php endif; ?>

    <form action="<?= url_to('register') ?>" method="post">
        <?= csrf_field() ?>

        <?php if (in_array('username', $config->validFields)) : ?>
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username"
                    class="form-control <?= session('errors.username') ? 'is-invalid' : '' ?>"
                    value="<?= old('username') ?>" placeholder="Enter username" autocomplete="off">
                <?php if (session('errors.username')) : ?>
                    <div class="invalid-feedback"><?= session('errors.username') ?></div>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <div class="form-group">
            <label for="email">Email address</label>
            <input type="email" id="email" name="email"
                class="form-control <?= session('errors.email') ? 'is-invalid' : '' ?>"
                value="<?= old('email') ?>" placeholder="email@example.com" autocomplete="off">
            <?php if (session('errors.email')) : ?>
                <div class="invalid-feedback"><?= session('errors.email') ?></div>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password"
                class="form-control <?= session('errors.password') ? 'is-invalid' : '' ?>"
                placeholder="Enter password">
            <?php if (session('errors.password')) : ?>
                <div class="invalid-feedback"><?= session('errors.password') ?></div>
            <?php endif; ?>
        </div>

        <div class="form-group mb-4">
            <label for="pass_confirm">Confirm Password</label>
            <input type="password" id="pass_confirm" name="pass_confirm"
                class="form-control <?= session('errors.pass_confirm') ? 'is-invalid' : '' ?>"
                placeholder="Confirm your password">
            <?php if (session('errors.pass_confirm')) : ?>
                <div class="invalid-feedback"><?= session('errors.pass_confirm') ?></div>
            <?php endif; ?>
        </div>

        <button class="btn btn-block login-btn" type="submit">Register</button>
    </form>

    <p class="login-wrapper-footer-text mt-3">
        Already have an account? <a href="<?= url_to('login') ?>" class="text-reset">Login here</a>
    </p>
</div>

<?= $this->endSection(); ?>