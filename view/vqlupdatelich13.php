<?php
ob_start();
include_once("controller/clich.php");
include_once("controller/clophoc.php");
$p = new controllophoc();
$malophoc = $_REQUEST["updatelich13"];

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
                    <h1 class="h2" style="padding-left: 200px;">CẬP NHẬT ID LỚP VÀ PASSWORD TỔNG</h1> <br>
                </div> <p style="padding-left: 200px;">(chỉ cập nhật những buổi chưa học)</p>
                <form class="js-form-submit-data" action="#" method="POST">
                    <div class="form-group row">
                        <label for="id" class="col-md-2 offset-md-2 col-form-label">Id</label>
                        <div class="col-md-6">
                            <input type="text" required class="form-control " id="id" name="id" value="<?php echo $row["IdChinh"] ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="pass" class="col-md-2 offset-md-2 col-form-label">Password</label>
                        <div class="col-md-6">
                            <input type="text" required class="form-control " id="pass" name="pass" value="<?php echo $row["PassChinh"] ?>">
                        </div>
                    </div>
                    <div class="form-group row mt-5">
                        <label for="user_email" class="col-md-2 col-form-label"></label>
                        <div class="col-md-8">
                            <br>
                            <button type="submit" name="btnsubmit" class="btn btn-primary btn-lg mb-2 btn-block">Cập nhật</button>
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
        $id = $_REQUEST["id"];
        $pass = $_REQUEST["pass"];

            $ktra1 = $p -> layupdate13chhoc($malophoc, $id, $pass);
            if($ktra1 == 1){
                echo header("refresh:0; url='QL.php?lichhoc'");
            }elseif($ktra1 == 0){
                echo "<script>alert('Lỗi không xác định')</script>";
            }
    }
    ?>
</body>

</html>