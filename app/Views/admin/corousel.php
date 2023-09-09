<?= $this->extend('admin/base'); ?>

<?= $this->section('content'); ?>

<div id="content">
  <div id="content-header">
    <hr>
    <a href="<?= base_url('AdmPanel/Corousel/new'); ?>" style="margin-left: 20px;" class="btn btn-primary"><i class="fa-solid fa-square-plus"></i>
      Tambah</a>
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
                  <th>Text</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php $i = 1;
                foreach ($data as $item) : ?>
                  <tr>
                    <td><?= $i; ?></td>
                    <td><img src="<?= base_url('uploads/' . $item['gambar']); ?>" alt="Gambar <?= $item['header']; ?>" width="100">
                    <td><?= $item['header']; ?></td>
                    <td>
                      <div class="btn-group btn-group-sm" role="group">
                        <a href="<?= base_url('AdmPanel/Corousel/' . $item['id_corousel'] . '/edit'); ?>" type="button" class="btn btn-info"><i class="fas fa-edit"></i></a>
                        <button onclick="deleteData('<?= $item['id_corousel']; ?>')" type="button" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                      </div>
                    </td>
                  </tr>
                  <?php $i++; ?>
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
          xhr.open('GET', 'CorouselDelete/' + a)
          xhr.send()
        }
      });
  }
</script>

<?= $this->endSection(); ?>