<?= $this->extend('admin/base'); ?>

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
        <h3 class="card-title">Web Setting</h3>

        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
            <i class="fas fa-minus"></i>
          </button>
        </div>
      </div>
      <form action="<?= base_url('AdminPanel/data/' . $data['id_website_setting']); ?>" method="post" enctype="multipart/form-data">
        <input type="hidden" name="_method" value="PUT">
        <div class="card-body">
          <div class="form-group">
            <label for="exampleInputEmail1">Alamat Toko</label>
            <input type="text" name="nama" id="nama" class="form-control" placeholder="" value="<?= $data['alamat_toko']; ?>">
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Kontak Toko</label>
            <input type="text" name="nama" id="nama" class="form-control" placeholder="" value="<?= $data['kontak_toko']; ?>">
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