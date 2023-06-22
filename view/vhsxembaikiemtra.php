<!doctype html>
<html>
<?php
ob_start();
include_once("controller/ckiemtra.php");
$p = new controlkiemtra();
$tendn = $_SESSION["tendangnhap"];
//lay ma hoc sinh
include_once("controller/chocsinh.php");
$phocsinh = new controlhocsinh();
$tablehocsinh = $phocsinh->lay1hs($tendn);
$rowhocsinh =  mysqli_fetch_assoc($tablehocsinh);
$mahs = $rowhocsinh['MaHS'];
//lấy 1 bài ktra
$Diem = null;
$makt = $_REQUEST["xemdethichitiet"];
if($makt == null){
    $makt = $_SESSION["makt"];
}
$malop = $_SESSION["malop"];

$table = $p->lay1ktra($makt, $malop);
$row = mysqli_fetch_assoc($table);
$mamonhoc = $row["MaMonHoc"];
//lấy chi tiết môn học
include_once("controller/clophoc.php");
$plophoc = new controllophoc();
$table = $plophoc->chon1lophoc($row["MaLopHoc"]);
$rowlophoc = mysqli_fetch_assoc($table);
$tieude = $rowlophoc['TenLop'];
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
					<h1>DANH SÁCH BÀI KIỂM TRA</h1>
				</div>
			</div>
		</div>
<?php
echo "<H3>$tieude</H3>";
echo "<a href='HS.php?trangchu'>Trang chủ</a> / ";
echo "<a href='HS.php?xembaihoc=" . $row["MaLopHoc"] . "'>$tieude</a> ";

echo "/<a href='HS.php?xemdethichitiet=" . $makt . "'>" . $row['TieuDe'] . "</a><br>";
echo "<br><br><br>";
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


include_once("controller/cbailam.php");
$pbailam = new controlbailam();


$tablebailam = $pbailam->laybai1lam($makt, $mahs);
if (mysqli_num_rows($tablebailam) > 0) {
    $rowbailam =  mysqli_fetch_assoc($tablebailam);
    if(isset($_REQUEST["lamxongbai"])){
        $kq = $pbailam->laydiem($rowbailam["MaBL"], $makt);
    }
}
if($mamonhoc == 2){
    $tablebailam = $pbailam->laybai1lamvan($makt, $mahs);
}else{
    $tablebailam = $pbailam->laybai1lam($makt, $mahs);
}
if (mysqli_num_rows($tablebailam) > 0) {
    $rowbailam =  mysqli_fetch_assoc($tablebailam);
    $Diem = $rowbailam['Diem'];
    if ($Diem != null) {
        echo "<br>";
        echo "Điểm: " . $Diem;
    }
}
?>
<form action="#" method="POST" id="form_button">
    <?php
if($mamonhoc != 2){
    if ($Diem != null) {
        echo '<button type="submit" ';
        echo 'disabled';
        echo 'name="btnsubmit" class="button">Đã thành kiểm tra</button>';
    } elseif ($today_dt > $timekt_dt) {
        echo '<button type="submit" ';
        echo 'disabled';
        echo 'name="btnsubmit" class="button">Hết thời gian kiểm tra</button>';
    } elseif ($today_dt < $timebd_dt) {
        echo '<button type="submit" ';
        echo 'disabled';
        echo 'name="btnsubmit" class="button">Chưa bắt đầu kiểm tra</button>';
    } elseif (mysqli_num_rows($tablebailam) > 0) {
        echo '<button type="submit" ';
        echo 'name="btnsubmit1" class="button">Tiếp tục bài làm</button>';
    } else {
        echo '<button type="submit" ';
        echo 'name="btnsubmit2" class="button">Bắt đầu bài làm</button>';
    }
}else{
        if ($today_dt > $timekt_dt) {
        echo '<button type="submit" ';
        echo 'disabled';
        echo 'name="btnsubmit" class="button">Hết thời gian kiểm tra</button>';
    } elseif ($today_dt < $timebd_dt) {
        echo '<button type="submit" ';
        echo 'disabled';
        echo 'name="btnsubmit" class="button">Chưa bắt đầu kiểm tra</button>';
    } elseif (mysqli_num_rows($tablebailam) > 0 and $rowbailam["FileBaiLam"] == null) {
        echo '<button type="submit" ';
        echo 'name="btnsubmit1" class="button">Tiếp tục bài làm</button>';
    } elseif (mysqli_num_rows($tablebailam) == 0) {
        echo '<button type="submit" ';
        echo 'name="btnsubmit2" class="button">Bắt đầu bài làm</button>';
    }else{
        echo '<button type="submit" ';
        echo 'disabled';
        echo 'name="btnsubmit" class="button">Đã thành kiểm tra</button>';
    }
}
    ?>
</form>
<?php
if (isset($_REQUEST["btnsubmit1"]) and $mamonhoc != 2) {
    echo header("refresh:0; url='HS.php?bailam=1'");
}elseif(isset($_REQUEST["btnsubmit1"])){
    echo header("refresh:0; url='HS.php?bailamvan=".$makt."&malop=".$malop."'");
}

if (isset($_REQUEST["btnsubmit2"])and $mamonhoc != 2) {
    include_once("controller/cbailam.php");
    $pbailam = new controlbailam();
    $kq = $pbailam->laythembailamtn($makt, $mahs);
    if ($kq == 1) {
        echo header("refresh:0; url='HS.php?xdetn=".$makt."&malop=".$malop."'");
    } elseif ($kq == 0) {
        echo "<script>alert('Lỗi không thể làm bài')</script>";
    }
}elseif(isset($_REQUEST["btnsubmit2"])){
    include_once("controller/cbailam.php");
    $pbailam = new controlbailam();
    $kq = $pbailam->laythembailamtl($makt, $mahs);
    if ($kq == 1) {
        echo header("refresh:0; url='HS.php?xdevan=".$makt."&malop=".$malop."'");
    } elseif ($kq == 0) {
        echo "<script>alert('Lỗi không thể làm bài')</script>";
    }
}
?>
    </div></div>

</body>

</html>