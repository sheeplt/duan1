<?php 
	include_once("ketnoi.php");
	class modelmonhoc{
		function chon1monhoc($maMH){
			$con;
			$p = new clsketnoi();
			if ($p->ketnoidb($con)){
				$chuoi="SELECT * FROM `monhoc` where MaMonHoc = $maMH";
				$table =  mysqli_query($con, $chuoi);
				$p->dongketnoi($con);
				return $table;
			}else{
				return false;
			}
		}
		function chonmonhoc(){
			$con;
			$p = new clsketnoi();
			if ($p->ketnoidb($con)){
				$chuoi="SELECT * FROM `monhoc`";
				$table =  mysqli_query($con, $chuoi);
				$p->dongketnoi($con);
				return $table;
			}else{
				return false;
			}
		}
		function laymamontumalop($malop){
			$con;
			$p = new clsketnoi();
			if ($p->ketnoidb($con)){
				$chuoi="SELECT * FROM lophoc
				JOIN giaovien on giaovien.MaGV = lophoc.MaGV
				WHERE MaLopHoc = $malop;";
				$table =  mysqli_query($con, $chuoi);
				$p->dongketnoi($con);
				return $table;
			}else{
				return false;
			}
		}
	}
?>