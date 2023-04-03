<?= $this->extend('web/base'); ?>
<?= $this->section('content'); ?>

<style>
.checked {
  color: orange;
}
</style>

<div class="banner">
  <div class="w3l_banner_nav_right">
    <div class="agileinfo_single">
      <h5><?= $data['nama_item']; ?></h5>
      <div class="col-md-4 agileinfo_single_left">
        <img id="example" src="<?= base_url('uploads/' . $data['gambar_item']); ?>" alt=" " class="img-responsive" />
      </div>
      <div class="col-md-8 agileinfo_single_right">
        <div class="col-sm-6">
          <?php
          $db = \Config\Database::connect();
          $get = $db->table('review_item')->where('id_item', $data['id_item'])->get()->getResultArray();
          $rt = [];
          $i = 1;

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
          <?php if ($nbulat == 0) : ?>
          <span class="fa-solid fa-star "></span>
          <span class="fa-solid fa-star "></span>
          <span class="fa-solid fa-star "></span>
          <span class="fa-solid fa-star"></span>
          <span class="fa-solid fa-star"></span>
          <?php endif ?>

          <?php if ($nbulat == 1) : ?>
          <span class="fa-solid fa-star checked"></span>
          <span class="fa-solid fa-star"></span>
          <span class="fa-solid fa-star"></span>
          <span class="fa-solid fa-star"></span>
          <span class="fa-solid fa-star"></span>
          <?php endif ?>

          <?php if ($nbulat == 2) : ?>
          <span class="fa-solid fa-star checked"></span>
          <span class="fa-solid fa-star checked"></span>
          <span class="fa-solid fa-star"></span>
          <span class="fa-solid fa-star"></span>
          <span class="fa-solid fa-star"></span>
          <?php endif ?>

          <?php if ($nbulat == 3) : ?>
          <span class="fa-solid fa-star checked"></span>
          <span class="fa-solid fa-star checked"></span>
          <span class="fa-solid fa-star checked"></span>
          <span class="fa-solid fa-star"></span>
          <span class="fa-solid fa-star"></span>
          <?php endif ?>

          <?php if ($nbulat == 4) : ?>
          <span class="fa-solid fa-star checked"></span>
          <span class="fa-solid fa-star checked"></span>
          <span class="fa-solid fa-star checked"></span>
          <span class="fa-solid fa-star checked"></span>
          <span class="fa-solid fa-star"></span>
          <?php endif ?>

          <?php if ($nbulat == 5) : ?>
          <span class="fa-solid fa-star checked"></span>
          <span class="fa-solid fa-star checked"></span>
          <span class="fa-solid fa-star checked"></span>
          <span class="fa-solid fa-star checked"></span>
          <span class="fa-solid fa-star checked"></span>
          <?php endif ?>

        </div>
        <div class="w3agile_description">
          <h4>Deskripsi :</h4>
          <p><?= $data['desc_item']; ?></p>
        </div>
        <div class="snipcart-item block">
          <div class="snipcart-thumb agileinfo_single_right_snipcart">
            <h4>Rp. <?= $data['harga_item']; ?> - Stok : <?= $data['stok_item']; ?></h4>
          </div>
          <div class="snipcart-details agileinfo_single_right_details">
            <form action="#" method="post">
              <fieldset>
                <input type="hidden" name="cmd" value="_cart" />
                <input type="hidden" name="add" value="1" />
                <input type="hidden" name="business" value=" " />
                <input type="hidden" name="item_name" value="pulao basmati rice" />
                <input type="hidden" name="amount" value="21.00" />
                <input type="hidden" name="discount_amount" value="1.00" />
                <input type="hidden" name="currency_code" value="USD" />
                <input type="hidden" name="return" value=" " />
                <input type="hidden" name="cancel_return" value=" " />
                <input onclick="add_item('<?= $data['id_item'] ?>', <?= $data['stok_item'] ?>)" type="button" name="add"
                  value="+ Keranjang" class="button" />
              </fieldset>
            </form>
          </div>

          <button data-toggle="modal" data-target="#myModal" class="btn btn-info btn-lg pull-right">Lihat Review Item
            (<?= $pbagi; ?>)</button>
        </div>
      </div>
      <div class="clearfix"> </div>
    </div>
  </div>
  <div class="clearfix"></div>
</div>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Review Item</h4>
      </div>
      <div class="modal-body">
        <?php foreach ($get as $item) : ?>
        <?php $getpembeli = $db->table('pembeli')->where('id_pembeli', $item['id_pembeli'])->get()->getRowArray(); ?>
        <div class="row">
          <div class="col-sm-4"><?= $getpembeli['fullname']; ?></div>
          <div class="col-sm-8">
            <?php for ($i = 0; $i < $item['bintang']; $i++) : ?>
            <span class="fa-solid fa-star checked"></span>
            <?php endfor; ?>
            <span>(<?= $item['bintang']; ?>) <?= $item['insert_datetime']; ?></span>
          </div>
          <div class="col-sm-12">
            <p><?= $item['isi_review_item']; ?></p>
          </div>
        </div>
        <?php
          $i++;
          if ($i != $pbagi) {
            echo '<hr>';
          }
          ?>
        <?php endforeach ?>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
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