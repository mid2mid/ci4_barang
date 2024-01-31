<?= $this->extend('users/components/print') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
  <div class="row">
    <div class="col-12">
      <h1>Inventory barang</h1>
      <h4>Periode Start :
        <?= empty($filter['start']) ? '-' : $filter['start'] ?>
      </h4>
      <h4>Periode End :
        <?= empty($filter['end']) ? '-' : $filter['end'] ?>
      </h4>
    </div>
    <div class="col-12">
      <table id="" class="table table-bordered table-striped ini_tables">
        <thead>
          <tr>
            <th>No</th>
            <th>Kode</th>
            <th>Nama</th>
            <th>Deksripsi</th>
            <th>Stok</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($data as $i => $v): ?>
          <tr>
            <td>
              <?= $i + 1 ?>
            </td>
            <td>
              <?= $v['kode'] ?>
            </td>
            <td>
              <?= $v['nama'] ?>
            </td>
            <td>
              <?= $v['deskripsi'] ?>
            </td>
            <td>
              <?= $v['stok'] ?>
            </td>
          </tr>
          <?php endforeach ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<?= $this->endSection('content') ?>