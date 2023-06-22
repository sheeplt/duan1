<?php
include_once("model/mtaikhoan.php");
class controlTaiKhoan{
	//
	function statusgv($tendn){
		$p = new modelTaiKhoan();
		$tblPro = $p->statusgv($tendn);
		if($tblPro){
			return 1;
		}else{
			return 0; //không thể chèn
		}
	}
	function statushs($tendn){
		$p = new modelTaiKhoan();
		$tblPro = $p->statushs($tendn);
		if($tblPro){
			return 1;
		}else{
			return 0; //không thể chèn
		}
	}
	function statusql($tendn){
		$p = new modelTaiKhoan();
		$tblPro = $p->statusql($tendn);
		if($tblPro){
			return 1;
		}else{
			return 0; //không thể chèn
		}
	}
	function statusgv1($tendn){
		$p = new modelTaiKhoan();
		$tblPro = $p->statusgv1($tendn);
		if($tblPro){
			return 1;
		}else{
			return 0; //không thể chèn
		}
	}
	function statushs1($tendn){
		$p = new modelTaiKhoan();
		$tblPro = $p->statushs1($tendn);
		if($tblPro){
			return 1;
		}else{
			return 0; //không thể chèn
		}
	}
	function statusql1($tendn){
		$p = new modelTaiKhoan();
		$tblPro = $p->statusql1($tendn);
		if($tblPro){
			return 1;
		}else{
			return 0; //không thể chèn
		}
	}
	//lấy tất cả tải khoản
	function laytaikhoan($tendn){
		$p = new modelTaiKhoan();
		$tblPro = $p->chontaikhoan($tendn);
		return ($tblPro);
	}
	function laydoimk($tendn, $mk){
		$p = new modelTaiKhoan();
		$tblPro = $p->chondoimk($tendn, $mk);
		if($tblPro){
			return 1;
		}else{
			return 0; //không thể chèn
		}
	}
	function vohieutk($tendn){
		$p = new modelTaiKhoan();
		$tblPro = $p->vohieutk($tendn);
		if($tblPro){
			return 1;
		}else{
			return 0; //không thể chèn
		}
	}
	function layalltaikhoan(){
		$p = new modelTaiKhoan();
		$tblPro = $p->chonalltaikhoan();
		return ($tblPro);
	}
	function datlaimk($ma){
		$p = new modelTaiKhoan();
		$tblPro = $p->chontaikhoan($ma);
		$row = mysqli_fetch_assoc($tblPro);
		$mkcu = $row["MK"];
		if($mkcu == "12345"){
			return 3;
		}
		$kq = $p->datlaimk($ma);
		if($kq){
			return 1;
		}else{
			return 0; //không thể chèn
		}
	}
}
