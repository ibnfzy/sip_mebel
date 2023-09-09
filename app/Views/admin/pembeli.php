<?= $this->extend('admin/base'); ?>

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
            <h5>Table Corousel</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Nama</th>
                  <th>Total Transaksi</th>
                  <th>Total Transaksi Berhasil</th>
                  <th>Bukti Pembayaran belum diValidasi</th>
                </tr>
              </thead>
              <tbody>
                <?php $db = \Config\Database::connect();
                $i = 1; ?>
                <?php foreach ($pelanggan as $item) : ?>
                  <?php
                  $get1 = $db->table('cart_item')->where('id_pembeli', $item['id_pembeli'])->get()->getResultArray();
                  $get2 = $db->table('cart_item')->where('id_pembeli', $item['id_pembeli'])->where('status_bayar', 'Selesai')->get()->getResultArray();
                  $get3 = $db->table('cart_item')->where('id_pembeli', $item['id_pembeli'])->where('status_bayar', 'Menunggu Validasi Bukti Bayar')->get()->getResultArray();
                  ?>
                  <tr>
                    <td><?= $i; ?></td>
                    <td><?= $item['fullname']; ?></td>
                    <td><?= count($get1); ?></td>
                    <td><?= count($get2); ?></td>
                    <td><?= count($get3); ?></td>
                  </tr>
                  <?php $i++; ?>
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
  function deleteData(a) {
    swal.fire({
        title: "Apa kamu yakin?",
        text: "Data akan terhapus",
        icon: "warning",
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
                swal.fire("Data Telah Terhapus", {
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
          xhr.open('DELETE', 'Corousel/' + a)
          xhr.send()
        }
      });
  }
</script>

<?= $this->endSection(); ?>