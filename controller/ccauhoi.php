<?php 
	include_once("model/mcauhoi.php");
	class controlcauhoi{
        function lay1chtn($mach){
			$p = new modelcauhoi();
			$tblPro = $p->chon1chtn($mach);
			return ($tblPro);
		}
        function layupdatechtn( $mach, $da){
			$p = new modelcauhoi();
			$tblPro = $p->chonupdatechtn($mach, $da);
			if($tblPro){
                return 1;
            }else{
                return 0; //không thể chèn
            }
		}
		function chonchtheode($makt){
			$p = new modelcauhoi();
			$tblPro = $p->chonchtheode($makt);
			return ($tblPro);
		}
		function xoachtn($mach){
			$p=new modelcauhoi();
            $ins =$p->xoachtn($mach);
			return $ins;
		}
		function laythemchtn( $makt, $da, $diem){
			$p = new modelcauhoi();
			$tblPro = $p->chonthemchtn($makt,  $da, $diem);
			if($tblPro){
                return 1;
            }else{
                return 0; //không thể chèn
            }
		}
	}
?>