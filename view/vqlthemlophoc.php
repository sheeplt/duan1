<?php
include_once("controller/clophoc.php");
ob_start();
//lay ngay thi
$tendn = $_SESSION["tendangnhap"];
include_once("controller/cquanli.php");
$pql = new controlquanli();
$tableql = $pql -> lay1quanli($tendn);
$rowql=mysqli_fetch_assoc($tableql);
$ngaythi = $rowql["NgayThi"];
$ngaykt = strtotime ( '-3 day' , strtotime ( $ngaythi ) ) ;
$ngaykt = date ( 'Y-m-j' , $ngaykt );
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm bài viết</title>
    <script src="view/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="ml-sm-auto col-lg-1"></div>

            <main role="main" class="ml-sm-auto col-lg-10">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
                    <h1 class="h2" style="padding-left: 200px;">CHỌN MÔN MUỐN THÊM</h1>
                </div>
                <form class="js-form-submit-data" action="#" method="POST">
                    <div class="form-group row mt-5">
                        <label for="monhoc" class="col-md-2 offset-md-2 col-form-label">Môn học</label>
                        <div class="col-md-6">
                            <select name="monhoc">
                                <?php
                                include_once("controller/cmonhoc.php");
                                $p1 = new controlmonhoc();
                                $table1 = $p1->laymonhoc();
                                if ($table1) {
                                    if (mysqli_num_rows($table1) > 0) {
                                        while ($row1 = mysqli_fetch_assoc($table1)) {
                                            if(isset($_REQUEST["kiemtra"]) and $_REQUEST['monhoc'] == $row1["MaMonHoc"]){
                                                echo "<option selected  value='" . $row1["MaMonHoc"] . "'>" . $row1["TenMonHoc"] . "</option>";
                                            }else{
                                                echo "<option  value='" . $row1["MaMonHoc"] . "'>" . $row1["TenMonHoc"] . "</option>";
                                            }
                                        }
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div> 
                    <div class="form-group row mt-5">
                        <label for="user_email" class="col-md-2 col-form-label"></label>
                        <div class="col-md-8">
                            <button type="submit" name="kiemtra" class="btn btn-primary btn-lg mb-2 btn-block">Kiểm tra</button>
                        </div>
                    </div>
                </form>

                <br><br>
                <?php
                if (isset($_REQUEST["kiemtra"])) {
                    $monhoc = $_REQUEST['monhoc'];
                ?> 
                <!-- form lớp học -->
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
                    <h1 class="h2" style="padding-left: 200px;">THÊM LỚP HỌC</h1>
                </div>
                <form class="js-form-submit-data" action="#" method="POST">
                    <div class="form-group row">
                        <label for="tenlop" class="col-md-2 offset-md-2 col-form-label">Tên lớp</label>
                        <div class="col-md-6">
                            <input type="text" required class="form-control " id="tenlop" name="tenlop" value="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tenlop" class="col-md-2 offset-md-2 col-form-label">Loại lớp</label>
                        <div class="col-md-6">
                            <select name="loailop" id="" required>
                                <option value="1" selected>Lớp bình thường</option>
                                <option value="2">Lớp Nâng Cao</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="siso" class="col-md-2 offset-md-2 col-form-label">Sỉ số</label>
                        <div class="col-md-6">
                            <input type="text" required class="form-control " id="siso" name="siso" value="">
                        </div>
                    </div>
                    <div class="form-group row mt-5">
                            <label for="giaovien" class="col-md-2 offset-md-2 col-form-label">Giáo viên giảng dạy</label>
                            <div class="col-md-6">
                                <select name="giaovien">
                                    <?php
                                    include_once("controller/cgiaovien.php");
                                    $p3 = new controlgiaovien();
                                    $table3 = $p3->laygvtheomonhoc($monhoc);
                                    if ($table3) {
                                        if (mysqli_num_rows($table3) > 0) {
                                            while ($row3 = mysqli_fetch_assoc($table3)) {
                                                echo "<option value='" . $row3["MaGV"] . "'>" . $row3["TenGV"] . "</option>";
                                            }
                                        }
                                    } else {
                                        echo 1;
                                    }
                                    ?>
                                </select> đã lọc theo môn học và giáo viên đã nghỉ
                            </div>
                        </div>
                    <div class="form-group row">
                        <label for="thoigian" class="col-md-2 offset-md-2 col-form-label">Thời gian dự kiến mở lớp</label>
                        <div class="col-md-6">
                            <input type="date" required class="form-control " id="thoigian" name="thoigian" value="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="thoigian" class="col-md-2 offset-md-2 col-form-label">Tiết học</label>
                        <div class="col-md-6">
                            Buổi 1: <select name="thu1" id="" required>
                                <option value="1">Thứ 2</option>
                                <option value="2">Thứ 3</option>
                                <option value="3">Thứ 4</option>
                                <option value="4">Thứ 5</option>
                                <option value="5">Thứ 6</option>
                                <option value="6">Thứ 7</option>
                                <option value="7">Chủ Nhật</option>
                            </select>
                            <select name="tiet1" id="">
                                <option value="1">Tiết 1 (7h-9h)</option>
                                <option value="2">Tiết 2 (9h-11h)</option>
                                <option value="3">Tiết 3 (1h-3h)</option>
                                <option value="4">Tiết 4 (3h-5h)</option>
                                <option value="5">Tiết 5 (18h-20h)</option>
                                <option value="6">Tiết 6 (20h-22h)</option>
                            </select> <br>
                            Buổi 2: <select name="thu2" id="" required>
                                <option value="1">Thứ 2</option>
                                <option value="2">Thứ 3</option>
                                <option value="3">Thứ 4</option>
                                <option value="4">Thứ 5</option>
                                <option value="5">Thứ 6</option>
                                <option value="6">Thứ 7</option>
                                <option value="7">Chủ Nhật</option>
                            </select>
                            <select name="tiet2" id="">
                                <option value="1">Tiết 1 (7h-9h)</option>
                                <option value="2">Tiết 2 (9h-11h)</option>
                                <option value="3">Tiết 3 (1h-3h)</option>
                                <option value="4">Tiết 4 (3h-5h)</option>
                                <option value="5">Tiết 5 (18h-20h)</option>
                                <option value="6">Tiết 6 (20h-22h)</option>
                            </select><br>
                            Buổi 3: <select name="thu3" id="">
                            <option value="0"></option>
                                <option value="1">Thứ 2</option>
                                <option value="2">Thứ 3</option>
                                <option value="3">Thứ 4</option>
                                <option value="4">Thứ 5</option>
                                <option value="5">Thứ 6</option>
                                <option value="6">Thứ 7</option>
                                <option value="7">Chủ Nhật</option>
                            </select>
                            <select name="tiet3" id="">
                            <option value="0"></option>
                                <option value="1">Tiết 1 (7h-9h)</option>
                                <option value="2">Tiết 2 (9h-11h)</option>
                                <option value="3">Tiết 3 (1h-3h)</option>
                                <option value="4">Tiết 4 (3h-5h)</option>
                                <option value="5">Tiết 5 (18h-20h)</option>
                                <option value="6">Tiết 6 (20h-22h)</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="hocphi" class="col-md-2 offset-md-2 col-form-label">Học phí</label>
                        <div class="col-md-6">
                            <input type="text" required class="form-control " id="hocphi" name="hocphi" value="">
                        </div>
                    </div>
                    <div class="form-group row">
                            <label for="TimeKT" class="col-md-2 offset-md-2 col-form-label">Thời gian kết thúc</label> trước ngày thi 3 ngày
                            <div class="col-md-6">
                                <input type="date" required class="form-control " id="TimeKT" name="TimeKT" value="<?php echo $ngaykt ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="idlp" class="col-md-2 offset-md-2 col-form-label">ID lớp học</label>
                            <div class="col-md-6">
                                <input type="text"  class="form-control " id="idlp" name="idlp" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="pass" class="col-md-2 offset-md-2 col-form-label">Password</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control " id="pass" name="pass" value="">
                            </div>
                        </div>
                    <div class="form-group row mt-5">
                        <label for="user_email" class="col-md-2 col-form-label"></label>
                        <div class="col-md-8">
                            <button type="submit" name="btnsubmit" class="btn btn-primary btn-lg mb-2 btn-block">Tạo lớp học</button>
                        </div>
                    </div>

                </form>
                <?php  
                }
                ?>
            </main>
            <div class="ml-sm-auto col-lg-1"></div>
        </div>
    </div>
    <?php
    if (isset($_REQUEST["btnsubmit"])) {
        $tenlop = $_REQUEST["tenlop"];
        $loailop = $_REQUEST["loailop"];
        $giaovien = $_REQUEST['giaovien'];
        $siso = $_REQUEST["siso"];
        $thoigian = $_REQUEST["thoigian"];
        $hocphi = $_REQUEST["hocphi"];
        $hocphi = str_replace('.', '', $hocphi);
        $hocphi = str_replace(',', '', $hocphi);
        $TimeKT = $_REQUEST['TimeKT'];
        $id = $_REQUEST['idlp'];
        $pass = $_REQUEST['pass'];
        //số buổi
        $tiet1 = $_REQUEST["tiet1"]; $thu1 =  $_REQUEST["thu1"]; 
        $tiet2 = $_REQUEST["tiet2"]; $thu2 =  $_REQUEST["thu2"]; 
        $tiet3 = $_REQUEST["tiet3"]; $thu3 =  $_REQUEST["thu3"]; 
        //bắt đầu thêm
        $p = new controllophoc();
        $kq = $p->themlophoc($tenlop, $siso, $giaovien, $thoigian, $hocphi, $thu1, $thu2, $thu3, $tiet1, $tiet2, $tiet3, $TimeKT, $id, $pass, $loailop);
            
        if($kq ==1){
            echo "<script>alert('Tên lớp đang được  sử dụng (chỉ ktra lớp đang mở)')</script>";
        }elseif($kq==2){
            echo header("refresh:0; url='QL.php?hocsinh'");
        }elseif($kq==3){
            echo "<script>alert('Lỗi thêm buổi')</script>";
        }elseif($kq==4){
            echo "<script>alert('Lịch giáo viên bị trùng')</script>";
        }elseif($kq==5){
            echo "<script>alert('Thời gian bắt đầu không được bé hơn thời gian hiện tại')</script>";
        }elseif($kq==0){
            echo "<script>alert('Lỗi không xác định')</script>";
        }
    }
    ?>
</body>

</html>