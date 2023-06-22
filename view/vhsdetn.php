<!DOCTYPE html>
<html lang="en">
<script src="view/js/jquery-3.6.0.js"></script>
<script src="view/js/Home.js"></script>
<?php
ob_start();
$tendn = $_SESSION["tendangnhap"];
$makt = $_SESSION["makt"];
//lay ma hoc sinh
include_once("controller/chocsinh.php");
$phocsinh = new controlhocsinh();
$tablehocsinh = $phocsinh->lay1hs($tendn);
$rowhocsinh =  mysqli_fetch_assoc($tablehocsinh);
$mahs = $rowhocsinh['MaHS'];
//lay ma bai lam
include_once("controller/cbailam.php");
$pbailam = new controlbailam();
$tablebailam = $pbailam->laybai1lam($makt, $mahs);
$rowbailam =  mysqli_fetch_assoc($tablebailam);
$mabl = $rowbailam['MaBL'];
//cập nhật câu trả lời
if (isset($_REQUEST["btnsubmitcautruoc"])) {
    $dapan = $_REQUEST["dapan"];
    $macauhoi = $_REQUEST["macauhoi"];
    $mabailam = $_REQUEST["mabailam"];
    $so = $_REQUEST["so"];
    $kq = $pbailam->chonupdatecautraloitracnghiem($mabailam, $macauhoi, $dapan);
    if ($kq == 1) {
        echo header("refresh:0; url='" . strtok($_SERVER["REQUEST_URI"], '?') . "?bailam=" . ($so - 1) . "'");
    } elseif ($kq == 0) {
        echo "<script>alert('Lỗi')</script>";
    }
}
if (isset($_REQUEST["btnsubmitcausau"])) {
    $dapan = $_REQUEST["dapan"];
    $macauhoi = $_REQUEST["macauhoi"];
    $mabailam = $_REQUEST["mabailam"];
    $so = $_REQUEST["so"];
        $kq = $pbailam->chonupdatecautraloitracnghiem($mabailam, $macauhoi, $dapan);
        if ($kq == 1) {
            echo header("refresh:0; url='" . strtok($_SERVER["REQUEST_URI"], '?') . "?bailam=" . ($so + 1) . "'");
        } elseif ($kq == 0) {
            echo "<script>alert('Lỗi')</script>";
        }
    
}
// tính điểm và nộp bài
if (isset($_REQUEST["nopbai"])) {
    $macauhoi = $_REQUEST["macauhoi"];
    $dapan = $_REQUEST["dapan"];
    $mabailam = $_REQUEST["mabailam"];
    $makt = $_REQUEST["makt"];
    $kq1 = $pbailam->chonupdatecautraloitracnghiem($mabailam, $macauhoi, $dapan);
    ?>
    <script type="text/javascript">
        setInterval(function()
        {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.open("GET", "view/response.php", false);
            xmlhttp.send(null);
            if(xmlhttp.responseText != "00:00:01"){
               alert("Thời gian làm bài chưa hết, bạn có muốn nộp bài");
            }
        }, 1000)
    </script>
    <?php
        if ($kq1 == 1) {
            echo header("refresh:0; url='HS.php?xemdethichitiet&lamxongbai");
        } else {
            echo "<script>alert('Lỗi')</script>";
        }
    
}
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đề trắc nghiệm</title>
    <link rel="stylesheet" href="view/styles/lich_day.css">
    <link rel="stylesheet" href="view/styles/bootstrap.min.css">
    <script src="view/js/bootstrap.min.js"></script>
</head>

<body>
<div class="popular page_section">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="section_title text-center">
                            <h1 style="margin-bottom: 50px;"></h1>
                        </div>
                    </div>
                </div>
    <?php

    $so = $_GET['bailam'];
    // chọn 1 bài kiểm tra
    include_once("controller/ckiemtra.php");
    $p = new controlkiemtra();
    $table = $p->layktratn($makt);
    $row = mysqli_fetch_assoc($table);
    //danh sách câu trắc nghiệm
    $table1 = $p->layktratn($makt);
    $i = 1;
    ?>
    <h1 style='text-align:center;'>Đề bài: <?php echo $row["TieuDe"] ?></h1>
    <p style='text-align:center;'>Thời gian làm bài: <?php echo $row["Time"] ?> phút</p> <br>
 
    <!-- tính thời gian -->
    <h6 style="text-align:center;">Thời gian còn lại:<div id="response" ></div></h6>
    

    <script type="text/javascript">
        setInterval(function()
        {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.open("GET", "view/response.php", false);
            xmlhttp.send(null);
            if(xmlhttp.responseText == "00:00:01"){
               window.location="HS.php?xemdethichitiet&lamxongbai";
            }
            document.getElementById("response").innerHTML = xmlhttp.responseText;
        }, 1000)
    </script>
    <a style="color: red;" href="/do_an_nhom14/file/DeThi/<?php echo  $row["FileDe"]; ?>">
                        <h5><?php echo "XEM ĐỀ TẠI ĐÂY"; ?></h5>
    </a>
    <table style='text-align:center; width: 100%'>
        <tr class="row">
        <td class="col-sm-8" style="margin-left: 190px;">
                <?php
                $j = mysqli_num_rows($table1);
                $table2 = $p->layktratn1($makt, $so - 1);
                $row2 = mysqli_fetch_assoc($table2);
                $mach = $row2["MaCHTN"];
                $table3 = $pbailam->lay1dapan($mabl, $mach);
                $row3 = mysqli_fetch_assoc($table3);
                $da = $row3["CauTL"];
                echo "Câu " . $so . ": ";
                echo "&nbsp;";
                echo "(" . $row2["SoDiem"] . " điểm)<br><br>";
                ?>
                <form action="#" method="POST">
                    <input type="radio" id="CauA" name="dapan" value="A" <?php if ($da == "A") {
                                                                                                        echo "checked";
                                                                                                    } ?>> A
                    &nbsp;
                    <input type="radio" id="CauB" name="dapan" value="B" <?php if ($da == "B") {
                                                                                                        echo "checked";
                                                                                                    } ?>> B
                    &nbsp;
                    <input type="radio" id="CauC" name="dapan" value="C" <?php if ($da == "C") {
                                                                                                        echo "checked";
                                                                                                    } ?>> C
                    &nbsp;
                    <input type="radio" id="CauD" name="dapan" value="D" <?php if ($da == "DS") {
                                                                                                        echo "checked";
                                                                                                    } ?>> D
                    <br><br>
                    <input type="hidden" name="macauhoi" value="<?php echo $row2["MaCHTN"]; ?>">
                    <input type="hidden" name="mabailam" value="<?php echo $mabl; ?>">
                    <input type="hidden" name="makt" value="<?php echo $makt; ?>">
                    <input type="hidden" name="so" value="<?php echo $so; ?>">
                    <?php
                    echo "<div id='form_button' class='col-sm-8'>";
                    if ($so != 1) {
                        echo "
                        <button class='button'  name='btnsubmitcautruoc' class='button'> Câu trước
                        </button>";
                    }
                    if ($so < $j) {
                        echo "
                        <button class='button'  name='btnsubmitcausau' class='button'> Câu sau
                        </button>
                        </div>";
                    }
                    if ($so == $j) {
                        echo "<div id='form_button' class='col-sm-8' style='margin-left:150px;' >
                        <button class='button'  name='nopbai' class='button'> Nộp bài
                        </button>
                        </div>";
                    }
                    ?>
                </form>
            </td>
            <td class="col-sm-2">
                <table border="1">
                    <?php
                    
                    $t = 1;
                    echo "<tr>";
                    while ($row1 = mysqli_fetch_assoc($table1)) {
                    ?>
                        <td >
                            <?php echo "<a href='" . strtok($_SERVER["REQUEST_URI"], '?') . "?bailam=" . $i . "' >Câu " . $i . " </a>";
                            $i = $i + 1;
                            $t = $t + 1; ?>
                        </td>
                    <?php
                        if ($t == 4) {
                            echo "</tr>";
                            $t = 0;
                            echo "<tr>";
                        }
                    }
                    ?>
                </table>
            </td>
        </tr>
    </table>

    <br>
            </div></div>
</body>

</html>