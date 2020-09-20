<?php
  
  session_start();

  if (!isset($_SESSION['logged'])) {
    header("location: ../");  
  }

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>MISHOP | BẢNG ĐIỀU KHIỂN</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
   <!-- Select2 -->
  <link rel="stylesheet" href="plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!-- DataTables -->
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="home.php?flag=1" class="brand-link">
      <img src="dist/img/mlogo.jpg" alt="FSTORE LOGO" class="brand-image img-circle elevation-3"
           style="opacity: 1">
      <span class="brand-text font-weight-light">MISHOP</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="dist/img/avatar5.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">MINH NGUYÊN</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-header">BẢNG ĐIỀU KHIỂN</li>
          <?php
            if (isset($_GET['flag'])) {
              $flag = $_GET['flag'];
          ?>
          <li class="nav-item">
            <a href="home.php?flag=1" class="nav-link <?php if ($flag == 1) { echo "active"; } ?>">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                TỔNG QUAN
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview <?php if ($flag == 2 || $flag == 3) { echo "menu-open"; } ?>">
            <a href="#" class="nav-link <?php if ($flag == 2 || $flag == 3) { echo "active"; } ?>">
              <i class="nav-icon far fa-image"></i>
              <p>
                BANNER
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="add-banner.php?flag=2" class="nav-link <?php if ($flag == 2) { echo "active"; } ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>THÊM MỚI</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="banners.php?flag=3" class="nav-link <?php if ($flag == 3) { echo "active"; } ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>TOÀN BỘ BANNER</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview <?php if ($flag == 4 || $flag == 5) { echo "menu-open"; } ?>">
            <a href="#" class="nav-link <?php if ($flag == 4 || $flag == 5) { echo "active"; } ?>">
              <i class="nav-icon fas fa-th"></i>
              <p>
                DANH MỤC
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="add-category.php?flag=4" class="nav-link <?php if ($flag == 4) { echo "active"; } ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>THÊM MỚI</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="categories.php?flag=5" class="nav-link <?php if ($flag == 5) { echo "active"; } ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>TOÀN BỘ DANH MỤC</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview <?php if ($flag == 6 || $flag == 7) { echo "menu-open"; } ?>">
            <a href="#" class="nav-link <?php if ($flag == 6 || $flag == 7) { echo "active"; } ?>">
              <i class="nav-icon fas fa-th"></i>
              <p>
                DANH MỤC CON
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="add-child-category.php?flag=6" class="nav-link <?php if ($flag == 6) { echo "active"; } ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>THÊM MỚI</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="child-categories.php?flag=7" class="nav-link <?php if ($flag == 7) { echo "active"; } ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>TOÀN BỘ DANH MỤC</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview <?php if ($flag == 18) { echo "menu-open"; } ?>">
            <a href="brands.php?flag=18" class="nav-link <?php if ($flag == 18) { echo "active"; } ?>">
              <i class="nav-icon fas fa-th"></i>
              <p>
                THƯƠNG HIỆU
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview <?php if ($flag == 8 || $flag == 9 || $flag == 14) { echo "menu-open"; } ?>">
            <a href="#" class="nav-link <?php if ($flag == 8 || $flag == 9 || $flag == 14) { echo "active"; } ?>">
              <i class="nav-icon fas fa-tshirt"></i>
              <p>
                SẢN PHẨM
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="add-product.php?flag=8" class="nav-link <?php if ($flag == 8) { echo "active"; } ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>THÊM MỚI</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="products.php?flag=9" class="nav-link <?php if ($flag == 9) { echo "active"; } ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>TOÀN BỘ SẢN PHẨM</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="attributes.php?flag=14" class="nav-link <?php if ($flag == 14) { echo "active"; } ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>THUỘC TÍNH</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview <?php if ($flag == 10 || $flag == 11 || $flag == 12 || $flag == 13) { echo "menu-open"; } ?>">
            <a href="#" class="nav-link <?php if ($flag == 10 || $flag == 11 || $flag == 12 || $flag == 13) { echo "active"; } ?>">
              <i class="nav-icon fa fa-shopping-bag"></i>
              <p>
                ĐƠN HÀNG
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="orders.php?flag=10" class="nav-link <?php if ($flag == 10) { echo "active"; } ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>CHỜ XỬ LÝ</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="orders.php?flag=11" class="nav-link <?php if ($flag == 11) { echo "active"; } ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>ĐANG GIAO</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="orders.php?flag=12" class="nav-link <?php if ($flag == 12) { echo "active"; } ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>THÀNH CÔNG</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="orders.php?flag=13" class="nav-link <?php if ($flag == 13) { echo "active"; } ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>ĐÃ HUỶ</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="users.php?flag=15" class="nav-link <?php if ($flag == 15) { echo "active"; } ?>">
              <i class="nav-icon far fas fa-user"></i>
              <p>
                KHÁCH HÀNG
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview <?php if ($flag == 16 || $flag == 17) { echo "menu-open"; } ?>">
            <a href="#" class="nav-link <?php if ($flag == 16 || $flag == 17) { echo "active"; } ?>">
              <i class="nav-icon fas fa-star"></i>
              <p>
                ĐÁNH GIÁ SẢN PHẨM
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="reviews.php?flag=16" class="nav-link <?php if ($flag == 16) { echo "active"; } ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>CHỜ DUYỆT</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="reviews.php?flag=17" class="nav-link <?php if ($flag == 17) { echo "active"; } ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>ĐÃ DUYỆT</p>
                </a>
              </li>
            </ul>
          </li>

          <?php
            }
          ?>

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>