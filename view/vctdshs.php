<!doctype html>
<html>

<head>
	<meta charset="utf-8">
	<title>Danh sách học sinh</title>
	<link rel="stylesheet" href="view/styles/bootstrap.min.css">
	<script src="view/js/bootstrap.min.js"></script>
</head>
<?php
$malop = $_GET["ctdshs"];
include_once("controller/chocsinh.php");
$p = new controlhocsinh();
$table = $p->layctdshs($malop);
if ($table) {
	if (mysqli_num_rows($table) > 0) {
		echo "<h1 style='text-align:center;'>DANH SÁCH HỌC SINH</h1>";
		echo "<table style='width:auto; margin-left: 250px; text-align: center;' >";
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
<body>
	</table>
</body>

</html>