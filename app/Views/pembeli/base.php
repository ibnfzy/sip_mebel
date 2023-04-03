<!DOCTYPE html>
<html lang="en">

<head>
  <title>🏘 Meubel Shop | Pembeli Panel</title>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="<?= base_url(''); ?>/css/bootstrap.min.css" />
  <link rel="stylesheet" href="<?= base_url(''); ?>/css/bootstrap-responsive.min.css" />
  <link rel="stylesheet" href="<?= base_url(''); ?>/css/fullcalendar.css" />
  <link rel="stylesheet" href="<?= base_url(''); ?>/fontawesome-free-6.4.0-web/css/all.min.css" />
  <script src="<?= base_url(''); ?>/swal/dist/sweetalert2.min.js"></script>
  <link rel="stylesheet" href="<?= base_url(''); ?>/swal/dist/sweetalert2.min.css">
  <link rel="stylesheet" href="<?= base_url('/'); ?>/toastr/build/toastr.min.css">
  <link rel="stylesheet" href="<?= base_url('/'); ?>/css/select2.css" />
  <link rel="stylesheet" href="<?= base_url(''); ?>/css/maruti-style.css" />
  <link rel="stylesheet" href="<?= base_url(''); ?>/css/maruti-media.css" class="skin-color" />
  <style>
  .text-white {
    color: white;
  }
  </style>
</head>

<body>

  <?= $this->include('pembeli/layout/navbar'); ?>

  <?= $this->renderSection('content'); ?>

  <?= $this->include('pembeli/layout/footer'); ?>

  <script src="<?= base_url(''); ?>/js/excanvas.min.js"></script>
  <script src="<?= base_url(''); ?>/js/jquery.min.js"></script>
  <script src="<?= base_url(''); ?>/js/jquery.ui.custom.js"></script>
  <script src="<?= base_url(''); ?>/js/bootstrap.min.js"></script>
  <script src="<?= base_url(''); ?>/js/jquery.flot.min.js"></script>
  <script src="<?= base_url(''); ?>/js/jquery.flot.resize.min.js"></script>
  <script src="<?= base_url(''); ?>/js/jquery.peity.min.js"></script>
  <script src="<?= base_url(''); ?>/js/fullcalendar.min.js"></script>

  <script src="<?= base_url('/'); ?>/toastr/build/toastr.min.js"></script>
  <script src="<?= base_url('/'); ?>/fontawesome-free-6.4.0-web/js/all.min.js"></script>
  <script src="<?= base_url('/'); ?>/js/jquery.dataTables.min.js"></script>
  <script src="<?= base_url('/'); ?>/js/select2.min.js"></script>
  <script src="<?= base_url(''); ?>/js/maruti.js"></script>
  <!-- <script src="<?= base_url(''); ?>/js/maruti.dashboard.js"></script> -->
  <script src="<?= base_url(''); ?>/js/maruti.tables.js"></script>


  <?= $this->renderSection('script'); ?>

  <script>
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