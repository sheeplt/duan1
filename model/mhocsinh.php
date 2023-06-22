<?php 
	include_once("ketnoi.php");
	class modelhocsinh{
		function chondshs($limit,$count){
			$con;
			$p = new clsketnoi();
			if ($p->ketnoidb($con)){
				$chuoi="SELECT *
                FROM `hocsinh`
                JOIN taikhoan ON taikhoan.TenDN = hocsinh.TenDN
				ORDER BY taikhoan.TrangThaiTK DESC, SUBSTRING_INDEX(TenHS, ' ', -1) ASC
				limit $limit,$count";
				$table =  mysqli_query($con, $chuoi);
				$p->dongketnoi($con);
				return $table;
			}else{
				return false;
			}
		}
		function chondslophoc(){
			$con;
			$p = new clsketnoi();
			if ($p->ketnoidb($con)){
				$chuoi="SELECT * FROM `lophoc` join giaovien on giaovien.MaGV = lophoc.MaGV ORDER BY TrangThai ASC;";
				$table =  mysqli_query($con, $chuoi);
				$p->dongketnoi($con);
				return $table;
			}else{
				return false;
			}
		}
        function chonctdshs($malop){
			$con;
			$p = new clsketnoi();
			if ($p->ketnoidb($con)){
				$chuoi="SELECT * FROM hocsinh
				JOIN ctlophoc on ctlophoc.MaHocSinh = hocsinh.MaHS
				WHERE ctlophoc.MaLopHoc = $malop
				ORDER BY SUBSTRING_INDEX(TenHS, ' ', -1) ASC";
				$table =  mysqli_query($con, $chuoi);
				$p->dongketnoi($con);
				return $table;
			}else{
				return false;
			}
		}
		function chondshschhoc($malop){
			$con;
			$p = new clsketnoi();
			if ($p->ketnoidb($con)){
				$chuoi="SELECT * FROM hocsinh
				JOIN taikhoan ON taikhoan.TenDN = hocsinh.TenDN
				WHERE MaHS NOT in (
					SELECT MaHocSinh FROM ctlophoc WHERE MaLopHoc = $malop
				)  AND taikhoan.TrangThaiTK = 1
				ORDER BY SUBSTRING_INDEX(TenHS, ' ', -1) ASC;";
				$table =  mysqli_query($con, $chuoi);
				$p->dongketnoi($con);
				return $table;
			}else{
				return false;
			}
		}
		function chon1hschhoc($malop, $mahs){
			$con;
			$p = new clsketnoi();
			if ($p->ketnoidb($con)){
				$chuoi="SELECT * FROM hocsinh
				JOIN taikhoan ON taikhoan.TenDN = hocsinh.TenDN
				WHERE MaHS NOT in (
					SELECT MaHocSinh FROM ctlophoc WHERE MaLopHoc = $malop
				)  AND taikhoan.TrangThaiTK = 1 and hocsinh.MaHS = $mahs
				ORDER BY SUBSTRING_INDEX(TenHS, ' ', -1) ASC;";
				$table =  mysqli_query($con, $chuoi);
				$p->dongketnoi($con);
				return $table;
			}else{
				return false;
			}
		}
		function chon1hs($tenDN){
			$con;
			$p = new clsketnoi();
			if ($p->ketnoidb($con)){
				$chuoi="SELECT * FROM `hocsinh` 
				JOIN taikhoan ON taikhoan.TenDN = hocsinh.TenDN
				WHERE hocsinh.TenDN = '$tenDN'";
				$table =  mysqli_query($con, $chuoi);
				$p->dongketnoi($con);
				return $table;
			}else{
				return false;
			}
		}
		function chon1hs1($ma){
			$con;
			$p = new clsketnoi();
			if ($p->ketnoidb($con)){
				$chuoi="SELECT * FROM `hocsinh` 
				JOIN taikhoan ON taikhoan.TenDN = hocsinh.TenDN
				WHERE MaHS = '$ma'";
				$table =  mysqli_query($con, $chuoi);
				$p->dongketnoi($con);
				return $table;
			}else{
				return false;
			}
		}
		function demALLhocsinh(){
			$con;
			$p = new clsketnoi();
			if ($p->ketnoidb($con)){
				$chuoi="SELECT COUNT(MaHS)
				FROM hocsinh";
				$table =  mysqli_query($con, $chuoi);
				$p->dongketnoi($con);
				return $table;
			}else{
				return false;
			}
		}
		function demhocsinh($ma){
			$con;
			$p = new clsketnoi();
			if ($p->ketnoidb($con)){
				$chuoi="SELECT COUNT(MaHS)
				FROM hocsinh
				JOIN ctlophoc on ctlophoc.MaHocSinh = hocsinh.MaHS
				WHERE ctlophoc.MaLopHoc = $ma;";
				$table =  mysqli_query($con, $chuoi);
				$p->dongketnoi($con);
				return $table;
			}else{
				return false;
			}
		}
		function themhocsinh($tenhocsinh, $ngay, $diachi, $gioitinh, $malop, $sdt, $email, $tenanh, $hinhanh){
			$con;
			$p = new clsketnoi();
			if ($p->ketnoidb($con)){
				//lay ma hoc sinh
				$chuoilayma="SELECT MAX(MaHS) FROM `hocsinh`;";
				$kqmahocsinh =  mysqli_query($con, $chuoilayma);
				if($kqmahocsinh){
					if (mysqli_num_rows($kqmahocsinh) > 0) {
						$row = mysqli_fetch_assoc($kqmahocsinh);
						$Mahocsinhcu = $row['MAX(MaHS)'];
						$mahocsinhmoi = $Mahocsinhcu +1;
						$tendangnhap = "HS".$mahocsinhmoi;
					}
				}else{
					return false;
				}
				//thêm tài khoản
				$chuoitk="INSERT INTO `taikhoan` (`TenDN`, `MK`, `LoaiTK`, `TrangThaiTK`) VALUES ('$tendangnhap', '12345', 'HS', 1);";
				$kqtk =  mysqli_query($con, $chuoitk);
				//thêm học sinh
				if($kqtk){
					$chuoi="INSERT INTO `hocsinh` (`MaHS`, `TenHS`, `NgaySinh`, `DiaChi`, `GioiTinh`, `TenDN`, `SDT`, `Email`, `HinhAnh`)
					 VALUES ($mahocsinhmoi, '$tenhocsinh', '$ngay', '$diachi', '$gioitinh', '$tendangnhap', '$sdt', '$email', '$tenanh')";
					$kq =  mysqli_query($con, $chuoi);
					$last_id = mysqli_insert_id($con);
					$p->dongketnoi($con);
					return $last_id;
				}else{
					$chuoixoatk="DELETE FROM taikhoan WHERE `taikhoan`.`TenDN` = '$tendangnhap';";
					mysqli_query($con, $chuoixoatk);
					return false;
				}
			}else{
				return false;
			}
		}
		function themhocsinhvaolophoc($malh, $mahs){
			$con;
			$p = new clsketnoi();
			if ($p->ketnoidb($con)){
				$chuoi="INSERT INTO `ctlophoc` (`MaLopHoc`, `MaHocSinh`) VALUES ('$malh', '$mahs')";
				$table =  mysqli_query($con, $chuoi);
				$p->dongketnoi($con);
				return $table;
			}else{
				return false;
			}
		}
		function ktratrunglichhs($ngay, $thu, $tiet, $mahs){
			$con;
			$p = new clsketnoi();
			if ($p->ketnoidb($con)){
				$chuoi="SELECT * FROM `lichhocvsgiangday` 
				JOIN lophoc on lophoc.MaLopHoc = lichhocvsgiangday.MaLopHoc 
				JOIN ctlophoc on ctlophoc.MaLopHoc = lophoc.MaLopHoc 
				WHERE ctlophoc.MaHocSinh = $mahs AND Ngay >= '$ngay' AND Thu = $thu AND Tiet= $tiet";
				$table =  mysqli_query($con, $chuoi);
				$sodong = mysqli_num_rows($table) ;
				if($sodong>0){
					$kq = 0;
				}else{
					$kq = 1;
				}
				$p->dongketnoi($con);
				return $kq;
			}else{
				return false;
			}
		}
		function ktratrunglich1hs($ngay, $thu, $tiet, $mahs){
			$con;
			$p = new clsketnoi();
			if ($p->ketnoidb($con)){
				$chuoi="SELECT * FROM `lichhocvsgiangday` 
				JOIN lophoc on lophoc.MaLopHoc = lichhocvsgiangday.MaLopHoc 
				JOIN ctlophoc on ctlophoc.MaLopHoc = lophoc.MaLopHoc 
				WHERE ctlophoc.MaHocSinh = $mahs AND Ngay = '$ngay' AND Thu = $thu AND Tiet= $tiet";
				$table =  mysqli_query($con, $chuoi);
				$sodong = mysqli_num_rows($table) ;	
				$p->dongketnoi($con);
				return $sodong;
			}else{
				return false;
			}
		}
		function updatehocsinh($tenhocsinh, $ngay, $diachi, $gioitinh, $ma, $sdt, $email){
			$con;
			$p = new clsketnoi();
			if ($p->ketnoidb($con)){
				$chuoi="UPDATE `hocsinh` 
				SET `TenHS` = '$tenhocsinh', `NgaySinh` = '$ngay', `DiaChi` = '$diachi', `GioiTinh` = '$gioitinh', `SDT` = '$sdt', `Email` = '$email'
				WHERE `hocsinh`.`MaHS` = $ma";
				$table =  mysqli_query($con, $chuoi);
				$p->dongketnoi($con);
				return $table;
			}else{
				return false;
			}
		}
		function updatehocsinhCoanh($tenhocsinh, $ngay, $diachi, $gioitinh, $ma, $sdt, $email, $tenanh){
			$con;
			$p = new clsketnoi();
			if ($p->ketnoidb($con)){
				$chuoi="UPDATE `hocsinh` 
				SET `TenHS` = '$tenhocsinh', `NgaySinh` = '$ngay', `DiaChi` = '$diachi', `GioiTinh` = '$gioitinh', `SDT` = '$sdt', `Email` = '$email', `HinhAnh` = '$tenanh'
				WHERE `hocsinh`.`MaHS` = $ma";
				$table =  mysqli_query($con, $chuoi);
				$p->dongketnoi($con);
				return $table;
			}else{
				return false;
			}
		}
		function xoahocsinhkhoilophoc($malop, $mahs){
			$con;
			$p = new clsketnoi();
			if ($p->ketnoidb($con)){
				$chuoi="DELETE FROM ctlophoc WHERE MaLopHoc = $malop AND MaHocSinh = $mahs";
				$table =  mysqli_query($con, $chuoi);
				$p->dongketnoi($con);
				return $table;
			}else{
				return false;
			}
		}
	}
?>