<?= $this->extend('web/base'); ?>

<?= $this->section('content'); ?>

<!-- / catg header banner section -->

<!-- product category -->
<section id="aa-product-category">
  <div class="container">
    <div class="row">
      <div class="col-lg-9 col-md-9 col-sm-8">
        <div class="aa-product-catg-content">

          <div class="aa-product-catg-body">
            <ul class="aa-product-catg">
              <!-- start single product item -->
              <?php foreach ($data as $item) : ?>
              <li>
                <figure>
                  <a class="aa-product-img" href="<?= base_url('Produk/' . $item['id_produk']); ?>"><img height="300"
                      src="<?= base_url('uploads/' . $item['gambar_produk']); ?>" alt="polo shirt img"></a>
                  <a onclick="add_item('<?= $item['id_produk'] ?>', <?= $item['stok_produk'] ?>)"
                    class="aa-add-card-btn" href="javascript::void"><span class="fa fa-shopping-cart"></span>Add To
                    Cart</a>
                  <figcaption>
                    <h4 class="aa-product-title"><a
                        href="<?= base_url('Produk/' . $item['id_produk']); ?>"><?= $item['nama_produk']; ?></a></h4>
                    <span class="aa-product-price">Rp. <?= $item['harga_produk']; ?> - Stok :
                      <?= $item['stok_produk'] ;?></span>
                    <p class="aa-product-descrip"></p>
                  </figcaption>
                </figure>
                <!-- <div class="aa-product-hvr-content">
                    <a href="#" data-toggle="tooltip" data-placement="top" title="Add to Wishlist"><span class="fa fa-heart-o"></span></a>
                    <a href="#" data-toggle="tooltip" data-placement="top" title="Compare"><span class="fa fa-exchange"></span></a>
                    <a href="#" data-toggle2="tooltip" data-placement="top" title="Quick View" data-toggle="modal" data-target="#quick-view-modal"><span class="fa fa-search"></span></a>
                  </div> -->
                <!-- product badge -->
                <!-- <span class="aa-badge aa-sale" href="#">SALE!</span> -->
              </li>
              <?php endforeach ?>

            </ul>
            <!-- / quick view modal -->
          </div>
          <?= $pager->links('produk', 'katalog_page') ?>
          <!-- pagination -->
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