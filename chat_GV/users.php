<?php
  include_once "chat_GV/api/app/controller/AuthController.php";
  include_once "chat_GV/api/app/Config.php";
  include_once "chat_GV/api/app/controller/UserController.php";

  $auth = new AuthController();
  $auth->checkAuth();
  $user = new UserController();
  $row = $user->getUserByIdGV($_SESSION['tendangnhap']);
  $_SESSION["unique_id"] = $row["MaGV"];
?>
<body>
<div class="popular page_section">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="section_title text-center">
                            <h1 style="margin-bottom: 50px;"></h1>
                        </div>
                    </div>
                </div>
  <div class="wrapper">
    <section class="users">
      <header style="text-align: center;">
        <div class="content">
          <img src="view/images/<?php echo $row["HinhAnh"]; ?>" alt="">
          <div class="details">
            <span><?php echo $row["TenGV"]; ?></span>
            <p><?php 
            if($row['status'] == 1){
              echo "Đang hoạt động";
            }else{
              echo "Không hoạt động";
            }
            ?></p>
          </div>
        </div>
        
      </header>
      <div>
        <form action="" method="POST">
          <button style="min-width: 180px; padding: 14px 40px; border: none;" type="submit" name="hocsinh">Học sinh</button>
          <button style="min-width: 180px; padding: 14px 40px; border: none;" type="submit" name="giaovu">Giáo vụ</button>
        </form>
        <?php
        if(isset($_REQUEST["hocsinh"])){
          $_SESSION["nguoidungOut"] = "hocsinh";
        }elseif(isset($_REQUEST["giaovu"])){
          $_SESSION["nguoidungOut"] = "giaovu";
        }else{
          $_SESSION["nguoidungOut"] = "hocsinh";
        }
        ?>
      </div>
      <div class="search">
        <span class="text">Lựa chọn cuộc trò chuyện</span>
        <input class="" type="text" name="search" id="" placeholder="Nhập tên để tìm kiếm">
        <button class=""><i class="fas fa-search"></i></button>
      </div>
      <div class="users-list">
      </div>
    </section>
  </div>

  <script src="chat_GV/assets/users-event.js"></script>
            </div></div>
</body>
</html>