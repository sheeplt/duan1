<?php
ob_start();
?>
<!doctype html>
<html>

<head>
	<meta charset="utf-8">
	<title>Danh sách bài học</title>
	<link rel="stylesheet" href="view/styles/lich_day.css">
	<script src="view/js/bootstrap.min.js"></script>
</head>

<body>
	<div class="content-wrapper">
		<section class="content">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-12">
						<?php
						include_once("controller/choadon.php");
						$p = new controlhoadon();
						$table = $p->dstienluong();
						if ($table) {
							if (mysqli_num_rows($table) > 0) {
								echo "<h1 style='text-align:center;'>BẢNG LƯƠNG</h1>";
								echo "<table style='width:1000px; margin-left: 250px; text-align: center;'>";
								echo "<tr style='border: 1px solid black;'>";
								echo "<td style='color: white; text-align:center;border: 1px solid black;  background: #015f95;'>Mã bảng lương</td>";
								echo "<td style='color: white; text-align:center;border: 1px solid black;  background: #015f95;'>Số tiền</td>";
								echo "<td style='color: white; text-align:center;border: 1px solid black;  background: #015f95;'>Chú thích</td>";
								echo "<td style='color: white; text-align:center;border: 1px solid black;  background: #015f95;'>Sửa</td>";
								echo "</tr>";
								$i = 1;
								while ($row = mysqli_fetch_assoc($table)) {
									echo "<tr>";
									echo "<td style='border: 1px solid black; background: white;'>";
									echo $row["MaLuong"];
									echo "</td>";
									echo "<td style='border: 1px solid black; background: #ebecd0;'>";
									if (strlen($row["SoTien"]) == 5) {
										echo $row["SoTien"][0], $row["SoTien"][1];
										echo ".";
										echo $row["SoTien"][2], $row["SoTien"][3], $row["SoTien"][4];
									} elseif (strlen($row["SoTien"]) == 7) {
										echo $row["SoTien"][0];
										echo ".";
										echo $row["SoTien"][1], $row["SoTien"][2], $row["SoTien"][3];
										echo ".";
										echo $row["SoTien"][4], $row["SoTien"][5], $row["SoTien"][6];
									} elseif (strlen($row["SoTien"]) == 8) {
										echo $row["SoTien"][0], $row["SoTien"][1];
										echo ".";
										echo $row["SoTien"][2], $row["SoTien"][3], $row["SoTien"][4];
										echo ".";
										echo $row["SoTien"][5], $row["SoTien"][6], $row["SoTien"][7];
									}
									echo "</td>";
									echo "</td>";
									echo "<td style='border: 1px solid black; background: #ebecd0;'>";
									echo $row["TenLuong"];
									echo "</td>";
									echo "<td  style='border: 1px solid black; background: #ebecd0;'>";
									echo "<a href='QL.php?updatebangluong=" . $row["MaLuong"] . "'>Sửa</a>";
									echo "</td>";

									echo "</tr>";
								}
								echo "</table>";
							}
						}
						if (isset($_REQUEST["btnsubmit"])) {
						?>
							<form class="js-form-submit-data" action="QL.php?hoadonnhanvien" method="POST" enctype="multipart/form-data">
								<button type="submit" name="" class="">Thoát</button>
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
</body>>

</html>