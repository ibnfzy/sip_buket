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
      <form action="<?= base_url('AdminPanel/Produk/' . $produk['id_produk']); ?>" method="post"
        enctype="multipart/form-data">
        <input type="hidden" name="_method" value="PUT">
        <div class="card-body">
          <div class="form-group">
            <label for="exampleInputEmail1">Nama Produk</label>
            <input type="text" name="nama" id="nama" class="form-control" placeholder=""
              value="<?= $produk['nama_produk']; ?>">
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Harga Produk</label>
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text">Rp. </span>
              </div>
              <input type="number" class="form-control" name="harga" id="harga" placeholder="Harga Barang"
                value="<?= $produk['harga_produk']; ?>">
            </div>
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Stok Produk</label>
            <input type="number" name="stok_produk" id="stok_produk" class="form-control" placeholder=""
              value="<?= $produk['stok_produk']; ?>">
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Kategori Produk</label>
            <?= form_dropdown('kategori', $option, $produk['kategori_produk'], [
              'class' => 'form-control'
            ]); ?>
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Gambar Produk <span class="text-red">* Max FILESIZE <= 2mb (Kosongkan jika
                  tidak ingin merubah gambar)</span></label>
            <?= form_input('gambar', '', [
              'class' => 'form-control',
              'accept' => 'image/*'
            ], 'file'); ?>
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Deskripsi Produk</label>
            <?= form_textarea('desc', $produk['desc_produk'], [
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