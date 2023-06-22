<?php
ob_start();
?>
<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>Lịch giảng dạy</title>
    <link rel="stylesheet" href="view/styles/lich_day.css">
</head>
<?php
// if(!include('Windows.location')){
//     require( PHP_WINDOWS_EVENT_CTRL_C);
// }
// if(location.reload()){
//     setcookie('ngaythang', mktime(0, 0, 0, $thang , $ngay, $nam), time() - 600);
// }
if (isset($_COOKIE["ngaythang"]) & isset($_REQUEST["hientai"])) {
    setcookie('ngaythang', false);
    echo header("refresh:0; url='GV.php?dslich'");
}
$ma = $_SESSION["tendangnhap"];
include_once("controller/clich.php");
$p = new controllich();
$table = $p->laylichchoGV($ma);
if ($table) {
    if (mysqli_num_rows($table) > 0) {
        //lấy ngày tháng năm
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $thu = date("l");
        $thu = strtolower($thu);

        if (isset($_COOKIE["ngaythang"])) {
            $ngay = date("d", $_COOKIE["ngaythang"]);
            $thang = date("m", $_COOKIE["ngaythang"]);
            $nam = date("Y", $_COOKIE["ngaythang"]);
        } else {
            $ngay = date("d");
            $thang = date("m");
            $nam = date("Y");
        }
        //thêm tuần trước và sau
        ?>
        <div class="popular page_section">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="section_title text-center">
                            <h1 style="margin-bottom: 50px;">Lịch giảng dạy theo tuần</h1>
                        </div>
                    </div>
                </div>

                <form action="#" method="POST" id="form_button">
                    <button type="submit" name="hientai" class="button">Hiện tại</button>
                    <button type="submit" name="btnsubmit1" class="button">
                        < Tuần trước</button>
                            <button type="submit" name="btnsubmit2" class="button">Tuần sau ></button>
                </form>
                <?php
                //nhấn tuần trước
                if (isset($_REQUEST["btnsubmit1"])) {
                    $ngaytruoc = mktime(0, 0, 0, $thang, $ngay - 7, $nam);
                    $ngay = date("d", $ngaytruoc);
                    $thang = date("m", $ngaytruoc);
                    $nam = date("Y", $ngaytruoc);
                    setcookie('ngaythang', mktime(0, 0, 0, $thang, $ngay, $nam), time() + 600);
                }
                //nhấn tuần sau
                if (isset($_REQUEST["btnsubmit2"])) {
                    $ngaysau = mktime(0, 0, 0, $thang, $ngay + 7, $nam);
                    $ngay = date("d", $ngaysau);
                    $thang = date("m", $ngaysau);
                    $nam = date("Y", $ngaysau);
                    setcookie('ngaythang', mktime(0, 0, 0, $thang, $ngay, $nam), time() + 600);
                }

                switch ($thu) {
                    case 'monday':
                        $ngay2 = mktime(0, 0, 0, $thang, $ngay, $nam);
                        $ngay2 = date('d-m-Y', $ngay2);
                        $ngay3 = mktime(0, 0, 0, $thang, $ngay + 1, $nam);
                        $ngay3 = date('d-m-Y', $ngay3);
                        $ngay4 = mktime(0, 0, 0, $thang, $ngay + 2, $nam);
                        $ngay4 = date('d-m-Y', $ngay4);
                        $ngay5 = mktime(0, 0, 0, $thang, $ngay + 3, $nam);
                        $ngay5 = date('d-m-Y', $ngay5);
                        $ngay6 = mktime(0, 0, 0, $thang, $ngay + 4, $nam);
                        $ngay6 = date('d-m-Y', $ngay6);
                        $ngay7 = mktime(0, 0, 0, $thang, $ngay + 5, $nam);
                        $ngay7 = date('d-m-Y', $ngay7);
                        $ngaycn = mktime(0, 0, 0, $thang, $ngay + 6, $nam);
                        $ngaycn = date('d-m-Y', $ngaycn);
                        break;
                    case 'tuesday':
                        $ngay2 = mktime(0, 0, 0, $thang, $ngay - 1, $nam);
                        $ngay2 = date('d-m-Y', $ngay2);
                        $ngay3 = mktime(0, 0, 0, $thang, $ngay, $nam);
                        $ngay3 = date('d-m-Y', $ngay3);
                        $ngay4 = mktime(0, 0, 0, $thang, $ngay + 1, $nam);
                        $ngay4 = date('d-m-Y', $ngay4);
                        $ngay5 = mktime(0, 0, 0, $thang, $ngay + 2, $nam);
                        $ngay5 = date('d-m-Y', $ngay5);
                        $ngay6 = mktime(0, 0, 0, $thang, $ngay + 3, $nam);
                        $ngay6 = date('d-m-Y', $ngay6);
                        $ngay7 = mktime(0, 0, 0, $thang, $ngay + 4, $nam);
                        $ngay7 = date('d-m-Y', $ngay7);
                        $ngaycn = mktime(0, 0, 0, $thang, $ngay + 5, $nam);
                        $ngaycn = date('d-m-Y', $ngaycn);
                        break;
                    case 'wednesday':
                        $ngay2 = mktime(0, 0, 0, $thang, $ngay - 2, $nam);
                        $ngay2 = date('d-m-Y', $ngay2);
                        $ngay3 = mktime(0, 0, 0, $thang, $ngay - 1, $nam);
                        $ngay3 = date('d-m-Y', $ngay3);
                        $ngay4 = mktime(0, 0, 0, $thang, $ngay, $nam);
                        $ngay4 = date('d-m-Y', $ngay4);
                        $ngay5 = mktime(0, 0, 0, $thang, $ngay + 1, $nam);
                        $ngay5 = date('d-m-Y', $ngay5);
                        $ngay6 = mktime(0, 0, 0, $thang, $ngay + 2, $nam);
                        $ngay6 = date('d-m-Y', $ngay6);
                        $ngay7 = mktime(0, 0, 0, $thang, $ngay + 3, $nam);
                        $ngay7 = date('d-m-Y', $ngay7);
                        $ngaycn = mktime(0, 0, 0, $thang, $ngay + 4, $nam);
                        $ngaycn = date('d-m-Y', $ngaycn);
                        break;
                    case 'thursday':
                        $ngay2 = mktime(0, 0, 0, $thang, $ngay - 3, $nam);
                        $ngay2 = date('d-m-Y', $ngay2);
                        $ngay3 = mktime(0, 0, 0, $thang, $ngay - 2, $nam);
                        $ngay3 = date('d-m-Y', $ngay3);
                        $ngay4 = mktime(0, 0, 0, $thang, $ngay - 1, $nam);
                        $ngay4 = date('d-m-Y', $ngay4);
                        $ngay5 = mktime(0, 0, 0, $thang, $ngay, $nam);
                        $ngay5 = date('d-m-Y', $ngay5);
                        $ngay6 = mktime(0, 0, 0, $thang, $ngay + 1, $nam);
                        $ngay6 = date('d-m-Y', $ngay6);
                        $ngay7 = mktime(0, 0, 0, $thang, $ngay + 2, $nam);
                        $ngay7 = date('d-m-Y', $ngay7);
                        $ngaycn = mktime(0, 0, 0, $thang, $ngay + 3, $nam);
                        $ngaycn = date('d-m-Y', $ngaycn);
                        break;
                    case 'friday':
                        $ngay2 = mktime(0, 0, 0, $thang, $ngay - 4, $nam);
                        $ngay2 = date('d-m-Y', $ngay2);
                        $ngay3 = mktime(0, 0, 0, $thang, $ngay - 3, $nam);
                        $ngay3 = date('d-m-Y', $ngay3);
                        $ngay4 = mktime(0, 0, 0, $thang, $ngay - 2, $nam);
                        $ngay4 = date('d-m-Y', $ngay4);
                        $ngay5 = mktime(0, 0, 0, $thang, $ngay - 1, $nam);
                        $ngay5 = date('d-m-Y', $ngay5);
                        $ngay6 = mktime(0, 0, 0, $thang, $ngay, $nam);
                        $ngay6 = date('d-m-Y', $ngay6);
                        $ngay7 = mktime(0, 0, 0, $thang, $ngay + 1, $nam);
                        $ngay7 = date('d-m-Y', $ngay7);
                        $ngaycn = mktime(0, 0, 0, $thang, $ngay + 2, $nam);
                        $ngaycn = date('d-m-Y', $ngaycn);
                        break;
                    case 'saturday':
                        $ngay2 = mktime(0, 0, 0, $thang, $ngay - 5, $nam);
                        $ngay2 = date('d-m-Y', $ngay2);
                        $ngay3 = mktime(0, 0, 0, $thang, $ngay - 4, $nam);
                        $ngay3 = date('d-m-Y', $ngay3);
                        $ngay4 = mktime(0, 0, 0, $thang, $ngay - 3, $nam);
                        $ngay4 = date('d-m-Y', $ngay4);
                        $ngay5 = mktime(0, 0, 0, $thang, $ngay - 2, $nam);
                        $ngay5 = date('d-m-Y', $ngay5);
                        $ngay6 = mktime(0, 0, 0, $thang, $ngay - 1, $nam);
                        $ngay6 = date('d-m-Y', $ngay6);
                        $ngay7 = mktime(0, 0, 0, $thang, $ngay, $nam);
                        $ngay7 = date('d-m-Y', $ngay7);
                        $ngaycn = mktime(0, 0, 0, $thang, $ngay + 1, $nam);
                        $ngaycn = date('d-m-Y', $ngaycn);
                        break;
                    default:
                        $ngay2 = mktime(0, 0, 0, $thang, $ngay - 6, $nam);
                        $ngay2 = date('d-m-Y', $ngay2);
                        $ngay3 = mktime(0, 0, 0, $thang, $ngay - 5, $nam);
                        $ngay3 = date('d-m-Y', $ngay3);
                        $ngay4 = mktime(0, 0, 0, $thang, $ngay - 4, $nam);
                        $ngay4 = date('d-m-Y', $ngay4);
                        $ngay5 = mktime(0, 0, 0, $thang, $ngay - 3, $nam);
                        $ngay5 = date('d-m-Y', $ngay5);
                        $ngay6 = mktime(0, 0, 0, $thang, $ngay - 2, $nam);
                        $ngay6 = date('d-m-Y', $ngay6);
                        $ngay7 = mktime(0, 0, 0, $thang, $ngay - 1, $nam);
                        $ngay7 = date('d-m-Y', $ngay7);
                        $ngaycn = mktime(0, 0, 0, $thang, $ngay, $nam);
                        $ngaycn = date('d-m-Y', $ngaycn);
                        break;
                }
                ?>
                <table style="width:99%; font-size: 20px ; text-align: center; margin: 5px; border : 1px solid black"
                    border="1">
                    <tr>
                        <td style='color: white; text-align:center;border: 1px solid black;  background: #015f95;'>Ca Học</td>
                        <td style='color: white; text-align:center;border: 1px solid black;  background: #015f95;'>Thứ 2 <br>
                            <?php echo $ngay2 ?>
                        </td>
                        <td style='color: white; text-align:center;border: 1px solid black;  background: #015f95;'>Thứ 3 <br>
                            <?php echo $ngay3 ?>
                        </td>
                        <td style='color: white; text-align:center;border: 1px solid black;  background: #015f95;'>Thứ 4 <br>
                            <?php echo $ngay4 ?>
                        </td>
                        <td style='color: white; text-align:center;border: 1px solid black;  background: #015f95;'>Thứ 5 <br>
                            <?php echo $ngay5 ?>
                        </td>
                        <td style='color: white; text-align:center;border: 1px solid black;  background: #015f95;'>Thứ 6 <br>
                            <?php echo $ngay6 ?>
                        </td>
                        <td style='color: white; text-align:center;border: 1px solid black;  background: #015f95;'>Thứ 7 <br>
                            <?php echo $ngay7 ?>
                        </td>
                        <td style='color: white; text-align:center;border: 1px solid black;  background: #015f95;'>Chủ nhật <br>
                            <?php echo $ngaycn ?>
                        </td>
                    </tr>
                    <tr>
                        <td style="background-color: rgb(255, 241, 153);">Sáng</td>
                        <td id="thu2sang">
                            <?php
                            $table1 = $p->laylichchoGV1($ma, $ngay2);
                            while ($row1 = mysqli_fetch_assoc($table1)) {
                                echo "<table  style='border : 1px solid black; background: #ADD8E6; margin: 10px -25px 10px 20px;'> <tr> <td>";
                                echo "<b style='font-size: 15px;'>";
                                echo $row1["TenLop"];
                                echo "</b>";
                                if ($row1["TrangThaiBuoiHoc"] == 0) {
                                    echo "<br>";
                                    echo "(Đang lên kế hoạch)";
                                }
                                echo "<p style='font-size: 13px; color:black;'>Tiết học: ";
                                echo $row1["Tiet"] . "</p>";
                                echo "<p style='font-size: 13px; color: black; margin: -10px 5px -10px 5px;'>ID lớp: ";
                                echo $row1["Id"] . "</p>";
                                echo "<p style='font-size: 13px; color:black;'>Password: ";
                                echo $row1["Pass"] . "</p>";
                                echo "<p style='font-size: 13px; color:black;'>Ghi chú: ";
                                echo $row1["GhiChu"] . "</p>";
                                echo "</td> </tr> </table>";
                            }
                            ?>
                        </td>
                        <td id="thu3sang">
                            <?php
                            $table1 = $p->laylichchoGV1($ma, $ngay3);
                            while ($row1 = mysqli_fetch_assoc($table1)) {
                                echo "<table  style='border : 1px solid black; background: #ADD8E6; margin: 10px -25px 10px 20px;'> <tr> <td>";
                                echo "<b style='font-size: 15px;'>";
                                echo $row1["TenLop"];
                                echo "</b>";
                                if ($row1["TrangThaiBuoiHoc"] == 0) {
                                    echo "<br>";
                                    echo "(Đang lên kế hoạch)";
                                }
                                echo "<p style='font-size: 13px; color:black;'>Tiết học: ";
                                echo $row1["Tiet"] . "</p>";
                                echo "<p style='font-size: 13px; color: black; margin: -10px 5px -10px 5px;'>ID lớp: ";
                                echo $row1["Id"] . "</p>";
                                echo "<p style='font-size: 13px; color:black;'>Password: ";
                                echo $row1["Pass"] . "</p>";
                                echo "<p style='font-size: 13px; color:black;'>Ghi chú: ";
                                echo $row1["GhiChu"] . "</p>";
                                echo "</td> </tr> </table>";
                            }
                            ?>
                        </td>
                        <td id="thu4sang">
                            <?php
                            $table1 = $p->laylichchoGV1($ma, $ngay4);
                            while ($row1 = mysqli_fetch_assoc($table1)) {
                                echo "<table  style='border : 1px solid black; background: #ADD8E6; margin: 10px -25px 10px 20px;'> <tr> <td>";
                                echo "<b style='font-size: 15px;'>";
                                echo $row1["TenLop"];
                                echo "</b>";
                                if ($row1["TrangThaiBuoiHoc"] == 0) {
                                    echo "<br>";
                                    echo "(Đang lên kế hoạch)";
                                }
                                echo "<p style='font-size: 13px; color:black;'>Tiết học: ";
                                echo $row1["Tiet"] . "</p>";
                                echo "<p style='font-size: 13px; color: black; margin: -10px 5px -10px 5px;'>ID lớp: ";
                                echo $row1["Id"] . "</p>";
                                echo "<p style='font-size: 13px; color:black;'>Password: ";
                                echo $row1["Pass"] . "</p>";
                                echo "<p style='font-size: 13px; color:black;'>Ghi chú: ";
                                echo $row1["GhiChu"] . "</p>";
                                echo "</td> </tr> </table>";
                            }
                            ?>
                        </td>
                        <td id="thu5sang">
                            <?php
                            $table1 = $p->laylichchoGV1($ma, $ngay5);
                            while ($row1 = mysqli_fetch_assoc($table1)) {
                                echo "<table  style='border : 1px solid black; background: #ADD8E6; margin: 10px -25px 10px 20px;'> <tr> <td>";
                                echo "<b style='font-size: 15px;'>";
                                echo $row1["TenLop"];
                                echo "</b>";
                                if ($row1["TrangThaiBuoiHoc"] == 0) {
                                    echo "<br>";
                                    echo "(Đang lên kế hoạch)";
                                }
                                echo "<p style='font-size: 13px; color:black;'>Tiết học: ";
                                echo $row1["Tiet"] . "</p>";
                                echo "<p style='font-size: 13px; color: black; margin: -10px 5px -10px 5px;'>ID lớp: ";
                                echo $row1["Id"] . "</p>";
                                echo "<p style='font-size: 13px; color:black;'>Password: ";
                                echo $row1["Pass"] . "</p>";
                                echo "<p style='font-size: 13px; color:black;'>Ghi chú: ";
                                echo $row1["GhiChu"] . "</p>";
                                echo "</td> </tr> </table>";
                            }
                            ?>
                        </td>
                        <td id="thu6sang">
                            <?php
                            $table1 = $p->laylichchoGV1($ma, $ngay6);
                            while ($row1 = mysqli_fetch_assoc($table1)) {
                                echo "<table  style='border : 1px solid black; background: #ADD8E6; margin: 10px -25px 10px 20px;'> <tr> <td>";
                                echo "<b style='font-size: 15px;'>";
                                echo $row1["TenLop"];
                                echo "</b>";
                                if ($row1["TrangThaiBuoiHoc"] == 0) {
                                    echo "<br>";
                                    echo "(Đang lên kế hoạch)";
                                }
                                echo "<p style='font-size: 13px; color:black;'>Tiết học: ";
                                echo $row1["Tiet"] . "</p>";
                                echo "<p style='font-size: 13px; color: black; margin: -10px 5px -10px 5px;'>ID lớp: ";
                                echo $row1["Id"] . "</p>";
                                echo "<p style='font-size: 13px; color:black;'>Password: ";
                                echo $row1["Pass"] . "</p>";
                                echo "<p style='font-size: 13px; color:black;'>Ghi chú: ";
                                echo $row1["GhiChu"] . "</p>";
                                echo "</td> </tr> </table>";
                            }
                            ?>
                        </td>
                        <td id="thu7sang">
                            <?php
                            $table1 = $p->laylichchoGV1($ma, $ngay7);
                            while ($row1 = mysqli_fetch_assoc($table1)) {
                                echo "<table  style='border : 1px solid black; background: #ADD8E6; margin: 10px -25px 10px 20px;'> <tr> <td>";
                                echo "<b style='font-size: 15px;'>";
                                echo $row1["TenLop"];
                                echo "</b>";
                                if ($row1["TrangThaiBuoiHoc"] == 0) {
                                    echo "<br>";
                                    echo "(Đang lên kế hoạch)";
                                }
                                echo "<p style='font-size: 13px; color:black;'>Tiết học: ";
                                echo $row1["Tiet"] . "</p>";
                                echo "<p style='font-size: 13px; color: black; margin: -10px 5px -10px 5px;'>ID lớp: ";
                                echo $row1["Id"] . "</p>";
                                echo "<p style='font-size: 13px; color:black;'>Password: ";
                                echo $row1["Pass"] . "</p>";
                                echo "<p style='font-size: 13px; color:black;'>Ghi chú: ";
                                echo $row1["GhiChu"] . "</p>";
                                echo "</td> </tr> </table>";
                            }
                            ?>
                        </td>
                        <td id="cnsang">
                            <?php
                            $table1 = $p->laylichchoGV1($ma, $ngaycn);
                            while ($row1 = mysqli_fetch_assoc($table1)) {
                                echo "<table  style='border : 1px solid black; background: #ADD8E6; margin: 10px -25px 10px 20px;'> <tr> <td>";
                                echo "<b style='font-size: 15px;'>";
                                echo $row1["TenLop"];
                                echo "</b>";
                                if ($row1["TrangThaiBuoiHoc"] == 0) {
                                    echo "<br>";
                                    echo "(Đang lên kế hoạch)";
                                }
                                echo "<p style='font-size: 13px; color:black;'>Tiết học: ";
                                echo $row1["Tiet"] . "</p>";
                                echo "<p style='font-size: 13px; color: black; margin: -10px 5px -10px 5px;'>ID lớp: ";
                                echo $row1["Id"] . "</p>";
                                echo "<p style='font-size: 13px; color:black;'>Password: ";
                                echo $row1["Pass"] . "</p>";
                                echo "<p style='font-size: 13px; color:black;'>Ghi chú: ";
                                echo $row1["GhiChu"] . "</p>";
                                echo "</td> </tr> </table>";
                            }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td style="background-color: rgb(255, 241, 153);">Chiều</td>
                        <td id="thu2chieu">
                            <?php
                            $table2 = $p->laylichchoGV2($ma, $ngay2);
                            while ($row2 = mysqli_fetch_assoc($table2)) {
                                echo "<table  style='border : 1px solid black; background: #ADD8E6; margin: 10px -25px 10px 20px;'> <tr> <td>";
                                echo "<b style='font-size: 15px;'>";
                                echo $row2["TenLop"];
                                echo "</b>";
                                if ($row2["TrangThaiBuoiHoc"] == 0) {
                                    echo "<br>";
                                    echo "(Đang lên kế hoạch)";
                                }
                                echo "<p style='font-size: 13px; color:black;'>Tiết học: ";
                                echo $row2["Tiet"] . "</p>";
                                echo "<p style='font-size: 13px; color: black; margin: -10px 5px -10px 5px;'>ID lớp: ";
                                echo $row2["Id"] . "</p>";
                                echo "<p style='font-size: 13px; color:black;'>Password: ";
                                echo $row2["Pass"] . "</p>";
                                echo "<p style='font-size: 13px; color:black;'>Ghi chú: ";
                                echo $row2["GhiChu"] . "</p>";
                                echo "</td> </tr> </table>";
                            }
                            ?>
                        </td>
                        <td id="thu3chieu">
                            <?php
                            $table2 = $p->laylichchoGV2($ma, $ngay3);
                            while ($row2 = mysqli_fetch_assoc($table2)) {
                                echo "<table  style='border : 1px solid black; background: #ADD8E6; margin: 10px -25px 10px 20px;'> <tr> <td>";
                                echo "<b style='font-size: 15px;'>";
                                echo $row2["TenLop"];
                                echo "</b>";
                                if ($row2["TrangThaiBuoiHoc"] == 0) {
                                    echo "<br>";
                                    echo "(Đang lên kế hoạch)";
                                }
                                echo "<p style='font-size: 13px; color:black;'>Tiết học: ";
                                echo $row2["Tiet"] . "</p>";
                                echo "<p style='font-size: 13px; color: black; margin: -10px 5px -10px 5px;'>ID lớp: ";
                                echo $row2["Id"] . "</p>";
                                echo "<p style='font-size: 13px; color:black;'>Password: ";
                                echo $row2["Pass"] . "</p>";
                                echo "<p style='font-size: 13px; color:black;'>Ghi chú: ";
                                echo $row2["GhiChu"] . "</p>";
                                echo "</td> </tr> </table>";
                            }
                            ?>
                        </td>
                        <td id="thu4chieu">
                            <?php
                            $table2 = $p->laylichchoGV2($ma, $ngay4);
                            while ($row2 = mysqli_fetch_assoc($table2)) {
                                echo "<table  style='border : 1px solid black; background: #ADD8E6; margin: 10px -25px 10px 20px;'> <tr> <td>";
                                echo "<b style='font-size: 15px;'>";
                                echo $row2["TenLop"];
                                echo "</b>";
                                if ($row2["TrangThaiBuoiHoc"] == 0) {
                                    echo "<br>";
                                    echo "(Đang lên kế hoạch)";
                                }
                                echo "<p style='font-size: 13px; color:black;'>Tiết học: ";
                                echo $row2["Tiet"] . "</p>";
                                echo "<p style='font-size: 13px; color: black; margin: -10px 5px -10px 5px;'>ID lớp: ";
                                echo $row2["Id"] . "</p>";
                                echo "<p style='font-size: 13px; color:black;'>Password: ";
                                echo $row2["Pass"] . "</p>";
                                echo "<p style='font-size: 13px; color:black;'>Ghi chú: ";
                                echo $row2["GhiChu"] . "</p>";
                                echo "</td> </tr> </table>";
                            }
                            ?>
                        </td>
                        <td id="thu5chieu">
                            <?php
                            $table2 = $p->laylichchoGV2($ma, $ngay5);
                            while ($row2 = mysqli_fetch_assoc($table2)) {
                                echo "<table  style='border : 1px solid black; background: #ADD8E6; margin: 10px -25px 10px 20px;'> <tr> <td>";
                                echo "<b style='font-size: 15px;'>";
                                echo $row2["TenLop"];
                                echo "</b>";
                                if ($row2["TrangThaiBuoiHoc"] == 0) {
                                    echo "<br>";
                                    echo "(Đang lên kế hoạch)";
                                }
                                echo "<p style='font-size: 13px; color:black;'>Tiết học: ";
                                echo $row2["Tiet"] . "</p>";
                                echo "<p style='font-size: 13px; color: black; margin: -10px 5px -10px 5px;'>ID lớp: ";
                                echo $row2["Id"] . "</p>";
                                echo "<p style='font-size: 13px; color:black;'>Password: ";
                                echo $row2["Pass"] . "</p>";
                                echo "<p style='font-size: 13px; color:black;'>Ghi chú: ";
                                echo $row2["GhiChu"] . "</p>";
                                echo "</td> </tr> </table>";
                            }
                            ?>
                        </td>
                        <td id="thu6chieu">
                            <?php
                            $table2 = $p->laylichchoGV2($ma, $ngay6);
                            while ($row2 = mysqli_fetch_assoc($table2)) {
                                echo "<table  style='border : 1px solid black; background: #ADD8E6; margin: 10px -25px 10px 20px;'> <tr> <td>";
                                echo "<b style='font-size: 15px;'>";
                                echo $row2["TenLop"];
                                echo "</b>";
                                if ($row2["TrangThaiBuoiHoc"] == 0) {
                                    echo "<br>";
                                    echo "(Đang lên kế hoạch)";
                                }
                                echo "<p style='font-size: 13px; color:black;'>Tiết học: ";
                                echo $row2["Tiet"] . "</p>";
                                echo "<p style='font-size: 13px; color: black; margin: -10px 5px -10px 5px;'>ID lớp: ";
                                echo $row2["Id"] . "</p>";
                                echo "<p style='font-size: 13px; color:black;'>Password: ";
                                echo $row2["Pass"] . "</p>";
                                echo "<p style='font-size: 13px; color:black;'>Ghi chú: ";
                                echo $row2["GhiChu"] . "</p>";
                                echo "</td> </tr> </table>";
                            }
                            ?>
                        </td>
                        <td id="thu7chieu">
                            <?php
                            $table2 = $p->laylichchoGV2($ma, $ngay7);
                            while ($row2 = mysqli_fetch_assoc($table2)) {
                                echo "<table  style='border : 1px solid black; background: #ADD8E6; margin: 10px -25px 10px 20px;'> <tr> <td>";
                                echo "<b style='font-size: 15px;'>";
                                echo $row2["TenLop"];
                                echo "</b>";
                                if ($row2["TrangThaiBuoiHoc"] == 0) {
                                    echo "<br>";
                                    echo "(Đang lên kế hoạch)";
                                }
                                echo "<p style='font-size: 13px; color:black;'>Tiết học: ";
                                echo $row2["Tiet"] . "</p>";
                                echo "<p style='font-size: 13px; color: black; margin: -10px 5px -10px 5px;'>ID lớp: ";
                                echo $row2["Id"] . "</p>";
                                echo "<p style='font-size: 13px; color:black;'>Password: ";
                                echo $row2["Pass"] . "</p>";
                                echo "<p style='font-size: 13px; color:black;'>Ghi chú: ";
                                echo $row2["GhiChu"] . "</p>";
                                echo "</td> </tr> </table>";
                            }
                            ?>
                        </td>
                        <td id="thucnchieu">
                            <?php
                            $table2 = $p->laylichchoGV2($ma, $ngaycn);
                            while ($row2 = mysqli_fetch_assoc($table2)) {
                                echo "<table  style='border : 1px solid black; background: #ADD8E6; margin: 10px -25px 10px 20px;'> <tr> <td>";
                                echo "<b style='font-size: 15px;'>";
                                echo $row2["TenLop"];
                                echo "</b>";
                                if ($row2["TrangThaiBuoiHoc"] == 0) {
                                    echo "<br>";
                                    echo "(Đang lên kế hoạch)";
                                }
                                echo "<p style='font-size: 13px; color:black;'>Tiết học: ";
                                echo $row2["Tiet"] . "</p>";
                                echo "<p style='font-size: 13px; color: black; margin: -10px 5px -10px 5px;'>ID lớp: ";
                                echo $row2["Id"] . "</p>";
                                echo "<p style='font-size: 13px; color:black;'>Password: ";
                                echo $row2["Pass"] . "</p>";
                                echo "<p style='font-size: 13px; color:black;'>Ghi chú: ";
                                echo $row2["GhiChu"] . "</p>";
                                echo "</td> </tr> </table>";
                            }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td style="background-color: rgb(255, 241, 153);">Tối</td>
                        <td id="thu2toi">
                            <?php
                            $table2 = $p->laylichchoGV3($ma, $ngay2);
                            while ($row2 = mysqli_fetch_assoc($table2)) {
                                echo "<table  style='border : 1px solid black; background: #ADD8E6; margin: 10px -25px 10px 20px;'> <tr> <td>";
                                echo "<b style='font-size: 15px;'>";
                                echo $row2["TenLop"];
                                echo "</b>";
                                if ($row2["TrangThaiBuoiHoc"] == 0) {
                                    echo "<br>";
                                    echo "(Đang lên kế hoạch)";
                                }
                                echo "<p style='font-size: 13px; color:black;'>Tiết học: ";
                                echo $row2["Tiet"] . "</p>";
                                echo "<p style='font-size: 13px; color: black; margin: -10px 5px -10px 5px;'>ID lớp: ";
                                echo $row2["Id"] . "</p>";
                                echo "<p style='font-size: 13px; color:black;'>Password: ";
                                echo $row2["Pass"] . "</p>";
                                echo "<p style='font-size: 13px; color:black;'>Ghi chú: ";
                                echo $row2["GhiChu"] . "</p>";
                                echo "</td> </tr> </table>";
                            }
                            ?>
                        </td>
                        <td id="thu3toi">
                            <?php
                            $table2 = $p->laylichchoGV3($ma, $ngay3);
                            while ($row2 = mysqli_fetch_assoc($table2)) {
                                echo "<table  style='border : 1px solid black; background: #ADD8E6; margin: 10px -25px 10px 20px;'> <tr> <td>";
                                echo "<b style='font-size: 15px;'>";
                                echo $row2["TenLop"];
                                echo "</b>";
                                if ($row2["TrangThaiBuoiHoc"] == 0) {
                                    echo "<br>";
                                    echo "(Đang lên kế hoạch)";
                                }
                                echo "<p style='font-size: 13px; color:black;'>Tiết học: ";
                                echo $row2["Tiet"] . "</p>";
                                echo "<p style='font-size: 13px; color: black; margin: -10px 5px -10px 5px;'>ID lớp: ";
                                echo $row2["Id"] . "</p>";
                                echo "<p style='font-size: 13px; color:black;'>Password: ";
                                echo $row2["Pass"] . "</p>";
                                echo "<p style='font-size: 13px; color:black;'>Ghi chú: ";
                                echo $row2["GhiChu"] . "</p>";
                                echo "</td> </tr> </table>";
                            }
                            ?>
                        </td>
                        <td id="thu4toi">
                            <?php
                            $table2 = $p->laylichchoGV3($ma, $ngay4);
                            while ($row2 = mysqli_fetch_assoc($table2)) {
                                echo "<table  style='border : 1px solid black; background: #ADD8E6; margin: 10px -25px 10px 20px;'> <tr> <td>";
                                echo "<b style='font-size: 15px;'>";
                                echo $row2["TenLop"];
                                echo "</b>";
                                if ($row2["TrangThaiBuoiHoc"] == 0) {
                                    echo "<br>";
                                    echo "(Đang lên kế hoạch)";
                                }
                                echo "<p style='font-size: 13px; color:black;'>Tiết học: ";
                                echo $row2["Tiet"] . "</p>";
                                echo "<p style='font-size: 13px; color: black; margin: -10px 5px -10px 5px;'>ID lớp: ";
                                echo $row2["Id"] . "</p>";
                                echo "<p style='font-size: 13px; color:black;'>Password: ";
                                echo $row2["Pass"] . "</p>";
                                echo "<p style='font-size: 13px; color:black;'>Ghi chú: ";
                                echo $row2["GhiChu"] . "</p>";
                                echo "</td> </tr> </table>";
                            }
                            ?>
                        </td>
                        <td id="thu5toi">
                            <?php
                            $table2 = $p->laylichchoGV3($ma, $ngay5);
                            while ($row2 = mysqli_fetch_assoc($table2)) {
                                echo "<table  style='border : 1px solid black; background: #ADD8E6; margin: 10px -25px 10px 20px;'> <tr> <td>";
                                echo "<b style='font-size: 15px;'>";
                                echo $row2["TenLop"];
                                echo "</b>";
                                if ($row2["TrangThaiBuoiHoc"] == 0) {
                                    echo "<br>";
                                    echo "(Đang lên kế hoạch)";
                                }
                                echo "<p style='font-size: 13px; color:black;'>Tiết học: ";
                                echo $row2["Tiet"] . "</p>";
                                echo "<p style='font-size: 13px; color: black; margin: -10px 5px -10px 5px;'>ID lớp: ";
                                echo $row2["Id"] . "</p>";
                                echo "<p style='font-size: 13px; color:black;'>Password: ";
                                echo $row2["Pass"] . "</p>";
                                echo "<p style='font-size: 13px; color:black;'>Ghi chú: ";
                                echo $row2["GhiChu"] . "</p>";
                                echo "</td> </tr> </table>";
                            }
                            ?>
                        </td>
                        <td id="thu6toi">
                            <?php
                            $table2 = $p->laylichchoGV3($ma, $ngay6);
                            while ($row2 = mysqli_fetch_assoc($table2)) {
                                echo "<table  style='border : 1px solid black; background: #ADD8E6; margin: 10px -25px 10px 20px;'> <tr> <td>";
                                echo "<b style='font-size: 15px;'>";
                                echo $row2["TenLop"];
                                echo "</b>";
                                if ($row2["TrangThaiBuoiHoc"] == 0) {
                                    echo "<br>";
                                    echo "(Đang lên kế hoạch)";
                                }
                                echo "<p style='font-size: 13px; color:black;'>Tiết học: ";
                                echo $row2["Tiet"] . "</p>";
                                echo "<p style='font-size: 13px; color: black; margin: -10px 5px -10px 5px;'>ID lớp: ";
                                echo $row2["Id"] . "</p>";
                                echo "<p style='font-size: 13px; color:black;'>Password: ";
                                echo $row2["Pass"] . "</p>";
                                echo "<p style='font-size: 13px; color:black;'>Ghi chú: ";
                                echo $row2["GhiChu"] . "</p>";
                                echo "</td> </tr> </table>";
                            }
                            ?>
                        </td>
                        <td id="thu7toi">
                            <?php
                            $table2 = $p->laylichchoGV3($ma, $ngay7);
                            while ($row2 = mysqli_fetch_assoc($table2)) {
                                echo "<table  style='border : 1px solid black; background: #ADD8E6; margin: 10px -25px 10px 20px;'> <tr> <td>";
                                echo "<b style='font-size: 15px;'>";
                                echo $row2["TenLop"];
                                echo "</b>";
                                if ($row2["TrangThaiBuoiHoc"] == 0) {
                                    echo "<br>";
                                    echo "(Đang lên kế hoạch)";
                                }
                                echo "<p style='font-size: 13px; color:black;'>Tiết học: ";
                                echo $row2["Tiet"] . "</p>";
                                echo "<p style='font-size: 13px; color: black; margin: -10px 5px -10px 5px;'>ID lớp: ";
                                echo $row2["Id"] . "</p>";
                                echo "<p style='font-size: 13px; color:black;'>Password: ";
                                echo $row2["Pass"] . "</p>";
                                echo "<p style='font-size: 13px; color:black;'>Ghi chú: ";
                                echo $row2["GhiChu"] . "</p>";
                                echo "</td> </tr> </table>";
                            }
                            ?>
                        </td>
                        <td id="thucntoi">
                            <?php
                            $table2 = $p->laylichchoGV3($ma, $ngaycn);
                            while ($row2 = mysqli_fetch_assoc($table2)) {
                                echo "<table  style='border : 1px solid black; background: #ADD8E6; margin: 10px -25px 10px 20px;'> <tr> <td>";
                                echo "<b style='font-size: 15px;'>";
                                echo $row2["TenLop"];
                                echo "</b>";
                                if ($row2["TrangThaiBuoiHoc"] == 0) {
                                    echo "<br>";
                                    echo "(Đang lên kế hoạch)";
                                }
                                echo "<p style='font-size: 13px; color:black;'>Tiết học: ";
                                echo $row2["Tiet"] . "</p>";
                                echo "<p style='font-size: 13px; color: black; margin: -10px 5px -10px 5px;'>ID lớp: ";
                                echo $row2["Id"] . "</p>";
                                echo "<p style='font-size: 13px; color:black;'>Password: ";
                                echo $row2["Pass"] . "</p>";
                                echo "<p style='font-size: 13px; color:black;'>Ghi chú: ";
                                echo $row2["GhiChu"] . "</p>";
                                echo "</td> </tr> </table>";
                            }
                            ?>
                        </td>
                    </tr>
                </table>
                <?php
    } else {
        echo "0 result";
    }
} else {
    echo "Erro";
}
?>

        <body>
            </table>

    </div>
</div>
</body>

</html>