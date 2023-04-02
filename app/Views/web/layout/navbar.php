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
        <button type="button" class="navbar-toggle collapsed navbar-toggle1" data-toggle="collapse" data-target="#bs-megadropdown-tabs">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
      </div>
      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="bs-megadropdown-tabs">
        <ul class="nav navbar-nav nav_1">
          <li style="position: relative; height: auto; margin-left: 20%; padding-top: 10px; font-weight: bold; padding-bottom: 5px;">
            Kategori
            Item</li>
          <li><a href="products.html">Branded Foods</a></li>
          <li><a href="household.html">Households</a></li>
          <li class="dropdown mega-dropdown active">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Veggies & Fruits<span class="caret"></span></a>
            <div class="dropdown-menu mega-dropdown-menu w3ls_vegetables_menu">
              <div class="w3ls_vegetables">
                <ul>
                  <li><a href="vegetables.html">Vegetables</a></li>
                  <li><a href="vegetables.html">Fruits</a></li>
                </ul>
              </div>
            </div>
          </li>
          <li><a href="kitchen.html">Kitchen</a></li>
          <li><a href="short-codes.html">Short Codes</a></li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Beverages<span class="caret"></span></a>
            <div class="dropdown-menu mega-dropdown-menu w3ls_vegetables_menu">
              <div class="w3ls_vegetables">
                <ul>
                  <li><a href="drinks.html">Soft Drinks</a></li>
                  <li><a href="drinks.html">Juices</a></li>
                </ul>
              </div>
            </div>
          </li>
          <li><a href="pet.html">Pet Food</a></li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Frozen Foods<span class="caret"></span></a>
            <div class="dropdown-menu mega-dropdown-menu w3ls_vegetables_menu">
              <div class="w3ls_vegetables">
                <ul>
                  <li><a href="frozen.html">Frozen Snacks</a></li>
                  <li><a href="frozen.html">Frozen Nonveg</a></li>
                </ul>
              </div>
            </div>
          </li>
          <li><a href="bread.html">Bread & Bakery</a></li>
        </ul>
      </div><!-- /.navbar-collapse -->
    </nav>
  </div>
  <div class="w3l_banner_nav_right">
    <section class="slider">
      <div class="flexslider">
        <ul class="slides">
          <li>
            <div class="w3l_banner_nav_right_banner" style="--imgurl: url('../images/1.jpg')">
              <h3>Make your <span>food</span> with Spicy.</h3>
              <div class="more">
                <a href="products.html" class="button--saqui button--round-l button--text-thick" data-text="Shop now">Shop now</a>
              </div>
            </div>
          </li>
          <li>
            <div class="w3l_banner_nav_right_banner" style="--imgurl: url('../images/2.jpg')">
              <h3>Make your <span>food</span> with Spicy.</h3>
              <div class="more">
                <a href="products.html" class="button--saqui button--round-l button--text-thick" data-text="Shop now">Shop now</a>
              </div>
            </div>
          </li>
          <li>
            <div class="w3l_banner_nav_right_banner" style="--imgurl: url('../images/3.jpg')">
              <h3>upto <i>50%</i> off.</h3>
              <div class="more">
                <a href="products.html" class="button--saqui button--round-l button--text-thick" data-text="Shop now">Shop now</a>
              </div>
            </div>
          </li>
        </ul>
      </div>
    </section>
    <!-- flexSlider -->
    <link rel="stylesheet" href="<?= base_url(''); ?>/assets/css/flexslider.css" type="text/css" media="screen" property="" />
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