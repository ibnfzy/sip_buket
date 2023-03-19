<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Hadifa Gallery | Log in</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url(''); ?>/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?= base_url(''); ?>/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <script src="<?= base_url(''); ?>/swal/dist/sweetalert2.min.js"></script>
  <link rel="stylesheet" href="<?= base_url(''); ?>/swal/dist/sweetalert2.min.css">
  <link rel="stylesheet" href="<?= base_url('/'); ?>/toastr/build/toastr.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url(''); ?>/dist/css/adminlte.min.css">
</head>

<body class="hold-transition login-page">
  <div class="login-box">
    <div class="login-logo">
      <a href="<?= base_url('/'); ?>"><b>Hadifa </b>Gallery</a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
      <div class="card-body login-card-body">
        <!-- <p class="login-box-msg">Sign in to start your session</p> -->

        <form action="<?= base_url('Auth/Customer'); ?>" method="post">
          <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="username" name="username">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" class="form-control" placeholder="Password" name="password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <!-- /.col -->
            <div class="col-12">
              <button type="submit" class="btn btn-primary btn-block">Login Sebagai Customer</button>
            </div>
            <!-- /.col -->
          </div>
        </form>
        <hr>
        <!-- /.social-auth-links -->


        <p class="mb-0">
          <a href="<?= base_url('Auth/Customer/Registration'); ?>" class="text-center">Belum punya akun? silahkan daftar
            disini!</a>
        </p>
      </div>
      <!-- /.login-card-body -->
    </div>
  </div>
  <!-- /.login-box -->

  <!-- jQuery -->
  <script src="<?= base_url(''); ?>/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="<?= base_url(''); ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?= base_url('/'); ?>/toastr/build/toastr.min.js"></script>
  <!-- AdminLTE App -->
  <script src="<?= base_url(''); ?>/dist/js/adminlte.min.js"></script>

  <?= $this->renderSection('script'); ?>

  <script>
  toastr.options = {
    "closeButton": false,
    "debug": false,
    "newestOnTop": true,
    "progressBar": true,
    "positionClass": "toast-top-right",
    "preventDuplicates": false,
    "showDuration": "600",
    "hideDuration": "1000",
    "timeOut": "5000",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
  }
  </script>

  <?php ?>

  <?php
  if (session()->getFlashdata('dataMessage')) {
    foreach (session()->getFlashdata('dataMessage') as $item) {
      echo '<script>toastr["' .
        session()->getFlashdata('type-status') . '"]("' . $item . '")</script>';
    }
  }
  if (session()->getFlashdata('message')) {
    echo '<script>toastr["' .
      session()->getFlashdata('type-status') . '"]("' . session()->getFlashdata('message') . '")</script>';
  }
  ?>
</body>

</html>