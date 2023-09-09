<!DOCTYPE html>
<html lang="en">

<head>
  <title>🏘 Fauzan Meubel</title>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="<?= base_url(''); ?>/css/bootstrap.min.css" />
  <link rel="stylesheet" href="<?= base_url(''); ?>/css/bootstrap-responsive.min.css" />
  <link rel="stylesheet" href="<?= base_url('/'); ?>/toastr/build/toastr.min.css">
  <link rel="stylesheet" href="<?= base_url(''); ?>/css/maruti-login.css" />
</head>

<body>
  <div id="loginbox">
    <form id="loginform" class="form-vertical" method="POST" action="<?= base_url('Auth/Pembeli/Registration'); ?>">
      <div class="control-group normal_text">
        <h3>FORM REGISTRASI PEMBELI</h3>
      </div>
      <div class="control-group">
        <div class="controls">
          <div class="main_input_box">
            <span class="add-on"><i class="icon-user"></i></span><input type="text" name="fullname"
              placeholder="Fullname" />
          </div>
        </div>
      </div>
      <div class="control-group">
        <div class="controls">
          <div class="main_input_box">
            <span class="add-on"><i class="icon-user"></i></span><input type="text" name="username"
              placeholder="Username" />
          </div>
        </div>
      </div>
      <div class="control-group">
        <div class="controls">
          <div class="main_input_box">
            <span class="add-on"><i class="icon-lock"></i></span><input type="password" name="password"
              placeholder="Password" />
          </div>
        </div>
      </div>
      <div class="control-group">
        <div class="controls">
          <div class="main_input_box">
            <span class="add-on"><i class="icon-lock"></i></span><input type="password" name="confirmPassword"
              placeholder="Konfirmasi Password" />
          </div>
        </div>
      </div>
      <div class="control-group">
        <div class="controls">
          <div class="main_input_box"> 
             <span class="add-on"><i class="icon-user"></i></span>
            <?= form_dropdown('kota', $ongkir, '', [
				'style' => 'height:40px;display:inline-box;width:75%;border:1px solid #dadada;margin-bottom: 3px'
			]); ?>
          </div>
        </div>
      </div>
      <div class="control-group">
        <div class="controls">
          <div class="main_input_box">
            <span class="add-on"><i class="icon-user"></i></span> <input name="alamat" type="text" class="span11" placeholder="Alamat Lengkap" />
          </div>
        </div>
      </div>
      <div class="control-group">
        <div class="controls">
          <div class="main_input_box">
            <span class="add-on"><i class="icon-user"></i></span> <input name="nomor" type="text" class="span11" placeholder="Nomor HP" />
          </div>
        </div>
      </div>
      <div class="control-group">
        <div class="controls">
          <div class="main_input_box">
            <span class="add-on"><i class="icon-user"></i></span><input name="desa" type="text" class="span11" placeholder="Kecamatan Desa" />
          </div>
        </div>
      </div>
      <!--
      <div class="control-group">
        <div class="controls">
          <div class="main_input_box">
            <span class="add-on"><i class="icon-user"></i></span> <input name="kode_pos" type="text" class="span11" placeholder="Kode Pos" />
          </div>
        </div>
      </div>
-->
      <div class="form-actions">
        <span class="pull-left"><a href="<?= base_url(''); ?>" class="flip-link btn btn-inverse">Kembali ke Halaman
            Depan</a> </span>
        <hr>
        <span class="pull-left"><a href="<?= base_url('Auth/Pembeli'); ?>" class="flip-link btn btn-inverse">Sudah punya
            akun?
            silahkan login disni.</a></span>
        <span class="pull-right"><input type="submit" class="btn btn-success" value="Daftar" /></span>
      </div>
    </form>
  </div>

  <script src="<?= base_url(''); ?>/js/jquery.min.js"></script>
  <script src="<?= base_url('/'); ?>/toastr/build/toastr.min.js"></script>
  <script src="<?= base_url(''); ?>/js/maruti.login.js"></script>
  
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