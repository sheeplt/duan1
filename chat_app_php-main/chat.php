<?php
include_once "chat_app_php-main/api/app/controller/AuthController.php";
include_once "chat_app_php-main/api/app/Config.php";
include_once "chat_app_php-main/api/app/controller/UserController.php";
include_once "chat_app_php-main/api/app/controller/MessageController.php";

$auth = new AuthController();
$auth->checkAuth();

$user = new UserController();
$row = $user->getUserByIdGV($_GET['hoithoai']);
$_SESSION["idgv"] = $_GET['hoithoai'];

$mess = new MessageController();
$mess->updateChat($row['TenDN']);
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
    <section class="chat-area">
      <header>
        <a href="HS.php?hoivadap" class="back-icon">
          <i class="fas fa-arrow-left"></i>
        </a>
        <img src="view/images/<?php echo $row['HinhAnh']; ?>" alt="">
        <div class="details">
          <span><?php echo $row['TenGV']; ?></span>
          <div><?php 
          if($row['status'] == 1){
            echo "Đang hoạt động";
          }else{
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

  <script src="chat_app_php-main/assets/chat-event.js"></script>
            </div></div>
</body>
</html>