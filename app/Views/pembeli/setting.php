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
            <h5>Informasi Setting</h5>
          </div>
          <div class="widget-content nopadding">
            <form action="<?= base_url('PembeliPanel/Setting/' . $data['id_pembeli_informasi']); ?>" method="POST" class="form-horizontal">
              <div class="control-group">
                <label class="control-label">Kota</label>
                <div class="controls">
                  <?= form_dropdown('kota', $ongkir, $data['kota'] ? $data['kota'] : ''); ?>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Alamat Lengkap :</label>
                <div class="controls">
                  <input name="alamat" type="text" class="span11" placeholder="" value="<?= $data['alamat']; ?>" />
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Nomor Kontak :</label>
                <div class="controls">
                  <input name="nomor" type="text" class="span11" value="<?= $data['nomor_hp'] ?>" placeholder="" />
                </div>
              </div>

              <div class="control-group">
                <label class="control-label">Kecamatan / Desa :</label>
                <div class="controls">
                  <input name="desa" type="text" class="span11" value="<?= $data['kec_desa'] ?>" placeholder="" />
                </div>
              </div>
<!--
              <div class="control-group">
                <label class="control-label">Kode Pos :</label>
                <div class="controls">
                  <input name="kode_pos" type="text" class="span11" value="<?= $data['kode_pos'] ?>" placeholder="" />
                </div>
              </div>
-->
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