<?= $this->extend('user/base'); ?>

<?= $this->section('content'); ?>

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
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
        <h3 class="card-title">Invoice</h3>

        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
            <i class="fas fa-minus"></i>
          </button>
        </div>
      </div>
      <div class="card-body">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">

              <!-- Main content -->
              <div class="invoice p-3 mb-3">
                <!-- title row -->
                <div class="row">
                  <div class="col-12">
                    <h4>
                      💐 Hadifa Gallery.
                      <small class="float-right">Date: <?= $keranjang['tgl_checkout']; ?></small>
                    </h4>
                  </div>
                  <!-- /.col -->
                </div>
                <!-- info row -->
                <div class="row invoice-info">
                  <div class="col-sm-4 invoice-col">
                    Dikirim dari
                    <address>
                      <strong>Hadifa Gallery.</strong><br>
                      <?= $dataToko['alamat_toko']; ?><br>
                      Kontak: <?= $dataToko['kontak_toko']; ?>
                    </address>
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-4 invoice-col">
                    Ke Alamat
                    <address>
                      <strong><?= $_SESSION['fullname']; ?></strong><br>
                      <?= $dataUser['alamat']; ?><br>
                      Phone: <?= $dataUser['nomor_hp']; ?>
                    </address>
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-4 invoice-col">
                    <b>Invoice</b><br>
                    <br>
                    <b>ID Keranjang Produk:</b> <?= $keranjang['id_keranjang_produk']; ?><br>
                    <b>ID Customer:</b> <?= $_SESSION['id_customer']; ?>
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->

                <!-- Table row -->
                <div class="row">
                  <div class="col-12 table-responsive">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>Kuantitas</th>
                          <th>Produk</th>
                          <th>ID Produk</th>
                          <th>Subtotal</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $i = 1;
                        $total = [];
                        foreach ($data as $item) : ?>
                          <?php $total[] = $item['total_harga']; ?>
                          <tr>
                            <td><?= $item['qty_transaksi']; ?></td>
                            <td><?= $item['nama_produk']; ?></td>
                            <td><?= $item['id_produk']; ?></td>
                            <td>Rp. <?= $item['total_harga']; ?></td>
                          </tr>
                        <?php endforeach ?>
                      </tbody>
                    </table>
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->

                <div class="row">
                  <!-- accepted payments column -->
                  <div class="col-6">
                    <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                      Silahkan melalukan pembayaran dengan mentranfer ke rekening berikut: <br>
                      <b>BANK XYZ 09310932</b> <br> dengan sebesar <b>Rp. <?= $keranjang['total_bayar']; ?> .-</b>
                    </p>
                  </div>
                  <!-- /.col -->
                  <div class="col-6">

                    <div class="table-responsive">
                      <table class="table">
                        <tr>
                          <th style="width:50%">Subtotal:</th>
                          <td>Rp. <?= $subtotal = array_sum($total); ?></td>
                        </tr>
                        <tr>
                          <th>Biaya Ongkir:</th>
                          <td>Rp. <?= $dataToko['biaya_ongkir']; ?></td>
                        </tr>
                        <tr>
                          <th>Total yang dibayar:</th>
                          <td>Rp. <?= $keranjang['total_bayar']; ?>
                            <?= $node = ($keranjang['total_bayar'] == ($subtotal + $dataToko['biaya_ongkir'])) ? '' : '
                            <span class="badge bg-success">Free Ongkir</span>'; ?></td>
                        </tr>
                      </table>
                    </div>
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->

                <!-- this row will not appear when printing -->
                <div class="row no-print">
                  <div class="col-12">
                    <a href="invoice-print.html" rel="noopener" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> Print</a>
                    <button data-toggle="modal" data-target="#exampleModal" type="button" class="btn bg-pink float-right"><i class="far fa-credit-card"></i> Upload Bukti Pembayaran
                    </button>
                  </div>
                </div>
              </div>
              <!-- /.invoice -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div>
      </div>
      <!-- /.card-footer-->
    </div>
    <!-- /.card -->

  </section>
  <!-- /.content -->
</div>

<?php if ($keranjang['bukti_bayar'] == null) : ?>

  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">
        <div class="modal-header bg-pink">
          <h5 class="modal-title text-white" id="exampleModalLabel">Upload Bukti Pembayaran <span class="text-dark">* Max
              FILESIZE
              <= 2mb </span>
          </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="<?= base_url('CustomerPanel/upload/' . $keranjang['id_keranjang_produk']); ?>" method="post" enctype="multipart/form-data">
          <div class="modal-body">
            <div class="form-group">
              </label>
              <?= form_input('gambar', '', [
                'class' => 'form-control',
                'accept' => 'image/*'
              ], 'file'); ?>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn bg-pink">Upload Bukti Pembayaran</button>
          </div>
        </form>
      </div>
    </div>
  </div>

<?php endif ?>

<?= $this->endSection(); ?>