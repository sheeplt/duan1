<?php 
	include_once("model/mbaihoc.php");
	class controlbaihoc{
		function chonbaihocThongbao($malop){
			$p = new modelbaihoc();
			$tblPro = $p->chonbaihocThongbao($malop);
			return ($tblPro);
		}
		function chonbaihocTailieu($malop){
			$p = new modelbaihoc();
			$tblPro = $p->chonbaihocTailieu($malop);
			return ($tblPro);
		}
		function chonbaihocBaitap($malop){
			$p = new modelbaihoc();
			$tblPro = $p->chonbaihocBaitap($malop);
			return ($tblPro);
		}
        function lay1baihoc($mabh){
			$p = new modelbaihoc();
			$tblPro = $p->chon1baihoc($mabh);
			return ($tblPro);
		}
		function chonthemthongbao($tieude, $ghichu, $malop){
			$p = new modelbaihoc();
			$table = $p -> chonthemthongbao($tieude, $ghichu, $malop);
            if($table){
                return 1;
            }else{
                return 0; //không thể chèn
            }
		}
		function chonupdatethongbao($tieude, $ghichu, $malop){
			$p = new modelbaihoc();
			$table = $p -> chonupdatethongbao($tieude, $ghichu, $malop);
            if($table){
                return 1;
            }else{
                return 0; //không thể chèn
            }
		}
		function chonthemtailieu($tieude, $ghichu, $malop, $tenfile, $file){
			$p = new modelbaihoc();
			$thoigianhientai = time();
			$tenmoi = $thoigianhientai.$tenfile;
			if(move_uploaded_file($file,"file/BT/".$tenmoi)){
				$table = $p -> chonthemtailieu($tieude, $ghichu, $malop, $tenmoi);
				if($table){
					return 1;
				}else{
					return 0;//không thể insert
				}
			}else{
				return 2; //không thể upload
			}
		}
		function chonthembaitap($tieude, $ghichu, $malop, $tenfile, $file){
			$p = new modelbaihoc();
			$thoigianhientai = time();
			$tenmoi = $thoigianhientai.$tenfile;
			if(move_uploaded_file($file,"file/BT/".$tenmoi)){
				$table = $p -> chonthembaitap($tieude, $ghichu, $malop, $tenmoi);
				if($table){
					return 1;
				}else{
					return 0;//không thể insert
				}
			}else{
				return 2; //không thể upload
			}
		}
		function chonupdatetailieuCoFile($tieude, $ghichu, $malop, $tenfile, $file){
			$p = new modelbaihoc();
			$thoigianhientai = time();
			$tenmoi = $thoigianhientai.$tenfile;
			if(move_uploaded_file($file,"file/BT/".$tenmoi)){
				$table = $p -> chonupdatetailieuCoFile($tieude, $ghichu, $malop, $tenmoi);
				if($table){
					return 1;
				}else{
					return 0;//không thể insert
				}
			}else{
				return 2; //không thể upload
			}
		}
		function chonupdatetailieuKFile($tieude, $ghichu, $malopm){
			$p = new modelbaihoc();
			$table = $p -> chonupdatetailieuKFile($tieude, $ghichu, $malopm);
            if($table){
                return 1;
            }else{
                return 0; //không thể chèn
            }
		}
		function xoabaihoc($mabh){
			$p=new modelbaihoc();
            $ins =$p->xoabaihoc($mabh);
			return $ins;
		}
		function laybaihocchoHS($maGV, $malop){
			$p = new modelbaihoc();
			$tblPro = $p->chonbaihocchoHS($maGV, $malop);
			return ($tblPro);
		}
	}

?>