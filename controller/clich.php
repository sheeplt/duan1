<?php 
	include_once("model/mlich.php");
	class controllich{
		function laylichchoGV2($maGV, $ngay){
			$p = new modellich();
			$tblPro = $p->chonlichchoGV2($maGV, $ngay);
			return ($tblPro);
		}
		function laylichchoGV3($maGV, $ngay){
			$p = new modellich();
			$tblPro = $p->chonlichchoGV3($maGV, $ngay);
			return ($tblPro);
		}
		function laylichchoGV1($maGV, $ngay){
			$p = new modellich();
			$tblPro = $p->chonlichchoGV1($maGV, $ngay);
			return ($tblPro);
		}
		function laylichchoHS2($malop, $ngay){
			$p = new modellich();
			$tblPro = $p->chonlichchoHS2($malop, $ngay);
			return ($tblPro);
		}
		function laylichchoHS3($malop, $ngay){
			$p = new modellich();
			$tblPro = $p->chonlichchoHS3($malop, $ngay);
			return ($tblPro);
		}
		function laylichchoHS1($malop, $ngay){
			$p = new modellich();
			$tblPro = $p->chonlichchoHS1($malop, $ngay);
			return ($tblPro);
		}
		function laylichchoGV($maGV){
			$p = new modellich();
			$tblPro = $p->chonlichchoGV($maGV);
			return ($tblPro);
		}
		function laytietvabuoi($malop, $so){
			$p = new modellich();
			$tblPro = $p->laytietvabuoi($malop, $so);
			return ($tblPro);
		}
		function themlichhocbu($lophoc, $gvtructiep, $ngay, $tiet, $thu, $id, $pass, $ghichu){
			$p = new modellich();
			include_once("model/mlophoc.php");
			$plop= new modellophoc;
			$tablekiemtralichtrung1 = $plop ->kiemtralichtrung1GV($gvtructiep, $ngay, $thu, $tiet);
			if($tablekiemtralichtrung1 == 1 ){
				$tblPro = $p->themlichhocbu($lophoc, $gvtructiep, $ngay, $tiet, $thu, $id, $pass, $ghichu);
				if($tblPro == 1){
					return 1;
				}else{
					return 0; //không thể chèn
				}
			}else {
				return 2;// trùng lịch với giáo viên
			}
			
		}
		function chonlichchoQL(){
			$p = new modellich();
			$tblPro = $p->chonlichchoQL();
			return ($tblPro);
		}
		function layngayketthuc($ma){
			$p = new modellich();
			$tblPro = $p->chonngayketthuc($ma);
			return ($tblPro);
		}
		function laylichtheotietchoQL($malop){
			$p = new modellich();
			$tblPro = $p->chonlichtheotietchoQL($malop);
			return ($tblPro);
		}
		function lay1lich($malich){
			$p = new modellich();
			$tblPro = $p->chon1lich($malich);
			return ($tblPro);
		}
		function laylichtheongaychoQL($malop, $tiet, $thu){
			$p = new modellich();
			$tblPro = $p->chonlichtheongaychoQL($malop, $tiet, $thu);
			return ($tblPro);
		}
		function laylichtheongaychoQL1($malop, $tiet, $thu){
			$p = new modellich();
			$tblPro = $p->chonlichtheongaychoQL1($malop, $tiet, $thu);
			return ($tblPro);
		}
		function laylichtheongaychoQL2($malop, $mamonhoc, $tiet, $thu){
			$p = new modellich();
			$tblPro = $p->chonlichtheongaychoQL2($malop, $mamonhoc, $tiet, $thu);
			return ($tblPro);
		}
		function chonlichtheongaybuchoQL($malop){
			$p = new modellich();
			$tblPro = $p->chonlichtheongaybuchoQL($malop);
			return ($tblPro);
		}
		function layupdate1chhoc($malop, $maGV){
			$ngay = date('Y-m-d');
			$p = new modellich();
			include_once("model/mlophoc.php");
			$plop= new modellophoc;
			//lấy thu và tiết
			$tablelich = $p->lichchitiet($malop);
			if(mysqli_num_rows($tablelich) == 2){
				$thu3 = 0;
				$tiet3 = 0;
			}else{
				$table1buoi = $p->laytietvabuoi($malop, 0);
				$row1buoi = mysqli_fetch_assoc($table1buoi);
				$thu3 = $row1buoi["MaThu"];
				$tiet3 = $row1buoi["MaTiet"];
			}
				$table1buoi = $p->laytietvabuoi($malop, 0);
				$row1buoi = mysqli_fetch_assoc($table1buoi);
				$thu1 = $row1buoi["MaThu"];
				$tiet1 = $row1buoi["MaTiet"];
				$table1buoi = $p->laytietvabuoi($malop, 1);
				$row1buoi = mysqli_fetch_assoc($table1buoi);
				$thu2 = $row1buoi["MaThu"];
				$tiet2 = $row1buoi["MaTiet"];
			//ktra lịch trùng cho giáo viên
			$tablekiemtralichtrung1 = $plop ->kiemtralichtrungGV($maGV, $ngay, $thu1, $tiet1);
			$tablekiemtralichtrung2 = $plop ->kiemtralichtrungGV($maGV, $ngay, $thu2, $tiet2);
			if($tiet3 == 0 and $thu3 == 0){
				$tablekiemtralichtrung3 = 1;
				}else{
					$tablekiemtralichtrung3 = $plop ->kiemtralichtrungGV($maGV, $ngay, $thu3, $tiet3);
				}
			if($tablekiemtralichtrung1 == 1 and $tablekiemtralichtrung2 == 1 and $tablekiemtralichtrung3 == 1){
				//update lịch
				$kqlich = $p->chonupdate1chhoc($malop, $maGV);
				if($kqlich){
					//update giao viên mới
					$kqlop = $p->chonupdate1lophoc($malop, $maGV);
					if($kqlop){
						return 1; //thêm thành công
					}else {
						return 0; //không thể chèn
					}
				}else{
					return 0; //không thể chèn
				}
			}else{
				return 2; // lịch giáo viên bị trùng
			}
		}
		function layupdate1chitietlophoc($malop, $maGV, $tenlop, $siso, $ngay, $hocphi, 
			$thu1, $tiet1, $thu1cu, $tiet1cu, $thu2, $tiet2, $thu2cu, $tiet2cu,$thu3, $tiet3, $thu3cu, $tiet3cu, $magvcu, $id, $pass){
			$p = new modellich();
			//kiểm tra có phải giáo viên cũ hay k
			if($maGV == $magvcu and $thu1 == $thu1cu and $tiet1 == $tiet1cu and $thu2 == $thu2cu and $tiet2 == $tiet2cu and $thu3 == $thu3cu and $tiet3 == $tiet3cu){

			}else{
				// kiểm tra lịch trùng của giáo viên
					include_once("model/mlophoc.php");
					$plop= new modellophoc;
					// trường hợp là giáo viên mới
					if($magvcu != $maGV){
						$tablekiemtralichtrung1 = $plop ->kiemtralichtrungGV($maGV, $ngay, $thu1, $tiet1);
						$tablekiemtralichtrung2 = $plop ->kiemtralichtrungGV($maGV, $ngay, $thu2, $tiet2);
						if($tiet3 == 0 and $thu3 == 0){
							$tablekiemtralichtrung3 = 1;
							}else{
								$tablekiemtralichtrung3 = $plop ->kiemtralichtrungGV($maGV, $ngay, $thu3, $tiet3);
							}
						if($tablekiemtralichtrung1 == 1 and $tablekiemtralichtrung2 == 1 and $tablekiemtralichtrung3 == 1){

						}else{
							return 3; // lịch giáo viên bị trùng
						}
					}
					// trường hợp là giáo viên cũ nhưng đổi lịch
					if($thu1 != $thu1cu or $tiet1 != $tiet1cu){
						$tablekiemtralichtrung1 = $plop ->kiemtralichtrungGV($maGV, $ngay, $thu1, $tiet1);
						if($tablekiemtralichtrung1 != 1){
							return 3; // lịch giáo viên bị trùng
						}
					}
					if($thu2 != $thu2cu or $tiet2 != $tiet2cu){
						$tablekiemtralichtrung2 = $plop ->kiemtralichtrungGV($maGV, $ngay, $thu2, $tiet2);
						if($tablekiemtralichtrung2 != 1){
							return 3; // lịch giáo viên bị trùng
						}
					}
					if($thu3 != $thu3cu or $tiet3 != $tiet3cu){
						$tablekiemtralichtrung3 = $plop ->kiemtralichtrungGV($maGV, $ngay, $thu3, $tiet3);
						if($tablekiemtralichtrung3 != 1){
							return 3; // lịch giáo viên bị trùng
						}
					}
					//kiểm tra lịch trùng với học sinh
					if($thu1 != $thu1cu or $tiet1 != $tiet1cu){
						include_once("model/mhocsinh.php");
						$phs= new modelhocsinh;
						$tblHocSinh = $phs ->chonctdshs($malop);
						while($rowhs = mysqli_fetch_assoc($tblHocSinh)){
							$tablekiemtralichtrung = $phs ->ktratrunglichhs($ngay, $thu1, $tiet1, $rowhs["MaHS"]);
							if($tablekiemtralichtrung == 0){
								return 4; //lịch học sinh bị trùng
							}
						}
					}
					if($thu2 != $thu2cu or $tiet2 != $tiet2cu){
						include_once("model/mhocsinh.php");
						$phs= new modelhocsinh;
						$tblHocSinh = $phs ->chonctdshs($malop);
						while($rowhs = mysqli_fetch_assoc($tblHocSinh)){
							$tablekiemtralichtrung = $phs ->ktratrunglichhs($ngay, $thu2, $tiet2, $rowhs["MaHS"]);
							if($tablekiemtralichtrung == 0){
								return 4; //lịch học sinh bị trùng
							}
						}
					}
					if($thu3 != $thu3cu or $tiet3 != $tiet3cu){
						include_once("model/mhocsinh.php");
						$phs= new modelhocsinh;
						$tblHocSinh = $phs ->chonctdshs($malop);
						while($rowhs = mysqli_fetch_assoc($tblHocSinh)){
							$tablekiemtralichtrung = $phs ->ktratrunglichhs($ngay, $thu3, $tiet3, $rowhs["MaHS"]);
							if($tablekiemtralichtrung == 0){
								return 4; //lịch học sinh bị trùng
							}
						}
					}
			}
			// cập nhật trên bảng lop học
			$kq = $p->chonupdate1chitietlophoc($malop, $maGV, $tenlop, $siso, $ngay, $hocphi, $id, $pass);
			if($kq != 1){
				return 0; //không thể chèn
			}
			$kqxoa = $p->xoalichthaydoi($malop, $ngay);
			if($kqxoa != 1){
				return 0; //không thể chèn
			}
			//cập nhật buổi học
			$kq1 = $p->chonupdate1chitietbuoihoc($malop, $thu1, $tiet1, $thu1cu, $tiet1cu);
			$kq2 = $p->chonupdate1chitietbuoihoc($malop, $thu2, $tiet2, $thu2cu, $tiet2cu);
			if($tiet3 == 0 and $thu3 == 0){
				$kq3 = 1;
			}else{
				$kq3 = $p->chonupdate1chitietbuoihoc($malop, $thu3, $tiet3, $thu3cu, $tiet3cu);
			}
			if($kq1 != 1 and $kq2 != 1 and $kq3 != 1){
				return 2; // lỗi cập nhật buổi
			}
			// cập nhật trên lịch
				// mã gv
				if($magvcu != $maGV){
					$kqgiaovien = $p->chonupdate1chhoc($malop, $maGV);
					if($kqgiaovien != 1){
						return 0; //không thể chèn
					}
				}
				// cập nhật id
					$kqlich = $p->chonupdateIdchhoc($malop, $id, $pass);
					if($kqlich != 1){
						return 0; //không thể chèn
					}
				// cập nhật thứ
				//echo "<script>alert('".$tiet1cu, $tiet1."')</script>";
				if($thu1 != $thu1cu or $tiet1 != $tiet1cu){
					//lấy từng buổi chưa học
					$tblChHoc = $p->ALLlichtheoNgay($malop, $tiet1cu, $thu1cu);
					if(mysqli_num_rows($tblChHoc)>0){
						while($row=mysqli_fetch_assoc($tblChHoc)){
							$ngayhoc = $row["Ngay"];
							//bắt đầu cập nhật từng buổi
							$kq = $p->chonupdate2chhoc($malop, $tiet1cu, $thu1cu, $tiet1, $thu1, $ngayhoc, $ngayhoc);
							if($kq == 0){
								return 0; //không thể chèn
							}
						}
					}
				}
				if($thu2 != $thu2cu or $tiet2 != $tiet2cu){
					//lấy từng buổi chưa học
					$tblChHoc = $p->ALLlichtheoNgay($malop, $tiet2cu, $thu2cu);
					if(mysqli_num_rows($tblChHoc)>0){
						while($row=mysqli_fetch_assoc($tblChHoc)){
							$ngayhoc = $row["Ngay"];
							//bắt đầu cập nhật từng buổi
							$kq = $p->chonupdate2chhoc($malop, $tiet2cu, $thu2cu, $tiet2, $thu2, $ngayhoc, $ngayhoc);
							if($kq == 0){
								return 0; //không thể chèn
							}
						}
					}
				}
				if($thu3 != $thu3cu or $tiet3 != $tiet3cu){
					//lấy từng buổi chưa học
					$tblChHoc = $p->ALLlichtheoNgay($malop, $tiet3cu, $thu3cu);
					if(mysqli_num_rows($tblChHoc)>0){
						while($row=mysqli_fetch_assoc($tblChHoc)){
							$ngayhoc = $row["Ngay"];
							//bắt đầu cập nhật từng buổi
							$kq = $p->chonupdate2chhoc($malop, $tiet3cu, $thu3cu, $tiet3, $thu3, $ngayhoc, $ngayhoc);
							if($kq == 0){
								return 0; //không thể chèn
							}
						}
					}
				}
			return 1;
		}
		function layupdate13chhoc($malop, $id, $pass){
			$p = new modellich();
			// cập nhật lich
				$kqbuoicu = $p->chonupdate13lich($malop, $id, $pass);
				if($kqbuoicu != 1){
					return 0; // Lỗi cập nhật 
				}
			// cập nhật lớp
				$kqbuoimoi = $p->chonupdate13lophoc($malop, $id, $pass);
				if($kqbuoimoi != 1){
					return 0; // Lỗi cập nhật 
				}
			return 1;
		}
		function layupdate2chhoc($malop, $tiet, $thu, $tietup, $thuup, $maGV){
			$p = new modellich();
			//kiểm tra buổi được thanh đổi hay chưa
			if($tiet == $tietup and $thu = $thuup){
				return 2; // chưa thay đổi tiết học
			}
			//kiểm tra lịch trùng của giảng viên
			$ngay = date('Y-m-d');
			include_once("model/mlophoc.php");
			$plop= new modellophoc;
			$tablekiemtralichtrung1 = $plop ->kiemtralichtrungGV($maGV, $ngay, $thuup, $tietup);
			if($tablekiemtralichtrung1 != 1 ){
				return 3; // lịch giáo viên bị trùng
			}
			//kiểm tra lịch trùng của học sinh
			if($thu != $thuup or $tiet != $tietup){
				include_once("model/mhocsinh.php");
				$phs= new modelhocsinh;
				$tblHocSinh = $phs ->chonctdshs($malop);
				while($rowhs = mysqli_fetch_assoc($tblHocSinh)){
					$tablekiemtralichtrung = $phs ->ktratrunglichhs($ngay, $thuup, $tietup, $rowhs["MaHS"]);
					if($tablekiemtralichtrung == 0){
						return 4; //lịch học sinh bị trùng
					}
				}
			}
			// cập nhật bản chi tiết
				// cập nhật thứ buối cũ
				$kqbuoicu = $p->updateChitietBuoiCu($malop, $thu, $tiet);
				if($kqbuoicu == 0){
					return 0; // Lỗi cập nhật 
				}
				// thêm buổi học mới
				include_once("model/mlophoc.php");
				$plophoc = new modellophoc;
				$kqbuoimoi = $plophoc->thembuoihoc($malop, $thuup, $tietup);
				if($kqbuoimoi == 0){
					return 0; // Lỗi cập nhật 
				}

			//lấy từng buổi chưa học
			$tblChHoc = $p->chonlichtheongaychoQL($malop, $tiet, $thu);
			if(mysqli_num_rows($tblChHoc)>0){
				while($row=mysqli_fetch_assoc($tblChHoc)){
					$ngayhoc = $row["Ngay"];
					//bắt đầu cập nhật từng buổi
					$kq = $p->chonupdate2chhoc($malop, $tiet, $thu, $tietup, $thuup, $ngayhoc, $ngayhoc);
					if($kq == 0){
						return 0; //không thể chèn
					}
				}
				return 1;
			}
			
		}
		// update lịch bù
		function layupdate3($malich, $tiet, $ngay, $magv, $ghichu, $thu, $id, $pass, $malop){
			$p = new modellich();
			include_once("model/mlophoc.php");
			$plop= new modellophoc;
			//ktra lịch trùng với gv
			$tablekiemtralichtrung1 = $plop ->kiemtralichtrung1GV($magv, $ngay, $thu, $tiet);
			if($tablekiemtralichtrung1 != 1 ){
				return -2;// trùng lịch với giáo viên
			}
			//ktra lịch trùng với hs
				$demsoHSbitrung = 0;
				include_once("model/mhocsinh.php");
				$phs= new modelhocsinh;
				$tblHocSinh = $phs ->chonctdshs($malop);
				while($rowhs = mysqli_fetch_assoc($tblHocSinh)){
					$tablekiemtralichtrung = $phs ->ktratrunglich1hs($ngay, $thu, $tiet, $rowhs["MaHS"]);
					if($tablekiemtralichtrung != 0){
						$demsoHSbitrung = $demsoHSbitrung + 1;
					}
				}
				if($demsoHSbitrung == 0){
					$demsoHSbitrung = -1;
				}
			$tblPro = $p->chonupdate3($malich, $tiet, $ngay, $magv, $ghichu, $thu, $id, $pass);
				if($tblPro == 1){
					return $demsoHSbitrung;
				}else{
					return 0; //không thể chèn
				}
		}
		// update 3
		function chonupdate33($malich, $magv, $ghichu, $id, $pass, $ngay, $thu, $tiet){
			$p = new modellich();
			include_once("model/mlophoc.php");
			$plop= new modellophoc;
			$tablekiemtralichtrung1 = $plop ->kiemtralichtrung1GV($magv, $ngay, $thu, $tiet);
			if($tablekiemtralichtrung1 == 1){
				$tblPro = $p->chonupdate33($malich, $magv, $ghichu, $id, $pass);
				if($tblPro == 1){
					return 1;
				}else{
					return 0; //không thể chèn
				}
			}
		}
		function chonupdate333($malich, $ghichu, $id, $pass){
			$p = new modellich();
			$tblPro = $p->chonupdate333($malich, $ghichu, $id, $pass);
			if($tblPro){
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
		function laysomonhocchohs($malop){
			$p = new modellich();
			$tblPro = $p->chonsomonhocchohs($malop);
			return ($tblPro);
		}
		function layxoalich1($malophoc, $mamonhoc){
			$p = new modellich();
			$tblPro = $p->chonxoalich1($malophoc, $mamonhoc);
			if($tblPro){
				return 1;
			}else{
				return 0; //không thể chèn
			}
		}
		function layxoalich2($malophoc, $mamonhoc, $tiet, $thu){
			$p = new modellich();
			$tblPro = $p->chonxoalich2($malophoc, $mamonhoc, $tiet, $thu);
			if($tblPro){
				return 1;
			}else{
				return 0; //không thể chèn
			}
		}
		function layxoalich3($malich){
			$p = new modellich();
			$tblPro = $p->chonxoalich3($malich);
			if($tblPro){
				return 1;
			}else{
				return 0; //không thể chèn
			}
		}
		function lichchitiet($malop){
			$p = new modellich();
			$tblPro = $p->lichchitiet($malop);
			return ($tblPro);
		}
	}

?>