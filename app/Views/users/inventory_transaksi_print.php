<?= $this->extend('users/components/print') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
  <div class="row">
    <div class="col-12">
      <h1>Inventory Barang Transaksi</h1>
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
            <th>Transaksi</th>
            <th>Jumlah</th>
            <th>Stok Awal</th>
            <th>Stok Akhir</th>
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
              <?= $v['tipe'] ?>
            </td>
            <td>
              <?= $v['jumlah'] ?>
            </td>
            <td>
              <?= $v['stok_awal'] ?>
            </td>
            <td>
              <?= $v['stok_akhir'] ?>
            </td>
          </tr>
          <?php endforeach ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<?= $this->endSection('content') ?>