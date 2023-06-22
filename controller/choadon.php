<?php 
	include_once("model/mhoadon.php");
	class controlhoadon{
		function dstienluong(){
			$p = new modelhoadon();
			$tblPro = $p->dstienluong();
			return ($tblPro);
		}
		function tienluong11($maluong){
			$p = new modelhoadon();
			$tblPro = $p->tienluong11($maluong);
			return ($tblPro);
		}
		function tienluong1($maluong){
			$p = new modelhoadon();
			$tblPro = $p->tienluong11($maluong);
			return ($tblPro);
		}
		function dshoadonHS(){
			$p = new modelhoadon();
			$tblPro = $p->dshoadonHS();
			return ($tblPro);
		}
        function dshoadon1HS($mahs){
			$p = new modelhoadon();
			$tblPro = $p->dshoadon1HS($mahs);
			return ($tblPro);
		}
		function dshoadonGV(){
			$p = new modelhoadon();
			$tblPro = $p->dshoadonGV();
			return ($tblPro);
		}
		function dshoadon1GV($magv){
			$p = new modelhoadon();
			$tblPro = $p->dshoadon1GV($magv);
			return ($tblPro);
		}
		function dshoadonQL(){
			$p = new modelhoadon();
			$tblPro = $p->dshoadonQL();
			return ($tblPro);
		}
		function dshoadon1QL($maql){
			$p = new modelhoadon();
			$tblPro = $p->dshoadon1QL($maql);
			return ($tblPro);
		}
		function hoadonupdateql($ma){
			$p = new modelhoadon();
			$tblPro = $p->hoadonupdateql($ma);
			return ($tblPro);
		}
		function tinhluongdslichdaday($magv, $malop){
			$p = new modelhoadon();
			$tblPro = $p->tinhluongdslichdaday($magv, $malop);
			return ($tblPro);
		}
		function tinhluongdslopday($magv){
			$p = new modelhoadon();
			$tblPro = $p->tinhluongdslopday($magv);
			return ($tblPro);
		}
		function tinhluongdslichbudaday($magv){
			$p = new modelhoadon();
			$tblPro = $p->tinhluongdslichbudaday($magv);
			return ($tblPro);
		}
		function themhoadonGV(){
			$p = new modelhoadon();
			//ngày thêm
            $today = time();
            $thang = date("m", $today);
            $nam = date("Y", $today);
            //cộng ngày
            $today = mktime(0, 0, 0, $thang , 5, $nam);//
            //đổi chuỗi thành ngày
            $today = strftime("%Y-%m-%d", $today);
			//tính hd có trước
			$slhoadon = $p->dshoadontrongthanggv($today);
			if(mysqli_num_rows($slhoadon) != 0){
				return 2; //hóa đơn đã được tạo
			}
			include_once("model/mgiaovien.php");
			$pgiaovien = new modelgiaovien;
			$tblGV = $pgiaovien->chongiaovienconlam();
			while ($rowgv = mysqli_fetch_assoc($tblGV)) {
				$kq = $p->themhoadonGV($rowgv["MaGV"], $today);
				if($kq == 0){
					return 0;
				}
			}
			return 1;
		}
		function themhoadonQL(){
			$p = new modelhoadon();
			//ngày thêm
            $today = time();
            $thang = date("m", $today);
            $nam = date("Y", $today);
            //cộng ngày
            $today = mktime(0, 0, 0, $thang , 5, $nam);//
            //đổi chuỗi thành ngày
            $today = strftime("%Y-%m-%d", $today);
			//tính hd có trước
			$slhoadon = $p->dshoadontrongthangql($today);
			if(mysqli_num_rows($slhoadon) != 0){
				return 2; //hóa đơn đã được tạo
			}
			include_once("model/mquanli.php");
			$pquanli = new modelquanli;
			$tblql = $pquanli->chonquanlidanglam();
			while ($rowql = mysqli_fetch_assoc($tblql)) {
				if($rowql["Role"] == 1){
					$tbltienluong = $p->tienluong1(5);
					$rowtienluong = mysqli_fetch_assoc($tbltienluong);
                    $sotien = $rowtienluong["SoTien"];
				}elseif($rowql["Role"] == 2){
					$tbltienluong = $p->tienluong1(3);
					$rowtienluong = mysqli_fetch_assoc($tbltienluong);
                    $sotien = $rowtienluong["SoTien"];
				}elseif($rowql["Role"] == 3){
					$tbltienluong = $p->tienluong1(4);
					$rowtienluong = mysqli_fetch_assoc($tbltienluong);
                    $sotien = $rowtienluong["SoTien"];
				}
				$kq = $p->themhoadonql($rowql["MaQL"], $today, $sotien);
				if($kq == 0){
					return 0;
				}
			}
			return 1;
		}
        function thanhtoaHS($mahd){
			$p = new modelhoadon();
			$tblPro = $p->thanhtoaHS($mahd);
			return ($tblPro);
		}
        function hoantienHS($mahd){
			$p = new modelhoadon();
			$tblPro = $p->hoantienHS($mahd);
			return ($tblPro);
		}
		function thanhtoaGV($mahd, $tongtien){
			$p = new modelhoadon();
			$tblPro = $p->thanhtoaGV($mahd, $tongtien);
			return ($tblPro);
		}
		function thanhtoaQl($mahd){
			$p = new modelhoadon();
			$tblPro = $p->thanhtoaQL($mahd);
			return ($tblPro);
		}
		function updatetienql($mahd, $sotien){
			$p = new modelhoadon();
			$tblPro = $p->updatetienql($mahd, $sotien);
			return ($tblPro);
		}
		function updatebangluong($maluong, $sotien){
			$p = new modelhoadon();
			$tblPro = $p->updatebangluong($maluong, $sotien);
			return ($tblPro);
		}
		function xoahoadonhs($mahs){
			$p = new modelhoadon();
			$tblPro = $p->xoahoadonhs($mahs);
			return ($tblPro);
		}
    }
?>