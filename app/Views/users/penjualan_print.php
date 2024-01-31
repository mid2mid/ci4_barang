<?= $this->extend('users/components/print') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
  <div class="row">
    <div class="col-12">
      <h1>Data Penjualan</h1>
      <h4>Periode Start :
        <?= empty($filter['start']) ? '-' : $filter['start'] ?>
      </h4>
      <h4>Periode End :
        <?= empty($filter['end']) ? '-' : $filter['end'] ?>
      </h4>
    </div>
    <div class="col-12">
      <table class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>No</th>
            <th>Customer</th>
            <th>Faktur</th>
            <th>Tanggal Faktur</th>
            <th>No PO</th>
            <th>Alamat</th>
            <th>Subtotal</th>
            <th>PPN</th>
            <th>Total</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($data as $i => $v): ?>
          <tr>
            <td>
              <?= $i + 1 ?>
            </td>
            <td>
              <?= $v['nama'] ?>
            </td>
            <td>
              <?= $v['faktur'] ?>
            </td>
            <td>
              <?= $v['faktur_tgl'] ?>
            </td>
            <td>
              <?= $v['po'] ?>
            </td>
            <td>
              <?= $v['alamat'] ?>
            </td>
            <td>
              Rp <?= number_format($v['subtotal'], 0, ",", ".") ?>
            </td>
            <td>
              Rp
              <?= number_format($v['ppn'], 0, ",", ".") ?>
            </td>
            <td>
              Rp
              <?= number_format($v['total'], 0, ",", ".") ?>
            </td>
          </tr>
          <?php endforeach ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<?= $this->endSection('content') ?>