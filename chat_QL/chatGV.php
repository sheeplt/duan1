<?php
include_once "chat_QL/api/app/controller/AuthController.php";
include_once "chat_QL/api/app/Config.php";
include_once "chat_QL/api/app/controller/UserController.php";
include_once "chat_QL/api/app/controller/MessageController.php";

$auth = new AuthController();
$auth->checkAuth();

$user = new UserController();
$row = $user->getUserByIdGV($_GET['hoithoai']);
$_SESSION["idql"] = $_GET['hoithoai'];

$mess = new MessageController();
$mess->updateChat($row['TenDN']);
?>
<link rel="stylesheet" href="chat_QL/assets/style_QL.css">

<body>
  <div class="content-wrapper">
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="wrapper" style='width: 1200px; margin-left: 20px;'>
              <section class="chat-area">
                <header>
                  <a href="QL.php?hoivadap" class="back-icon">
                    <i class="fas fa-arrow-left"></i>
                  </a>
                  <img src="view/images/<?php echo $row['HinhAnh']; ?>" alt="">
                  <div class="details">
                    <span><?php echo $row['TenGV']; ?></span>
                    <div><?php
                          if ($row['status'] == 1) {
                            echo "Đang hoạt động";
                          } else {
                            echo "Không hoạt động";
                          }
                          ?></div>
                  </div>
                </header>
                <div class="chat-box">

                </div>
                <form action="#" class="typing-area">
                  <input type="text" name="incoming_id" class="incoming_id" value="<?php echo $row['TenDN']; ?>" id="" hidden>
                  <input type="text" name="message" class="input-field" placeholder="Nhập nội dung ở đây..." autocomplete="off">
                  <button>
                    <i class="fab fa-telegram-plane"></i>
                  </button>
                </form>
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
<script src="chat_QL/assets/chat-event.js"></script>