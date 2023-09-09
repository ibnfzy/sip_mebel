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
            <h5>Edit Item</h5>
          </div>
          <div class="widget-content nopadding">
            <form action="<?= base_url('AdmPanel/Item/' . $item['id_item']); ?>" method="POST" class="form-horizontal"
              enctype="multipart/form-data">
              <input type="hidden" name="_method" value="PUT">
              <div class="control-group">
                <label class="control-label">Nama Item :</label>
                <div class="controls">
                  <input name="nama" type="text" class="span11" placeholder="" value="<?= $item['nama_item']; ?>" />
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Harga Item : </label>
                <div class="controls">
                  <div class="input-prepend"> <span class="add-on">Rp. </span>
                    <input type="number" placeholder="" class="span11" value="<?= $item['harga_item']; ?>" name="harga">
                  </div>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Stok Item :</label>
                <div class="controls">
                  <input name="stok_item" type="number" class="span11" value="<?= $item['stok_item']; ?>"
                    placeholder="" />
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Kategori Item</label>
                <div class="controls">
                  <?= form_dropdown('kategori', $option, $item['kategori_item']); ?>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Gambar Item max file size <=2mb *Mengkosongkan akan menyimpan file
                    lama</label>
                    <div class="controls">
                      <?= form_input('gambar', '', [
                        'accept' => 'image/*'
                      ], 'file'); ?>
                    </div>
              </div>
              <div class="control-group">
                <label class="control-label">Deskripsi Item</label>
                <div class="controls">
                  <?= form_textarea('desc', $item['desc_item'], [
						'id' => 'editor'
					]); ?>
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
  
  <?= $this->section('script'); ?>
  <script>
  CKEDITOR.replace( 'editor' );
  </script>
<?= $this->endSection(); ?>