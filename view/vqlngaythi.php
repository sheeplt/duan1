<h1 style="text-align:center">Ngày thi hiện tại là:</h1>
<?php
ob_start();
$tendn = $_SESSION["tendangnhap"];
include_once("controller/cquanli.php");
$p = new controlquanli();
$table = $p->lay1quanli($tendn);
$row = mysqli_fetch_assoc($table);
$maql = $row["MaQL"];
$ngatthi = $row["NgayThi"];
?>
<h1 style="text-align:center"><?php echo $row["NgayThi"]; ?></h1>
<div class="container-fluid">
    <div class="row">
        <main role="main" class="ml-sm-auto col-lg-10">
            <form class="js-form-submit-data" action="#" method="POST" enctype="multipart/form-data">
                <div class="form-group row mt-5">
                    <label for="user_email" class="col-md-2 col-form-label"></label>
                    <div class="col-md-8">
                        <button type="submit" name="btnsubmit" class="btn">Update ngày thi</button>
                    </div>
                </div>
            </form>
            <br><br>
        </main>
    </div>
</div>
<?php
if (isset($_REQUEST["btnsubmit"])) {
?>
<div class="container-fluid">
    <div class="row">
        <main role="main" class="ml-sm-auto col-lg-10">
            <form class="js-form-submit-data" action="#" method="POST" enctype="multipart/form-data">
                <div class="form-group row">
                        <label for="thoigian" class="col-md-2 offset-md-2 col-form-label">Thời gian dự kiến thi</label>
                        <div class="col-md-6">
                            <input type="date" required class="form-control " id="thoigian" name="thoigian" value="<?php echo $ngatthi ?>">
                        </div>
                    </div>
                <div class="form-group row mt-5">
                    <label for="user_email" class="col-md-2 col-form-label"></label>
                    <div class="col-md-8">
                        <button type="submit" name="xacnhan" class="btn">Xác nhận</button>
                    </div>
                </div>
            </form>
            <br><br>
        </main>
    </div>
</div>
<?php
}
if (isset($_REQUEST["xacnhan"])) {
    $thoigian = $_REQUEST["thoigian"];
    $kq = $p->updatengaythi($maql, $thoigian);
    if ($kq == 1) {
        echo header("refresh:0; url='QL.php?ngaythi'");
    } elseif ($kq == 0) {
        echo "<script>alert('Không thể insert lỗi 1')</script>";
    } elseif ($kq == 5) {
        echo "<script>alert('thời gian bắt thi không bé hơn hiện tại')</script>";
    }
}
?>