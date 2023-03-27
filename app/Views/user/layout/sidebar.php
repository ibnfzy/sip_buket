<aside class="main-sidebar elevation-4 sidebar-light-pink">
  <!-- Brand Logo -->
  <a href="<?= base_url('AdminPanel'); ?>" class="brand-link bg-pink">
    <span class="brand-text font-weight-light">💐 <strong>Hadifa</strong> Gallery</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar os-host os-theme-light os-host-resize-disabled os-host-scrollbar-horizontal-hidden os-host-transition os-host-overflow os-host-overflow-y">
    <!-- Sidebar user (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <div class="img-bordered border-light elevation-2">
          <i class="fa fa-user-alt"></i>
        </div>
      </div>
      <div class="info">
        <a href="#" class="d-block"><?= $_SESSION['fullname']; ?></a>
      </div>
    </div>

    <!-- SidebarSearch Form -->
    <div class="form-inline">
      <div class="input-group" data-widget="sidebar-search">
        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-sidebar">
            <i class="fas fa-search fa-fw"></i>
          </button>
        </div>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
        <li class="nav-item mb-2">
          <a href="<?= base_url('CustomerPanel'); ?>" class="nav-link <?= $retVal = (url_is('CustomerPanel')) ? 'active' : ''  ?>">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>Home</p>
          </a>
        </li>

        <li class="nav-item mb-2">
          <a href="<?= base_url('CustomerPanel/transaksi'); ?>" class="nav-link <?= $retVal = (url_is('CustomerPanel/transaksi')) ? 'active' : ''  ?>">
            <i class="nav-icon fas fa-dolly"></i>
            <p>Transaksi</p>
          </a>
        </li>

        <li class="nav-item mb-2">
          <a href="<?= base_url('CustomerPanel/informasi'); ?>" class="nav-link <?= $retVal = (url_is('CustomerPanel/informasi')) ? 'active' : ''  ?>"><i class="nav-icon fas fa-id-card"></i>
            <p>Informasi Customer</p>
          </a>
        </li>

      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>