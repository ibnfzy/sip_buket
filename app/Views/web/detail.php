<?= $this->extend('web/base'); ?>

<?= $this->section('content'); ?>

<?php
$db = \Config\Database::connect();
$get = $db->table('penilaian')->where('id_produk', $data['id_produk'])->get()->getResultArray();
$rt = [];

foreach ($get as $item) {
  $rt[] = $item['bintang'];
}

$nilai = array_sum($rt);
$pbagi = count($rt);
try {
  $rating = $nilai / $pbagi;
} catch (\Throwable $th) {
  $rating = 0;
}
$nbulat = round($rating);
$nbulat = ($nbulat > 5) ? 5 : $nbulat;
?>

<style>
.gold {
  color: #ff6600;
}
</style>

<!-- catg header banner section -->

<!-- / catg header banner section -->

<!-- product category -->
<section id="aa-product-details">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="aa-product-details-area">
          <div class="aa-product-details-content">
            <div class="row">
              <!-- Modal view slider -->
              <div class="col-md-5 col-sm-5 col-xs-12">
                <div class="aa-product-view-slider">
                  <div id="demo-1" class="simpleLens-gallery-container">
                    <div class="simpleLens-container">
                      <div class="simpleLens-big-image-container"><a
                          data-lens-image="<?= base_url('uploads/' . $data['gambar_produk']); ?>"
                          class="simpleLens-lens-image"><img src="<?= base_url('uploads/' . $data['gambar_produk']); ?>"
                            class="simpleLens-big-image"></a></div>
                    </div>

                  </div>
                </div>
              </div>
              <!-- Modal view content -->
              <div class="col-md-7 col-sm-7 col-xs-12">
                <div class="aa-product-view-content">
                  <h3><?= $data['nama_produk']; ?></h3>
                  <div class="aa-price-block">
                    <?php if ($nbulat == 1) : ?>
                    <span class="fa fa-star gold"></span>
                    <?php endif; ?>
                    <?php if ($nbulat == 2) : ?>
                    <span class="fa fa-star gold"></span>
                    <span class="fa fa-star gold"></span>
                    <?php endif; ?>
                    <?php if ($nbulat == 3) : ?>
                    <span class="fa fa-star gold"></span>
                    <span class="fa fa-star gold"></span>
                    <span class="fa fa-star gold"></span>
                    <?php endif; ?>
                    <?php if ($nbulat == 4) : ?>
                    <span class="fa fa-star gold"></span>
                    <span class="fa fa-star gold"></span>
                    <span class="fa fa-star gold"></span>
                    <span class="fa fa-star gold"></span>
                    <?php endif; ?>
                    <?php if ($nbulat == 5) : ?>
                    <span class="fa fa-star gold"></span>
                    <span class="fa fa-star gold"></span>
                    <span class="fa fa-star gold"></span>
                    <span class="fa fa-star gold"></span>
                    <span class="fa fa-star gold"></span>
                    <?php endif; ?> <br>
                    <span class="aa-product-view-price">Rp. <?= $data['harga_produk']; ?></span>
                    <p class="aa-product-avilability">Stok Produk: <span><?= $data['stok_produk']; ?></span></p>

                  </div>
                  <div class="aa-prod-quantity">

                    <p class="aa-prod-category">
                      Category: <a href="#"><?= $data['kategori_produk']; ?></a>
                    </p>
                  </div>
                  <div class="aa-prod-view-bottom">
                    <a onclick="add_item('<?= $data['id_produk'] ?>', <?= $data['stok_produk'] ?>)"
                      class="aa-add-to-cart-btn" href="#">Tambahkan ke keranjang</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="aa-product-details-bottom">
            <ul class="nav nav-tabs" id="myTab2">
              <li><a href="#description" data-toggle="tab">Deskripsi Produk</a></li>
              <li><a href="#review" data-toggle="tab">Penilaian Produk</a></li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
              <div class="tab-pane fade in active" id="description">
                <p><?= $data['desc_produk']; ?></p>
              </div>

              <div class="tab-pane fade " id="review">
                <div class="aa-product-review-area">
                  <h4><?= $pbagi; ?> Review
                  </h4>

                  <ul class="aa-review-nav">

                    <?php foreach ($get as $item) : ?>
                    <?php $g = $db->table('customer')->where('id_customer', $item['id_customer'])->get()->getRowArray(); ?>
                    <li>
                      <div class="media">
                        <div class="media-left">
                          <a href="javascript::void">
                            <span class="fa fa-user"></span>
                          </a>
                        </div>
                        <div class="media-body">
                          <h4 class="media-heading"><strong><?= $g['fullname']; ?></strong> -
                            <span><?= $item['insert_datetime']; ?></span>
                          </h4>
                          <div class="aa-product-rating">
                            <?php for ($i = 0; $i < $item['bintang']; $i++) : ?>
                            <span class="fa fa-star"></span>
                            <?php endfor; ?>
                          </div>
                          <p><?= $item['isi_penilaian']; ?></p>
                        </div>
                      </div>
                    </li>

                    <?php endforeach ?>

                  </ul>

                </div>
              </div>
            </div>
          </div>
          <!-- Related product -->
        </div>
      </div>
    </div>
  </div>
</section>
<!-- / product category -->


<?= $this->endSection(); ?>

<?= $this->section('script'); ?>

<script>
function add_item(id, stok) {
  <?php if (!isset($_SESSION['logged_in_pelanggan']) or $_SESSION['logged_in_pelanggan'] == false) :  ?>
  swal.fire({
    title: "Tidak ada sesi login terdeteksi, silahkan melakukan login sebelum melakukan transaksi!",
    icon: "info",
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
  }).then((willLogin) => {
    if (willLogin.isConfirmed) {
      window.location.replace("<?= base_url('Auth/Customer') ?>")
    }
  });
  <?php endif; ?>

  <?php if (isset($_SESSION['logged_in_pelanggan']) and $_SESSION['logged_in_pelanggan'] == true) : ?>
  if (stok === 0) {
    return swal.fire({
      title: "Stok produk kosong, tidak dapat menambahkan kekeranjang!",
      icon: "info",
    });
  }

  swal.fire({
      title: "Tambah item ke keranjang?",
      icon: "info",
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
    })
    .then((willLogin) => {
      if (willLogin.isConfirmed) {
        $.ajax({
          method: "POST",
          url: "/add_item",
          data: {
            'id': parseInt(id)
          },
          success: function(response) {
            swal.fire({
              title: "Item berhasil masuk ke Keranjang, pergi ke halaman Keranjang?",
              icon: "info",
              buttons: true,
            }).then((isSuccess) => {
              if (isSuccess) {
                window.location.replace("<?= base_url('Keranjang') ?>")
              }
            });
          },
          error: function(response) {
            swal(response.error);
          }
        });
      } else {
        swal.fire("Item tidak ditambahkan ke Keranjang!");
      }
    });
  <?php endif; ?>
}
</script>

<?= $this->endSection(); ?>