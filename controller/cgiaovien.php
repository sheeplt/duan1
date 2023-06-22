<?php 
	include_once("model/mgiaovien.php");
	class controlgiaovien{
		function laygiaovien(){
			$p = new modelgiaovien();
			$tblPro = $p->chongiaovien();
			return ($tblPro);
		}
		function lay1giaovien($tendn){
			$p = new modelgiaovien();
			$tblPro = $p->chon1giaovien($tendn);
			return ($tblPro);
		}
		function lay1giaovien1($tendn){
			$p = new modelgiaovien();
			$tblPro = $p->chon1giaovien2($tendn);
			return ($tblPro);
		}
		function laygvtheomonhoc($ma){
			$p = new modelgiaovien();
			$tblPro = $p->chongvtheomonhoc($ma);
			return ($tblPro);
		}
		function laygvchuachunghiem(){
			$p = new modelgiaovien();
			$tblPro = $p->chongvchuachunghiem();
			return ($tblPro);
		}
		function themgiaovien($ten, $ngay, $diachi, $gioitinh, $ma, $tenanh, $diachianh, $sdt, $email){
			$p = new modelgiaovien();
			$thoigianhientai = time();
			$tenmoi = $thoigianhientai.$tenanh;
			if(move_uploaded_file($diachianh,"view/images/".$tenmoi)){
				$table = $p -> themgiaovien($ten, $ngay, $diachi, $gioitinh, $ma, $tenmoi, $sdt, $email);
				if($table){
					return 1;
				}else{
					return 0;//không thể insert
				}
			}else{
				return 2; //không thể upload
			}
		}
		function updategiaovien($ten, $ngay, $diachi, $gioitinh, $mamon, $ma, $sdt, $email){
			$p = new modelgiaovien();
			$tblPro = $p->updategiaovien($ten, $ngay, $diachi, $gioitinh, $mamon, $ma, $sdt, $email);
			if($tblPro){
                return 1;
            }else{
                return 0; //không thể chèn
            }
		}
		function updategiaovienCoanh($ten, $ngay, $diachi, $gioitinh, $mamon, $ma, $tenanh, $diachianh, $sdt, $email){
			$p = new modelgiaovien();
			$thoigianhientai = time();
			$tenmoi = $thoigianhientai.$tenanh;
			if(move_uploaded_file($diachianh,"view/images/".$tenmoi)){
				$table = $p -> updategiaovienCoanh($ten, $ngay, $diachi, $gioitinh, $mamon, $ma, $tenmoi, $sdt, $email);
				if($table){
					return 1;
				}else{
					return 0;//không thể insert
				}
			}else{
				return 2; //không thể upload
			}
		}
		function xoagiaovien($ma){
			$p = new modelgiaovien();
			$tblPro = $p->xoagiaovien($ma);
			if($tblPro){
                return 1;
            }else{
                return 0; //không thể chèn
            }
		}
	}
?>