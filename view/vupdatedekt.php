<?php
include_once("controller/ckiemtra.php");
$p = new controlkiemtra();
$makt = $_REQUEST["updatekiemtra"];
$malop = $_REQUEST["malop"];
$table = $p->lay1ktra($makt, $malop);
$row = mysqli_fetch_assoc($table);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa đề kiểm tra</title>
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
                        <h1 style="margin-bottom: 100px;">CẬP NHẬT BÀI KIỂM TRA</h1>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="row">
                    <div class="ml-sm-auto col-lg-1"></div>

                    <main role="main" class="ml-sm-auto col-lg-10">
                        <form class="js-form-submit-data" action="#" method="POST">
                            <div class="form-group row">
                                <label for="tieude" class="col-md-2 offset-md-2 col-form-label">Tiêu đề</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control " id="tieude" name="tieude"
                                        value="<?php echo $row["TieuDe"] ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="Time" class="col-md-2 offset-md-2 col-form-label">Thời gian (phút)</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control " id="Time" name="Time"
                                        value="<?php echo $row["Time"] ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="TimeBD" class="col-md-2 offset-md-2 col-form-label">Thời gian bắt
                                    đầu</label>
                                <div class="col-md-6">
                                    <input type="datetime-local" class="form-control " id="TimeBD" name="TimeBD"
                                        value="<?php echo $row["TimeBD"] ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="TimeKT" class="col-md-2 offset-md-2 col-form-label">Thời gian kết
                                    thúc</label>
                                <div class="col-md-6">
                                    <input type="datetime-local" class="form-control " id="TimeKT" name="TimeKT"
                                        value="<?php echo $row["TimeKT"] ?>">
                                </div>
                            </div>
                            <div class="form-group row mt-5">
                                <label for="user_email" class="col-md-2 col-form-label"></label>
                                <div class="col-md-8">
                                    <button type="submit" name="btnsubmit"
                                        class="btn btn-primary btn-lg mb-2 btn-block">Cập nhật kiểm tra</button>
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
                $tieude = $_REQUEST["tieude"];
                $time = $_REQUEST["Time"];
                $timebd = $_REQUEST["TimeBD"];
                $timekt = $_REQUEST["TimeKT"];
                $kq = $p->layupdatekt($makt, $time, $tieude, $malop, $timebd, $timekt);
                if ($kq == 1) {
                    echo "<script>alert('cập nhật dữ liệu thành công')</script>";
                    echo header("refresh:0; url='GV.php?xbh=" . $malop . "&kiemtra'");
                } elseif ($kq == 0) {
                    echo "<script>alert('Không thể update lỗi')</script>";
                }
            }
            ?>
        </div>
    </div>
</body>

</html>