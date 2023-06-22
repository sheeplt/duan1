<?php
include_once("ketnoi.php");
class modelTaiKhoan{
	//
	function statusgv($tendn){
		$p = new clsketnoi();
		if ($p->ketnoidb($con)) {
			$chuoi = "UPDATE `giaovien` SET `status` = '1' WHERE `TenDN` = '$tendn'";
			$table =  mysqli_query($con, $chuoi);
			$p->dongketnoi($con);
			return $table;
		} else {
			return false;
		}
	}
	function statushs($tendn){
		$p = new clsketnoi();
		if ($p->ketnoidb($con)) {
			$chuoi = "UPDATE `hocsinh` SET `status` = '1' WHERE `TenDN` = '$tendn'";
			$table =  mysqli_query($con, $chuoi);
			$p->dongketnoi($con);
			return $table;
		} else {
			return false;
		}
	}
	function statusql($tendn){
		$p = new clsketnoi();
		if ($p->ketnoidb($con)) {
			$chuoi = "UPDATE `quanli` SET `status` = '1' WHERE `TenDN` = '$tendn'";
			$table =  mysqli_query($con, $chuoi);
			$p->dongketnoi($con);
			return $table;
		} else {
			return false;
		}
	}
	function statusgv1($tendn){
		$p = new clsketnoi();
		if ($p->ketnoidb($con)) {
			$chuoi = "UPDATE `giaovien` SET `status` = '0' WHERE `TenDN` = '$tendn'";
			$table =  mysqli_query($con, $chuoi);
			$p->dongketnoi($con);
			return $table;
		} else {
			return false;
		}
	}
	function statushs1($tendn){
		$p = new clsketnoi();
		if ($p->ketnoidb($con)) {
			$chuoi = "UPDATE `hocsinh` SET `status` = '0' WHERE `TenDN` = '$tendn'";
			$table =  mysqli_query($con, $chuoi);
			$p->dongketnoi($con);
			return $table;
		} else {
			return false;
		}
	}
	function statusql1($tendn){
		$p = new clsketnoi();
		if ($p->ketnoidb($con)) {
			$chuoi = "UPDATE `quanli` SET `status` = '0' WHERE `TenDN` = '$tendn'";
			$table =  mysqli_query($con, $chuoi);
			$p->dongketnoi($con);
			return $table;
		} else {
			return false;
		}
	}
	//chọn tất cả sản phẩm
	function chontaikhoan($tendn){
		$p = new clsketnoi();
		if ($p->ketnoidb($con)) {
			$chuoi = "SELECT * FROM `taikhoan` WHERE TenDN = '$tendn'";
			$table =  mysqli_query($con, $chuoi);
			$p->dongketnoi($con);
			return $table;
		} else {
			return false;
		}
	}
	function chondoimk($tendn, $mk){
		$p = new clsketnoi();
		if ($p->ketnoidb($con)) {
			$chuoi = "UPDATE `taikhoan` SET `MK` = '$mk' WHERE `TenDN` = '$tendn'";
			$table =  mysqli_query($con, $chuoi);
			$p->dongketnoi($con);
			return $table;
		} else {
			return false;
		}
	}
	function vohieutk($tendn){
		$p = new clsketnoi();
		if ($p->ketnoidb($con)) {
			$chuoi = "UPDATE `taikhoan` SET `TrangThaiTK` = '0' WHERE `TenDN` = '$tendn'";
			$table =  mysqli_query($con, $chuoi);
			$p->dongketnoi($con);
			return $table;
		} else {
			return false;
		}
	}
	function vohieutkallHS(){
		$p = new clsketnoi();
		if ($p->ketnoidb($con)) {
			$chuoi = "UPDATE `taikhoan` SET `TrangThaiTK` = '0' WHERE `LoaiTK` = 'HS'";
			$table =  mysqli_query($con, $chuoi);
			$p->dongketnoi($con);
			return $table;
		} else {
			return false;
		}
	}
	function chonalltaikhoan(){
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
	function datlaimk($ma){
		$con;
		$p = new clsketnoi();
		if ($p->ketnoidb($con)){
			$chuoi="UPDATE taikhoan SET MK = '12345' WHERE TenDN = '$ma'";
			$table =  mysqli_query($con, $chuoi);
			$p->dongketnoi($con);
			return $table;
		}else{
			return false;
		}
	}
}
