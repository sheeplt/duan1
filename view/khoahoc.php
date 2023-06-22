    <!-- Popular -->

	<div class="popular page_section">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="section_title text-center">
						<h1>Các khóa học của VICTORIA</h1>
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
				<!-- Popular Course Item -->
				<!-- <div class="col-lg-4 course_box">
					<div class="card">
						<img class="card-img-top" src="view/images/anh-vat_li.jpg" alt="">
						<div class="card-body text-center">
							<div class="card-title"><a href="courses.html">Vật lí 12</a></div>
							<div class="card-text">Adobe Guide, Layes, Smart Objects etc...</div>
						</div>
						<div class="price_box d-flex flex-row align-items-center">
							<div class="course_author_image">
								<img src="view/images/author.jpg" alt="">
							</div>
							<div class="course_author_name">Michael Smith, <span>Author</span></div>
							<div class="course_price d-flex flex-column align-items-center justify-content-center"><span>$29</span></div>
						</div>
					</div>
				</div>

				
				<div class="col-lg-4 course_box">
					<div class="card">
						<img class="card-img-top" src="view/images/anh-hoa_hoc.png" alt="">
						<div class="card-body text-center">
							<div class="card-title"><a href="courses.html">Hóa học 12</a></div>
							<div class="card-text">Adobe Guide, Layes, Smart Objects etc...</div>
						</div>
						<div class="price_box d-flex flex-row align-items-center">
							<div class="course_author_image">
								<img src="view/images/author.jpg" alt="https://unsplash.com/@mehdizadeh">
							</div>
							<div class="course_author_name">Michael Smith, <span>Author</span></div>
							<div class="course_price d-flex flex-column align-items-center justify-content-center"><span>$29</span></div>
						</div>
					</div>
				</div>

				Popular Course Item
				<div class="col-lg-4 course_box">
					<div class="card">
						<img class="card-img-top" src="view/images/anh-sinh.jpg" alt="">
						<div class="card-body text-center">
							<div class="card-title"><a href="courses.html">Sinh học 12</a></div>
							<div class="card-text">Adobe Guide, Layes, Smart Objects etc...</div>
						</div>
						<div class="price_box d-flex flex-row align-items-center">
							<div class="course_author_image">
								<img src="view/images/author.jpg" alt="https://unsplash.com/@mehdizadeh">
							</div>
							<div class="course_author_name">Michael Smith, <span>Author</span></div>
							<div class="course_price d-flex flex-column align-items-center justify-content-center"><span>$29</span></div>
						</div>
					</div>
				</div>

				Popular Course Item
				<div class="col-lg-4 course_box">
					<div class="card">
						<img class="card-img-top" src="view/images/anh-lichsu.jpg" alt="">
						<div class="card-body text-center">
							<div class="card-title"><a href="courses.html">Lịch sử 12</a></div>
							<div class="card-text">Adobe Guide, Layes, Smart Objects etc...</div>
						</div>
						<div class="price_box d-flex flex-row align-items-center">
							<div class="course_author_image">
								<img src="view/images/author.jpg" alt="https://unsplash.com/@mehdizadeh">
							</div>
							<div class="course_author_name">Michael Smith, <span>Author</span></div>
							<div class="course_price d-flex flex-column align-items-center justify-content-center"><span>$29</span></div>
						</div>
					</div>
				</div>

				Popular Course Item
				<div class="col-lg-4 course_box">
					<div class="card">
						<img class="card-img-top" src="view/images/anh-diali.jpg" alt="">
						<div class="card-body text-center">
							<div class="card-title"><a href="courses.html">Địa lí 12</a></div>
							<div class="card-text">Adobe Guide, Layes, Smart Objects etc...</div>
						</div>
						<div class="price_box d-flex flex-row align-items-center">
							<div class="course_author_image">
								<img src="view/images/author.jpg" alt="https://unsplash.com/@mehdizadeh">
							</div>
							<div class="course_author_name">Michael Smith, <span>Author</span></div>
							<div class="course_price d-flex flex-column align-items-center justify-content-center"><span>$29</span></div>
						</div>
					</div>
				</div>

				Popular Course Item
				<div class="col-lg-4 course_box">
					<div class="card">
						<img class="card-img-top" src="view/images/anh-anh.png" alt="">
						<div class="card-body text-center">
							<div class="card-title"><a href="courses.html">Tiếng anh 12</a></div>
							<div class="card-text">Adobe Guide, Layes, Smart Objects etc...</div>
						</div>
						<div class="price_box d-flex flex-row align-items-center">
							<div class="course_author_image">
								<img src="view/images/author.jpg" alt="https://unsplash.com/@mehdizadeh">
							</div>
							<div class="course_author_name">Michael Smith, <span>Author</span></div>
							<div class="course_price d-flex flex-column align-items-center justify-content-center"><span>$29</span></div>
						</div>
					</div>
				</div>

				Popular Course Item
				<div class="col-lg-4 course_box">
					<div class="card">
						<img class="card-img-top" src="view/images/anh-van.jpg" alt="">
						<div class="card-body text-center">
							<div class="card-title"><a href="courses.html">Ngữ văn 12</a></div>
							<div class="card-text">Adobe Guide, Layes, Smart Objects etc...</div>
						</div>
						<div class="price_box d-flex flex-row align-items-center">
							<div class="course_author_image">
								<img src="view/images/author.jpg" alt="https://unsplash.com/@mehdizadeh">
							</div>
							<div class="course_author_name">Michael Smith, <span>Author</span></div>
							<div class="course_price d-flex flex-column align-items-center justify-content-center"><span>$29</span></div>
						</div>
					</div>
				</div>

				Popular Course Item
				<div class="col-lg-4 course_box">
					<div class="card">
						<img class="card-img-top" src="view/images/anh-gdcd.jpg" alt="https://unsplash.com/@kimberlyfarmer">
						<div class="card-body text-center">
							<div class="card-title"><a href="courses.html">Giáo dục công dân 12</a></div>
							<div class="card-text">Adobe Guide, Layes, Smart Objects etc...</div>
						</div>
						<div class="price_box d-flex flex-row align-items-center">
							<div class="course_author_image">
								<img src="view/images/author.jpg" alt="https://unsplash.com/@mehdizadeh">
							</div>
							<div class="course_author_name">Michael Smith, <span>Author</span></div>
							<div class="course_price d-flex flex-column align-items-center justify-content-center"><span>$29</span></div>
						</div>
					</div>
				</div> -->

			</div>
		</div>		
	</div>