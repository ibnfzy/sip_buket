<?= $this->extend('user/base'); ?>

<?= $this->section('content'); ?>

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Data Website</h1>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Keranjang</h3>

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
              <th>Total Produk</th>
              <th>Free Item</th>
              <th>Total Bayar</th>
              <th>Status</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php $i = 1;
            foreach ($keranjang as $item) : ?>

            <?php
              switch ($item['status_bayar']) {
                case 'Menunggu Bukti Bayar':
                  $bg = 'bg-dark';
                  break;

                case 'Menunggu Validasi Bukti Bayar':
                  $bg = 'bg-info';
                  break;

                case 'Diproses':
                  $bg = 'bg-secondary';
                  break;

                case 'Dalam Pengiriman':
                  $bg = 'bg-primary';
                  break;

                case 'Selesai':
                  $bg = 'bg-success';
                  break;

                case 'Gagal':
                  $bg = 'bg-danger';
                  break;

                default:
                  $bg = '';
                  break;
              };

              switch ($item['get_free_item']) {
                case 0:
                  $freeitem = 'Tidak';
                  break;

                case 1:
                  $freeitem = 'Ya';
                  break;

                default:
                  $freeitem = 'Tidak';
                  break;
              }
              ?>
            <tr>
              <td><?= $i++; ?>.</td>
              <td><?= $item['total_items'] ?></td>
              <td><?= $freeitem ?></td>
              <td>Rp. <?= $item['total_bayar'] ?></td>
              <td><span class="badge <?= $bg; ?>"><?= $item['status_bayar'] ?></span></td>
              <td>
                <?php if ($item['status_bayar'] == 'Dalam Pengiriman') : ?>
                <!-- TRUE -->
                <a href="javascript::void" onclick="statusDiterima('<?= $item['id_keranjang_produk'] ?>')" type="button"
                  title="Ubah Status diterima" class="btn btn-info text-white"><i class="fas fa-check"></i></i>
                </a>
                <?php endif ?>
                <?php if ($item['status_bayar'] == 'Selesai') : ?>
                <!-- TRUE -->
                <a href="<?= base_url('CustomerPanel/Review/new') ;?>" type="button" title="Berikan testimoni"
                  style="background-color: darkblue;" class="btn btn-blue text-white"><i class="fas fa-star"></i></a>
                <?php endif ?>
                <a href="<?= base_url('CustomerPanel/invoice/' . $item['rowid']); ?>" type="button"
                  title="Lihat Invoice" class="btn bg-pink text-white"><i class="fas fa-receipt"></i></a>

              </td>
            </tr>
            <?php endforeach ?>
            </tfoot>
        </table>
      </div>
      <!-- /.card-body -->

      <!-- /.card-footer-->
    </div>

    <hr>

    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Transaksi Produk</h3>

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
              <th>Kuantitas</th>
              <th>Total Harga</th>
              <th>Tanggal Transaksi</th>
            </tr>
          </thead>
          <tbody>
            <?php $p = 1;
            foreach ($transaksi as $item) : ?>
            <tr>
              <td><?= $p++; ?>.</td>
              <td><?= $item['nama_produk']; ?></td>
              <td><?= $item['qty_transaksi']; ?></td>
              <td>Rp. <?= $item['total_harga']; ?></td>
              <td><?= $item['transaksi_datetime']; ?></td>
            </tr>
            <?php endforeach ?>
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
const statusDiterima = (rowid) => {
  swal.fire({
      title: "Konfirmasi produk telah diterima?",
      text: "Status akan berubah",
      icon: "info",
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
    })
    .then((willDelete) => {
      if (willDelete) {
        $.ajax({
          method: "POST",
          data: {
            'status_bayar': 'Selesai',
            'keranjang_produk': rowid
          },
          url: "update-selesai",
          success: function(response) {
            swal.fire("Berhasil melakukan konfirmasi", {
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