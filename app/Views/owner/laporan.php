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
            <h5>Laporan Form</h5>
          </div>
          <div class="widget-content nopadding">
            <form action="<?= base_url('OwnerPanel/Print'); ?>" method="POST" class="form-horizontal">
              <div class="control-group">
                <label class="control-label">Dari Tanggal :</label>
                <div class="controls">
                  <input type="date" name="val1" class="span11" placeholder="" />
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Sampai Tanggal :</label>
                <div class="controls">
                  <input type="date" name="val2" class="span11" placeholder="" />
                </div>
              </div>
              <div class="form-actions">
                <button type="submit" class="btn btn-success">Proses Query</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?= $this->endSection(); ?>