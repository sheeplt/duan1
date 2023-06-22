<?php
ob_start();
$malophoc = $_REQUEST["themlichbu"];
include_once("controller/cmonhoc.php");
$p = new controlmonhoc;
$tablemon = $p -> laymamontumalop($malophoc);
$row = mysqli_fetch_assoc($tablemon);
$mamonhoc = $row["MaMonHoc"];
include_once("controller/clich.php");
$p = new controllich();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cập nhật lịch học</title>
    <link rel="stylesheet" href="view/styles/lich_day.css">
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="ml-sm-auto col-lg-1"></div>

            <main role="main" class="ml-sm-auto col-lg-10">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
                    <h1 class="h2" style="padding-left: 100px;">THÊM LỊCH HỌC BÙ</h1>
                </div>
                <form class="js-form-submit-data" action="#" method="POST">
                <div class="form-group row mt-5">
                            <label for="lophoc" class="col-md-2 offset-md-2 col-form-label">Buổi học</label>
                            <div class="col-md-6">
                                
                                    <div class="col-md-6">
                                            <select name="thu" id="" required>
                                            <option value="1" >Thứ 2</option>
                                            <option value="2">Thứ 3</option>
                                            <option value="3">Thứ 4</option>
                                            <option value="4">Thứ 5</option>
                                            <option value="5">Thứ 6</option>
                                            <option value="6">Thứ 7</option>
                                            <option value="7">Chủ Nhật</option>
                                        </select>
                                        <select name="tiet" id="">
                                            <option value="1">Tiết 1 (7h-9h)</option>
                                            <option value="2">Tiết 2 (9h-11h)</option>
                                            <option value="3">Tiết 3 (1h-3h)</option>
                                            <option value="4">Tiết 4 (3h-5h)</option>
                                            <option value="5">Tiết 5 (18h-20h)</option>
                                            <option value="6">Tiết 6 (20h-22h)</option>
                                        </select>
                                        </div>
                                
                            </div>
                        </div>
                    <div class="form-group row">
                        <label for="TimeBD" class="col-md-2 offset-md-2 col-form-label">Ngày học</label>
                        <div class="col-md-6">
                            <input type="date" required class="form-control " id="Time" name="Time" value="">
                        </div>
                    </div>  <br>
                    <div class="form-group row">
                        <input type="hidden" name="ngaycu" value="">
                    </div>
                    <div class="form-group row mt-5">
                        <label for="giaovien" class="col-md-2 offset-md-2 col-form-label">Giáo viên giảng dạy</label>
                        <div class="col-md-6">
                            <select name="giaovien">
                                <?php
                                include_once("controller/cgiaovien.php");
                                $p3 = new controlgiaovien();
                                $table3 = $p3->laygvtheomonhoc($mamonhoc);
                                if ($table3) {
                                    if (mysqli_num_rows($table3) > 0) {
                                        while ($row3 = mysqli_fetch_assoc($table3)) {
                                                echo "<option value='" . $row3["MaGV"] . "'>" . $row3["TenGV"] . "</option>";
                                           
                                        }
                                    } else {
                                        echo 1;
                                    }
                                } else {
                                    echo 1;
                                }
                                ?>
                            </select>
                        </div>
                    </div><br>
                    <div class="form-group row">
                            <label for="Id" class="col-md-2 offset-md-2 col-form-label">ID lớp học</label>
                            <div class="col-md-6">
                                <input type="text"  class="form-control " id="Id" name="Id" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="pass" class="col-md-2 offset-md-2 col-form-label">Password</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control " id="pass" name="pass" value="">
                            </div>
                        </div>
                    <div class="form-group row">
                        <label for="TimeBD" class="col-md-2 offset-md-2 col-form-label">Ghi Chú</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control " id="ghichu" name="ghichu" value="">
                        </div>
                    </div> 
                    <input type="hidden" class="form-control " id="malop" name="malop" value="<?php echo $malophoc ?>">
                    <div class="form-group row mt-5">
        <label for="user_email" class="col-md-2 col-form-label"></label>
        <div class="col-md-8">
            <button type="submit" name="btnsubmit" class="btn btn-primary btn-lg mb-2 btn-block">Thêm buổi học</button>
        </div>
    </div>
        </div>
    </div>
    

    </form>

    <br><br>

    </main>
    <div class="ml-sm-auto col-lg-1"></div>
    </div>
    </div>
    <?php
    if (isset($_REQUEST["btnsubmit"])) {
        $tiet = $_REQUEST["tiet"];
        $thu = $_REQUEST["thu"];
        $Time = $_REQUEST["Time"];
        $magiaovien = $_REQUEST["giaovien"];
        $id = $_REQUEST["Id"];
        $pass = $_REQUEST["pass"];
        $ghichu = $_REQUEST["ghichu"];
        $malop = $_REQUEST["malop"];
        //
        $ngay = date('Y-m-d');
		$ngay = strtotime($ngay);
        $ngaylich = strtotime($Time);
        if($ngaylich >= $ngay){
            $kq = $p->themlichhocbu($malop, $magiaovien, $Time, $tiet, $thu, $id, $pass, $ghichu);
            if($kq == 1){
                echo "<script>alert('Thêm lịch thành công')</script>";
                echo header("refresh:0; url='QL.php?chitietlichtheotiet=".$malophoc."'");
            }elseif($kq == 2){
                echo "<script>alert('Giáo viên bị trùng lịch')</script>";
            }elseif($kq == 0){
                echo "<script>alert('Lỗi k xác định')</script>";
            }
        }else{
            echo "<script>alert('Ngày thêm đã trôi qua')</script>";
        }
       
    }
    ?>
</body>

</html>