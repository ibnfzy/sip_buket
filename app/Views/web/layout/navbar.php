<!-- Start header section -->
<header id="aa-header">
  <?php $cart = \Config\Services::cart(); ?>
  <!-- start header top  -->
  <div class="aa-header-top">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="aa-header-top-area">
            <!-- start header top left -->
            <div class="aa-header-top-left">
              <!-- start language -->
              <div class="aa-language">
                <div class="dropdown">

                </div>
              </div>
              <!-- / language -->

              <!-- start currency -->
              <div class="aa-currency">
                <div class="dropdown">

                </div>
              </div>
              <!-- / currency -->
              <!-- start cellphone -->
              <div class="cellphone hidden-xs">
                <!-- <p><span class="fa fa-phone"></span>00-62-658-658</p> -->
              </div>
              <!-- / cellphone -->
            </div>
            <!-- / header top left -->
            <div class="aa-header-top-right">
              <ul class="aa-head-top-nav-right">
                <li><a href="<?= base_url('CustomerPanel'); ?>">Customer Panel</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- / header top  -->

  <!-- start header bottom  -->
  <div class="aa-header-bottom">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="aa-header-bottom-area">
            <!-- logo  -->
            <div class="aa-logo">
              <!-- Text based logo -->
              <a href="index.html">

                <p>💐 <strong>Hadinafa</strong> Gallery</p>
              </a>
              <!-- img based logo -->
              <!-- <a href="index.html"><img src="<?= base_url(''); ?>/img/logo.jpg" alt="logo img"></a> -->
            </div>
            <!-- / logo  -->
            <!-- cart box -->
            <div class="aa-cartbox">
              <a class="aa-cart-link" href="<?= base_url('Keranjang'); ?>">
                <span class="fa fa-shopping-basket"></span>
                <span class="aa-cart-title">Keranjang</span>
                <span class="aa-cart-notify"><?= $cart->totalItems(); ?></span>
              </a>
            </div>
            <!-- / cart box -->
            <!-- search box -->

            <!-- / search box -->
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- / header bottom  -->
</header>
<!-- / header section -->
<!-- menu -->
<section id="menu">
  <div class="container">
    <div class="menu-area">
      <!-- Navbar -->
      <div class="navbar navbar-default" role="navigation">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        </div>
        <div class="navbar-collapse collapse">
          <!-- Left nav -->
          <ul class="nav navbar-nav">
            <li><a href="<?= base_url(); ?>">Home</a></li>
            <li><a href="<?= base_url('Produk'); ?>">Produk Kami</a></li>
          </ul>
        </div>
        <!--/.nav-collapse -->
      </div>
    </div>
  </div>
</section>