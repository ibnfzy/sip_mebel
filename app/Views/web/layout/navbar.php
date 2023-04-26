<!-- header -->

<!-- script-for sticky-nav -->
<script>
$(document).ready(function() {
  var navoffeset = $(".agileits_header").offset().top;
  $(window).scroll(function() {
    var scrollpos = $(window).scrollTop();
    if (scrollpos >= navoffeset) {
      $(".agileits_header").addClass("fixed");
    } else {
      $(".agileits_header").removeClass("fixed");
    }
  });

});
</script>
<!-- //script-for sticky-nav -->
<div class="logo_products">
  <div class="container">
    <div class="w3ls_logo_products_left">
      <h1><a href="<?= base_url('/'); ?>"><span>🏘 Meubel </span> Shop</a></h1>
    </div>
    <div class="w3ls_logo_products_left1">
      <ul class="special_items">
        <li><a href="<?= base_url('/'); ?>">Home</a><i>/</i></li>
        <li><a href="<?= base_url('/Item'); ?>">Item Katalog</a><i></i></li>
      </ul>
    </div>
    <div class="w3ls_logo_products_left1">
      <ul class="phone_email">
        <li><a href="<?= base_url('Cart'); ?>"><i class="fa-solid fa-cart-shopping"></i> Keranjang</a> </li>
        <li><i class="fa-solid fa-user"></i><a href="<?= base_url('PembeliPanel'); ?>"> Login</a>
        </li>
      </ul>
    </div>
    <div class="clearfix"> </div>
  </div>
</div>
<!-- //header -->
<!-- banner -->
<div class="banner">
  <div class="w3l_banner_nav_left">
    <nav class="navbar nav_bottom">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header nav_2">
        <button type="button" class="navbar-toggle collapsed navbar-toggle1" data-toggle="collapse"
          data-target="#bs-megadropdown-tabs">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
      </div>
      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="bs-megadropdown-tabs">
        <ul class="nav navbar-nav nav_1">
          <li
            style="position: relative; height: auto; margin-left: 20%; padding-top: 10px; font-weight: bold; padding-bottom: 5px;">
            Kategori
            Item</li>
          <?php
          $db = \Config\Database::connect();
          $get = $db->table('kategori_item')->get()->getResultArray();
          ?>
          <?php foreach ($get as $item) : ?>
          <li><a
              href="<?= base_url('ItemByKategori/' . str_replace(' ', '_', $item['nama_kategori'])); ?>"><?= $item['nama_kategori']; ?></a>
          </li>
          <?php endforeach ?>
        </ul>
      </div><!-- /.navbar-collapse -->
    </nav>
  </div>
  <div class="w3l_banner_nav_right">
    <section class="slider">
      <div class="flexslider">
        <ul class="slides">
          <?php foreach ($cr as $item) : ?>
          <li>
            <div class="w3l_banner_nav_right_banner"
              style="--imgurl: url('<?= base_url('uploads/' . $item['gambar']) ?>')">
              <h3
                style="text-shadow: -1px -1px 0 #000, 1px -1px 0 #000, -1px 1px 0 #000, 1px 1px 0 #000; color: #84C639; -webkit-font-smoothing: antialiased; font-weight: bold;">
                <?= $item['header']; ?></h3>
              <div class="more">
                <?php if ($item['link_to'] != '') : ?>
                <a href="<?= $item['link_to'] ?>" class="button--saqui button--round-l button--text-thick"
                  data-text="Lihat detail">Lihat detail</a>
                <?php endif ?>
              </div>
            </div>
          </li>
          <?php endforeach ?>
        </ul>
      </div>
    </section>
    <!-- flexSlider -->
    <link rel="stylesheet" href="<?= base_url(''); ?>/assets/css/flexslider.css" type="text/css" media="screen"
      property="" />
    <script defer src="<?= base_url(''); ?>/assets/js/jquery.flexslider.js"></script>
    <script type="text/javascript">
    $(window).load(function() {
      $('.flexslider').flexslider({
        animation: "slide",
        start: function(slider) {
          $('body').removeClass('loading');
        }
      });
    });
    </script>
    <!-- //flexSlider -->
  </div>
  <div class="clearfix"></div>
</div>