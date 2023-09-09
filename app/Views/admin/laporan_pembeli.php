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
            <button id="print" style="margin-left: 20px;" class="btn btn-secondary"><i class="fa-solid fa-print"></i>
              Print</button>
            <button onclick="javascript:demoFromHTML();" style="margin-left: 20px;" class="btn btn-danger"><i
                class="fa-solid fa-file-pdf"></i>
              Download PDF</button>
          </div>
          <div class="widget-content nopadding">
            <table id="printTable" class="table table-bordered data-table-buttons">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Nama Pembeli</th>
                  <th scope="col">Total Barang yang dibeli</th>
                  <th>Total Transaksi Checkout</th>
                  <th>Total Transaksi Checkout Berhasil</th>
                  <th>Bukti Pembayaran belum diValidasi</th>
                  <th>Status Pelanggan</th>
                </tr>
              </thead>
              <tbody>
                <?php

                use CodeIgniter\Database\RawSql;

                $i = 1;
                foreach ($data as $item) : ?>
                <?php $db = \Config\Database::connect();
                  // dd($getBarang['fullname']);
                  $get1 = $db->table('cart_item')->where('id_pembeli', $item['id_pembeli'])->get()->getResultArray();
                  $get2 = $db->table('cart_item')->where('id_pembeli', $item['id_pembeli'])->where('status_bayar', 'Selesai')->get()->getResultArray();
                  $get3 = $db->table('cart_item')->where('id_pembeli', $item['id_pembeli'])->where('status_bayar', 'Menunggu Validasi Bukti Bayar')->get()->getResultArray();
                  $get4 = $db->table('transactions')
                    ->select(new RawSql('DISTINCT id_pembeli, COUNT(id_pembeli) as total_transaksi, transactions_datetime'))
                    ->where('id_pembeli', $item['id_pembeli'])
                    ->groupBy('id_pembeli')->get()->getRowArray();

                  // dd($get4);

                  $status = 'Customer Baru';
                  if (count($get1) >= 5) {
                    $status = 'Pelanggan Loyal';
                  } else if (count($get1) != 0) {
                    $status = 'Customer';
                  }
                  ?>
                <tr>
                  <th><?= $i++; ?></th>
                  <td><?= $item['fullname']; ?></td>
                  <td><?= $get4['total_transaksi'] ?? '0'; ?></td>
                  <td><?= count($get1); ?></td>
                  <td><?= count($get2); ?></td>
                  <td><?= count($get3); ?></td>
                  <td><?= $status; ?></td>
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
function printData() {
  var divToPrint = document.getElementById("printTable");
  newWin = window.open("");
  newWin.document.write(divToPrint.outerHTML);
  newWin.print();
  newWin.close();
}

const btn = document.getElementById("print");
btn.addEventListener('click', () => printData())

function demoFromHTML() {
  var doc = new jspdf.jsPDF()

  doc.autoTable({
    html: '#printTable'
  })

  doc.save('laporan.pdf')
}
</script>
<?= $this->endSection(); ?>