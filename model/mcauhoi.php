<?php 
	include_once("ketnoi.php");
	class modelcauhoi{
		function chon1chtn($mach){
			$con;
			$p = new clsketnoi();
			if ($p->ketnoidb($con)){
				$chuoi="SELECT *
				FROM `cauhoitn` 
				WHERE `MaCHTN` = $mach";
				$table =  mysqli_query($con, $chuoi);
				$p->dongketnoi($con);
				return $table;
			}else{
				return false;
			}
		}
		function chonupdatechtn($mach, $da){
			$con;
			$p = new clsketnoi();
			if ($p->ketnoidb($con)){
				$chuoi="UPDATE `cauhoitn` SET 
				`DapAn` = '$da' WHERE `MaCHTN` = $mach";
				$table =  mysqli_query($con, $chuoi);
				$p->dongketnoi($con);
				return $table;
			}else{
				return false;
			}
		}
		// hien thi cau hoi trac nghiem cho de thi
		function chonchtheode($makt){
			$con;
			$p = new clsketnoi();
			if ($p->ketnoidb($con)){
				$chuoi="SELECT *
				FROM `cauhoitn`
				WHERE MaKT = $makt";
				$table =  mysqli_query($con, $chuoi);
				$p->dongketnoi($con);
				return $table;
			}else{
				return false;
			}
		}
		// xoa cau hoi cho cau trac nghiem
		function xoachtn($mach){
			$con;
			$p=new clsketnoi();
			$p->ketnoiDB($con);
			$string="DELETE FROM cauhoitn WHERE MaCHTN = '$mach'";
			$kq=mysqli_query($con,$string);
			$p->dongketnoi($con);
			return $kq;
		}
		//them cau tn
		function chonthemchtn( $makt, $da, $diem){
			$con;
			$p=new clsketnoi();
			$p->ketnoiDB($con);
			$string="INSERT INTO `cauhoitn` (`MaCHTN`, `DapAn`, `SoDiem`, `MaKT`) 
			VALUES (NULL, '$da', '$diem', '$makt');";
			$kq=mysqli_query($con,$string);
			$p->dongketnoi($con);
			return $kq;
		}
	}
?>