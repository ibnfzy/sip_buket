<?= $this->extend('web/base'); ?>

<?= $this->section('content'); ?>

<!-- Start slider -->
<section id="aa-slider" style="padding-bottom: 40px;">
  <div class="aa-slider-area">
    <div id="sequence" class="seq">
      <div class="seq-screen">
        <ul class="seq-canvas">
          <!-- single slide item -->
          <?php foreach ($cr as $item) : ?>
          <li>
            <div class="seq-model">
              <img data-seq src="<?= base_url('uploads/' . $item['gambar']) ?>" alt="Men slide img" />
            </div>
            <div class="seq-title">
              <!-- <span data-seq>Save Up to 75% Off</span> -->
              <h2 data-seq><?= $item['header']; ?></h2>
              <!-- <p data-seq>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minus, illum.</p> -->
              <?php if ($item['link_to'] != '') : ?>
              <a data-seq href="<?= $item['link_to'] ?>" class="aa-shop-now-btn aa-secondary-btn">Lihat Detail</a>
              <?php endif ?>
            </div>
          </li>
          <?php endforeach ?>

        </ul>
      </div>
      <!-- slider navigation btn -->
      <fieldset class="seq-nav" aria-controls="sequence" aria-label="Slider buttons">
        <a type="button" class="seq-prev" aria-label="Previous"><span class="fa fa-angle-left"></span></a>
        <a type="button" class="seq-next" aria-label="Next"><span class="fa fa-angle-right"></span></a>
      </fieldset>
    </div>
  </div>
</section>
<!-- / slider -->


<section id="aa-banner ">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="row">
          <div class="aa-banner-area">
            <a href="#"><img src="<?= base_url('uploads'); ?>/3.png" alt="fashion banner img"></a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Start Promo section -->

<!-- Latest Blog -->
<section id="aa-latest-blog">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="aa-latest-blog-area">
          <h2>Rekomendasi </h2>
          <div class="row">
            <!-- single latest blog -->
            <?php foreach ($rekom as $item) : ?>
            <div class="col-md-4 col-sm-4">
              <div class="aa-latest-blog-single">
                <figure class="aa-blog-img">
                  <a href="<?= base_url('Produk/' . $item['id_produk']); ?>"><img
                      src="<?= base_url('uploads/' . $item['gambar_produk']); ?>" alt="img"></a>
                  <figcaption class="aa-blog-img-caption">
                    <span href="#">Stok: <?= $item['stok_produk']; ?></span>
                    <a href="#">- <?= $item['kategori_produk']; ?></a>
                    <a href="#">Rp. <?= $item['harga_produk']; ?></a>
                    <span href="#"><i class="fa fa-clock-o"></i><?= $item['jam_tgl_upload']; ?></span>
                  </figcaption>
                </figure>
                <div class="aa-blog-info">
                  <h3 class="aa-blog-title"><a href="#"><?= $item['nama_produk']; ?></a></h3>
                  <p><?= $item['desc_produk']; ?></p>
                  <a href="<?= base_url('Produk/' . $item['id_produk']); ?>" class="aa-read-mor-btn">Read more <span
                      class="fa fa-long-arrow-right"></span></a>
                </div>
              </div>
            </div>
            <?php endforeach ?>

          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- / Latest Blog -->


<!-- / Subscribe section -->

<?= $this->endSection(); ?>