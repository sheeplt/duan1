<!DOCTYPE html>
<html lang="en">

<head>
    <title>Giáo viên</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Course Project">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="view/styles/bootstrap4/bootstrap.min.css">
    <link href="view/plugins/fontawesome-free-5.0.1/css/fontawesome-all.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="view/plugins/OwlCarousel2-2.2.1/owl.carousel.css">
    <link rel="stylesheet" type="text/css" href="view/plugins/OwlCarousel2-2.2.1/owl.theme.default.css">
    <link rel="stylesheet" type="text/css" href="view/plugins/OwlCarousel2-2.2.1/animate.css">
    <link rel="stylesheet" type="text/css" href="view/styles/mainstyles.css">
    <link rel="stylesheet" type="text/css" href="view/styles/responsive.css">

    <link rel="stylesheet" type="text/css" href="view/styles/index.css">
    <link rel="stylesheet" type="text/css" href="view/styles/Man_hinh_nho.css">
    <link rel="stylesheet" type="text/css" href="icon/themify-icons-font/themify-icons/themify-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css" integrity="sha512-q3eWabyZPc1XTCmF+8/LuE1ozpg5xxn7iO89yfSOd5/oKvyqLngoNGsx8jq92Y8eXJ/IRxQbEC+FGSYxtk2oiw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="chat_GV/assets/style_GV.css">

    <!-- Css nhẹ -->
    <style>
        .dangxuat {
            color:black;
            border: none; 
            background-color:#ffb606;
        }
        .dangxuat:hover {
            color: red;
        }
    </style>
    <!-- Add Google API Key -->
    <script src="http://maps.googleapis.com/maps/api/js?AIzaSyD-t4MjzyKVHTS9DgsFOTlkL0k0Y_sq3J4&sensor=false"></script>
        <script>
          //Khoi tao Map
          function initialize() {
            //Khai bao cac thuoc tinh
            var mapProp = {
              //Tam ban do, quy dinh boi kinh do va vi do
              center:new google.maps.LatLng(10.821974, 106.687022),
              //set default zoom cua ban do khi duoc load
              zoom:15,
              //Dinh nghia type
              mapTypeId:google.maps.MapTypeId.ROADMAP
            };
            //Truyen tham so cho cac thuoc tinh Map cho the div chua Map
            var map=new google.maps.Map(document.getElementById("googleMap"), mapProp);
            var marker=new google.maps.Marker({
            position:new google.maps.LatLng(10.821974, 106.687022),
            });
          marker.setMap(map);
          }
          google.maps.event.addDomListener(window, 'load', initialize);
        </script>

</head>

<body>

    <div class="super_container">

        <!-- Header -->

        <header class="header d-flex flex-row">
            <div class="header_content d-flex flex-row align-items-center">
                <!-- Logo -->
                <div class="logo_container">
                    <div class="logo">
                        <a href="GV.php">
                            <img src="view/images/logo.png" alt="VICTORY">
                            <span>VICTORIA</span>
                        </a>
                    </div>
                </div>

                <!-- Main Navigation -->
                <!-- Menu Web -->
                <nav class="main_nav_container">
                    <div class="main_nav">
                        <ul class="main_nav_list">
                            <li class="main_nav_item">
                                <a href="GV.php">
                                    <img src="view/images/home.png" style="width:25px;  margin-bottom: 5px;">
                                </a>
                            </li>
                            <li class="main_nav_item">
                                <a href="GV.php?dslich">
                                    <img src="view/images/xemlich.png" style="width:25px; margin-bottom: 5px;">
                                    Xem lịch dạy
                                </a>
                            </li>
                            <li class="main_nav_item">
                                <a href="GV.php?dslop">
                                    <img src="view/images/khoahoc.png" style="width:25px; margin-bottom: 5px;">
                                    Quản lí lớp
                                </a>
                            </li>
                            <!-- chat bot -->
                            <li class="main_nav_item">
                                <div class="qoute">
                                    <a href="GV.php?hoivadap"><img src="view/images/chat.png"
                                            style="width:25px; margin-bottom: 5px;"> Hỏi & Đáp</a>
                                </div>
                            </li>
                            <li class="main_nav_item">
                                <a href="GV.php?ttcn">
                                    <img src="view/images/ttcn.png" style="width:25px; margin-bottom: 5px;">
                                    <!-- <i class="fa fa-caret-down"></i> -->
                                </a>
                            </li>

                            <!-- <li class="main_nav_item"><a href="elements.html">elements</a></li> -->
                        </ul>
                    </div>
                </nav>
            </div>
            <div class="header_side d-flex flex-row justify-content-center align-items-center">
                <a class="dangxuat" href="GV.php?dangxuat" onclick="return confirm('Đăng xuất ?');">
                    <strong>ĐĂNG XUẤT</strong>
                    &ensp;
                    <img src="view/images/icons8-enter-100.png" alt="">
                </a>
            </div>

            <!-- Hamburger -->
            <!-- Buttun menu moibile -->
            <div class="hamburger_container">
                <i class="fas fa-bars trans_200"></i>
            </div>

        </header>

        <!-- Menu mobile -->
        <div class="menu_container menu_mm">

            <!-- Menu Close Button -->
            <div class="menu_close_container">
                <div class="menu_close"></div>
            </div>

            <!-- Menu Items -->
            <div class="menu_inner menu_mm">
                <div class="menu menu_mm">
                    <ul class="menu_list menu_mm">
                        <li class="menu_item menu_mm"><a href="GV.php">Trang chủ</a></li>
                        <li class="menu_item menu_mm"><a href="GV.php?page=ttcn">Xem thông tin cá nhân</a></li>
                        <li class="menu_item menu_mm"><a href="GV.php?page=dslich">Xem lịch dạy</a></li>
                        <li class="menu_item menu_mm"><a href="GV.php?page=dslop">Quản lí lớp</a></li>
                        <li class="menu_item menu_mm"><a href="GV.php?hoivadap">Hỏi & Đáp</a></li>
                        <li class="menu_item menu_mm"><a href="GV.php?dangxuat">Đăng xuất</a></li>

                        <!-- <li class="menu_item menu_mm"><a href="elements.html">Elements</a></li> -->
                    </ul>

                    <!-- Menu Social -->

                    <div class="menu_social_container menu_mm">
                        <ul class="menu_social menu_mm">
                            <li class="menu_social_item menu_mm"><a href="#"><i class="fab fa-pinterest"></i></a></li>
                            <li class="menu_social_item menu_mm"><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                            <li class="menu_social_item menu_mm"><a href="#"><i class="fab fa-instagram"></i></a></li>
                            <li class="menu_social_item menu_mm"><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                            <li class="menu_social_item menu_mm"><a href="#"><i class="fab fa-twitter"></i></a></li>
                        </ul>
                    </div>

                    <div class="menu_copyright menu_mm">Khóa luận tốt nghiệp | GVHD: Phan Thị Bảo Trân <i
                            class="fa fa-heart" aria-hidden="true"></i> Nhóm 14</div>
                </div>

            </div>

        </div>
        <br><br><br>