<?php
ob_start();
$tendn = $_SESSION["tendangnhap"];
include_once("controller/cquanli.php");
$p = new controlquanli();
$table = $p->lay1quanli($tendn);
if ($table) {
  if (mysqli_num_rows($table) > 0) {
    $row = mysqli_fetch_assoc($table);
  }
}
$maql = $row["MaQL"];
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Hồ sơ người dùng</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="QL.php">Trang chủ</a></li>
            <li class="breadcrumb-item active">Hồ sơ người dùng</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-3">

          <!-- Profile Image -->
          <div class="card card-primary card-outline">
            <div class="card-body box-profile">
              <div class="text-center">
                <img class="profile-user-img img-fluid img-circle" src="view/images/<?php echo  $row["HinhAnh"]; ?>" alt="Ảnh hồ sơ">
              </div>

              <h3 class="profile-username text-center"><?php echo  $row["TenQL"]; ?></h3>

              <p class="text-muted text-center">
                <?php
                if ($row["Role"] == 1) {
                  echo "Giáo vụ";
                } elseif ($row["Role"] == 2) {
                  echo "Kế toán";
                } elseif ($row["Role"] == 3) {
                  echo "Nhân viên tư vấn";
                }
                ?>
              </p>

              <ul class="list-group list-group-unbordered mb-3">
                <li class="list-group-item">
                  <b>Ngày sinh:</b> <a class="float-right"><?php echo  $row["NgaySinh"]; ?></a>
                </li>
                <li class="list-group-item">
                  <b>Giới tính:</b> <a class="float-right"><?php echo  $row["GioiTinh"]; ?></a>
                </li>
                <li class="list-group-item">
                  <b>Số điện thoại:</b> <a class="float-right"><?php echo  $row["SDT"]; ?></a>
                </li>
                <li class="list-group-item">
                  <b>Email:</b> <a class="float-right"><?php echo  $row["Email"]; ?></a>
                </li>
                <li class="list-group-item">
                  <b>Địa chỉ:</b> <a class="float-right"><?php echo  $row["DiaChi"]; ?></a>
                </li>
                <li class="list-group-item">
                  <b>Tên đăng nhập:</b> <a class="float-right"><?php echo  $row["TenDN"]; ?></a>
                </li>
                <li class="nav-link active">
                  <form action="#" method="POST">
                    <button type="submit" name="doimk" class="btn btn-danger" style="margin: 30px 0px 0px 30px;">
                      <i class="glyphicon glyphicon-info-sign"></i>
                      Thay đổi mật khẩu
                    </button>
                  </form>
                </li>
              </ul>
              <?php
              if (isset($_REQUEST["doimk"])) {
                echo header("refresh:0; url='QL.php?dmk'");
              }
              ?>
              <!-- <a href="#" class="btn btn-primary btn-block"><b>Quản lí</b></a> -->
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="card">
            <div class="card-header p-2">
              <ul class="nav nav-pills">
                <li class="nav-item"><a class="nav-link active" href="#settings" data-toggle="tab">Chỉnh sửa hồ sơ</a></li>
              </ul>
              <!-- /.card-header -->
            </div>
            <div class="card-body">
              <div class="tab-content">
                <div class="active tab-pane" id="settings">
                  <form class="form-horizontal" action="#" method="POST" enctype="multipart/form-data">
                    <div class="form-group row">
                      <label for="user_avatar" class="col-sm-2 col-form-label" style="padding-top: 0;">Ảnh đại diện</label>
                      <div class="col-sm-10">
                        <div class="user-avatar-upload-wrapper js-one-image-wrapper ">
                          <div class="user-avatar-inner js-one-image-inner">
                            <img class="profile-user-img img-fluid img-circle" src="view/images/<?php echo  $row["HinhAnh"]; ?>" alt="Ảnh hồ sơ">
                          </div>
                          <div class="user-avatar-upload clearfix" style="margin: 10px 0 0 10px;">
                            <input type="file" name="file" class="btn-add-avatar js-change-image-file" accept=".png, .jpg, .jpeg">
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="hoten" class="col-sm-2 col-form-label">Họ và tên:</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" name="hoten" id="hoten" placeholder="Họ và tên ..." value="<?php echo $row["TenQL"] ?>">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="ngaysinh" class="col-sm-2 col-form-label">Ngày sinh</label>
                      <div class="col-md-10">
                        <input type="date" required class="form-control " id="ngaysinh" name="ngaysinh" value="<?php echo $row["NgaySinh"] ?>">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="gioitinh" class="col-sm-2 col-form-label">Giới tính:</label>
                      <div class="col-sm-10" style="font-size: 20px;">
                        <input type="radio" <?php if ($row["GioiTinh"] == 'Nam') {
                                              echo "checked";
                                            }  ?> id="gioitinh" name="gioitinh" value="Nam">
                        <label for="gioitinh"> Nam</label><br>
                        <input type="radio" <?php if ($row["GioiTinh"] == 'Nữ') {
                                              echo "checked";
                                            }  ?> id="gioitinh" name="gioitinh" value="Nữ">
                        <label for="gioitinh"> Nữ</label><br>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="sdt" class="col-sm-2 col-form-label">Số điện thoại:</label>
                      <div class="col-sm-10">
                        <input type="number" class="form-control" name="sdt" id="sdt" placeholder="Số điện thoại ..." value="<?php echo $row["SDT"] ?>">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="email" class="col-sm-2 col-form-label">Email</label>
                      <div class="col-sm-10">
                        <input type="email" class="form-control" name="email" id="email" placeholder="Email ..." value="<?php echo $row["Email"] ?>">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="diachi" class="col-sm-2 col-form-label">Địa chỉ:</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" name="diachi" id="diachi" placeholder="Địa chỉ ..." value="<?php echo $row["DiaChi"] ?>">
                      </div>
                    </div>
                    <input type="hidden" class="form-control" name="Role" id="Role" placeholder="Địa chỉ ..." value="<?php echo $row["Role"] ?>">
                    <div class="form-group row">
                      <div class="offset-sm-2 col-sm-10">
                        <div class="checkbox" style="text-align: center;">
                          <input type="checkbox" name="xacnhan" id="xacnhan" value="1">&emsp; Xác nhận chỉnh sửa hồ sơ</a>
                        </div>
                      </div>
                    </div>
                    <div class="form-group row">
                      <div class="offset-sm-2 col-sm-10" style="text-align: center;">
                        <button type="submit" name="btnsubmit" class="btn btn-danger">Chỉnh sửa</button>
                      </div>
                    </div>
                  </form>
                </div>
                <!-- /.tab-pane -->
              </div>
              <!-- /.tab-content -->
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php
if (isset($_REQUEST["btnsubmit"])) {
  $tenquanli = $_REQUEST["hoten"];
  $ngaysinh = $_REQUEST["ngaysinh"];
  $diachi = $_REQUEST["diachi"];
  $gioitinh = $_REQUEST["gioitinh"];
  $sdt = $_REQUEST["sdt"];
  $email = $_REQUEST["email"];
  $vaitro = $_REQUEST["Role"];

  $hinhanh = $_FILES["file"]["tmp_name"];
  $tenanh = $_FILES["file"]["name"];
  $p = new controlquanli();
  if (isset($_REQUEST["xacnhan"])) {
    if ($tenanh == "") {
      $kq = $p->capnhatquanli($maql, $tenquanli, $ngaysinh, $diachi, $gioitinh, $sdt, $email, $vaitro);
      if ($kq == 1) {
        echo "<script>alert('cập nhật thông tin thành công')</script>";
        echo header("refresh:0; url='QL.php?tncn'");
      } elseif ($kq == 0) {
        echo "<script>alert('Không thể insert lỗi 1')</script>";
      }
    } else {
      $kq = $p->capnhatquanliCoanh($maql, $tenquanli, $ngaysinh, $diachi, $gioitinh, $sdt, $email, $vaitro, $tenanh, $hinhanh);
      if ($kq == 1) {
        echo "<script>alert('cập nhật thông tin thành công')</script>";
        echo header("refresh:0; url='QL.php?tncn'");
      } elseif ($kq == 0) {
        echo "<script>alert('Không thể insert lỗi 1')</script>";
      } elseif ($kq == 2) {
        echo "<script>alert('Không thể upload ảnh')</script>";
      }
    }
  } else {
    echo "<script>alert('Bạn chưa xác nhận lại thông tin')</script>";
  }
}
?>