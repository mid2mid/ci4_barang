<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin Login</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/plugins/adminlte/css/adminlte.min.css">
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <!-- Toastr -->
  <link rel="stylesheet" href="/plugins/toastr/toastr.min.css">
</head>

<body class="hold-transition login-page">
  <!-- <body class="hold-transition login-page" style="background: url('/uploads/bg2.jpg') no-repeat center center fixed; background-size:cover;"> -->
  <div class="login-box">
    <!-- <div class="login-logo">
      <a href="/index2.html"><b>Admin</b>LTE</a>
    </div> -->
    <!-- /.login-logo -->
    <div class="card">
      <div class="card-body login-card-body">
        <p class="login-box-msg"><b>Panel Login Admin</b></p>
        <form action="<?= url_to('admin.login.index') ?>" method="post">
          <?= csrf_field() ?>
          <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Username" name="username" required>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-user"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" class="form-control" placeholder="Password" name="password" required>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-8">
            </div>
            <!-- /.col -->
            <div class="col-4">
              <button type="submit" class="btn btn-primary btn-block">Login</button>
            </div>
            <!-- /.col -->
          </div>
        </form>

        <div class="social-auth-links text-center mb-3">
          <p>- OR -</p>
          <a href="<?= url_to('user.login.index') ?>" class="btn btn-block btn-primary">
            Login Sebagai User
          </a>
        </div>
        <!-- /.social-auth-links -->

        <p class="mb-1">

          <a href="#">ada kendala silakan hubungi operator</a>
        </p>
      </div>
      <!-- /.login-card-body -->
    </div>
  </div>
  <!-- /.login-box -->

  <!-- jQuery -->
  <script src="/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="/plugins/adminlte/js/adminlte.min.js"></script>
  <!-- SweetAlert2 -->
  <script src="/plugins/sweetalert2/sweetalert2.min.js"></script>
  <!-- Toastr -->
  <script src="/plugins/toastr/toastr.min.js"></script>
  <script>
    var Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000
    });
    //   Toast.fire({
    //     icon: 'success',
    //     title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
    //   })

    <?php if (!empty($message)): ?>
      <?php if ($message['status'] == 'success'): ?>
        Swal.fire({
          icon: 'success',
          showConfirmButton: false,
          timer: 1500,
          title: '<?= $message['pesan'] ?? "" ?>'
        })
      <?php else: ?>
        Swal.fire({
          icon: 'error',
          showConfirmButton: false,
          timer: 1500,
          title: '<?= $message['pesan'] ?? "" ?>'
        })
      <?php endif ?>
    <?php endif ?>
    $(function () {
      // $(document).Toasts('create', {
      //   title: '',
      //   position: 'topLeft',
      //   body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      // })
    });
  </script>
</body>

</html>