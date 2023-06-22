<?php 
	include_once("ketnoi.php");
	class modelbailam{
		function chonbailam($makt){
			$con;
			$p = new clsketnoi();
			if ($p->ketnoidb($con)){
				$chuoi="SELECT * FROM `bailam` 
                JOIN hocsinh on hocsinh.MaHS = bailam.MaHS 
                JOIN dekiemtra on dekiemtra.MaKT = bailam.MaKT 
                WHERE bailam.MaKT = $makt";
				$table =  mysqli_query($con, $chuoi);
				$p->dongketnoi($con);
				return $table;
			}else{
				return false;
			}
		}
		function chon1dapan($mabl, $mach){
			$con;
			$p = new clsketnoi();
			if ($p->ketnoidb($con)){
				$chuoi="SELECT * FROM `bailamtn` WHERE MaCHTN = $mach AND MaBL = $mabl";
				$table =  mysqli_query($con, $chuoi);
				$p->dongketnoi($con);
				return $table;
			}else{
				return false;
			}
		}
		function chonbai1lam($makt, $mahs){
			$con;
			$p = new clsketnoi();
			if ($p->ketnoidb($con)){
				$chuoi="SELECT * FROM `bailam`
                JOIN hocsinh on hocsinh.MaHS = bailam.MaHS 
                JOIN dekiemtra on dekiemtra.MaKT = bailam.MaKT 
                WHERE bailam.MaKT = $makt
				AND bailam.MaHS= $mahs";
				$table =  mysqli_query($con, $chuoi);
				$p->dongketnoi($con);
				return $table;
			}else{
				return false;
			}
		}
		function chonbai1lamvan($makt, $mahs){
			$con;
			$p = new clsketnoi();
			if ($p->ketnoidb($con)){
				$chuoi="SELECT * FROM `bailamvan` 
                JOIN hocsinh on hocsinh.MaHS = bailamvan.MaHS 
                JOIN dekiemtra on dekiemtra.MaKT = bailamvan.MaKT 
                WHERE bailamvan.MaKT = $makt
				AND bailamvan.MaHS= $mahs";
				$table =  mysqli_query($con, $chuoi);
				$p->dongketnoi($con);
				return $table;
			}else{
				return false;
			}
		}
		function chonchamdiem($mabl, $diem){
			$con;
			$p = new clsketnoi();
			if ($p->ketnoidb($con)){
				$chuoi="UPDATE `bailam` SET `Diem` = '$diem' WHERE `bailam`.`MaBL` = $mabl";
				$table =  mysqli_query($con, $chuoi);
				$p->dongketnoi($con);
				return $table;
			}else{
				return false;
			}
		}
		function chonchamdiemvan($mabl, $diem){
			$con;
			$p = new clsketnoi();
			if ($p->ketnoidb($con)){
				$chuoi="UPDATE `bailamvan` SET `Diem` = '$diem' WHERE `bailamvan`.`MaBL` = $mabl";
				$table =  mysqli_query($con, $chuoi);
				$p->dongketnoi($con);
				return $table;
			}else{
				return false;
			}
		}
		function nopbaivan($mabl, $tenfile){
			$con;
			$p = new clsketnoi();
			if ($p->ketnoidb($con)){
				$chuoi="UPDATE `bailamvan` SET `FileBaiLam` = '$tenfile' WHERE `bailamvan`.`MaBL` = $mabl";
				$table =  mysqli_query($con, $chuoi);
				$p->dongketnoi($con);
				return $table;
			}else{
				return false;
			}
		}
		function chonthembailamtn($makt, $mahs){
			$con;
			$p = new clsketnoi();
			if ($p->ketnoidb($con)){
				$chuoi="INSERT INTO `bailam` (`MaBL`, `Diem`, `MaKT`, `MaHS`) VALUES (NULL,  NULL, '$makt', '$mahs');";
				$table =  mysqli_query($con, $chuoi);
				$last_id = mysqli_insert_id($con);
				$p->dongketnoi($con);
				return $last_id;
			}else{
				return false;
			}
		}
		function chonthembailamtl($makt, $mahs){
			$con;
			$p = new clsketnoi();
			if ($p->ketnoidb($con)){
				$chuoi="INSERT INTO `bailamvan` (`MaBL`, `MaKT`, `MaHS`, `Diem`, `FileBaiLam`) VALUES (NULL, '$makt', '$mahs', NULL, NULL);";
				$table =  mysqli_query($con, $chuoi);
				$last_id = mysqli_insert_id($con);
				$p->dongketnoi($con);
				return $last_id;
			}else{
				return false;
			}
		}
		function themCTbailamtn($mach, $mabl){
			$con;
			$p = new clsketnoi();
			if ($p->ketnoidb($con)){
				$chuoi="INSERT INTO `bailamtn` (`MaCHTN`, `MaBL`, `CauTL`) VALUES ('$mach', '$mabl', NULL);;";
				$table =  mysqli_query($con, $chuoi);
				$p->dongketnoi($con);
				return $table;
			}else{
				return false;
			}
		}
		//update cau tra loi trac nghiem
		function chonupdatecautraloitracnghiem($mabl, $mach, $dapan){
			$con;
			$p = new clsketnoi();
			if ($p->ketnoidb($con)){
				$chuoi="UPDATE `bailamtn` SET `CauTL` = '$dapan' WHERE `MaCHTN` = $mach AND `MaBL` = $mabl;";
				$table =  mysqli_query($con, $chuoi);
				$p->dongketnoi($con);
				return $table;
			}else{
				return false;
			}
		}
		function chonlaydiem($mabl, $makt){
			$con;
			$p = new clsketnoi();
			
			if ($p->ketnoidb($con)){
				// lay cau tra loi
				$chuoi="SELECT * FROM `bailamtn` WHERE MaBL = $mabl";
				$table =  mysqli_query($con, $chuoi);
				$diemtong = 0;
				// so sanh tung cau tra loi
				while ($row = mysqli_fetch_assoc($table)) {
					$mach = $row["MaCHTN"];
					//lay dap an dung
					$chuoi2="SELECT * FROM `cauhoitn` WHERE `MaCHTN` = $mach";
					$table2 =  mysqli_query($con, $chuoi2);
					$row2 = mysqli_fetch_assoc($table2);
					//so sanh dap ap
					if($row2["DapAn"] == $row["CauTL"]){
						$diemtong = $diemtong + $row2["SoDiem"];
					}
				}
				$chuoi="UPDATE `bailam` SET `Diem` = '$diemtong' WHERE `MaBL` = $mabl;";
				$table =  mysqli_query($con, $chuoi);
				$p->dongketnoi($con);
					return $table;
			}else{
				return false;
			}
		}
	}
?>