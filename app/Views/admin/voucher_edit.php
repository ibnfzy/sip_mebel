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
            <h5>Tambah Voucher</h5>
          </div>
          <div class="widget-content nopadding">
            <form action="<?= base_url('AdmPanel/Voucher/' . $data['id_voucher']); ?>" method="POST"
              class="form-horizontal">
              <input type="hidden" name="_method" value="PUT">
              <div class="control-group">
                <label class="control-label">Title Voucher :</label>
                <div class="controls">
                  <input name="kategori" type="text" class="span11" placeholder=""
                    value="<?= $data['title_voucher']; ?>" />
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Potongan Diskon (%) :</label>
                <div class="controls">
                  <input name="kategori" type="number" class="span11" placeholder="" value="<?= $data['persen']; ?>" />
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Untuk Jenis Pelanggan :</label>
                <div class="controls">
                  <?= form_dropdown('jenis', [
                    'Pelanggan Baru' => 'Pelanggan Baru',
                    'Pelanggan Lama' => 'Pelanggan Lama',
                    'Pelanggan Loyal' => 'Pelanggan Loyal',
                  ], $data['jenis_pembeli_for']); ?>
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