
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
            $malop = $_REQUEST["xbh"];
            include_once("controller/cbaihoc.php");
            $p = new controlbaihoc();
            //hiển thị tên lophoc
            include_once("controller/clophoc.php");
            $plophoc = new controllophoc();
            $table = $plophoc->chon1lophoc($malop);
            $row = mysqli_fetch_assoc($table);
            $tieude = $row['TenLop'];
            echo "<H1 style='text-align: center;'>$tieude</H1>";
            //day dia chi
            echo "<a href='GV.php?dslop'>Trang chủ</a> / ";
            echo "<a href='GV.php?xbh=" . $malop . "'>$tieude</a> ";
            echo "<br><br><br>";
            if (isset($_REQUEST["xoathongbao"])) {
                $mabh = $_REQUEST["xoathongbao"];
                $kq2 = $p->xoabaihoc($mabh);
                echo header("refresh:0; url='GV.php?xbh=" . $malop . "&thongbao'");
            }
            if (isset($_REQUEST["xoatailieu"])) {
                $mabh = $_REQUEST["xoatailieu"];
                $kq2 = $p->xoabaihoc($mabh);
                echo header("refresh:0; url='GV.php?xbh=" . $malop . "&tailieu'");
            }
            if (isset($_REQUEST["xoabaitap"])) {
                $mabh = $_REQUEST["xoabaitap"];
                $kq2 = $p->xoabaihoc($mabh);
                echo header("refresh:0; url='GV.php?xbh=" . $malop . "&baitap'");
            }
            if (isset($_REQUEST["xoakiemtra"])) {
                $makt = $_REQUEST["xoakiemtra"];
                include_once("controller/ckiemtra.php");
                $pkiemtra = new controlkiemtra;
                $kq2 = $pkiemtra->xoabaiktct($makt, $malop);
                echo header("refresh:0; url='GV.php?xbh=" . $malop . "&kiemtra'");
            }
            ?>
            <br>
            <form method="POST" action="" enctype="multipart/form-data" id="form_button">
                <button type="submit" name="chitiet" class="button" style="width: 200px;">
                    DANH SÁCH HỌC SINH</button>
            </form>
            <?php
            if (isset($_REQUEST["chitiet"])) {
                include_once("controller/chocsinh.php");
                $p = new controlhocsinh();
                $table = $p->layctdshs($malop);
                if ($table) {
                    if (mysqli_num_rows($table) > 0) {
                        echo "<h1 style='text-align:center;'>DANH SÁCH HỌC SINH</h1>";
                        echo "<table style='width: 100%;  text-align: center;' >";
                        echo "<tr style='border: 1px solid black;'>";
                        echo "<td style='color: white; text-align:center;border: 1px solid black;  background: #015f95;'>STT</td>";
                        echo "<td style='color: white; text-align:center;border: 1px solid black;  background: #015f95;'>Tên học sinh</td>";
                        echo "<td style='color: white; text-align:center;border: 1px solid black;  background: #015f95;'>Ngày sinh</td>";
                        echo "<td style='color: white; text-align:center;border: 1px solid black;  background: #015f95;'>Địa chỉ</td>";
                        echo "<td style='color: white; text-align:center;border: 1px solid black;  background: #015f95;'>Giới tính</td>";
                        echo "</tr>";
                        $i = 1;
                        while ($row = mysqli_fetch_assoc($table)) {
                            echo "<tr>";
                            echo "<td style='border: 1px solid black; background: white;'>";
                            echo $i;
                            $i = $i + 1;
                            echo "</td>";
                            echo "<td style='border: 1px solid black; background: #ebecd0;'>";
                            echo $row["TenHS"];
                            echo "</td>";
                            echo "<td style='border: 1px solid black; background: #ebecd0;'>";
                            echo $row["NgaySinh"];
                            echo "</td>";
                            echo "<td style='border: 1px solid black; background: #ebecd0;'>";
                            echo $row["DiaChi"];
                            echo "</td>";
                            echo "<td style='border: 1px solid black; background: #ebecd0;'>";
                            echo $row["GioiTinh"];
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
                <form method="POST" action="GV.php?xbh=<?php echo $malop ?>" enctype="multipart/form-data">
                    <br><button type="submit" name="" class="btn">
                        Thoát</button>
                </form>
                <?php

            } else {

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
                                if (isset($_REQUEST["huythongbao"])) {
                                    echo header("refresh:0; url='GV.php?xbh=" . $malop . "'");
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
                            if (isset($_REQUEST["suathongbao"]) and $_REQUEST["suathongbao"] == $row1["MaBH"]) {
                                ?>
                                <form method="POST" action="">
                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <input type="text" required placeholder="Nhập tiêu đề" class="form-control " id="tieude"
                                                name="tieude" value="<?php echo $row1["TieuDe"] ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <input type="text" placeholder="Nhập ghi chú" class="form-control " id="ghichu"
                                                name="ghichu" value="<?php echo $row1["GhiChu"] ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row mt-5">
                                        <div class="col-md-8">
                                            <button type="submit" name="btnSuaThongbao" class=" btn-primary mb-2 ">Sửa</button>
                                        </div>
                                    </div>
                                </form>
                                <?php
                            } else {
                                ?>
                                <h5 style="color: #FF9966; margin-right: 130px;">
                                    <?php echo $row1["TieuDe"]; ?>
                                </h5>
                                <a href="GV.php?xbh=<?php echo $malop; ?>&thongbao&suathongbao=<?php echo $row1["MaBH"] ?>">Sửa</a>
                                / <a href='GV.php?xbh=<?php echo $malop; ?>&thongbao&xoathongbao=<?php echo $row1["MaBH"] ?>'
                                    style='margin-right: 130px;'>Xóa</a>
                                <div
                                    style="background-color: #DDDDDD; width: 90%; padding: 2px; border-radius: 5px;margin: auto; margin-right: 130px;">
                                    <p style="margin: auto;">
                                        <?php echo $row1["GhiChu"]; ?>
                                    </p>
                                </div>
                                <?php
                            }
                            echo "</td>";
                            echo "</tr>";
                        }
                        echo "<tr>";
                        echo "<td></td>";
                        echo "<td>";
                        if (isset($_REQUEST["themthongbao"])) {
                            ?>
                            <form method="POST" action="">
                                <div class="form-group row">
                                    <div class="col-md-8">
                                        <input type="text" required placeholder="Nhập tiêu đề" class="form-control " id="tieude"
                                            name="tieude" value="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-8">
                                        <input type="text" placeholder="Nhập ghi chú" class="form-control " id="ghichu"
                                            name="ghichu" value="">
                                    </div>
                                </div>
                                <div class="form-group row mt-5">
                                    <div class="col-md-12">
                                        <button type="submit" name="btnThongbao" class="btn-primary mb-2">Thêm thông
                                            báo</button>
                                    </div>
                                </div>
                            </form>
                            <?php
                        } else {
                            echo "<form method='POST' action = 'GV.php?xbh=" . $malop . "&thongbao'>";
                            echo "<button name='themthongbao' class='btn-default btn-circle'>&#43;</button>";
                            echo "</form>";
                        }
                        if (isset($_REQUEST["btnThongbao"])) {
                            $tieude = $_REQUEST["tieude"];
                            $ghichu = $_REQUEST["ghichu"];
                            $kq = $p->chonthemthongbao($tieude, $ghichu, $malop);
                            if ($kq == 1) {
                                echo header("refresh:0; url='GV.php?xbh=" . $malop . "&thongbao'");
                            } elseif ($kq == 0) {
                                echo "<script>alert('Không thể insert lỗi 1')</script>";
                            }
                        }
                        if (isset($_REQUEST["btnSuaThongbao"])) {
                            $tieude = $_REQUEST["tieude"];
                            $ghichu = $_REQUEST["ghichu"];
                            $mabh = $_REQUEST["suathongbao"];
                            $kq = $p->chonupdatethongbao($tieude, $ghichu, $mabh);
                            if ($kq == 1) {
                                echo header("refresh:0; url='GV.php?xbh=" . $malop . "&thongbao'");
                            } elseif ($kq == 0) {
                                echo "<script>alert('Không thể insert lỗi 1')</script>";
                            }
                        }
                        echo "</td>";
                        echo "</tr>";
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
                                    echo "<button name='tailieu' class='' style='background-color: white; border: solid white; color: blue;'>&#8744;</button>";
                                }
                                if (isset($_REQUEST["huytailieuhoctap"])) {
                                    echo header("refresh:0; url='GV.php?xbh=" . $malop . "'");
                                }
                                ?>
                            </form>
                        </td>
                        <td>
                            <H3 style="color: #FF9900; margin-right: 130px;">TÀI LIỆU HỌC TẬP</H3>
                        </td>

                    </tr>
                    <?php
                    if (isset($_REQUEST["tailieu"])) {
                        while ($row1 = mysqli_fetch_assoc($table)) {
                            echo "<tr>";
                            echo "<td></td>";
                            echo "<td>";
                            if (isset($_REQUEST["suatailieu"]) and $_REQUEST["suatailieu"] == $row1["MaBH"]) {
                                ?>
                                <form method="POST" action="" enctype="multipart/form-data">
                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <input type="text" required placeholder="Nhập tiêu đề" class="form-control " id="tieude"
                                                name="tieude" value="<?php echo $row1["TieuDe"] ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <input type="file" placeholder="" class="form-control " id="uploadfile" name="uploadfile"
                                                value=""
                                                accept=".doc,.docx,.xml,.pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <input type="text" placeholder="Nhập ghi chú" class="form-control " id="ghichu"
                                                name="ghichu" value="<?php echo $row1["GhiChu"] ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row mt-5">
                                        <div class="col-md-8">
                                            <button type="submit" name="btnSuaTailieu" class=" btn-primary mb-2 ">Sửa</button>
                                        </div>
                                    </div>
                                </form>
                                <?php
                            } else {
                                ?>
                                <a style="color: #FF9966;" href="/do_an_nhom14/file/BT/<?php echo $row1["File"]; ?>">
                                    <h5 style="margin-right: 130px;">
                                        <?php echo $row1["TieuDe"]; ?>
                                    </h5>
                                </a>
                                <a href="GV.php?xbh=<?php echo $malop; ?>&tailieu&suatailieu=<?php echo $row1["MaBH"] ?>">Sửa</a>
                                / <a href='GV.php?xbh=<?php echo $malop; ?>&tailieu&xoatailieu=<?php echo $row1["MaBH"] ?>'
                                    style='margin-right: 130px;'>Xóa</a>
                                <?php if ($row1["GhiChu"] != null) { ?>
                                    <div
                                        style="background-color: #DDDDDD; width: 90%; padding: 2px; border-radius: 5px; margin-right: 130px;">
                                        <p style="margin: auto;">
                                            <?php echo $row1["GhiChu"]; ?>
                                        </p>
                                    </div>
                                <?php }
                            }
                            echo "</td>";
                            echo "</tr>";
                        }
                        echo "<tr>";
                        echo "<td></td>";
                        echo "<td>";
                        if (isset($_REQUEST["themtailieu"])) {
                            ?>
                            <form method="POST" action="" enctype="multipart/form-data">
                                <div class="form-group row">
                                    <div class="col-md-8">
                                        <input type="text" required placeholder="Nhập tiêu đề" class="form-control " id="tieude"
                                            name="tieude" value="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-8">
                                        <input type="file" required placeholder="" class="form-control " id="uploadfile"
                                            name="uploadfile" value=""
                                            accept=".doc,.docx,.xml,.pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-8">
                                        <input type="text" placeholder="Nhập ghi chú" class="form-control " id="ghichu"
                                            name="ghichu" value="">
                                    </div>
                                </div>
                                <div class="form-group row mt-5">
                                    <div class="col-md-12">
                                        <button type="submit" name="btntailieu" class=" btn-primary mb-2 ">Thêm tài
                                            liệu</button>
                                    </div>
                                </div>
                            </form>
                            <?php
                        } else {
                            echo "<form method='POST' action = 'GV.php?xbh=" . $malop . "&tailieu'>";
                            echo "<button name='themtailieu' class='btn-default btn-circle'>&#43;</button>";
                            echo "</form>";
                        }
                        echo "</td>";
                        echo "</tr>";
                        if (isset($_REQUEST["btntailieu"])) {
                            $file = $_FILES["uploadfile"]["tmp_name"];
                            $tenfile = $_FILES["uploadfile"]["name"];
                            $tieude = $_REQUEST["tieude"];
                            $ghichu = $_REQUEST["ghichu"];
                            $kq = $p->chonthemtailieu($tieude, $ghichu, $malop, $tenfile, $file);
                            if ($kq == 1) {
                                echo header("refresh:0; url='GV.php?xbh=" . $malop . "&tailieu'");
                            } elseif ($kq == 0) {
                                echo "<script>alert('Không thể insert lỗi 1')</script>";
                            } elseif ($kq == 2) {
                                echo "<script>alert('Không thể upload file')</script>";
                            }
                        }
                        if (isset($_REQUEST["btnSuaTailieu"])) {
                            $tieude = $_REQUEST["tieude"];
                            $ghichu = $_REQUEST["ghichu"];
                            $mabh = $_REQUEST["suatailieu"];
                            if ($_FILES['uploadfile']["tmp_name"] != null) {
                                $file = $_FILES["uploadfile"]["tmp_name"];
                                $tenfile = $_FILES["uploadfile"]["name"];
                                $kq = $p->chonupdatetailieuCofile($tieude, $ghichu, $mabh, $tenfile, $file);
                                if ($kq == 1) {
                                    echo header("refresh:0; url='GV.php?xbh=" . $malop . "&tailieu'");
                                } elseif ($kq == 0) {
                                    echo "<script>alert('Không thể insert lỗi 1')</script>";
                                } elseif ($kq == 2) {
                                    echo "<script>alert('Không thể upload file')</script>";
                                }
                            } else {
                                $kq = $p->chonupdatetailieuKfile($tieude, $ghichu, $mabh);
                                if ($kq == 1) {
                                    echo header("refresh:0; url='GV.php?xbh=" . $malop . "&tailieu'");
                                } elseif ($kq == 0) {
                                    echo "<script>alert('Không thể insert lỗi 1')</script>";
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
                                if (isset($_REQUEST["huytaibaitap"])) {
                                    echo header("refresh:0; url='GV.php?xbh=" . $malop . "'");
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
                        while ($row1 = mysqli_fetch_assoc($table)) {
                            echo "<tr>";
                            echo "<td></td>";
                            echo "<td>";
                            if (isset($_REQUEST["suabaitap"]) and $_REQUEST["suabaitap"] == $row1["MaBH"]) {
                                ?>
                                <form method="POST" action="" enctype="multipart/form-data">
                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <input type="text" required placeholder="Nhập tiêu đề" class="form-control " id="tieude"
                                                name="tieude" value="<?php echo $row1["TieuDe"] ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <input type="file" placeholder="" class="form-control " id="uploadfile" name="uploadfile"
                                                value=""
                                                accept=".doc,.docx,.xml,.pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <input type="text" placeholder="Nhập ghi chú" class="form-control " id="ghichu"
                                                name="ghichu" value="<?php echo $row1["GhiChu"] ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row mt-5">
                                        <div class="col-md-8">
                                            <button type="submit" name="btnSuabaitap" class=" btn-primary mb-2 ">Sửa</button>
                                        </div>
                                    </div>
                                </form>
                                <?php
                            } else {
                                ?>
                                <a style="color: #FF9966;" href="/do_an_nhom14/file/BT/<?php echo $row1["File"]; ?>">
                                    <h5 style="margin-right: 130px;">
                                        <?php echo $row1["TieuDe"]; ?>
                                    </h5>
                                </a>
                                <a href="GV.php?xbh=<?php echo $malop; ?>&baitap&suabaitap=<?php echo $row1["MaBH"] ?>">Sửa</a>
                                / <a href='GV.php?xbh=<?php echo $malop; ?>&baitap&xoabaitap=<?php echo $row1["MaBH"] ?>'
                                    style='margin-right: 130px;'>Xóa</a>
                                <?php if ($row1["GhiChu"] != null) { ?>
                                    <div
                                        style="background-color: #DDDDDD; width: 90%; padding: 2px; border-radius: 5px;margin-right: 130px;">
                                        <p style="margin: auto;">
                                            <?php echo $row1["GhiChu"]; ?>
                                        </p>
                                    </div>
                                <?php }
                            }
                            echo "</td>";
                            echo "</tr>";
                        }
                        echo "<tr>";
                        echo "<td></td>";
                        echo "<td>";
                        if (isset($_REQUEST["thembaitap"])) {
                            ?>
                            <form method="POST" action="" enctype="multipart/form-data">
                                <div class="form-group row">
                                    <div class="col-md-8">
                                        <input type="text" required placeholder="Nhập tiêu đề" class="form-control " id="tieude"
                                            name="tieude" value="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-8">
                                        <input type="file" required placeholder="" class="form-control " id="uploadfile"
                                            name="uploadfile" value=""
                                            accept=".doc,.docx,.xml,.pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-8">
                                        <input type="text" placeholder="Nhập ghi chú" class="form-control " id="ghichu"
                                            name="ghichu" value="">
                                    </div>
                                </div>
                                <div class="form-group row mt-5">
                                    <div class="col-md-12">
                                        <button type="submit" name="btnbaitap" class=" btn-primary mb-2 ">Thêm bài tập</button>
                                    </div>
                                </div>
                            </form>
                            <?php
                        } else {
                            echo "<form method='POST' action = 'GV.php?xbh=" . $malop . "&baitap'>";
                            echo "<button name='thembaitap' class='btn-default btn-circle'>&#43;</button>";
                            echo "</form>";
                        }
                        echo "</td>";
                        echo "</tr>";
                        if (isset($_REQUEST["btnbaitap"])) {
                            $file = $_FILES["uploadfile"]["tmp_name"];
                            $tenfile = $_FILES["uploadfile"]["name"];
                            $tieude = $_REQUEST["tieude"];
                            $ghichu = $_REQUEST["ghichu"];
                            $kq = $p->chonthembaitap($tieude, $ghichu, $malop, $tenfile, $file);
                            if ($kq == 1) {
                                echo header("refresh:0; url='GV.php?xbh=" . $malop . "&baitap'");
                            } elseif ($kq == 0) {
                                echo "<script>alert('Không thể insert lỗi 1')</script>";
                            } elseif ($kq == 2) {
                                echo "<script>alert('Không thể upload file')</script>";
                            }
                        }
                        if (isset($_REQUEST["btnSuabaitap"])) {
                            $tieude = $_REQUEST["tieude"];
                            $ghichu = $_REQUEST["ghichu"];
                            $mabh = $_REQUEST["suabaitap"];
                            if ($_FILES['uploadfile']["tmp_name"] != null) {
                                $file = $_FILES["uploadfile"]["tmp_name"];
                                $tenfile = $_FILES["uploadfile"]["name"];
                                $kq = $p->chonupdatetailieuCofile($tieude, $ghichu, $mabh, $tenfile, $file);
                                if ($kq == 1) {
                                    echo header("refresh:0; url='GV.php?xbh=" . $malop . "&baitap'");
                                } elseif ($kq == 0) {
                                    echo "<script>alert('Không thể insert lỗi 1')</script>";
                                } elseif ($kq == 2) {
                                    echo "<script>alert('Không thể upload file')</script>";
                                }
                            } else {
                                $kq = $p->chonupdatetailieuKfile($tieude, $ghichu, $mabh);
                                if ($kq == 1) {
                                    echo header("refresh:0; url='GV.php?xbh=" . $malop . "&baitap'");
                                } elseif ($kq == 0) {
                                    echo "<script>alert('Không thể insert lỗi 1')</script>";
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
                                if (isset($_REQUEST["huytailieuhoctap"])) {
                                    echo header("refresh:0; url='GV.php?xbh=" . $malop . "'");
                                }
                                ?>
                            </form>
                        </td>
                        <td>
                            <H3 style="color: #FF9900; margin-right: 130px;">ĐỀ KIỂM TRA</H3>
                        </td>

                    </tr>
                    <?php
                    if (isset($_REQUEST["kiemtra"])) {
                        while ($rowtra = mysqli_fetch_assoc($tablektra)) {
                            echo "<tr>";
                            echo "<td></td>";
                            echo "<td   style='color: #FF9966;'>";
                            echo "<a  style='color: #FF9966;' href='GV.php?xemdethichitiet=" . $rowtra["MaKT"] . "&malop=" . $malop . "'>" . $rowtra["TieuDe"] . "</a><br>";
                            include_once("controller/cbailam.php");
                            $pbailam = new controlbailam();
                            $tablebailam = $pbailam->laybailam($rowtra["MaKT"]);
                            $sodong = mysqli_num_rows($tablebailam);
                            if ($sodong == 0) {
                                ?>
                                <a href="GV.php?updatekiemtra=<?php echo $rowtra["MaKT"] ?>&malop=<?php echo $malop; ?>">Sửa</a>
                                / <a href='GV.php?xbh=<?php echo $malop; ?>&kiemtra&xoakiemtra=<?php echo $rowtra["MaKT"]; ?>'
                                    style='margin-right: 70px;'>Xóa</a>

                                <?php
                            } else {
                                echo "<h6 style='margin-right: 70px;'>Sửa/Xóa</h6>";
                            }

                            echo "</td>";
                            echo "<td></td>";
                            echo "</tr>";
                        }
                        echo "<tr>";
                        echo "<td></td>";
                        echo "<td>";
                        echo "<form method='POST' action = 'GV.php?vdsktraChthem=" . $malop . "'>";
                        echo "<button name='thembaitap' class='btn-default btn-circle' style='margin-right: 70px;'>&#43;</button>";
                        echo "</form>";
                        echo "</td>";
                        echo "</tr>";


                    }
                    ?>
                </table>
                <?php
            }
            ?>

        </div>
    </div>

</body>

</html>