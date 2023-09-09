<?= $this->extend('pembeli/base'); ?>

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
            <h5>ID Pelanggan #<?= $_SESSION['id_pembeli'] ?> - <?= $_SESSION['fullname'] ?></h5>
          </div>
          <div class="widget-content">
            <?= $pager->links('items', 'pagers') ?>

            <ul class="thumbnails">

              <?php foreach ($data as $item) : ?>
                <li class="span3">
                  <a target="_blank" class="thumbnail" href="<?= base_url('Item/' . $item['id_item']); ?>">
                    <p><?= $item['nama_item']; ?></p>
                    <img style="height: 200px;" width="200" height="200" src="<?= base_url('uploads/' . $item['gambar_item']); ?>" alt="">
                    <p>Rp. <?= $item['harga_item']; ?> | Stok <?= $item['stok_item']; ?></p>
                  </a>
                  <div class="actions">
                    <a title="" href="<?= base_url('Item/' . $item['id_item']); ?>"><i class="fa-regular fa-eye"></i></a>
                  </div>
                </li>
              <?php endforeach ?>

            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?= $this->endSection(); ?>