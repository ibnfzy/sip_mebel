<?= $this->extend('owner/base'); ?>

<?= $this->section('content'); ?>

<div id="content">
  <div id="content-header">
    <hr>

  </div>
  <div class="container-fluid">
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title">
            <span class="icon"><i class="icon-th"></i></span>
            <h5>Table Corousel</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Nama Laporan</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php $i = 1;
                foreach ($data as $item) : ?>
                <tr>
                  <td><?= $i; ?></td>
                  <td><?= $item['nama_laporan']; ?></td>
                  <td>
                    <div class="btn-group btn-group-sm" role="group">
                      <a href="<?= base_url('uploads/'.$item['nama_file']); ?>" type="button" class="btn btn-info"
                        download=""><i class="fa-regular fa-file-pdf"></i> Buka PDF</a>
                      <a href="<?= base_url('OwnerPanel/Arsip/' . $item['id_arsip_laporan']); ?>" type="button"
                        class="btn btn-danger"><i class="fa-solid fa-download"></i> Download</a>
                    </div>
                  </td>
                </tr>
                <?php $i++; ?>
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