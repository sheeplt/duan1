<?php
ob_start();
$makt = $_REQUEST["themch"];
$malop = $_REQUEST["malop"];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm câu hỏi</title>
    <link rel="stylesheet" href="view/styles/bootstrap.min.css">
    <script src="view/js/bootstrap.min.js"></script>
</head>

<body>
<div class="popular page_section">
	<div class="container">
		<div class="row">
			<div class="col">
				<div class="section_title text-center">
					<h1>THÊM CÂU HỎI</h1>
				</div>
			</div>
		</div>
    <?php

    include_once("controller/ckiemtra.php");
    $pkiemtra = new controlkiemtra;
    $diem = $pkiemtra -> layktratn($makt);
			 $kqdiem = 0;
			 if ($diem) {
				 if (mysqli_num_rows($diem) > 0) {
					 while ($rowdiem = mysqli_fetch_assoc($diem)) {
						 $kqdiem = $kqdiem + $rowdiem['SoDiem'];
					 }
				 }
			 }
    if($kqdiem == 10){
        echo header("refresh:0; url='GV.php?xemdethichitiet=".$makt."&malop=".$malop."'");
    }
    echo "Tổng điểm hiện tại: ".$kqdiem;
    ?>
    <form class="js-form-submit-data" action="#" method="POST">
        <div class="form-group row">
            <label for="DapAn" class="col-md-2 offset-md-2 col-form-label">Đáp án đúng</label>
            <div class="col-md-6">
                <input type="radio" checked id="DapAn" name="DapAn" value="A">
                <label for="DapAn"> A</label>  &nbsp;&nbsp;&nbsp;
                <input type="radio" id="DapAn" name="DapAn" value="B">
                <label for="DapAn"> B</label> &nbsp;&nbsp;&nbsp;
                <input type="radio" id="DapAn" name="DapAn" value="C">
                <label for="DapAn"> C</label> &nbsp;&nbsp;&nbsp;
                <input type="radio" id="DapAn" name="DapAn" value="D">
                <label for="DapAn"> D</label> &nbsp;&nbsp;&nbsp;
            </div>
        </div>
        <div class="form-group row">
            <label for="diem" class="col-md-2 offset-md-2 col-form-label">Số điểm của câu</label>
            <div class="col-md-6">
                <input type="number" require class="form-control " id="diem" name="diem" value="">
            </div>
        </div>
        <div class="form-group row mt-5">
            <label for="user_email" class="col-md-2 col-form-label"></label>
            <div class="col-md-8">
                <button type="submit" name="tn" class="btn btn-primary btn-lg mb-2 btn-block">Thêm câu hỏi</button>
            </div>
        </div>
    </form>
    <?php
    include_once("controller/ccauhoi.php");
    $p1 = new controlcauhoi();
    if (isset($_REQUEST["tn"])) {
        $diem = $_REQUEST["diem"];
        $da = $_REQUEST["DapAn"];
            if($diem + $kqdiem <= 10){
                $kq = $p1->laythemchtn($makt, $da, $diem);
                if ($kq == 1) {
                    echo header("refresh:0; url='GV.php?themch=".$makt."&malop=".$malop."'");
                } elseif ($kq == 0) {
                    echo "<script>alert('Không thể update lỗi')</script>";
                }
            }else{
                echo "<script>alert('Số điểm vượt quá mức quy định')</script>";
            }
        
    }
    ?>
    </div></div>
</body>

</html>