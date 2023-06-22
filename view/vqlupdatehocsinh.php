<?php
include_once("controller/chocsinh.php");
ob_start();
$Mahocsinh = $_REQUEST["updatehs"];
$p = new controlhocsinh();
$table = $p->lay1hs1($Mahocsinh);
$row = mysqli_fetch_assoc($table);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm học sinh lớp <?php echo $Malop; ?></title>
    <script src="view/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="ml-sm-auto col-lg-1"></div>

            <main role="main" class="ml-sm-auto col-lg-10">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
                    <h1 class="h2" style="padding-left: 100px;">UPDATE HỌC SINH </h1>
                </div>
                <form class="js-form-submit-data" action="#" method="POST"   enctype="multipart/form-data">
                <div class="form-group row">
                        <label for="mahs" class="col-md-2 offset-md-2 col-form-label">Ảnh đại diện</label>
                        <div class="col-md-6">
                        <div class="user-avatar-inner js-one-image-inner">
                                  <img class="profile-user-img img-fluid img-circle" src="view/images/<?php echo  $row["HinhAnh"]; ?>" alt="Ảnh hồ sơ" accept=".png, .jpg, .jpeg">
                                </div>
                                <div class="user-avatar-upload clearfix">
                                    <input type="file" name="file" class="btn-add-avatar js-change-image-file" accept=".png, .jpg, .jpeg">
                                </div>
                        </div>
                    </div>
                <div class="form-group row">
                        <label for="mahs" class="col-md-2 offset-md-2 col-form-label">Mã Học Sinh</label>
                        <div class="col-md-6">
                            <input type="text" required disabled class="form-control " id="mahs" name="mahs" value="<?php echo $row["MaHS"] ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tendn" class="col-md-2 offset-md-2 col-form-label">Tên đăng nhập</label>
                        <div class="col-md-6">
                            <input type="text" required disabled class="form-control " id="tendn" name="tendn" value="<?php echo $row["TenDN"] ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tenhs" class="col-md-2 offset-md-2 col-form-label">Tên học sinh</label>
                        <div class="col-md-6">
                            <input type="text" required class="form-control " id="tenhs" name="tenhs" value="<?php echo $row["TenHS"] ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="ngaysinh" class="col-md-2 offset-md-2 col-form-label">Ngày sinh</label>
                        <div class="col-md-6">
                            <input type="date" required class="form-control " id="ngaysinh" name="ngaysinh" value="<?php echo $row["NgaySinh"] ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="diachi" class="col-md-2 offset-md-2 col-form-label">Địa chỉ</label>
                        <div class="col-md-6">
                            <input type="text" required class="form-control " id="diachi" name="diachi" value="<?php echo $row["DiaChi"] ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="sdt" class="col-md-2 offset-md-2 col-form-label">Số điện thoại</label>
                        <div class="col-md-6">
                            <input type="text" required class="form-control " id="sdt" name="sdt" value="<?php echo $row["SDT"] ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-md-2 offset-md-2 col-form-label">Email</label>
                        <div class="col-md-6">
                            <input type="text" required class="form-control " id="email" name="email" value="<?php echo $row["Email"] ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="gioitinh" class="col-md-2 offset-md-2 col-form-label">Giới tính</label>
                        <div class="col-md-6">
                            <input type="radio" <?php if($row["GioiTinh"] == 'Nam'){echo "checked";}  ?> id="gioitinh" name="gioitinh" value="Nam">
                            <label for="gioitinh"> Nam</label><br>
                            <input type="checkbox" <?php  if($row["GioiTinh"] == 'Nữ'){echo "checked";}  ?> id="gioitinh" name="gioitinh" value="Nữ">
                            <label for="radio"> Nữ</label><br>
                        </div>
                    </div>
                    <div class="form-group row">
                    </div>
                    <div class="form-group row mt-5">
                        <label for="user_email" class="col-md-2 col-form-label"></label>
                        <div class="col-md-8">
                            <button type="submit" name="btnsubmit" class="btn btn-primary btn-lg mb-2 btn-block">Update học sinh</button>
                        </div>
                    </div>

                </form>

                <br><br>

            </main>
            <div class="ml-sm-auto col-lg-1"></div>
        </div>
    </div>
    <?php
    if (isset($_REQUEST["btnsubmit"])) {
        $tenhs = $_REQUEST["tenhs"];
        $ngaysinh = $_REQUEST["ngaysinh"];
        $diachi = $_REQUEST["diachi"];
        $gioitinh = $_REQUEST["gioitinh"];
        $sdt = $_REQUEST["sdt"];
        $email = $_REQUEST["email"];

        $hinhanh = $_FILES["file"]["tmp_name"];
        $tenanh = $_FILES["file"]["name"];

        if ($tenanh == "") {
            $kq = $p->updatehocsinh($tenhs, $ngaysinh, $diachi, $gioitinh, $Mahocsinh, $sdt, $email);
            if ($kq == 1) {
                echo header("refresh:0; url='QL.php?tatcahocsinh=1'");
            } elseif ($kq == 0) {
                echo "<script>alert('Không thể insert lỗi 1')</script>";
            }
        }else{
            $kq = $p->updatehocsinhCoanh($tenhs, $ngaysinh, $diachi, $gioitinh, $Mahocsinh, $sdt, $email, $tenanh, $hinhanh);
            if ($kq == 1) {
                echo header("refresh:0; url='QL.php?giangvien'");
            } elseif ($kq == 0) {
                echo "<script>alert('Không thể insert lỗi 1')</script>";
            } elseif ($kq == 2) {
                echo "<script>alert('Không thể upload ảnh')</script>";
            }
        }
        
    }
    ?>
</body>

</html>