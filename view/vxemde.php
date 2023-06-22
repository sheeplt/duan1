<!DOCTYPE html>
<html lang="en">
<script src="./js/jquery-3.6.0.js"></script>
<script src="./js/Home.js"></script>
<?php
ob_start();

$malop = $_GET['malop'];
$tendn = $_SESSION["tendangnhap"];
$makt = $_REQUEST['xdetn'];

if (isset($_REQUEST["btnsubmitcautruoc"])) {
    $so = $_REQUEST["so"];
    echo header("refresh:0; url='" . strtok($_SERVER["REQUEST_URI"], '?') . "?xdetn=" . $makt . "&q=" . ($so - 1) . "&malop=" . $malop . "'");

}
if (isset($_REQUEST["btnsubmitcausau"])) {
    $so = $_REQUEST["so"];
    echo header("refresh:0; url='" . strtok($_SERVER["REQUEST_URI"], '?') . "?xdetn=" . $makt . "&q=" . ($so + 1) . "&malop=" . $malop . "'");

}
if (isset($_REQUEST["nopbai"])) {
    echo header("refresh:0; url='GV.php?xemdethichitiet=" . $makt . "&malop=" . $malop . "'");
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
    <?php

    $so = $_GET['q'];
    // chọn 1 bài kiểm tra
    include_once("controller/ckiemtra.php");
    $p = new controlkiemtra();
    $table = $p->lay1ktra($makt, $malop);
    $row = mysqli_fetch_assoc($table);
    //danh sách câu trắc nghiệm
    $table1 = $p->layktratn($makt);
    $i = 1;
    ?>
    <div class="popular page_section">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="section_title text-center">
                        <h1>Đề bài:
                            <?php echo $row["TieuDe"] ?>
                        </h1>
                    </div>
                </div>
            </div>
            <p style='text-align:center;'>Thời gian làm bài:
                <?php echo $row["Time"] ?> phút
            </p> <br><br><br>

            <a style="color: #FF9966; margin: auto;" href="/do_an_nhom14/file/DeThi/<?php echo $row["FileDe"]; ?>">
                <h5>
                    <?php echo "Xem đề"; ?>
                </h5>
            </a>
            <table style='text-align:center; width: 1000px;'>
                <tr style='text-align:center;' class="row">
                    <td class="col-sm-6">
                        <table style='margin-left: 180px;' border="2">
                            <?php
                            $j = mysqli_num_rows($table1);
                            $t = 1;
                            echo "<tr>";
                            while ($row1 = mysqli_fetch_assoc($table1)) {
                                ?>
                                <td style='margin-left: 180px;'>
                                    <?php echo "<a href='" . strtok($_SERVER["REQUEST_URI"], '?') . "?xdetn=" . $makt . "&q=" . $i . "&malop=" . $malop . "'>Câu " . $i . " </a>";
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
                    <td class="col-sm-6">
                        <?php
                        $table2 = $p->layktratn1($makt, $so - 1);
                        $row2 = mysqli_fetch_assoc($table2);
                        $mach = $row2["MaCHTN"];
                        echo "Câu " . $so . ": ";
                        echo "&nbsp;";
                        echo "(" . $row2["SoDiem"] . " điểm)<br><br>";
                        ?>
                        <form action="#" method="POST">
                            <input type="radio" id="CauA" name="dapan" value="A"> A
                            &nbsp;
                            <input type="radio" id="CauB" name="dapan" value="B"> B
                            &nbsp;
                            <input type="radio" id="CauC" name="dapan" value="C"> C
                            &nbsp;
                            <input type="radio" id="CauD" name="dapan" value="D"> D
                            &nbsp;<br>
                            <input type="hidden" name="makt" value="<?php echo $makt; ?>">
                            <input type="hidden" name="so" value="<?php echo $so; ?>">
                            <?php
                            if ($so != 1) {
                                echo "<div id='form_button' class='col-sm-8'>
                        <button class='button'  name='btnsubmitcautruoc' class='button'> Câu trước
                        </button>
                        </div>";
                            }
                            if ($so < $j) {
                                echo "<div id='form_button' class='col-sm-8'>
                        <button class='button'  name='btnsubmitcausau' class='button'> Câu sau
                        </button>
                        </div>";
                            }
                            if ($so == $j) {
                                echo "<div id='form_button' class='col-sm-8'>
                        <button class='button'  name='nopbai' class='button'> Trở về
                        </button>
                        </div>";
                            }
                            ?>
                        </form>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</body>

</html>