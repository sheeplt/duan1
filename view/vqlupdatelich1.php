<?php
ob_start();
include_once("controller/clich.php");
include_once("controller/clophoc.php");
$p = new controllophoc();
$malophoc = $_REQUEST["updatelich1"];
$table = $p->chon1lophoc($malophoc);
$row = mysqli_fetch_assoc($table);
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
                    <h1 class="h2" style="padding-left: 200px;">CẬP NHẬT GIÁO VIÊN GIẢNG DẠY</h1> <br>
                    <p>(chỉ cập nhật những ngày chưa dạy)</p>
                </div>
                <form class="js-form-submit-data" action="#" method="POST">
                    <div class="form-group row mt-5">
                        <label for="giaovien" class="col-md-2 offset-md-2 col-form-label">Giáo viên giảng dạy</label>
                        <div class="col-md-6">
                            <select name="giaovien">
                                <?php
                                include_once("controller/cgiaovien.php");
                                $p3 = new controlgiaovien();
                                $table3 = $p3->laygvtheomonhoc($row['MaMonHoc']);
                                if ($table3) {
                                    if (mysqli_num_rows($table3) > 0) {
                                        while ($row3 = mysqli_fetch_assoc($table3)) {
                                            if ($row3["MaGV"] == $row["MaGV"]) {
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
                    </div>
                    <div class="form-group row">
                        <input type="hidden" name="gvcu" value="<?php echo $row['MaGV']  ?>">
                    </div>
                    <div class="form-group row mt-5">
                        <label for="user_email" class="col-md-2 col-form-label"></label>
                        <div class="col-md-8">
                            <br>
                            <button type="submit" name="btnsubmit" class="btn btn-primary btn-lg mb-2 btn-block">Cập nhật giáo viên</button>
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
        $p = new controllich();
        $giaovien = $_REQUEST["giaovien"];
        $gvcu = $_REQUEST["gvcu"];
        if($giaovien == $gvcu){
            echo "<script>alert('Vẫn chưa thay đổi giáo viên')</script>";
        }else{
            $ktra1 = $p -> layupdate1chhoc($malophoc, $giaovien);
            if($ktra1 == 1){
                echo header("refresh:0; url='QL.php?lichhoc'");
            }elseif($ktra1 == 2){
                echo "<script>alert('Giáo viên bị trùng lịch giảng dạy')</script>";
            }elseif($ktra1 == 0){
                echo "<script>alert('Lỗi không xác định')</script>";
            }
        }
    }
    ?>
</body>

</html>