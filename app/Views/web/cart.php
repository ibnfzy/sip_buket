<?= $this->extend('web/base'); ?>

<?= $this->section('content'); ?>
<!-- catg header banner section -->
<?php $cart = \Config\Services::cart(); ?>

<!-- / catg header banner section -->

<!-- Cart view section -->
<section id="cart-view">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="cart-view-area">
          <div class="cart-view-table">
            <form action="<?= base_url('update_cart'); ?>" method="post">
              <div class="table-responsive">
                <table class="table">
                  <thead>
                    <tr>
                      <th>~</th>
                      <th>~</th>
                      <th>Produk</th>
                      <th>Stok</th>
                      <th>Harga</th>
                      <th>Kuantitas</th>
                      <th>Total</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if ($cart->contents() == null) : ?>
                    <td colspan="7">Keranjang Kosong</td>
                    <?php endif;
                    $total = [];
                    $i = 1; ?>
                    <?php foreach ($cart->contents() as $data) : ?>
                    <tr>
                      <td><a class="remove" href="<?= base_url('remove_item/' . $data['rowid']); ?>">
                          <fa class="fa fa-close"></fa>
                        </a></td>
                      <input type="hidden" name="rowid[<?= $i; ?>]" value="<?= $data['rowid']; ?>">
                      <input type="hidden" name="stok[<?= $i; ?>]" value="<?= $data['stok']; ?>">
                      <td><a href="#"><img width="100" src="<?= base_url('uploads/' . $data['gambar']); ?>"
                            alt="img"></a></td>
                      <td><a class="aa-cart-title" href="#"><?= $data['name']; ?></a></td>
                      <td><?= $data['stok']; ?></td>
                      <td>Rp. <?= $data['price']; ?></td>
                      <td><input class="aa-cart-quantity" type="number" name="qtybutton[<?= $i ?>]"
                          value="<?= $data['qty']; ?>"></td>
                      <td>Rp. <?= $subTotal =  $data['price'] * $data['qty']; ?></td><?php $total[] = $subTotal; ?>
                    </tr>
                    <?php endforeach ?>

                    <tr>
                      <td colspan="7" class="aa-cart-view-bottom">

                        <input class="aa-cart-view-btn" type="submit" value="Update Cart">
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </form>
            <!-- Cart Total view -->
            <div class="cart-view-total">
              <h4>Total Keranjang</h4>
              <table class="aa-totals-table">
                <tbody>
                  <tr>
                    <th>Subtotal</th>
                    <td>Rp. <?= $_SESSION['subtotal'] = array_sum($total); ?></td>
                  </tr>
                </tbody>
              </table>
              <a href="<?= base_url('CustomerPanel/checkout'); ?>" class="aa-cart-view-btn">Proses Checkout</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- / Cart view section -->

<?= $this->endSection(); ?>