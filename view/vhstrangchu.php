<?php
ob_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Học sinh</title>
</head>

<body>
    <div class="popular page_section">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="section_title text-center">
                        <h1>Các khóa học hiện tại</h1>
                    </div>
                </div>
            </div>
            <table style="width:100%; font-size: 25px ; text-align: center; margin-top: 50px;">
                <tr>
                    <?php
                    include_once("controller/clich.php");
                    $p = new controllich();
                    // lấy mã lớp
                    $tenDN = $_SESSION["tendangnhap"];
                    include_once("controller/chocsinh.php");
                    $hocsinh = new controlhocsinh();
                    $table = $hocsinh->lay1hs($tenDN);
                    $row = mysqli_fetch_assoc($table);
                    $MaHS = $row['MaHS'];

                    $i = 0;
                    $table1 = $p->laysomonhocchohs($MaHS);
                    while ($row1 = mysqli_fetch_assoc($table1)) {
                        $i = $i + 1;
                        echo "<td style='border : 1px solid black; width: 33%;'>";
                        echo "<H3>" . $row1['TenLop'] . "</H3>";
                        echo "Giáo viên: " . $row1['TenGV'] . "<br>";
                        echo "<a href='HS.php?xembaihoc=" . $row1['MaLopHoc'] . "'>Xem bài học</a><br>";
                        //echo "<a href='HS.php?xemkiemtra=".$row1['MaGV']."&MaLopHoc=".$malop."'>kiểm tra</a><br>";
                        echo "</td>";
                        if ($i == 3) {
                            echo "</tr>";
                            echo "<tr>";
                            $i = 0;
                        }
                    }
                    ?>
                </tr>
            </table>
        </div>
    </div>
</body>

</html>