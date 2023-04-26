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
            <h5></h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table-buttons">
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
                    <td>Rp. <?= $item['total_harga']; ?></td>
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