<?php
include_once("controller/cquanli.php");
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
                    <h1 class="h2" style="padding-left: 200px;">THÊM GIÁO VỤ</h1>
                </div>
                <form class="js-form-submit-data" action="#" method="POST"   enctype="multipart/form-data">
                    <div class="form-group row">
                        <label for="tenquanli" class="col-md-2 offset-md-2 col-form-label">Tên giáo vụ</label>
                        <div class="col-md-6">
                            <input type="text" required class="form-control " id="tenquanli" name="tenquanli" value="">
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
                    <div class="form-group row">
                        <label for="vaitro" class="col-md-2 offset-md-2 col-form-label">Vai trò</label>
                        <div class="col-md-6">
                            <input type="radio" id="vaitro" name="vaitro" value="1">
                            <label for="vaitro"> Giáo vụ lớp học</label><br>
                            <input type="radio" id="vaitro" name="vaitro" value="2">
                            <label for="vaitro"> Giáo vụ tư vấn khách hàng</label><br>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="vaitro" class="col-md-2 offset-md-2 col-form-label"></label>
                        <div class="col-md-6">
                        Tên đăng nhập là 'QL + Mã tự động tăng' <br>
                        Mã giáo vụ là mã tự động tăng <br>
                        Lưu mặt khẩu mặc định là 12345
                        </div>
                    </div>
                    <div class="form-group row mt-5">
                        <label for="user_email" class="col-md-2 col-form-label"></label>
                        <div class="col-md-8">
                            <button type="submit" name="btnsubmit" class="btn btn-primary btn-lg mb-2 btn-block">Thêm giáo vụ</button>
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
        $tenquanli = $_REQUEST["tenquanli"];
        $ngaysinh = $_REQUEST["ngaysinh"];
        $diachi = $_REQUEST["diachi"];
        $gioitinh = $_REQUEST["gioitinh"];
        $sdt = $_REQUEST["sdt"];
        $email = $_REQUEST["email"];
        $vaitro = $_REQUEST["vaitro"];

        $hinhanh = $_FILES["file"]["tmp_name"];
        $tenanh = $_FILES["file"]["name"];
        $p = new controlquanli();
        $kq = $p->themquanli($tenquanli, $ngaysinh, $diachi, $gioitinh, $sdt, $email, $vaitro, $tenanh, $hinhanh);
        if ($kq == 1) {
            echo header("refresh:0; url='QL.php?quanli'");
        } elseif ($kq == 0) {
            echo "<script>alert('Không thể insert lỗi 1')</script>";
        }
    }
    ?>
</body>

</html>