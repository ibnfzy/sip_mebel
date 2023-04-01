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
            <h5>Tambah Kategori Item</h5>
          </div>
          <div class="widget-content nopadding">
            <form action="<?= base_url('AdmPanel/Settings'); ?>" method="POST" class="form-horizontal">
              <input type="hidden" name="_method" value="PUT">
              <div class="control-group">
                <label class="control-label">Alamat Toko :</label>
                <div class="controls">
                  <input name="kategori" type="text" class="span11" placeholder=""
                    value="<?= $data['alamat_toko']; ?>" />
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Kontak Toko :</label>
                <div class="controls">
                  <input name="kategori" type="text" class="span11" placeholder=""
                    value="<?= $data['kontak_toko']; ?>" />
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Biaya Ongkir :</label>
                <div class="controls">
                  <input name="kategori" type="text" class="span11" placeholder=""
                    value="<?= $data['biaya_ongkir']; ?>" />
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