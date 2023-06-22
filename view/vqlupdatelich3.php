<?php
ob_start();
include_once("controller/clich.php");
$p = new controllich();
$malich = $_REQUEST["updatelich3"];
$malophoc = $_REQUEST["malop"];
$table = $p->lay1lich($malich);
$row = mysqli_fetch_assoc($table);
// lấy mã môn học
include_once("controller/clophoc.php");
$plophoc = new controllophoc();
$tablelophoc = $plophoc->chon1lophoc($malophoc);
$rowlophoc = mysqli_fetch_assoc($tablelophoc);
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
                    <h1 class="h2" style="padding-left: 200px;">CẬP NHẬT NGÀY HỌC</h1>
                </div>
                <form class="js-form-submit-data" action="#" method="POST">
                    <div class="form-group row mt-5">
                        <label for="lophoc" class="col-md-2 offset-md-2 col-form-label">Buổi học</label>
                        <div class="col-md-6">

                            <div class="col-md-6">
                                <select name="thu" id="" required>
                                    <option value="1" <?php if ($row["Thu"] == 1) {
                                                            echo "selected";
                                                        } ?>>Thứ 2</option>
                                    <option value="2" <?php if ($row["Thu"] == 2) {
                                                            echo "selected";
                                                        } ?>>Thứ 3</option>
                                    <option value="3" <?php if ($row["Thu"] == 3) {
                                                            echo "selected";
                                                        } ?>>Thứ 4</option>
                                    <option value="4" <?php if ($row["Thu"] == 4) {
                                                            echo "selected";
                                                        } ?>>Thứ 5</option>
                                    <option value="5" <?php if ($row["Thu"] == 5) {
                                                            echo "selected";
                                                        } ?>>Thứ 6</option>
                                    <option value="6" <?php if ($row["Thu"] == 6) {
                                                            echo "selected";
                                                        } ?>>Thứ 7</option>
                                    <option value="7" <?php if ($row["Thu"] == 7) {
                                                            echo "selected";
                                                        } ?>>Chủ Nhật</option>
                                </select>
                                <select name="tiet" id="">
                                    <option value="1" <?php if ($row["Tiet"] == 1) {
                                                            echo "selected";
                                                        } ?>>Tiết 1 (7h-9h)</option>
                                    <option value="2" <?php if ($row["Tiet"] == 2) {
                                                            echo "selected";
                                                        } ?>>Tiết 2 (9h-11h)</option>
                                    <option value="3" <?php if ($row["Tiet"] == 3) {
                                                            echo "selected";
                                                        } ?>>Tiết 3 (1h-3h)</option>
                                    <option value="4" <?php if ($row["Tiet"] == 4) {
                                                            echo "selected";
                                                        } ?>>Tiết 4 (3h-5h)</option>
                                    <option value="5" <?php if ($row["Tiet"] == 5) {
                                                            echo "selected";
                                                        } ?>>Tiết 5 (18h-20h)</option>
                                    <option value="6" <?php if ($row["Tiet"] == 6) {
                                                            echo "selected";
                                                        } ?>>Tiết 6 (20h-22h)</option>
                                </select>
                            </div>

                        </div>
                    </div>
                    <div class="form-group row">
                        <input type="hidden" name="tietcu" value="<?php echo $row['Tiet']  ?>">
                        <input type="hidden" name="thucu" value="<?php echo $row['Thu']  ?>">
                        <input type="hidden" name="gvcu" value="<?php echo $row['GVTrucTiep']  ?>">
                    </div>
                    <div class="form-group row">
                        <label for="TimeBD" class="col-md-2 offset-md-2 col-form-label">Ngày học</label>
                        <div class="col-md-6">
                            <input type="date" required class="form-control " id="Time" name="Time" value="<?php echo  $row['Ngay'] ?>">
                        </div>
                    </div> <br>
                    <div class="form-group row">
                        <input type="hidden" name="ngaycu" value="<?php echo $row['Ngay']  ?>">
                    </div>
                    <div class="form-group row mt-5">
                        <label for="giaovien" class="col-md-2 offset-md-2 col-form-label">Giáo viên giảng dạy</label>
                        <div class="col-md-6">
                            <select name="giaovien">
                                <?php
                                include_once("controller/cgiaovien.php");
                                $p3 = new controlgiaovien();
                                $table3 = $p3->laygvtheomonhoc($rowlophoc['MaMonHoc']);
                                if ($table3) {
                                    if (mysqli_num_rows($table3) > 0) {
                                        while ($row3 = mysqli_fetch_assoc($table3)) {
                                            if ($row3["MaGV"] == $row["GVTrucTiep"]) {
                                                echo "<option selected value='" . $row3["MaGV"] . "'>" . $row3["TenGV"] . "</option>";
                                            } else {
                                                echo "<option value='" . $row3["MaGV"] . "'>" . $row3["TenGV"] . "</option>";
                                            }
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
                            <input type="text" class="form-control " id="Id" name="Id" value="<?php echo  $row['Id'] ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="pass" class="col-md-2 offset-md-2 col-form-label">Password</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control " id="pass" name="pass" value="<?php echo  $row['Pass'] ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="TimeBD" class="col-md-2 offset-md-2 col-form-label">Ghi Chú</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control " id="ghichu" name="ghichu" value="<?php echo  $row['GhiChu'] ?>">
                        </div>
                    </div> <br>
                    <div class="form-group row mt-5">
                        <label for="user_email" class="col-md-2 col-form-label"></label>
                        <div class="col-md-8">
                            <button type="submit" name="btnsubmit" class="btn btn-primary btn-lg mb-2 btn-block">Cập nhật buổi học</button>
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
        $tietup = $_REQUEST["tiet"];
        $thuup = $_REQUEST["thu"];
        $Time = $_REQUEST["Time"];
        $magiaovien = $_REQUEST["giaovien"];
        $id = $_REQUEST["Id"];
        $pass = $_REQUEST["pass"];
        $ghichu = $_REQUEST["ghichu"];
        //
        $tietcu = $_REQUEST["tietcu"];
        $ngaycu = $_REQUEST["ngaycu"];
        $thucu = $_REQUEST["thucu"];
        $gvcu = $_REQUEST["gvcu"];
        //chỉ thay đổi id
        if ($tietup == $tietcu && $Time == $ngaycu && $thucu == $thuup && $gvcu == $magiaovien) {
            $kq = $p->chonupdate333($malich, $ghichu, $id, $pass);
            if ($kq == 1) {
                echo "<script>alert('cập nhật dữ liệu thành công')</script>";
                echo header("refresh:0; url='QL.php?chitietlichtheotiet=" . $malophoc . "'");
            } elseif ($kq == 0) {
                echo "<script>alert('Lỗi k xác định')</script>";
            }
        } elseif ($tietup == $tietcu && $Time == $ngaycu && $thucu == $thuup) { //đổi giáo viên dạy thế 
            $kq = $p->chonupdate33($malich, $magiaovien, $ghichu, $id, $pass, $Time, $thuup, $tietup);
            if ($kq == 1) {
                echo "<script>alert('Đã đổi giáo viên dạy thế')</script>";
                echo header("refresh:0; url='QL.php?chitietlichtheotiet=" . $malophoc . "'");
            } elseif ($kq == 2) {
                echo "<script>alert('Giáo viên bị trùng lịch')</script>";
            } elseif ($kq == 0) {
                echo "<script>alert('Lỗi k xác định')</script>";
            }
        } else { //đổi buổi học
            //đổi ngày thành chuỗi
            $Time = strtotime($Time);
            //tính thứ của ngày
            $thu1 = date("l", $Time);
            $thu1 = strtolower($thu1);
            switch ($thu1) {
                case 'monday':
                    $thu1 = 1;
                    break;
                case 'tuesday':
                    $thu1 = 2;
                    break;
                case 'wednesday':
                    $thu1 = 3;
                    break;
                case 'thursday':
                    $thu1 = 4;
                    break;
                case 'friday':
                    $thu1 = 5;
                    break;
                case 'saturday':
                    $thu1 = 6;
                    break;
                default:
                    $thu1 = 7;
                    break;
            }
            // đổi chuỗi thành ngày
            $Time = strftime("%Y-%m-%d", $Time);
            if ($thu1 == $thuup) {
                $kq = $p->layupdate3($malich, $tietup, $Time, $magiaovien, $ghichu, $thuup, $id, $pass, $malophoc);
                if ($kq == -2) {
                    echo "<script>alert('Giáo viên bị trùng lịch')</script>";
                } elseif ($kq == 0) {
                    echo "<script>alert('Lỗi k xác định')</script>";
                } elseif ($kq == -1) {
                    echo "<script>alert('Thêm lịch bù thành công')</script>";
                    echo header("refresh:0; url='QL.php?chitietlichtheotiet=" . $malophoc . "'");
                } else {
                    echo "<script>alert('Có " . $kq . " học sinh bị trùng lịch')</script>";
                    echo header("refresh:0; url='QL.php?chitietlichtheotiet=" . $malophoc . "'");
                }
            } else {
                echo "<script>alert('Ngày học k trùng với thứ đã chọn')</script>";
            }
        }
    }
    ?>
</body>

</html>