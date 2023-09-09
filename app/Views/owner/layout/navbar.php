<!--Header-part-->
<div id="header">
  <h1><a href="#">🏘 Fauzan Meubel</a> </h1>
</div>
<!--close-Header-part-->

<!--top-Header-messaages-->
<div class="btn-group rightzero"> <a class="top_message tip-left" title="Manage Files"><i class="icon-file"></i></a>
  <a class="top_message tip-bottom" title="Manage Users"><i class="icon-user"></i></a> <a class="top_message tip-bottom" title="Manage Comments"><i class="icon-comment"></i><span class="label label-important">5</span></a> <a class="top_message tip-bottom" title="Manage Orders"><i class="icon-shopping-cart"></i></a>
</div>
<!--close-top-Header-messaages-->

<!--top-Header-menu-->
<div id="user-nav" class="navbar navbar-inverse">
  <ul class="nav">
    <li class=""><a title="" href="<?= base_url('OwnerPanel/Settings'); ?>"><i class="icon icon-cog"></i> <span class="text">Website Setting</span></a></li>
    <li class=""><a title="" href="<?= base_url('Auth/Owner/Destroy'); ?>"><i class="icon icon-share-alt"></i> <span class="text">Logout</span></a>
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
    <!-- 
<li class="active"><a href="<?= base_url('OwnerPanel'); ?>"><i class="icon icon-home"></i> <span>Home</span></a>
    </li> 
-->
    <li class="active"><a href="<?= base_url('OwnerPanel/Arsip'); ?>"><i class="fa-solid fa-file-pdf" style="color: #ffffff;"></i> <span>Arsip Laporan</span></a> </li>
    <!-- <li class="active"><a href="<?= base_url('OwnerPanel/Admin'); ?>"><i class="fa fa-users text-white" aria-hidden="true"></i>
        <span>Admin</span></a>
    </li> -->

  </ul>
</div>