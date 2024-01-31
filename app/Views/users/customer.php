<?= $this->extend('users/components/master') ?>

<?= $this->section('content') ?>
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Data Customer</h1>
</div>

<div class="row">
  <div class="col-12 mb-3">
    <div class="card card-body p-1">
      <a href="#" class="btn btn-sm btn-primary" style="width: fit-content;" data-toggle="modal" data-target="#modalTambah"><i class="fas fa-plus"></i> Tambah Customer</a>
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
            <a href="<?= url_to('user.customer.print') . '?start=' . $filter['start'] . '&end=' . $filter['end'] ?>" target="_blank" class="btn btn-warning btn-sm d-block">Print</a>
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
              <th>Nama</th>
              <th>Alamat</th>
              <th style="width: fit-content;">aksi</th>
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
                <?= $v['alamat'] ?>
              </td>
              <td class="d-flex">
                <button type="button" class="btn btn-primary btn-sm mr-2" data-toggle="modal" data-target="#modalUpdate_<?= $i + 1 ?>">
                  <i class="fas fa-edit"></i>
                </button>
                <!-- Modal Update Customer -->
                <div class="modal fade" id="modalUpdate_<?= $i + 1 ?>" tabindex="-1" aria-labelledby="modalUpdate_<?= $i + 1 ?>Label" aria-hidden="true">
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="modalUpdate_<?= $i + 1 ?>Label">Update Customer</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <form method="post" action="<?= url_to('user.customer.index') ?>" enctype="multipart/form-data">
                        <input type="hidden" name="_method" value="PUT">
                        <input type="hidden" name="id_customer" value="<?= $v['id_customer'] ?>">
                        <?= csrf_field() ?>
                        <div class="modal-body">
                          <div class="form-group">
                            <label>Kode Customer</label>
                            <input type="text" class="form-control" value="<?= $v['kode'] ?>" maxlength="50" readonly>
                          </div>
                          <div class="form-group">
                            <label>Nama Customer</label>
                            <input type="text" class="form-control" required value="<?= $v['nama'] ?>" name="nama" maxlength="50">
                          </div>
                          <div class="form-group">
                            <label>Alamat Customer</label>
                            <input type="text" class="form-control" required value="<?= $v['alamat'] ?>" name="alamat" maxlength="1000">
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
                <form action="<?= url_to('user.customer.index') ?>" method="post">
                  <?= csrf_field() ?>
                  <input type="hidden" name="_method" value="DELETE">
                  <input type="hidden" name="id_customer" value="<?= $v['id_customer'] ?>">
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

<!-- Modal Tambah Customer -->
<div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="modalTambahLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalTambahLabel">Tambah Customer</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" action="<?= url_to('user.customer.index') ?>" enctype="multipart/form-data">
        <?= csrf_field() ?>
        <div class="modal-body">
          <div class="form-group">
            <label>Kode Customer</label>
            <input type="text" class="form-control" required name="kode" maxlength="50">
          </div>
          <div class="form-group">
            <label>Nama Customer</label>
            <input type="text" class="form-control" required name="nama" maxlength="50">
          </div>
          <div class="form-group">
            <label>Alamat Customer</label>
            <input type="text" class="form-control" required name="alamat" maxlength="1000">
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