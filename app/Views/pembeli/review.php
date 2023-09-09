<?= $this->extend('pembeli/base'); ?>

<?= $this->section('content'); ?>

<div id="content">
  <div id="content-header">
    <hr>
    <a href="<?= base_url('PembeliPanel/Review/new'); ?>" style="margin-left: 20px;" class="btn btn-primary"> <i
        class="fa-solid fa-square-plus"></i>
      Tambah</a>
  </div>
  <div class="container-fluid">
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title">
            <span class="icon"><i class="icon-th"></i></span>
            <h5>Table Item</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Nama Item</th>
                  <th>Bintang</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php $db = \Config\Database::connect();
                $e = 1; ?>
                <?php foreach ($data as $item) : ?>
                <?php
                  $get = $db->table('item')->where('id_item', $item['id_item'])->get()->getRowArray();
                  ?>
                <tr>
                  <td><?= $e; ?></td>
                  <td><?= $get['nama_item']; ?></td>
                  <td>
                    <?php for ($i = 0; $i < $item['bintang']; $i++) : ?>
                    <i class="fa-solid fa-star" style="color: #ffd940;"></i>
                    <?php endfor; ?>
                  </td>
                  <td>
                    <div class="btn-group btn-group-lg" role="group">
                      <button onclick="deleteData('<?= $item['id_review_item']; ?>')" type="button"
                        class="btn btn-danger"><i class="fa fa-trash"></i></button>
                    </div>
                  </td>
                </tr>
                <?php $e++; ?>
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

<?= $this->section('script'); ?>

<script>
function deleteData(a) {
  swal.fire({
      title: "Apa kamu yakin?",
      text: "Data akan terhapus",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
    })
    .then((willDelete) => {
      if (willDelete) {
        var xhr = new XMLHttpRequest()
        xhr.onreadystatechange = function() {
          var DONE = 4; // readyState 4 means the request is done.
          var OK = 200; // status 200 is a successful return.
          if (xhr.readyState === DONE) {
            if (xhr.status === OK) {
              swal.fire("Data Telah Terhapus", {
                icon: "success",
              }).then(() => {
                window.location.reload()
              }) // 'This is the returned text.'
            } else {
              swal.fire("Terjadi kesalahan pada AJAX", {
                icon: "error",
              })
              console.log('Error: ' + xhr.status); // An error occurred during the request.
            }
          }
        }
        xhr.open('GET', 'ReviewDelete/' + a)
        xhr.send()
      }
    });
}
</script>

<?= $this->endSection(); ?>