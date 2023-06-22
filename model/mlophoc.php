<?php 
	include_once("ketnoi.php");
	class modellophoc{
		function chonlophocdangmo(){
			$con;
			$p = new clsketnoi();
			if ($p->ketnoidb($con)){
				$chuoi="SELECT * FROM `lophoc` WHERE TrangThai = 1 or TrangThai = 2 or TrangThai = 3;";
				$table =  mysqli_query($con, $chuoi);
				$p->dongketnoi($con);
				return $table;
			}else{
				return false;
			}
		}
		function chonlophocdangmo2(){
			$con;
			$p = new clsketnoi();
			if ($p->ketnoidb($con)){
				$chuoi="SELECT * FROM `lophoc` 
                JOIN giaovien ON giaovien.MaGV = lophoc.MaGV
				WHERE TrangThai = 3;";
				$table =  mysqli_query($con, $chuoi);
				$p->dongketnoi($con);
				return $table;
			}else{
				return false;
			}
		}
		function chonlophocdangmo3(){
			$con;
			$p = new clsketnoi();
			if ($p->ketnoidb($con)){
				$chuoi="SELECT * FROM `lophoc` 
				JOIN giaovien on giaovien.MaGV = lophoc.MaGV
				WHERE TrangThai = 1 or TrangThai = 2 ";
				$table =  mysqli_query($con, $chuoi);
				$p->dongketnoi($con);
				return $table;
			}else{
				return false;
			}
		}
		function chonlophocdangmo2chogv($ma){
			$con;
			$p = new clsketnoi();
			if ($p->ketnoidb($con)){
				$chuoi="SELECT * FROM `lophoc` 
                JOIN giaovien ON giaovien.MaGV = lophoc.MaGV
				WHERE TrangThai = 3 and giaovien.TenDN = '$ma';";
				$table =  mysqli_query($con, $chuoi);
				$p->dongketnoi($con);
				return $table;
			}else{
				return false;
			}
		}
		function chonlophockt2chogv($ma){
			$con;
			$p = new clsketnoi();
			if ($p->ketnoidb($con)){
				$chuoi="SELECT * FROM `lophoc` 
                JOIN giaovien ON giaovien.MaGV = lophoc.MaGV
				WHERE TrangThai = 4 and giaovien.TenDN = '$ma';";
				$table =  mysqli_query($con, $chuoi);
				$p->dongketnoi($con);
				return $table;
			}else{
				return false;
			}
		}
		function chon1lophoc($ma){
			$con;
			$p = new clsketnoi();
			if ($p->ketnoidb($con)){
				$chuoi="SELECT * FROM `lophoc` 
				JOIN giaovien on giaovien.MaGV = lophoc.MaGV 
                JOIN monhoc on giaovien.MaMonHoc = monhoc.MaMonHoc WHERE MaLopHoc = $ma";
				$table =  mysqli_query($con, $chuoi);
				$p->dongketnoi($con);
				return $table;
			}else{
				return false;
			}
		}
		function kiemtralichtrungGV($magv, $ngay, $thu, $tiet){
			$con;
			$p = new clsketnoi();
			if ($p->ketnoidb($con)){
				$chuoi="SELECT * FROM `lichhocvsgiangday` 
				WHERE GVTrucTiep = $magv AND Ngay >= '$ngay' AND Thu = $thu AND Tiet= $tiet";
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
		function kiemtralichtrung1GV($magv, $ngay, $thu, $tiet){
			$con;
			$p = new clsketnoi();
			if ($p->ketnoidb($con)){
				$chuoi="SELECT * FROM `lichhocvsgiangday` 
				WHERE GVTrucTiep = $magv AND Ngay = '$ngay' AND Thu = $thu AND Tiet= $tiet";
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
		function themlophoc($tenlop, $sisi, $magv, $thoigian, $hocphi, $id, $pass, $loailop){
			$con;
			$p = new clsketnoi();
			if ($p->ketnoidb($con)){
				$chuoi="INSERT INTO `lophoc` (`MaLopHoc`, `TenLop`, `SiSo`, `TrangThai`, `MaGV`, `NgayBD`, `HocPhi`, `IdChinh`, `PassChinh`, `LoaiLop`) 
					VALUES (NULL, '$tenlop', '$sisi', '1', '$magv', '$thoigian', '$hocphi', '$id', '$pass', $loailop);";
				$table =  mysqli_query($con, $chuoi);
				$last_id = mysqli_insert_id($con);
				$p->dongketnoi($con);
				return $last_id;
			}else{
				return false;
			}
		}
		function thembuoihoc($malop, $mathu, $matiet){
			$con;
			$p = new clsketnoi();
			if ($p->ketnoidb($con)){
				$chuoi="INSERT INTO `ctlichhoc` (`MaLopHoc`, `MaThu`, `MaTiet`, `TrangThaiLich`) VALUES ('$malop', '$mathu', '$matiet', 1)";
				$table =  mysqli_query($con, $chuoi);
				$p->dongketnoi($con);
				return 1;
			}else{
				return false;
			}
		}
		function molop($malop){
			$con;
			$p = new clsketnoi();
			if ($p->ketnoidb($con)){
				$chuoi="UPDATE lichhocvsgiangday SET `TrangThaiBuoiHoc` = 1
				WHERE `MaLopHoc` = $malop";
				$table =  mysqli_query($con, $chuoi);
				$p->dongketnoi($con);
				return $table;
			}else{
				return false;
			}
		}
		function updatelophoc($tenlop, $sisi, $magv, $makhoi, $malop){
			$con;
			$p = new clsketnoi();
			if ($p->ketnoidb($con)){
				$chuoi="UPDATE `lophoc` SET `TenLop` = '$tenlop', `SiSo` = '$sisi', `MaGV` = '$magv', `MaKhoi` = '$makhoi' 
				WHERE `lophoc`.`MaLopHoc` = $malop";
				$table =  mysqli_query($con, $chuoi);
				$p->dongketnoi($con);
				return $table;
			}else{
				return false;
			}
		}
		function updatelophockt(){
			$con;
			$p = new clsketnoi();
			if ($p->ketnoidb($con)){
				$chuoi="UPDATE `lophoc` SET `TrangThai` = 4
				WHERE `TrangThai` = 3";
				$table =  mysqli_query($con, $chuoi);
				$p->dongketnoi($con);
				return $table;
			}else{
				return false;
			}
		}
		function huylop($malop){
			$con;
			$p = new clsketnoi();
			if ($p->ketnoidb($con)){
				$chuoi="UPDATE lophoc set TrangThai = 5 WHERE MaLopHoc = $malop";
				$kq1 =  mysqli_query($con, $chuoi);
				$p->dongketnoi($con);
				return $kq1;
			}else{
				return false;
			}
		}
	}
?>