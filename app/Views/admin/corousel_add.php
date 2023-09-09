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
            <h5>Tambah Foto Corousel</h5>
          </div>
          <div class="widget-content nopadding">
            <form action="<?= base_url('AdmPanel/Corousel'); ?>" method="POST" class="form-horizontal" enctype="multipart/form-data">
              <div class="control-group">
                <label class="control-label">Text Corousel :</label>
                <div class="controls">
                  <input name="header" type="text" class="span11" placeholder="" />
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Gambar Corousel max file size <=2mb </label>
                    <div class="controls">
                      <?= form_input('file', '', [
                        'accept' => 'image/*'
                      ], 'file'); ?>
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