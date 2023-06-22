<?php
include_once("controller/ccauhoi.php");
$p = new controlcauhoi();
$mach = $_REQUEST["updatechtn"];
$makt = $_REQUEST["kiemtra"];
$malop = $_REQUEST["malop"];
$table = $p->lay1chtn($mach);
$row = mysqli_fetch_assoc($table);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa câu hỏi trắc nghiệm</title>
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
                        <h1 style="margin-bottom: 100px;">CẬP NHẬT CÂU HỎI</h1>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="row">
                    <div class="ml-sm-auto col-lg-1"></div>

                    <main role="main" class="ml-sm-auto col-lg-10">

                        <form class="js-form-submit-data" action="#" method="POST">
                            <div class="form-group row">
                                <label for="giathue" class="col-md-2 offset-md-2 col-form-label">Đáp án đúng</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control " id="DapAn" name="DapAn"
                                        value="<?php echo $row["DapAn"] ?>">
                                </div>
                            </div>
                            <div class="form-group row mt-5">
                                <label for="user_email" class="col-md-2 col-form-label"></label>
                                <div class="col-md-8">
                                    <button type="submit" name="btnsubmit1"
                                        class="btn btn-primary btn-lg mb-2 btn-block">Cập nhật câu hỏi</button>
                                </div>
                            </div>

                        </form>

                        <br><br>

                    </main>
                    <div class="ml-sm-auto col-lg-1"></div>
                </div>
            </div>
            <?php
            if (isset($_REQUEST["btnsubmit1"])) {
                $da = $_REQUEST["DapAn"];
                $kq = $p->layupdatechtn($mach, $da);
                if ($kq == 1) {
                    echo header("refresh:0; url='GV.php?xemdethichitiet=" . $makt . "&malop=" . $malop . "'");
                } elseif ($kq == 0) {
                    echo "<script>alert('Không thể update lỗi')</script>";
                }
            }
            ?>
        </div>
    </div>
</body>

</html>