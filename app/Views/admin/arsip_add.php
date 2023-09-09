<?= $this->extend('admin/base'); ?>

<?= $this->section('content'); ?>

<div id="content">
  <div id="content-header">
    <button onclick="history.back()" class="btn btn-primary"><i class="icon icon-arrow-left"></i> Kembali</button>
  </div>
  <div class="container-fluid">
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title">
            <span class="icon"><i class="icon-th"></i></span>
            <h5>Simpan Laporan</h5>
          </div>
          <div class="widget-content nopadding">
            <form action="<?= base_url('AdmPanel/ArsipLaporan'); ?>" method="POST" class="form-horizontal"
              enctype="multipart/form-data">
              <div class="control-group">
                <label class="control-label">Nama Laporan :</label>
                <div class="controls">
                  <input name="nama_laporan" type="text" class="span11" placeholder="" />
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">File Arsip Laporan </label>
                <div class="controls">
                  <input type="file" name="file" id="file" accept="application/pdf">
                </div>
              </div>
              <div class="form-actions">
                <button type="submit" class="btn btn-success">Save</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?= $this->endSection(); ?>