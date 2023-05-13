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
        <h3 class="card-title">Laporan Penjualan <em>Form</em></h3>

        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
            <i class="fas fa-minus"></i>
          </button>
        </div>
      </div>
      <form action="<?= base_url('PemilikPanel/PrintLaporanPenjualan'); ?>" method="post">
        <div class="card-body">
          <div class="form-group">
            <label for="exampleInputEmail1">Dari Tanggal</label>
            <input type="date" name="val1" id="val1" class="form-control" placeholder="">
          </div>

          <div class="form-group">
            <label for="exampleInputEmail1">Sampai Tanggal</label>
            <input type="date" name="val2" id="val2" class="form-control" placeholder="">
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