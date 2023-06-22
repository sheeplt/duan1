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
							$kq2 = $p->thanhtoaHS($mahd);
						}
						if (isset($_REQUEST["hoantien"])) {
							$mahd = $_REQUEST["mahd"];
							$kq2 = $p->hoantienHS($mahd);
						}

						if (isset($_REQUEST["btnsubmit"])) {
							$search = $_REQUEST["search"];
							$table = $p->dshoadon1HS($search);
						} else {
							$table = $p->dshoadonHS();
						}
						if ($table) {
							if (mysqli_num_rows($table) > 0) {
								echo "<h1 style='text-align:center;'>DANH SÁCH HÓA ĐƠN HỌC SINH</h1>";
						?>
								<br>
								<form class="js-form-submit-data" action="#" method="POST" enctype="multipart/form-data">
									<span class="icon"><i class="fa fa-search"></i></span>
									<input type="search" name="search" id="search" placeholder="Nhập mã sinh viên" />
									<button type="submit" name="btnsubmit" class="">Tìm kiếm</button>
								</form> <br>
								<?php
								echo "<table style='width:1200px;  text-align: center;'>";
								echo "<tr style='border: 1px solid black;'>";
								echo "<td style='color: white; text-align:center;border: 1px solid black;  background: #015f95;'>Mã Hóa đơn</td>";
								echo "<td style='color: white; text-align:center;border: 1px solid black;  background: #015f95;'>Mã học sinh</td>";
								echo "<td style='color: white; text-align:center;border: 1px solid black;  background: #015f95;'>Tên học sinh</td>";
								echo "<td style='color: white; text-align:center;border: 1px solid black;  background: #015f95;'>Ngày thanh toán</td>";
								echo "<td style='color: white; text-align:center;border: 1px solid black;  background: #015f95;'>Số tiền</td>";
								echo "<td style='color: white; text-align:center;border: 1px solid black;  background: #015f95;'>Trạng thái</td>";
								echo "<td style='color: white; text-align:center;border: 1px solid black;  background: #015f95;'>Lớp học</td>";
								echo "<td style='color: white; text-align:center;border: 1px solid black;  background: #015f95;'>Cập nhật</td>";
								echo "</tr>";
								$i = 1;
								while ($row = mysqli_fetch_assoc($table)) {
									echo "<tr>";
									echo "<td style='border: 1px solid black; background: white;'>";
									echo $row["MaHoaDon"];
									echo "</td>";
									echo "<td style='border: 1px solid black; background: #ebecd0;'>";
									echo $row["MaHS"];
									echo "</td>";
									echo "</td>";
									echo "<td style='border: 1px solid black; background: #ebecd0;'>";
									echo $row["TenHS"];
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
									if (strlen($row["HocPhi"]) == 6) {
                                        echo $row["HocPhi"][0], $row["HocPhi"][1], $row["HocPhi"][2];
                                        echo ".";
                                        echo $row["HocPhi"][3], $row["HocPhi"][4], $row["HocPhi"][5];
                                    } elseif (strlen($row["HocPhi"]) == 7) {
                                        echo $row["HocPhi"][0];
                                        echo ".";
                                        echo $row["HocPhi"][1], $row["HocPhi"][2], $row["HocPhi"][3];
                                        echo ".";
                                        echo $row["HocPhi"][4], $row["HocPhi"][5], $row["HocPhi"][6];
                                    } elseif (strlen($row["HocPhi"]) == 8) {
                                        echo $row["HocPhi"][0], $row["HocPhi"][1];
                                        echo ".";
                                        echo $row["HocPhi"][2], $row["HocPhi"][3], $row["HocPhi"][4];
                                        echo ".";
                                        echo $row["HocPhi"][5], $row["HocPhi"][6], $row["HocPhi"][7];
                                    }
									echo "</td>";
									echo "<td  style='border: 1px solid black; background: #ebecd0;'>";
									if ($row["TrangThaiHoaDon"] == 0) {
										echo "Chưa thanh toán";
									} elseif ($row["TrangThaiHoaDon"] == 1) {
										echo "Đã thanh toán";
									} elseif ($row["TrangThaiHoaDon"] == 2) {
										echo "Đã hoàn";
									}
									echo "</td>";
									echo " <td style='border: 1px solid black; background: #ebecd0;'>";
									echo $row["TenLop"];
									echo "</td>";
									echo "<td style='border: 1px solid black; background: white;'>";
								?>
									<form method="POST" action="">
										<input type="hidden" name="mahd" value="<?php echo $row['MaHoaDon']  ?>">
										<?php
										if ($row["TrangThaiHoaDon"] == 0) {
										?> <input name="thanhtoan" type="submit" value="Thanh toán" onclick="return confirm('Bạn muốn thanh toán hóa đơn ?');" style="background-color: white; border: solid white; color: blue;">
											<?php
										} elseif ($row["TrangThaiHoaDon"] == 1) {
											if ($row["TrangThai"] == 5) {
											?> <input name="hoantien" type="submit" value="Hoàn tiền" onclick="return confirm('Bạn muốn thanh toán hóa đơn ?');" style="background-color: white; border: solid white; color: blue;">
										<?php
											} else {
												echo "Đã thanh toán";
											}
										}
										if ($row["TrangThaiHoaDon"] == 2) {
											echo "Đã hoàn";
										}
										?>
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
						if (isset($_REQUEST["btnsubmit"])) {
							?> <br>
							<form class="js-form-submit-data" action="QL.php?hoadonhoctap" method="POST" enctype="multipart/form-data">
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