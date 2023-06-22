<?php 
	include_once("ketnoi.php");
	class modellich{
		function chonlichchoGV($maGV){
			$con;
			$p = new clsketnoi();
			if ($p->ketnoidb($con)){
				$chuoi="SELECT *
				FROM `lichhocvsgiangday`
				JOIN lophoc ON lophoc.MaLopHoc = lichhocvsgiangday.MaLopHoc
				JOIN giaovien ON giaovien.MaGV = lophoc.MaGV
				WHERE giaovien.TenDN  ='$maGV'";
				$table =  mysqli_query($con, $chuoi);
				$p->dongketnoi($con);
				return $table;
			}else{
				return false;
			}
		}
		function chonlichchoGV2($maGV, $ngay){
			$con;
			$p = new clsketnoi();
			$ngay=date('Y-m-d', strtotime($ngay));
			if ($p->ketnoidb($con)){
				$chuoi="SELECT *
				FROM `lichhocvsgiangday`
				JOIN lophoc ON lophoc.MaLopHoc = lichhocvsgiangday.MaLopHoc
				JOIN giaovien ON giaovien.MaGV = lophoc.MaGV
				WHERE giaovien.TenDN  = '$maGV'
				AND Tiet > 2 and Tiet < 5
				AND Ngay = '$ngay'
				ORDER BY Tiet ASC";
				$table =  mysqli_query($con, $chuoi);
				$p->dongketnoi($con);
				return $table;
			}else{
				return false;
			}
		}
		function chonlichchoGV3($maGV, $ngay){
			$con;
			$p = new clsketnoi();
			$ngay=date('Y-m-d', strtotime($ngay));
			if ($p->ketnoidb($con)){
				$chuoi="SELECT *
				FROM `lichhocvsgiangday`
				JOIN lophoc ON lophoc.MaLopHoc = lichhocvsgiangday.MaLopHoc
				JOIN giaovien ON giaovien.MaGV = lophoc.MaGV
				WHERE giaovien.TenDN  = '$maGV'
				AND Tiet > 4
				AND Ngay = '$ngay'
				ORDER BY Tiet ASC";
				$table =  mysqli_query($con, $chuoi);
				$p->dongketnoi($con);
				return $table;
			}else{
				return false;
			}
		}
		function chonlichchoGV1($maGV, $ngay){
			$con;
			$p = new clsketnoi();
			$ngay=date('Y-m-d', strtotime($ngay));
			if ($p->ketnoidb($con)){
				$chuoi="SELECT *
				FROM `lichhocvsgiangday`
				JOIN lophoc ON lophoc.MaLopHoc = lichhocvsgiangday.MaLopHoc
				JOIN giaovien ON giaovien.MaGV = lophoc.MaGV
				WHERE giaovien.TenDN  = '$maGV'
				AND Tiet < 3
				AND Ngay = '$ngay'
				ORDER BY Tiet ASC";
				$table =  mysqli_query($con, $chuoi);
				$p->dongketnoi($con);
				return $table;
			}else{
				return false;
			}
		}
		function chonlichchoHS2($mahs, $ngay){
			$con;
			$p = new clsketnoi();
			$ngay=date('Y-m-d', strtotime($ngay));
			if ($p->ketnoidb($con)){
				$chuoi="SELECT *
				FROM `lichhocvsgiangday`
                JOIN lophoc on lophoc.MaLopHoc = lichhocvsgiangday.MaLopHoc
                JOIN ctlophoc on ctlophoc.MaLopHoc = lichhocvsgiangday.MaLopHoc
                JOIN giaovien on giaovien.MaGV = lophoc.MaGV
                JOIN ctlichhoc on ctlichhoc.MaLopHoc = lichhocvsgiangday.MaLopHoc
                WHERE ctlophoc.MaHocSinh = $mahs
				AND Tiet >2 and Tiet <5
				AND Ngay = '$ngay'
				GROUP BY lichhocvsgiangday.MaLich
				ORDER BY Tiet ASC";
				$table =  mysqli_query($con, $chuoi);
				$p->dongketnoi($con);
				return $table;
			}else{
				return false;
			}
		}
		function chonlichchoHS3($mahs, $ngay){
			$con;
			$p = new clsketnoi();
			$ngay=date('Y-m-d', strtotime($ngay));
			if ($p->ketnoidb($con)){
				$chuoi="SELECT *
				FROM `lichhocvsgiangday`
                JOIN lophoc on lophoc.MaLopHoc = lichhocvsgiangday.MaLopHoc
                JOIN ctlophoc on ctlophoc.MaLopHoc = lichhocvsgiangday.MaLopHoc
                JOIN giaovien on giaovien.MaGV = lophoc.MaGV
                JOIN ctlichhoc on ctlichhoc.MaLopHoc = lichhocvsgiangday.MaLopHoc
                WHERE ctlophoc.MaHocSinh = $mahs
				AND Tiet > 4
				AND Ngay = '$ngay'
				GROUP BY lichhocvsgiangday.MaLich
				ORDER BY Tiet ASC";
				$table =  mysqli_query($con, $chuoi);
				$p->dongketnoi($con);
				return $table;
			}else{
				return false;
			}
		}
		// chon lich cho hoc sinh
		function chonlichchoHS1($mahs, $ngay){
			$con;
			$p = new clsketnoi();
			$ngay=date('Y-m-d', strtotime($ngay));
			if ($p->ketnoidb($con)){
				$chuoi="SELECT *
				FROM `lichhocvsgiangday`
                JOIN lophoc on lophoc.MaLopHoc = lichhocvsgiangday.MaLopHoc
                JOIN ctlophoc on ctlophoc.MaLopHoc = lichhocvsgiangday.MaLopHoc
                JOIN giaovien on giaovien.MaGV = lophoc.MaGV
                JOIN ctlichhoc on ctlichhoc.MaLopHoc = lichhocvsgiangday.MaLopHoc
                WHERE ctlophoc.MaHocSinh = $mahs
				AND Tiet < 3
				AND Ngay = '$ngay'
				GROUP BY lichhocvsgiangday.MaLich
				ORDER BY Tiet ASC";
				$table =  mysqli_query($con, $chuoi);
				$p->dongketnoi($con);
				return $table;
			}else{
				return false;
			}
		}
		//
		
		function laytietvabuoi($malop, $so){
			$con;
			$p = new clsketnoi();
			if ($p->ketnoidb($con)){
				$chuoi="SELECT * FROM `ctlichhoc` 
				JOIN tiet on tiet.MaTiet = ctlichhoc.MaTiet 
				JOIN thu on thu.MaThu = ctlichhoc.MaThu 
				JOIN lophoc on lophoc.MaLopHoc = ctlichhoc.MaLopHoc
				WHERE ctlichhoc.MaLopHoc = $malop
				LIMIT $so,1";
				$table =  mysqli_query($con, $chuoi);
				$p->dongketnoi($con);
				return $table;
			}else{
				return false;
			}
		}
		function CapNhatTrangThaiThanhMo($malop){
			$con;
			$p = new clsketnoi();
			if ($p->ketnoidb($con)){
				$chuoi="UPDATE lophoc set TrangThai = 2 WHERE MaLopHoc = $malop";
				$table =  mysqli_query($con, $chuoi);
				$p->dongketnoi($con);
				return $table;
			}else{
				return false;
			}
		}
		function chonthemlich($lophoc, $TimeBD, $TimeKT, $thu, $tiet, $id, $pass, $gvtructiep){
			$con;
			date_default_timezone_set('Asia/Ho_Chi_Minh');
			$p = new clsketnoi();
			if ($p->ketnoidb($con)){
				$kq = 0;
				while(strtotime($TimeBD) <= strtotime($TimeKT)){
					//đổi ngày thành chuỗi
					$TimeBD = strtotime($TimeBD);
					$ngay = date ("d", $TimeBD);
                    $thang = date("m", $TimeBD);
                    $nam = date("Y", $TimeBD);
					//tính thứ của ngày
					$thu1 = date ("l", $TimeBD);
					$thu1 = strtolower($thu1);
					switch ($thu1) {
						case 'monday':
							$thu1 = 1;
							break;
						case 'tuesday':
							$thu1 = 2;
							break;
						case 'wednesday':
							$thu1= 3;
							break;
						case 'thursday':
							$thu1= 4;
							break;
						case 'friday':
							$thu1 =5;
							break;
						case 'saturday':
							$thu1 =6;
							break;
						default:
							$thu1 =7;
							break;
					}
					// đổi chuỗi thành ngày
					$TimeBD = strftime("%Y-%m-%d", $TimeBD);
					if($thu1 == $thu){
						//echo "<script>alert('Thứ hôm nay = ".$thu1."Và Thứ thêm =".$thu."')</script>";
						$chuoi="INSERT INTO `lichhocvsgiangday` (`MaLich`, `MaLopHoc`, `GVTrucTiep`, `Ngay`, `Tiet`, `Thu`, `Id`, `Pass`, `GhiChu`, `TrangThaiBuoiHoc`) 
						VALUES (NULL, '$lophoc', '$gvtructiep', '$TimeBD', '$tiet', '$thu1', '$id', '$pass', NULL, 0);";
						$table =  mysqli_query($con, $chuoi);
						if($table){
							$kq= 1;
						}
					}
					//cộng ngày
					$TimeBD = mktime(0, 0, 0, $thang , $ngay+1, $nam);//
					//đổi chuỗi thành ngày
					$TimeBD = strftime("%Y-%m-%d", $TimeBD);
				}
				$p->dongketnoi($con);
				if($kq == 1){
					return $kq;
				}else{
					return false;
				}
			}else{
				return false;
			}
		}
		function themlichhocbu($lophoc, $gvtructiep, $TimeBD, $tiet, $thu, $id, $pass, $ghichu){
			$con;
			$p = new clsketnoi();
			if ($p->ketnoidb($con)){
				$chuoi="INSERT INTO `lichhocvsgiangday` (`MaLich`, `MaLopHoc`, `GVTrucTiep`, `Ngay`, `Tiet`, `Thu`, `Id`, `Pass`, `GhiChu`, `TrangThaiBuoiHoc`) 
				VALUES (NULL, '$lophoc', '$gvtructiep', '$TimeBD', '$tiet', '$thu', '$id', '$pass', '$ghichu', 2);";
				$kq =  mysqli_query($con, $chuoi);
				$p->dongketnoi($con);
				return $kq;
			}else{
				return false;
			}
		}
		function updatetrangthailop($malop){
			$con;
			$p = new clsketnoi();
			if ($p->ketnoidb($con)){
				$chuoi="UPDATE lophoc set TrangThai = 3 WHERE MaLopHoc = $malop";
				$kq =  mysqli_query($con, $chuoi);
				$p->dongketnoi($con);
				return $kq;
			}else{
				return false;
			}
		}
		// chọn 1 lịch cho quản lí
		function chon1lich($malich){
			$con;
			$p = new clsketnoi();
			if ($p->ketnoidb($con)){
				$chuoi="SELECT * FROM `lichhocvsgiangday`
				JOIN giaovien on giaovien.MaGV = lichhocvsgiangday.GVTrucTiep WHERE MaLich = $malich";
				$table =  mysqli_query($con, $chuoi);
				$p->dongketnoi($con);
				return $table;
			}else{
				return false;
			}
		}
		// chọn lịch cho quản lí
		function chonlichchoQL(){
			$con;
			$p = new clsketnoi();
			if ($p->ketnoidb($con)){
				$chuoi="SELECT MaLich, Thu, GhiChu, 
				Ngay, TenMonHoc, TenLop, TenGV, Tiet, lichhocvsgiangday.MaLopHoc, lichhocvsgiangday.MaMonHoc, lichhocvsgiangday.MaGV 
				FROM `lichhocvsgiangday` 
				JOIN giaovien ON giaovien.MaGV = lichhocvsgiangday.MaGV 
				JOIN lophoc ON lophoc.MaLopHoc = lichhocvsgiangday.MaLopHoc 
				JOIN monhoc ON monhoc.MaMonHoc = lichhocvsgiangday.MaMonHoc 
				GROUP BY lichhocvsgiangday.MaLopHoc, lichhocvsgiangday.MaMonHoc";
				$table =  mysqli_query($con, $chuoi);
				$p->dongketnoi($con);
				return $table;
			}else{
				return false;
			}
		}
		// chọn lịch cho quản lí theo tiet
		function chonlichtheotietchoQL($malop){
			$con;
			$p = new clsketnoi();
			if ($p->ketnoidb($con)){
				$chuoi="SELECT * FROM `ctlichhoc` 
				JOIN tiet on tiet.MaTiet = ctlichhoc.MaTiet 
				JOIN thu on thu.MaThu = ctlichhoc.MaThu
                JOIN lophoc on lophoc.MaLopHoc = ctlichhoc.MaLopHoc
				WHERE ctlichhoc.MaLopHoc = $malop;";
				$table =  mysqli_query($con, $chuoi);
				$p->dongketnoi($con);
				return $table;
			}else{
				return false;
			}
		}
		function ALLlichtheoNgay($malop, $tiet, $thu){
			$con;
			$ngay = date('Y-m-d');
			$p = new clsketnoi();
			if ($p->ketnoidb($con)){
				$chuoi="SELECT *
				FROM `lichhocvsgiangday` 
				WHERE MaLopHoc = $malop
				and Tiet = $tiet and Thu = $thu
				AND ngay >= '$ngay'";
				$table =  mysqli_query($con, $chuoi);
				$p->dongketnoi($con);
				return $table;
			}else{
				return false;
			}
		}
		// chọn lịch cho quản lí theo ngày chưa học
		function chonlichtheongaychoQL($malop, $tiet, $thu){
			$con;
			$ngay = date('Y-m-d');
			$p = new clsketnoi();
			if ($p->ketnoidb($con)){
				$chuoi="SELECT *
				FROM `lichhocvsgiangday` 
				WHERE MaLopHoc = $malop
				and Tiet = $tiet and Thu = $thu
				AND ngay >= '$ngay'  AND TrangThaiBuoiHoc = 1";
				$table =  mysqli_query($con, $chuoi);
				$p->dongketnoi($con);
				return $table;
			}else{
				return false;
			}
		}
		// chọn lịch cho quản lí theo ngày đã học
		function chonlichtheongaychoQL1($malop, $tiet, $thu){
			$con;
			$ngay = date('Y-m-d');
			$p = new clsketnoi();
			if ($p->ketnoidb($con)){
				$chuoi="SELECT *
				FROM `lichhocvsgiangday` 
				WHERE MaLopHoc = $malop
				and Tiet = $tiet and Thu = $thu
				AND ngay < '$ngay' AND TrangThaiBuoiHoc = 1";
				$table =  mysqli_query($con, $chuoi);
				$p->dongketnoi($con);
				return $table;
			}else{
				return false;
			}
		}
		// chọn lịch cho quản lí theo ngày lịch bù
		function chonlichtheongaybuchoQL($malop){
			$con;
			$p = new clsketnoi();
			if ($p->ketnoidb($con)){
				$chuoi="SELECT *
				FROM `lichhocvsgiangday` 
				JOIN ctlichhoc on lichhocvsgiangday.MaLopHoc = ctlichhoc.MaLopHoc
				JOIN tiet on tiet.MaTiet = lichhocvsgiangday.Tiet 
				JOIN thu on thu.MaThu = lichhocvsgiangday.Thu
                JOIN lophoc on lophoc.MaLopHoc = ctlichhoc.MaLopHoc
				WHERE lichhocvsgiangday.MaLopHoc = $malop
				AND TrangThaiBuoiHoc = 2
				GROUP BY MaLich
				ORDER BY Ngay DESC";
				$table =  mysqli_query($con, $chuoi);
				$p->dongketnoi($con);
				return $table;
			}else{
				return false;
			}
		}
		// chọn lịch cho quản lí để update2
		function chonlichtheongaychoQL2($malop, $mamonhoc, $tiet, $thu){
			$con;
			$p = new clsketnoi();
			if ($p->ketnoidb($con)){
				$chuoi="SELECT MaLich, GhiChu, 
				Ngay, Thu, TenMonHoc, TenLop, TenGV, Tiet, lichhocvsgiangday.MaLopHoc, lichhocvsgiangday.MaMonHoc, lichhocvsgiangday.MaGV 
				FROM `lichhocvsgiangday` 
				JOIN giaovien ON giaovien.MaGV = lichhocvsgiangday.MaGV 
				JOIN lophoc ON lophoc.MaLopHoc = lichhocvsgiangday.MaLopHoc 
				JOIN monhoc ON monhoc.MaMonHoc = lichhocvsgiangday.MaMonHoc 
				WHERE lichhocvsgiangday.MaLopHoc = $malop AND lichhocvsgiangday.MaMonHoc = $mamonhoc 
				 and Tiet = $tiet and Thu = '$thu'";
				$table =  mysqli_query($con, $chuoi);
				$p->dongketnoi($con);
				return $table;
			}else{
				return false;
			}
		}
		// tính ngày kết thúc
		function chonngayketthuc($malh){
			$con;
			$p = new clsketnoi();
			if ($p->ketnoidb($con)){
				$chuoi="SELECT MAX(Ngay) FROM `lichhocvsgiangday` 
				WHERE MaLopHoc = $malh";
				$table =  mysqli_query($con, $chuoi);
				$p->dongketnoi($con);
				return $table;
			}else{
				return false;
			}
		}
		// update 1
		function chonupdate1chhoc($malop, $maGV){
			$con;
			$ngay = date('Y-m-d');
			$p = new clsketnoi();
			if ($p->ketnoidb($con)){
				$chuoi="UPDATE `lichhocvsgiangday` SET `GVTrucTiep`= $maGV WHERE MaLopHoc = $malop
				and Ngay >= '$ngay'";
				$table =  mysqli_query($con, $chuoi);
				$p->dongketnoi($con);
				return $table;
			}else{
				return false;
			}
		}
		function chonupdateIdchhoc($malop, $id, $pass){
			$con;
			$ngay = date('Y-m-d');
			$p = new clsketnoi();
			if ($p->ketnoidb($con)){
				$chuoi="UPDATE lichhocvsgiangday SET Id = '$id', Pass = '$pass'
				WHERE MaLopHoc = $malop AND Ngay >= '$ngay'";
				$table =  mysqli_query($con, $chuoi);
				$p->dongketnoi($con);
				return $table;
			}else{
				return false;
			}
		}
		function chonupdatebuoichhoc($malop, $id, $pass){
			$con;
			$ngay = date('Y-m-d');
			$p = new clsketnoi();
			if ($p->ketnoidb($con)){
				$chuoi="UPDATE lichhocvsgiangday SET Id = '$id', Pass = '$pass'
				WHERE MaLopHoc = $malop AND Ngay >= '$ngay'";
				$table =  mysqli_query($con, $chuoi);
				$p->dongketnoi($con);
				return $table;
			}else{
				return false;
			}
		}
		// update 1
		function chonupdate1lophoc($malop, $maGV){
			$con;
			$p = new clsketnoi();
			if ($p->ketnoidb($con)){
				$chuoi="UPDATE lophoc SET MaGV = $maGV WHERE MaLopHoc = $malop";
				$table =  mysqli_query($con, $chuoi);
				$p->dongketnoi($con);
				return $table;
			}else{
				return false;
			}
		}
		// update 12
		function chonupdate1chitietlophoc($malop, $maGV, $tenlop, $siso, $ngay, $hocphi, $id, $pass){
			$con;
			$p = new clsketnoi();
			if ($p->ketnoidb($con)){
				$chuoi="UPDATE `lophoc` 
				SET `TenLop` = '$tenlop', `SiSo` = '$siso', `MaGV` = '$maGV', `NgayBD` = '$ngay', `HocPhi` = '$hocphi', `IdChinh` = '$id', `PassChinh` = '$pass'
				WHERE `lophoc`.`MaLopHoc` = $malop;";
				$table =  mysqli_query($con, $chuoi);
				$p->dongketnoi($con);
				return $table;
			}else{
				return false;
			}
		}
		// update 13
		function chonupdate13lophoc($malop, $id, $pass){
			$con;
			$p = new clsketnoi();
			if ($p->ketnoidb($con)){
				$chuoi="UPDATE `lophoc` 
				SET `IdChinh` = '$id', `PassChinh` = '$pass'
				WHERE `lophoc`.`MaLopHoc` = $malop;";
				$table =  mysqli_query($con, $chuoi);
				$p->dongketnoi($con);
				return $table;
			}else{
				return false;
			}
		}
		function chonupdate13lich($malop, $id, $pass){
			$ngay = date('Y-m-d');
			$con;
			$p = new clsketnoi();
			if ($p->ketnoidb($con)){
				$chuoi="UPDATE `lichhocvsgiangday` 
				SET  Id = '$id', Pass = '$pass'
				WHERE`MaLopHoc` = $malop AND Ngay >= '$ngay';";
				$table =  mysqli_query($con, $chuoi);
				$p->dongketnoi($con);
				return $table;
			}else{
				return false;
			}
		}
		function chonupdate1chitietbuoihoc($malop, $thumoi, $tietmoi, $thucu, $tietcu){
			$con;
			$p = new clsketnoi();
			if ($p->ketnoidb($con)){
				$chuoi="UPDATE `ctlichhoc` SET `MaThu` = '$thumoi', `MaTiet` = '$tietmoi'
				 WHERE `ctlichhoc`.`MaLopHoc` = $malop AND `ctlichhoc`.`MaThu` = $thucu AND `ctlichhoc`.`MaTiet` = $tietcu;";
				$table =  mysqli_query($con, $chuoi);
				$p->dongketnoi($con);
				return $table;
			}else{
				return false;
			}
		}
		// update 2
		function chonupdate2chhoc($malop, $tiet, $thu, $tietup, $thuup, $ngayhoc, $ngayhocgoc){
			$con;
			$p = new clsketnoi();
			if ($p->ketnoidb($con)){
				//echo "<script>alert('".$tietup."')</script>";
			$songaychenh = $thuup - $thu; //-2
					//đổi ngày thành chuỗi
					$ngayhoc = strtotime($ngayhoc);
					$ngay = date ("d", $ngayhoc);
					$thang = date("m", $ngayhoc);
					$nam = date("Y", $ngayhoc);
					//cộng ngày
					$ngayhoc = mktime(0, 0, 0, $thang , $ngay + $songaychenh, $nam);//
					//đổi chuỗi thành ngày
					$ngayhoc = strftime("%Y-%m-%d", $ngayhoc);
					//chạy quẻy
					$chuoi="UPDATE
					`lichhocvsgiangday`
				SET
					Tiet = $tietup,
					Thu = '$thuup',
					Ngay = '$ngayhoc'
				WHERE
					 MaLopHoc = $malop  AND Tiet = $tiet AND Thu = '$thu' 
					AND Ngay = '$ngayhocgoc'";
					$table =  mysqli_query($con, $chuoi);
					if($table){
					}else{
						return 0; //không thể chèn
					}
				
			return 1;
			$p->dongketnoi($con);
			}else{
				return false;
			}
		}
		function updateChitietBuoiCu($malop, $thu, $tiet){
			$con;
			$p = new clsketnoi();
			if ($p->ketnoidb($con)){
				$chuoi="UPDATE `ctlichhoc` SET `TrangThaiLich` = '2' 
				WHERE `ctlichhoc`.`MaLopHoc` = $malop AND `ctlichhoc`.`MaThu` = $thu AND `ctlichhoc`.`MaTiet` = $tiet";
				$table =  mysqli_query($con, $chuoi);
				$p->dongketnoi($con);
				return $table;
			}else{
				return false;
			}
		}
		//update 3 lịch bù
		function chonupdate3($malich, $tiet, $ngay, $magv, $ghichu, $thu, $id, $pass){
			$con;
			$p = new clsketnoi();
			if ($p->ketnoidb($con)){
				$chuoi="UPDATE `lichhocvsgiangday` 
				SET `Ngay` = '$ngay', `Tiet` = '$tiet', `Thu` = '$thu', GVTrucTiep = $magv,
									 GhiChu = '$ghichu', Id = '$id', Pass = '$pass', TrangThaiBuoiHoc = 2
				 WHERE `lichhocvsgiangday`.`MaLich` = $malich";
				$table =  mysqli_query($con, $chuoi);
				$p->dongketnoi($con);
				return $table;
			}else{
				return false;
			}
		}
		//update đổi giáo viên dạy bù
		function chonupdate33($malich, $magv, $ghichu, $id, $pass){
			$con;
			$p = new clsketnoi();
			if ($p->ketnoidb($con)){
				$chuoi="UPDATE `lichhocvsgiangday` 
				SET  GVTrucTiep = $magv, GhiChu = '$ghichu', Id = '$id', Pass = '$pass'
				 WHERE `lichhocvsgiangday`.`MaLich` = $malich";
				$table =  mysqli_query($con, $chuoi);
				$p->dongketnoi($con);
				return $table;
			}else{
				return false;
			}
		}
		//update đổi id buổi học
		function chonupdate333($malich, $ghichu, $id, $pass){
			$con;
			$p = new clsketnoi();
			if ($p->ketnoidb($con)){
				$chuoi="UPDATE `lichhocvsgiangday` 
				SET  GhiChu = '$ghichu', Id = '$id', Pass = '$pass'
				 WHERE `lichhocvsgiangday`.`MaLich` = $malich";
				$table =  mysqli_query($con, $chuoi);
				$p->dongketnoi($con);
				return $table;
			}else{
				return false;
			}
		}
		// lấy số môn học cho học sinh
		function chonsomonhocchohs($MA){
			$con;
			$p = new clsketnoi();
			if ($p->ketnoidb($con)){
				$chuoi="SELECT * FROM lophoc 
				JOIN ctlophoc ON ctlophoc.MaLopHoc = lophoc.MaLopHoc
				JOIN giaovien on giaovien.MaGV = lophoc.MaGV
				WHERE ctlophoc.MaHocSinh = $MA AND TrangThai = 3;";
				$table =  mysqli_query($con, $chuoi);
				$p->dongketnoi($con);
				return $table;
			}else{
				return false;
			}
		}
		function chonxoalich1($malophoc, $mamonhoc){
			$con;
			$ngayhomnay = date('Y-m-d');
			$p = new clsketnoi();
			if ($p->ketnoidb($con)){
				$chuoi="DELETE FROM lichhocvsgiangday WHERE 
				MaMonHoc = $mamonhoc AND MaLopHoc = $malophoc AND Ngay >= '$ngayhomnay'";
				$table =  mysqli_query($con, $chuoi);
				$p->dongketnoi($con);
				return $table;
			}else{
				return false;
			}
		}
		function chonxoalich2($malophoc, $mamonhoc, $tiet, $thu){
			$con;
			$ngayhomnay = date('Y-m-d');
			$p = new clsketnoi();
			if ($p->ketnoidb($con)){
				$chuoi="DELETE FROM lichhocvsgiangday WHERE 
				MaMonHoc = $mamonhoc AND MaLopHoc = $malophoc AND Tiet = $tiet AND Thu = '$thu' AND Ngay >= '$ngayhomnay'";
				$table =  mysqli_query($con, $chuoi);
				$p->dongketnoi($con);
				return $table;
			}else{
				return false;
			}
		}
		function chonxoalich3($malich){
			$con;
			$p = new clsketnoi();
			if ($p->ketnoidb($con)){
				$chuoi="DELETE FROM lichhocvsgiangday WHERE `lichhocvsgiangday`.`MaLich` = $malich";
				$table =  mysqli_query($con, $chuoi);
				$p->dongketnoi($con);
				return $table;
			}else{
				return false;
			}
		}
		function lichchitiet($malop){
			$con;
			$p = new clsketnoi();
			if ($p->ketnoidb($con)){
				$chuoi="SELECT * FROM `ctlichhoc` 
				JOIN thu ON ctlichhoc.MaThu = thu.MaThu 
				JOIN tiet ON ctlichhoc.MaTiet = tiet.MaTiet 
				WHERE MaLopHoc = $malop AND TrangThaiLich = 1";
				$table =  mysqli_query($con, $chuoi);
				$p->dongketnoi($con);
				return $table;
			}else{
				return false;
			}
		}
		function xoalichchuahoc($malop){
			$con;
			$p = new clsketnoi();
			if ($p->ketnoidb($con)){
				$chuoi="DELETE FROM lichhocvsgiangday WHERE MaLopHoc = $malop";
				$table =  mysqli_query($con, $chuoi);
				$p->dongketnoi($con);
				return $table;
			}else{
				return false;
			}
		}
		function xoalichthaydoi($malop, $ngay){
			$con;
			$p = new clsketnoi();
			if ($p->ketnoidb($con)){
				$chuoi="DELETE FROM lichhocvsgiangday WHERE MaLopHoc = $malop and Ngay < '$ngay' ";
				$table =  mysqli_query($con, $chuoi);
				$p->dongketnoi($con);
				return $table;
			}else{
				return false;
			}
		}
	}
?>