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
        <h3 class="card-title">Keranjang Customer</h3>

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
              <th>Nama Customer</th>
              <th>Free Item</th>
              <th>Total Produk</th>
              <th>Total Bayar</th>
              <th>Status Bayar</th>
              <th>~</th>
            </tr>
          </thead>
          <tbody>
            <?php
            foreach ($keranjang as $item) : ?>
            <?php $db = \Config\Database::connect();
              $customer = $db->table('customer')->where('id_customer', $item['id_customer'])->get()->getResultArray();
              // dd($customer);
              ?>
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
              }; ?>
            <tr>
              <td><?= $item['id_keranjang_produk']; ?></td>
              <?php foreach ($customer as $data) : ?>
              <td><?= $data['fullname']; ?></td>
              <?php endforeach; ?>
              <td><?= $freeitem = ($item['get_free_item'] != 1) ? 'Tidak' : 'Ya'; ?></td>
              <td><?= $item['total_items']; ?></td>
              <td>Rp. <?= $item['total_bayar']; ?></td>
              <td><span class="badge <?= $bg; ?>"><?= $item['status_bayar'] ?></span></td>
              <td>
                <div class="btn-group btn-group-sm" role="group">
                  <a <?= ($item['status_bayar'] != 'Menunggu Validasi Bukti Bayar') ? 'hidden' : ''; ?>
                    href="<?= base_url('AdminPanel/validasi_bukti_bayar/' . $item['id_keranjang_produk']); ?>"
                    type="button" class="btn btn-info"><i class="fas fa-clipboard-check"></i> Validasi Bukti Bayar</a>
                  <a <?= ($item['status_bayar'] != 'Diproses') ? 'hidden' : ''; ?> title="Ubah status dalam pengiriman"
                    href="<?= base_url('AdminPanel/update_kirim/' . $item['id_keranjang_produk']); ?>" type="button"
                    class="btn btn-info"><i class="fas fa-truck-loading"></i> Ubah Status Dalam Pengiriman</a>
                  <a href="<?= base_url('uploads/' . $item['bukti_bayar']); ?>" class="btn bg-pink"
                    data-toggle="lightbox" data-title="" data-gallery="gallery"><i class="fas fa-file-invoice"></i>
                    Lihat Bukti Bayar</a>
                  &nbsp;
                </div>
              </td>
            </tr>
            <?php endforeach; ?>
            </tfoot>
        </table>
      </div>
      <!-- /.card-body -->
      <div class="card-footer">
        Footer
      </div>
      <!-- /.card-footer-->
    </div>
    <br>
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Transaksi Customer</h3>

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
              <th>Nama Pembeli</th>
              <th>Nama Produk</th>
              <th>Total Harga</th>
              <th>Tanggal Transaksi</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($order as $item) : ?>
            <tr>
              <td><?= $item['id_transaksi']; ?></td>
              <td><?= $item['fullname']; ?></td>
              <td><?= $item['nama_produk']; ?></td>
              <td>Rp. <?= $item['total_harga']; ?></td>
              <td><?= $item['transaksi_datetime']; ?></td>
              <td>
                <div class="btn-group btn-group-lg" role="group">
                  <!-- <button onclick="deleteData('<?= $item['id_transaksi']; ?>')" type="button" class="btn btn-danger"><i
                      class="align-middle me-2" data-feather="trash-2"></i></button> -->
                </div>
              </td>
            </tr>
            <?php endforeach; ?>
            </tfoot>
        </table>
      </div>
      <!-- /.card-body -->
      <div class="card-footer">
        Footer
      </div>
      <!-- /.card-footer-->
    </div>
    <!-- /.card -->

  </section>
  <!-- /.content -->
</div>

<?= $this->endSection(); ?>

<?= $this->section('script'); ?>

<script>
$(function() {
  $(document).on('click', '[data-toggle="lightbox"]', function(event) {
    event.preventDefault();
    $(this).ekkoLightbox({
      alwaysShowClose: true
    });
  });

  $('.filter-container').filterizr({
    gutterPixels: 3
  });
  $('.btn[data-filter]').on('click', function() {
    $('.btn[data-filter]').removeClass('active');
    $(this).addClass('active');
  });
})
</script>

<?= $this->endSection(); ?>