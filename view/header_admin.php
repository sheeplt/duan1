<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Giáo vụ</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="view/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="view/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="view/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="view/plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="view/styles/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="view/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="view/plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="view/plugins/summernote/summernote-bs4.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css" integrity="sha512-q3eWabyZPc1XTCmF+8/LuE1ozpg5xxn7iO89yfSOd5/oKvyqLngoNGsx8jq92Y8eXJ/IRxQbEC+FGSYxtk2oiw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  
</head>
<?php 
$tendn = $_SESSION["tendangnhap"];
include_once("controller/cquanli.php");
$p = new controlquanli();
$table = $p -> lay1quanli($tendn);
$row=mysqli_fetch_assoc($table);
$hinhanh = $row["HinhAnh"];
?>
<body class="hold-transition sidebar-mini layout-fixed">
  <!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item d-none d-sm-inline-block">
      <a href="QL.php" class="nav-link">
        <img src="view/images/home.png" style="width:25px;  margin-bottom: 5px;"> Trang chủ</a>
    </li>
  </ul>
</nav>
<!-- /.navbar -->
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="QL.php" class="brand-link">
    <img src="view/images/logo.png" alt="VICTORY Logo" class="brand-image img-circle elevation-3"
      style="opacity: .8">
    <span class="brand-text font-weight-light">VICTORIA</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="view/images/<?php echo $hinhanh; ?>" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="QL.php?tncn" class="d-block">
          Giáo vụ
        </a>
      </div>
    </div>

    <!-- SidebarSearch Form -->
    <!-- <div class="form-inline">
      <div class="input-group" data-widget="sidebar-search">
        <input class="form-control form-control-sidebar" type="search" placeholder="Tìm kiếm" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-sidebar">
            <i class="fas fa-search fa-fw"></i>
          </button>
        </div>
      </div>
    </div> -->

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
        <li class="nav-header" style="font-size: 20px;"> <B>Chức năng hệ thống</B></li>
        
        <!-- <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-th"></i>
            <p>
              Tiện ích
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-edit"></i>
            <p>
              Quản lí bài viết
            </p>
          </a>
        </li> -->
        <li class="nav-item">
          <a href="QL.php?lichhoc" class="nav-link">
            <i class="nav-icon fas fa-calendar-alt"></i>
            <p>
              Quản lí lịch học & giảng dạy
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="QL.php?hocsinh" class="nav-link">
            <i class="nav-icon fas fa-book"></i>
            <p>
              Quản lí danh sách lớp & học sinh
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-table"></i>
            <p>
              Quản lí người dùng
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="QL.php?giangvien" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Quản lí danh sách giáo viên</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="QL.php?tatcahocsinh=1" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Quản lí danh sách học sinh</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="QL.php?quanli" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Quản lí danh sách giáo vụ</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <a href="QL.php?ngaythi" class="nav-link">
            <i class="nav-icon fas fa-book"></i>
            <p>
              Ngày thi
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="QL.php?hoivadap" class="nav-link">
            <i class="nav-icon far fa-envelope"></i>
            <p>
              Hỏi & Đáp
            </p>
          </a>
        </li>
        <li class="nav-header">Mức độ nhãn</li>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon far fa-circle text-danger"></i>
            <p class="text">Quan trọng</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon far fa-circle text-warning"></i>
            <p>Cảnh báo</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon far fa-circle text-info"></i>
            <p>Thông tin</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="QL.php?dangxuat" class="nav-link" onclick="return confirm('Đăng xuất ?');">
            <p>
              <img src="view/images/icons8-enter-100.png" alt="dang xuat" style="width: 30px; height: 30px;">
              &emsp;
              Đăng xuất
            </p>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>
<!-- /.control-sidebar -->