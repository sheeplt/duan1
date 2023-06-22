<?php 
	include_once("model/mquanli.php");
	class controlquanli{
		function chonquanli(){
			$p = new modelquanli();
			$tblPro = $p->chonquanli();
			return ($tblPro);
		}
		function lay1quanli($tendn){
			$p = new modelquanli();
			$tblPro = $p->chon1quanli($tendn);
			return ($tblPro);
		}
		function lay1quanli1($ma){
			$p = new modelquanli();
			$tblPro = $p->chon1quanli1($ma);
			return ($tblPro);
		}
		function capnhatquanliCoanh($ma, $ten, $ngay, $diachi, $gioitinh, $sdt, $email, $role, $tenanh, $diachianh){
			$p = new modelquanli();
			$thoigianhientai = time();
			$tenmoi = $thoigianhientai.$tenanh;
			if(move_uploaded_file($diachianh,"view/images/".$tenmoi)){
				$table = $p -> capnhatquanliCoanh($ma, $ten, $ngay, $diachi, $gioitinh, $sdt, $email, $role, $tenmoi);
				if($table){
					return 1;
				}else{
					return 0;//không thể insert
				}
			}else{
				return 2; //không thể upload
			}
		}
		function themquanli($ten, $ngay, $diachi, $gioitinh, $sdt, $email, $role, $tenanh, $diachianh){
			$p = new modelquanli();
			$thoigianhientai = time();
			$tenmoi = $thoigianhientai.$tenanh;
			if(move_uploaded_file($diachianh,"view/images/".$tenmoi)){
				$table = $p -> themquanli($ten, $ngay, $diachi, $gioitinh, $sdt, $email, $role, $tenmoi);
				if($table){
					return 1;
				}else{
					return 0;//không thể insert
				}
			}else{
				return 2; //không thể upload
			}
		}
		function capnhatquanli($ma, $ten, $ngay, $diachi, $gioitinh, $sdt, $email, $role){
			$p = new modelquanli();
			$tblPro = $p->capnhatquanli($ma, $ten, $ngay, $diachi, $gioitinh, $sdt, $email, $role);
			if($tblPro){
                return 1;
            }else{
                return 0; //không thể chèn
            }
		}
		function updatengaythi($ma, $ngay){
			$p = new modelquanli();
			// kiểm tra ngày bắt đầu
			$ngayhientai = date('Y-m-d');
			$ngayhientai = strtotime($ngayhientai);
			$ngaylich = strtotime($ngay);
			if ($ngaylich < $ngayhientai) {
				return 5; // thời gian bắt đầu k được bé hơn tg kết thúc
			}
			$nammoi = date("Y", $ngaylich);
			$namnay = date("Y", $ngayhientai);
			if($nammoi == $namnay){
				$tblPro = $p->updatengaythi($ma, $ngay);
				if($tblPro){
					return 1;
				}else{
					return 0; //không thể chèn
				}
			}else{
				include_once("model/mlophoc.php");
				$plophoc = new modellophoc;
				$kplophoc = $plophoc->updatelophockt();
				if($kplophoc == 0){
					return 0 ;
				}
				include_once("model/mtaikhoan.php");
				$ptaikhoan = new modeltaikhoan;
				$kptaikhoan = $ptaikhoan->vohieutkallHS();
				if($kptaikhoan == 0){
					return 0 ;
				}
				$tblPro = $p->updatengaythi($ma, $ngay);
				if($tblPro){
					return 1;
				}else{
					return 0; //không thể chèn
				}
			}
		}
		function xoaquanli($ma){
			$p = new modelquanli();
			$tblPro = $p->xoaquanli($ma);
			if($tblPro){
                return 1;
            }else{
                return 0; //không thể chèn
            }
		}
	}
?>