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
                        $TenDN = $_SESSION["tendangnhap"];
                        include_once("controller/chocsinh.php");
                        if (isset($_REQUEST["btnsubmit"])) {
                            echo header("refresh:0; url='QL.php?themlophoc'");
                        }
                        $p = new controlhocsinh();

                        include_once("controller/clophoc.php");
                        $plophoc = new controllophoc();
                        $table = $plophoc->chonlophocdangmo2();
                        if ($table) {
                            if (mysqli_num_rows($table) > 0) {
                                echo "<h1 style='text-align:center;'>DANH SÁCH LỚP ĐANG MỞ </h1>";
                                echo "<table style='width: 1200px; margin-left: 20px; text-align: center;'>";
                                echo "<tr style='border: 1px solid black;'>";
                                echo "<td style='color: white; text-align:center;border: 1px solid black;  background: #015f95;'>STT</td>";
                                echo "<td style='color: white; text-align:center;border: 1px solid black;  background: #015f95;'>Lớp</td>";
                                echo "<td style='color: white; text-align:center;border: 1px solid black;  background: #015f95;'>Giáo viên giảng dạy</td>";
                                echo "<td style='color: white; text-align:center;border: 1px solid black;  background: #015f95;'>Sỉ Số</td>";
                                echo "<td style='color: white; text-align:center;border: 1px solid black;  background: #015f95;'>Lịch học</td>";
                                echo "<td style='color: white; text-align:center;border: 1px solid black;  background: #015f95;'>Id</td>";
                                echo "<td style='color: white; text-align:center;border: 1px solid black;  background: #015f95;'>Password</td>";
                                echo "<td style='color: white; text-align:center;border: 1px solid black;  background: #015f95;'>Lịch học</td>";
                                echo "<td style='color: white; text-align:center;border: 1px solid black;  background: #015f95;'>Đổi giáo viên</td>";
                                echo "<td style='color: white; text-align:center;border: 1px solid black;  background: #015f95;'>Id học</td>";
                                echo "</tr>";
                                $i = 1;
                                while ($row = mysqli_fetch_assoc($table)) {
                                    echo "<tr>";
                                    echo "<td style='border: 1px solid black; background: white;'>";
                                    echo $i;
                                    $i = $i + 1;
                                    echo "</td>";
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
                                    echo $row["IdChinh"];
                                    echo "</td>";
                                    echo "<td style='border: 1px solid black; background: #ebecd0;'>";
                                    echo $row["PassChinh"];
                                    echo "</td>";
                                    echo "<td style='border: 1px solid black; background: #ebecd0;'>";
                                    echo "<a href='QL.php?chitietlichtheotiet=" . $row["MaLopHoc"] . "'>Xem lịch học</a>";
                                    echo "</td>";
                                    echo "<td style='border: 1px solid black; background: white;'>";
                                    echo "<a href='QL.php?updatelich1=" . $row["MaLopHoc"] . "'>Đổi giáo viên</a>";
                                    echo "</td>";
                                    echo "<td style='border: 1px solid black; background: white;'>";
                                    echo "<a href='QL.php?updatelich13=" . $row["MaLopHoc"] . "'>Đổi Id</a>";
                                    echo "</td>";
                                    echo "</tr>";
                                }
                                echo "</table>";
                            } else {
                                echo "0 result";
                            }
                        } else {
                            echo "Erro";
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