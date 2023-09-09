<?= $this->extend('owner/base'); ?>

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
                  <th scope="col">Nama Item</th>
                  <th scope="col">Total Harga</th>
                  <th scope="col">Waktu</th>
                  <th scope="col">Kuantitas Item</th>
                </tr>
              </thead>
              <tbody>
                <?php $i = 1;
                foreach ($data as $item) : ?>
                <tr>
                  <th><?= $i++; ?></th>
                  <td><?= $item['fullname']; ?></td>
                  <td><?= $item['nama_item']; ?></td>
                  <td>Rp. <?= number_format($item['total_harga'], 0, ',', '.'); ?></td>
                  <td><?= $item['transactions_datetime']; ?></td>
                  <td><?= $item['qty_transactions']; ?></td>
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