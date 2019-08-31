<?php

if(isset($_SESSION['logged_in'])){
  $user_nip=$_SESSION['user_nip'];
  $cgusr=$guser->row_array();
}
?>

<body class="nav-md">
  <div class="container body">
    <div class="main_container">
      <div class="col-md-3 left_col">
        <div class="left_col scroll-view">
          <div class="navbar nav_title" style="border: 0;">
            <a href="<?php echo base_url(); ?>" class="site_title"><i class="fa fa-paw"></i> <span>Admin Panel</span></a>
          </div>
          <div class="clearfix"></div>
          <div class="profile clearfix">
            <div class="profile_pic">
              <img src="<?php echo base_url().'assets/images/'.$cgusr['user_foto'];?>" alt="..." class="img-circle profile_img">
            </div>
            <div class="profile_info">
              <span>Welcome,</span>
              <h2><?php echo $cgusr['user_nama']; ?></h2>
            </div>
          </div>
          <br />
          <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
              <h3>General</h3>
              <ul class="nav side-menu">
                <li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Home</a> </li>
                <?php if($_SESSION['user_role']=='admin') {?>
                  <li><a href="<?php echo base_url(); ?>user"><i class="fa fa-child"></i> User</a> </li>
                <?php } ?>
              </div>

            </div>
          </div>
        </div>