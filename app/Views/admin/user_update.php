<?= $this->extend('admin/components/master'); ?>

<?= $this->section('content') ?>
<div class="row">
  <div class="col-12">
    <!-- general form elements -->
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Update User</h3>
      </div>
      <!-- /.card-header -->
      <!-- form start -->
      <form method="post" action="<?= url_to('admin.user.update') ?>" enctype="multipart/form-data">
        <?= csrf_field() ?>
        <input type="hidden" value="<?= $data['id_user'] ?>" name="id_user">
        <div class="card-body">
          <div class="form-group">
            <label>Username</label>
            <input type="text" class="form-control" readonly value="<?= $data['username'] ?>">
          </div>
          <div class="form-group">
            <label>Role</label>
            <input type="text" class="form-control" readonly value="<?= $data['role'] ?>">
          </div>
          <div class="form-group">
            <label>Nama</label>
            <input type="text" class="form-control" name="nama" value="<?= $data['nama'] ?>">
          </div>
          <div class="form-group">
            <label for="exampleInputFile">File input</label>
            <div class="input-group">
              <div class="custom-file">
                <input type="file" class="custom-file-input" id="exampleInputFile" name="gambar">
                <label class="custom-file-label" for="exampleInputFile">Choose file</label>
              </div>
            </div>
          </div>
        </div>

        <div class="form-group px-2">
          <img src="<?= $data['gambar'] ?>" class="rounded d-block" alt="" style="width: 200px; height: 200px;">
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