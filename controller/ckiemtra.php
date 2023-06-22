<?php 
	include_once("model/mkiemtra.php");
	class controlkiemtra{
		function layktra($maLh){
			$p = new modelkiemtra();
			$tblPro = $p->chonktra($maLh);
			return ($tblPro);
		}
		function chonktraChthem($maLh, $magv){
			$p = new modelkiemtra();
			$tblPro = $p->chonktraChthem($maLh, $magv);
			return ($tblPro);
		}
        function lay1ktra($makt, $malop){
			$p = new modelkiemtra();
			$tblPro = $p->chon1ktra($makt, $malop);
			return ($tblPro);
		}
		function chonktravan($makt){
			$p = new modelkiemtra();
			$tblPro = $p->chonktravan($makt);
			return ($tblPro);
		}
        function layktratn($makt){
			$p = new modelkiemtra();
			$tblPro = $p->chonktratn($makt);
			return ($tblPro);
		}
		function layktratn1($makt, $so){
			$p = new modelkiemtra();
			$tblPro = $p->chonktratn1($makt, $so);
			return ($tblPro);
		}
		function layupdatekt($makt, $time, $tieude, $malop, $timebd, $timekt){
			$p = new modelkiemtra();
			$citiet = $p->chonupdatectkt($makt, $malop, $timebd, $timekt);
			if($citiet == 0){
				return 0;
			}
			$tblPro = $p->chonupdatekt($makt, $time, $tieude);
			if($tblPro){
                return 1;
            }else{
                return 0; //không thể chèn
            }
		}
		function chonthemctkt($makt, $timebd, $timekt, $malop){
			$p = new modelkiemtra();
			$tblPro = $p->chonthemctkt($makt, $timebd, $timekt, $malop);
			return ($tblPro);
		}
		function laythemkt($time, $tieude, $hinhthuc, $timebd, $timekt, $magv, $malop, $tuanthi, $file, $tenfile){
			$p = new modelkiemtra();
			$thoigianhientai = time();
			$tenmoi = $thoigianhientai.$tenfile;
			if(move_uploaded_file($file,"file/DeThi/".$tenmoi)){
				$id = $p -> chonthemkt($time, $tieude, $magv, $tenmoi);
				if($id == 0){
					return 0;//không thể insert
				}
			}else{
				return 2; //không thể upload
			}
			$kq = $p->chonthemctkt($id, $timebd, $timekt, $malop);
			if($kq == 1){
				return $id;
			}else{
				return 0;
			}

		}
		function xoabaikt($makt){
			$p=new modelkiemtra();
			$cauhoi = $p->xoacauhoithuocbaikt($makt);
			if($cauhoi == 0){
				return 0;
			}
			$cauhoi = $p->xoactktra($makt);
			if($cauhoi == 0){
				return 0;
			}
            $ins =$p->xoabaikt($makt);
			return $ins;
		}
		function xoabaiktct($makt, $malop){
			$p=new modelkiemtra();
            $ins =$p->xoabaiktct($makt, $malop);
			return $ins;
		}
		function layxoachtnkt($mach, $makt){
			$p=new modelkiemtra();
            $ins =$p->chonxoachtnkt($mach, $makt);
			return $ins;
		}
	}