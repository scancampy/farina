<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 3 | <?php echo $title; ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url('adminlte/plugins/fontawesome-free/css/all.min.css'); ?>">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo base_url('adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css'); ?>">
  <link rel="stylesheet" href="<?php echo base_url('adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css'); ?>">
<!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="<?php echo base_url('adminlte/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css'); ?>">

  <!-- summernote -->
  <link rel="stylesheet" href="<?php echo base_url('adminlte/plugins/summernote/summernote-bs4.css'); ?>">
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="<?php echo base_url('adminlte/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css'); ?>">
  
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url('adminlte/css/adminlte.min.css'); ?>">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      
    </ul>

    
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-user"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="#" class="dropdown-item">
            <i class="fas fa-lock mr-2"></i> Change Password
          </a>
          <div class="dropdown-divider"></div>
          <a href="<?php echo base_url('admin/dashboard/signout'); ?>" class="dropdown-item">
            <i class="fas fa-door-open mr-2"></i> Sign Out
          </a>
        </div>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="../../index3.html" class="brand-link">
      <img src="<?php echo base_url('adminlte/img/AdminLTELogo.png'); ?>"
           alt="AdminLTE Logo"
           class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?php echo base_url('adminlte/img/user2-160x160.jpg'); ?>" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?php echo $name; ?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

          <li class="nav-item">
            <a href="<?php echo base_url('admin/dashboard'); ?>" class="nav-link <?php if ($this->uri->segment(2) == 'dashboard') { echo 'active';  } ?>">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>

          <li class="nav-item has-treeview <?php if ($this->uri->segment(2) == 'product') {  echo 'menu-open'; } ?>">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tags"></i>
              <p>
                Products
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" >
              <li class="nav-item">
                <a href="<?php echo base_url('admin/product/master'); ?>" class="nav-link <?php if ($this->uri->segment(3) == 'master' && $this->uri->segment(2) == 'product') { echo 'active';  } ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Master Product</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url('admin/product/brand'); ?>" class="nav-link <?php if ($this->uri->segment(3) == 'brand' && $this->uri->segment(2) == 'product') { echo 'active';  } ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Master Brand</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item has-treeview <?php if ($this->uri->segment(2) == 'article') {  echo 'menu-open'; } ?>">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-newspaper   "></i>
              <p>
                Beauty Article
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" >
              <li class="nav-item">
                <a href="<?php echo base_url('admin/article/master'); ?>" class="nav-link <?php if ($this->uri->segment(3) == 'master' && $this->uri->segment(2) == 'article') { echo 'active';  } ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Master Article</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url('admin/article/category'); ?>" class="nav-link <?php if ($this->uri->segment(3) == 'category' && $this->uri->segment(2) == 'article') { echo 'active';  } ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Master Article Category</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="<?php echo base_url('admin/events'); ?>" class="nav-link <?php if ($this->uri->segment(2) == 'events') { echo 'active';  } ?>">
              <i class="nav-icon fas fa-calendar-day"></i>
              <p>
                Events
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="<?php echo base_url('admin/voucher'); ?>" class="nav-link <?php if ($this->uri->segment(2) == 'voucher') { echo 'active';  } ?>">
              <i class="nav-icon fas fa-ticket-alt"></i>
              <p>
                Voucher
              </p>
            </a>
          </li>

          <li class="nav-item has-treeview <?php if ($this->uri->segment(2) == 'setting') {  echo 'menu-open'; } ?>">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-cogs   "></i>
              <p>
                Web Setting
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" >
              <li class="nav-item">
                <a href="<?php echo base_url('admin/setting/slides'); ?>" class="nav-link <?php if ($this->uri->segment(3) == 'slides' && $this->uri->segment(2) == 'setting') { echo 'active';  } ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Master Slides</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url('admin/setting/web'); ?>" class="nav-link <?php if ($this->uri->segment(3) == 'web' && $this->uri->segment(2) == 'setting') { echo 'active';  } ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Setting</p>
                </a>
              </li>
            </ul>
          </li>



          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
