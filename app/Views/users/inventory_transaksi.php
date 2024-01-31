<?= $this->extend('users/components/master') ?>

<?= $this->section('content') ?>
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Data Inventory Transaksi</h1>
</div>

<div class="row">
  <div class="col-12 mb-3">
    <div class="card card-body p-1">
      <form method="get">
        <div class="row">
          <div class="col-6">
            <div class="form-group">
              <label>Start Date</label>
              <input type="date" class="form-control" value="<?= $filter['start'] ?>" name="start">
            </div>
          </div>
          <div class="col-6">
            <div class="form-group">
              <label>End Date</label>
              <input type="date" class="form-control" value="<?= $filter['end'] ?>" name="end">
            </div>
          </div>
          <div class="col-6">
            <button type="submit" class="btn btn-primary btn-sm w-100">Filter</button>
          </div>
          <div class="col-6">
            <a href="<?= url_to('user.inventory.transaksi.print') . '?start=' . $filter['start'] . '&end=' . $filter['end'] ?>" target="_blank" class="btn btn-warning btn-sm d-block">Print</a>
          </div>
        </div>
      </form>
    </div>
  </div>
  <div class="col-12">
    <div class="card">
      <div class="card-body">
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
</div>

<!-- Modal Tambah barang -->
<div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="modalTambahLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalTambahLabel">Tambah barang</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" action="<?= url_to('user.inventory.barang') ?>" enctype="multipart/form-data">
        <?= csrf_field() ?>
        <div class="modal-body">
          <div class="form-group">
            <label>Kode Barang</label>
            <input type="text" class="form-control" required name="kode" maxlength="25">
          </div>
          <div class="form-group">
            <label>Nama Barang</label>
            <input type="text" class="form-control" required name="nama" maxlength="1000">
          </div>
          <div class="form-group">
            <label>Deskripsi Barang</label>
            <input type="text" class="form-control" required name="deskripsi" maxlength="1000">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Tambah</button>
        </div>
      </form>
    </div>
  </div>
</div>
<?= $this->endSection('content') ?>