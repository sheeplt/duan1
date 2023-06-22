<!DOCTYPE html>
<html lang="en">
<?php
ob_start();
$tenDN = $_SESSION["tendangnhap"];
$malop = $_REQUEST['themdekt'];
//lay ma GV
include_once("controller/cgiaovien.php");
$giavien = new controlgiaovien();
$table = $giavien->lay1giaovien($tenDN);
$row = mysqli_fetch_assoc($table);
$magv = $row["MaGV"];
$mamonhoc = $row["MaMonHoc"];
//them kiem tra
if (isset($_REQUEST["btnsubmit"])) {
    $tieude = $_REQUEST["tieude"];
    $time = $_REQUEST["Time"];
    $timebd = $_REQUEST["TimeBD"];
    $timekt = $_REQUEST["TimeKT"];
    
    date_default_timezone_set('Asia/Ho_Chi_Minh');
            $today = date("Y-m-d H:i:s"); 
            $today_dt = strtotime($today);
            $timekt_dt = strtotime($timekt);
            $timebd_dt = strtotime($timebd);

            $file = $_FILES["filede"]["tmp_name"];
            $tenfile = $_FILES["filede"]["name"];

            $datediff = abs($timekt_dt - $timebd_dt);
            $chechlech = floor($datediff / (60)); 
    //kiểm tra thời gian
    if($today_dt > $timekt_dt){
        echo "<script>alert('Thời gian kết thúc không được nhỏ hơn thời gian hiện tại')</script>";

    }elseif($chechlech < $time){
        echo "<script>alert('Thời gian làm bài không đủ')</script>";
    }elseif($timebd_dt >= $timekt_dt){
        echo "<script>alert('Thời gian bắt đầu không được lớn hơn thời gian kết thúc')</script>";
    }else{
        include_once("controller/ckiemtra.php");
        $kiemtra = new controlkiemtra();
        $kq = $kiemtra->laythemkt($time, $tieude, $hinhthuc, $timebd, $timekt, $magv, $malop, $tuanthi, $file, $tenfile);
        if ($kq == 0) {
            echo "<script>alert('Không thể thêm lỗi')</script>";
        } else {
            if($mamonhoc == 2){
                echo header("refresh:0; url='GV.php?xemdethichitiet=".$kq."&malop=".$malop."'");
            }else{
                echo header("refresh:0; url='GV.php?themch=" . $kq . "&malop=".$malop."'");
            }
        }
    }
}else{}
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm bài kiểm tra</title>
    <link rel="stylesheet" href="view/styles/lich_day.css">
    <link rel="stylesheet" href="view/styles/bootstrap.min.css">
    <script src="view/js/bootstrap.min.js"></script>
</head>

<body>
<div class="popular page_section">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="section_title text-center">
                            <h1 style="margin-bottom: 50px;"></h1>
                        </div>
                    </div>
                </div>
    <div class="container-fluid">
        <div class="row">
            <div class="ml-sm-auto col-lg-1"></div>
            <main role="main" class="ml-sm-auto col-lg-10">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
                    <h1 class="h2" style="padding-left: 100px;">TẠO BÀI KIỂM TRA</h1>
                </div>
                <form class="js-form-submit-data" action="#" method="POST" enctype="multipart/form-data">
                    <div class="form-group row">
                        <label for="tieude" class="col-md-2 offset-md-2 col-form-label">Tiêu đề</label>
                        <div class="col-md-6">
                            <input type="text" required class="form-control " id="tieude" name="tieude" value="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="Time" class="col-md-2 offset-md-2 col-form-label">Thời gian (phút)</label>
                        <div class="col-md-6">
                            <input type="text" required class="form-control " id="Time" name="Time" value="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="Time" class="col-md-2 offset-md-2 col-form-label">File đề:</label>
                        <div class="col-md-6">
                            <input type="file" required class="form-control " id="filede" name="filede" value="" accept=".doc,.docx,.xml,.pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="TimeBD" class="col-md-2 offset-md-2 col-form-label">Thời gian bắt đầu</label>
                        <div class="col-md-6">
                            <input type="datetime-local" required class="form-control " id="TimeBD" name="TimeBD" value="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="TimeKT" class="col-md-2 offset-md-2 col-form-label">Thời gian kết thúc</label>
                        <div class="col-md-6">
                            <input type="datetime-local" required class="form-control " id="TimeKT" name="TimeKT" value="">
                        </div>
                    </div>
                    
                    <div class="form-group row mt-5">
                        <label for="user_email" class="col-md-2 col-form-label"></label>
                        <div class="col-md-8">
                            <?php if($mamonhoc == 2){ ?>
                            <button type="submit" name="btnsubmit" class="btn btn-primary btn-lg mb-2 btn-block">Thêm đề kiểm tra</button>
                            <?php }else{ ?>
                            <button type="submit" name="btnsubmit" class="btn btn-primary btn-lg mb-2 btn-block">Thêm câu hỏi kiểm tra</button>
                            <?php }?>
                        </div>
                    </div>
                </form>
                <br><br>
            </main>
            <div class="ml-sm-auto col-lg-1"></div>
        </div>
    </div>
            </div></div>
</body>

</html>