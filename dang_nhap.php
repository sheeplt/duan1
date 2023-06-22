<?php
ob_start();
session_start(); 
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
    <link rel="stylesheet" type="text/css" href="view/styles/Form_dang_nhap.css">
</head>

<body>

    <?php
    echo "<meta charset='utf-8'>";
    if (isset($_REQUEST["submitdangnhap"])) {
        $tendangnhap = $_REQUEST["username"];
        $mk = $_REQUEST["password"];
        include_once("controller/ctaikhoan.php");
        $p = new controlTaiKhoan();
        $table = $p->laytaikhoan($tendangnhap);
        if ($table) {
            if (mysqli_num_rows($table) > 0) {
                $row = mysqli_fetch_assoc($table);
                if($row["TrangThaiTK"] == 0){
                    echo "<script>alert('Tài khoản của bạn đã bị vô hiệu hóa')</script>";
                }else{
                if ($tendangnhap == $row["TenDN"] && $mk == $row["MK"]) {
                    $_SESSION["login"] = "123";
                    $_SESSION["tendangnhap"] = $row["TenDN"];
                    if ($row["LoaiTK"] == 'GV') {
                        $p->statusgv($tendangnhap);
                        echo header("refresh:0; url='GV.php'");
                    } elseif ($row["LoaiTK"] == 'HS') {
                        $p->statushs($tendangnhap);
                        echo header("refresh:0; url='HS.php'");
                    } elseif ($row["LoaiTK"] == 'QL') {
                        $p->statusql($tendangnhap);
                        echo header("refresh:0; url='QL.php'");
                    }
                } elseif ($tendangnhap == $row["TenDN"] && $mk != $row["MK"]) {
                    echo "<script>alert('Mật khẩu không đúng')</script>";
                }}
            } else {
                echo "<script>alert('Tên đăng nhập không chính xác')</script>";
            }
        }
    }
    ?>

    <form action="" method="post">
        <section>
            <div class="img-bg">
                <img src="view/images/course_9.jpg" alt="Hình Ảnh Minh Họa">
            </div>
            <div class="noi-dung">
                <div class="form">
                    <h2>Trang Đăng Nhập</h2>
                    <form action="">
                        <div class="input-form">
                            <span>Tên Người Dùng</span>
                            <input type="text" id="" name="username" required>
                        </div>
                        <div class="input-form">
                            <span>Mật Khẩu</span>
                            <input type="password" name="password" required>
                        </div>
                        <!-- <div class="nho-dang-nhap">
                        <label><input type="checkbox" name=""> Nhớ Đăng Nhập</label>
                    </div> -->
                        <div class="input-form">
                            <input type="submit" name="submitdangnhap" value="Đăng Nhập">
                        </div>
                        <!-- <div class="input-form">
                        <p>Bạn Chưa Có Tài Khoản? <a href="Dang_ky.php">Đăng Ký</a></p>
                    </div> -->
                    </form>
                </div>
            </div>
        </section>
    </form>

</body>

</html>