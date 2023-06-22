
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lí lớp họct</title>
</head>
<style>
</style>

<body>
    <div class="popular page_section">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="section_title text-center">
                        <h1>Quản lí lớp học</h1>
                    </div>
                </div>
            </div>

                <h2 style='margin-bottom: 30px;'>LỚP ĐANG GIẢNG DẠY</h2>
                
                <table style="width: 100%; font-size: 25px ; text-align: center; margin-top: 5px;">
                    <tr>
                        <?php
                        include_once("controller/clich.php");
                        $p = new controllich();
                        // lấy mã lớp
                        $tenDN = $_SESSION["tendangnhap"];
                        include_once("controller/clophoc.php");
                        $lophoc = new controllophoc();
                        $tablelophoc = $lophoc->chonlophocdangmo2chogv($tenDN);

                        $i = 0;
                        while ($rowlophoc = mysqli_fetch_assoc($tablelophoc)) {
                            $i = $i + 1;
                            echo "<td class ='id' style='border: 1px solid black;'>";
                            echo "<H2 style='margin-top: 10px;'>" . $rowlophoc['TenLop'] . "</H2>";
                            echo "<a href='GV.php?xbh=" . $rowlophoc['MaLopHoc'] . "' style='font-size: 20px;'>Chi tiết</a><br>";
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
                
                <h2 style='margin: 30px 0px 30px 0px;'>LỚP ĐÃ HOÀN THÀNH</h2>
                
                <table style="width: 100%; font-size: 25px ; text-align: center; margin: 5px;"
                    border="1">
                    <tr>
                        <?php
                        $tablelophoc = $lophoc->chonlophockt2chogv($tenDN);

                        $i = 0;
                        while ($rowlophoc = mysqli_fetch_assoc($tablelophoc)) {
                            $i = $i + 1;
                            echo "<td class ='id' style=' border : 1px solid black;'>";
                            echo "<H2 style='margin-top: 10px;'>" . $rowlophoc['TenLop'] . "</H2>";
                            echo "<a href='GV.php?xbh=" . $rowlophoc['MaLopHoc'] . "' style='font-size: 20px;'>Chi tiết</a><br>";
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