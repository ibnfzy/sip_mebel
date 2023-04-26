<?= $this->extend('admin/base'); ?>

<?= $this->section('content'); ?>

<div id="content">
  <div id="content-header">
    <hr>
    <a href="<?= base_url('AdmPanel/KategoriItem/new'); ?>" style="margin-left: 20px;" class="btn btn-primary"> <i class="fa-solid fa-square-plus"></i>
      Tambah</a>
  </div>
  <div class="container-fluid">
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title">
            <span class="icon"><i class="icon-th"></i></span>
            <h5>Table Kategori Item</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Kategori</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($kategori as $item) : ?>
                  <tr>
                    <td><?= $item['id_kategori']; ?></td>
                    <td><?= $item['nama_kategori']; ?></td>
                    <td>
                      <div class="btn-group btn-group-sm" role="group">
                        <a href="<?= base_url('AdmPanel/KategoriItem/' . $item['id_kategori'] . '/edit'); ?>" type="button" class="btn btn-info"><i class="fas fa-edit"></i></a>
                        <button onclick="deleteData('<?= $item['id_kategori']; ?>')" type="button" class="btn btn-danger"><i class="fas fa-trash" data-feather="trash-2"></i></button>
                      </div>
                    </td>
                  </tr>
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
          xhr.open('DELETE', 'KategoriItem/' + a)
          xhr.send()
        }
      });
  }
</script>

<?= $this->endSection(); ?>