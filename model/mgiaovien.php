<?php 
	include_once("ketnoi.php");
	class modelgiaovien{
		function chongiaovien(){
			$con;
			$p = new clsketnoi();
			if ($p->ketnoidb($con)){
				$chuoi="SELECT *
				FROM `giaovien`
				JOIN taikhoan ON taikhoan.TenDN = giaovien.TenDN
				left JOIN monhoc ON monhoc.MaMonHoc = giaovien.MaMonHoc
				ORDER BY taikhoan.TrangThaiTK DESC, SUBSTRING_INDEX(TenGV, ' ', -1) ASC ;";
				$table =  mysqli_query($con, $chuoi);
				$p->dongketnoi($con);
				return $table;
			}else{
				return false;
			}
		}
		function chongiaovienconlam(){
			$con;
			$p = new clsketnoi();
			if ($p->ketnoidb($con)){
				$chuoi="SELECT * FROM giaovien 
				JOIN taikhoan ON taikhoan.TenDN = giaovien.TenDN
				left JOIN monhoc ON monhoc.MaMonHoc = giaovien.MaMonHoc
				WHERE taikhoan.TrangThaiTK = 1
				ORDER BY SUBSTRING_INDEX(TenGV, ' ', -1) ASC;";
				$table =  mysqli_query($con, $chuoi);
				$p->dongketnoi($con);
				return $table;
			}else{
				return false;
			}
		}
		function chon1giaovien($tendn){
			$con;
			$p = new clsketnoi();
			if ($p->ketnoidb($con)){
				$chuoi="SELECT *
				FROM `giaovien`
				JOIN monhoc ON monhoc.MaMonHoc = giaovien.MaMonHoc
				WHERE giaovien.TenDN = '$tendn'";
				$table =  mysqli_query($con, $chuoi);
				$p->dongketnoi($con);
				return $table;
			}else{
				return false;
			}
		}
		function chon1giaovien2($magv){
			$con;
			$p = new clsketnoi();
			if ($p->ketnoidb($con)){
				$chuoi="SELECT *
				FROM `giaovien`
				JOIN monhoc ON monhoc.MaMonHoc = giaovien.MaMonHoc
				JOIN taikhoan ON taikhoan.TenDN = giaovien.TenDN
				WHERE giaovien.MaGV = '$magv'";
				$table =  mysqli_query($con, $chuoi);
				$p->dongketnoi($con);
				return $table;
			}else{
				return false;
			}
		}
		//chon giao vien theo mon hoc
		function chongvtheomonhoc($ma){
			$con;
			$p = new clsketnoi();
			if ($p->ketnoidb($con)){
				$chuoi="SELECT * FROM `giaovien`
				JOIN taikhoan ON taikhoan.TenDN = giaovien.TenDN
				WHERE taikhoan.TrangThaiTK = 1 and MaMonHoc = $ma";
				$table =  mysqli_query($con, $chuoi);
				$p->dongketnoi($con);
				return $table;
			}else{
				return false;
			}
		}
		//chon giao vien chua chủ nhiệm
		function chongvchuachunghiem(){
			$con;
			$p = new clsketnoi();
			if ($p->ketnoidb($con)){
				$chuoi="SELECT * FROM `giaovien` WHERE MaGV NOT IN (SELECT MaGV FROM lophoc);";
				$table =  mysqli_query($con, $chuoi);
				$p->dongketnoi($con);
				return $table;
			}else{
				return false;
			}
		}
		function themgiaovien($ten, $ngay, $diachi, $gioitinh, $ma, $tenanh, $sdt, $email){
			$con;
			$p = new clsketnoi();
			if ($p->ketnoidb($con)){
				//lay ma giao vien
				$chuoilayma="SELECT MAX(MaGV) FROM `giaovien`;";
				$kqma =  mysqli_query($con, $chuoilayma);
				if($kqma){
					if (mysqli_num_rows($kqma) > 0) {
						$row = mysqli_fetch_assoc($kqma);
						$Macu = $row['MAX(MaGV)'];
						$mamoi = $Macu +1;
						$tendangnhap = "GV".$mamoi;
					}
				}else{
					return false;
				}
				//thêm tài khoản
				$chuoitk="INSERT INTO `taikhoan` (`TenDN`, `MK`, `LoaiTK`, `TrangThaiTK`) VALUES ('$tendangnhap', '12345', 'GV', 1);";
				$kqtk =  mysqli_query($con, $chuoitk);
				//thêm giáo viên
				if($kqtk){
					$chuoi="INSERT INTO `giaovien` (`MaGV`, `TenGV`, `NgaySinh`, `DiaChi`, `GioiTinh`, `TenDN`, `MaMonHoc`, `HinhAnh`, `SDT`, `Email`) 
					VALUES ($mamoi, '$ten', '$ngay', '$diachi', '$gioitinh', '$tendangnhap', '$ma', '$tenanh', '$sdt', '$email');";
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
		function updategiaovien($ten, $ngay, $diachi, $gioitinh, $mamon, $ma, $sdt, $email){
			$con;
			$p = new clsketnoi();
			if ($p->ketnoidb($con)){
				$chuoi="UPDATE `giaovien`
				 SET `TenGV` = '$ten', `DiaChi` = '$diachi', `NgaySinh` = '$ngay', `GioiTinh` = '$gioitinh', `MaMonHoc` = '$mamon', `SDT` = '$sdt', `Email` = '$email'
				 WHERE `giaovien`.`MaGV` = $ma";
				$table =  mysqli_query($con, $chuoi);
				$p->dongketnoi($con);
				return $table;
			}else{
				return false;
			}
		}
		function updategiaovienCoanh($ten, $ngay, $diachi, $gioitinh, $mamon, $ma, $tenanh, $sdt, $email){
			$con;
			$p = new clsketnoi();
			if ($p->ketnoidb($con)){
				$chuoi="UPDATE `giaovien`
				 SET `TenGV` = '$ten', `DiaChi` = '$diachi', `NgaySinh` = '$ngay', `GioiTinh` = '$gioitinh', `MaMonHoc` = '$mamon', `HinhAnh` = '$tenanh', `SDT` = '$sdt', `Email` = '$email'
				 WHERE `giaovien`.`MaGV` = $ma";
				$table =  mysqli_query($con, $chuoi);
				$p->dongketnoi($con);
				return $table;
			}else{
				return false;
			}
		}
		function xoagiaovien($ma){
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