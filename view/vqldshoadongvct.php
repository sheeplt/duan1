<?php
ob_start();
?>
<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>Danh sách bài học</title>
    <link rel="stylesheet" href="view/styles/lich_day.css">
    <script src="view/js/bootstrap.min.js"></script>
</head>
<?php
$magv = $_REQUEST["cthoadongiaovien"];
$mahd = $_REQUEST["mahd"];
include_once("controller/choadon.php");
$p = new controlhoadon();
include_once("controller/chocsinh.php");
$phocsinh = new controlhocsinh();
$tongtien = 0;
?>

<body>
    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <h3>CHI TIẾT HÓA ĐƠN CỦA GIÁO VIÊN </h3>
                        <?php
                        $table = $p->tinhluongdslopday($magv);
                        if ($table) {
                            if (mysqli_num_rows($table) > 0) {
                                while ($row = mysqli_fetch_assoc($table)) {
                                    $tablelich = $p->tinhluongdslichdaday($magv, $row["MaLopHoc"]);
                                    $sobuoi = mysqli_num_rows($tablelich);
                                    $soluong = $phocsinh->demhocsinh($row["MaLopHoc"]);
                                    echo "Tên lớp học: " . $row["TenLop"];
                                    echo "<br>";
                                    echo "Số buổi: " . $sobuoi;
                                    echo "<br>";
                                    echo "Số học sinh: " . $soluong;
                                    echo "<br>";
                                    if ($row["LoaiLop"] == 1) {
                                        $tbltienluong = $p->tienluong1(2);
                                        $rowtienluong = mysqli_fetch_assoc($tbltienluong);
                                        $tienluong = $rowtienluong["SoTien"];
                                    } else {
                                        $tbltienluong = $p->tienluong1(1);
                                        $rowtienluong = mysqli_fetch_assoc($tbltienluong);
                                        $tienluong = $rowtienluong["SoTien"];
                                    }
                                    $tienmon = $sobuoi * $soluong * $tienluong;
                                    $tienchuoi = strval($tienmon);
                                    $tongtien = $tongtien + $tienmon;
                                    echo "Tiền thanh toán môn: số buổi * số lượng học sinh * " . $tienluong . "(đ) = ";
                                    if (strlen($tienchuoi) == 6) {
                                        echo $tienchuoi[0], $tienchuoi[1], $tienchuoi[2];
                                        echo ".";
                                        echo $tienchuoi[3], $tienchuoi[4], $tienchuoi[5];
                                    } elseif (strlen($tienchuoi) == 7) {
                                        echo $tienchuoi[0];
                                        echo ".";
                                        echo $tienchuoi[1], $tienchuoi[2], $tienchuoi[3];
                                        echo ".";
                                        echo $tienchuoi[4], $tienchuoi[5], $tienchuoi[6];
                                    } elseif (strlen($tienchuoi) == 8) {
                                        echo $tienchuoi[0], $tienchuoi[1];
                                        echo ".";
                                        echo $tienchuoi[2], $tienchuoi[3], $tienchuoi[4];
                                        echo ".";
                                        echo $tienchuoi[5], $tienchuoi[6], $tienchuoi[7];
                                    } elseif (strlen($tienchuoi) == 1) {
                                        echo 0;
                                    }
                                    echo "<br>";
                                    echo "<br>";
                                }
                            }
                        }
                        $tablebu = $p->tinhluongdslichbudaday($magv);
                        $sobuoi = mysqli_num_rows($tablebu);
                        $rowbu = mysqli_fetch_assoc($tablebu);
                        if ($sobuoi > 0) {
                            echo "LỊCH DẠY THAY";
                            echo "<br>";
                            echo "Số buổi: " . $sobuoi;
                            echo "<br>";
                            $tienmon = $sobuoi * 250000;
                            $tienchuoi = strval($tienmon);
                            $tongtien = $tongtien + $tienmon;
                            echo "Tiền thanh toán môn: số buổi * 250.000 * 15000(đ) = ";
                            if (strlen($tienchuoi) == 6) {
                                echo $tienchuoi[0], $tienchuoi[1], $tienchuoi[2];
                                echo ".";
                                echo $tienchuoi[3], $tienchuoi[4], $tienchuoi[5];
                            } elseif (strlen($tienchuoi) == 7) {
                                echo $tienchuoi[0];
                                echo ".";
                                echo $tienchuoi[1], $tienchuoi[2], $tienchuoi[3];
                                echo ".";
                                echo $tienchuoi[4], $tienchuoi[5], $tienchuoi[6];
                            } elseif (strlen($tienchuoi) == 8) {
                                echo $tienchuoi[0], $tienchuoi[1];
                                echo ".";
                                echo $tienchuoi[2], $tienchuoi[3], $tienchuoi[4];
                                echo ".";
                                echo $tienchuoi[5], $tienchuoi[6], $tienchuoi[7];
                            }
                        }

                        echo "<br>";
                        echo "<br>";
                        $tongtienchuoi = strval($tongtien);
                        echo "TỔNG TIỀN: ";
                        if (strlen($tongtienchuoi) == 6) {
                            echo $tongtienchuoi[0], $tongtienchuoi[1], $tongtienchuoi[2];
                            echo ".";
                            echo $tongtienchuoi[3], $tongtienchuoi[4], $tongtienchuoi[5];
                        } elseif (strlen($tongtienchuoi) == 7) {
                            echo $tongtienchuoi[0];
                            echo ".";
                            echo $tongtienchuoi[1], $tongtienchuoi[2], $tongtienchuoi[3];
                            echo ".";
                            echo $tongtienchuoi[4], $tongtienchuoi[5], $tongtienchuoi[6];
                        } elseif (strlen($tongtienchuoi) == 8) {
                            echo $tongtienchuoi[0], $tongtienchuoi[1];
                            echo ".";
                            echo $tongtienchuoi[2], $tongtienchuoi[3], $tongtienchuoi[4];
                            echo ".";
                            echo $tongtienchuoi[5], $tongtienchuoi[6], $tongtienchuoi[7];
                        }
                        ?>
                        <form class="js-form-submit-data" action="" method="POST" enctype="multipart/form-data">
                            <input type="radio" id="xacnhan" name="xacnhan" value="1">
                            <label for="xacnhan"> Xác nhận thanh toán</label><br>
                            <input type="hidden" name="mahd" value="<?php echo $mahd; ?>">
                            <input type="hidden" name="tongtien" value="<?php echo $tongtien; ?>">
                            <button type="submit" name="thanhtoan" class="btn">Thanh toán</button>
                        </form>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
    </div>
</body>
<?php
if (isset($_REQUEST["thanhtoan"])) {
    $xacnhan = $_REQUEST["xacnhan"];
    $mahd = $_REQUEST["mahd"];
    $tongtien = $_REQUEST["tongtien"];
    if ($xacnhan == 1) {
        $kq = $p->thanhtoaGV($mahd, $tongtien);
        if ($kq == 1) {
            echo header("refresh:0; url='QL.php?hoadongiaovien'");
        } elseif ($kq == 0) {
            echo "<script>alert('Lỗi')</script>";
        }
    } else {
        echo "<script>alert('Bạn chưa xác nhận')</script>";
        echo header("refresh:0; url='QL.php?cthoadongiaovien=" . $magv . "'");
    }
}
?>

</html>