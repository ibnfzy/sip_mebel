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
  <!-- Invoice styling -->
  <style>
  body {
    font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
    text-align: center;
    color: #777;
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
  <div class="invoice-box">
    <table>
      <tr class="top">
        <td colspan="2">
          <table>
            <tr>
              <td class="title">
                <!-- <img src="./images/logo.png" alt="Company logo" style="width: 100%; max-width: 300px" /> -->
                <button onclick="history.back()" class="btn btn-primary" type="button">Kembali</button>
              </td>

              <td>
                Invoice #: <?= $keranjang['id_cart_item']; ?><br />
                Created: <?= $keranjang['tgl_checkout']; ?><br />
              </td>
            </tr>
          </table>
        </td>
      </tr>

      <tr class="information">
        <td colspan="2">
          <table>
            <tr>
              <td>
                🏘 Meubel Shop.<br />
                <?= $dataToko['alamat_toko']; ?> <br>
                <?= $dataToko['kontak_toko']; ?>
              </td>

              <td>
                <?= $_SESSION['fullname']; ?>.<br />
                <?= $dataUser['alamat']; ?><br />
                <?= $dataUser['nomor_hp']; ?>
              </td>
            </tr>
          </table>
        </td>
      </tr>


      <tr class="heading">
        <td>Nama Item</td>
        <td>Kuantitas</td>
        <td>Total Harga</td>
        <td>Tanggal Transaksi</td>
      </tr>

      <?php $i = 1;
      $total = [];
      foreach ($data as $item) : ?>
      <?php $total[] = $item['total_harga']; ?>
      <tr class="item">
        <td><?= $i++; ?></td>
        <td><?= $item['nama_item']; ?></td>
        <td><?= $item['qty_transactions']; ?></td>
        <td>Rp. <?= $item['total_harga']; ?></td>
        <td><?= $item['transactions_datetime']; ?></td>
      </tr>
      <?php endforeach ?>


      <tr class="total">
        <td>Subtotal: Rp. <?= $subtotal = array_sum($total); ?></td>
        <td>Biaya Ongkir: Rp.
          <?= $dataToko['biaya_ongkir']; ?></td>
        <td>Voucher Diskon (%): <?= $keranjang['potongan']; ?>%</td>
        <td>Total Bayar: Rp.
          <?php $bayarDiskon = ($subtotal * ($keranjang['potongan'] / 100)) + $dataToko['biaya_ongkir'];
          $bayar = $subtotal + $dataToko['biaya_ongkir'];

          echo $totalBayar = (isset($keranjang['potongan']) or $keranjang['potongan'] != 0) ? $bayarDiskon : $bayar;
          ?></td>
      </tr>

      <tr class="total">
        <td>Status Pembayaran : <?= $keranjang['status_bayar']; ?></td>
        <td><button <?= $disable = ($keranjang['bukti_bayar'] != null) ? '' : 'disabled'; ?> class="btn btn-primary"
            data-toggle="modal" data-target="#exampleModal">Lihat Bukti
            Bayar</button> </td>
        <td><a type="button" href="" class="btn btn-success">Validasi Bukti Bayar</a> </td>
      </tr>
    </table>
  </div>

  <?php if ($keranjang['bukti_bayar'] != null) : ?>

  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Bukti Pembayaran</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">
          <div class="mb-3">
            <img src="<?= base_url('uploads/' . $keranjang['bukti_bayar']); ?>" alt="Gambar Gagal Memuat" width="500">

          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  <?php endif; ?>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
  </script>
</body>

</html>