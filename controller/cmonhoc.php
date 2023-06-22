<?php 
	include_once("model/mmonhoc.php");
	class controlmonhoc{
		function lay1monhoc($maMH){
			$p = new modelmonhoc();
			$tblPro = $p->chon1monhoc($maMH);
			return ($tblPro);
		}
		function laymonhoc(){
			$p = new modelmonhoc();
			$tblPro = $p->chonmonhoc();
			return ($tblPro);
		}
		function laymamontumalop($malop){
			$p = new modelmonhoc();
			$tblPro = $p->laymamontumalop($malop);
			return ($tblPro);
		}
	}

?>