<?= $this->extend('owner/base'); ?>

<?= $this->section('content'); ?>

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <!-- <h1>Data Website</h1> -->
          <button onclick="history.back()" class="btn bg-pink"><i class="fas fa-arrow-left"></i> Kembali</button>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Form</h3>

        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
            <i class="fas fa-minus"></i>
          </button>
        </div>
      </div>
      <form action="<?= base_url('PemilikPanel/Admin'); ?>" method="post">
        <div class="card-body">
          <div class="form-group">
            <label>Fullname</label>
            <?= form_input('fullname', '', [
              'class' => 'form-control',
              'placeholder' => 'Masukkan nama lengkap'
            ]); ?>
          </div>

          <div class="form-group">
            <label>Username</label>
            <?= form_input('username', '', [
              'class' => 'form-control',
              'placeholder' => 'Masukkan Username'
            ]); ?>
          </div>

          <div class="form-group">
            <label>Password</label>
            <?= form_input('password', '', [
              'class' => 'form-control',
              'placeholder' => 'Masukkan Password'
            ], 'password'); ?>
          </div>

          <div class="form-group">
            <label>Konfirmasi Password</label>
            <?= form_input('konfirmasiPassword', '', [
              'class' => 'form-control',
              'placeholder' => 'Konfirmasi Password'
            ], 'password'); ?>
          </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
          <button class="btn btn-flat bg-pink">Save</button>
        </div>
      </form>
      <!-- /.card-footer-->
    </div>
    <!-- /.card -->

  </section>
  <!-- /.content -->
</div>

<?= $this->endSection(); ?>