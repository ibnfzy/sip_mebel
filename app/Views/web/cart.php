<?= $this->extend('web/base'); ?>
<?= $this->section('content'); ?>

<?php $cart = \Config\Services::cart(); ?>
<div class="banner">
  <div class="privacy about">
    <form action="">
      <h3>Keranjang<span></span></h3>

      <div class="checkout-right">
        <!-- <h4>Your shopping cart contains: <span>3 Products</span></h4> -->
        <table class="timetable_sub">
          <thead>
            <tr>
              <th>#</th>
              <th>Item</th>
              <th>Kuantitas</th>
              <th>Nama Item</th>
              <th>Harga</th>
              <th>Hapus</th>
            </tr>
          </thead>
          <tbody>
            <?php if ($cart->contents() == null) : ?>
            <td colspan="6">Keranjang Kosong</td>
            <?php endif;
            $total = [];
            $i = 1; ?>

            <?php foreach ($cart->contents() as $data) : ?>
            <tr class="rem1">
              <input type="hidden" name="rowid[<?= $i; ?>]" value="<?= $data['rowid']; ?>">
              <input type="hidden" name="stok[<?= $i; ?>]" value="<?= $data['stok']; ?>">
              <input type="hidden" value="<?= $data['qty']; ?>" name="qtybutton[<?= $i ?>]">
              <td class="invert"><?= $i; ?></td>
              <td class="invert-image"><a href="<?= base_url('Item/' . $data['id']); ?>"><img
                    src="<?= base_url('uploads/' . $data['gambar_item']); ?>" alt=" " class="img-responsive"></a>
              </td>
              <td class="invert">
                <div class="quantity">
                  <div class="quantity-select">
                    <div class="entry value-minus">&nbsp;</div>
                    <div class="entry value"><span><?= $data['qty']; ?></span></div>
                    <div class="entry value-plus active">&nbsp;</div>
                  </div>
                </div>
              </td>
              <td class="invert"><?= $data['name']; ?></td>

              <td class="invert">Rp. <?= $subTotal =  $data['price'] * $data['qty']; ?></td>
              <?php $total[] = $subTotal; ?></td>
              <td class="invert">
                <div class="rem">
                  <a href="<?= base_url('remove_item/' . $data['rowid']); ?>">
                    <div class="close1"> </div>
                  </a>
                </div>

              </td>
            </tr>
            <?php $i++;
            endforeach ?>
          </tbody>
        </table>
      </div>
      <div class="checkout-left">
        <style>
        .checkout-left-basket button {
          background: #84c639;
          font-size: 1.1em;
          color: #fff;
          text-transform: uppercase;
          text-align: center;
        }
        </style>
        <div class="col-md-4 checkout-left-basket">
          <h4>
            <button class="btn" type="submit">Update Keranjang</button>
          </h4>
          <ul>
            <li>Sub Total <i>-</i> <span>Rp. <span>Rp. <?= $subTotalx = array_sum($total); ?></span></li>
            <li>Biaya Ongkir <i>-</i> <span>$25.00 </span></li>
            <li>Diskon <i>-</i> <span class="discount-placeholder"></span></li>
            <li>Total Bayar <i>-</i> <span>$84.00</span></li>
          </ul>
        </div>
        <div class="col-md-8 address_form_agile">
          <h4>Tambahkan Kode Voucher (dapat dilihat di Panel)</h4>
          <form action="payment.html" method="post" class="creditly-card-form agileinfo_form">
            <section class="creditly-wrapper wthree, w3_agileits_wrapper">
              <div class="information-wrapper">
                <div class="first-row form-group">
                  <div class="controls">
                    <label class="control-label">Kode Voucher: </label>
                    <input class="billing-address-name form-control" type="text" id="id_discount" name="id_discount"
                      placeholder="...">
                  </div>
                </div>
                <button onclick="discount_get()" class="submit check_out">Check Voucher</button>
              </div>
            </section>
          </form>
          <div class="checkout-right-basket">
            <a href="<?= base_url('clear_cart'); ?>">Bersihkan Keranjang</a>
            <a href="payment.html">Checkout <span class="glyphicon glyphicon-chevron-right"
                aria-hidden="true"></span></a>
          </div>
        </div>

        <div class="clearfix"> </div>

      </div>
    </form>
  </div>
</div>

<?= $this->endSection(); ?>

<?= $this->section('script'); ?>

<script>
$('.value-plus').on('click', function() {
  var divUpd = $(this).parent().find('.value'),
    newVal = parseInt(divUpd.text(), 10) + 1;
  divUpd.text(newVal);
});

$('.value-minus').on('click', function() {
  var divUpd = $(this).parent().find('.value'),
    newVal = parseInt(divUpd.text(), 10) - 1;
  if (newVal >= 1) divUpd.text(newVal);
});
</script>

<script>
$(document).ready(function() {
  discount = 0;
  discountPlaceholder = $('.discount-placeholder').text(discount + '%')

  <?php if (isset($_SESSION['diskon'])) : ?>
  discount = <?= $_SESSION['diskon'] ?>;
  discountPlaceholder = $('.discount-placeholder').text(discount + '%')
  <?php endif ?>

  discount_get = function() {
    id = $('#id_discount').val()

    var xhr = new XMLHttpRequest()
    xhr.onreadystatechange = function() {
      var DONE = 4; // readyState 4 means the request is done.
      var OK = 200; // status 200 is a successful return.
      if (xhr.readyState === DONE) {
        if (xhr.status === OK) {
          swal.fire(xhr.response.msg, {
            icon: "success",
          }).then(() => {
            window.location.reload()
          }) // 'This is the returned text.'
        } else {
          swal.fire("Terjadi kesalahan pada AJAX, dengan error status: " + xhr.status, {
            icon: "error",
          })
          console.log('Error: ' + xhr.status); // An error occurred during the request.
        }
      }
    }

    xhr.open('POST', '/diskon')
    xhr.send('id=' + id)
  }
});

$(function() {
  // console.log($('.discount-placeholder').text('20%'))
  // $('#discount').length()

});
</script>

<?= $this->endSection(); ?>