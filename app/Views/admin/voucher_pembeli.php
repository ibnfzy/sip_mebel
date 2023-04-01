<?= $this->extend('admin/base'); ?>

<?= $this->section('content'); ?>

<div id="content">
</div>
<div class="container-fluid">
  <div class="row-fluid">
    <div class="span12">
      <div class="widget-box">
        <div class="widget-title">
          <span class="icon"><i class="icon-th"></i></span>
          <h5>Table Kategori Item</h5>
        </div>
        <div class="widget-content nopadding">
          <table class="table table-bordered data-table">
            <thead>
              <tr>
                <th>#</th>
                <th>Fullname</th>
                <th>ID Voucher</th>
                <th>Potongan (%)</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($data as $item) : ?>
              <tr>
                <td><?= $item['id_pembeli_voucher']; ?></td>
                <td><?= $item['fullname']; ?></td>
                <td><?= $item['potongan']; ?></td>
                <td><?= $item['status']; ?></td>
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