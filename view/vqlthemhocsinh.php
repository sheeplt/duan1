<?php
include_once("controller/chocsinh.php");
include_once("controller/clophoc.php");
ob_start();
$Malop = $_REQUEST["themhocsinh"];
$p = new controllophoc();
$kq = $p->chon1lophoc($Malop);
$row = mysqli_fetch_assoc($kq);
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
                    <h1 class="h2" style="padding-left: 200px;">THÊM HỌC SINH VÀO LỚP <?php echo mb_strtoupper($row["TenLop"]) ?></h1>
                </div>
                <form class="js-form-submit-data" action="#" method="POST"  enctype="multipart/form-data">
                    <div class="form-group row">
                        <label for="tenhs" class="col-md-2 offset-md-2 col-form-label">Tên học sinh</label>
                        <div class="col-md-6">
                            <input type="text" required class="form-control " id="tenhs" name="tenhs" value="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="ngaysinh" class="col-md-2 offset-md-2 col-form-label">Hình đại diện</label>
                        <div class="col-md-6">
                        <input type="file" required class="btn-add-avatar js-change-image-file" id="file" name="file"  accept=".png, .jpg, .jpeg">
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
                        <label for="gioitinh" class="col-md-2 offset-md-2 col-form-label">Giới tính</label>
                        <div class="col-md-6">
                            <input type="radio" id="gioitinh" name="gioitinh" value="Nam">
                            <label for="gioitinh"> Nam</label><br>
                            <input type="radio" id="gioitinh" name="gioitinh" value="Nữ">
                            <label for="gioitinh"> Nữ</label><br>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="sdt" class="col-md-2 offset-md-2 col-form-label">Số điện thoại</label>
                        <div class="col-md-6">
                            <input type="text" required class="form-control " id="sdt" name="sdt" value="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-md-2 offset-md-2 col-form-label">Email</label>
                        <div class="col-md-6">
                            <input type="text" required class="form-control " id="email" name="email" value="">
                        </div>
                    </div>
                    <div class="form-group row mt-5">
                    <label for="user_email" class="col-md-2 col-form-label"></label>
                        <div class="col-md-8">Tên đăng nhập là 'HS + Mã tự động tăng' <br>
                        Mã học sinh là mã tự động tăng <br>
                        Lưu mặt khẩu mặc định là 12345</div>
                        
                    </div>
                    <div class="form-group row mt-5">
                        <label for="user_email" class="col-md-2 col-form-label"></label>
                        <div class="col-md-8">
                            <button type="submit" name="btnsubmit" class="btn btn-primary btn-lg mb-2 btn-block">Tiếp tục thêm học sinh</button>
                            <button type="submit" name="ketthuc" class="btn btn-primary btn-lg mb-2 btn-block">Kết thúc</button>
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
        $p = new controlhocsinh();
        $kq = $p->themhocsinh($tenhs, $ngaysinh, $diachi, $gioitinh, $Malop, $sdt, $email, $tenanh, $hinhanh);
        if ($kq == 1) {
            echo header("refresh:0; url='QL.php?themhocsinh=".$Malop."'");
        }elseif($kq == 3){
            echo "<script>alert('Số lượng học sinh đã đủ')</script>";
        }elseif($kq == 4){
            echo "<script>alert('Cập nhật trạng thái thất bại')</script>";
        } elseif ($kq == 0) {
            echo "<script>alert('Không thể insert lỗi 1')</script>";
        }
    }
    if (isset($_REQUEST["ketthuc"])) {
        $tenhs = $_REQUEST["tenhs"];
        $ngaysinh = $_REQUEST["ngaysinh"];
        $diachi = $_REQUEST["diachi"];
        $gioitinh = $_REQUEST["gioitinh"];
        $sdt = $_REQUEST["sdt"];
        $email = $_REQUEST["email"];

        $hinhanh = $_FILES["file"]["tmp_name"];
        $tenanh = $_FILES["file"]["name"];
        $p = new controlhocsinh();
        $kq = $p->themhocsinh($tenhs, $ngaysinh, $diachi, $gioitinh, $Malop, $sdt, $email, $tenanh, $hinhanh);
        if ($kq == 1) {
            echo header("refresh:0; url='QL.php?ctdshs=".$Malop."'");
        }elseif($kq == 3){
            echo "<script>alert('Số lượng học sinh đã đủ')</script>";
        }elseif($kq == 4){
            echo "<script>alert('Cập nhật trạng thái thất bại')</script>";
        } elseif ($kq == 0) {
            echo "<script>alert('Không thể insert lỗi 1')</script>";
        } elseif ($kq == 6) {
            echo "<script>alert('Upload thất bại')</script>";
        }
    }
    ?>
</body>

</html>