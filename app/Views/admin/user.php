<?= $this->extend('admin/components/master'); ?>

<?= $this->section('content') ?>
<div class="row">
  <div class="col-12 mb-3">
    <div class="card card-body p-1">
      <a href="<?= url_to('admin.user.tambah') ?>" class="btn btn-primary btn-sm" style="width: 100px;">tambah user</a>
    </div>
  </div>
  <div class="col-12">
    <div class="card">
      <div class="card-body">
        <table id="example1" class="table table-bordered table-striped ini_tables no-wrap">
          <thead>
            <tr>
              <th>No</th>
              <th>Nama</th>
              <th>Username</th>
              <th>Role</th>
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
                <?= $v['username'] ?>
              </td>
              <td>
                <?= $v['role'] ?>
              </td>
              <td class="d-flex">
                <a href="<?= url_to('admin.user.update') ?>?id=<?= $v['id_user'] ?>" class="btn btn-sm btn-info m-1">update</a>
                <form action="<?= url_to('admin.user.delete') ?>" method="post">
                  <?= csrf_field() ?>
                  <input type="hidden" name="id_user" value="<?= $v['id_user'] ?>">
                  <button type="submit" class="btn btn-sm btn-danger m-1">hapus</button>
                </form>
                <form action="<?= url_to('admin.user.reset') ?>" method="post">
                  <?= csrf_field() ?>
                  <input type="hidden" name="id_user" value="<?= $v['id_user'] ?>">
                  <button type="submit" class="btn btn-sm btn-warning m-1">reset</button>
                </form>
              </td>
            </tr>
            <?php endforeach ?>
          </tbody>
          </tfoot>
        </table>
      </div>
    </div>
  </div>
</div>
<?= $this->endSection('content') ?>

<?= $this->section('footer') ?>
<?= $this->endSection('footer') ?>