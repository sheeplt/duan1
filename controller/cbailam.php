<?php 
	include_once("model/mbailam.php");
	class controlbailam{
		function laybailam($makt){
			$p = new modelbailam();
			$tblPro = $p->chonbailam($makt);
			return ($tblPro);
		}
		function lay1dapan($mabl, $mach){
			$p = new modelbailam();
			$tblPro = $p->chon1dapan($mabl, $mach);
			return ($tblPro);
		}
		function laybai1lam($makt, $mahs){
			$p = new modelbailam();
			$tblPro = $p->chonbai1lam($makt, $mahs);
			return ($tblPro);
		}
		function laybai1lamvan($makt, $mahs){
			$p = new modelbailam();
			$tblPro = $p->chonbai1lamvan($makt, $mahs);
			return ($tblPro);
		}
		function laychamdiem($mabl, $diem){
			$p = new modelbailam();
			$tblPro = $p->chonchamdiem($mabl, $diem);
			if($tblPro){
                return 1;
            }else{
                return 0; //không thể chèn
            }
		}
		function chonchamdiemvan($mabl, $diem){
			$p = new modelbailam();
			$tblPro = $p->chonchamdiemvan($mabl, $diem);
			if($tblPro){
                return 1;
            }else{
                return 0; //không thể chèn
            }
		}
		function nopbaivan($mabl, $diachi, $tenfile){
			$p = new modelbailam();
			$thoigianhientai = time();
			$tenmoi = $thoigianhientai.$tenfile;
			if(move_uploaded_file($diachi,"file/BaiLamVan/".$tenmoi)){
				$id = $p -> nopbaivan($mabl, $tenmoi);
				if($id == 0){
					return 0;//không thể insert
				}
				return 1;
			}else{
				return 2; //không thể upload
			}
		}
		function laythembailamtn($makt, $mahs){
			$p = new modelbailam();
			$idmoi = $p->chonthembailamtn($makt, $mahs);
			if(!$idmoi){
                return 0; //không thể chèn
            }
			include_once("model/mkiemtra.php");
			$p1 = new controlkiemtra();
    		$table1 = $p1->layktratn($makt);
			while ($row1 = mysqli_fetch_assoc($table1)) {
				$kq = $p->themCTbailamtn($row1['MaCHTN'], $idmoi);
				if($kq == 0){
					return 0;
				}
			}
			return 1;
		}
		function laythembailamtl($makt, $mahs){
			$p = new modelbailam();
			$idmoi = $p->chonthembailamtl($makt, $mahs);
			if(!$idmoi){
                return 0; //không thể chèn
            }
			return 1;
		}
		function chonupdatecautraloitracnghiem($mabl, $mach, $dapan){
			$p = new modelbailam();
			$tblPro = $p->chonupdatecautraloitracnghiem($mabl, $mach, $dapan);
			if($tblPro){
                return 1;
            }else{
                return 0; //không thể chèn
            }
		}
		function laydiem($mabl, $makt){
			$p = new modelbailam();
			$tblPro = $p->chonlaydiem($mabl, $makt);
			if($tblPro){
                return 1;
            }else{
                return 0; //không thể chèn
            }
		}
	}
?>