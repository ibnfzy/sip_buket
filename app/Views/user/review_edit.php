<?= $this->extend('user/base'); ?>

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
      <form action="<?= base_url('CustomerPanel/Review'); ?>" method="post">
        <div class="card-body">
          <div class="form-group">
            <label for="exampleInputEmail1">Produk</label>
            <?= form_dropdown('id_produk', $data, $item['id_produk'], [
              'class' => 'form-control'
            ]); ?>
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Nilai (1 sampai 5)</label>
            <input type="number" name="nilai" id="nama" class="form-control" placeholder=""
              value="<?= $item['nilai']; ?>">
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Deskripsi Review</label>
            <?= form_textarea('isi', $item['isi_penilaian'], [
              'class' => 'form-control'
            ]); ?>
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