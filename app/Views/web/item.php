<?= $this->extend('web/base'); ?>
<?= $this->section('content'); ?>

<div class="top-brands">
  <div class='container'>
  <div class="w3ls_service_grids">
				<div class="col-md-7 w3ls_service_grid_left">
					<h2>Selamat Datang di website <br> Fauzan Meubel</h2>
					<p style='color: black; font-size: 20px;'>Temukan keindahan dan kenyamanan dalam rumah impian Anda hanya di Fauzan Meubel! Dapatkan furnitur berkualitas terbaik untuk menciptakan ruang yang elegan dan fungsional. Belanja di website kami sekarang dan temukan koleksi lengkap kami. Mulailah merancang rumah impian Anda dengan gaya yang sesuai dengan pilihan dari Fauzan Meubel!. Dapat kan <b>Diskon sebesar 5%</b> untuk pembelian 1 Item, <b>10%</b> untuk pembelian 2 Item, dan dapatkan <b>Meja Gratis</b> untuk pembelian 3 Item, Tunggu apa lagi klik <a href="<?= base_url('Item') ?>">Link ini</a> untuk melihat Katalog Item tersedia.</p>
				</div>
				<div class="clearfix"> </div>
			</div>
  </div>
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
                    <a href="<?= base_url('Item/' . $item['id_item']); ?>"><img height="140" width="140" title=" "
                        alt=" " src="<?= base_url('uploads/' . $item['gambar_item']); ?>" /></a>
                    <p><?= $item['nama_item']; ?> <br> Stok: <?= $item['stok_item']; ?></p>
                    <h4>Rp. <?= number_format($item['harga_item'], 0, ',', '.'); ?></h4>
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
                        <input <?= ($item['nama_item'] == 'Meja') ? 'disabled' : ''; ?>
                          onclick="add_item('<?= $item['id_item'] ?>', <?= $item['stok_item'] ?>)" type="button"
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
        var data = new FormData()
        xhr.onreadystatechange = function() {
          var DONE = 4; // readyState 4 means the request is done.
          var OK = 200; // status 200 is a successful return.
          if (xhr.readyState === DONE) {
            if (xhr.status === OK) {
              console.log('s: ' + xhr.response); // An error occurred during the request.
              swal.fire("Item berhasil masuk ke Keranjang, pergi ke halaman Keranjang?", {
                icon: "success",
              }).then(() => {
                window.location.replace('/Cart')


              }) // 'This is the returned text.'
            } else {
              swal.fire("Terjadi kesalahan pada AJAX, dengan error status: " + xhr.status, {
                icon: "error",
              })
              console.log('Error: ' + xhr.status); // An error occurred during the request.
            }
          }
        }
        data.append('id', id)
        xhr.open('POST', '/add_item')
        xhr.send(data)

      } else {
        swal.fire("Item tidak ditambahkan ke Keranjang!");
      }
    });
  <?php endif; ?>
}
</script>

<?= $this->endSection(); ?>