<?= $this->extend('owner/base'); ?>

<?= $this->section('content'); ?>

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <!-- <h1>Data Website</h1> -->
          <!-- <button onclick="history.back()" class="btn bg-pink"><i class="fas fa-arrow-left"></i> Kembali</button> -->
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Laporan Produk <em>Form</em></h3>

        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
            <i class="fas fa-minus"></i>
          </button>
        </div>
      </div>
      <form action="<?= base_url('PemilikPanel/PrintLaporanProduk'); ?>" method="post">
        <div class="card-body">
          <div class="form-group">
            <label for="exampleInputEmail1">Tahun Transaksi</label>
            <select name="date" id="date" class="form-control" required>
              <option value="<?= date('Y'); ?>"><?= date('Y'); ?></option>
              <option value="<?= date('Y', strtotime(date('Y') . ' -1 Year')); ?>">
                <?= date('Y', strtotime(date('Y') . ' -1 Year')); ?></option>
              <option value="<?= date('Y', strtotime(date('Y') . ' -2 Year')); ?>">
                <?= date('Y', strtotime(date('Y') . ' -2 Year')); ?></option>
              <option value="<?= date('Y', strtotime(date('Y') . ' -3 Year')); ?>">
                <?= date('Y', strtotime(date('Y') . ' -3 Year')); ?></option>
              <option value="<?= date('Y', strtotime(date('Y') . ' -4 Year')); ?>">
                <?= date('Y', strtotime(date('Y') . ' -4 Year')); ?></option>
            </select>
          </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
          <button class="btn btn-flat bg-pink">Print</button>
        </div>
      </form>
      <!-- /.card-footer-->
    </div>
    <!-- /.card -->

  </section>
  <!-- /.content -->
</div>

<?= $this->endSection(); ?>