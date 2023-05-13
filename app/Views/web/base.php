<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Hadinafa Gallery | Home</title>

  <!-- Font awesome -->
  <link href="<?= base_url(''); ?>/css/font-awesome.css" rel="stylesheet">
  <!-- Bootstrap -->
  <link href="<?= base_url(''); ?>/css/bootstrap.css" rel="stylesheet">
  <!-- SmartMenus jQuery Bootstrap Addon CSS -->
  <link href="<?= base_url(''); ?>/css/jquery.smartmenus.bootstrap.css" rel="stylesheet">
  <!-- Product view slider -->
  <link rel="stylesheet" type="text/css" href="<?= base_url(''); ?>/css/jquery.simpleLens.css">
  <!-- slick slider -->
  <link rel="stylesheet" type="text/css" href="<?= base_url(''); ?>/css/slick.css">
  <!-- price picker slider -->
  <link rel="stylesheet" type="text/css" href="<?= base_url(''); ?>/css/nouislider.css">
  <!-- Theme color -->
  <link id="switcher" href="<?= base_url(''); ?>/css/theme-color/default-theme.css" rel="stylesheet">
  <!-- <link id="switcher" href="<?= base_url(''); ?>/css/theme-color/bridge-theme.css" rel="stylesheet"> -->
  <!-- Top Slider CSS -->
  <link href="<?= base_url(''); ?>/css/sequence-theme.modern-slide-in.css" rel="stylesheet" media="all">

  <script src="<?= base_url(''); ?>/swal/dist/sweetalert2.min.js"></script>
  <link rel="stylesheet" href="<?= base_url(''); ?>/swal/dist/sweetalert2.min.css">
  <link rel="stylesheet" href="<?= base_url('/'); ?>/toastr/build/toastr.min.css">

  <!-- Main style sheet -->
  <link href="<?= base_url(''); ?>/css/style.css" rel="stylesheet">

  <!-- Google Font -->
  <link href='https://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>


  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

  <style>
    .pagination .active a {
      background-color: #ff6666;
      color: white !important;
    }
  </style>

</head>

<body>
  <!-- wpf loader Two -->

  <div id="wpf-loader-two">
    <div class="wpf-loader-two-inner">
      <span>Loading</span>
    </div>
  </div>
  <!-- / wpf loader Two -->
  <!-- SCROLL TOP BUTTON -->
  <a class="scrollToTop" href="#"><i class="fa fa-chevron-up"></i></a>
  <!-- END SCROLL TOP BUTTON -->


  <?= $this->include('web/layout/navbar'); ?>
  <!-- / menu -->

  <?= $this->renderSection('content'); ?>

  <!-- footer -->
  <?= $this->include('web/layout/footer'); ?>
  <!-- / footer -->

  <!-- Login Modal -->
  <div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-body">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4>Login or Register</h4>
          <form class="aa-login-form" action="">
            <label for="">Username or Email address<span>*</span></label>
            <input type="text" placeholder="Username or email">
            <label for="">Password<span>*</span></label>
            <input type="password" placeholder="Password">
            <button class="aa-browse-btn" type="submit">Login</button>
            <label for="rememberme" class="rememberme"><input type="checkbox" id="rememberme"> Remember me </label>
            <p class="aa-lost-password"><a href="#">Lost your password?</a></p>
            <div class="aa-register-now">
              Don't have an account?<a href="account.html">Register now!</a>
            </div>
          </form>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div>

  <!-- jQuery library -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="<?= base_url(''); ?>/js/bootstrap.js"></script>
  <!-- SmartMenus jQuery plugin -->
  <script type="text/javascript" src="<?= base_url(''); ?>/js/jquery.smartmenus.js"></script>
  <!-- SmartMenus jQuery Bootstrap Addon -->
  <script type="text/javascript" src="<?= base_url(''); ?>/js/jquery.smartmenus.bootstrap.js"></script>
  <!-- To Slider JS -->
  <script src="<?= base_url(''); ?>/js/sequence.js"></script>
  <script src="<?= base_url(''); ?>/js/sequence-theme.modern-slide-in.js"></script>
  <!-- Product view slider -->
  <script type="text/javascript" src="<?= base_url(''); ?>/js/jquery.simpleGallery.js"></script>
  <script type="text/javascript" src="<?= base_url(''); ?>/js/jquery.simpleLens.js"></script>
  <!-- slick slider -->
  <script type="text/javascript" src="<?= base_url(''); ?>/js/slick.js"></script>
  <!-- Price picker slider -->
  <script type="text/javascript" src="<?= base_url(''); ?>/js/nouislider.js"></script>
  <script src="<?= base_url('/'); ?>/toastr/build/toastr.min.js"></script>
  <!-- Custom js -->
  <script src="<?= base_url(''); ?>/js/custom.js"></script>
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