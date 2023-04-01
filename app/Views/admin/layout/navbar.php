<!--Header-part-->
<div id="header">
  <h1><a href="#">🏘 Meubel Shop</a> </h1>
</div>
<!--close-Header-part-->

<!--top-Header-messaages-->
<div class="btn-group rightzero"> <a class="top_message tip-left" title="Manage Files"><i class="icon-file"></i></a>
  <a class="top_message tip-bottom" title="Manage Users"><i class="icon-user"></i></a> <a class="top_message tip-bottom"
    title="Manage Comments"><i class="icon-comment"></i><span class="label label-important">5</span></a> <a
    class="top_message tip-bottom" title="Manage Orders"><i class="icon-shopping-cart"></i></a>
</div>
<!--close-top-Header-messaages-->

<!--top-Header-menu-->
<div id="user-nav" class="navbar navbar-inverse">
  <ul class="nav">
    <li class=""><a title="" href="<?= base_url('AdmPanel/Settings'); ?>"><i class="icon icon-cog"></i> <span
          class="text">Website Setting</span></a></li>
    <li class=""><a title="" href="<?= base_url('Auth/Admin/Destroy'); ?>"><i class="icon icon-share-alt"></i> <span
          class="text">Logout</span></a>
    </li>
  </ul>
</div>

<div id="search">
  <!-- <input type="text" placeholder="Search here..." />
  <button type="submit" class="tip-left" title="Search"><i class="icon-search icon-white"></i></button> -->
</div>
<!--close-top-Header-menu-->

<div id="sidebar"><a href="#" class="visible-phone"><i class="icon icon-home"></i> Dashboard</a>
  <ul>
    <li class="active"><a href="<?= base_url('AdmPanel'); ?>"><i class="icon icon-home"></i> <span>Home</span></a> </li>
    <li><a href="<?= base_url('AdmPanel'); ?>"><i class="icon icon-picture"></i> <span>Corousel</span></a> </li>
    <li> <a href="<?= base_url('AdmPanel/Item'); ?>"><i class="fa-solid fa-cube text-white"></i> <span>Item</span></a>
    </li>
    <li> <a href="<?= base_url('AdmPanel/KategoriItem'); ?>"><i class="fa fa-cubes text-white" aria-hidden="true"></i>
        <span>Kategori Item</span></a> </li>
    <li> <a href="<?= base_url('AdmPanel/Pembeli'); ?>"><i class="fa fa-users text-white" aria-hidden="true"></i>
        <span>User Pembeli</span></a> </li>
    <li> <a href="<?= base_url('AdmPanel/Transaksi'); ?>"><i class="fa fa-truck text-white" aria-hidden="true"></i>
        <span>Transaksi</span></a> </li>
    <li> <a href="<?= base_url('AdmPanel/Voucher'); ?>"><i class="fa fa-tag text-white" aria-hidden="true"></i>
        <span>Voucher</span></a> </li>
    <li> <a href="<?= base_url('AdmPanel/VoucherPembeli'); ?>"><i class="fa fa-tags text-white" aria-hidden="true"></i>
        <span>Voucher Pembeli</span></a> </li>
  </ul>
</div>