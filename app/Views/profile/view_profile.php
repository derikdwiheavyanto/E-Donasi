<?= $this->extend('layout/layout'); ?>
<?= $this->section('content'); ?>

<div class="container mt-5">
  <div class="container position-relative ">
    <h2 class="mb-4">Profil Saya</h2>
    <button type="button" class="btn btn-primary mb-3 position-absolute top-0 end-0" data-bs-toggle="modal" data-bs-target="#editProfileModal">
      Edit Profil
    </button>
  </div>

  <!-- ✅ NOTIFIKASI SUCCESS -->
  <?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success">
      <?= session('success') ?>
    </div>
  <?php endif; ?>

  <!-- ❌ NOTIFIKASI ERROR VALIDASI -->
  <?php if (session()->getFlashdata('errors')): ?>
    <div class="alert alert-danger">
      <ul class="mb-0">
        <?php foreach (session('errors') as $error): ?>
          <li><?= esc($error) ?></li>
        <?php endforeach; ?>
      </ul>
    </div>
  <?php endif; ?>

  <table class="table table-borderless">
    <tr><th>Username</th><td><?= esc($user->username); ?></td></tr>
    <tr><th>Email</th><td><?= esc($user->email); ?></td></tr>
    <tr><th>No HP / WhatsApp</th><td><?= esc($user->phone ?? '-'); ?></td></tr>
    <tr><th>Alamat</th><td><?= esc($user->address ?? '-'); ?></td></tr>
    <tr><th>Tanggal Bergabung</th><td><?= date('d M Y', strtotime($user->created_at)); ?></td></tr>
    <tr>
      <th>Total Donasi</th>
      <td>Rp. <?= number_format($totalDonasi, 0, ',', '.'); ?></td>
    </tr>
    <tr>
      <th>Donasi Terakhir</th>
      <td>
        <?php if ($donasiTerakhir): ?>
          <?= date('d M Y', strtotime($donasiTerakhir['created_at'])); ?> - Rp. <?= number_format($donasiTerakhir['nominal'], 0, ',', '.'); ?>
        <?php else: ?>
          Belum ada donasi
        <?php endif; ?>
      </td>
    </tr>
  </table>

  <!-- ✅ MODAL EDIT PROFIL -->
  <div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <form action="<?= site_url('/donatur/profile/update') ?>" method="post">
          <div class="modal-header">
            <h5 class="modal-title" id="editProfileModalLabel">Edit Profil</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>

          <div class="modal-body">
            <?= csrf_field() ?>

            <div class="mb-3">
              <label for="username" class="form-label">Username</label>
              <input type="text" class="form-control <?= session('errors.username') ? 'is-invalid' : '' ?>" id="username" name="username" value="<?= old('username', $user->username) ?>" required>
            </div>

            <div class="mb-3">
              <label for="email" class="form-label">Email</label>
              <input type="email" class="form-control <?= session('errors.email') ? 'is-invalid' : '' ?>" id="email" name="email" value="<?= old('email', $user->email) ?>" required>
            </div>

            <div class="mb-3">
              <label for="password" class="form-label">Password (Kosongkan jika tidak ingin mengganti)</label>
              <input type="password" class="form-control <?= session('errors.password') ? 'is-invalid' : '' ?>" id="password" name="password">
            </div>

            <div class="mb-3">
              <label for="phone" class="form-label">No HP / WhatsApp</label>
              <input type="text" class="form-control <?= session('errors.phone') ? 'is-invalid' : '' ?>" id="phone" name="phone" value="<?= old('phone', $user->phone) ?>">
            </div>

            <div class="mb-3">
              <label for="address" class="form-label">Alamat</label>
              <textarea class="form-control <?= session('errors.address') ? 'is-invalid' : '' ?>" id="address" name="address" rows="3"><?= old('address', $user->address) ?></textarea>
            </div>
          </div>

          <div class="modal-footer">
            <button type="submit" class="btn btn-success">Simpan</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<?= $this->endSection(); ?>
