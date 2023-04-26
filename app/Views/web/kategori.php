<?= $this->extend('web/base'); ?>
<?= $this->section('content'); ?>

<div class="top-brands">
  <div class="container">
    <h3>Item Katalog</h3>
    <div class="agile_top_brands_grids">
      <?php foreach ($data as $item) : ?>
      <div class="col-md-3 top_brand_left ">
        <div class="hover14 column">
          <div class="agile_top_brand_left_grid">
            <!-- <div class="tag"><img src="images/tag.png" alt=" " class="img-responsive" /></div> -->
            <div class="agile_top_brand_left_grid1">
              <figure>
                <div class="snipcart-item block">
                  <div class="snipcart-thumb">
                    <a href="<?= base_url('Item/' . $item['id_item']); ?>"><img title=" " alt=" "
                        src="<?= base_url('uploads/' . $item['gambar_item']); ?>" /></a>
                    <p><?= $item['nama_item']; ?> <br> Stok: <?= $item['stok_item']; ?></p>
                    <h4>Rp. <?= $item['harga_item']; ?></h4>
                  </div>
                  <div class="snipcart-details top_brand_home_details">
                    <form action="#" method="post">
                      <fieldset>
                        <input type="hidden" name="cmd" value="_cart" />
                        <input type="hidden" name="add" value="1" />
                        <input type="hidden" name="business" value=" " />
                        <input type="hidden" name="item_name" value="Fortune Sunflower Oil" />
                        <input type="hidden" name="amount" value="7.99" />
                        <input type="hidden" name="discount_amount" value="1.00" />
                        <input type="hidden" name="currency_code" value="USD" />
                        <input type="hidden" name="return" value=" " />
                        <input type="hidden" name="cancel_return" value=" " />
                        <input onclick="add_item('<?= $item['id_item'] ?>', <?= $item['stok_item'] ?>)" type="button"
                          name="add" value="+ Keranjang" class="button" />
                      </fieldset>

                    </form>

                  </div>
                </div>
              </figure>
            </div>
          </div>
        </div>
      </div>
      <?php endforeach ?>


      <div class="clearfix"> </div>
    </div>

  </div>
  <?= $pager->links('item', 'item_page') ?>
  <!-- pager -->
</div>

<?= $this->endSection(); ?>

<?= $this->section('script'); ?>

<script>
function add_item(id, stok) {
  <?php if (!isset($_SESSION['logged_in_pelanggan']) or $_SESSION['logged_in_pelanggan'] == false) :  ?>
  swal.fire({
    title: "Sepertinya anda belum login, silahkan login untuk memulai transaksi anda",
    icon: "info",
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
  }).then((willLogin) => {
    if (willLogin.isConfirmed) {
      window.location.replace("<?= base_url('Auth/Pembeli') ?>")
    }
  });
  <?php endif; ?>

  <?php if (isset($_SESSION['logged_in_pelanggan']) and $_SESSION['logged_in_pelanggan'] == true) : ?>
  if (stok === 0) {
    return swal.fire({
      title: "Stok item ini kosong, gagal menambah item ke keranjang",
      icon: "info",
    });
  }

  swal.fire({
      title: "Tambahkan item ke keranjang?",
      icon: "info",
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
    })
    .then((willLogin) => {
      if (willLogin.isConfirmed) {
        var xhr = new XMLHttpRequest()
        xhr.onreadystatechange = function() {
          var DONE = 4; // readyState 4 means the request is done.
          var OK = 200; // status 200 is a successful return.
          if (xhr.readyState === DONE) {
            if (xhr.status === OK) {
              swal.fire("Item berhasil masuk ke Keranjang, pergi ke halaman Keranjang?", {
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
        xhr.open('POST', '/add_item')
        xhr.send('id=' + parseInt(id))

      } else {
        swal.fire("Item tidak ditambahkan ke Keranjang!");
      }
    });
  <?php endif; ?>
}
</script>

<?= $this->endSection(); ?>