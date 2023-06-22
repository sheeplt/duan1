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
						$malop = $_GET["themhocsinhvaolop"];
						include_once("controller/chocsinh.php");
						if (isset($_REQUEST["btnsubmit"])) {
							echo header("refresh:0; url='QL.php?ctdshs=" . $malop . "'");
						}
						if (isset($_REQUEST["themhocsinhmoi"])) {
							echo header("refresh:0; url='QL.php?themhocsinh=" . $malop . "'");
						}
						$p = new controlhocsinh();
						if (isset($_REQUEST["Themhocsinh"])) {
							$MaHS = $_REQUEST["MaHS"];
							$kq2 = $p->themhocsinhvaolophoc($malop, $MaHS);
							if ($kq2 == 2) {
								echo "<script>alert('Học sinh trùng lịch học')</script>";
							} elseif ($kq2 == 3) {
								echo "<script>alert('Số lượng học sinh đã đủ')</script>";
							} elseif ($kq2 == 4) {
								echo "<script>alert('Cập nhật trạng thái thất bại')</script>";
							} elseif ($kq2 == 5) {
								echo "<script>alert('Thêm hóa đơn thất bại')</script>";
							} else {
								echo header("refresh:0; url='QL.php?themhocsinhvaolop=" . $malop . "'");
							}
						}
						if (isset($_REQUEST["tim"])) {
							$search = $_REQUEST["search"];
							$table = $p->chon1hschhoc($malop, $search);
						} else {
							$table = $p->chondshschhoc($malop);
						}
						if ($table) {
							echo "<h1 style='text-align:center;'>DANH SÁCH HỌC SINH ĐANG HỌC TẠI TRUNG TÂM</h1>";
							?>
								<br>
								<form class="js-form-submit-data" action="#" method="POST" enctype="multipart/form-data">
									<span class="icon"><i class="fa fa-search"></i></span>
									<input type="search" name="search" id="search" placeholder="Nhập mã sinh viên" />
									<button type="submit" name="tim" class="">Tìm kiếm</button>
								</form><br>
							<form action="#" method="POST" id='form_button'>
							<?php
							include_once("controller/clophoc.php");
							$plophoc = new controllophoc();
							$tablelophoc = $plophoc->chon1lophoc($malop);
							$rowlophoc = mysqli_fetch_assoc($tablelophoc);
							$trangthailop = $rowlophoc["TrangThai"];
							if ($trangthailop == 1 or $trangthailop == 2) {
								echo "<button type='submit' name='themhocsinhmoi' class='button' style='width: 130px;'>Thêm học sinh mới</button>";
							}
							?>

							<button type="submit" name="btnsubmit" class='button' style='width: 130px;'>Trở về</button>
							</form> <br>
							<?php
							if (mysqli_num_rows($table) > 0) {
							echo "<table style='width:1000px;  text-align: center;' >";
							echo "<tr style='border: 1px solid black;'>";
							echo "<td style='color: white; text-align:center;border: 1px solid black;  background: #015f95;'>STT</td>";
							echo "<td style='color: white; text-align:center;border: 1px solid black;  background: #015f95;'>Tên đăng nhập</td>";
							echo "<td style='color: white; text-align:center;border: 1px solid black;  background: #015f95;'>Tên học sinh</td>";
							echo "<td style='color: white; text-align:center;border: 1px solid black;  background: #015f95;'>Ngày sinh</td>";
							echo "<td style='color: white; text-align:center;border: 1px solid black;  background: #015f95;'>Địa chỉ</td>";
							echo "<td style='color: white; text-align:center;border: 1px solid black;  background: #015f95;'>Giới tính</td>";
							echo "<td style='color: white; text-align:center;border: 1px solid black;  background: #015f95;'>Thêm học sinh</td>";

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
						?>
									<form method="POST" action="">
										<input type="hidden" name="MaHS" value="<?php echo $row['MaHS']  ?>">
										<input name="Themhocsinh" type="submit" value="Thêm" style="background-color: white; border: solid white; color: blue;">
									</form>
						<?php
									echo "</td>";
									echo "</tr>";
								}
								echo "</table>";
							}else{
								echo "Học sinh đã được thêm vào lớp";
							}
						} else {
							echo "Erro";
						}
						if (isset($_REQUEST["tim"])) {
							?> <br>
							<form class="js-form-submit-data" action="QL.php?themhocsinhvaolop=<?php echo $malop; ?>" method="POST" enctype="multipart/form-data">
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
</body>

</html>