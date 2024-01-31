<?= $this->extend('users/components/master') ?>

<?= $this->section('content') ?>
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Data Penjualan</h1>
</div>

<div class="row">
  <div class="col-12 mb-3">
    <div class="card card-body p-1">
      <a href="<?= url_to('user.penjualan.tambah') ?>" class="btn btn-sm btn-primary" style="width: fit-content;"><i class="fas fa-plus"></i> Tambah penjualan</a>
    </div>
  </div>
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
            <a href="<?= url_to('user.penjualan.print') . '?start=' . $filter['start'] . '&end=' . $filter['end'] ?>" target="_blank" class="btn btn-warning btn-sm d-block">Print</a>
          </div>
        </div>
      </form>
    </div>
  </div>

  <div class="col-12">
    <div class="card">
      <div class="card-body">
        <table class="table table-bordered table-striped ini_tables2">
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
              <th>aksi</th>
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
                  Rp
                  <?= number_format($v['subtotal'], 0, ",", ".") ?>
                </td>
                <td>
                  Rp
                  <?= number_format($v['ppn'], 0, ",", ".") ?>
                </td>
                <td>
                  Rp
                  <?= number_format($v['total'], 0, ",", ".") ?>
                </td>
                <td class="d-flex">
                  <button type="button" class="btn btn-primary btn-sm mr-2" data-toggle="modal" data-target="#modalUpdate_<?= $i + 1 ?>">
                    <i class="fas fa-info"></i>
                  </button>
                  <a href="<?= url_to('user.penjualan.print2') ?>?id=<?= $v['id_transaksi'] ?>" target="_blank" rel="noopener noreferrer" class="btn btn-sm btn-warning mr-2"><i class="fas fa-print"></i></a>
                  <!-- Modal Update penjualan -->
                  <div class="modal fade" id="modalUpdate_<?= $i + 1 ?>" tabindex="-1" aria-labelledby="modalUpdate_<?= $i + 1 ?>Label" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="modalUpdate_<?= $i + 1 ?>Label">Details Penjualan</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <div class="row">
                            <div class="col-12 row mb-2">
                              <div class="col-2"><b>Customer</b></div>
                              <div class="col-1">:</div>
                              <div class="col-9">
                                <?= $v['nama'] ?>
                              </div>
                            </div>
                            <div class="col-12 row mb-2">
                              <div class="col-2"><b>No Faktur</b></div>
                              <div class="col-1">:</div>
                              <div class="col-9">
                                <?= $v['faktur'] ?>
                              </div>
                            </div>
                            <div class="col-12 row mb-2">
                              <div class="col-2"><b>No Faktur</b></div>
                              <div class="col-1">:</div>
                              <div class="col-9">
                                <?= $v['faktur'] ?>
                              </div>
                            </div>
                            <div class="col-12 row mb-2">
                              <div class="col-2"><b>PO</b></div>
                              <div class="col-1">:</div>
                              <div class="col-9">
                                <?= $v['po'] ?>
                              </div>
                            </div>
                            <div class="col-12 row mb-2">
                              <div class="col-2"><b>Tanggal</b></div>
                              <div class="col-1">:</div>
                              <div class="col-9">
                                <?= $v['faktur_tgl'] ?>
                              </div>
                            </div>
                            <div class="col-12 row mb-2">
                              <div class="col-2"><b>Alamat</b></div>
                              <div class="col-1">:</div>
                              <div class="col-9">
                                <?= $v['alamat'] ?>
                              </div>
                            </div>
                            <div class="col-12 row mb-2">
                              <div class="col-2"><b>SubTotal</b></div>
                              <div class="col-1">:</div>
                              <div class="col-9">
                                Rp
                                <?= number_format($v['subtotal'], 0, ",", ".") ?>
                              </div>
                            </div>
                            <div class="col-12 row mb-2">
                              <div class="col-2"><b>PPN 11%</b></div>
                              <div class="col-1">:</div>
                              <div class="col-9">
                                Rp
                                <?= number_format($v['ppn'], 0, ",", ".") ?>
                              </div>
                            </div>
                            <div class="col-12 row mb-2">
                              <div class="col-2"><b>Total</b></div>
                              <div class="col-1">:</div>
                              <div class="col-9">
                                Rp
                                <?= number_format($v['total'], 0, ",", ".") ?>
                              </div>
                            </div>
                          </div>
                          <h3 class="my-2">Rincian Transaksi</h3>
                          <table class="table table-hover">
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
                              <?php foreach ($v['item'] ?? [] as $i2 => $v2): ?>
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
                                    Rp
                                    <?= number_format($v2['jumlah'], 0, ",", ".") ?>
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
                            </tbody>
                          </table>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                      </div>
                    </div>
                  </div>
                  <form action="<?= url_to('user.penjualan.index') ?>" method="post">
                    <?= csrf_field() ?>
                    <input type="hidden" name="_method" value="DELETE">
                    <input type="hidden" name="id_transaksi" value="<?= $v['id_transaksi'] ?>">
                    <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                  </form>
                </td>
              </tr>
            <?php endforeach ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<!-- Modal Tambah penjualan -->
<div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="modalTambahLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalTambahLabel">Tambah penjualan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" action="<?= url_to('user.penjualan.index') ?>" enctype="multipart/form-data">
        <?= csrf_field() ?>
        <div class="modal-body">
          <div class="form-group">
            <label>Kode penjualan</label>
            <input type="text" class="form-control" required value="111" name="kode" maxlength="50">
          </div>
          <div class="form-group">
            <label>Nama penjualan</label>
            <input type="text" class="form-control" required value="111" name="nama" maxlength="50">
          </div>
          <div class="form-group">
            <label>Alamat penjualan</label>
            <input type="text" class="form-control" required value="111" name="alamat" maxlength="1000">
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