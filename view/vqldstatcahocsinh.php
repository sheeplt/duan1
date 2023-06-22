<?php
ob_start();
$tendn = $_SESSION["tendangnhap"];
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
						//reset mk
						if (isset($_REQUEST["datlaimk"])) {
							$TenDN = $_REQUEST["TenDN"];
							include_once("controller/ctaikhoan.php");
							$ptaikhoan = new controltaikhoan();
							$kq2 = $ptaikhoan->datlaimk($TenDN);
							if ($kq2 == 3) {
								echo "<script>alert('Mật khẩu cũ chưa thay đổi')</script>";
							}
						}
						if (isset($_REQUEST["vohieu"])) {
							$TenDN = $_REQUEST["TenDN"];
							$mahs = $_REQUEST["MaHS"];
							include_once("controller/ctaikhoan.php");
							$ptaikhoan = new controltaikhoan();
							$kq2 = $ptaikhoan->vohieutk($TenDN);
							if ($kq2 == 0) {
								echo "<script>alert('vô hiệu thất bại')</script>";
							}
							include_once("controller/choadon.php");
							$phoadon = new controlhoadon();
							$kq2 = $phoadon->xoahoadonhs($mahs);
							if ($kq2 == 0) {
								echo "<script>alert('xóa thất bại')</script>";
							}
						}
						include_once("controller/chocsinh.php");
						$p = new controlhocsinh();
						//lấy số trang
						$page = $_REQUEST["tatcahocsinh"];
						$soluonghs = $p->demAllhocsinh();
						$sohstrentrang = 30;
						if ($soluonghs % 30 == 0) {
							$sotrang = $soluonghs / 30;
						} else {
							$sotrang = $soluonghs / 30 + 1;
						}
						if ($page == 1) {
							$sotruyen = 0;
						} else {
							$sotruyen = ($page - 1) * 30;
						}
						if (isset($_REQUEST["btnsubmit"])) {
							$search = $_REQUEST["search"];
							$table = $p->lay1hs1($search);
						} else {
							$table = $p->laydshs($sotruyen, $sohstrentrang);
						}
						if ($table) {
							if (mysqli_num_rows($table) > 0) {
								echo "<h1 style='text-align:center;'>DANH SÁCH HỌC SINH</h1>";
								?>
								<br>
								<form class="js-form-submit-data" action="#" method="POST" enctype="multipart/form-data">
									<span class="icon"><i class="fa fa-search"></i></span>
									<input type="search" name="search" id="search" placeholder="Nhập mã sinh viên" />
									<button type="submit" name="btnsubmit" class="">Tìm kiếm</button>
								</form><br>
								<?php
								echo "<table style='width:1200px; text-align: center;' >";
								echo "<tr style='border: 1px solid black;'>";
								echo "<td style='color: white; text-align:center;border: 1px solid black;  background: #015f95;'>STT</td>";
								echo "<td style='color: white; text-align:center;border: 1px solid black;  background: #015f95;'>Mã học sinh</td>";
								echo "<td style='color: white; text-align:center;border: 1px solid black;  background: #015f95;'>Tên đăng nhập</td>";
								echo "<td style='color: white; text-align:center;border: 1px solid black;  background: #015f95;'>Tên học sinh</td>";
								echo "<td style='color: white; text-align:center;border: 1px solid black;  background: #015f95;'>Ngày sinh</td>";
								echo "<td style='color: white; text-align:center;border: 1px solid black;  background: #015f95;'>Địa chỉ</td>";
								echo "<td style='color: white; text-align:center;border: 1px solid black;  background: #015f95;'>Giới tính</td>";
								echo "<td style='color: white; text-align:center;border: 1px solid black;  background: #015f95;'>Số điện thoại</td>";
								echo "<td style='color: white; text-align:center;border: 1px solid black;  background: #015f95;'>Email</td>";
								echo "<td style='color: white; text-align:center;border: 1px solid black;  background: #015f95;'>Trạng thái học tập</td>";
								echo "<td style='color: white; text-align:center;border: 1px solid black;  background: #015f95;'>Sửa</td>";
								echo "<td style='color: white; text-align:center;border: 1px solid black;  background: #015f95;'>Đặt lại mật khẩu</td>";
								echo "<td style='color: white; text-align:center;border: 1px solid black;  background: #015f95;'>Vô hiệu tài khoản</td>";

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
									echo "<td style='border: 1px solid black; background: #ebecd0;'>";
									echo $row["SDT"];
									echo "</td>";
									echo "<td style='border: 1px solid black; background: #ebecd0;'>";
									echo $row["Email"];
									echo "</td>";
									echo "<td style='border: 1px solid black; background: #ebecd0;'>";
									if ($row["TrangThaiTK"] == 1) {
										echo "Đang học tập";
									} else {
										echo "Đã tốt nghiệp";
									}

									echo "</td>";
									echo "<td style='border: 1px solid black; background: white;'>";
									if ($row["TrangThaiTK"] == 1) {
										echo "<a href='QL.php?updatehs=" . $row["MaHS"] . "'>Sửa</a>";
									} else {
										echo "Sửa";
									}
									echo "</td>";
									echo "<td style='border: 1px solid black; background: white;'>";
									if ($row["TrangThaiTK"] == 1) {
						?>
										<form method="POST" action="">
											<input type="hidden" name="TenDN" value="<?php echo $row["TenDN"]; ?>">
											<input name="datlaimk" type="submit" value="Reset" onclick="return confirm('Bạn muốn đặt lại mật khẩu?');" style="background-color: white; border: solid white; color: red;">
										</form>
							<?php
									} else {
										echo "Reset";
									}
									echo "</td>";
									echo "<td style='border: 1px solid black; background: white;'>";
									if ($row["TrangThaiTK"] == 1) {
										?>
														<form method="POST" action="">
															<input type="hidden" name="TenDN" value="<?php echo $row["TenDN"]; ?>">
															<input type="hidden" name="MaHS" value="<?php echo $row["MaHS"]; ?>">
															<input name="vohieu" type="submit" value="Vô hiệu" onclick="return confirm('Bạn muốn vô hiệu tài khoản?');" style="background-color: white; border: solid white; color: red;">
														</form>
											<?php
													} else {
														echo "Vô hiệu";
													}
									echo "</td>";
									echo "</tr>";
								}
								echo "</table>";
							}
						}
						if (isset($_REQUEST["btnsubmit"])) {
							?>
							<form class="js-form-submit-data" action="QL.php?tatcahocsinh=1" method="POST" enctype="multipart/form-data">
								<button type="submit" name="" class="">Thoát</button>
							</form>
						<?php
						} else {
							echo "Số trang: ";
							for ($i = 1; $i <= $sotrang; $i++) {
								echo "<a href=QL.php?tatcahocsinh=" . $i . " >";
								echo "  $i";
								echo "</a>";
							}
						}

						echo "<br><br><br><br>";
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