<?php 
	include_once("model/mbaiviet.php");
	class controlbaiviet{
		function layallbaiviet(){
			$p = new modelbaiviet();
			$tblPro = $p->chonallbaiviet();
			return ($tblPro);
		}
        function lay1baiviet($ma){
			$p = new modelbaiviet();
			$tblPro = $p->chon1baiviet($ma);
			return ($tblPro);
		}
		function chonbaivietuutien($uutien){
			$p = new modelbaiviet();
			$tblPro = $p->chonbaivietuutien($uutien);
			return ($tblPro);
		}
        function laythembaiviet($tieude, $noidung, $Maql, $file, $loaianh, $anh, $uutien){
			if ($loaianh == "image/jpeg" || $loaianh == "image/png") {
					$create = move_uploaded_file($file, "./img/" . $anh);
					if ($create) {
						$p = new modelbaiviet();
						$tblPro = $p->chonthembaiviet($tieude, $noidung, $Maql, $uutien, $anh);
						if($tblPro == 1){
							return 1;
						}else{
							return 0; //không thể chèn
						}
					} else {
						return -1; //không thể upload
					}
			} else {
				return -3; //Không đúng loại file
			}
			
		}
        function layupdatebaiviet($tieude, $noidung, $Ma, $uutien){
			$p = new modelbaiviet();
			$tblPro = $p->chonupdatebaiviet($tieude, $noidung, $Ma, $uutien);
			if($tblPro == 1){
				return 1;
			}else{
				return 0; //không thể chèn
			}
		}
		function chonupdatebaivietcoanh($tieude, $noidung, $MaBV, $uutien, $tenanh, $file, $loaianh){
			$p = new modelbaiviet();
			if ($loaianh == "image/jpeg" || $loaianh == "image/png") {
				date_default_timezone_set('Asia/Ho_Chi_Minh');
				//ảnh sẽ được đặt tên theo ngày tháng năm - giờ phút giây - tên ảnh
				$newname =  date('dmY-His') . "-" . $tenanh;
				$create = move_uploaded_file($file, "./img/" . $newname);
				if ($create) {
					$tblPro = $p->chonupdatebaivietcoanh($tieude, $noidung, $MaBV, $uutien, $newname);
					if($tblPro == 1){
						return 1;
					}else{
						return 0; //không thể chèn
					}
				} else{
					return -1; 
				}
			} else{
				return -3; //không đúng loại file 
			}
		}
        function chonxoabaiviet($Ma){
			$p = new modelbaiviet();
			$tblPro = $p->chonxoabaiviet($Ma);
			if($tblPro == 1){
				return 1;
			}else{
				return 0; //không thể chèn
			}
		}
	}
?>