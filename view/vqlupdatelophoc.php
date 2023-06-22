<?php
include_once("controller/clophoc.php");
ob_start();
$malop = $_GET["updatelop"];
$p = new controllophoc();
$kq = $p->chon1lophoc($malop);
$row = mysqli_fetch_assoc($kq);

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
                    <h1 class="h2" style="padding-left: 100px;">UPDATE LỚP HỌC</h1>
                </div>
                <form class="js-form-submit-data" action="#" method="POST">
                    <div class="form-group row">
                        <label for="tenlop" class="col-md-2 offset-md-2 col-form-label">Tên lớp</label>
                        <div class="col-md-6">
                            <input type="text" required class="form-control " id="tenlop" name="tenlop" value="<?php echo $row["TenLop"] ?>">
                            <input type="hidden" required class="form-control " id="tenlopcu" name="tenlopcu" value="<?php echo $row["TenLop"] ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="siso" class="col-md-2 offset-md-2 col-form-label">Sỉ số</label>
                        <div class="col-md-6">
                            <input type="text" required class="form-control " id="siso" name="siso" value="<?php echo $row["SiSo"] ?>">
                        </div>
                    </div>
                    <div class="form-group row mt-5">
                            <label for="giaovien" class="col-md-2 offset-md-2 col-form-label">Giáo viên giảng dạy</label>
                            <div class="col-md-6">
                                <select name="giaovien">
                                    <?php
                                    include_once("controller/cgiaovien.php");
                                    $p3 = new controlgiaovien();
                                    $table3 = $p3->laygvchuachunghiem();
                                    if ($table3) {
                                        if (mysqli_num_rows($table3) > 0) {
                                            while ($row3 = mysqli_fetch_assoc($table3)) {
                                                echo "<option value='" . $row3["MaGV"] . "'>" . $row3["TenGV"] . "</option>";
                                            }
                                            echo "<option selected value='" . $row["MaGV"] . "'>" . $row["TenGV"] . "</option>";

                                        } else {
                                            echo 1;
                                        }
                                    } else {
                                        echo 1;
                                    }
                                    ?>
                                </select> đã lọc giáo viên chưa chủ nghiệm
                            </div>
                        </div>
                        <div class="form-group row mt-5">
                        <label for="khoi" class="col-md-2 offset-md-2 col-form-label">Khối</label>
                        <div class="col-md-6">
                            <select name="khoi">
                                <?php
                                include_once("controller/ckhoi.php");
                                $p = new controlkhoi();
                                $table2 = $p->layallkhoi();
                                if ($table2) {
                                    if (mysqli_num_rows($table2) > 0) {
                                        while ($row2 = mysqli_fetch_assoc($table2)) {
                                            if ($row2["MaKhoi"] == $row["MaKhoi"]) {
                                                echo "<option selected value='" . $row2["MaKhoi"] . "'>" . $row2["MaKhoi"] . "</option>";
                                            } else {
                                                echo "<option value='" . $row2["MaKhoi"] . "'>" . $row2["MaKhoi"] . "</option>";
                                            }
                                        }
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div> <br>
                    <div class="form-group row mt-5">
                        <label for="user_email" class="col-md-2 col-form-label"></label>
                        <div class="col-md-8">
                            <button type="submit" name="btnsubmit" class="btn btn-primary btn-lg mb-2 btn-block">Update lớp học</button>
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
        $tenlop = $_REQUEST["tenlop"];
        $tenlopcu = $_REQUEST["tenlopcu"];
        $giaovien = $_REQUEST['giaovien'];
        $siso = $_REQUEST["siso"];
        $khoi = $_REQUEST['khoi'];

        //kiểm tra tên lớp học
        $test = false;
        include_once("controller/chocsinh.php");
        $p = new controlhocsinh();
        $table = $p->laydslophoc();
        if ($table) {
            if (mysqli_num_rows($table) > 0) {
                while ($row = mysqli_fetch_assoc($table)) {
                    if($row["TenLop"] == $tenlop && $tenlop != $tenlopcu){
                        $test = true;
                        echo "<script>alert('Tên lớp ".$tenlop." đã tồn tại')</script>";
                    }
                }
            }
        }
        if($test == false){
            $p = new controllophoc();
            $kq = $p->updatelophoc($tenlop, $siso, $giaovien, $khoi, $malop);
            if ($kq != 0) {
                echo "<script>alert('update dữ liệu thành công')</script>";
                echo header("refresh:0; url='QL.php?hocsinh'");
            } elseif ($kq == 0) {
                echo "<script>alert('Không thể insert lỗi 1')</script>";
            }
        }
    }
    ?>
</body>

</html>