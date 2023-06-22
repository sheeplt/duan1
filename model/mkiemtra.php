<?php 
	include_once("ketnoi.php");
	class modelkiemtra{
		function chonktra($maLh){
			$con;
			$p = new clsketnoi();
			if ($p->ketnoidb($con)){
				$chuoi="SELECT *
                FROM `dekiemtra`
                JOIN giaovien ON giaovien.MaGV = dekiemtra.MaGV
				JOIN ctkiemtra on ctkiemtra.MaKT = dekiemtra.MaKT
                WHERE ctkiemtra.MaLopHoc = $maLh";
				$table =  mysqli_query($con, $chuoi);
				$p->dongketnoi($con);
				return $table;
			}else{
				return false;
			}
		}
		function chonktraChthem($maLh, $magv){
			$con;
			$p = new clsketnoi();
			if ($p->ketnoidb($con)){
				$chuoi="SELECT * FROM `dekiemtra` 
				WHERE dekiemtra.MaKT not in (SELECT MaKT FROM ctkiemtra WHERE MaLopHoc = $maLh) AND MaGV = $magv
				;";
				$table =  mysqli_query($con, $chuoi);
				$p->dongketnoi($con);
				return $table;
			}else{
				return false;
			}
		}
        function chon1ktra($makt, $malop){
			$con;
			$p = new clsketnoi();
			if ($p->ketnoidb($con)){
				$chuoi="SELECT * FROM `dekiemtra` 
				JOIN ctkiemtra on ctkiemtra.MaKT = dekiemtra.MaKT 
				JOIN lophoc on ctkiemtra.MaLopHoc = lophoc.MaLopHoc 
				JOIN giaovien ON giaovien.MaGV = lophoc.MaGV
                WHERE ctkiemtra.MaKT = $makt and ctkiemtra.MaLopHoc = $malop";
				$table =  mysqli_query($con, $chuoi);
				$p->dongketnoi($con);
				return $table;
			}else{
				return false;
			}
		}
		// danh sách câu hỏi kiếm tra trắc nghiệm theo đề
        function chonktravan($makt){
			$con;
			$p = new clsketnoi();
			if ($p->ketnoidb($con)){
				$chuoi="SELECT *
                FROM `dekiemtra`
                WHERE dekiemtra.MaKT = $makt";
				$table =  mysqli_query($con, $chuoi);
				$p->dongketnoi($con);
				return $table;
			}else{
				return false;
			}
		}
		// danh sách câu hỏi kiếm tra trắc nghiệm theo đề
        function chonktratn($makt){
			$con;
			$p = new clsketnoi();
			if ($p->ketnoidb($con)){
				$chuoi="SELECT *
                FROM `dekiemtra`
                JOIN cauhoitn ON cauhoitn.MaKT = dekiemtra.MaKT
                WHERE dekiemtra.MaKT = $makt";
				$table =  mysqli_query($con, $chuoi);
				$p->dongketnoi($con);
				return $table;
			}else{
				return false;
			}
		}
		// danh sách câu hỏi kiếm tra trắc nghiệm theo đề (1 câu)
        function chonktratn1($makt, $so){
			$con;
			$p = new clsketnoi();
			if ($p->ketnoidb($con)){
				$chuoi="SELECT *
                FROM `dekiemtra`
				JOIN cauhoitn ON cauhoitn.MaKT = dekiemtra.MaKT
                WHERE dekiemtra.MaKT = $makt
				Limit $so, 1";
				$table =  mysqli_query($con, $chuoi);
				$p->dongketnoi($con);
				return $table;
			}else{
				return false;
			}
		}
		function chonupdatekt($makt, $time, $tieude){
			$con;
			$p = new clsketnoi();
			if ($p->ketnoidb($con)){
				$chuoi="UPDATE `truongcap1`.`dekiemtra` SET `Time` = '$time',
				`TieuDe` = '$tieude'
				 WHERE `MaKT` = $makt";
				$table =  mysqli_query($con, $chuoi);
				$p->dongketnoi($con);
				return $table;
			}else{
				return false;
			}
		}
		function chonupdatectkt($makt, $malop, $timebd, $timekt){
			$con;
			$p = new clsketnoi();
			if ($p->ketnoidb($con)){
				$chuoi="UPDATE `truongcap1`.`ctkiemtra` SET 
				`TimeBD` = '$timebd',
				`TimeKT` = '$timekt'
				 WHERE `MaKT` = $makt and `MaLopHoc` = $malop";
				$table =  mysqli_query($con, $chuoi);
				$p->dongketnoi($con);
				return $table;
			}else{
				return false;
			}
		}
		function chonthemkt($time, $tieude, $magv, $tenmoi){
			$con;
			$p = new clsketnoi();
			if ($p->ketnoidb($con)){
				$chuoi="INSERT INTO `dekiemtra` (`MaKT`, `Time`, `TieuDe`, `MaGV`, `FileDe`) VALUES (NULL, '$time', '$tieude', '$magv', '$tenmoi');";
				$table =  mysqli_query($con, $chuoi);
				$last_id = $con->insert_id;
				if($table){
					return $last_id;
				}else{
					return 0; //không thể chèn
				}
				$p->dongketnoi($con);
				return $table;
			}else{
				return false;
			}
		}
		function chonthemctkt($makt, $timebd, $timekt, $malop){
			$con;
			$p = new clsketnoi();
			if ($p->ketnoidb($con)){
				$chuoi="INSERT INTO `ctkiemtra` (`MaKT`, `MaLopHoc`, `TimeBD`, `TimeKT`)
				 VALUES ('$makt', '$malop', '$timebd', '$timekt');";
				$table =  mysqli_query($con, $chuoi);
				if($table){
					return $table;
				}else{
					return 0; //không thể chèn
				}
				$p->dongketnoi($con);
			}else{
				return false;
			}
		}
		function xoacauhoithuocbaikt($makt){
			$con;
			$p=new clsketnoi();
			$p->ketnoiDB($con);
			$string="DELETE FROM cauhoitn WHERE MaKT='$makt'";
			$kq=mysqli_query($con,$string);
			$p->dongketnoi($con);
			return $kq;
		}
		function xoactktra($makt){
			$con;
			$p=new clsketnoi();
			$p->ketnoiDB($con);
			$string="DELETE FROM ctkiemtra WHERE MaKT='$makt'";
			$kq=mysqli_query($con,$string);
			$p->dongketnoi($con);
			return $kq;
		}
		function xoabaikt($makt){
			$con;
			$p=new clsketnoi();
			$p->ketnoiDB($con);
			$string="DELETE FROM dekiemtra WHERE MaKT='$makt'";
			$kq=mysqli_query($con,$string);
			$p->dongketnoi($con);
			return $kq;
		}
		function xoabaiktct($makt, $malop){
			$con;
			$p=new clsketnoi();
			$p->ketnoiDB($con);
			$string="DELETE FROM ctkiemtra WHERE `ctkiemtra`.`MaKT` = $makt AND `ctkiemtra`.`MaLopHoc` = $malop";
			$kq=mysqli_query($con,$string);
			$p->dongketnoi($con);
			return $kq;
		}
		function chonxoachtnkt($mach, $makt){
			$con;
			$p=new clsketnoi();
			$p->ketnoiDB($con);
			$string="DELETE FROM chitiettn WHERE `MaKT` = $makt AND `MaCHTN` = $mach";
			$kq=mysqli_query($con,$string);
			$p->dongketnoi($con);
			return $kq;
		}
	}
?>