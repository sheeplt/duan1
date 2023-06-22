<?php
ob_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết môn học</title>
    <link rel="stylesheet" href="view/styles/lich_day.css">
    <link rel="stylesheet" href="view/styles/form.css">
    <link rel="stylesheet" href="view/styles/bootstrap.min.css">
    <script src="view/js/bootstrap.min.js"></script>
</head>
<style type="text/css">
    .btn-circle {
        width: 30px;
        height: 30px;
        text-align: center;
        padding: 6px 0;
        font-size: 12px;
        line-height: 1.428571429;
        border-radius: 15px;
        margin-right: 130px;
    }

    .table {
        width: 100%;
        text-align: center;
    }

    .muiten {
        text-align: left;
    }
</style>

<body>
    <div class="popular page_section">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="section_title text-center">
                        <h1></h1>
                    </div>
                </div>
            </div>
            <?php
            $tendn = $_SESSION["tendangnhap"];
            $malop = $_REQUEST["xembaihoc"];
            $_SESSION["malop"] = $malop;

            include_once("controller/cbaihoc.php");
            $p = new controlbaihoc();
            //hiển thị tên lophoc
            include_once("controller/clophoc.php");
            $plophoc = new controllophoc();
            $table = $plophoc->chon1lophoc($malop);
            $row = mysqli_fetch_assoc($table);
            $tieude = $row['TenLop'];
            echo "<H1 style='text-align: center; margin-top: 20px;'>$tieude</H1>";
            //day dia chi
            echo "<a href='HS.php?trangchu'>Trang chủ</a> / ";
            echo "<a href='HS.php?xembaihoc=" . $malop . "'>$tieude</a> ";
            echo "<br><br><br>";
            if (isset($_REQUEST["xoabaihoc"])) {
                $mabh = $_REQUEST["MABH"];
                $kq2 = $p->xoabaihoc($mabh);
            }

            ?>

            <?php

            $table = $p->chonbaihocThongbao($malop);
            ?>
            <table class="table">
                <tr>
                    <td class="muiten">
                        <form method="POST" action="">
                            <?php
                            if (isset($_REQUEST["thongbao"])) {
                                echo "<button name='huythongbao' class='' style='background-color: white; border: solid white; color: blue;'>&#8743;</button>";
                            } else {
                                echo "<button name='thongbao' class='' style='background-color: white; border: solid white; color: blue;'>&#8744;</button>";
                            }
                            ?>
                        </form>
                    </td>
                    <td>
                        <H3 style="color: #FF9900; margin-right: 130px;">THÔNG BÁO</H3>
                    </td>
                </tr>
                <?php
                if (isset($_REQUEST["thongbao"])) {
                    while ($row1 = mysqli_fetch_assoc($table)) {
                        echo "<tr>";
                        echo "<td></td>";
                        echo "<td>";
                        ?>
                        <h5 style="color: #FF9966; margin-right: 130px;">
                            <?php echo $row1["TieuDe"]; ?>
                        </h5>
                        <div
                            style="background-color: #DDDDDD; width: 90%; padding: 2px; border-radius: 5px; margin-right: 130px;">
                            <p style="margin: auto;">
                                <?php echo $row1["GhiChu"]; ?>
                            </p>
                        </div>
                        <?php
                        echo "</td>";
                        echo "</tr>";
                    }
                }
                ?>
            </table>
            <?php
            $table = $p->chonbaihocTailieu($malop);
            ?>
            <table class="table">
                <tr>
                    <td class="muiten">
                        <form method="POST" action="">
                            <?php
                            if (isset($_REQUEST["tailieuhoctap"])) {
                                echo "<button name='huytailieuhoctap' class='' style='background-color: white; border: solid white; color: blue;'>&#8743;</button>";
                            } else {
                                echo "<button name='tailieuhoctap' class='' style='background-color: white; border: solid white; color: blue;'>&#8744;</button>";
                            }
                            ?>
                        </form>
                    </td>
                    <td>
                        <H3 style="color: #FF9900; margin-right: 130px;">TÀI LIỆU HỌC TẬP</H3>
                    </td>
                </tr>
                <?php
                if (isset($_REQUEST["tailieuhoctap"])) {
                    if ($table) {
                        if (mysqli_num_rows($table) > 0) {
                            while ($row1 = mysqli_fetch_assoc($table)) {
                                echo "<tr>";
                                echo "<td></td>";
                                echo "<td>";
                                ?>
                                <a style="color: #FF9966; text-decoration: none;"
                                    href="/truongcap1/file/BT/<?php echo $row1["File"]; ?>">
                                    <h5 style="margin-right: 130px;">
                                        <?php echo $row1["TieuDe"]; ?>
                                    </h5>
                                </a>
                                <?php if ($row1["GhiChu"] != null) { ?>
                                    <div
                                        style="background-color: #DDDDDD; width: 90%; padding: 2px; border-radius: 5px; margin-right: 130px;">
                                        <p style="margin: auto;">
                                            <?php echo $row1["GhiChu"]; ?>
                                        </p>
                                    </div>
                                <?php } ?>
                                <?php
                                echo "</td>";
                                echo "</tr>";
                            }
                        }
                    }
                }
                ?>
            </table>
            <?php

            $table = $p->chonbaihocBaitap($malop);
            ?>
            <table class="table">
                <tr>
                    <td class="muiten">
                        <form method="POST" action="">
                            <?php
                            if (isset($_REQUEST["baitap"])) {
                                echo "<button name='huytaibaitap' class='' style='background-color: white; border: solid white; color: blue;'>&#8743;</button>";
                            } else {
                                echo "<button name='baitap' class='' style='background-color: white; border: solid white; color: blue;'>&#8744;</button>";
                            }
                            ?>
                        </form>
                    </td>
                    <td>
                        <H3 style="color: #FF9900; margin-right: 130px;">BÀI TẬP</H3>
                    </td>
                </tr>
                <?php
                if (isset($_REQUEST["baitap"])) {
                    if ($table) {
                        if (mysqli_num_rows($table) > 0) {
                            while ($row1 = mysqli_fetch_assoc($table)) {
                                echo "<tr>";
                                echo "<td></td>";
                                echo "<td>";
                                ?>
                                <a style="color: #FF9966; text-decoration: none;"
                                    href="/truongcap1/file/BT/<?php echo $row1["File"]; ?>">
                                    <h5 style="margin-right: 130px;">
                                        <?php echo $row1["TieuDe"]; ?>
                                    </h5>
                                </a>
                                <?php if ($row1["GhiChu"] != null) { ?>
                                    <div
                                        style="background-color: #DDDDDD; width: 90%; padding: 2px; border-radius: 5px; margin-right: 130px;">
                                        <p style="margin: auto;">
                                            <?php echo $row1["GhiChu"]; ?>
                                        </p>
                                    </div>
                                <?php } ?>
                                <?php
                                echo "</td>";
                                echo "</tr>";
                            }
                        }
                    }
                }
                ?>
            </table>
            <?php

            include_once("controller/ckiemtra.php");
            $pktra = new controlkiemtra();
            $tablektra = $pktra->layktra($malop);
            ?>
            <table class="table">
                <tr>
                    <td class="muiten">
                        <form method="POST" action="">
                            <?php
                            if (isset($_REQUEST["kiemtra"])) {
                                echo "<button name='huykiemtra' class='' style='background-color: white; border: solid white; color: blue;'>&#8743;</button>";
                            } else {
                                echo "<button name='kiemtra' class='' style='background-color: white; border: solid white; color: blue;'>&#8744;</button>";
                            }
                            ?>
                        </form>
                    </td>
                    <td>
                        <H3 style="color: #FF9900; margin-right: 130px;"> ĐỀ KIỂM TRA</H3>
                    </td>
                </tr>
                <?php
                if (isset($_REQUEST["kiemtra"])) {
                    if ($tablektra) {
                        if (mysqli_num_rows($tablektra) > 0) {
                            while ($rowtra = mysqli_fetch_assoc($tablektra)) {
                                echo "<tr>";
                                echo "<td></td>";
                                echo "<td>";
                                echo "<a  style='color: #FF9966; text-decoration: none; margin-right: 120px;' href='HS.php?xemdethichitiet=" . $rowtra["MaKT"] . "'>" . $rowtra["TieuDe"] . "</a><br>";
                                echo "</td>";
                                echo "</tr>";
                            }
                        }
                    }
                }
                ?>
            </table>
            <?php
            ?>
        </div>
    </div>
</body>

</html>