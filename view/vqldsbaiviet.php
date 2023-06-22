<?php
ob_start();
$tendn = $_SESSION["tendangnhap"];
include_once("controller/cquanli.php");
$pquanli = new controlquanli();
$tablequanli = $pquanli -> lay1quanli($tendn);
$rowquanli=mysqli_fetch_assoc($tablequanli);
$MaQL = $rowquanli["MaQL"];
?>
<!doctype html>
<html>

<head>
	<meta charset="utf-8">
	<title>Danh sách bài học</title>
	<link rel="stylesheet" href="view/styles/lich_day.css">
	<script src="view/js/bootstrap.min.js"></script>
</head>
<?php
include_once("controller/cbaiviet.php");
$p = new controlbaiviet();
if (isset($_REQUEST["xoaMaBV"])) {
	$MaBV = $_REQUEST["MaBV"];
	$kq2 = $p->chonxoabaiviet($MaBV);
}
if (isset($_REQUEST["btnsubmit"])) {
    $MaQL = $_REQUEST["MaQL"];
    echo header("refresh:0; url='QL.php?thembaiviet=" . $MaQL . "'");
}
$table = $p->layallbaiviet();
if ($table) {
	if (mysqli_num_rows($table) > 0) {
		echo "<h1 style='text-align:center;'>DANH SÁCH BÀI VIẾT</h1>";
		echo "<table style='width:1000px; margin-left: 250px; text-align: center;'>";
		echo "<tr style='border: 1px solid black;'>";
		echo "<td style='color: white; text-align:center;border: 1px solid black;  background: #015f95;'>STT</td>";
		echo "<td style='color: white; text-align:center;border: 1px solid black;  background: #015f95;'>Tiêu đề</td>";
		echo "<td style='color: white; text-align:center;border: 1px solid black;  background: #015f95;'>Hình ảnh</td>";
		echo "<td style='color: white; text-align:center;border: 1px solid black;  background: #015f95;'>Mức ưu tiên</td>";
		echo "<td style='color: white; text-align:center;border: 1px solid black;  background: #015f95;'>Nội dung</td>";
		echo "<td style='color: white; text-align:center;border: 1px solid black;  background: #015f95;'>Chi tiết</td>";
		echo "<td style='color: white; text-align:center;border: 1px solid black;  background: #015f95;'>Cập nhật</td>";
		echo "<td style='color: white; text-align:center;border: 1px solid black;  background: #015f95;'>Xóa</td>";
		echo "</tr>";
		$i = 1;
		while ($row = mysqli_fetch_assoc($table)) {
			echo "<tr>";
			echo "<td style='border: 1px solid black; background: white;'>";
			echo $i;
			$i = $i + 1;
			echo "</td>";
			echo "<td style='border: 1px solid black; background: #ebecd0;'>";
			echo $row["TieuDe"];
			echo "</td>";
			echo "</td>";
			echo "<td style='border: 1px solid black; background: #ebecd0;'>";
			echo $row["HinhAnh"];
			echo "</td>";
			echo "</td>";
			echo "<td style='border: 1px solid black; background: #ebecd0;'>";
			echo $row["UuTien"];
			echo "</td>";
			echo "<td style='border: 1px solid black; background: #ebecd0;'>";
			echo substr($row['NoiDung'], 0, 100);
			echo "...";
			echo "</td>";
			echo "<td style='border: 1px solid black; background: white;'>";
			echo "<a href='GV.php?xembaivietchitiet=" . $row["MaBV"] . "'>Chi tiết</a>";
			echo "</td>";
			echo "<td style='border: 1px solid black; background: white;'>";
			echo "<a href='QL.php?updatebaiviet=" . $row["MaBV"] . "'>Sửa</a>";
			echo "</td>";
			echo "<td style='border: 1px solid black; background: white;'>";
?>
			<form method="POST" action="">
				<input type="hidden" name="MaBV" value="<?php echo $row['MaBV']  ?>">
				<input name="xoaMaBV" type="submit" value="Xóa" onclick="return confirm('Xóa bài viết ?');" style="background-color: white; border: solid white; color: red;">
			</form>
<?php
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
<form action="#" method="POST" id='form_button'>
    <input type="hidden" name="MaQL" value="<?php echo $MaQL  ?>">
	<button type="submit" name="btnsubmit" class='button' style='width: 130px;'>Thêm bài viết</button>
</form>
<body>
	</table>
</body>

</html>