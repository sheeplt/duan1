<!DOCTYPE html>
<html lang="en">

<head>
    <title>Nhóm 14</title>
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css" integrity="sha512-q3eWabyZPc1XTCmF+8/LuE1ozpg5xxn7iO89yfSOd5/oKvyqLngoNGsx8jq92Y8eXJ/IRxQbEC+FGSYxtk2oiw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="chat_app_php-main/assets/style.css">

    <!-- Css nhẹ -->
    <style>
        .dangnhap :hover {
            color: green
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
                center: new google.maps.LatLng(10.821974, 106.687022),
                //set default zoom cua ban do khi duoc load
                zoom: 15,
                //Dinh nghia type
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };
            //Truyen tham so cho cac thuoc tinh Map cho the div chua Map
            var map = new google.maps.Map(document.getElementById("googleMap"), mapProp);
            var marker = new google.maps.Marker({
                position: new google.maps.LatLng(10.821974, 106.687022),
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
                        <a href="index.php">
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
                                <a href="index.php"><img src="view/images/home.png" style="width:25px;  margin-bottom: 5px;">
                                    Trang chủ
                                </a>
                            </li>
                            <li class="main_nav_item">
                                <a href="index.php?page=khoahoc"><img src="view/images/khoahoc.png" style="width:25px; margin-bottom: 5px;">
                                    Khóa học
                                </a>
                            </li>
                            <!-- <li class="main_nav_item"><a href="index.php?page=tintuc"><img src="view/images/tintuc.png" style="width:25px; margin-bottom: 5px;"> Tin tức</a></li> -->
                            <!-- <li class="main_nav_item"><a href="#">Hỗ trợ</a></li> -->
                            <!-- <li class="main_nav_item"><a href="index.php?page=lienhe"><img src="view/images/lienhe.png" style="width:25px; margin-bottom: 5px;"> Liên hệ</a></li> -->

                            <li class="main_nav_item">
                                <div class="qoute">
                                    <a href="index.php?hoivadap"><img src="view/images/chat.png" style="width:25px; margin-bottom: 5px;">
                                        Tư vấn
                                    </a>
                                </div>
                            </li>

                            <!-- <li class="main_nav_item"><a href="elements.html">elements</a></li> -->
                        </ul>
                    </div>
                </nav>
            </div>
            <div class="header_side d-flex flex-row justify-content-center align-items-center">
                <button style="border: none; background-color:#ffb606;">
                    <a class="dangnhap" style="color: black;" href="dang_nhap.php">
                        <img src="view/images/icons8-enter-100.png" alt="">
                        &ensp;
                        <strong>ĐĂNG NHẬP</strong>
                    </a>
                </button>
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
                        <li class="menu_item menu_mm"><a href="index.php">Trang chủ</a></li>
                        <li class="menu_item menu_mm"><a href="index.php?page=khoahoc">Khóa học</a></li>
                        <!-- <li class="menu_item menu_mm"><a href="index.php?page=tintuc">Tin tức</a></li> -->
                        <li class="menu_item menu_mm"><a href="index.php?hoivadap">Tư vấn</a></li>
                        <!-- <li class="menu_item menu_mm"><a href="index.php?page=lienhe">Liên hệ</a></li> -->
                        <li class="menu_item menu_mm"><a href="dang_nhap.php">Đăng Nhập</a></li>

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
        <!-- Home -->

        <div class="home">

            <!-- Hero Slider -->
            <div class="hero_slider_container">
                <div class="hero_slider owl-carousel">

                    <!-- Hero Slide -->
                    <div class="hero_slide">
                        <div class="hero_slide_background"
                            style="background-image:url(view/images/slider_background.jpg)"></div>
                        <div class="hero_slide_container d-flex flex-column align-items-center justify-content-center">
                            <div class="hero_slide_content text-center">
                                <h1 data-animation-in="fadeInUp" data-animation-out="animate-out fadeOut"><span>Tri
                                        thức</span> là sức mạnh !</h1>
                            </div>
                        </div>
                    </div>

                    <!-- Hero Slide -->
                    <div class="hero_slide">
                        <div class="hero_slide_background"
                            style="background-image:url(view/images/slider_background.jpg)"></div>
                        <div class="hero_slide_container d-flex flex-column align-items-center justify-content-center">
                            <div class="hero_slide_content text-center">
                                <h1 data-animation-in="fadeInUp" data-animation-out="animate-out fadeOut"><span>Tri
                                        thức</span> ở đâu chúng tôi vươn cao tới đó !</h1>
                            </div>
                        </div>
                    </div>

                    <!-- Hero Slide -->
                    <div class="hero_slide">
                        <div class="hero_slide_background"
                            style="background-image:url(view/images/slider_background.jpg)"></div>
                        <div class="hero_slide_container d-flex flex-column align-items-center justify-content-center">
                            <div class="hero_slide_content text-center">
                                <h1 data-animation-in="fadeInUp" data-animation-out="animate-out fadeOut">Tất cả là vì
                                    <span>Học sinh</span> thân yêu !
                                </h1>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="hero_slider_left hero_slider_nav trans_200"><span class="trans_200"> &#60; </span></div>
                <div class="hero_slider_right hero_slider_nav trans_200"><span class="trans_200"> &#62; </span></div>
            </div>

        </div>

        <div class="hero_boxes">
            <div class="hero_boxes_inner">
                <div class="container">
                    <div class="row">

                        <div class="col-lg-4 hero_box_col">
                            <div class="hero_box d-flex flex-row align-items-center justify-content-start">
                                <img src="view/images/earth-globe.svg" class="svg" alt="">
                                <div class="hero_box_content">
                                    <h2 class="hero_box_title">Khóa học trực tuyến</h2>
                                    <a href="#" class="hero_box_link">Xem thêm</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 hero_box_col">
                            <div class="hero_box d-flex flex-row align-items-center justify-content-start">
                                <img src="view/images/books.svg" class="svg" alt="">
                                <div class="hero_box_content">
                                    <h2 class="hero_box_title">Thư viện trực tuyến</h2>
                                    <a href="#" class="hero_box_link">Xem thêm</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 hero_box_col">
                            <div class="hero_box d-flex flex-row align-items-center justify-content-start">
                                <img src="view/images/professor.svg" class="svg" alt="">
                                <div class="hero_box_content">
                                    <h2 class="hero_box_title">Đội ngũ giảng viên</h2>
                                    <a href="#" class="hero_box_link">Xem thêm</a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>