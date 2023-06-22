<?php
include_once("controller/cbaiviet.php");
ob_start();
$tendn = $_SESSION["tendangnhap"];
$MaQL = $_REQUEST["thembaiviet"];
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
                    <h1 class="h2" style="padding-left: 100px;">THÊM BÀI VIẾT</h1>
                </div>
                <form class="js-form-submit-data" action="#" method="POST" enctype="multipart/form-data">
                    <div class="form-group row">
                        <label for="tieude" class="col-md-2 offset-md-2 col-form-label">Tiêu đề</label>
                        <div class="col-md-6">
                            <input type="text" required class="form-control " id="tieude" name="tieude" value="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="uutien" class="col-md-2 offset-md-2 col-form-label">Mức ưu tiên</label>
                        <div class="col-md-6">
                        <input type="checkbox" id="uutien" name="uutien" value="1">
                            <label for="uutien"> 1 - hiển thị lớn trên trang chủ</label><br>
                            <input type="checkbox" id="uutien" name="uutien" value="2">
                            <label for="uutien"> 2 -  hiển thị bé trên trang chủ</label><br>
                            <input type="checkbox" id="uutien" name="uutien" value="0">
                            <label for="uutien"> 0 - hiển thị trên trang tin tức</label><br>
                        </div>
                    </div>
                    <div class="form-group row mt-5">
                        <label for="anh" class="col-md-2 offset-md-2 col-form-label">Chọn ảnh chính</label>
                        <div class="col-md-6">
                            <input type="file" class="form-control " id="anh" name="ffile" value="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="giathue" class="col-md-2 offset-md-2 col-form-label">Nội dung</label>
                        <div class="col-md-6">
                            <textarea name="noidung" required class="form-control " id="noidung" cols="79" rows="5"></textarea><br>
                        </div>
                    </div>
                    <div class="form-group row mt-5">
                        <label for="user_email" class="col-md-2 col-form-label"></label>
                        <div class="col-md-8">
                            <button type="submit" name="btnsubmit" class="btn btn-primary btn-lg mb-2 btn-block">Tạo bài viết</button>
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
        $noidung = $_REQUEST["noidung"];
        $uutien = $_REQUEST["uutien"];

        $file = $_FILES["ffile"]["tmp_name"];
        $loaianh = $_FILES["ffile"]["type"];
        $anh = $_FILES["ffile"]["name"];

        $p = new controlbaiviet();
        $kq = $p->laythembaiviet($tieude, $noidung, $MaQL, $file, $loaianh, $anh, $uutien);
        if ($kq == 1) {
            echo "<script>alert('thêm dữ liệu thành công')</script>";
            echo header("refresh:0; url='QL.php?baiviet'");
        } elseif ($kq == 0) {
            echo "<script>alert('Không thể insert lỗi 1')</script>";
        } elseif ($kq == -1) {
            echo "<script>alert('Không thể upload ảnh')</script>";
        } elseif ($kq == -3) {
            echo "<script>alert('Không đúng định dạng')</script>";
        } else {
            echo "<script>alert('Không xác định được lỗi')</script>";
        }
    }
    ?>
</body>

</html>