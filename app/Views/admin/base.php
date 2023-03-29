<!DOCTYPE html>
<html lang="en">

<head>
  <title>Admin Panel</title>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="<?= base_url(''); ?>/css/bootstrap.min.css" />
  <link rel="stylesheet" href="<?= base_url(''); ?>/css/bootstrap-responsive.min.css" />
  <link rel="stylesheet" href="<?= base_url(''); ?>/css/fullcalendar.css" />
  <link rel="stylesheet" href="<?= base_url(''); ?>/css/font-awesome.css" />
  <script src="<?= base_url(''); ?>/swal/dist/sweetalert2.min.js"></script>
  <link rel="stylesheet" href="<?= base_url(''); ?>/swal/dist/sweetalert2.min.css">
  <link rel="stylesheet" href="<?= base_url('/'); ?>/toastr/build/toastr.min.css">
  <link rel="stylesheet" href="<?= base_url(''); ?>/css/maruti-style.css" />
  <link rel="stylesheet" href="<?= base_url(''); ?>/css/maruti-media.css" class="skin-color" />
</head>

<body>

  <?= $this->include('admin/layout/navbar'); ?>

  <?= $this->renderSection('content'); ?>

  <?= $this->include('admin/layout/footer'); ?>

  <script src="<?= base_url(''); ?>/js/excanvas.min.js"></script>
  <script src="<?= base_url(''); ?>/js/jquery.min.js"></script>
  <script src="<?= base_url(''); ?>/js/jquery.ui.custom.js"></script>
  <script src="<?= base_url(''); ?>/js/bootstrap.min.js"></script>
  <script src="<?= base_url(''); ?>/js/jquery.flot.min.js"></script>
  <script src="<?= base_url(''); ?>/js/jquery.flot.resize.min.js"></script>
  <script src="<?= base_url(''); ?>/js/jquery.peity.min.js"></script>
  <script src="<?= base_url(''); ?>/js/fullcalendar.min.js"></script>

  <script src="<?= base_url('/'); ?>/toastr/build/toastr.min.js"></script>

  <script src="<?= base_url(''); ?>/js/maruti.js"></script>
  <script src="<?= base_url(''); ?>/js/maruti.dashboard.js"></script>
  <script src="<?= base_url(''); ?>/js/maruti.chat.js"></script>


  <?= $this->renderSection('script'); ?>

  <script>
    $(function() {
      $(".datatablefull").DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
      $('.datatableminimal').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
      });
    });

    toastr.options = {
      "closeButton": false,
      "debug": false,
      "newestOnTop": true,
      "progressBar": true,
      "positionClass": "toast-top-right",
      "preventDuplicates": false,
      "showDuration": "600",
      "hideDuration": "1000",
      "timeOut": "5000",
      "extendedTimeOut": "1000",
      "showEasing": "swing",
      "hideEasing": "linear",
      "showMethod": "fadeIn",
      "hideMethod": "fadeOut"
    }
  </script>

  <?php ?>

  <?php
  if (session()->getFlashdata('dataMessage')) {
    foreach (session()->getFlashdata('dataMessage') as $item) {
      echo '<script>toastr["' .
        session()->getFlashdata('type-status') . '"]("' . $item . '")</script>';
    }
  }
  if (session()->getFlashdata('message')) {
    echo '<script>toastr["' .
      session()->getFlashdata('type-status') . '"]("' . session()->getFlashdata('message') . '")</script>';
  }
  ?>

</body>

</html>