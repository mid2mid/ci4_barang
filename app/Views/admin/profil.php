<?= $this->extend('admin/components/master') ?>

<?= $this->section('content') ?>
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Data Pembelian</h1>
</div>

<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-body">
        <form method="post" action="<?= url_to('admin.profil.index') ?>" enctype="multipart/form-data">
          <?= csrf_field() ?>
          <input type="hidden" value="<?= $data['id_user'] ?>" name="id_user">
          <div class="form-group">
            <label>Username</label>
            <input type="text" class="form-control" value="<?= $data['username'] ?>" readonly>
          </div>
          <div class="form-group">
            <label>Nama</label>
            <input type="text" class="form-control" required value="<?= $data['nama'] ?>" name="nama" maxlength="100">
          </div>
          <div class="form-group">
            <label>Password</label>
            <input type="password" class="form-control" name="password">
          </div>
          <div class="form-group">
            <label for="exampleInputFile">Foto Profil</label>
            <div class="input-group">
              <div class="custom-file">
                <input type="file" class="custom-file-input" id="exampleInputFile" name="gambar">
                <label class="custom-file-label" for="exampleInputFile">Choose file</label>
              </div>
            </div>
          </div>
          <button type="submit" class="btn btn-sm btn-primary">simpan</button>
        </form>
      </div>
    </div>
  </div>
</div>

<?= $this->endSection('content') ?>