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
                  <th scope="col">Nama item</th>
                  <th scope="col">Total Transaksi</th>
                  <th scope="col">Waktu Transaksi</th>
                </tr>
              </thead>
              <tbody>
                <?php $i = 1;
                foreach ($data as $item) : ?>
                <?php $db = \Config\Database::connect();
                  $getitem = $db->table('item')->where('id_item', $item['id_item'])->get(1)->getRow();
                  // dd($getitem);
                  ?>
                <tr>
                  <th><?= $i++; ?></th>
                  <td><?= $getitem->nama_item; ?></td>
                  <td><?= $item['total_transaksi']; ?></td>
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