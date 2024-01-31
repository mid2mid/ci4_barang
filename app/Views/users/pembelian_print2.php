<?= $this->extend('users/components/print') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
  <div class="row">
    <div class="col-12 mb-3">
      <h1>Data Pembelian</h1>
    </div>
    <div class="col-12">
      <div class="row">
        <div class="col-12 row mb-2">
          <div class="col-2"><b>Customer</b></div>
          <div class="col-1">:</div>
          <div class="col-9">
            <?= $data['nama'] ?? '' ?>
          </div>
        </div>
        <div class="col-12 row mb-2">
          <div class="col-2"><b>No Faktur</b></div>
          <div class="col-1">:</div>
          <div class="col-9">
            <?= $data['faktur'] ?? '' ?>
          </div>
        </div>
        <div class="col-12 row mb-2">
          <div class="col-2"><b>PO</b></div>
          <div class="col-1">:</div>
          <div class="col-9">
            <?= $data['po'] ?? '' ?>
          </div>
        </div>
        <div class="col-12 row mb-2">
          <div class="col-2"><b>Tanggal</b></div>
          <div class="col-1">:</div>
          <div class="col-9">
            <?= $data['faktur_tgl'] ?? '' ?>
          </div>
        </div>
        <div class="col-12 row mb-2">
          <div class="col-2"><b>SubTotal</b></div>
          <div class="col-1">:</div>
          <div class="col-9">
            Rp
            <?= number_format(($data['subtotal'] ?? 0), 0, ",", ".") ?>
          </div>
        </div>
        <div class="col-12 row mb-2">
          <div class="col-2"><b>Total</b></div>
          <div class="col-1">:</div>
          <div class="col-9">
            Rp
            <?= number_format(($data['total'] ?? 0), 0, ",", ".") ?>
          </div>
        </div>
      </div>
      <h3 class="my-2">Rincian Transaksi</h3>
      <table class="table table-bordered">
        <thead>
          <tr>
            <th scope="col">Kode</th>
            <th scope="col">Nama Barang</th>
            <th scope="col">Keterangan</th>
            <th scope="col">Jumlah</th>
            <th scope="col">Harga</th>
            <th scope="col">Total</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($data['item'] ?? [] as $i2 => $v2): ?>
          <tr>
            <td>
              <?= $v2['kode'] ?>
            </td>
            <td>
              <?= $v2['nama'] ?>
            </td>
            <td>
              <?= $v2['keterangan'] ?>
            </td>
            <td>
              <?= $v2['jumlah'] ?>
            </td>
            <td>
              Rp
              <?= number_format($v2['harga'], 0, ",", ".") ?>
            </td>
            <td>
              Rp
              <?= number_format(($v2['harga'] * $v2['jumlah']), 0, ",", ".") ?>
            </td>
          </tr>
          <?php endforeach ?>
          <tr>
            <td colspan="5">Subtotal</td>
            <td>Rp
              <?= number_format($data['subtotal'], 0, ",", ".") ?>
            </td>
          </tr>
          <tr>
            <td colspan="5">Total</td>
            <td>Rp
              <?= number_format($data['total'], 0, ",", ".") ?>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>

<?= $this->endSection('content') ?>