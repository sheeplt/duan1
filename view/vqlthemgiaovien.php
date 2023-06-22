<?php
include_once("controller/cgiaovien.php");
ob_start();
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
                    <h1 class="h2" style="padding-left: 200px;">THÊM GIẢNG VIÊN</h1>
                </div>
                <form class="js-form-submit-data" action="#" method="POST" enctype="multipart/form-data">
                    <div class="form-group row">
                        <label for="tengiangvien" class="col-md-2 offset-md-2 col-form-label">Tên giảng viên</label>
                        <div class="col-md-6">
                            <input type="text" required class="form-control " id="tengiangvien" name="tengiangvien" value="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="ngaysinh" class="col-md-2 offset-md-2 col-form-label">Ngày sinh</label>
                        <div class="col-md-6">
                            <input type="date" required class="form-control " id="ngaysinh" name="ngaysinh" value="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="diachi" class="col-md-2 offset-md-2 col-form-label">Địa chỉ</label>
                        <div class="col-md-6">
                            <input type="text" required class="form-control " id="diachi" name="diachi" value="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="file" class="col-md-2 offset-md-2 col-form-label">Hình ảnh</label>
                        <div class="col-md-6">
                            <input type="file" required class="btn-add-avatar js-change-image-file" id="file" name="file"  accept=".png, .jpg, .jpeg">
                            <!-- <input type="file" name="file" class="btn-add-avatar js-change-image-file" accept=".png, .jpg, .jpeg"> -->
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
                                            echo "<option value='" . $row1["MaMonHoc"] . "'>" . $row1["TenMonHoc"] . "</option>";
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
                            <input type="radio" id="gioitinh" name="gioitinh" value="Nam">
                            <label for="gioitinh"> Nam</label><br>
                            <input type="radio" id="gioitinh" name="gioitinh" value="Nữ">
                            <label for="gioitinh"> Nữ</label><br>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="SDT" class="col-md-2 offset-md-2 col-form-label">Số điện thoại</label>
                        <div class="col-md-6">
                            <input type="text" required class="form-control " id="SDT" name="SDT" value="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="Email" class="col-md-2 offset-md-2 col-form-label">Email</label>
                        <div class="col-md-6">
                            <input type="text" required class="form-control " id="Email" name="Email" value="">
                        </div>
                    </div>
                    <div class="form-group row mt-5">
                        <label for="user_email" class="col-md-2 col-form-label"></label>
                        <div class="col-md-8">
                        Tên đăng nhập là 'GV + Mã tự động tăng' <br>
                        Mã giáo viên là mã tự động tăng <br>
                        Lưu mặt khẩu mặc định là 12345
                        </div>
                    </div>
                    <div class="form-group row mt-5">
                        <label for="user_email" class="col-md-2 col-form-label"></label>
                        <div class="col-md-8">
                            <button type="submit" name="btnsubmit" class="btn btn-primary btn-lg mb-2 btn-block">Thêm giảng viên</button>
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
        $tengiangvien = $_REQUEST["tengiangvien"];
        $ngaysinh = $_REQUEST["ngaysinh"];
        $diachi = $_REQUEST["diachi"];
        $gioitinh = $_REQUEST["gioitinh"];
        $monhoc = $_REQUEST["monhoc"];
        $Email = $_REQUEST["Email"];
        $SDT = $_REQUEST["SDT"];

        $hinhanh = $_FILES["file"]["tmp_name"];
        $tenanh = $_FILES["file"]["name"];

        $p = new controlgiaovien();
        $kq = $p->themgiaovien($tengiangvien, $ngaysinh, $diachi, $gioitinh, $monhoc, $tenanh, $hinhanh, $SDT, $Email);
        if ($kq == 1) {
            echo header("refresh:0; url='QL.php?giangvien'");
        } elseif ($kq == 0) {
            echo "<script>alert('Không thể insert lỗi 1')</script>";
        }
    }
    ?>
</body>

</html>