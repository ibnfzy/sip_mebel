<?= $this->extend('pembeli/base'); ?>

<?= $this->section('content'); ?>

<div id="content">
  <div id="content-header">

  </div>
  <div class="container-fluid">
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title">
            <span class="icon"><i class="icon-th"></i></span>
            <h5>Table Keranjang Checkout</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>#</th>
                  <th>ID Invoice</th>
                  <th>Total Item</th>
                  <th>Jenis Reward</th>
                  <th>Discount (%)</th>
                  <th>Total Harga Barang</th>
                  <th>Tanggal Checkout</th>
                  <th>Tanggal Bayar</th>
                  <th>Metode Pembayaran</th>
                  <th>Status</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php $i = 1; foreach ($cart_item as $item) : ?>
                <tr>
                  <td><?= $i; ?></td>
                  <td><?= $item['id_cart_item']; ?></td>
                  <td><?= $item['total_items']; ?></td>
                  <td><?= ($item['type_reward'] == 'free') ? 'Free 1 Meja' : 'Diskon'; ?></td>
                  <td><?= $item['potongan']; ?>%</td>
                  <td>Rp. <?= number_format($item['total_bayar'], 0, ',', '.'); ?></td>
                  <td><?= $item['tgl_checkout']; ?></td>
                  <td>
                    <?= ($item['tanggal_upload_bayar'] == null or $item['status_bayar'] == 'Menunggu Bukti Bayar') ? 'Belum Bayar' : $item['tanggal_upload_bayar']; ?>
                  </td>
                  <td><?= $item['metode_pembayaran']; ?></td>
                  <td><?= $item['status_bayar']; ?></td>
                  <td>
                    <div class="btn-group btn-group-sm" role="group">
                      <?php if ($item['status_bayar'] == 'Dalam Pengiriman') : ?>

                      <a href="#" onclick="statusDiterima('<?= $item['id_cart_item'] ?>')" type="button"
                        class="btn btn-success"><i class="fa-solid fa-circle-check"></i> Barang Diterima</a>

                      <?php endif ?>

                      <?php if ($item['status_bayar'] == 'Selesai') : ?>

                      <a href="<?= base_url('PembeliPanel/Review'); ?>" type="button" class="btn btn-warning"><i
                          class="fa-solid fa-star"></i> Beri Review</a>

                      <?php endif ?>
                      <a href="<?= base_url('PembeliPanel/Transaksi/' . $item['rowid']); ?>" type="button"
                        class="btn btn-info"><i class="fa-solid fa-file-invoice"></i> Lihat Invoice</a>
                    </div>
                  </td>
                </tr>
                <?php $i++ ;?>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <!-- <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title">
            <span class="icon"><i class="icon-th"></i></span>
            <h5>Table Transaksi Item</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Nama Item</th>
                  <th>Kuantitas</th>
                  <th>Total Harga</th>
                  <th>Tanggal Transaksi</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($transaksi as $item) : ?>
                <tr>
                  <td><?= $item['id_transactions']; ?></td>
                  <td><?= $item['nama_item']; ?></td>
                  <td><?= $item['qty_transactions']; ?></td>
                  <td>Rp. <?= number_format($item['total_harga'], 0, ',', '.'); ?></td>
                  <td><?= $item['transactions_datetime']; ?></td>
                </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div> -->
  </div>
</div>

<?= $this->endSection(); ?>

<?= $this->section('script'); ?>

<script>
const statusDiterima = (rowid) => {
  swal.fire({
      title: "Konfirmasi produk telah diterima?",
      text: "Status akan berubah",
      icon: "info",
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
    })
    .then((willDelete) => {
      if (willDelete) {
        var xhr = new XMLHttpRequest()
        var formData = new FormData()
        xhr.onreadystatechange = function() {
          var DONE = 4; // readyState 4 means the request is done.
          var OK = 200; // status 200 is a successful return.
          if (xhr.readyState === DONE) {
            if (xhr.status === OK) {
              swal.fire("Berhasil melakukan konfirmasi", {
                icon: "success",
              }).then(() => {
                window.location.reload()
              }) // 'This is the returned text.'
            } else {
              swal.fire("Terjadi kesalahan pada AJAX", {
                icon: "error",
              })
              console.log('Error: ' + xhr.status); // An error occurred during the request.
            }
          }
        }
        formData.append('status_bayar', 'Selesai')
        formData.append('id_cart_item', rowid)
        xhr.open('POST', '<?= base_url('')?>PembeliPanel/Ubah_status_selesai')
        xhr.send(formData)
      }
    });
};
</script>

<?= $this->endSection(); ?>