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
						
						if (isset($_REQUEST["thanhtoan"])) {
							$mahd = $_REQUEST["mahd"];
							$kq2 = $p->thanhtoaQL($mahd);
						}
						if (isset($_REQUEST["themhoadon"])) {
							$kq = $p->themhoadonQL();
							if ($kq == 0) {
								echo "<script>alert('Thêm hóa đơn thất bại')</script>";
							}
							if ($kq == 2) {
								echo "<script>alert('Hóa đơn tháng này đã được tạo')</script>";
							}
						}
						if (isset($_REQUEST["btnsubmit"])) {
							$search = $_REQUEST["search"];
							$table = $p->dshoadon1QL($search);
						} else {
							$table = $p->dshoadonQL();
						}
						if ($table) {
							if (mysqli_num_rows($table) > 0) {
								echo "<h1 style='text-align:center;'>DANH SÁCH HÓA ĐƠN QUẢN LÍ</h1>";
								?>
						<br>
						<form class="js-form-submit-data" action="#" method="POST" enctype="multipart/form-data">
							<span class="icon"><i class="fa fa-search"></i></span>
							<input type="search" name="search" id="search" placeholder="Nhập mã quản lí" />
							<button type="submit" name="btnsubmit" class="">Tìm kiếm</button>
						</form><br>
						<form action="#" method="POST" id='form_button'>
							<button type="submit" name="themhoadon" class='btn' onclick="return confirm('Bạn muốn thêm hóa đơn tháng này?');" style='width: 130px;'>Thêm hóa đơn tháng này</button>
						</form><br>
						<?php
								echo "<table style='width:1200px;  text-align: center;'>";
								echo "<tr style='border: 1px solid black;'>";
								echo "<td style='color: white; text-align:center;border: 1px solid black;  background: #015f95;'>Mã Hóa đơn</td>";
								echo "<td style='color: white; text-align:center;border: 1px solid black;  background: #015f95;'>Mã quản lí</td>";
								echo "<td style='color: white; text-align:center;border: 1px solid black;  background: #015f95;'>Tên quản lí</td>";
								echo "<td style='color: white; text-align:center;border: 1px solid black;  background: #015f95;'>Ngày thanh toán</td>";
								echo "<td style='color: white; text-align:center;border: 1px solid black;  background: #015f95;'>Số tiền</td>";
								echo "<td style='color: white; text-align:center;border: 1px solid black;  background: #015f95;'>Trạng thái</td>";
								echo "<td style='color: white; text-align:center;border: 1px solid black;  background: #015f95;'>Sửa</td>";
								echo "<td style='color: white; text-align:center;border: 1px solid black;  background: #015f95;'>Chi tiết</td>";
								echo "</tr>";
								$i = 1;
								while ($row = mysqli_fetch_assoc($table)) {
									echo "<tr>";
									echo "<td style='border: 1px solid black; background: white;'>";
									echo $row["MaHoaDon"];
									echo "</td>";
									echo "<td style='border: 1px solid black; background: #ebecd0;'>";
									echo $row["MaQL"];
									echo "</td>";
									echo "</td>";
									echo "<td style='border: 1px solid black; background: #ebecd0;'>";
									echo $row["TenQL"];
									echo "</td>";
									echo "</td>";
									echo "<td style='border: 1px solid black; background: #ebecd0;'>";
									$ngay = date('Y-m-d');
                                    $ngay = strtotime($ngay);
                                    $ngaylich = strtotime($row["NgayTT"]);
                                    if ($ngaylich < $ngay and $row["TrangThaiHoaDon"] == 0) {
                                        echo "<p style = 'color:red'> " . $row["NgayTT"] . " </p>";
                                    } else {
                                        echo $row["NgayTT"];
                                    }
									echo "</td>";
									echo "<td style='border: 1px solid black; background: #ebecd0;'>";
									if (strlen($row["SoTien"]) == 6) {
										echo $row["SoTien"][0], $row["SoTien"][1], $row["SoTien"][2];
										echo ".";
										echo $row["SoTien"][3], $row["SoTien"][4], $row["SoTien"][5];
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
									echo "<td  style='border: 1px solid black; background: #ebecd0;'>";
									if ($row["TrangThaiHoaDon"] == 0) {
										echo "Chưa thanh toán";
									} elseif ($row["TrangThaiHoaDon"] == 1) {
										echo "Đã thanh toán";
									}
									echo "</td>";
									echo "<td  style='border: 1px solid black; background: #ebecd0;'>";
									if ($row["TrangThaiHoaDon"] == 1) {
										echo "Sửa";
									} else {
										echo "<a href='QL.php?updatehoadonql=" . $row["MaHoaDon"] . "'>Sửa</a>";
									}
									echo "</td>";
									echo "<td style='border: 1px solid black; background: white;'>";
						?>
									<form method="POST" action="">
										<input type="hidden" name="mahd" value="<?php echo $row['MaHoaDon']  ?>">
										<?php
										if ($row["TrangThaiHoaDon"] == 0) {
										?> <input name="thanhtoan" type="submit" value="Thanh toán" onclick="return confirm('Bạn muốn thanh toán hóa đơn ?');" style="background-color: white; border: solid white; color: blue;"><?php
																																																			} elseif ($row["TrangThaiHoaDon"] == 1) {
																																																				echo "Đã thanh toán";
																																																			}
																																																				?>
									</form>
									</form>
							<?php
									echo "</td>";
									echo "</tr>";
								}
								echo "</table>";
							}
						}
						if (isset($_REQUEST["btnsubmit"])) {
							?><br>
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
</body>

</html>