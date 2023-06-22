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
						if (isset($_REQUEST["vohieu"])) {
							$TenDN = $_REQUEST["TenDN"];
							include_once("controller/ctaikhoan.php");
							$ptaikhoan = new controltaikhoan();
							$kq2 = $ptaikhoan->vohieutk($TenDN);
							if ($kq2 == 0) {
								echo "<script>alert('vô hiệu thất bại')</script>";
							}
						}
						if (isset($_REQUEST["themgiaovien"])) {
							echo header("refresh:0; url='QL.php?themgiaovien'");
						}
						//
						if (isset($_REQUEST["datlaimk"])) {
							$TenDN = $_REQUEST["TenDN"];
							include_once("controller/ctaikhoan.php");
							$ptaikhoan = new controltaikhoan();
							$kq2 = $ptaikhoan->datlaimk($TenDN);
							if ($kq2 == 3) {
								echo "<script>alert('Mật khẩu cũ chưa thay đổi')</script>";
							}
						}
						include_once("controller/cgiaovien.php");
						$p = new controlgiaovien();
						if (isset($_REQUEST["xoagiaovien"])) {
							$TenDN = $_REQUEST["TenDN"];
							$kq2 = $p->xoagiaovien($TenDN);
						}
						if (isset($_REQUEST["btnsubmit"])) {
							$search = $_REQUEST["search"];
							$table = $p->lay1giaovien1($search);
						} else {
							$table = $p->laygiaovien();
						}
						if ($table) {
							if (mysqli_num_rows($table) > 0) {
								echo "<h1 style='text-align:center;'>DANH SÁCH GIẢNG VIÊN</h1>";
								?>
								<br>
								<form class="js-form-submit-data" action="#" method="POST" enctype="multipart/form-data">
									<span class="icon"><i class="fa fa-search"></i></span>
									<input type="search" name="search" id="search" placeholder="Nhập mã giảng viên" />
									<button type="submit" name="btnsubmit" class="">Tìm kiếm</button>
								</form> <br>
								<form action="#" method="POST" id='form_button'>
								<button type="submit" name="themgiaovien" class='button' style='width: 130px;'>Thêm giảng viên</button>
								</form> <br>
								<?php
								echo "<table style='width:1200px;text-align: center;' >";
								echo "<tr style='border: 1px solid black;'>";
								echo "<td style='color: white; text-align:center;border: 1px solid black;  background: #015f95;'>STT</td>";
								echo "<td style='color: white; text-align:center;border: 1px solid black;  background: #015f95;'>Mã giáo viên</td>";
								echo "<td style='color: white; text-align:center;border: 1px solid black;  background: #015f95;'>Tên đăng nhập</td>";
								echo "<td style='color: white; text-align:center;border: 1px solid black;  background: #015f95;'>Tên giảng viên</td>";
								echo "<td style='color: white; text-align:center;border: 1px solid black;  background: #015f95;'>Môn dạy</td>";
								echo "<td style='color: white; text-align:center;border: 1px solid black;  background: #015f95;'>Ngày sinh</td>";
								echo "<td style='color: white; text-align:center;border: 1px solid black;  background: #015f95;'>Địa chỉ</td>";
								echo "<td style='color: white; text-align:center;border: 1px solid black;  background: #015f95;'>Giới tính</td>";
								echo "<td style='color: white; text-align:center;border: 1px solid black;  background: #015f95;'>Số điện thoại</td>";
								echo "<td style='color: white; text-align:center;border: 1px solid black;  background: #015f95;'>Email</td>";
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
									echo $row["MaGV"];
									echo "</td>";
									echo "<td style='border: 1px solid black; background: #ebecd0;'>";
									echo $row["TenDN"];
									echo "</td>";
									echo "<td style='border: 1px solid black; background: #ebecd0;'>";
									echo $row["TenGV"];
									echo "</td>";
									echo "<td style='border: 1px solid black; background: #ebecd0;'>";
									echo $row["TenMonHoc"];
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
									echo "</td>";
									echo "<td style='border: 1px solid black; background: #ebecd0;'>";
									echo $row["SDT"];
									echo "</td>";
									echo "</td>";
									echo "<td style='border: 1px solid black; background: #ebecd0;'>";
									echo $row["Email"];
									echo "</td>";
									echo "<td style='border: 1px solid black; background: white;'>";
									echo "<a href='QL.php?updategv=" . $row["MaGV"] . "'>Sửa</a>";
									echo "</td>";
									echo "<td style='border: 1px solid black; background: white;'>";
									if($row["TrangThaiTK"] == 0 ){
										echo "Reset";
									}else{
										?>
									<form method="POST" action="">
										<input type="hidden" name="TenDN" value="<?php echo $row["TenDN"]; ?>">
										<input name="datlaimk" type="submit" value="Reset" onclick="return confirm('Bạn muốn đặt lại mật khẩu?');" style="background-color: white; border: solid white; color: red;">
									</form>
										<?php
									}
							
									echo "</td>";
									echo "<td style='border: 1px solid black; background: white;'>";
									if($row["TrangThaiTK"] == 0 ){
										echo "Vô hiệu";
									}else{
										?>
									<form method="POST" action="">
										<input type="hidden" name="TenDN" value="<?php echo $row["TenDN"]; ?>">
										<input name="vohieu" type="submit" value="Vô hiệu" onclick="return confirm('Bạn muốn vô hiệu hóa tài khoản?');" style="background-color: white; border: solid white; color: red;">
									</form>
							<?php
									}
							
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
						if (isset($_REQUEST["btnsubmit"])) {
							?> <br>
							<form class="js-form-submit-data" action="QL.php?giangvien" method="POST" enctype="multipart/form-data">
								<button type="submit" name="" class="">Thoát</button>
							</form>
						<?php
						} else {
						?>

							
						<?php } ?>
					</div>
					<!-- /.col -->
				</div>
				<!-- /.row -->
			</div><!-- /.container-fluid -->
		</section>
	</div>
</body>

</html>