<?= $this->extend('users/components/master') ?>

<?= $this->section('content') ?>
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Tambah Pembelian</h1>
</div>

<div class="row">
  <div class="col-12 mb-3">
    <div class="card card-body">
      <form method="post" action="<?= url_to('user.pembelian.tambah') ?>" id="form_post">
        <?= csrf_field() ?>
        <div class="form-group">
          <label>Customer</label>
          <select class="form-control select2 select2-danger" data-dropdown-css-class="select2-danger" style="width: 100%;" name="id_customer" required>
            <?php foreach ($customer as $i => $v): ?>
            <option value="<?= $v['id_customer'] ?>"><?= $v['kode'] . ' - ' . $v['nama'] ?></option>
            <?php endforeach ?>
          </select>
        </div>
        <div class="form-group">
          <label>No Faktur</label>
          <input type="text" class="form-control" required name="faktur" maxlength="1000">
        </div>
        <div class="form-group">
          <label>po</label>
          <input type="text" class="form-control" required name="po" maxlength="1000">
        </div>
        <div class="form-group">
          <label>Tanggal Faktur</label>
          <input type="date" class="form-control" required value="<?= $date ?>" name="faktur_tgl">
        </div>
        <h3 class="my-2">Rincian Transaksi</h3>
        <button type="button" class="btn btn-sm btn-primary btn_tambah mb-2"><i class="fas fa-plus"></i></button>
        <table class="table table-hover" id="item_post">
          <thead>
            <tr>
              <th scope="col">Barang</th>
              <th scope="col">Keterangan</th>
              <th scope="col">Jumlah</th>
              <th scope="col">Harga</th>
              <th scope="col"></th>
            </tr>
          </thead>
          <tbody>
            <tr class="total_wrap" data-jumlah="0" data-harga="0">
              <td>
                <select class="form-control select2 select2-danger" data-dropdown-css-class="select2-danger" style="width: 100%;" name="id_barang[]" required>
                  <?php foreach ($barang as $i => $v): ?>
                  <option value="<?= $v['id_barang'] ?>"><?= $v['kode'] . ' - ' . $v['nama'] ?></option>
                  <?php endforeach ?>
                </select>
              </td>
              <td>
                <input type="text" class="form-control" required name="keterangan[]" maxlength="1000">
              </td>
              <td>
                <input type="number" class="form-control total_trigger input_jumlah" required name="jumlah[]">
              </td>
              <td>
                <input type="number" class="form-control total_trigger input_harga" required name="harga[]">
              </td>
              <td>
                <button type="button" class="btn btn-sm btn-danger btn_hapus"><i class="fas fa-trash"></i></button>
              </td>
            </tr>
            <tr>
              <td colspan="3">Subtotal</td>
              <td colspan="2" id="subtotal">Rp 0</td>
            </tr>
            <tr>
              <td colspan="3">Total</td>
              <td colspan="2" id="total">Rp 0</td>
            </tr>
          </tbody>
        </table>
        <button type="submit" class="btn btn-primary">Tambah</button>
      </form>
    </div>
  </div>
</div>
<?= $this->endSection('content') ?>

<?= $this->section('footer') ?>
<script>
$(document).on('click', '.btn_hapus', function(e) {
  $(this).parent().parent().remove()
})
$(document).on('keyup', '.total_trigger', function(e) {
  var total = 0;
  var input = 0
  var input2 = 0
  $("#item_post tr td .input_jumlah").each(function(i, v) {
    input = $(this).val();
    if (input == '') {
      input = 0
    }
    // console.log(input)
    $("#item_post tr td .input_harga").each(function(i2, v2) {
      if (i == i2) {
        input2 = $(this).val();
        if (input2 == '') {
          input2 = 0
        }
        // console.log(input2)
      }
    });
    total = (input * input2) + total
  });
  let html = `Rp ${total}`
  $('#subtotal').html(html)
  $('#total').html(html)
})
$(document).on('click', '.btn_tambah', function(e) {
  let html = `
              <tr class="total_wrap" data-jumlah="0" data-harga="0">
              <td>
                <select class="form-control select2 select2-danger" data-dropdown-css-class="select2-danger" style="width: 100%;" name="id_barang[]" required>
                  <?php foreach ($barang as $i => $v): ?>
                                                                                <option value="<?= $v['id_barang'] ?>"><?= $v['kode'] . ' - ' . $v['nama'] ?></option>
                  <?php endforeach ?>
                </select>
              </td>
              <td>
                <input type="text" class="form-control" required name="keterangan[]" maxlength="1000">
              </td>
              <td>
                <input type="number" class="form-control total_trigger input_jumlah" required name="jumlah[]">
              </td>
              <td>
                <input type="number" class="form-control total_trigger input_harga" required name="harga[]">
              </td>
              <td>
                <button type="button" class="btn btn-sm btn-danger btn_hapus"><i class="fas fa-trash"></i></button>
              </td>
            </tr>`
  $('#item_post tbody').prepend(function() {
    return html
  })
})
</script>
<?= $this->endSection('content') ?>