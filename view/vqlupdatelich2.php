<?php
ob_start();
include_once("controller/clich.php");
$malophoc = $_REQUEST["updatelich2"];
$thu = $_REQUEST["thu"];
$tiet = $_REQUEST["tiet"];
//lấy mã giáo viên
include_once("controller/clophoc.php");
$plophoc = new controllophoc();
$table = $plophoc->chon1lophoc($malophoc);
$row = mysqli_fetch_assoc($table);
$magv = $row["MaGV"];
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
                    <p>(Chỉ cập nhật những ngày chưa học)</p>
                </div>
                <form class="js-form-submit-data" action="#" method="POST">
                <div class="form-group row mt-5">
                            <label for="lophoc" class="col-md-2 offset-md-2 col-form-label">Buổi học</label>
                            <div class="col-md-6">
                                
                                    <div class="col-md-6">
                                            <select name="thu" id="" required>
                                            <option value="1" <?php if($thu==1){echo "selected";} ?>>Thứ 2</option>
                                            <option value="2" <?php if($thu==2){echo "selected";} ?>>Thứ 3</option>
                                            <option value="3" <?php if($thu==3){echo "selected";} ?>>Thứ 4</option>
                                            <option value="4" <?php if($thu==4){echo "selected";} ?>>Thứ 5</option>
                                            <option value="5" <?php if($thu==5){echo "selected";} ?>>Thứ 6</option>
                                            <option value="6" <?php if($thu==6){echo "selected";} ?>>Thứ 7</option>
                                            <option value="7" <?php if($thu==7){echo "selected";} ?>>Chủ Nhật</option>
                                        </select>
                                        <select name="tiet" id="">
                                            <option value="1" <?php if($tiet==1){echo "selected";} ?>>Tiết 1 (7h-9h)</option>
                                            <option value="2" <?php if($tiet==2){echo "selected";} ?>>Tiết 2 (9h-11h)</option>
                                            <option value="3" <?php if($tiet==3){echo "selected";} ?>>Tiết 3 (1h-3h)</option>
                                            <option value="4" <?php if($tiet==4){echo "selected";} ?>>Tiết 4 (3h-5h)</option>
                                            <option value="5" <?php if($tiet==5){echo "selected";} ?>>Tiết 5 (18h-20h)</option>
                                            <option value="6" <?php if($tiet==6){echo "selected";} ?>>Tiết 6 (20h-22h)</option>
                                        </select>
                                        </div>
                                
                            </div>
                        </div>
                        
                        <input type="hidden" name="thucu" value="<?php echo $thu  ?>">
                        <input type="hidden" name="tietcu" value="<?php echo $tiet ?>">
        <div class="form-group row mt-5">
            <label for="user_email" class="col-md-2 col-form-label"></label>
            <div class="col-md-8">
                <button type="submit" name="btnsubmit" class="btn btn-primary btn-lg mb-2 btn-block">Cập nhật buổi học</button>
            </div>
        </div>

        </form>

        <br><br>

        </main>
        <div class="ml-sm-auto col-lg-1"></div>
    </div>
    </div>
    <?php
    $p = new controllich();
    if (isset($_REQUEST["btnsubmit"])) {
        
        $tietup = $_REQUEST["tiet"];
        $thuup = $_REQUEST["thu"];
        $tietcu = $_REQUEST["tietcu"];
        $thucu = $_REQUEST["thucu"];
        if($tietup == $tietcu && $thuup == $thucu){
            echo "<script>alert('Vẫn chưa thay buổi học')</script>";
        }else{
            $kq = $p->layupdate2chhoc($malophoc, $tietcu, $thucu, $tietup, $thuup, $magv);
            if($kq == 1){
                echo header("refresh:0; url='QL.php?chitietlichtheotiet=".$malophoc."'");
            }elseif($kq == 2){
                echo "<script>alert('Chưa thay đổi lịch học')</script>";
            }elseif($kq == 3){
                echo "<script>alert('Giáo viên bị trùng lịch')</script>";
            }elseif($kq == 4){
                echo "<script>alert('Học sinh bị trùng lịch')</script>";
            }elseif($kq == 0){
                echo "<script>alert('Lỗi')</script>";
            }
        }
    }
    ?>
</body>

</html>