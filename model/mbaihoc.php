<?php 
	include_once("ketnoi.php");
	class modelbaihoc{
		function chonbaihocThongbao($malop){
			$con;
			$p = new clsketnoi();
			if ($p->ketnoidb($con)){
				$chuoi="SELECT *
                FROM `baihoc`
                WHERE MaLopHoc = $malop  and baihoc.ChuDe = 1";
				$table =  mysqli_query($con, $chuoi);
				$p->dongketnoi($con);
				return $table;
			}else{
				return false;
			}
		}
		function chonbaihocTailieu($malop){
			$con;
			$p = new clsketnoi();
			if ($p->ketnoidb($con)){
				$chuoi="SELECT *
                FROM `baihoc`
                WHERE MaLopHoc = $malop  and baihoc.ChuDe = 2";
				$table =  mysqli_query($con, $chuoi);
				$p->dongketnoi($con);
				return $table;
			}else{
				return false;
			}
		}
		function chonbaihocBaitap( $malop){
			$con;
			$p = new clsketnoi();
			if ($p->ketnoidb($con)){
				$chuoi="SELECT *
                FROM `baihoc`
                WHERE MaLopHoc = $malop  and baihoc.ChuDe = 3";
				$table =  mysqli_query($con, $chuoi);
				$p->dongketnoi($con);
				return $table;
			}else{
				return false;
			}
		}
        function chon1baihoc($mabh){
			$con;
			$p = new clsketnoi();
			if ($p->ketnoidb($con)){
				$chuoi="SELECT *
                FROM `baihoc`
                JOIN giaovien ON giaovien.MaGV = baihoc.MaGV
                WHERE baihoc.MaBH = $mabh";
				$table =  mysqli_query($con, $chuoi);
				$p->dongketnoi($con);
				return $table;
			}else{
				return false;
			}
		}
		function chonthemthongbao($tieude, $ghichu, $malop){
			$con;
			$p = new clsketnoi();
			if ($p->ketnoidb($con)){
				$chuoi="INSERT INTO `baihoc` (`MaBH` ,`TieuDe` ,`File` ,`GhiChu` ,`ChuDe` ,`MaLopHoc`)
				VALUES (NULL , '$tieude', NULL , '$ghichu', '1', $malop);";
				$table =  mysqli_query($con, $chuoi);
				$p->dongketnoi($con);
				return $table;
			}else{
				return false;
			}
		}
		function chonupdatethongbao($tieude, $ghichu, $mabh){
			$con;
			$p = new clsketnoi();
			if ($p->ketnoidb($con)){
				$chuoi="UPDATE `baihoc` SET `TieuDe` = '$tieude', `GhiChu` = '$ghichu' 
				WHERE `baihoc`.`MaBH` = $mabh";
				$table =  mysqli_query($con, $chuoi);
				$p->dongketnoi($con);
				return $table;
			}else{
				return false;
			}
		}
		function chonthemtailieu($tieude, $ghichu, $malop, $tenfile){
			$con;
			$p = new clsketnoi();
			if ($p->ketnoidb($con)){
				$chuoi="INSERT INTO `baihoc` (`MaBH` ,`TieuDe` ,`File` ,`GhiChu` ,`ChuDe` ,`MaLopHoc`)
				VALUES (NULL , '$tieude', '$tenfile' , '$ghichu', '2', $malop);";
				$table =  mysqli_query($con, $chuoi);
				$p->dongketnoi($con);
				return $table;
			}else{
				return false;
			}
		}
		function chonthembaitap($tieude, $ghichu, $malop, $tenfile){
			$con;
			$p = new clsketnoi();
			if ($p->ketnoidb($con)){
				$chuoi="INSERT INTO `baihoc` (`MaBH` ,`TieuDe` ,`File` ,`GhiChu` ,`ChuDe` ,`MaLopHoc`)
				VALUES (NULL , '$tieude', '$tenfile' , '$ghichu', '3', $malop);";
				$table =  mysqli_query($con, $chuoi);
				$p->dongketnoi($con);
				return $table;
			}else{
				return false;
			}
		}
		function chonupdatetailieuCoFile($tieude, $ghichu, $mabh, $file){
			$con;
			$p = new clsketnoi();
			if ($p->ketnoidb($con)){
				$chuoi="UPDATE `baihoc` SET `TieuDe` = '$tieude', `GhiChu` = '$ghichu' , `File` = '$file'
				WHERE `baihoc`.`MaBH` = $mabh";
				$table =  mysqli_query($con, $chuoi);
				$p->dongketnoi($con);
				return $table;
			}else{
				return false;
			}
		}
		function chonupdatetailieuKFile($tieude, $ghichu, $mabh){
			$con;
			$p = new clsketnoi();
			if ($p->ketnoidb($con)){
				$chuoi="UPDATE `baihoc` SET `TieuDe` = '$tieude', `GhiChu` = '$ghichu' 
				WHERE `baihoc`.`MaBH` = $mabh";
				$table =  mysqli_query($con, $chuoi);
				$p->dongketnoi($con);
				return $table;
			}else{
				return false;
			}
		}
		function xoabaihoc($mabh){
			$con;
			$p=new clsketnoi();
			$p->ketnoiDB($con);
			$string="DELETE FROM baihoc WHERE MABH='$mabh'";
			$kq=mysqli_query($con,$string);
			$p->dongketnoi($con);
			return $kq;
		}
		function chonbaihocchoHS($maGV, $malop){
			$con;
			$p = new clsketnoi();
			if ($p->ketnoidb($con)){
				$chuoi="SELECT *
                FROM `baihoc`
                JOIN giaovien ON giaovien.MaGV = baihoc.MaGV
                JOIN monhoc ON monhoc.MaMonHoc = baihoc.MaMonHoc
                WHERE giaovien.MaGV = '$maGV' AND baihoc.MaMonHoc = $malop;";
				$table =  mysqli_query($con, $chuoi);
				$p->dongketnoi($con);
				return $table;
			}else{
				return false;
			}
		}
	}
?>