<!doctype html>
<html>

<head>
	<meta charset="utf-8">
	<title>Danh sách học sinh</title>
	<script src="view/js/bootstrap.min.js"></script>
</head>

<body>
	<div class="content-wrapper">
		<section class="content">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-12">
						<?php
						$malop = $_GET["ctdshs"];
						include_once("controller/clophoc.php");
						$p = new controllophoc();
						$kqlophoc = $p->chon1lophoc($malop);
						$rowlophoc = mysqli_fetch_assoc($kqlophoc);
						include_once("controller/chocsinh.php");
						if (isset($_REQUEST["btnsubmit"])) {
							echo header("refresh:0; url='QL.php?hocsinh'");
						}
						if (isset($_REQUEST["themhocsinh"])) {
							echo header("refresh:0; url='QL.php?themhocsinhvaolop=" . $malop . "'");
						}
						$p = new controlhocsinh();
						if (isset($_REQUEST["xoahocsinh"])) {
							$MaHS = $_REQUEST["MaHS"];
							$kq2 = $p->xoahocsinhkhoilophoc($malop, $MaHS);
						}
						$table = $p->layctdshs($malop);
						if ($table) {
							echo "<h1 style='text-align:center;'>DANH SÁCH HỌC SINH</h1>";
							?> 
							<form action="#" method="POST" id='form_button'>
							<?php
							include_once("controller/clophoc.php");
							$plophoc = new controllophoc();
							$tablelophoc = $plophoc->chon1lophoc($malop);
							$rowlophoc = mysqli_fetch_assoc($tablelophoc);
							$trangthailop = $rowlophoc["TrangThai"];
							if ($trangthailop == 1 or $trangthailop == 2) {
								echo "<button type='submit' name='themhocsinh' class='button' style='width: 130px;'>Thêm học sinh</button>";
							}
							?>

							<button type="submit" name="btnsubmit" class='button' style='width: 130px;'>Trở về</button>
						</form> <br>
							<?php
							
							if (mysqli_num_rows($table) > 0) {
							echo "<table style='width:1000px; text-align: center;' >";
							echo "<tr style='border: 1px solid black;'>";
							echo "<td style='color: white; text-align:center;border: 1px solid black;  background: #015f95;'>STT</td>";
							echo "<td style='color: white; text-align:center;border: 1px solid black;  background: #015f95;'>Tên đăng nhập</td>";
							echo "<td style='color: white; text-align:center;border: 1px solid black;  background: #015f95;'>Tên học sinh</td>";
							echo "<td style='color: white; text-align:center;border: 1px solid black;  background: #015f95;'>Ngày sinh</td>";
							echo "<td style='color: white; text-align:center;border: 1px solid black;  background: #015f95;'>Địa chỉ</td>";
							echo "<td style='color: white; text-align:center;border: 1px solid black;  background: #015f95;'>Giới tính</td>";
							echo "<td style='color: white; text-align:center;border: 1px solid black;  background: #015f95;'>Xóa khỏi lớp</td>";

							echo "</tr>";

								$i = 1;
								while ($row = mysqli_fetch_assoc($table)) {
									echo "<tr>";
									echo "<td style='border: 1px solid black; background: white;'>";
									echo $i;
									$i = $i + 1;
									echo "</td>";
									echo "<td style='border: 1px solid black; background: #ebecd0;'>";
									echo $row["TenDN"];
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
									echo "<td style='border: 1px solid black; background: white;'>";
									if ($rowlophoc["TrangThai"] == 5 or $rowlophoc["TrangThai"] == 4 or $rowlophoc["TrangThai"] == 3) {
										echo "Xóa khỏi lớp";
									} else {
						?>
										<form method="POST" action="">
											<input type="hidden" name="MaHS" value="<?php echo $row['MaHS']  ?>">
											<input name="xoahocsinh" type="submit" value="Xóa khỏi lớp" onclick="return confirm('Xóa học sinh khỏi lớp này ?');" style="background-color: white; border: solid white; color: red;">
										</form>
						<?php
									}

									echo "</td>";
									echo "</tr>";
								}
								echo "</table>";
							}
						} else {
							echo "Erro";
						}
						?>

						
					</div>
					<!-- /.col -->
				</div>
				<!-- /.row -->
			</div><!-- /.container-fluid -->
		</section>
	</div>
</body>

</html>