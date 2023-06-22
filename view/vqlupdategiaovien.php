<?php
include_once("controller/cgiaovien.php");
ob_start();
$magv = $_REQUEST["updategv"];
$p = new controlgiaovien();
$table = $p->lay1giaovien1($magv);
$row = mysqli_fetch_assoc($table);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <script src="view/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="ml-sm-auto col-lg-1"></div>
            <main role="main" class="ml-sm-auto col-lg-10">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
                    <h1 class="h2" style="padding-left: 200px;">UPDATE GIẢNG VIÊN</h1>
                </div>
                <form class="js-form-submit-data" action="#" method="POST"  enctype="multipart/form-data">
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
                        <label for="mahs" class="col-md-2 offset-md-2 col-form-label">Mã giảng viên</label>
                        <div class="col-md-6">
                            <input type="text" required disabled class="form-control " id="mahs" name="mahs" value="<?php echo $row["MaGV"] ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tendn" class="col-md-2 offset-md-2 col-form-label">Tên đăng nhập</label>
                        <div class="col-md-6">
                            <input type="text" required disabled class="form-control " id="tendn" name="tendn" value="<?php echo $row["TenDN"] ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tengiangvien" class="col-md-2 offset-md-2 col-form-label">Tên giảng viên</label>
                        <div class="col-md-6">
                            <input type="text" required class="form-control " id="tengiangvien" name="tengiangvien" value="<?php echo $row["TenGV"] ?>">
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
                    <div class="form-group row mt-5">
                        <label for="monhoc" class="col-md-2 offset-md-2 col-form-label">Môn học</label>
                        <div class="col-md-6">
                            <select name="monhoc">
                                <?php
                                include_once("controller/cmonhoc.php");
                                $p1 = new controlmonhoc();
                                $table1 = $p1->laymonhoc();
                                if ($table1) {
                                    if (mysqli_num_rows($table1) > 0) {
                                        while ($row1 = mysqli_fetch_assoc($table1)) {
                                            if($row["MaMonHoc"] == $row1["MaMonHoc"]){
                                            echo "<option selected value='" . $row1["MaMonHoc"] . "'>" . $row1["TenMonHoc"] . "</option>";
                                            }else{
                                                echo "<option value='" . $row1["MaMonHoc"] . "'>" . $row1["TenMonHoc"] . "</option>";
                                            }
                                        }
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div> <br>
                    <div class="form-group row">
                        <label for="gioitinh" class="col-md-2 offset-md-2 col-form-label">Giới tính</label>
                        <div class="col-md-6">
                            <input type="radio" <?php if($row["GioiTinh"] == 'Nam'){echo "checked";}  ?> id="gioitinh" name="gioitinh" value="Nam">
                            <label for="gioitinh"> Nam</label><br>
                            <input type="radio" <?php  if($row["GioiTinh"] == 'Nữ'){echo "checked";}  ?> id="gioitinh" name="gioitinh" value="Nữ">
                            <label for="gioitinh"> Nữ</label><br>
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
                    <div class="form-group row mt-5">
                        <label for="user_email" class="col-md-2 col-form-label"></label>
                        <div class="col-md-8">
                            <button type="submit" name="btnsubmit" class="btn btn-primary btn-lg mb-2 btn-block">Update giảng viên</button>
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
        $p = new controlgiaovien();

        $tengiangvien = $_REQUEST["tengiangvien"];
        $ngaysinh = $_REQUEST["ngaysinh"];
        $diachi = $_REQUEST["diachi"];
        $gioitinh = $_REQUEST["gioitinh"];
        $monhoc = $_REQUEST["monhoc"];
        $sdt = $_REQUEST["sdt"];
        $email = $_REQUEST["email"];

        $hinhanh = $_FILES["file"]["tmp_name"];
        $tenanh = $_FILES["file"]["name"];
        if ($tenanh == "") {
            $kq = $p->updategiaovien($tengiangvien, $ngaysinh, $diachi, $gioitinh, $monhoc, $monhoc, $sdt, $email);
            if ($kq == 1) {
                echo header("refresh:0; url='QL.php?giangvien'");
            } elseif ($kq == 0) {
                echo "<script>alert('Không thể insert lỗi 1')</script>";
            }
        }else{
            $kq = $p->updategiaovienCoanh($tengiangvien, $ngaysinh, $diachi, $gioitinh, $monhoc, $monhoc, $tenanh, $hinhanh, $sdt, $email);
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