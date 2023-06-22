<?php 
	include_once("ketnoi.php");
	class modelquanli{
		function chonquanli(){
			$p = new clsketnoi();
			if ($p->ketnoidb($con)) {
				$chuoi = "SELECT * FROM `quanli`";
				$table =  mysqli_query($con, $chuoi);
				$p->dongketnoi($con);
				return $table;
			} else {
				return false;
			}
		}
		function chonquanlidanglam(){
			$p = new clsketnoi();
			if ($p->ketnoidb($con)) {
				$chuoi = "SELECT * FROM `quanli` 
				JOIN taikhoan on taikhoan.TenDN = quanli.TenDN
				WHERE taikhoan.TrangThaiTK = 1";
				$table =  mysqli_query($con, $chuoi);
				$p->dongketnoi($con);
				return $table;
			} else {
				return false;
			}
		}
		function chon1quanli($tendn){
			$con;
			$p = new clsketnoi();
			if ($p->ketnoidb($con)){
				$chuoi="SELECT *
				FROM `quanli`
				JOIN taikhoan ON taikhoan.TenDN = quanli.TenDN
				WHERE quanli.TenDN = '$tendn'";
				$table =  mysqli_query($con, $chuoi);
				$p->dongketnoi($con);
				return $table;
			}else{
				return false;
			}
		}
		function chon1quanli1($ma){
			$con;
			$p = new clsketnoi();
			if ($p->ketnoidb($con)){
				$chuoi="SELECT *
				FROM `quanli`
				JOIN taikhoan ON taikhoan.TenDN = quanli.TenDN
				WHERE quanli.MaQL = '$ma'";
				$table =  mysqli_query($con, $chuoi);
				$p->dongketnoi($con);
				return $table;
			}else{
				return false;
			}
		}
		function themquanli($ten, $ngay, $diachi, $gioitinh, $sdt, $email, $role, $tenanh){
			$con;
			$p = new clsketnoi();
			if ($p->ketnoidb($con)){
				//lay ma giao vien
				$chuoilayma="SELECT MAX(MaQL) FROM `quanli`;";
				$kqma =  mysqli_query($con, $chuoilayma);
				if($kqma){
					if (mysqli_num_rows($kqma) > 0) {
						$row = mysqli_fetch_assoc($kqma);
						$Macu = $row['MAX(MaQL)'];
						$mamoi = $Macu +1;
						$tendangnhap = "QL".$mamoi;
					}
				}else{
					return false;
				}
				//thêm tài khoản
				$chuoitk="INSERT INTO `taikhoan` (`TenDN`, `MK`, `LoaiTK`) VALUES ('$tendangnhap', '12345', 'QL');";
				$kqtk =  mysqli_query($con, $chuoitk);
				//thêm giáo viên
				if($kqtk){
					$chuoi="INSERT INTO `quanli` (`MaQL`, `TenQL`, `DiaChi`, `NgaySinh`, `GioiTinh`, `SDT`, `Email`, `TenDN`, `NgayThi`, `Role`, `HinhAnh`) 
					VALUES (NULL, '$ten', '$diachi', '$ngay', '$gioitinh', '$sdt', '$email', '$tendangnhap', NULL, '$role', '$tenanh');";
					$kq =  mysqli_query($con, $chuoi);
					$p->dongketnoi($con);
					return $kq;
				}else{
					$chuoixoatk="DELETE FROM taikhoan WHERE `taikhoan`.`TenDN` = '$tendangnhap';";
					mysqli_query($con, $chuoixoatk);
					return false;
				}
			}else{
				return false;
			}
		}
		function capnhatquanli($ma, $ten, $ngay, $diachi, $gioitinh, $sdt, $email, $role){
			$con;
			$p = new clsketnoi();
			if ($p->ketnoidb($con)){
				$chuoi="UPDATE `quanli` SET 
				`TenQL` = '$ten', `DiaChi` = '$diachi', `SDT` = '$sdt', `NgaySinh` = '$ngay', `GioiTinh` = '$gioitinh', `Email` = '$email', `Role` = '$role' 
				WHERE `quanli`.`MaQL` = $ma;";
				$table =  mysqli_query($con, $chuoi);
				$p->dongketnoi($con);
				return $table;
			}else{
				return false;
			}
		}
		function capnhatquanliCoanh($ma, $ten, $ngay, $diachi, $gioitinh, $sdt, $email, $role, $hinhanh){
			$con;
			$p = new clsketnoi();
			if ($p->ketnoidb($con)){
				$chuoi="UPDATE `quanli` SET 
				`TenQL` = '$ten', `DiaChi` = '$diachi', `SDT` = '$sdt', `NgaySinh` = '$ngay', `GioiTinh` = '$gioitinh', `Email` = '$email', `Role` = '$role', `HinhAnh` = '$hinhanh' 
				WHERE `quanli`.`MaQL` = $ma;";
				$table =  mysqli_query($con, $chuoi);
				$p->dongketnoi($con);
				return $table;
			}else{
				return false;
			}
		}
		function updatengaythi($ma, $ngay){
			$con;
			$p = new clsketnoi();
			if ($p->ketnoidb($con)){
				$chuoi="UPDATE `quanli` SET 
				`NgayThi` = '$ngay'
				WHERE `quanli`.`MaQL` = $ma;";
				$table =  mysqli_query($con, $chuoi);
				$p->dongketnoi($con);
				return $table;
			}else{
				return false;
			}
		}
		function xoaquanli($ma){
			$con;
			$p = new clsketnoi();
			if ($p->ketnoidb($con)){
				$chuoitk="DELETE FROM taikhoan WHERE `taikhoan`.`TenDN` = '$ma'";
				$kqtk =  mysqli_query($con, $chuoitk);
				$p->dongketnoi($con);
					return $kqtk;
			}else{
				return false;
			}
		}
	}
?>