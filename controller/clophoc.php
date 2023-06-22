<?php
include_once("model/mlophoc.php");
class controllophoc
{
	function chonlophocdangmo()
	{
		$p = new modellophoc();
		$tblPro = $p->chonlophocdangmo();
		return ($tblPro);
	}
	function chonlophocdangmo2()
	{
		$p = new modellophoc();
		$tblPro = $p->chonlophocdangmo2();
		return ($tblPro);
	}
	function chonlophocdangmo3()
	{
		$p = new modellophoc();
		$tblPro = $p->chonlophocdangmo3();
		return ($tblPro);
	}
	function chonlophocdangmo2chogv($ma)
	{
		$p = new modellophoc();
		$tblPro = $p->chonlophocdangmo2chogv($ma);
		return ($tblPro);
	}
	function chonlophockt2chogv($ma)
	{
		$p = new modellophoc();
		$tblPro = $p->chonlophockt2chogv($ma);
		return ($tblPro);
	}
	function chon1lophoc($ma)
	{
		$p = new modellophoc();
		$tblPro = $p->chon1lophoc($ma);
		return ($tblPro);
	}
	function themlophoc($tenlop, $siso, $giaovien, $thoigian, $hocphi, $thu1, $thu2, $thu3, $tiet1, $tiet2, $tiet3, $TimeKT, $id, $pass, $loailop)
	{
		$p = new modellophoc();
		//kiểm tra tên trùng
		$tablekiemtraten = $p->chonlophocdangmo();
		if ($tablekiemtraten) {
			while ($rowkiemtraten = mysqli_fetch_assoc($tablekiemtraten)) {
				if ($rowkiemtraten["TenLop"] == $tenlop) {
					return 1; //TÊN LỚP TRÙNG
				}
			}
		}
		// kiểm tra ngày bắt đầu
		$ngay = date('Y-m-d');
		$ngay = strtotime($ngay);
		$ngaylich = strtotime($thoigian);
		if ($ngaylich < $ngay) {
			return 5; // thời gian bắt đầu k được bé hơn tg kết thúc
		}
		//ktra lịch trùng cho giáo viên
		$tablekiemtralichtrung1 = $p->kiemtralichtrungGV($giaovien, $thoigian, $thu1, $tiet1);
		$tablekiemtralichtrung2 = $p->kiemtralichtrungGV($giaovien, $thoigian, $thu2, $tiet2);
		if ($tiet3 == 0 and $thu3 == 0) {
			$tablekiemtralichtrung3 = 1;
		} else {
			$tablekiemtralichtrung3 = $p->kiemtralichtrungGV($giaovien, $thoigian, $thu3, $tiet3);
		}
		if ($tablekiemtralichtrung1 == 1 and $tablekiemtralichtrung2 == 1 and $tablekiemtralichtrung3 == 1) {
			//bắt đầu thêm lớp
			$mavuatao = $p->themlophoc($tenlop, $siso, $giaovien, $thoigian, $hocphi, $id, $pass, $loailop);
			if ($mavuatao) {
				$kq1 = $p->thembuoihoc($mavuatao, $thu1, $tiet1);
				$kq2 = $p->thembuoihoc($mavuatao, $thu2, $tiet2);
				if ($tiet3 == 0 and $thu3 == 0) {
					$kq3 = 1;
				} else {
					$kq3 = $p->thembuoihoc($mavuatao, $thu3, $tiet3);
				}
				//kiểm tra thêm buổi
				if ($kq1 == 1 and $kq2 == 1 and $kq3 == 1) {
					//thêm lich
					include_once("model/mlich.php");
					$p = new modellich();
					$tblPro1 = $p->chonthemlich($mavuatao, $thoigian, $TimeKT, $thu1, $tiet1, $id, $pass, $giaovien);
					$tblPro2 = $p->chonthemlich($mavuatao, $thoigian, $TimeKT, $thu2, $tiet2, $id, $pass, $giaovien);
					if ($thu3 == 0 and $tiet3 == 0) {
						$tblPro3 = 1;
					} else {
						$tblPro3 = $p->chonthemlich($mavuatao, $thoigian, $TimeKT, $thu3, $tiet3, $id, $pass, $giaovien);
					}
					if ($tblPro1 == 1 and $tblPro2 == 1 and $tblPro3 == 1) {
						return 2; //THÊM DỮ LIỆU THÀNH CÔNG
					} else {
						return 0; //KHÔNG THỂ CHÈN
					}
				} else {
					return 3; //LỖI THÊM BUỔI
				}
			} else {
				return 0; //KHÔNG THỂ CHÈN
			}
		} else {
			return 4; // lịch giáo viên bị trùng
		}
	}
	function molop($malop, $ngaykt)
	{
		$p = new modellophoc();
		$tblPro = $p->molop($malop);
		if ($tblPro) {
			include_once("model/mlich.php");
			$plich = new modellich();
			$kqtrangthai = $plich->updatetrangthailop($malop);
			if ($kqtrangthai == 0) {
				return 0;
			}
			// chọn 1 lớp học
			$tblPro = $p->chon1lophoc($malop);
			$row = mysqli_fetch_assoc($tblPro);
			//thêm hóa đơn học sinh
			$ngaybd = $row["NgayBD"];
			$ngaybd = strtotime($ngaybd);
			$ngay = date("d", $ngaybd);
			$thang = date("m", $ngaybd);
			$nam = date("Y", $ngaybd);
			//cộng ngày
			$ngaydonghs = mktime(0, 0, 0, $thang + 1, $ngay, $nam);
			//đổi chuỗi thành ngày
			$ngaydonghs = strftime("%Y-%m-%d", $ngaydonghs);
			//số tiền
			$sotien = $row["HocPhi"] - 500000;
			//bắt đầu thêm hóa đơn
			include_once("model/mhoadon.php");
			$phoadon = new modelhoadon();
			include_once("model/mhocsinh.php");
			$phs = new modelhocsinh;
			$tblHocSinh = $phs->chonctdshs($malop);
			while ($rowhs = mysqli_fetch_assoc($tblHocSinh)) {
				$kqhoadon = $phoadon->themhoadonHS($malop, $rowhs["MaHS"], $ngaydonghs, $sotien);
				if ($kqhoadon == 0) {
					return 0;
				}
			}
			return 1;
		} else {
			return 0; //không thể chèn
		}
	}
	function updatelophoc($tenlop, $sisi, $magv, $makhoi, $malop)
	{
		$p = new modellophoc();
		$tblPro = $p->updatelophoc($tenlop, $sisi, $magv, $makhoi, $malop);
		if ($tblPro) {
			return 1;
		} else {
			return 0; //không thể chèn
		}
	}
	function huylop($malop)
	{
		include_once("model/mlich.php");
		$p = new modellich();
		$kqlich = $p->xoalichchuahoc($malop);
		if ($kqlich != 1) {
			return 0;
		}
		$p = new modellophoc();
		$tblPro = $p->huylop($malop);
		if ($tblPro) {
			return 1;
		} else {
			return 0; //không thể chèn
		}
	}
}
