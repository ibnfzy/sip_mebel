<?= $this->extend('web/base'); ?>
<?= $this->section('content'); ?>

<?php $cart = \Config\Services::cart();
// dd(session()->get('diskon'));
?>
<div class="banner">
  <div class="privacy about">
    <form action="<?= base_url('update_cart'); ?>" method="POST">
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
              <th>Diskon</th>
              <th>Sub Total</th>
              <th>Hapus</th>
            </tr>
          </thead>
          <tbody>
            <?php if ($cart->contents() == null): ?>
            <td colspan="8">Keranjang Kosong</td>
            <?php endif;
            $total = [];
            $totalx = [];
            $i = 1; ?>

            <?php foreach ($cart->contents() as $data): ?>
            <tr class="rem1">
              <input type="hidden" name="rowid[<?= $i; ?>]" value="<?= $data['rowid']; ?>">
              <input type="hidden" name="stok[<?= $i; ?>]" value="<?= $data['stok']; ?>">
              <input type="hidden" value="<?= $data['qty']; ?>" name="qtybutton[<?= $i ?>]">
              <td class="invert">
                <?= $i; ?>
              </td>
              <td class="invert"><a href="<?= base_url('Item/' . $data['id']); ?>"><img
                    src="<?= base_url('uploads/' . $data['gambar']); ?>" width="100" alt=" " class="img-responsive"></a>
              </td>
              <td class="invert">
                <div class="quantity">
                  <div class="quantity-select">
                    <input type="number" value="<?= $data['qty']; ?>" name="qtybutton[<?= $i ?>]">
                  </div>
                </div>
              </td>
              <td class="invert">
                <?= $data['name']; ?>
              </td>
              <td class="invert">Rp.
                <?php $subTotal = $data['price'] * $data['qty'];
                  echo number_format($subTotal, 0, ',', '.') ?>
              </td>
              <td class="invert">
                <?= (session()->get('id_barang_diskon') == $data['id']) ? session()->get('diskon') : 0; ?> %
              </td>
              <td class="invert">Rp.
                <?php $hargaDison = $subTotal - ($subTotal * (session()->get('diskon') / 100));
                  $subTotalx = (session()->get('id_barang_diskon') == $data['id']) ? $hargaDison : $subTotal;
                  echo number_format($subTotalx, 0, ',', '.') ?>
              </td>

              <?php $total[] = $subTotal; ?>
              <?php $totalx[] = $subTotalx; ?>
              </td>
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
          </ul>
        </div>
        <div class="col-md-8 address_form_agile">
          <h4>Total (Belum termasuk biaya ongkos kirim) - Rp.
            <?php $_SESSION['subtotal'] = array_sum($total); ?>
            <?= number_format(array_sum($totalx), 0, ',', '.'); ?>
          </h4>
          <div class="checkout-right-basket">
            <a href="<?= base_url('clear_cart'); ?>">Bersihkan Keranjang</a>
            <a href="javascript::void()" data-toggle="modal" data-target="#myModal">
              Proses <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            </a>
          </div>
        </div>

        <div class="clearfix"> </div>

      </div>
    </form>
  </div>
</div>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
            aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Pilih metode pembayaran sebelum checkout</h4>
      </div>
      <form action="<?= base_url('PembeliPanel/Checkout'); ?>" method="post">

        <div class="modal-body">
          <select name="bayar" id="" class="form-control" required>
            <option value="transfer">1. Transfer</option>
            <option value="cod">2. Cash on Delivery</option>
          </select>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Checkout</button>
        </div>
      </form>
    </div>
  </div>
</div>

<?= $this->endSection(); ?>

<?= $this->section('script'); ?>

<script>
$('.value-plus').on('click', function() {
  var divUpd = $(this).parent().find('.value');
  var qtybutton = $(this).parent().find('input.value');
  newVal = parseInt(divUpd.text(), 10) + 1;
  divUpd.text(newVal);
  qtybutton.text(newVal);
});

$('.value-minus').on('click', function() {
  var divUpd = $(this).parent().find('.value');
  var qtybutton = $(this).parent().find('input.value');
  newVal = parseInt(divUpd.text(), 10) - 1;
  if (newVal >= 1) divUpd.text(newVal);
  if (newVal >= 1) qtybutton.text(newVal);
});
</script>

<script>
$(document).ready(function() {
  discount = 0;
  discountPlaceholder = $('.discount-placeholder').text(discount + '%')

  <?php if (isset($_SESSION['diskon'])): ?>
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