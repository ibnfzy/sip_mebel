<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <title>Invoice</title>

  <!-- Favicon -->
  <!-- <link rel="icon" href="./images/favicon.png" type="image/x-icon" /> -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <link rel="stylesheet" href="<?= base_url(''); ?>/fontawesome-free-6.4.0-web/css/all.min.css" />
  <!-- Invoice styling -->
  <script src="<?= base_url(''); ?>/swal/dist/sweetalert2.min.js"></script>
  <link rel="stylesheet" href="<?= base_url(''); ?>/swal/dist/sweetalert2.min.css">
  <link rel="stylesheet" href="<?= base_url('/'); ?>/toastr/build/toastr.min.css">
  <style>
    body {
      font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
      text-align: center;
      color: #777;
      background: rgb(238, 174, 202);
      background: linear-gradient(90deg, rgba(238, 174, 202, 1) 0%, rgba(148, 187, 233, 1) 100%);
    }

    body h1 {
      font-weight: 300;
      margin-bottom: 0px;
      padding-bottom: 0px;
      color: #000;
    }

    body h3 {
      font-weight: 300;
      margin-top: 10px;
      margin-bottom: 20px;
      font-style: italic;
      color: #555;
    }

    body a {
      color: #06f;
    }

    .invoice-box {
      max-width: 800px;
      margin: auto;
      padding: 30px;
      border: 1px solid #eee;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
      font-size: 16px;
      line-height: 24px;
      font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
      color: #555;
      background-color: white;
    }

    .invoice-box table {
      width: 100%;
      line-height: inherit;
      text-align: left;
      border-collapse: collapse;
    }

    .invoice-box table td {
      padding: 5px;
      vertical-align: top;
    }

    .invoice-box table tr td:nth-child(2) {
      text-align: right;
    }

    .invoice-box table tr.top table td {
      padding-bottom: 20px;
    }

    .invoice-box table tr.top table td.title {
      font-size: 45px;
      line-height: 45px;
      color: #333;
    }

    .invoice-box table tr.information table td {
      padding-bottom: 40px;
    }

    .invoice-box table tr.heading td {
      background: #eee;
      border-bottom: 1px solid #ddd;
      font-weight: bold;
    }

    .invoice-box table tr.details td {
      padding-bottom: 20px;
    }

    .invoice-box table tr.item td {
      border-bottom: 1px solid #eee;
    }

    .invoice-box table tr.item.last td {
      border-bottom: none;
    }

    .invoice-box table tr.total td:nth-child(2) {
      border-top: 2px solid #eee;
      font-weight: bold;
    }

    @media only screen and (max-width: 600px) {
      .invoice-box table tr.top table td {
        width: 100%;
        display: block;
        text-align: center;
      }

      .invoice-box table tr.information table td {
        width: 100%;
        display: block;
        text-align: center;
      }
    }
  </style>
</head>

<body>
  <?php $db = \Config\Database::connect(); ?>
  <?php $get = $db->table('biaya_ongkir')->where('nama_kota', $datapembeli['kota'])->get()->getRowArray(); ?>
  <div class="invoice-box">
    <table>
      <tr class="top">
        <td colspan="3">
          <table>
            <tr>
              <td class="title">
                <!-- <img src="./images/logo.png" alt="Company logo" style="width: 100%; max-width: 300px" /> -->
                <button onclick="history.back()" class="btn btn-primary" type="button"><i
                    class="fa-solid fa-arrow-left"></i> Kembali</button>
              </td>

              <td>
                Invoice #:
                <?= $cart_item['id_cart_item']; ?><br />
                Created:
                <?= $cart_item['tgl_checkout']; ?><br />
                Batas Pembayaran:
                <?= ($cart_item['batas_pembayaran'] != null) ? $cart_item['batas_pembayaran'] : 'Sudah Mengupload Bukti Bayar' ?>
              </td>
            </tr>
          </table>
        </td>
      </tr>

      <tr class="information">
        <td colspan="7">
          <table>
            <tr>
              <td colspan="3">
                🏘 Fauzan Meubel.<br />
                <?= $dataToko['alamat_toko']; ?> <br>
                <?= $dataToko['kontak_toko']; ?>
              </td>

              <td></td>

              <td>
                <?= $_SESSION['fullname']; ?>.<br />
                <?= $get['nama_kota']; ?>,
                <?= $datapembeli['kec_desa']; ?>
                <?= $datapembeli['alamat']; ?><br />
                <?= $datapembeli['nomor_hp']; ?>
              </td>
            </tr>
          </table>
        </td>
      </tr>

      <tr class="heading">
        <td>#</td>
        <td>Nama Item</td>
        <td>Kuantitas</td>
        <td>Diskon</td>
        <td>Total Harga</td>
        <td>Tanggal Order</td>
      </tr>

      <?php $i = 1;
      $total = [];
      foreach ($data as $item): ?>
        <?php $total[] = $item['total_harga']; ?>
        <tr class="item">
          <td>
            <?= $i++; ?>
          </td>
          <td>
            <?= $item['nama_item']; ?>
          </td>
          <td>
            <?= $item['qty_transactions']; ?>
          </td>
          <td>
            <?= ($item['potongan'] == 1) ? $cart_item['potongan'] : 0; ?> %
          </td>
          <td>Rp.
            <?= number_format($item['total_harga'], 0, ',', '.'); ?>
          </td>
          <td>
            <?= $item['transactions_datetime']; ?>
          </td>
        </tr>
      <?php endforeach ?>


      <tr class="total">
        <td colspan="3">Subtotal: Rp.
          <?php $subtotal = array_sum($total);
          echo number_format($subtotal, 0, ',', '.') ?>
        </td>
        <!-- <td colspan="3">Diskon (%):
          <?= $cart_item['potongan']; ?>%
        </td> -->
        <td colspan="3">Jenis Reward :
          <?= ($cart_item['type_reward'] == 'free') ? 'Free 1 Meja' : 'Diskon'; ?>
        </td>
      </tr>

      <tr class="total">
        <td colspan="3">Biaya Ongkir: Rp.
          <?= number_format($get['biaya'], 0, ',', '.'); ?>
        </td>
        <td colspan="3">Total Bayar: Rp.
          <?php $bayarDiskon = $subtotal + $get['biaya'];
          $bayar = $subtotal + $get['biaya'];

          $totalBayar = ($cart_item['potongan'] != 0) ? $bayarDiskon : $bayar;
          echo number_format($totalBayar, 0, ',', '.')
            ?>
        </td>
      </tr>

      <tr class="total">
        <td colspan="3">Status Pembayaran :
          <?= $cart_item['status_bayar']; ?>
        </td>
        <td colspan="3">Metode Pembayaran :
          <?= $cart_item['metode_pembayaran']; ?>
        </td>
      </tr>
      <tr>
        <!-- <td>Jenis Reward :
          <?= ($cart_item['type_reward'] == 'free') ? 'Free 1 Meja' : 'Diskon'; ?>
        </td> -->
      </tr>
    </table>
    <table>
      <tr>
        <td>Silahkan menyelesaikan transaksi dengan mengirim pembayaran dengan nominal Rp.
          <?= number_format($totalBayar, 0, ',', '.') ?> ke BANK XYZ 123456789 A/N Wulan
        </td>
      </tr>
    </table>
    <hr>
    <div class="row">
      <div class="col-4">
        <!-- ($cart_item['metode_pembayaran'] == 'Transfer') ? '' : 'disabled' -->
        <button <?= ($cart_item['status_bayar'] == 'GAGAL') ? 'disabled' : '' ?> class="btn btn-primary"
          data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fa-solid fa-upload"></i> Upload Bukti
          Bayar</button>
      </div>
      <div class="col-4"> <a type="button" target="_blank"
          href="https://wa.me/<?= str_replace('08', '628', $dataToko['kontak_toko']); ?>" class="btn btn-success"><i
            class="fa-brands fa-whatsapp"></i> Hubungi
          Toko</a></div>
      <div class="col-4"><a type="button" href="javascript::void" onclick="window.print()" class="btn btn-secondary"><i
            class="fa-solid fa-print"></i> Print</a>
      </div>
    </div>
  </div>

  <!-- Modal -->
  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Upload Bukti Bayar *Max <= 2Mb</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="<?= base_url('PembeliPanel/Upload_bukti_bayar/' . $cart_item['id_cart_item']); ?>" method="post"
          enctype="multipart/form-data">
          <div class="modal-body">
            <div class="mb-3">
              <!-- <label for="exampleFormControlInput1" class="form-label">Email address</label> -->
              <input type="file" class="form-control" name="gambar" id="exampleFormControlInput1" accept="image/*">
            </div>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Upload</button>
          </div>
        </form>
      </div>
    </div>
  </div>


  <script src="<?= base_url(''); ?>/js/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>
  <script src="<?= base_url('/'); ?>/toastr/build/toastr.min.js"></script>
  <script src="<?= base_url('/'); ?>/fontawesome-free-6.4.0-web/js/all.min.js"></script>
</body>

</html>