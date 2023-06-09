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
                Invoice #: <?= $cart_item['id_cart_item']; ?><br />
                Created: <?= $cart_item['tgl_checkout']; ?><br />
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
        <td>Voucher Diskon (%): <?= $cart_item['potongan']; ?>%</td>
        <td>Total Bayar: Rp.
          <?php $bayarDiskon = ($subtotal * ($cart_item['potongan'] / 100)) + $dataToko['biaya_ongkir'];
          $bayar = $subtotal + $dataToko['biaya_ongkir'];

          echo $totalBayar = (isset($cart_item['potongan']) or $cart_item['potongan'] != 0) ? $bayarDiskon : $bayar;
          ?></td>
      </tr>

      <tr class="total">
        <td>Status Pembayaran : <?= $cart_item['status_bayar']; ?></td>
        <td><button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Upload Bukti
            Bayar</button> </td>
        <td><a type="button" href="" class="btn btn-success"><svg xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 448 512">
              <!--! Font Awesome Pro 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
              <path
                d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7.9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z" />
            </svg> Hubungi Toko</a> </td>
      </tr>
    </table>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Upload Bukti Pembayaran</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="<?= base_url('PembeliPanel/Upload_bukti_bayar/' . $cart_item['id_cart_item']); ?>" method="post"
          enctype="multipart/form-data">
          <div class="modal-body">
            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">Bukti Bayar <span class="text-danger">*Max ukuran file
                  2mb</label>
              <input type="file" class="form-control" id="file" name="gambar" accept="image/*">
              <!-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div> -->
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Upload</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
  </script>
</body>

</html>