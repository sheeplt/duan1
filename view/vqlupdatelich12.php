<?php
ob_start();
include_once("controller/clich.php");
include_once("controller/clophoc.php");
$p = new controllophoc();
$malophoc = $_REQUEST["updatelich12"];

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
                    <h1 class="h2" style="padding-left: 200px;">CẬP NHẬT CHI TIẾT LỚP HỌC</h1> <br>
                </div>
                <form class="js-form-submit-data" action="#" method="POST">
                    <div class="form-group row">
                        <label for="tenlop" class="col-md-2 offset-md-2 col-form-label">Tên lớp</label>
                        <div class="col-md-6">
                            <input type="text" required class="form-control " id="tenlop" name="tenlop" value="<?php echo $row["TenLop"] ?>">
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
                    <div class="form-group row">
                        <label for="thoigian" class="col-md-2 offset-md-2 col-form-label">Thời gian dự kiến mở lớp</label>
                        <div class="col-md-6">
                            <input type="date" required class="form-control " id="thoigian" name="thoigian" value="<?php echo $row["NgayBD"] ?>">
                        </div>
                    </div>
                    <div class="form-group row mt-5">
                            <label for="lophoc" class="col-md-2 offset-md-2 col-form-label">Buổi 1</label>
                            <div class="col-md-6">
                                <?php 
                                 include_once("controller/clich.php");
                                 $p2 = new controllich();
                                 $table2 = $p2->laytietvabuoi($malophoc, 0);
                                 if ($table2) {
                                     if (mysqli_num_rows($table2) > 0) {
                                    $row2 = mysqli_fetch_assoc($table2); 
                                ?>
                        <input type="hidden" name="thu1cu" value="<?php echo $row2['MaThu']  ?>">
                        <input type="hidden" name="tiet1cu" value="<?php echo $row2['MaTiet']  ?>">

                                    <div class="col-md-6">
                                            <select name="thu1" id="" required>
                                            <option value="1" <?php if($row2["MaThu"]==1){echo "selected";} ?>>Thứ 2</option>
                                            <option value="2" <?php if($row2["MaThu"]==2){echo "selected";} ?>>Thứ 3</option>
                                            <option value="3" <?php if($row2["MaThu"]==3){echo "selected";} ?>>Thứ 4</option>
                                            <option value="4" <?php if($row2["MaThu"]==4){echo "selected";} ?>>Thứ 5</option>
                                            <option value="5" <?php if($row2["MaThu"]==5){echo "selected";} ?>>Thứ 6</option>
                                            <option value="6" <?php if($row2["MaThu"]==6){echo "selected";} ?>>Thứ 7</option>
                                            <option value="7" <?php if($row2["MaThu"]==7){echo "selected";} ?>>Chủ Nhật</option>
                                        </select>
                                        <select name="tiet1" id="">
                                            <option value="1" <?php if($row2["MaTiet"]==1){echo "selected";} ?>>Tiết 1 (7h-9h)</option>
                                            <option value="2" <?php if($row2["MaTiet"]==2){echo "selected";} ?>>Tiết 2 (9h-11h)</option>
                                            <option value="3" <?php if($row2["MaTiet"]==3){echo "selected";} ?>>Tiết 3 (1h-3h)</option>
                                            <option value="4" <?php if($row2["MaTiet"]==4){echo "selected";} ?>>Tiết 4 (3h-5h)</option>
                                            <option value="5" <?php if($row2["MaTiet"]==5){echo "selected";} ?>>Tiết 5 (18h-20h)</option>
                                            <option value="6" <?php if($row2["MaTiet"]==6){echo "selected";} ?>>Tiết 6 (20h-22h)</option>
                                        </select>
                                        </div>
                                <?php       
                                    }
                                }?>
                            </div>
                        </div>
                        <div class="form-group row mt-5">
                            <label for="lophoc" class="col-md-2 offset-md-2 col-form-label">Buổi 2</label>
                            <div class="col-md-6">
                                <?php 
                                 include_once("controller/clich.php");
                                 $p2 = new controllich();
                                 $table2 = $p2->laytietvabuoi($malophoc, 1);
                                 if ($table2) {
                                     if (mysqli_num_rows($table2) > 0) {
                                    $row2 = mysqli_fetch_assoc($table2); 
                                ?>
                        <input type="hidden" name="thu2cu" value="<?php echo $row2['MaThu']  ?>">
                        <input type="hidden" name="tiet2cu" value="<?php echo $row2['MaTiet']  ?>">
                                    <div class="col-md-6">
                                            <select name="thu2" id="" required>
                                            <option value="1" <?php if($row2["MaThu"]==1){echo "selected";} ?>>Thứ 2</option>
                                            <option value="2" <?php if($row2["MaThu"]==2){echo "selected";} ?>>Thứ 3</option>
                                            <option value="3" <?php if($row2["MaThu"]==3){echo "selected";} ?>>Thứ 4</option>
                                            <option value="4" <?php if($row2["MaThu"]==4){echo "selected";} ?>>Thứ 5</option>
                                            <option value="5" <?php if($row2["MaThu"]==5){echo "selected";} ?>>Thứ 6</option>
                                            <option value="6" <?php if($row2["MaThu"]==6){echo "selected";} ?>>Thứ 7</option>
                                            <option value="7" <?php if($row2["MaThu"]==7){echo "selected";} ?>>Chủ Nhật</option>
                                        </select>
                                        <select name="tiet2" id="">
                                            <option value="1" <?php if($row2["MaTiet"]==1){echo "selected";} ?>>Tiết 1 (7h-9h)</option>
                                            <option value="2" <?php if($row2["MaTiet"]==2){echo "selected";} ?>>Tiết 2 (9h-11h)</option>
                                            <option value="3" <?php if($row2["MaTiet"]==3){echo "selected";} ?>>Tiết 3 (1h-3h)</option>
                                            <option value="4" <?php if($row2["MaTiet"]==4){echo "selected";} ?>>Tiết 4 (3h-5h)</option>
                                            <option value="5" <?php if($row2["MaTiet"]==5){echo "selected";} ?>>Tiết 5 (18h-20h)</option>
                                            <option value="6" <?php if($row2["MaTiet"]==6){echo "selected";} ?>>Tiết 6 (20h-22h)</option>
                                        </select>
                                        </div>
                                <?php       
                                    }
                                }?>
                            </div>
                        </div>
                        <?php 
                        include_once("controller/clich.php");
                        $p2 = new controllich();
                        $table2 = $p2->laytietvabuoi($malophoc, 2);
                        if ($table2) {
                            if (mysqli_num_rows($table2) > 0) {
                                $row2 = mysqli_fetch_assoc($table2); 
                        ?>
                        <input type="hidden" name="thu3cu" value="<?php echo $row2['MaThu']  ?>">
                        <input type="hidden" name="tiet3cu" value="<?php echo $row2['MaTiet']  ?>">
                        <div class="form-group row mt-5">
                            <label for="lophoc" class="col-md-2 offset-md-2 col-form-label">Buổi 3</label>
                            <div class="col-md-6">
                                
                                    <div class="col-md-6">
                                            <select name="thu3" id="" required>
                                            <option value="1" <?php if($row2["MaThu"]==1){echo "selected";} ?>>Thứ 2</option>
                                            <option value="2" <?php if($row2["MaThu"]==2){echo "selected";} ?>>Thứ 3</option>
                                            <option value="3" <?php if($row2["MaThu"]==3){echo "selected";} ?>>Thứ 4</option>
                                            <option value="4" <?php if($row2["MaThu"]==4){echo "selected";} ?>>Thứ 5</option>
                                            <option value="5" <?php if($row2["MaThu"]==5){echo "selected";} ?>>Thứ 6</option>
                                            <option value="6" <?php if($row2["MaThu"]==6){echo "selected";} ?>>Thứ 7</option>
                                            <option value="7" <?php if($row2["MaThu"]==7){echo "selected";} ?>>Chủ Nhật</option>
                                        </select>
                                        <select name="tiet3" id="">
                                            <option value="1" <?php if($row2["MaTiet"]==1){echo "selected";} ?>>Tiết 1 (7h-9h)</option>
                                            <option value="2" <?php if($row2["MaTiet"]==2){echo "selected";} ?>>Tiết 2 (9h-11h)</option>
                                            <option value="3" <?php if($row2["MaTiet"]==3){echo "selected";} ?>>Tiết 3 (1h-3h)</option>
                                            <option value="4" <?php if($row2["MaTiet"]==4){echo "selected";} ?>>Tiết 4 (3h-5h)</option>
                                            <option value="5" <?php if($row2["MaTiet"]==5){echo "selected";} ?>>Tiết 5 (18h-20h)</option>
                                            <option value="6" <?php if($row2["MaTiet"]==6){echo "selected";} ?>>Tiết 6 (20h-22h)</option>
                                        </select>
                                        </div>
                                
                            </div>
                        </div>
                        <?php       
                            }else{
                                echo "<input type='hidden' required class='form-control' id='thu3' name='thu3' value='0'>";
                                echo "<input type='hidden' required class='form-control' id='tiet3' name='tiet3' value='0'>";
                                echo "<input type='hidden' required class='form-control' id='thu3' name='thu3cu' value='0'>";
                                echo "<input type='hidden' required class='form-control' id='tiet3' name='tiet3cu' value='0'>";
                            }
                        }?>
                    <div class="form-group row">
                        <label for="hocphi" class="col-md-2 offset-md-2 col-form-label">Học phí</label>
                        <div class="col-md-6">
                            <input type="text" required class="form-control " id="hocphi" name="hocphi" value="<?php echo $row["HocPhi"] ?>">
                        </div>
                    </div>
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
        $gvcu = $_REQUEST["gvcu"];
        $tenlop = $_REQUEST["tenlop"];
        $giaovien = $_REQUEST['giaovien'];
        $siso = $_REQUEST["siso"];
        $thoigian = $_REQUEST["thoigian"];
        $hocphi = $_REQUEST["hocphi"];
        $id = $_REQUEST["id"];
        $pass = $_REQUEST["pass"];
        //số buổi
        $tiet1 = $_REQUEST["tiet1"]; $thu1 =  $_REQUEST["thu1"]; 
        $tiet2 = $_REQUEST["tiet2"]; $thu2 =  $_REQUEST["thu2"]; 
        $tiet3 = $_REQUEST["tiet3"]; $thu3 =  $_REQUEST["thu3"]; 
        //số buổi cũ
        $tiet1cu = $_REQUEST["tiet1cu"]; $thu1cu =  $_REQUEST["thu1cu"]; 
        $tiet2cu = $_REQUEST["tiet2cu"]; $thu2cu =  $_REQUEST["thu2cu"]; 
        $tiet3cu = $_REQUEST["tiet3cu"]; $thu3cu =  $_REQUEST["thu3cu"]; 

        $ngay = date('Y-m-d');
		$ngay = strtotime($ngay);
		$ngaylich = strtotime($thoigian);
		if ($ngaylich < $ngay) {
			echo "<script>alert('Thời gian bắt đầu không được bé hơn thời gian hiện tại')</script>"; // thời gian bắt đầu k được bé hơn tg kết thúc
		}else{
            $ktra1 = $p -> layupdate1chitietlophoc($malophoc, $giaovien, $tenlop, $siso, $thoigian, $hocphi,
                     $thu1, $tiet1, $thu1cu, $tiet1cu, $thu2, $tiet2, $thu2cu, $tiet2cu,$thu3, $tiet3, $thu3cu, $tiet3cu, $gvcu, $id, $pass);
            if($ktra1 == 1){
                echo header("refresh:0; url='QL.php?hocsinh'");
            }elseif($ktra1 == 2){
                echo "<script>alert('Không thể cập nhật buổi học mới')</script>";
            }elseif($ktra1 == 3){
                echo "<script>alert('Giáo viên bị trùng lịch giảng dạy')</script>";
            }elseif($ktra1 == 4){
                echo "<script>alert('Học sinh có lịch bị trùng')</script>";
            }elseif($ktra1 == 0){
                echo "<script>alert('Lỗi không xác định')</script>";
            }
        }
    }
    ?>
</body>

</html>