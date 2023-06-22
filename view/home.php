<!-- Popular -->

<div class="popular page_section">
<div class="container">
    <div class="row">
        <div class="col">
            <div class="section_title text-center">
                <h1>Khóa học phổ biến</h1>
            </div>
        </div>
    </div>

    <div class="row course_boxes">
    <?php 
				include_once("controller/clophoc.php");
				$p = new controllophoc();
				$table = $p->chonlophocdangmo3();
				if ($table) {
					if (mysqli_num_rows($table) > 0) {
						while ($row = mysqli_fetch_assoc($table)) { 
				?>
        <!-- Popular Course Item -->
        <div class="col-lg-4 course_box">
					<div class="card">
						<img class="card-img-top" src="view/images/
						<?php 
						if($row["MaMonHoc"] == 1){
							echo "anh-toan.jpg";
						}elseif($row["MaMonHoc"] == 2){
							echo "anh-van.jpg";
						}elseif($row["MaMonHoc"] == 3){
							echo "anh-anh.png";
						}elseif($row["MaMonHoc"] == 6){
							echo "anh-vat_li.jpg";
						}elseif($row["MaMonHoc"] == 7){
							echo "anh-hoa_hoc.png";
						}elseif($row["MaMonHoc"] == 8){
							echo "anh-sinh.jpg";
						}
						?>
						" alt="">
						<div class=" text-center">
							<div class="card-title"><h3><?php echo $row["TenLop"]; ?></h3></div>
						</div>
						<div class=" text-center">
							<div>Ngày bắt đầu học: <?php echo date("d-m-Y",strtotime($row["NgayBD"])); ?></div>
						</div>
						<div class="price_box d-flex flex-row align-items-center">
							<div class="course_author_image">
								<img src="view/images/<?php echo $row["HinhAnh"]; ?>" style="width: 46px; height: 46px;" alt="">
							</div>
							<div class="course_author_name"><?php echo $row["TenGV"]; ?>, <span>Giáo viên</span></div>
							<div class="course_price d-flex flex-column align-items-center justify-content-center" ><span style="font-size: 8px;">
								<?php 
								if (strlen($row["HocPhi"]) == 6) {
									echo $row["HocPhi"][0], $row["HocPhi"][1], $row["HocPhi"][2];
									echo ".";
									echo $row["HocPhi"][3], $row["HocPhi"][4], $row["HocPhi"][5];
								} elseif (strlen($row["HocPhi"]) == 7) {
									echo $row["HocPhi"][0];
									echo ".";
									echo $row["HocPhi"][1], $row["HocPhi"][2], $row["HocPhi"][3];
									echo ".";
									echo $row["HocPhi"][4], $row["HocPhi"][5], $row["HocPhi"][6];
								} elseif (strlen($row["HocPhi"]) == 8) {
									echo $row["HocPhi"][0], $row["HocPhi"][1];
									echo ".";
									echo $row["HocPhi"][2], $row["HocPhi"][3], $row["HocPhi"][4];
									echo ".";
									echo $row["HocPhi"][5], $row["HocPhi"][6], $row["HocPhi"][7];
								}
								?> VND
							</span></div>
						</div>
					</div>
				</div>
                <?php 
						}
					}
				}
				?>
    </div>
</div>		
</div>

<!-- Register -->

<div class="register">

<div class="container-fluid">
    
    <div class="row row-eq-height">
        <div class="col-lg-6 nopadding">
            
            <!-- Register -->

            <div class="register_section d-flex flex-column align-items-center justify-content-center">
                <div class="register_content text-center">
                    <h1 class="register_title">Đăng ký ngay bây giờ và được giảm giá <span>50%</span>tất cả các khóa học cho đến ngày 15 tháng 5 năm 2023</h1>
                    <!-- <p class="register_text"></p> -->
                    <div class="button button_1 register_button mx-auto trans_200"><a href="#">Đăng kí ngay bây giờ !!!</a></div>
                </div>
            </div>

        </div>

        <div class="col-lg-6 nopadding">
            
            <!-- Search -->

            <div class="search_section d-flex flex-column align-items-center justify-content-center">
                <div class="search_background" style="background-image:url(view/images/search_background.jpg);"></div>
                <div class="search_content text-center">
                    <h1 class="search_title">Tìm kiếm khóa học của bạn</h1>
                    <form id="search_form" class="search_form" action="post">
                        <input id="search_form_name" class="input_field search_form_name" type="text" placeholder="Tên khóa học" required="required" data-error="Course name is required.">
                        <input id="search_form_category" class="input_field search_form_category" type="text" placeholder="Môn học">
                        <input id="search_form_degree" class="input_field search_form_degree" type="text" placeholder="Giảng viên">
                        <button id="search_submit_button" type="submit" class="search_submit_button trans_200" value="Submit">Tìm kiếm khóa học</button>
                    </form>
                </div> 
            </div>

        </div>
    </div>
</div>
</div>

<!-- Services -->

<div class="services page_section">

<div class="container">
    <div class="row">
        <div class="col">
            <div class="section_title text-center">
                <h1>Dịch vụ nổi bật của VICTORIA</h1>
            </div>
        </div>
    </div>

    <div class="row services_row">

        <div class="col-lg-4 service_item text-left d-flex flex-column align-items-start justify-content-start">
            <div class="icon_container d-flex flex-column justify-content-end">
                <img src="view/images/earth-globe.svg" alt="">
            </div>
            <h3>Các khóa học trực tuyến</h3>
            <p>Nội dung</p>
        </div>

        <div class="col-lg-4 service_item text-left d-flex flex-column align-items-start justify-content-start">
            <div class="icon_container d-flex flex-column justify-content-end">
                <img src="view/images/exam.svg" alt="">
            </div>
            <h3>Bài kiểm tra, thi thử sát với đề nhất</h3>
            <p>Nội dung</p>
        </div>

        <div class="col-lg-4 service_item text-left d-flex flex-column align-items-start justify-content-start">
            <div class="icon_container d-flex flex-column justify-content-end">
                <img src="view/images/books.svg" alt="">
            </div>
            <h3>Thư viện online tuyệt vời</h3>
            <p>Nội dung</p>
        </div>

        <div class="col-lg-4 service_item text-left d-flex flex-column align-items-start justify-content-start">
            <div class="icon_container d-flex flex-column justify-content-end">
                <img src="view/images/professor.svg" alt="">
            </div>
            <h3>Giáo viên xuất sắc</h3>
            <p>Nội dung</p>
        </div>

        <div class="col-lg-4 service_item text-left d-flex flex-column align-items-start justify-content-start">
            <div class="icon_container d-flex flex-column justify-content-end">
                <img src="view/images/blackboard.svg" alt="">
            </div>
            <h3>Chương trình giảng dạy hàng đầu</h3>
            <p>Nội dung</p>
        </div>

        <div class="col-lg-4 service_item text-left d-flex flex-column align-items-start justify-content-start">
            <div class="icon_container d-flex flex-column justify-content-end">
                <img src="view/images/mortarboard.svg" alt="">
            </div>
            <h3>Bằng tốt nghiệp</h3>
            <p>Nội dung</p>
        </div>

    </div>
</div>
</div>

<!-- Testimonials -->

<div class="testimonials page_section">
<!-- <div class="testimonials_background" style="background-image:url(view/images/testimonials_background.jpg)"></div> -->
<div class="testimonials_background_container prlx_parent">
    <div class="testimonials_background prlx" style="width: 100%; height: 100%; background-image:url(view/images/hoc_sinh_noi_gi_ve_victory.jpg)"></div>
</div>
<div class="container">

    <div class="row">
        <div class="col">
            <div class="section_title text-center">
                <h1>Học sinh nói gì về VICTORIA</h1>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-10 offset-lg-1">
            
            <div class="testimonials_slider_container">

                <!-- Testimonials Slider -->
                <div class="owl-carousel owl-theme testimonials_slider">
                    
                    <!-- Testimonials Item -->
                    <div class="owl-item">
                        <div class="testimonials_item text-center">
                            <div class="quote">“</div>
                            <p class="testimonials_text">Nội dung</p>
                            <div class="testimonial_user">
                                <div class="testimonial_image mx-auto">
                                    <img src="view/images/avatar5.png" alt="">
                                </div>
                                <div class="testimonial_name">Nguyễn Văn A</div>
                                <div class="testimonial_title">Học sinh</div>
                            </div>
                        </div>
                    </div>

                    <!-- Testimonials Item -->
                    <div class="owl-item">
                        <div class="testimonials_item text-center">
                            <div class="quote">“</div>
                            <p class="testimonials_text">Nội dung</p>
                            <div class="testimonial_user">
                                <div class="testimonial_image mx-auto">
                                    <img src="view/images/avatar5.png" alt="">
                                </div>
                                <div class="testimonial_name">Lê Văn B</div>
                                <div class="testimonial_title">Học sinh đã học</div>
                            </div>
                        </div>
                    </div>

                    <!-- Testimonials Item -->
                    <div class="owl-item">
                        <div class="testimonials_item text-center">
                            <div class="quote">“</div>
                            <p class="testimonials_text">Nội dung</p>
                            <div class="testimonial_user">
                                <div class="testimonial_image mx-auto">
                                    <img src="view/images/avatar5.png" alt="">
                                </div>
                                <div class="testimonial_name">Trần Thị C</div>
                                <div class="testimonial_title">Học sinh</div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>

</div>
</div>

<!-- Events -->

<div class="events page_section">
<div class="container">
    
    <div class="row">
        <div class="col">
            <div class="section_title text-center">
                <h1>Các sự kiện sắp tới của VICTORIA</h1>
            </div>
        </div>
    </div>
    
    <div class="event_items">

        <!-- Event Item -->
        <div class="row event_item">
            <div class="col">
                <div class="row d-flex flex-row align-items-end">

                    <div class="col-lg-2 order-lg-1 order-2">
                        <div class="event_date d-flex flex-column align-items-center justify-content-center">
                            <div class="event_day">25</div>
                            <div class="event_month">Tháng 4</div>
                        </div>
                    </div>

                    <div class="col-lg-6 order-lg-2 order-3">
                        <div class="event_content">
                            <div class="event_name"><a class="trans_200" href="#">Lễ hội học sinh</a></div>
                            <div class="event_location">Trung tâm VICTORIA</div>
                            <p>Nội dung</p>
                        </div>
                    </div>

                    <div class="col-lg-4 order-lg-3 order-1">
                        <div class="event_image">
                            <img src="view/images/event_1.jpg" alt="">
                        </div>
                    </div>

                </div>	
            </div>
        </div>

        <!-- Event Item -->
        <div class="row event_item">
            <div class="col">
                <div class="row d-flex flex-row align-items-end">

                    <div class="col-lg-2 order-lg-1 order-2">
                        <div class="event_date d-flex flex-column align-items-center justify-content-center">
                            <div class="event_day">15</div>
                            <div class="event_month">Tháng 5</div>
                        </div>
                    </div>

                    <div class="col-lg-6 order-lg-2 order-3">
                        <div class="event_content">
                            <div class="event_name"><a class="trans_200" href="#">Mở cửa thư viện mới của trung tâm VICTORY</a></div>
                            <div class="event_location">Trung tâm VICTORIA</div>
                            <p>Nội dung</p>
                        </div>
                    </div>

                    <div class="col-lg-4 order-lg-3 order-1">
                        <div class="event_image">
                            <img src="view/images/event_2.jpg" alt="">
                        </div>
                    </div>

                </div>	
            </div>
        </div>

        <!-- Event Item -->
        <div class="row event_item">
            <div class="col">
                <div class="row d-flex flex-row align-items-end">

                    <div class="col-lg-2 order-lg-1 order-2">
                        <div class="event_date d-flex flex-column align-items-center justify-content-center">
                            <div class="event_day">01</div>
                            <div class="event_month">Tháng 6</div>
                        </div>
                    </div>

                    <div class="col-lg-6 order-lg-2 order-3">
                        <div class="event_content">
                            <div class="event_name"><a class="trans_200" href="#">Kiểm tra và cập nhật chương trình giảng dạy mới</a></div>
                            <div class="event_location">Trung tâm VICTORIA</div>
                            <p>Nội dung</p>
                        </div>
                    </div>

                    <div class="col-lg-4 order-lg-3 order-1">
                        <div class="event_image">
                            <img src="view/images/event_3.jpg" alt="">
                        </div>
                    </div>

                </div>	
            </div>
        </div>

    </div>
        
</div>
</div>