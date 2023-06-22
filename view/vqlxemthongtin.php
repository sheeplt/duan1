<?php 
ob_start();
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

<div class="container"> 
        <h1 class="text-center">THÔNG TIN CÁ NHÂN</h1> 
    <div class="container"> 
        <div class="row profile">        
            <div class="col-md-4">          
                <div class="profile-sidebar">                          
                    <div class="profile-userpic">                 
                        <img src="img/profile_user.jpg" class="img-responsive" alt="Thông tin cá nhân">               
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
                                    <button type="submit" name="btnsubmit">
                                    <i class="glyphicon glyphicon-info-sign"></i>
                                        Thay đổi mật khẩu 
                                    </button>
                                </form>         
                            </li>   
                            <?php
                            if(isset($_REQUEST["btnsubmit"])){
                                echo header ("refresh:0; url='QL.php?dmk'");
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
					$tendn = $_SESSION["tendangnhap"];
					include_once("controller/cquanli.php");
					$p = new controlquanli();
					$table = $p -> lay1quanli($tendn);
						if($table){
							if(mysqli_num_rows($table)>0){
								while($row=mysqli_fetch_assoc($table)){
								echo "<table style='width:95%; margin: 10px;' >";
								echo "<tr>";
								echo "<td>Tên quản lí: </td>";
								echo "<td>";echo $row["TenQL"];echo "</td>";
								echo "</tr>";
								echo "<tr>";
								echo "<td>Địa chỉ: </td>";
								echo "<td>";echo $row["DiaChi"];echo "</td>";
								echo "</tr>";
								echo "<tr>";
								echo "<td>Ngày sinh: </td>";
								echo "<td>";echo $row["NgaySinh"];echo "</td>";
								echo "</tr>";
								echo "<tr>";
								echo "<td>Giới tính: </td>";
								echo "<td>";echo $row["GioiTinh"];echo "</td>";
								echo "</tr>";
								echo "<tr>";
								echo "<td>Số điện thoại: </td>";
								echo "<td>";echo $row["SDT"];echo "</td>";
								echo "</tr>";
                                echo "<tr>";
								echo "<td>Email: </td>";
								echo "<td>";echo $row["Email"];echo "</td>";
								echo "</tr>";
								echo "<tr>";
								echo "<td>Tên đăng nhập: </td>";
								echo "<td>";echo $row["TenDN"];echo "</td>";
								echo "</tr>";
								}
								echo "</table>";
							}else{
								echo "0 result";
							}
						}else{
							echo "Erro";
						}
				?>
                </div>     
            </div>  
        </div>
    </div> 
    </div>

</body>
</html>