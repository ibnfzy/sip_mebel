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
                  <th scope="col">ID Pelanggan</th>
                  <th scope="col">Nama Pembeli</th>
                  <th scope="col">Nama Item</th>
                  <th scope="col">Total Harga</th>
                  <th scope="col">Waktu</th>
                  <th scope="col">Kuantitas Item</th>
                </tr>
              </thead>
              <tbody>
                <?php $i = 1;
                foreach ($data as $item): ?>
                <tr>
                  <th>
                    <?= $i++; ?>
                  </th>
                  <td>
                    <?= $item['id_pembeli']; ?>
                  </td>
                  <td>
                    <?= $item['fullname']; ?>
                  </td>
                  <td>
                    <?= $item['nama_item']; ?>
                  </td>
                  <td>Rp.
                    <?= number_format($item['total_harga'], 0, ',', '.'); ?>
                  </td>
                  <td>
                    <?= $item['transactions_datetime']; ?>
                  </td>
                  <td>
                    <?= $item['qty_transactions']; ?>
                  </td>
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
  const d = new Date()
  const months = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober",
    "November", "December"
  ];
  let month = months[d.getMonth()];
  let fulldate = d.getDate() + ' ' + month + ' ' + d.getFullYear();
  var doc = new jspdf.jsPDF()

  doc.setFontSize(17)
  doc.text('LAPORAN TRANSAKSI', 110, 10, 'center')
  doc.text('TOKO FAUZAN MEUBLE', 110, 16, 'center')
  doc.setFontSize(12)
  doc.text('Desa Arpal, Kecamatan Arungkeke, Kab. Jeneponto', 110, 20, 'center')
  doc.text('Sulawesi Selatan', 110, 25, 'center')
  doc.autoTable({
    html: '#printTable',
    margin: {
      top: 30
    },
    'autoPaging': 'text'
  });

  var finalY = doc.lastAutoTable.finalY
  doc.setFontSize(12)
  doc.text('Jeneponto, ' + fulldate, 140, finalY + 20)
  doc.text('Admin', 140, finalY + 35)

  doc.save('laporan.pdf')
}
</script>
<?= $this->endSection(); ?>