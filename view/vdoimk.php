<?php
ob_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đổi mật khẩu</title>
    <script src="view/js/bootstrap.min.js"></script>
</head>

<body>
    <?php
    $TenDN = $_SESSION["tendangnhap"];
    include_once("controller/ctaikhoan.php");
    $p = new controlTaiKhoan();
    $table = $p->laytaikhoan($TenDN);
    $row = mysqli_fetch_assoc($table);
    if (isset($_REQUEST["btnsubmit"])) {
        $mk1 = $_REQUEST["mk1"];
        $mk2 = $_REQUEST["mk2"];
        $mk3 = $_REQUEST["mk3"];
        if ($mk1 != $row["MK"]) {
            echo "<script>alert('Nhập mật khẩu cũ không chính xác')</script>";
        } elseif ($mk2 != $mk3) {
            echo "<script>alert('Nhập mật khẩu mới không trùng')</script>";
        } elseif ($mk2 == $mk1) {
            echo "<script>alert('Nhập mật khẩu mới giống mật khẩu cũ')</script>";
        } else {
            $kq = $p->laydoimk($TenDN, $mk2);
            if ($kq == 1) {
                echo "<script>alert('cập nhật dữ liệu thành công')</script>";
                echo header("refresh:0; url='GV.php?ttcn'");
            } elseif ($kq == 0) {
                echo "<script>alert('Không thể update lỗi')</script>";
            }
        }
    }
    ?>
    <div class="popular page_section">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="section_title text-center">
                        <h1 style="margin-bottom: 100px;">THAY ĐỔI MẬT KHẨU</h1>
                    </div>
                </div>
            </div>
            <main role="main" class="ml-sm-auto col-lg-11">
                <form class="js-form-submit-data" action="#" method="POST">
                    <div class="form-group row">
                        <label for="mk1" class="col-md-2 offset-md-2 col-form-label">Nhập mật khẩu cũ:</label>
                        <div class="col-md-6">
                            <input type="password" class="form-control " id="mk1" name="mk1" value="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="mk2" class="col-md-2 offset-md-2 col-form-label">Nhập mật khấu mới:</label>
                        <div class="col-md-6">
                            <input type="password" class="form-control " id="mk2" name="mk2" value="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="mk3" class="col-md-2 offset-md-2 col-form-label">Nhập lại mật khấu mới:</label>
                        <div class="col-md-6">
                            <input type="password" class="form-control " id="mk3" name="mk3" value="">
                        </div>
                    </div>
                    <div class="form-group row mt-5">
                        <label for="user_email" class="col-md-2 col-form-label"></label>
                        <div class="col-md-8">
                            <button type="submit" name="btnsubmit" class="btn btn-primary btn-lg mb-2 btn-block">Đổi mật
                                khẩu</button>
                        </div>
                    </div>

                </form>

                <br><br>

            </main>
        </div>
    </div>
</body>

</html>