<?php
ob_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách học sinh</title>
    <link rel="stylesheet" href="view/styles/form.css">
    <script src="view/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="view/styles/lich_day.css">
</head>

<body>
    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">

                        <?php
                        //lay ngay thi
                        $tendn = $_SESSION["tendangnhap"];
                        include_once("controller/cquanli.php");
                        $pql = new controlquanli();
                        $tableql = $pql->lay1quanli($tendn);
                        $rowql = mysqli_fetch_assoc($tableql);
                        $ngaythi = $rowql["NgayThi"];
                        $ngaykt = strtotime('-3 day', strtotime($ngaythi));
                        $ngaykt = date('Y-m-j', $ngaykt);
                        $TenDN = $_SESSION["tendangnhap"];
                        include_once("controller/chocsinh.php");
                        if (isset($_REQUEST["btnsubmit"])) {
                            echo header("refresh:0; url='QL.php?themlophoc'");
                        }
                        if (isset($_REQUEST["huylop"])) {
                            include_once("controller/clophoc.php");
                            $p = new controllophoc();
                            $malop = $_REQUEST["malop"];
                            $kq2 = $p->huylop($malop);
                            if ($kq2 == 0) {
                                echo "<script>alert('Hủy lớp thất bại')</script>";
                            }
                        }
                        if (isset($_REQUEST["molop"])) {
                            include_once("controller/clophoc.php");
                            $p = new controllophoc();
                            $malop = $_REQUEST["malop"];
                            $NgayBD = $_REQUEST["NgayBD"];
                            $ngay = date('Y-m-d');
                            if(strtotime($NgayBD) < strtotime($ngay)){
                                echo "<script>alert('Ngày bắt đầu của lớp bé hơn hiện tại')</script>";
                            }else{
                                $kq2 = $p->molop($malop, $ngaykt);
                                if ($kq2 == 0) {
                                    echo "<script>alert('Mở lớp thất bại')</script>";
                                }
                            }
                            
                        }
                        $p = new controlhocsinh();
                        $table = $p->laydslophoc();

                        echo "<h1 style='text-align:center;'>DANH SÁCH LỚP </h1>";
                        ?>
                        <form action="#" method="POST" id='form_button'>
                            <button type="submit" name="btnsubmit" class='button' style='width: 130px;'>Thêm lớp học</button>
                        </form> <br>
                        <?php
                        echo "<table style='width: 1200px;; margin-left: 20px; text-align: center;'>";
                        echo "<tr style='border: 1px solid black;'>";
                        echo "<td style='color: white; text-align:center;border: 1px solid black;  background: #015f95;'>Lớp</td>";
                        echo "<td style='color: white; text-align:center;border: 1px solid black;  background: #015f95;'>Giáo viên giảng dạy</td>";
                        echo "<td style='color: white; text-align:center;border: 1px solid black;  background: #015f95;'>Sỉ Số</td>";
                        echo "<td style='color: white; text-align:center;border: 1px solid black;  background: #015f95;'>Lịch học</td>";
                        echo "<td style='color: white; text-align:center;border: 1px solid black;  background: #015f95;'>Thời gian</td>";
                        echo "<td style='color: white; text-align:center;border: 1px solid black;  background: #015f95;'>Học phí</td>";
                        echo "<td style='color: white; text-align:center;border: 1px solid black;  background: #015f95;'>Id</td>";
                        echo "<td style='color: white; text-align:center;border: 1px solid black;  background: #015f95;'>Password</td>";
                        echo "<td style='color: white; text-align:center;border: 1px solid black;  background: #015f95;'>DS học sinh</td>";
                        echo "<td style='color: white; text-align:center;border: 1px solid black;  background: #015f95;'>Trạng thái</td>";
                        echo "<td style='color: white; text-align:center;border: 1px solid black;  background: #015f95;'>Cập nhật</td>";
                        echo "<td style='color: white; text-align:center;border: 1px solid black;  background: #015f95;'>Hủy lớp</td>";
                        echo "</tr>";
                        if ($table) {
                            if (mysqli_num_rows($table) > 0) {
                                $i = 1;
                                while ($row = mysqli_fetch_assoc($table)) {
                                    echo "<tr>";
                                    echo "<td style='border: 1px solid black; background: #ebecd0;'>";
                                    echo $row["TenLop"];
                                    echo "</td>";
                                    echo "<td style='border: 1px solid black; background: #ebecd0;'>";
                                    echo $row["TenGV"];
                                    echo "</td>";
                                    echo "</td>";
                                    echo "<td style='border: 1px solid black; background: #ebecd0;'>";
                                    $soluong = $p->demhocsinh($row["MaLopHoc"]);
                                    echo $soluong . "/";
                                    echo $row["SiSo"];
                                    echo "</td>";
                                    echo "<td style='border: 1px solid black; background: #ebecd0;'>";
                                    include_once("controller/clich.php");
                                    $plich = new controllich();
                                    $tablelich = $plich->lichchitiet($row["MaLopHoc"]);
                                    if (mysqli_num_rows($tablelich) > 0) {
                                        while ($rowlich = mysqli_fetch_assoc($tablelich)) {
                                            echo $rowlich["Ten"] . " - Tiết: " . $rowlich["MaTiet"] . "(" . $rowlich["ThoiGian"] . ")";
                                            echo '<br>';
                                        }
                                    }
                                    echo "</td>";
                                    echo "<td style='border: 1px solid black; background: #ebecd0;'>";
                                    $ngay = date('Y-m-d');
                                    $ngay = strtotime($ngay);
                                    $ngaylich = strtotime($row["NgayBD"]);
                                    if ($ngaylich < $ngay and $row["TrangThai"] == 1 or $ngaylich < $ngay and $row["TrangThai"] == 2) {
                                        echo "<p style = 'color:red'> " . $row["NgayBD"] . " </p>";
                                    } else {
                                        echo $row["NgayBD"];
                                    }
                                    echo "</td>";
                                    echo "<td style='border: 1px solid black; background: #ebecd0;'>";
                                    if (strlen($row["HocPhi"]) == 6) {
                                        echo $row["HocPhi"][0], $row["HocPhi"][1], $row["HocPhi"][2];
                                        echo ".";
                                        echo $row["HocPhi"][3], $row["HocPhi"][4], $row["HocPhi"][5];
                                    } elseif (strlen($row["HocPhi"]) == 7) {
                                        echo $row["HocPhi"][0];
                                        echo ".";
                                        echo $row["HocPhi"][1], $row["HocPhi"][2], $row["HocPhi"][3];
                                        echo ".";
                                        echo $row["HocPhi"][4], $row["HocPhi"][5], $row["HocPhi"][6];
                                    } elseif (strlen($row["HocPhi"]) == 8) {
                                        echo $row["HocPhi"][0], $row["HocPhi"][1];
                                        echo ".";
                                        echo $row["HocPhi"][2], $row["HocPhi"][3], $row["HocPhi"][4];
                                        echo ".";
                                        echo $row["HocPhi"][5], $row["HocPhi"][6], $row["HocPhi"][7];
                                    }
                                    echo "</td>";
                                    echo "<td style='border: 1px solid black; background: #ebecd0;'>";
                                    echo $row["IdChinh"];
                                    echo "</td>";
                                    echo "<td style='border: 1px solid black; background: #ebecd0;'>";
                                    echo $row["PassChinh"];
                                    echo "</td>";
                                    echo "<td style='border: 1px solid black; background: white;'>";
                                    echo "<a href='QL.php?ctdshs=" . $row["MaLopHoc"] . "'>Xem</a>";
                                    echo "</td>";
                                    echo "</td>";
                                    echo "<td style='border: 1px solid black; background: white;'>";
                                    if ($row["TrangThai"] == 3) {
                                        echo "<a href='QL.php?chitietlichtheotiet=" . $row["MaLopHoc"] . "'>Xem lịch học</a>";
                                    } elseif ($row["TrangThai"] == 2) {
                        ?>
                                        <form method="POST" action="">
                                            <input type="hidden" name="malop" value="<?php echo $row["MaLopHoc"]; ?>">
                                            <input type="hidden" name="NgayBD" value="<?php echo $row["NgayBD"]; ?>">
                                            <input name="molop" type="submit" value="Mở lớp" onclick="return confirm('Bạn muốn mở lớp?');" style="background-color: white; border: solid white; color: blue;">
                                        </form>
                                    <?php
                                    } elseif ($row["TrangThai"] == 1) {
                                        echo "Đang lên kế hoạch";
                                    } elseif ($row["TrangThai"] == 5) {
                                        echo "Đã hủy";
                                    } else {
                                        echo "Đã kết thúc";
                                    }
                                    echo "</td>";
                                    echo "<td style='border: 1px solid black; background: white;'>";
                                    if ($row["TrangThai"] == 5 or $row["TrangThai"] == 4 or $row["TrangThai"] == 3) {
                                        echo "Sửa";
                                    } else {
                                        echo "<a href='QL.php?updatelich12=" . $row["MaLopHoc"] . "'>Sửa chi tiết</a>";
                                    }
                                    echo "</td>";

                                    echo "<td style='border: 1px solid black; background: white;'>";
                                    if ($row["TrangThai"] == 3 or $row["TrangThai"] == 4 or $row["TrangThai"] == 5) {
                                        echo "Hủy lớp";
                                    } else {
                                    ?>
                                        <form method="POST" action="">
                                            <input type="hidden" name="malop" value="<?php echo $row["MaLopHoc"]; ?>">
                                            <input name="huylop" type="submit" value="Hủy lớp" onclick="return confirm('Bạn muốn hủy lớp?');" style="background-color: white; border: solid white; color: red;">
                                        </form>
                                    <?php
                                    }

                                    echo "</td>";
                                    echo "</tr>";
                                }
                                echo "</table>";
                            }
                        }
                        ?>

                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
    </div>
</body>

</html>