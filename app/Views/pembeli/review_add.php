<?= $this->extend('pembeli/base'); ?>

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
            <h5>Tambah Item</h5>
          </div>
          <div class="widget-content nopadding">
            <form action="<?= base_url('PembeliPanel/Review'); ?>" method="POST" class="form-horizontal">
              <div class="control-group">
                <label class="control-label">Item</label>
                <div class="controls">
                  <?= form_dropdown('id_item', $data, ''); ?>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Nilai</label>
                <div class="controls">
                  <select name="nilai" id="nilai">
                    <option value="1"> ⭐ </option>
                    <option value="2"> ⭐⭐</option>
                    <option value="3"> ⭐⭐⭐</option>
                    <option value="4"> ⭐⭐⭐⭐</option>
                    <option value="5"> ⭐⭐⭐⭐⭐</option>
                  </select>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Deskripsi Review</label>
                <div class="controls">
                  <?= form_textarea('isi', ''); ?>
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