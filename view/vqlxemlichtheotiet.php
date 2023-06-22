<?php
ob_start();
?>
<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>Xem lịch chi tiết</title>
    <link rel="stylesheet" href="view/styles/lich_day.css">
</head>

<body>
    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <?php
                        $tendn = $_SESSION["tendangnhap"];
                        include_once("controller/clich.php");
                        $p = new controllich();
                        $malop = $_REQUEST["chitietlichtheotiet"];
                        if (isset($_REQUEST["xoalich"])) {
                            $malich = $_REQUEST["MaLich"];
                            $kq2 = $p->layxoalich3($malich);
                            if ($kq2 == 1) {
                            } elseif ($kq2 == 0) {
                                echo "<script>alert('Không thể xóa')</script>";
                            }
                        }



                        $table = $p->laylichtheotietchoQL($malop);
                        if ($table) {
                            if (mysqli_num_rows($table) > 0) {
                                echo "<h1 style='text-align:center; width: 100%'>DANH SÁCH LỊCH HỌC TRONG TUẦN <br></h1>";
                        ?>
                                <form method="POST" action="" id="form_button">
                                    <input type="hidden" name="malophoc" value="<?php echo $malop  ?>">
                                    <button type="submit" name="submit" class="button">Xem lịch bù</button>
                                </form> <br>
                                <?php
                                echo "<table style='width:1200px;  text-align: center;'>";
                                echo "<tr style='border: 1px solid black;'>";
                                echo "<td style='color: white; text-align:center;border: 1px solid black;  background: #015f95;'>Chi tiết</td>";
                                echo "<td style='color: white; text-align:center;border: 1px solid black;  background: #015f95;'>STT</td>";
                                echo "<td style='color: white; text-align:center;border: 1px solid black;  background: #015f95;'>Thứ trong tuần</td>";
                                echo "<td style='color: white; text-align:center;border: 1px solid black;  background: #015f95;'>Tiết học</td>";
                                echo "<td style='color: white; text-align:center;border: 1px solid black;  background: #015f95;'>Cập nhật buổi học</td>";
                                echo "</tr>";
                                $i = 1;
                                while ($row = mysqli_fetch_assoc($table)) {
                                    echo "<tr>";
                                    echo "<td style='border: 1px solid black; background: white;'>";
                                ?>
                                    <form method="POST" action="">
                                        <input type="hidden" name="malophoc" value="<?php echo $row['MaLopHoc']  ?>">
                                        <input type="hidden" name="thu" value="<?php echo $row['MaThu']  ?>">
                                        <input type="hidden" name="tiet" value="<?php echo $row['MaTiet']  ?>">
                                        <input name="chitiet" type="submit" value="&#8744;" style="background-color: white; border: solid white; color: red;">
                                    </form>
                            <?php
                                    echo "</td>";
                                    echo "<td style='border: 1px solid black; background: white;'>";
                                    echo $i;
                                    $i = $i + 1;
                                    echo "</td>";
                                    echo "<td style='border: 1px solid black; background: #ebecd0;'>";
                                    echo $row['Ten'];
                                    if ($row["TrangThaiLich"] == 2) {
                                        echo " (Lịch cũ)";
                                    }
                                    echo "</td>";
                                    echo "<td style='border: 1px solid black; background: #ebecd0;'>";
                                    echo $row["MaTiet"] . " (" . $row["ThoiGian"] . ")";
                                    echo "</td>";
                                    echo "<td style='border: 1px solid black; background: #white;'>";
                                    if ($row["TrangThaiLich"] == 2) {
                                        echo "Sửa";
                                    } else {
                                        echo "<a href='QL.php?updatelich2=" . $row["MaLopHoc"] . "&tiet=" . $row["MaTiet"] . "&thu=" . $row['MaThu'] . "'>Sửa</a>";
                                    }
                                    echo "</td>";
                                    echo "</tr>";
                                }
                                echo "</table><br><br><br>";
                            }
                        }
                        if (isset($_REQUEST["chitiet"])) {
                            $malh = $_REQUEST["malophoc"];
                            $thu = $_REQUEST["thu"];
                            $tiet = $_REQUEST["tiet"];
                            ?>
                            <h1 style='text-align:center;'>CHI TIẾT LỊCH HỌC</h1>
                            <form method="POST" action="#" id="form_button">
                                <input type="hidden" name="malophoc" value="<?php echo $malh ?>">
                                <input type="hidden" name="tiet" value="<?php echo $tiet ?>">
                                <input type="hidden" name="thu" value="<?php echo $thu ?>">
                                <input type="radio" id="chuahoc" checked name="abc" value="chuahoc">
                                <label for="chuahoc">Chưa học &emsp;</label>
                                <input type="radio" id="dahoc" name="abc" value="dahoc">
                                <label for="dahoc">Đã học &emsp;</label>
                                <input name="locbuoihoc" type="submit" value="Lọc" class="button">
                            </form>
                            <table style='width:1200px; text-align: center;'>
                                <tr style='border: 1px solid black;'>
                                    <td style='color: white; text-align:center;border: 1px solid black;  background: #015f95;'>STT</td>
                                    <td style='color: white; text-align:center;border: 1px solid black;  background: #015f95;'>Ngày học</td>
                                    <td style='color: white; text-align:center;border: 1px solid black;  background: #015f95;'>Id</td>
                                    <td style='color: white; text-align:center;border: 1px solid black;  background: #015f95;'>Password</td>
                                    <td style='color: white; text-align:center;border: 1px solid black;  background: #015f95;'>Giáo viên dạy thay</td>
                                    <td style='color: white; text-align:center;border: 1px solid black;  background: #015f95;'>Chú thích</td>
                                    <td style='color: white; text-align:center;border: 1px solid black;  background: #015f95;'>Đổi lịch học một buổi</td>
                                    <td style='color: white; text-align:center;border: 1px solid black;  background: #015f95;'>Xóa</td>
                                </tr>
                                <tr>
                                    <?php
                                    $table1 = $p->laylichtheongaychoQL($malop, $tiet, $thu);
                                    if (mysqli_num_rows($table1) > 0) {
                                        $i = 1;
                                        while ($row1 = mysqli_fetch_assoc($table1)) {
                                            echo "<td style='border: 1px solid black; background: white;'>";
                                            echo $i;
                                            $i = $i + 1;
                                            echo "</td>";
                                            echo "<td style='border: 1px solid black; background: #ebecd0;'>";
                                            echo $row1["Ngay"];
                                            echo "</td>";
                                            echo "<td style='border: 1px solid black; background: #ebecd0;'>";
                                            echo $row1["Id"];
                                            echo "</td>";
                                            echo "<td style='border: 1px solid black; background: #ebecd0;'>";
                                            echo $row1["Pass"];
                                            echo "</td>";
                                            echo "<td style='border: 1px solid black; background: #ebecd0;'>";
                                            //lấy mã gv 
                                            include_once("controller/clophoc.php");
                                            $plophoc = new controllophoc();
                                            $tablelophoc = $plophoc->chon1lophoc($malop);
                                            $rowlophoc = mysqli_fetch_assoc($tablelophoc);
                                            if ($row1["GVTrucTiep"] == $rowlophoc["MaGV"]) {
                                                echo "Không";
                                            } else {
                                                $tablegiaovien = $p->lay1lich($row1["MaLich"]);
                                                $rowgiaovien = mysqli_fetch_assoc($tablegiaovien);
                                                echo $rowgiaovien["TenGV"];
                                            }
                                            echo "</td>";
                                            echo "<td style='border: 1px solid black; background: #ebecd0;'>";
                                            echo $row1["GhiChu"];
                                            echo "</td>";
                                            echo "<td style='border: 1px solid black; background: white;'>";
                                            echo "<a href='QL.php?updatelich3=" . $row1["MaLich"] . "&malop=" . $malh . "'>Sửa</a>";
                                            echo "</td>";
                                            echo "<td style='border: 1px solid black; background: white;'>";
                                    ?>
                                            <form method="POST" action="">
                                                <input type="hidden" name="MaLich" value="<?php echo $row1['MaLich']  ?>">
                                                <input name="xoalich" type="submit" value="Xóa" onclick="return confirm('Xóa lịch học ?');" style="background-color: white; border: solid white; color: red;">
                                            </form>
                                        <?php
                                            echo "</td>";
                                            echo "</tr>";
                                        }
                                    }
                                    echo "</table>";
                                }
                                if (isset($_REQUEST["locbuoihoc"])) {
                                    $loc = $_REQUEST["abc"];
                                    $malh = $_REQUEST["malophoc"];
                                    $tiet = $_REQUEST["tiet"];
                                    $thu = $_REQUEST["thu"];
                                    if ($loc == 'dahoc') {
                                        ?>
                                        <h1 style='text-align:center;'>CHI TIẾT LỊCH HỌC</h1>
                                        <form method="POST" action="#" id="form_button">
                                            <input type="hidden" name="malophoc" value="<?php echo $malh ?>">
                                            <input type="hidden" name="thu" value="<?php echo $thu ?>">
                                            <input type="hidden" name="tiet" value="<?php echo $tiet ?>">
                                            <input type="radio" id="chuahoc" name="abc" value="chuahoc">
                                            <label for="chuahoc">Chưa học &emsp;</label>
                                            <input type="radio" id="dahoc" checked name="abc" value="dahoc">
                                            <label for="dahoc">Đã học &emsp;</label>
                                            <input name="locbuoihoc" type="submit" value="Lọc" class="button">
                                        </form>
                                        <table style='width:1200px;  text-align: center;'>
                                            <tr style='border: 1px solid black;'>
                                                <td style='color: white; text-align:center;border: 1px solid black;  background: #015f95;'>STT</td>
                                                <td style='color: white; text-align:center;border: 1px solid black;  background: #015f95;'>Ngày học</td>
                                                <td style='color: white; text-align:center;border: 1px solid black;  background: #015f95;'>Id</td>
                                                <td style='color: white; text-align:center;border: 1px solid black;  background: #015f95;'>Password</td>
                                                <td style='color: white; text-align:center;border: 1px solid black;  background: #015f95;'>Giáo viên dạy thay</td>
                                                <td style='color: white; text-align:center;border: 1px solid black;  background: #015f95;'>Chú thích</td>
                                                <td style='color: white; text-align:center;border: 1px solid black;  background: #015f95;'>Đổi lịch học một buổi</td>
                                                <td style='color: white; text-align:center;border: 1px solid black;  background: #015f95;'>Xóa</td>
                                            </tr>
                                            <tr>
                                                <?php
                                                $table1 = $p->laylichtheongaychoQL1($malh, $tiet, $thu);
                                                if (mysqli_num_rows($table1) > 0) {
                                                    $i = 1;
                                                    while ($row1 = mysqli_fetch_assoc($table1)) {
                                                        echo "<td style='border: 1px solid black; background: white;'>";
                                                        echo $i;
                                                        $i = $i + 1;
                                                        echo "</td>";
                                                        echo "<td style='border: 1px solid black; background: #ebecd0;'>";
                                                        echo $row1["Ngay"];
                                                        echo "</td>";
                                                        echo "<td style='border: 1px solid black; background: #ebecd0;'>";
                                                        echo $row1["Id"];
                                                        echo "</td>";
                                                        echo "<td style='border: 1px solid black; background: #ebecd0;'>";
                                                        echo $row1["Pass"];
                                                        echo "</td>";
                                                        echo "<td style='border: 1px solid black; background: #ebecd0;'>";
                                                        //lấy mã gv 
                                                        include_once("controller/clophoc.php");
                                                        $plophoc = new controllophoc();
                                                        $tablelophoc = $plophoc->chon1lophoc($malh);
                                                        $rowlophoc = mysqli_fetch_assoc($tablelophoc);
                                                        if ($row1["GVTrucTiep"] == $rowlophoc["MaGV"]) {
                                                            echo "Không";
                                                        } else {
                                                            $tablegiaovien = $p->lay1lich($row1["MaLich"]);
                                                            $rowgiaovien = mysqli_fetch_assoc($tablegiaovien);
                                                            echo $rowgiaovien["TenGV"];
                                                        }
                                                        echo "</td>";
                                                        echo "<td style='border: 1px solid black; background: #ebecd0;'>";
                                                        echo $row1["GhiChu"];
                                                        echo "</td>";
                                                        echo "<td style='border: 1px solid black; background: white;'>";
                                                        echo "Sửa";
                                                        echo "</td>";
                                                        echo "<td style='border: 1px solid black; background: white;'>";
                                                        echo "Xóa";
                                                        echo "</td>";
                                                        echo "</tr>";
                                                    }
                                                }
                                                echo "</table>";
                                            } elseif ($loc == 'chuahoc') {
                                                ?>
                                                <h1 style='text-align:center;'>CHI TIẾT LỊCH HỌC</h1>
                                                <form method="POST" action="#" id="form_button">
                                                    <input type="hidden" name="malophoc" value="<?php echo $malh ?>">
                                                    <input type="hidden" name="tiet" value="<?php echo $tiet ?>">
                                                    <input type="hidden" name="thu" value="<?php echo $thu ?>">
                                                    <input type="radio" id="chuahoc" checked name="abc" value="chuahoc">
                                                    <label for="chuahoc">Chưa học &emsp;</label>
                                                    <input type="radio" id="dahoc" name="abc" value="dahoc">
                                                    <label for="dahoc">Đã học &emsp;</label>
                                                    <input name="locbuoihoc" type="submit" value="Lọc" class="button">
                                                </form>
                                                <table style='width:1200px;  text-align: center;'>
                                                    <tr style='border: 1px solid black;'>
                                                        <td style='color: white; text-align:center;border: 1px solid black;  background: #015f95;'>STT</td>
                                                        <td style='color: white; text-align:center;border: 1px solid black;  background: #015f95;'>Ngày học</td>
                                                        <td style='color: white; text-align:center;border: 1px solid black;  background: #015f95;'>Id</td>
                                                        <td style='color: white; text-align:center;border: 1px solid black;  background: #015f95;'>Password</td>
                                                        <td style='color: white; text-align:center;border: 1px solid black;  background: #015f95;'>Giáo viên dạy thay</td>
                                                        <td style='color: white; text-align:center;border: 1px solid black;  background: #015f95;'>Chú thích</td>
                                                        <td style='color: white; text-align:center;border: 1px solid black;  background: #015f95;'>Đổi lịch học một buổi</td>
                                                        <td style='color: white; text-align:center;border: 1px solid black;  background: #015f95;'>Xóa</td>
                                                    </tr>
                                                    <tr>
                                                        <?php
                                                        $table1 = $p->laylichtheongaychoQL($malh, $tiet, $thu);
                                                        if (mysqli_num_rows($table1) > 0) {
                                                            $i = 1;
                                                            while ($row1 = mysqli_fetch_assoc($table1)) {
                                                                echo "<td style='border: 1px solid black; background: white;'>";
                                                                echo $i;
                                                                $i = $i + 1;
                                                                echo "</td>";
                                                                echo "<td style='border: 1px solid black; background: #ebecd0;'>";
                                                                echo $row1["Ngay"];
                                                                echo "</td>";
                                                                echo "<td style='border: 1px solid black; background: #ebecd0;'>";
                                                                echo $row1["Id"];
                                                                echo "</td>";
                                                                echo "<td style='border: 1px solid black; background: #ebecd0;'>";
                                                                echo $row1["Pass"];
                                                                echo "</td>";
                                                                echo "<td style='border: 1px solid black; background: #ebecd0;'>";
                                                                //lấy mã gv 
                                                                include_once("controller/clophoc.php");
                                                                $plophoc = new controllophoc();
                                                                $tablelophoc = $plophoc->chon1lophoc($malh);
                                                                $rowlophoc = mysqli_fetch_assoc($tablelophoc);
                                                                if ($row1["GVTrucTiep"] == $rowlophoc["MaGV"]) {
                                                                    echo "Không";
                                                                } else {
                                                                    $tablegiaovien = $p->lay1lich($row1["MaLich"]);
                                                                    $rowgiaovien = mysqli_fetch_assoc($tablegiaovien);
                                                                    echo $rowgiaovien["TenGV"];
                                                                }
                                                                echo "</td>";
                                                                echo "<td style='border: 1px solid black; background: #ebecd0;'>";
                                                                echo $row1["GhiChu"];
                                                                echo "</td>";
                                                                echo "<td style='border: 1px solid black; background: white;'>";
                                                                echo "<a href='QL.php?updatelich3=" . $row1["MaLich"] . "&malop=" . $malh . "'>Sửa</a>";
                                                                echo "</td>";
                                                                echo "<td style='border: 1px solid black; background: white;'>";
                                                        ?>
                                                                <form method="POST" action="">
                                                                    <input type="hidden" name="MaLich" value="<?php echo $row1['MaLich']  ?>">
                                                                    <input name="xoalich" type="submit" value="Xóa" onclick="return confirm('Xóa lịch học ?');" style="background-color: white; border: solid white; color: red;">
                                                                </form>
                                                    <?php
                                                                echo "</td>";
                                                                echo "</tr>";
                                                            }
                                                        }
                                                        echo "</table>";
                                                    }
                                                }
                                                if (isset($_REQUEST['submit'])) {
                                                    $malh = $_REQUEST["malophoc"];
                                                    ?>
                                                    <h1 style='text-align:center;'>CHI TIẾT LỊCH BÙ</h1>
                                                    <table style='width:1200px;  text-align: center;'>
                                                        <tr style='border: 1px solid black;'>
                                                            <td style='color: white; text-align:center;border: 1px solid black;  background: #015f95;'>STT</td>
                                                            <td style='color: white; text-align:center;border: 1px solid black;  background: #015f95;'>Ngày học</td>
                                                            <td style='color: white; text-align:center;border: 1px solid black;  background: #015f95;'>Thứ</td>
                                                            <td style='color: white; text-align:center;border: 1px solid black;  background: #015f95;'>Tiết</td>
                                                            <td style='color: white; text-align:center;border: 1px solid black;  background: #015f95;'>Id</td>
                                                            <td style='color: white; text-align:center;border: 1px solid black;  background: #015f95;'>Password</td>
                                                            <td style='color: white; text-align:center;border: 1px solid black;  background: #015f95;'>Giáo viên dạy thay</td>
                                                            <td style='color: white; text-align:center;border: 1px solid black;  background: #015f95;'>Chú thích</td>
                                                            <td style='color: white; text-align:center;border: 1px solid black;  background: #015f95;'>Đổi lịch học một buổi</td>
                                                            <td style='color: white; text-align:center;border: 1px solid black;  background: #015f95;'>Xóa</td>
                                                        </tr>
                                                        <tr>
                                                            <?php
                                                            $table1 = $p->chonlichtheongaybuchoQL($malh);
                                                            if (mysqli_num_rows($table1) > 0) {
                                                                $i = 1;
                                                                while ($row1 = mysqli_fetch_assoc($table1)) {
                                                                    echo "<td style='border: 1px solid black; background: white;'>";
                                                                    echo $i;
                                                                    $i = $i + 1;
                                                                    echo "</td>";
                                                                    echo "<td style='border: 1px solid black; background: #ebecd0;'>";
                                                                    echo $row1["Ngay"];
                                                                    echo "</td>";
                                                                    echo "<td style='border: 1px solid black; background: #ebecd0;'>";
                                                                    echo $row1['Ten'];
                                                                    echo "</td>";
                                                                    echo "<td style='border: 1px solid black; background: #ebecd0;'>";
                                                                    echo $row1["Tiet"] . " (" . $row1["ThoiGian"] . ")";
                                                                    echo "</td>";
                                                                    echo "<td style='border: 1px solid black; background: #ebecd0;'>";
                                                                    echo $row1["Id"];
                                                                    echo "</td>";
                                                                    echo "<td style='border: 1px solid black; background: #ebecd0;'>";
                                                                    echo $row1["Pass"];
                                                                    echo "</td>";
                                                                    echo "<td style='border: 1px solid black; background: #ebecd0;'>";
                                                                    //lấy mã gv 
                                                                    include_once("controller/clophoc.php");
                                                                    $plophoc = new controllophoc();
                                                                    $tablelophoc = $plophoc->chon1lophoc($malh);
                                                                    $rowlophoc = mysqli_fetch_assoc($tablelophoc);
                                                                    if ($row1["GVTrucTiep"] == $rowlophoc["MaGV"]) {
                                                                        echo "Không";
                                                                    } else {
                                                                        $tablegiaovien = $p->lay1lich($row1["MaLich"]);
                                                                        $rowgiaovien = mysqli_fetch_assoc($tablegiaovien);
                                                                        echo $rowgiaovien["TenGV"];
                                                                    }
                                                                    echo "</td>";
                                                                    echo "<td style='border: 1px solid black; background: #ebecd0;'>";
                                                                    echo $row1["GhiChu"];
                                                                    echo "</td>";
                                                                    echo "<td style='border: 1px solid black; background: white;'>";
                                                                    // lấy ngày hiện tại
                                                                    $ngay = date('Y-m-d');
                                                                    $ngay = strtotime($ngay);
                                                                    $ngaylich = strtotime($row1["Ngay"]);
                                                                    if ($ngaylich >= $ngay) {
                                                                        echo "<a href='QL.php?updatelich3=" . $row1["MaLich"] . "&malop=" . $malh . "'>Sửa</a>";
                                                                    } else {
                                                                        echo "Sửa";
                                                                    }

                                                                    echo "</td>";
                                                                    echo "<td style='border: 1px solid black; background: white;'>";
                                                                    if ($ngaylich >= $ngay) {
                                                            ?>
                                                                        <form method="POST" action="">
                                                                            <input type="hidden" name="MaLich" value="<?php echo $row1['MaLich']  ?>">
                                                                            <input name="xoalich" type="submit" value="Xóa" onclick="return confirm('Xóa lịch học ?');" style="background-color: white; border: solid white; color: red;">
                                                                        </form>
                                                            <?php
                                                                    } else {
                                                                        echo "Xóa";
                                                                    }

                                                                    echo "</td>";
                                                                    echo "</tr>";
                                                                }
                                                            }
                                                            echo "</table>";
                                                            ?>
                                                            <form method="POST" action="QL.php?themlichbu=<?php echo $malop ?>" id="form_button">
                                                                <input type="hidden" name="malophoc" value="<?php echo $malop  ?>">
                                                                <button type="submit" name="Thêm lịch bù" class="button">Thêm lịch bù</button>
                                                            </form>
                                                        <?php
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