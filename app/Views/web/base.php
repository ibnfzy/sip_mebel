<!--
author: W3layouts
author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<html>

<head>
  <title>🏘 Fauzan Meubel</title>
  <!-- for-mobile-apps -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="keywords" content="Grocery Store Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
  <script type="application/x-javascript">
  addEventListener("load", function() {
    setTimeout(hideURLbar, 0);
  }, false);

  function hideURLbar() {
    window.scrollTo(0, 1);
  }
  </script>
  <!-- //for-mobile-apps -->
  <link href="<?= base_url(''); ?>/assets/css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
  <link href="<?= base_url(''); ?>/assets/css/style.css" rel="stylesheet" type="text/css" media="all" />
  <!-- font-awesome icons -->
  <link rel="stylesheet" href="<?= base_url(''); ?>/fontawesome-free-6.4.0-web/css/all.min.css" />
  <!-- //font-awesome icons -->
  <script src="<?= base_url(''); ?>/swal/dist/sweetalert2.min.js"></script>
  <link rel="stylesheet" href="<?= base_url(''); ?>/swal/dist/sweetalert2.min.css">
  <link rel="stylesheet" href="<?= base_url('/'); ?>/toastr/build/toastr.min.css">
  <!-- js -->
  <script src="<?= base_url(''); ?>/assets/js/jquery-1.11.1.min.js"></script>
  <!-- //js -->
  <link href='//fonts.googleapis.com/css?family=Ubuntu:400,300,300italic,400italic,500,500italic,700,700italic'
    rel='stylesheet' type='text/css'>
  <link
    href='//fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic'
    rel='stylesheet' type='text/css'>
  <!-- start-smoth-scrolling -->
  <script type="text/javascript" src="<?= base_url(''); ?>/assets/js/move-top.js"></script>
  <script type="text/javascript" src="<?= base_url(''); ?>/assets/js/easing.js"></script>
  <script type="text/javascript">
  jQuery(document).ready(function($) {
    $(".scroll").click(function(event) {
      event.preventDefault();
      $('html,body').animate({
        scrollTop: $(this.hash).offset().top
      }, 1000);
    });
  });
  </script>
  <!-- start-smoth-scrolling -->
</head>

<body>
  <?= $this->include('web/layout/navbar'); ?>
  <!-- banner -->
  <?= $this->renderSection('content'); ?>
  <!-- //newsletter -->
  <!-- footer -->
  <?= $this->include('web/layout/footer'); ?>
  <!-- //footer -->
  <!-- Bootstrap Core JavaScript -->
  <script src="<?= base_url(''); ?>/assets/js/bootstrap.min.js"></script>
  <script src="<?= base_url('/'); ?>/toastr/build/toastr.min.js"></script>
  <script src="<?= base_url('/'); ?>/fontawesome-free-6.4.0-web/js/all.min.js"></script>
  <script>
  $(document).ready(function() {
    $(".dropdown").hover(
      function() {
        $('.dropdown-menu', this).stop(true, true).slideDown("fast");
        $(this).toggleClass('open');
      },
      function() {
        $('.dropdown-menu', this).stop(true, true).slideUp("fast");
        $(this).toggleClass('open');
      }
    );
  });
  </script>
  <!-- here stars scrolling icon -->
  <script type="text/javascript">
  $(document).ready(function() {
    /*
    	var defaults = {
    	containerID: 'toTop', // fading element id
    	containerHoverID: 'toTopHover', // fading element hover id
    	scrollSpeed: 1200,
    	easingType: 'linear' 
    	};
    */

    $().UItoTop({
      easingType: 'easeOutQuart'
    });

  });
  </script>
  <!-- //here ends scrolling icon -->
  <script src="<?= base_url(''); ?>/assets/js/minicart.js"></script>
  <script>
  paypal.minicart.render();

  paypal.minicart.cart.on('checkout', function(evt) {
    var items = this.items(),
      len = items.length,
      total = 0,
      i;

    // Count the number of each item in the cart
    for (i = 0; i < len; i++) {
      total += items[i].get('quantity');
    }

    if (total < 3) {
      alert('The minimum order quantity is 3. Please add more to your shopping cart before checking out');
      evt.preventDefault();
    }
  });
  </script>

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

</body>

</html>