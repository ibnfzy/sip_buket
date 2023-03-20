<?= $this->extend('admin/base'); ?>

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
      <form action="<?= base_url('AdminPanel/Corousel/' . $data['id_corousel']); ?>" method="post"
        enctype="multipart/form-data">
        <div class="card-body">
          <div class="form-group">
            <label for="exampleInputEmail1">Judul</label>
            <input type="text" name="header" id="nama" class="form-control" placeholder=""
              value="<?= $data['header']; ?>">
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Link</label>
            <input type="text" name="link" id="nama" class="form-control" placeholder=""
              value="<?= $data['link_to']; ?>">
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Gambar Produk <span class="text-red">* Max FILESIZE <= 2mb (Kosongkan jika
                  tidak ingin merubah gambar)</span></label>
            <?= form_input('file', '', [
              'class' => 'form-control',
              'accept' => 'image/*'
            ], 'file'); ?>
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