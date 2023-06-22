<!doctype html>
<html>
<?php
ob_start();
include_once("controller/ckiemtra.php");
$p = new controlkiemtra();
$tendn = $_SESSION["tendangnhap"];
include_once("controller/cgiaovien.php");
$giavien = new controlgiaovien();
$table = $giavien->lay1giaovien($tendn);
$row = mysqli_fetch_assoc($table);
$magv = $row["MaGV"];
$mamonhoc = $row["MaMonHoc"];

//lấy 1 bài ktra
$Diem = null;
$makt = $_REQUEST["xemdethichitiet"];
$malop = $_REQUEST["malop"];
$table = $p->lay1ktra($makt, $malop);
$row = mysqli_fetch_assoc($table);
//lấy chi tiết môn học
include_once("controller/clophoc.php");
$plophoc = new controllophoc();
$table = $plophoc->chon1lophoc($malop);
$rowlophoc = mysqli_fetch_assoc($table);
$tieude = $rowlophoc['TenLop'];
//m câu hỏi
include_once("controller/ccauhoi.php");
$pcauhoi = new controlcauhoi;

?>

<head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="view/styles/bootstrap.min.css">
    <script src="view/js/bootstrap.min.js"></script>
</head>
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
echo "<H3>$tieude</H3>";
echo "<a href='GV.php?dslop'>Trang chủ</a> / ";
echo "<a href='GV.php?xbh=" . $malop . "'>$tieude</a> ";

echo "/<a href='GV.php?xemdethichitiet=" . $makt . "&malop=" . $malop . "'>" . $row['TieuDe'] . "</a><br>";
echo "<br><br><br>";
?>
<br>
<form method="POST" action="" enctype="multipart/form-data">
    <button type="submit" name="chitiet" class="btn btn-primary mb-2 ">CHI TIẾT</button>
    <?php if ($mamonhoc == 2) {
    ?><button type="submit" name="danhsachbainop" class="btn btn-primary mb-2 ">BÀI NỘP</button> <?php
                                                                                                    } else {
                                                                                                        ?>
        <button type="submit" name="danhsachcauhoi" class="btn btn-primary mb-2 ">DANH SÁCH CÂU HỎI</button>
        <button type="submit" name="danhsachdiem" class="btn btn-primary mb-2 ">DANH SÁCH ĐIỂM</button>
    <?php
                                                                                                    } ?>

</form>
<?php
if (isset($_REQUEST["chitiet"])) {
    echo "<H3> " . $row['TieuDe'] . "</H3>";
    echo "<br>";
    echo "Thời gian làm bài: " . $row['Time'] . " phút";
    echo "<br>";
    $_SESSION["time"] = $row['Time'];
    echo "Ngày bắt đầu: " . $row['TimeBD'];
    echo "<br>";
    $timebd = $row['TimeBD'];
    echo "Ngày kết thúc: " . $row['TimeKT'];
    echo "<br>";
    $timekt = $row['TimeKT'];

    date_default_timezone_set('Asia/Ho_Chi_Minh');
    $today = date("Y-m-d H:i:s");
    $today_dt = strtotime($today);
    $timekt_dt = strtotime($timekt);
    $timebd_dt = strtotime($timebd);
?>
    <form action="#" id="form_button">
        <?php
        echo '<button type="submit" ';
        echo 'name="btnsubmit2" disabled class="button">Bắt đầu bài làm</button>';
        ?>
    </form>
    <?php
} elseif (isset($_REQUEST["danhsachcauhoi"])) {
    $table = $pcauhoi->chonchtheode($makt);
    echo "<h1 style='text-align:center;'>DANH SÁCH CÂU HỎI</h1>";
    echo "<table style='width:1000px;  text-align: center;'>";
    echo "<tr style='border: 1px solid black;'>";
    echo "<td style='color: white; text-align:center;border: 1px solid black;  background: #015f95;'>Câu số:</td>";
    echo "<td style='color: white; text-align:center;border: 1px solid black;  background: #015f95;'>Đáp án</td>";
    echo "<td style='color: white; text-align:center;border: 1px solid black;  background: #015f95;'>Số điểm</td>";
    echo "<td style='color: white; text-align:center;border: 1px solid black;  background: #015f95;'>Sửa</td>";
    if ($table) {
        if (mysqli_num_rows($table) > 0) {

            echo "</tr>";
            $i = 1;
            while ($row = mysqli_fetch_assoc($table)) {
                echo "<tr>";
                echo "<td style='border: 1px solid black; background: white;'>";
                echo "Câu " . $i;
                $i = $i + 1;
                echo "</td>";
                echo "<td style='border: 1px solid black; background: #ebecd0;'>";
                echo $row["DapAn"];
                echo "<td style='border: 1px solid black; background: #ebecd0;'>";
                echo $row["SoDiem"];
                echo "</td>";
                echo "<td style='border: 1px solid black; background: white;'>";
                include_once("controller/cbailam.php");
                $pbailam = new controlbailam();
                $tablebailam = $pbailam->laybailam($makt);
                $sodong = mysqli_num_rows($tablebailam);
                if ($sodong == 0) {
                    echo "<a href='GV.php?updatechtn=" . $row["MaCHTN"] . "&kiemtra=" . $makt . "&malop=" . $malop . "'>Sửa</a>";
                } else {
                    echo "Sửa";
                }
                echo "</td>";
                echo "</tr>";
            }
            echo "</table>";
        }
    }
}

if (isset($_REQUEST["danhsachdiem"])) {
    include_once("controller/chocsinh.php");
    $phocsinh = new controlhocsinh;
    $table = $phocsinh->layctdshs($malop);
    echo "<h1 style='text-align:center;'>DANH SÁCH ĐIỂM HỌC SINH</h1>";
    echo "<table style='width:1000px; text-align: center;'>";
    echo "<tr style='border: 1px solid black;'>";
    echo "<td style='color: white; text-align:center;border: 1px solid black;  background: #015f95;'>STT</td>";
    echo "<td style='color: white; text-align:center;border: 1px solid black;  background: #015f95;'>Mã học sinh</td>";
    echo "<td style='color: white; text-align:center;border: 1px solid black;  background: #015f95;'>Tên học sinh</td>";
    echo "<td style='color: white; text-align:center;border: 1px solid black;  background: #015f95;'>Số điểm</td>";
    if ($table) {
        if (mysqli_num_rows($table) > 0) {

            echo "</tr>";
            $i = 1;
            while ($row = mysqli_fetch_assoc($table)) {
                echo "<tr>";
                echo "<td style='border: 1px solid black; background: white;'>";
                echo $i;
                $i = $i + 1;
                echo "</td>";
                echo "<td style='border: 1px solid black; background: #ebecd0;'>";
                echo $row["MaHS"];
                echo "</td>";
                echo "<td style='border: 1px solid black; background: #ebecd0;'>";
                echo $row["TenHS"];
                echo "</td>";
                echo "<td style='border: 1px solid black; background: #ebecd0;'>";
                include_once("controller/cbailam.php");
                $pbailam = new controlbailam;
                $tablebailam = $pbailam->laybai1lam($makt, $row["MaHS"]);
                if (mysqli_num_rows($tablebailam) == 0) {
                    echo "Chưa làm bài";
                } else {
                    $rowbailam = mysqli_fetch_assoc($tablebailam);
                    if ($rowbailam["Diem"] == null) {
                        echo "Chưa làm bài";
                    } else {
                        echo $rowbailam["Diem"];
                    }
                }

                echo "</td>";
                echo "</tr>";
            }
            echo "</table>";
        }
    }
}
if (isset($_REQUEST["danhsachbainop"])) {
    include_once("controller/chocsinh.php");
    $phocsinh = new controlhocsinh;
    $table = $phocsinh->layctdshs($malop);
    echo "<h1 style='text-align:center;'>DANH SÁCH BÀI NỘP</h1>";
    echo "<table style='width:1000px; text-align: center;'>";
    echo "<tr style='border: 1px solid black;'>";
    echo "<td style='color: white; text-align:center;border: 1px solid black;  background: #015f95;'>STT</td>";
    echo "<td style='color: white; text-align:center;border: 1px solid black;  background: #015f95;'>Mã học sinh</td>";
    echo "<td style='color: white; text-align:center;border: 1px solid black;  background: #015f95;'>Tên học sinh</td>";
    echo "<td style='color: white; text-align:center;border: 1px solid black;  background: #015f95;'>Bài làm</td>";
    echo "<td style='color: white; text-align:center;border: 1px solid black;  background: #015f95;'>Số điểm</td>";
    if ($table) {
        if (mysqli_num_rows($table) > 0) {

            echo "</tr>";
            $i = 1;
            while ($row = mysqli_fetch_assoc($table)) {
                echo "<tr>";
                echo "<td style='border: 1px solid black; background: white;'>";
                echo $i;
                $i = $i + 1;
                echo "</td>";
                echo "<td style='border: 1px solid black; background: #ebecd0;'>";
                echo $row["MaHS"];
                echo "</td>";
                echo "<td style='border: 1px solid black; background: #ebecd0;'>";
                echo $row["TenHS"];
                echo "</td>";
                echo "<td style='border: 1px solid black; background: #ebecd0;'>";
                include_once("controller/cbailam.php");
                $pbailam = new controlbailam;
                $tablebailam = $pbailam->laybai1lamvan($makt, $row["MaHS"]);
                if (mysqli_num_rows($tablebailam) == 0) {
                    echo "Chưa làm bài";
                    echo "</td>";
                    echo "<td style='border: 1px solid black; background: #ebecd0;'>";
                    echo "";
                    echo "</td>";
                } else {
                    $rowbailam = mysqli_fetch_assoc($tablebailam);
                ?>
                    <a style="color: #FF9966; margin: auto;" href="/do_an_nhom14/file/BaiLamVan/<?php echo  $rowbailam["FileBaiLam"]; ?>">
                        <?php echo "Xem bài làm"; ?></a>
<?php
                    echo "</td>";
                    echo "<td style='border: 1px solid black; background: #ebecd0;'>";
                    if(isset($rowbailam["Diem"])){
                        echo $rowbailam["Diem"];
                    }else{
                        ?>
                        <form class="js-form-submit-data" action="#" method="POST" enctype="multipart/form-data">
                            <input type="search" name="search" id="search" placeholder="Nhập điểm..." />
                            <input type="hidden" name="mabl" id="search" value="<?php echo $rowbailam["MaBL"]; ?>" />
                        </form>
                        <?php
                    }
                    echo "</td>";
                }
                echo "</tr>";
            }
            echo "</table>";
        }
    }
}
if (isset($_REQUEST["search"])) {
    include_once("controller/cbailam.php");
    $pbailam = new controlbailam;
    $search = $_REQUEST["search"];
    $mabl = $_REQUEST["mabl"];
    echo $mabl, $search;
    $kq = $pbailam->chonchamdiemvan($mabl, $search);
    if ($kq != 0) {
        echo header("refresh:0; url='GV.php?xemdethichitiet=".$makt."&malop=".$malop."'");
    } elseif ($kq == 0) {
        echo "<script>alert('Không thể insert lỗi 1')</script>";
    }
}
?>
    </div></div>


</body>

</html>