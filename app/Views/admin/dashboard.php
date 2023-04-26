<?= $this->extend('admin/base'); ?>

<?= $this->section('content'); ?>

<div id="content">
  <div id="content-header">

  </div>
  <div class="container-fluid">
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box widget-plain">
          <div class="center">
            <ul class="stat-boxes">
              <li style="background-color: lightblue;">
                <div class="left peity_bar_neutral">
                  <span>
                    <i class="fa-solid fa-tags fa-2xl"></i>
                  </span>
                  ...
                </div>
                <div class="right"> <strong><?= $voucher; ?></strong> Voucher Tersedia </div>
              </li>

              <li style="background-color: lightpink;">
                <div class="left peity_bar_neutral">
                  <span>
                    <i class="fa-solid fa-users fa-2xl"></i>
                  </span>
                  ...
                </div>
                <div class="right"> <strong><?= $pembeli; ?></strong> Total Akun Pembeli </div>
              </li>

              <li style="background-color: lightyellow;">
                <div class="left peity_bar_neutral">
                  <span>
                    <i class="fa-solid fa-boxes-stacked fa-2xl"></i>
                  </span>
                  ...
                </div>
                <div class="right"> <strong><?= $itemstok; ?></strong> Total Stok Item Tersedia </div>
              </li>

              <li style="background-color: lightgreen;">
                <div class="left peity_bar_neutral">
                  <span>
                    <i class="fa-solid fa-receipt fa-2xl"></i>
                  </span>
                  ...
                </div>
                <div class="right"> <strong><?= $verifikasi; ?></strong> Total Butuh Verifikasi Bukti Bayar </div>
              </li>
            </ul>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>

<?= $this->endSection(); ?>