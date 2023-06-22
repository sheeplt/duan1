
<!doctype html>
<html>

<head>
	<meta charset="utf-8">
	<title>Danh sách đề kiểm tra</title>
	<link rel="stylesheet" href="view/styles/lich_day.css">
	<link rel="stylesheet" href="view/styles/bootstrap.min.css">
	<script src="view/js/bootstrap.min.js"></script>
</head>
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
		$tenDN = $_SESSION["tendangnhap"];
		//lay ma GV
include_once("controller/cgiaovien.php");
$giavien = new controlgiaovien();
$table = $giavien->lay1giaovien($tenDN);
$row = mysqli_fetch_assoc($table);
$magv = $row["MaGV"];
		$maLh = $_REQUEST['vdsktraChthem'];
		include_once("controller/ckiemtra.php");
		$p = new controlkiemtra();
		if (isset($_REQUEST["xoabaikt"])) {
			$makt = $_REQUEST["MAKT"];
			$kq2 = $p->xoabaikt($makt);
		}
		if (isset($_REQUEST["btnsubmit"])) {
			echo header("refresh:0; url='GV.php?themdekt=" . $maLh . "'");
		}
		$table = $p->chonktraChthem($maLh, $magv);
		echo "<table style='width: 100%; margin: 50px 0px 30px 0px; text-align: center;'>";
		echo "<tr style='border: 1px solid black;'>";
		echo "<td style='color: white; text-align:center;border: 1px solid black;  background: #015f95;'>STT</td>";
		echo "<td style='color: white; text-align:center;border: 1px solid black;  background: #015f95;'>Tiêu đề</td>";
		echo "<td style='color: white; text-align:center;border: 1px solid black;  background: #015f95;'>Thời gian (phút)</td>";
		echo "<td style='color: white; text-align:center;border: 1px solid black;  background: #015f95;'>Xem đề</td>";
		echo "<td style='color: white; text-align:center;border: 1px solid black;  background: #015f95;'>Thêm bài kiểm tra</td>";
		echo "</tr>";
		if ($table) {
			if (mysqli_num_rows($table) > 0) {

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
					echo "<td style='border: 1px solid black; background: #ebecd0;'>";
					echo $row["Time"];
					echo "</td>";
					echo "<td style='border: 1px solid black; background: white;'>";
					echo "<a href='/do_an_nhom14/file/DeThi/". $row["FileDe"]."'>Xem đề</a>";
					echo "</td>";
					echo "<td style='border: 1px solid black; background: white;'>";
					echo "<a href='GV.php?themdechthem=".$row["MaKT"]."&malop=".$maLh."'>Thêm</a>";
					echo "</td>";
					
				}
				echo "</table>";
			}
		}

		?>
		<form action="#" method="POST" id='form_button'>
			<button type="submit" name="btnsubmit" class='button' style='width: 130px;'>Thêm bài kiểm tra</button>
		</form>

		<body>
			</table>
	</div>
</div>

</body>

</html>