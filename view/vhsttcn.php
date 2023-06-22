<?php
ob_start();

$tendn = $_SESSION["tendangnhap"];
include_once("controller/chocsinh.php");
$p = new controlhocsinh();
$table = $p->lay1hs($tendn);
$row = mysqli_fetch_assoc($table);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông tin cá nhân</title>
    <link rel="stylesheet" href="view/styles/ttcn.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
</head>

<body>
    <div class="popular page_section">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="section_title text-center">
                        <h1>THÔNG TIN CÁ NHÂN</h1>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="container">
                    <div class="row profile">
                        <div class="col-md-4">
                            <div class="profile-sidebar">
                                <div class="profile-userpic">
                                    <img src="view/images/<?php echo $row["HinhAnh"]; ?>" class="img-responsive"
                                        alt="Thông tin cá nhân">
                                </div>
                                <!-- <div class="profile-usertitle">                   
                        <div class="profile-usertitle-name">
                            HocwebGiare                 
                        </div>                  
                        <div class="profile-usertitle-job">
                            Web Developer                  
                        </div>              
                    </div>    
                    <br>                                            
                    <div class="profile-userbuttons">                 
                        <button type="button" class="btn btn-success btn-sm"><a href="index.php" style="color: #fff;">Trang chủ</a></button>                  
                        <button type="button" class="btn btn-danger btn-sm"><a href="GV.php" style="color: #fff;">Thoát ra</a></button>                
                    </div>  -->
                                <div class="profile-usermenu">
                                    <ul class="nav">
                                        <!-- <div class="logo_menuchinh" style="float:left; padding-top:5px; padding-left:10px; color:#fff; margin-left:auto; margin-right:auto; text-align:center; line-height:40px; font-size:16px;font-weight:bold;font-family:Arial">
                                Logo
                            </div>
                            <div class="menu-icon">
                                <span>Menu</span>
                            </div> -->
                                        <li class="active">
                                            <form action="#" method="POST">
                                                <button type="submit" name="btnsubmit"
                                                style="text-align: center; margin-left: 100px; border: none; background-color: white;">
                                                    <i class="glyphicon glyphicon-info-sign"></i>
                                                    Thay đổi mật khẩu
                                                </button>
                                            </form>
                                        </li>
                                        <?php
                                        if (isset($_REQUEST["btnsubmit"])) {
                                            echo header("refresh:0; url='HS.php?dmk'");
                                        }
                                        ?>
                                        <!-- <li>                           
                                <a href="#">                        
                                    <i class="glyphicon glyphicon-envelope"></i>                           
                                        Tin nhắn 
                                </a>                       
                            </li> -->
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="profile-content">
                                <?php
                                echo "<table style='width:100%; margin-top: 50px; font-size: 20px;' >";
                                echo "<tr>";
                                echo "<td>Tên học sinh: </td>";
                                echo "<td>";
                                echo $row["TenHS"];
                                echo "</td>";
                                echo "</tr>";
                                echo "<tr>";
                                echo "<td>Địa chỉ: </td>";
                                echo "<td>";
                                echo $row["DiaChi"];
                                echo "</td>";
                                echo "</tr>";
                                echo "<tr>";
                                echo "<td>Ngày sinh: </td>";
                                echo "<td>";
                                echo $row["NgaySinh"];
                                echo "</td>";
                                echo "</tr>";
                                echo "<tr>";
                                echo "<td>Giới tính: </td>";
                                echo "<td>";
                                echo $row["GioiTinh"];
                                echo "</td>";
                                echo "</tr>";
                                echo "<tr>";
                                echo "</tr>";
                                echo "<tr>";
                                echo "<td>Tên đăng nhập: </td>";
                                echo "<td>";
                                echo $row["TenDN"];
                                echo "</td>";
                                echo "</tr>";
                                echo "</table>";
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>