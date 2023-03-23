<?= $this->extend('web/base'); ?>

<?= $this->section('content'); ?>

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
                    <span class="aa-product-view-price">Rp. <?= $data['harga_produk']; ?></span>
                    <p class="aa-product-avilability">Stok Produk: <span><?= $data['stok_produk']; ?></span></p>
                  </div>
                  <p>Transaksi pertama bagi Customer yang berdomisili Makassar akan mendapatkan <strong>Voucher Bebas
                      Ongkir</strong>, bagi pelanggan yang telah mendapatkan status <strong>Customer+</strong> akan
                    mendapatkan free item saat melakukan transaksi dengan pembelian lebih dari 1 produk</p>

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
                  <h4>2 Reviews for T-Shirt</h4>
                  <ul class="aa-review-nav">
                    <li>
                      <div class="media">
                        <div class="media-left">
                          <a href="#">
                            <img class="media-object" src="img/testimonial-img-3.jpg" alt="girl image">
                          </a>
                        </div>
                        <div class="media-body">
                          <h4 class="media-heading"><strong>Marla Jobs</strong> - <span>March 26, 2016</span></h4>
                          <div class="aa-product-rating">
                            <span class="fa fa-star"></span>
                            <span class="fa fa-star"></span>
                            <span class="fa fa-star"></span>
                            <span class="fa fa-star"></span>
                            <span class="fa fa-star-o"></span>
                          </div>
                          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                        </div>
                      </div>
                    </li>
                    <li>
                      <div class="media">
                        <div class="media-left">
                          <a href="#">
                            <img class="media-object" src="img/testimonial-img-3.jpg" alt="girl image">
                          </a>
                        </div>
                        <div class="media-body">
                          <h4 class="media-heading"><strong>Marla Jobs</strong> - <span>March 26, 2016</span></h4>
                          <div class="aa-product-rating">
                            <span class="fa fa-star"></span>
                            <span class="fa fa-star"></span>
                            <span class="fa fa-star"></span>
                            <span class="fa fa-star"></span>
                            <span class="fa fa-star-o"></span>
                          </div>
                          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                        </div>
                      </div>
                    </li>
                  </ul>
                  <h4>Add a review</h4>
                  <div class="aa-your-rating">
                    <p>Your Rating</p>
                    <a href="#"><span class="fa fa-star-o"></span></a>
                    <a href="#"><span class="fa fa-star-o"></span></a>
                    <a href="#"><span class="fa fa-star-o"></span></a>
                    <a href="#"><span class="fa fa-star-o"></span></a>
                    <a href="#"><span class="fa fa-star-o"></span></a>
                  </div>
                  <!-- review form -->
                  <form action="" class="aa-review-form">
                    <div class="form-group">
                      <label for="message">Your Review</label>
                      <textarea class="form-control" rows="3" id="message"></textarea>
                    </div>
                    <div class="form-group">
                      <label for="name">Name</label>
                      <input type="text" class="form-control" id="name" placeholder="Name">
                    </div>
                    <div class="form-group">
                      <label for="email">Email</label>
                      <input type="email" class="form-control" id="email" placeholder="example@gmail.com">
                    </div>

                    <button type="submit" class="btn btn-default aa-review-submit">Submit</button>
                  </form>
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
  swal({
    title: "Silahkan login dahulu untuk melakukan transaksi!",
    icon: "info",
    buttons: true
  }).then((willLogin) => {
    if (willLogin) {
      window.location.replace("<?= base_url('Auth/User') ?>")
    }
  });
  <?php endif; ?>

  <?php if (isset($_SESSION['logged_in_pelanggan']) and $_SESSION['logged_in_pelanggan'] == true) : ?>
  if (stok === 0) {
    return swal({
      title: "Stok produk kosong, tidak dapat menambahkan kekeranjang!",
      icon: "info",
      buttons: false,
    })
  }

  swal({
      title: "Masukkan Item ke keranjang?",
      icon: "info",
      buttons: true,
      dangerMode: true,
    })
    .then((willLogin) => {
      if (willLogin) {
        $.ajax({
          method: "POST",
          url: "/add_item",
          data: {
            'id': parseInt(id)
          },
          success: function(response) {
            swal({
              title: "Item berhasil masuk ke cart, pergi ke cart page?",
              icon: "info",
              buttons: true,
            }).then((isSuccess) => {
              if (isSuccess) {
                window.location.replace("<?= base_url('cart') ?>")
              }
            });
          },
          error: function(response) {
            swal(response.error);
          }
        });
      } else {
        swal("Item tidak ditambahkan ke cart!");
      }
    });
  <?php endif; ?>
}
</script>

<?= $this->endSection(); ?>