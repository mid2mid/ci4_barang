<?= $this->extend('admin/components/master'); ?>

<?= $this->section('content') ?>
<div class="row">
  <div class="col-12">
    <!-- general form elements -->
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Tambah User</h3>
      </div>
      <!-- /.card-header -->
      <!-- form start -->
      <form method="post" action="<?= url_to('admin.user.tambah') ?>" enctype="multipart/form-data">
        <?= csrf_field() ?>
        <div class="card-body">
          <div class="form-group">
            <label>Nama</label>
            <input type="text" class="form-control" required name="nama">
          </div>
          <div class="form-group">
            <label>Username</label>
            <input type="text" class="form-control" required name="username">
          </div>
          <div class="form-group">
            <label>Role</label>
            <select class="form-control" required name="role">
              <option value='user'>user</option>
              <option value="admin">admin</option>
            </select>
          </div>
          <div class="form-group">
            <label for="exampleInputFile">File input</label>
            <div class="input-group">
              <div class="custom-file">
                <input type="file" class="custom-file-input" id="exampleInputFile" name="gambar" required>
                <label class="custom-file-label" for="exampleInputFile">Choose file</label>
              </div>
            </div>
          </div>
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </form>
    </div>
    <!-- /.card -->
  </div>

</div>
<?= $this->endSection('content') ?>

<?= $this->section('footer') ?>
<?= $this->endSection('footer') ?>