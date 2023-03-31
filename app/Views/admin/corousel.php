<?= $this->extend('admin/base'); ?>

<?= $this->section('content'); ?>

<div id="content">
  <div id="content-header">
    <a href="<?= base_url('AdmPanel/Corousel/new'); ?>" class="btn btn-primary"><i class="icon icon-plus-sign"></i>
      Tambah</button>
  </div>
  <div class="container-fluid">
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title">
            <span class="icon"><i class="icon-th"></i></span>
            <h5>Table Corousel</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Gambar</th>
                  <th>Header Corousel</th>
                  <th>Link Halaman</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($data as $item) : ?>
                  <tr>
                    <td><?= $item['id_corousel']; ?></td>
                    <td><img src="<?= base_url('uploads/' . $item['gambar']); ?>" alt="Gambar <?= $item['header']; ?>" width="100">
                    <td><?= $item['header']; ?></td>
                    <td><a title="Buka Link" href="<?= $item['link_to']; ?>" class="btn btn-warning"><i class="fas fa-external-link-alt"></i>
                      </a></td>
                    <td>
                      <div class="btn-group btn-group-sm" role="group">
                        <a href="<?= base_url('AdmPanel/Corousel/' . $item['id_corousel'] . '/edit'); ?>" type="button" class="btn btn-info"><i class="fas fa-edit"></i></a>
                        <button onclick="deleteData('<?= $item['id_corousel']; ?>')" type="button" class="btn btn-danger"><i class="fas fa-trash"></i></button>
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
          xhr.open('DELETE', 'Corousel/' + a)
          xhr.send()
        }
      });
  }
</script>

<?= $this->endSection(); ?>