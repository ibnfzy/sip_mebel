<!DOCTYPE html>
<html lang="en">

<head>
  <title>🏘 Meubel Shop</title>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="<?= base_url(''); ?>/css/bootstrap.min.css" />
  <link rel="stylesheet" href="<?= base_url(''); ?>/css/bootstrap-responsive.min.css" />
  <link rel="stylesheet" href="<?= base_url(''); ?>/css/maruti-login.css" />
</head>

<body>
  <div id="loginbox">
    <form id="loginform" class="form-vertical" method="POST" action="<?= base_url('Auth/Pemilik'); ?>">
      <div class="control-group normal_text">
        <h3>🏘 <b>Meubel</b> Shop</h3>
      </div>
      <div class="control-group">
        <div class="controls">
          <div class="main_input_box">
            <span class="add-on"><i class="icon-user"></i></span><input type="text" name="username" placeholder="Username" />
          </div>
        </div>
      </div>
      <div class="control-group">
        <div class="controls">
          <div class="main_input_box">
            <span class="add-on"><i class="icon-lock"></i></span><input type="password" name="password" placeholder="Password" />
          </div>
        </div>
      </div>
      <div class="form-actions">
        <span class="pull-left"><a href="<?= base_url(''); ?>" class="flip-link btn btn-inverse">Kembali ke Halaman
            Depan</a></span>
        <span class="pull-right"><input type="submit" class="btn btn-success" value="Login" /></span>
      </div>
    </form>
  </div>

  <script src="<?= base_url(''); ?>/js/jquery.min.js"></script>
  <script src="<?= base_url(''); ?>/js/maruti.login.js"></script>
</body>

</html>