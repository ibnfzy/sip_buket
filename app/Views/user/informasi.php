<?= $this->extend('user/base'); ?>

<?= $this->section('content'); ?>

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <!-- <h1>Data Website</h1> -->
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Form Informasi Customer</h3>

        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
            <i class="fas fa-minus"></i>
          </button>
        </div>
      </div>
      <form action="<?= base_url('CustomerPanel/informasi/' . $data['id_customer_detail']); ?>" method="post">
        <div class="card-body">
          <div class="form-group">
            <label for="exampleInputEmail1">Kota</label>
            <?= form_dropdown('kota', $ongkir, $data['kota_domisili'] ? $data['kota_domisili'] : '', [
              'class' => 'form-control select2',
            ]); ?>
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Alamat</label>
            <input type="text" name="alamat" id="nama" class="form-control" placeholder="" value="<?= $data['alamat']; ?>">
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Kontak (Nomor HP)</label>
            <input type="text" name="nomor" id="nama" class="form-control" placeholder="" value="<?= $data['nomor_hp']; ?>">
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

<?= $this->section('script'); ?>

<script>
  $('.select2').select2({
    tags: true
  });
</script>

<?= $this->endSection(); ?>