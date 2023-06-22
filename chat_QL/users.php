<?php
include_once "chat_QL/api/app/controller/AuthController.php";
include_once "chat_QL/api/app/Config.php";
include_once "chat_QL/api/app/controller/UserController.php";

$auth = new AuthController();
$auth->checkAuth();
$user = new UserController();
$row = $user->getUserByIdQL($_SESSION['tendangnhap']);
$_SESSION["unique_id"] = $row["MaQL"];
?>
<link rel="stylesheet" href="chat_QL/assets/style_QL.css">

<body>
  <div class="content-wrapper">
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="wrapper" style='width: 1200px; margin-left: 20px;'>
              <section class="users">
                <header>
                  <div class="content">
                    <img src="view/images/<?php echo $row["HinhAnh"]; ?>" alt="">
                    <div class="details">
                      <span><?php echo $row["TenQL"]; ?></span>
                      <p><?php
                          if ($row['status'] == 1) {
                            echo "Đang hoạt động";
                          } else {
                            echo "Không hoạt động";
                          }
                          ?></p>
                    </div>
                  </div>

                </header>
                <div>
                  <form action="" method="POST">
                    <button style="min-width: 180px; padding: 14px 40px; border: none;" type="submit" name="nthocsinh">Học sinh</button>
                    <button style="min-width: 180px; padding: 14px 40px; border: none;" type="submit" name="ntgiaovien">Giáo viên</button>
                  </form>
                  <?php
                  if (isset($_REQUEST["nthocsinh"])) {
                    $_SESSION["nguoidungOut"] = "hocsinh";
                  } elseif (isset($_REQUEST["ntgiaovien"])) {
                    $_SESSION["nguoidungOut"] = "giaovien";
                  } else {
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
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
  </div>
</body>
</html>  
<script src="chat_QL/assets/users-event.js"></script>