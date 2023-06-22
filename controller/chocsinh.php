<?php 
	include_once("model/mhocsinh.php");
	class controlhocsinh{
		function laydshs($limit,$count){
			$p = new modelhocsinh();
			$tblPro = $p->chondshs($limit,$count);
			return ($tblPro);
		}
		function laydslophoc(){
			$p = new modelhocsinh();
			$tblPro = $p->chondslophoc();
			return ($tblPro);
		}
        function layctdshs($malop){
			$p = new modelhocsinh();
			$tblPro = $p->chonctdshs($malop);
			return ($tblPro);
		}
		function chondshschhoc($malop){
			$p = new modelhocsinh();
			$tblPro = $p->chondshschhoc($malop);
			return ($tblPro);
		}
		function chon1hschhoc($malop, $mahs){
			$p = new modelhocsinh();
			$tblPro = $p->chon1hschhoc($malop, $mahs);
			return ($tblPro);
		}
		function lay1hs($tenDN){
			$p = new modelhocsinh();
			$tblPro = $p->chon1hs($tenDN);
			return ($tblPro);
		}
		function lay1hs1($tenDN){
			$p = new modelhocsinh();
			$tblPro = $p->chon1hs1($tenDN);
			return ($tblPro);
		}
		function demAllhocsinh(){
			$p = new modelhocsinh();
			$tblPro = $p->demAllhocsinh();
			$row = mysqli_fetch_assoc($tblPro);
			$soluong = $row["COUNT(MaHS)"];
			return ($soluong);
		}
		function demhocsinhTrunglich($ngay, $thu, $tiet, $malop, $malich){
			$p = new modelhocsinh();
			$demsoHSbitrung = 0;
			$tblHocSinh = $p ->chonctdshs($malop);
			while($rowhs = mysqli_fetch_assoc($tblHocSinh)){
				$tablekiemtralichtrung = $p ->ktratrunglich1hs($ngay, $thu, $tiet, $rowhs["MaHS"]);
				if($tablekiemtralichtrung != 0 ){
					$demsoHSbitrung = $demsoHSbitrung + 1;
				}
			}
			return ($demsoHSbitrung);
		}
		function demhocsinh($ma){
			$p = new modelhocsinh();
			$tblPro = $p->demhocsinh($ma);
			$row = mysqli_fetch_assoc($tblPro);
			$soluong = $row["COUNT(MaHS)"];
			return ($soluong);
		}
		function themhocsinh($tenhocsinh, $ngay, $diachi, $gioitinh, $malop, $sdt, $email, $tenanh, $diachianh){
			$p = new modelhocsinh();
			//ktra số lượng học sinh
			$tblPro = $p->demhocsinh($malop);
			$row = mysqli_fetch_assoc($tblPro);
			$soluong = $row["COUNT(MaHS)"];
			//lấy thông tin lớp học
			include_once("model/mlich.php");
			$plich = new modellich();
			$tablelop = $plich -> laytietvabuoi($malop, 0);
			$rowlop = mysqli_fetch_assoc($tablelop);
			$siso = $rowlop["SiSo"];
			if($soluong < $siso){
				$soluong = $soluong + 1;
				$tiso = $soluong/$siso;
				if($tiso == 0.8){
					$kq = $plich -> CapNhatTrangThaiThanhMo($malop);
					if($kq == 1){

					}else{
						return 4; //cập nhật trạng thái thất bại
					}
				}
				$thoigianhientai = time();
				$tenmoi = $thoigianhientai.$tenanh;
				if(move_uploaded_file($diachianh,"view/images/".$tenmoi)){
					$last_id = $p->themhocsinh($tenhocsinh, $ngay, $diachi, $gioitinh, $malop, $sdt, $email, $tenmoi, $hinhanh);
				}else{
					return 6; //không thể upload
				}
				if($last_id){
					$themvaolop = $p->themhocsinhvaolophoc($malop, $last_id);
					if($themvaolop){
						include_once("model/mhoadon.php");
						$phoadon = new modelhoadon();
						$tablehoadon = $phoadon -> themhoadonHScoc($malop, $last_id);
						if($tablehoadon){
							return 1;
						}else{
							return 5; // thêm hóa đơn thất bại
						}
					}else{
						return 2; // lỗi thêm lớp
					}
				}else{
					return 0; //không thể chèn
				}
			}else{
				return 3; //số lượng học sinh đã đủ
			}
		}
		function themhocsinhvaolophoc($malh, $mahs){
			$p = new modelhocsinh();
			//ktra số lượng học sinh
			$tblPro = $p->demhocsinh($malh);
			$row = mysqli_fetch_assoc($tblPro);
			$soluong = $row["COUNT(MaHS)"];
			//lấy thông tin lớp học
			include_once("model/mlich.php");
			$plich = new modellich();
			$tablelop = $plich -> laytietvabuoi($malh, 0);
			$rowlop = mysqli_fetch_assoc($tablelop);
			$siso = $rowlop["SiSo"];
			if($soluong < $siso){
					$soluong = $soluong + 1;
					$tiso = $soluong/$siso;
				if($tiso == 0.8){
					$kq = $plich -> CapNhatTrangThaiThanhMo($malh);
					if($kq == 1){

					}else{
						return 4; //cập nhật trạng thái thất bại
					}
				}
				//lấy thông tin buổi và tiết
				for ($so = 0; $so <= 2; $so++) {
					$tabletietvabuoi = $plich->laytietvabuoi($malh, $so);
					if($tabletietvabuoi){
						while($rowtietvabuoi = mysqli_fetch_assoc($tabletietvabuoi)){
							//ktra lịch trùng
							$ktra = $p->ktratrunglichhs($rowtietvabuoi["NgayBD"], $rowtietvabuoi["MaThu"], $rowtietvabuoi["MaTiet"], $mahs);
							//echo "<script>alert('".$ktra."')</script>";
							if($ktra == 0){
								return 2; //lịch học sinh bị trùng
							}
						}
					}
				}
				//bắt đầu thêm học sinh
				$tblPro = $p->themhocsinhvaolophoc($malh, $mahs);
				if($tblPro){
					include_once("model/mhoadon.php");
					$phoadon = new modelhoadon();
					$tablehoadon = $phoadon -> themhoadonHScoc($malh, $mahs);
					if($tablehoadon){
						return 1;
					}else{
						return 5; // thêm hóa đơn thất bại
					}
				}else{
					return 0; //không thể chèn
				}
			}else{
				return 3; //số lượng học sinh đã đủ
			}
			
		}
		function updatehocsinh($tenhocsinh, $ngay, $diachi, $gioitinh,$ma, $sdt, $email){
			$p = new modelhocsinh();
			$tblPro = $p->updatehocsinh($tenhocsinh, $ngay, $diachi, $gioitinh, $ma, $sdt, $email);
			if($tblPro){
                return 1;
            }else{
                return 0; //không thể chèn
            }
		}
		function updatehocsinhCoanh($tenhocsinh, $ngay, $diachi, $gioitinh, $ma, $sdt, $email, $tenanh, $diachianh){
			$p = new modelhocsinh();
			$thoigianhientai = time();
			$tenmoi = $thoigianhientai.$tenanh;
			if(move_uploaded_file($diachianh,"view/images/".$tenmoi)){
				$table = $p -> updatehocsinhCoanh($tenhocsinh, $ngay, $diachi, $gioitinh, $ma, $sdt, $email, $tenmoi);
				if($table){
					return 1;
				}else{
					return 0;//không thể insert
				}
			}else{
				return 2; //không thể upload
			}
		}
		function xoahocsinhkhoilophoc($malop, $mahs){
			$p = new modelhocsinh();
			$tblPro = $p->xoahocsinhkhoilophoc($malop, $mahs);
			if($tblPro){
                return 1;
            }else{
                return 0; //không thể chèn
            }
		}
	}

?>