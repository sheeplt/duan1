<?php
include_once("controller/choadon.php");
ob_start();
$mahd = $_REQUEST["updatehoadonql"];
$p = new controlhoadon();
$table = $p->hoadonupdateql($mahd);
$row = mysqli_fetch_assoc($table);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm học sinh lớp <?php echo $Malop; ?></title>
    <script src="view/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="ml-sm-auto col-lg-1"></div>

            <main role="main" class="ml-sm-auto col-lg-10">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
                    <h1 class="h2" style="padding-left: 100px;">UPDATE HÓA ĐƠN</h1>
                </div>
                <form class="js-form-submit-data" action="#" method="POST">
                <div class="form-group row">
                        <label for="mahs" class="col-md-2 offset-md-2 col-form-label">Tên quản lí</label>
                        <div class="col-md-6">
                            <input type="text" required disabled class="form-control " id="mahs" name="mahs" value="<?php echo $row["TenQL"] ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tendn" class="col-md-2 offset-md-2 col-form-label">Ngày Thanh Toán</label>
                        <div class="col-md-6">
                            <input type="text" required disabled class="form-control " id="tendn" name="tendn" value="<?php echo $row["NgayTT"] ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="SoTien" class="col-md-2 offset-md-2 col-form-label">Số tiền</label>
                        <div class="col-md-6">
                            <input type="text" required class="form-control " id="SoTien" name="SoTien" value="<?php echo $row["SoTien"] ?>">
                        </div>
                    </div>
                    
                    <div class="form-group row mt-5">
                        <label for="user_email" class="col-md-2 col-form-label"></label>
                        <div class="col-md-8">
                            <button type="submit" name="btnsubmit" class="btn btn-primary btn-lg mb-2 btn-block">Update học sinh</button>
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
        $SoTien = $_REQUEST["SoTien"];
        $kq = $p->updatetienql($mahd, $SoTien);
        if ($kq == 1) {
            echo header("refresh:0; url='QL.php?hoadonnhanvien'");
        } elseif ($kq == 0) {
            echo "<script>alert('Không thể insert lỗi 1')</script>";
        }
    }
    ?>
</body>

</html>