<?= $this->extend('layout/layout'); ?>

<?= $this->section('content'); ?>

<h1 class="mt-4"><?= $title; ?></h1>
<ol class="breadcrumb mb-4">
  <li class="breadcrumb-item active">Dashboard</li>
</ol>
<div class="input-group rounded w-50">
  <input type="search" class="form-control rounded" placeholder="Search" aria-label="Search" aria-describedby="search-addon" />
</div>
<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">No</th>
      <th scope="col">Invoice</th>
      <th scope="col">Masuk pada</th>
      <th scope="col">Donatur</th>
      <th scope="col">Keterangan</th>
      <th scope="col">Nominal</th>
      <th scope="col">Channel</th>
      <th scope="col">Status</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">1</th>
      <td>ID12</td>
      <td>12/12/12</td>
      <td>subali</td>
      <td>Masjid</td>
      <td>1.000,000</td>
      <td>BCA</td>
      <td>Sukses</td>
    </tr>
    <tr>
      <th scope="row">2</th>
      <td>ID12</td>
      <td>12/12/12</td>
      <td>subali</td>
      <td>Masjid</td>
      <td>1.000,000</td>
      <td>BCA</td>
      <td>Sukses</td>
    </tr>
    <tr>
      <th scope="row">3</th>
      <td>ID12</td>
      <td>12/12/12</td>
      <td>subali</td>
      <td>Masjid</td>
      <td>1.000,000</td>
      <td>BCA</td>
      <td>Sukses</td>
    </tr>
    <tr>
      <th scope="row">3</th>
      <td>ID12</td>
      <td>12/12/12</td>
      <td>subali</td>
      <td>Masjid</td>
      <td>1.000,000</td>
      <td>BCA</td>
      <td>Sukses</td>
    </tr>
    <tr>
      <th scope="row">3</th>
      <td>ID12</td>
      <td>12/12/12</td>
      <td>subali</td>
      <td>Masjid</td>
      <td>1.000,000</td>
      <td>BCA</td>
      <td>Sukses</td>
    </tr>
    <tr>
      <th scope="row">3</th>
      <td>ID12</td>
      <td>12/12/12</td>
      <td>subali</td>
      <td>Masjid</td>
      <td>1.000,000</td>
      <td>BCA</td>
      <td>Sukses</td>
    </tr>
    <tr>
      <th scope="row">3</th>
      <td>ID12</td>
      <td>12/12/12</td>
      <td>subali</td>
      <td>Masjid</td>
      <td>1.000,000</td>
      <td>BCA</td>
      <td>Sukses</td>
    </tr>
  </tbody>
</table>
<?= $this->endSection(); ?>