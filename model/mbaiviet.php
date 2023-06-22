<?php 
	include_once("ketnoi.php");
	class modelbaiviet{
		function chonallbaiviet(){
			$con;
			$p = new clsketnoi();
			if ($p->ketnoidb($con)){
				$chuoi="SELECT * FROM `baiviet`";
				$table =  mysqli_query($con, $chuoi);
				$p->dongketnoi($con);
				return $table;
			}else{
				return false;
			}
		}
		function chonbaivietuutien($uutien){
			$con;
			$p = new clsketnoi();
			if ($p->ketnoidb($con)){
				$chuoi="SELECT * FROM `baiviet`  WHERE UuTien = $uutien";
				$table =  mysqli_query($con, $chuoi);
				$p->dongketnoi($con);
				return $table;
			}else{
				return false;
			}
		}
        function chon1baiviet($ma){
			$con;
			$p = new clsketnoi();
			if ($p->ketnoidb($con)){
				$chuoi="SELECT * FROM `baiviet` WHERE MaBV = $ma";
				$table =  mysqli_query($con, $chuoi);
				$p->dongketnoi($con);
				return $table;
			}else{
				return false;
			}
		}
        function chonthembaiviet($tieude, $noidung, $Maql, $uutien, $anh){
			$con;
			$p = new clsketnoi();
			if ($p->ketnoidb($con)){
				$chuoi="INSERT INTO `baiviet` (`MaBV`, `TieuDe`, `NoiDung`, `MaQL`, `UuTien`, `HinhAnh`)
				 VALUES (NULL, '$tieude', '$noidung', '$Maql', '$uutien', '$anh');";
				$kq =  mysqli_query($con, $chuoi);
				$p->dongketnoi($con);
				return $kq;
			}else{
				return false;
			}
		}
        function chonupdatebaiviet($tieude, $noidung, $Ma, $uutien){
			$con;
			$p = new clsketnoi();
			if ($p->ketnoidb($con)){
				$chuoi="UPDATE `baiviet` SET `TieuDe` = '$tieude', `NoiDung` = '$noidung',  `UuTien` = '$uutien' WHERE `baiviet`.`MaBV` = $Ma";
				$kq =  mysqli_query($con, $chuoi);
				$p->dongketnoi($con);
				return $kq;
			}else{
				return false;
			}
		}
		function chonupdatebaivietcoanh($tieude, $noidung, $Ma, $uutien, $hinhanh){
			$con;
			$p = new clsketnoi();
			if ($p->ketnoidb($con)){
				$chuoi="UPDATE `baiviet` SET `TieuDe` = '$tieude', `NoiDung` = '$noidung',  `UuTien` = '$uutien', `HinhAnh` = '$hinhanh'
				WHERE `baiviet`.`MaBV` = $Ma";
				$kq =  mysqli_query($con, $chuoi);
				$p->dongketnoi($con);
				return $kq;
			}else{
				return false;
			}
		}
        function chonxoabaiviet($Ma){
			$con;
			$p = new clsketnoi();
			if ($p->ketnoidb($con)){
				$chuoi="DELETE FROM baiviet WHERE `baiviet`.`MaBV` =  $Ma";
				$kq =  mysqli_query($con, $chuoi);
				$p->dongketnoi($con);
				return $kq;
			}else{
				return false;
			}
		}
    }
?>