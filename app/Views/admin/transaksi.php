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
            <h5>Table Keranjang Checkout</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>#</th>
                  <th>ID Pelanggan</th>
                  <th>ID Invoice</th>
                  <th>Nama Pembeli</th>
                  <th>Total Item</th>
                  <th>Jenis Reward</th>
                  <th>Total Harga</th>
                  <th>Discount (%)</th>
                  <th>Ongkos Kirim</th>
                  <th>Total Bayar (+ Ongkir)</th>
                  <th>Tanggal Order</th>
                  <th>Status</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php $db = \Config\Database::connect();
                $i = 0; 
                ?>
                <?php foreach ($keranjang as $item) : ?>
                <?php $get = $db->table('pembeli')->where('id_pembeli', $item['id_pembeli'])->get()->getRowArray(); ?>
                <?php $q = $db->table('pembeli_informasi')->where('id_pembeli', $item['id_pembeli'])->get()->getRowArray(); ?>
                <?php $d = $db->table('biaya_ongkir')->where('nama_kota', $q['kota'])->get()->getRowArray(); ?>
                <?php $alamat =  $q['kota'] . ', ' . $q['kec_desa'] . ' ' . $q['alamat'] . ' ' . $q['kode_pos']; 
                ?>
                <tr>
                  <td><?= $i += 1; ?></td>
                  <td><?= $get['id_pembeli']; ?></td>
                  <td><?= $item['id_cart_item']; ?></td>
                  <td><?= $get['fullname']; ?></td>
                  <td><?= $item['total_items']; ?></td>
                  <td><?= ($item['type_reward'] == 'free') ? 'Free 1 Meja' : 'Diskon' ?></td>
                  <td>Rp. <?= number_format($item['total_bayar'], 0, ',', '.'); ?></td>
                  <td><?= $item['potongan']; ?>%</td>
                  <td>Rp. <?= number_format($d['biaya'], 0, ',', '.'); ?></td>
                  <td>Rp. <?php
                            $bayarDiskon = ($item['total_bayar'] * ($item['potongan'] / 100)) + $d['biaya'];
                            $bayar = $item['total_bayar'] + $d['biaya'];

                            $total = ($item['potongan'] == 20) ? $bayarDiskon : $bayar;

                            echo number_format($total, 0, ',', '.');

                            ?></td>
                  <td><?= $item['tgl_checkout']; ?></td>
                  <td><?= $item['status_bayar']; ?></td>
                  <td>

                    <div class="btn-group-vertical btn-group-sm" role="group">
                       <?php if ($item['bukti_bayar'] != null) : ?>
                      <a href="#myModal<?= $i ?>" data-toggle="modal" class="btn btn-warning"><i class="fa-solid fa-eye"></i>
                        Lihat Bukti Bayar</a>
                      <?php endif ?>
                      <a onclick="modalShow('<?= $item['tgl_checkout'] ?>', '<?= ($item['tanggal_upload_bayar'] == null or $item['status_bayar'] == 'Menunggu Bukti Bayar') ? 'Belum Bayar' : $item['tanggal_upload_bayar']; ?>', '<?= $get['fullname']; ?>', '<?= $q['kota']; ?>, <?= $q['kec_desa']; ?> <?= $q['alamat']; ?>', '<?= $item['rowid']; ?>', '<?= str_replace('08', '628', $q['nomor_hp']); ?>', '<?= $item['type_reward'] ?>')"
                        class="btn btn-info">
                        <i class="fa-solid fa-eye"></i>
                        Detail Transaksi
                      </a>

                      <?php if ($item['status_bayar'] == 'Menunggu Validasi Bukti Bayar') : ?>
                      <a href="<?= base_url('AdmPanel/Validasi/' . $item['id_cart_item']); ?>"
                        class="btn btn-success"><i class="fa-solid fa-check"></i> Validasi Bukti Bayar</a>
                      <?php endif ?>

                      <?php if ($item['status_bayar'] == 'Diproses') : ?>
                      <a href="<?= base_url('AdmPanel/Kirim/' . $item['id_cart_item']); ?>" class="btn btn-primary"><i
                          class="fa-solid fa-truck-fast"></i> Ubah status menjadi Dikirim</a>
                      <?php endif ?>
                    </div>
                  </td>
                </tr>

                <div id="myModal<?= $i ?>" class="modal hide">
                  <div class="modal-header">
                    <button data-dismiss="modal" class="close" type="button">×</button>
                    <h3>Bukti Pembayaran</h3>
                  </div>
                  <div class="modal-body">
                    <p><img src="<?= base_url('uploads/' . $item['bukti_bayar']); ?>" /></p>
                  </div>
                  <div class="modal-footer"><a data-dismiss="modal" class="btn btn-inverse" href="#">Cancel</a> </div>
                </div>

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
                  <th>Nama Pembeli</th>
                  <th>Nama Item</th>
                  <th>Kuantitas</th>
                  <th>Total Harga</th>
                  <th>Tanggal Transaksi</th>
                </tr>
              </thead>
              <tbody>
                <?php $i = 0;
                foreach ($order as $item) : ?>
                <?php $get = $db->table('pembeli')->where('id_pembeli', $item['id_pembeli'])->get()->getRowArray(); ?>
                <tr>
                  <td><?= $i += 1; ?></td>
                  <td><?= $get['fullname']; ?></td>
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

<div id="myModal" class="modal hide">
  <div class="modal-header">
    <button data-dismiss="modal" class="close" type="button">×</button>
    <h3>Detail Transaksi</h3>
  </div>
  <div class="modal-body">

    <div class="control-group ">
      <label class="control-label">Nama Pembeli :</label>
      <div class="controls">
        <input type="text" class="span5" placeholder="" id='nama' readonly />
      </div>
    </div>
    <div class="control-group">
      <label class="control-label">Domisili & Alamat Lengkap :</label>
      <div class="controls">
        <input type="text" class="span5" placeholder="" id="alamat" readonly />
      </div>
    </div>

    <div class="control-group">
      <label class="control-label">Jenis Reward :</label>
      <div class="controls">
        <input type="text" class="span5" placeholder="" id="reward" readonly />
      </div>
    </div>
    
    <div class="control-group">
      <label class="control-label">Tanggal Bayar :</label>
      <div class="controls">
        <input type="text" class="span5" placeholder="" id="tgl_bayar" readonly />
      </div>
    </div>

    <table class="table table-striped">
      <thead>
        <tr>
          <th>Nama Produk</th>
          <th>Kuantitas</th>
          <th>Total Harga</th>
          <th>Tanggal Transaksi</th>
        </tr>
      </thead>
      <tbody id='tbody'>
      </tbody>
    </table>

  </div>
  <div class="modal-footer"><a data-dismiss="modal" class="btn btn-inverse" href="#">Cancel</a>
    <a target="_blank" class="btn btn-success" id="wa" href="#"><i class="fa-brands fa-whatsapp"></i> Hubungi
      Pembeli</a>
  </div>
</div>

<?= $this->endSection(); ?>

<?= $this->section('script'); ?>

<script>
const modalShow = (tgl_order = '', tgl_bayar = '', fullname = '', alamat = '', rowid = '', nomor_hp = '', reward_type = '') => {
  // console.log(fullname)
  $('#nama').val(fullname)
  $('#alamat').val(alamat)
  $('#wa').attr('href', 'https://wa.me/' + nomor_hp)
 // $('#tgl_order').val(tgl_order)
  $('#tgl_bayar').val(tgl_bayar)

  if (reward_type == 'free') {
    $('#reward').val('Free Item Meja')
  } else {
    $('#reward').val('Diskon 20%')
  }


  const xmlhttp = new XMLHttpRequest();
  xmlhttp.onload = function() {
    myObj = JSON.parse(this.responseText);
    let text = ""
    for (let x in myObj) {
      nama_item = myObj[x].nama_item;
      qty = myObj[x].qty_transactions;
      total_harga = myObj[x].total_harga;
      date = myObj[x].transactions_datetime;
      no = 1;

      text += `
        <tr>
          <td>${nama_item}</td>
          <td>${qty}</td>
          <td>Rp. ${total_harga}</td>
          <td>${date}</td>
        </tr>
        `;

      no++;
    }
    document.getElementById("tbody").innerHTML = text;
    $('#myModal').modal('toggle')
  }

  xmlhttp.open("GET", "GetTransaksi/" + rowid);
  // xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xmlhttp.send();
}
</script>

<?= $this->endSection(); ?>