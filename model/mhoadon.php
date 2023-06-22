<?php 
	include_once("ketnoi.php");
	class modelhoadon{
        function dstienluong(){
            $con;
			$p = new clsketnoi();
			if ($p->ketnoidb($con)){
				$chuoi="SELECT * FROM `bangluong`";
				$table =  mysqli_query($con, $chuoi);
				$p->dongketnoi($con);
				return $table;
			}else{
				return false;
			}
        }
        function tienluong11($maluong){
            $con;
			$p = new clsketnoi();
			if ($p->ketnoidb($con)){
				$chuoi="SELECT *  FROM `bangluong`  WHERE MaLuong = $maluong";
				$table =  mysqli_query($con, $chuoi);
				$p->dongketnoi($con);
				return $table;
			}else{
				return false;
			}
        }
        function tienluong1($maluong){
            $con;
			$p = new clsketnoi();
			if ($p->ketnoidb($con)){
				$chuoi="SELECT SoTien  FROM `bangluong`  WHERE MaLuong = $maluong";
				$table =  mysqli_query($con, $chuoi);
				$p->dongketnoi($con);
				return $table;
			}else{
				return false;
			}
        }
        function dshoadonHS(){
            $con;
			$p = new clsketnoi();
			if ($p->ketnoidb($con)){
				$chuoi="SELECT * FROM `hoadonhs`
                JOIN hocsinh on hocsinh.MaHS = hoadonhs.MaHS
                JOIN lophoc ON lophoc.MaLopHoc = hoadonhs.MaLopHoc
                ORDER BY TrangThaiHoaDon ASC , NgayTT ASC ;";
				$table =  mysqli_query($con, $chuoi);
				$p->dongketnoi($con);
				return $table;
			}else{
				return false;
			}
        }
        function dshoadon1HS($mahs){
            $con;
			$p = new clsketnoi();
			if ($p->ketnoidb($con)){
				$chuoi="SELECT * FROM `hoadonhs`
                JOIN hocsinh on hocsinh.MaHS = hoadonhs.MaHS
                JOIN lophoc ON lophoc.MaLopHoc = hoadonhs.MaLopHoc
                WHERE hoadonhs.MaHS = $mahs
                ORDER BY TrangThaiHoaDon ASC , NgayTT ASC ;";
				$table =  mysqli_query($con, $chuoi);
				$p->dongketnoi($con);
				return $table;
			}else{
				return false;
			}
        }
        function dshoadonGV(){
            $con;
			$p = new clsketnoi();
			if ($p->ketnoidb($con)){
				$chuoi="SELECT * FROM `hoadongv`
                JOIN giaovien on giaovien.MaGV = hoadongv.MaGV
                ORDER BY TrangThaiHoaDon ASC , NgayTT ASC;";
				$table =  mysqli_query($con, $chuoi);
				$p->dongketnoi($con);
				return $table;
			}else{
				return false;
			}
        }
        function dshoadon1GV($magv){
            $con;
			$p = new clsketnoi();
			if ($p->ketnoidb($con)){
				$chuoi="SELECT * FROM `hoadongv`
                JOIN giaovien on giaovien.MaGV = hoadongv.MaGV
                WHERE hoadongv.MaGV = $magv
                ORDER BY TrangThaiHoaDon ASC , NgayTT ASC;";
				$table =  mysqli_query($con, $chuoi);
				$p->dongketnoi($con);
				return $table;
			}else{
				return false;
			}
        }
        function dshoadonQL(){
            $con;
			$p = new clsketnoi();
			if ($p->ketnoidb($con)){
				$chuoi="SELECT * FROM `hoadonql`
                JOIN quanli on quanli.MaQL = hoadonql.MaQL
                ORDER BY TrangThaiHoaDon ASC , NgayTT ASC;";
				$table =  mysqli_query($con, $chuoi);
				$p->dongketnoi($con);
				return $table;
			}else{
				return false;
			}
        }
        function dshoadon1QL($maql){
            $con;
			$p = new clsketnoi();
			if ($p->ketnoidb($con)){
				$chuoi="SELECT * FROM `hoadonql`
                JOIN quanli on quanli.MaQL = hoadonql.MaQL
                WHERE hoadonql.MaQL = $maql
                ORDER BY TrangThaiHoaDon ASC , NgayTT ASC;";
				$table =  mysqli_query($con, $chuoi);
				$p->dongketnoi($con);
				return $table;
			}else{
				return false;
			}
        }
        function hoadonupdateql($ma){
            $con;
			$p = new clsketnoi();
			if ($p->ketnoidb($con)){
				$chuoi="SELECT * FROM `hoadonql`
                JOIN quanli on quanli.MaQL = hoadonql.MaQL
                WHERE hoadonql.MaHoaDon = $ma";
				$table =  mysqli_query($con, $chuoi);
				$p->dongketnoi($con);
				return $table;
			}else{
				return false;
			}
        }
        function dshoadontrongthanggv($ngay){
            $con;
			$p = new clsketnoi();
			if ($p->ketnoidb($con)){
				$chuoi="SELECT * FROM `hoadongv`
                WHERE NgayTT = '$ngay'";
				$table =  mysqli_query($con, $chuoi);
				$p->dongketnoi($con);
				return $table;
			}else{
				return false;
			}
        }
        function dshoadontrongthangql($ngay){
            $con;
			$p = new clsketnoi();
			if ($p->ketnoidb($con)){
				$chuoi="SELECT * FROM `hoadonql`
                WHERE NgayTT = '$ngay'";
				$table =  mysqli_query($con, $chuoi);
				$p->dongketnoi($con);
				return $table;
			}else{
				return false;
			}
        }
        function tinhluongdslichdaday($magv, $malop){
            $con;
			$p = new clsketnoi();
            $today = time();
		    $ngay = date ("d", $today);
            $thang = date("m", $today);
            $nam = date("Y", $today);
            //cộng ngày
            $ngay1 = mktime(0, 0, 0, $thang-1 , 1, $nam);//
            //đổi chuỗi thành ngày
            $ngay1 = strftime("%Y-%m-%d", $ngay1);
            $ngay2 = date("Y-m-t", strtotime($ngay1));
			if ($p->ketnoidb($con)){
				$chuoi="SELECT * FROM `lichhocvsgiangday` 
                WHERE GVTrucTiep = $magv AND TrangThaiBuoiHoc = 1 and MaLopHoc = $malop
                and Ngay between '$ngay1' and '$ngay2'";
				$table =  mysqli_query($con, $chuoi);
				$p->dongketnoi($con);
				return $table;
			}else{
				return false;
			}
        }
        function tinhluongdslichbudaday($magv){
            $con;
			$p = new clsketnoi();
            $today = time();
		    $ngay = date ("d", $today);
            $thang = date("m", $today);
            $nam = date("Y", $today);
            //cộng ngày
            $ngay1 = mktime(0, 0, 0, $thang-1 , 1, $nam);//
            //đổi chuỗi thành ngày
            $ngay1 = strftime("%Y-%m-%d", $ngay1);
            $ngay2 = date("Y-m-t", strtotime($ngay1));
			if ($p->ketnoidb($con)){
				$chuoi="SELECT * FROM `lichhocvsgiangday` 
                WHERE MaLopHoc NOT in (SELECT MaLopHoc FROM `lophoc` WHERE TrangThai = 3 and MaGV = $magv)
                AND GVTrucTiep = $magv AND TrangThaiBuoiHoc = 2
                and Ngay between '$ngay1' and '$ngay2'";
				$table =  mysqli_query($con, $chuoi);
				$p->dongketnoi($con);
				return $table;
			}else{
				return false;
			}
        }
        function tinhluongdslopday($magv){
            $con;
			$p = new clsketnoi();
			if ($p->ketnoidb($con)){
				$chuoi="SELECT * FROM `lophoc` 
                JOIN giaovien ON giaovien.MaGV = lophoc.MaGV
				WHERE TrangThai = 3 and giaovien.MaGV = '$magv';";
				$table =  mysqli_query($con, $chuoi);
				$p->dongketnoi($con);
				return $table;
			}else{
				return false;
			}
        }
		function themhoadonHScoc($malop,$mahs){
            $con;
			$p = new clsketnoi();
            $today = time();
		    $ngay = date ("d", $today);
            $thang = date("m", $today);
            $nam = date("Y", $today);
            //cộng ngày
            $today = mktime(0, 0, 0, $thang , $ngay+3, $nam);//
            //đổi chuỗi thành ngày
            $today = strftime("%Y-%m-%d", $today);
			if ($p->ketnoidb($con)){
				$chuoi="INSERT INTO `hoadonhs` (`MaHoaDon`, `NgayTT`, `SoTien`, `MaHS`, `MaLopHoc`, `TrangThaiHoaDon`) 
                VALUES (NULL, '$today', '500000', '$mahs', '$malop', 0);";
				$table =  mysqli_query($con, $chuoi);
				$p->dongketnoi($con);
				return $table;
			}else{
				return false;
			}
        }
        function themhoadonHS($malop,$mahs, $ngaydong, $sotien){
            $con;
			$p = new clsketnoi();
			if ($p->ketnoidb($con)){
				$chuoi="INSERT INTO `hoadonhs` (`MaHoaDon`, `NgayTT`, `SoTien`, `MaHS`, `MaLopHoc`, `TrangThaiHoaDon`) 
                VALUES (NULL, '$ngaydong', '$sotien', '$mahs', '$malop', 0);";
				$table =  mysqli_query($con, $chuoi);
				$p->dongketnoi($con);
				return $table;
			}else{
				return false;
			}
        }
        function themhoadonGV($magv, $ngay){
            $con;
			$p = new clsketnoi();
			if ($p->ketnoidb($con)){
				$chuoi="INSERT INTO `hoadongv` (`MaHoaDon`, `NgayTT`, `SoTien`, `TrangThaiHoaDon`, `MaGV`) 
                VALUES (NULL, '$ngay', NULL, '0', '$magv')";
				$table =  mysqli_query($con, $chuoi);
				$p->dongketnoi($con);
				return $table;
			}else{
				return false;
			}
        }
        function themhoadonql($maql, $ngay, $sotien){
            $con;
			$p = new clsketnoi();
			if ($p->ketnoidb($con)){
				$chuoi="INSERT INTO `hoadonql` (`MaHoaDon`, `NgayTT`, `SoTien`, `TrangThaiHoaDon`, `MaQL`) 
                VALUES (NULL, '$ngay', '$sotien', '0', '$maql');";
				$table =  mysqli_query($con, $chuoi);
				$p->dongketnoi($con);
				return $table;
			}else{
				return false;
			}
        }
        function thanhtoaHS($mahd){
            $con;
			$p = new clsketnoi();
			if ($p->ketnoidb($con)){
				$chuoi="UPDATE `hoadonhs` SET `TrangThaiHoaDon` = '1' WHERE `hoadonhs`.`MaHoaDon` = $mahd;";
				$table =  mysqli_query($con, $chuoi);
				$p->dongketnoi($con);
				return $table;
			}else{
				return false;
			}
        }
        function hoantienHS($mahd){
            $con;
			$p = new clsketnoi();
			if ($p->ketnoidb($con)){
				$chuoi="UPDATE `hoadonhs` SET `TrangThaiHoaDon` = '2' WHERE `hoadonhs`.`MaHoaDon` = $mahd;";
				$table =  mysqli_query($con, $chuoi);
				$p->dongketnoi($con);
				return $table;
			}else{
				return false;
			}
        }
        function thanhtoaGV($mahd, $tongtien){
            $con;
			$p = new clsketnoi();
			if ($p->ketnoidb($con)){
				$chuoi= "UPDATE `hoadongv` SET `SoTien` = '$tongtien', `TrangThaiHoaDon` = '1' WHERE `hoadongv`.`MaHoaDon` = $mahd;";
				$table =  mysqli_query($con, $chuoi);
				$p->dongketnoi($con);
				return $table;
			}else{
				return false;
			}
        }
        
        function thanhtoaQL($mahd){
            $con;
			$p = new clsketnoi();
			if ($p->ketnoidb($con)){
				$chuoi="UPDATE `hoadonql` SET `TrangThaiHoaDon` = '1' WHERE `hoadonql`.`MaHoaDon` = $mahd;";
				$table =  mysqli_query($con, $chuoi);
				$p->dongketnoi($con);
				return $table;
			}else{
				return false;
			}
        }
        function updatetienql($mahd, $sotien){
            $con;
			$p = new clsketnoi();
			if ($p->ketnoidb($con)){
				$chuoi="UPDATE `hoadonql` SET `SoTien` = '$sotien' WHERE `hoadonql`.`MaHoaDon` = $mahd;";
				$table =  mysqli_query($con, $chuoi);
				$p->dongketnoi($con);
				return $table;
			}else{
				return false;
			}
        }
        function updatebangluong($maluong, $sotien){
            $con;
			$p = new clsketnoi();
			if ($p->ketnoidb($con)){
				$chuoi="UPDATE `bangluong` SET `SoTien` = '$sotien' WHERE `bangluong`.`MaLuong` = $maluong";
				$table =  mysqli_query($con, $chuoi);
				$p->dongketnoi($con);
				return $table;
			}else{
				return false;
			}
        }
		function xoahoadonhs($mahs){
            $con;
			$p = new clsketnoi();
			if ($p->ketnoidb($con)){
				$chuoi="DELETE FROM hoadonhs WHERE MaHS = $mahs AND TrangThaiHoaDon = 0";
				$table =  mysqli_query($con, $chuoi);
				$p->dongketnoi($con);
				return $table;
			}else{
				return false;
			}
        }
    }
