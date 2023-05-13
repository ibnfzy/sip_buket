<?= $this->extend('admin/base'); ?>

<?= $this->section('content'); ?>

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <!-- <h1>Data Website</h1> -->
          <a href="<?= base_url('AdminPanel/Produk/new'); ?>" class="btn bg-pink"><i class="fas fa-plus"></i> Tambah
            Data</a>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Table Produk</h3>

        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
            <i class="fas fa-minus"></i>
          </button>
        </div>
      </div>
      <div class="card-body">
        <table class="table table-bordered table-hover datatableminimal">
          <thead>
            <tr>
              <th>~</th>
              <th>Nama Produk</th>
              <th>Harga</th>
              <th>Stok</th>
              <th>Kategori</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($produk as $item) : ?>
            <tr>
              <td><?= $item['id_produk']; ?></td>
              <td><img src="<?= base_url('uploads/' . $item['gambar_produk']); ?>"
                  alt="Gambar Produk <?= $item['nama_produk']; ?>" width="100">
                <?= $item['nama_produk']; ?></td>
              <td>Rp. <?= $item['harga_produk']; ?></td>
              <td><?= $item['stok_produk']; ?></td>
              <td><?= $item['kategori_produk']; ?></td>
              <td>
                <div class="btn-group btn-group-sm" role="group">
                  <a href="<?= base_url('AdminPanel/Produk/' . $item['id_produk'] . '/edit'); ?>" type="button"
                    class="btn btn-info"><i class="fas fa-edit"></i></a>
                  <button onclick="deleteData('<?= $item['id_produk']; ?>')" type="button" class="btn btn-danger"><i
                      class="fas fa-trash" data-feather="trash-2"></i></button>
                </div>
              </td>
            </tr>
            <?php endforeach; ?>
            </tfoot>
        </table>
      </div>
      <!-- /.card-body -->

      <!-- /.card-footer-->
    </div>
    <!-- /.card -->

  </section>
  <!-- /.content -->
</div>

<?= $this->endSection(); ?>
<?= $this->section('script'); ?>
<script>
function deleteData(a) {
  swal.fire({
      title: "Apa kamu yakin?",
      text: "Data akan terhapus",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
    })
    .then((willDelete) => {
      if (willDelete) {
        $.ajax({
          method: "GET",
          url: "ProdukDelete/" + a,
          success: function(response) {
            swal.fire("Data Telah Terhapus", {
              icon: "success",
            }).then(() => {
              window.location.reload()
            })
          },
          error: function(response) {
            swal.fire("Terjadi kesalahan pada AJAX", {
              icon: "error",
            })
          }
        });
      }
    });
}
</script>
<?= $this->endSection(); ?>