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
                  <th>Total Item</th>
                  <th>Voucher Discount (%)</th>
                  <th>Total Bayar</th>
                  <th>Status</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($cart_item as $item) : ?>
                  <tr>
                    <td><?= $item['id_cart_item']; ?></td>
                    <td><?= $item['total_items']; ?></td>
                    <td><?= $item['potongan']; ?>%</td>
                    <td><?= $item['total_bayar']; ?></td>
                    <td><?= $item['status_bayar']; ?></td>
                    <td>

                      <div class="btn-group btn-group-sm" role="group">
                        <?php if ($item['status_bayar'] == 'Dalam Pengiriman') : ?>

                          <a href="#" onclick="statusDiterima('<?= $item['id_cart_item'] ?>')" type="button" class="btn bg-success"><i class="fa-solid fa-circle-check"></i></a>

                        <?php endif ?>

                        <?php if ($item['status_bayar'] == 'Selesai') : ?>

                          <a href="<?= base_url('PembeliPanel/Review'); ?>" type="button" class="btn bg-warning"><i class="fa-solid fa-star"></i></a>

                        <?php endif ?>
                        <a href="<?= base_url('PembeliPanel/Transaksi/' . $item['rowid']); ?>" type="button" class="btn btn-info"><i class="fa-solid fa-file-invoice"></i></a>
                      </div>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>

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
                    <td><?= $item['transactions_datetime']; ?></td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
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
          xhr.open('POST', 'Ubah_status_selesai/')
          xhr.send('status_bayar=Selesai&id_cart_item=' + rowid)
        }
      });
  };
</script>

<?= $this->endSection(); ?>