<!DOCTYPE html>
<html lang="en">
<script src="view/js/jquery-3.6.0.js"></script>
<script src="view/js/Home.js"></script>

<style>
    body {
  font-family: sans-serif;
  background-color: #eeeeee;
}

.file-upload {
  background-color: #ffffff;
  width: 600px;
  margin: 0 auto;
  padding: 20px;
}

.file-upload-btn {
  width: 100%;
  margin: 0;
  color: #fff;
  background: #1FB264;
  border: none;
  padding: 10px;
  border-radius: 4px;
  border-bottom: 4px solid #15824B;
  transition: all .2s ease;
  outline: none;
  text-transform: uppercase;
  font-weight: 700;
}

.file-upload-btn:hover {
  background: #1AA059;
  color: #ffffff;
  transition: all .2s ease;
  cursor: pointer;
}

.file-upload-btn:active {
  border: 0;
  transition: all .2s ease;
}

.file-upload-content {
  display: none;
  text-align: center;
}

.file-upload-input {
  position: absolute;
  margin: 0;
  padding: 0;
  width: 100%;
  height: 100%;
  outline: none;
  opacity: 0;
  cursor: pointer;
}

.image-upload-wrap {
  margin-top: 20px;
  border: 4px dashed #1FB264;
  position: relative;
}

.image-dropping,
.image-upload-wrap:hover {
  background-color: #1FB264;
  border: 4px dashed #ffffff;
}

.image-title-wrap {
  padding: 0 15px 15px 15px;
  color: #222;
}

.drag-text {
  text-align: center;
}

.drag-text h3 {
  font-weight: 100;
  text-transform: uppercase;
  color: #15824B;
  padding: 60px 0;
}

.file-upload-image {
  max-height: 200px;
  max-width: 200px;
  margin: auto;
  padding: 20px;
}

.remove-image {
  width: 200px;
  margin: 0;
  color: #fff;
  background: #cd4535;
  border: none;
  padding: 10px;
  border-radius: 4px;
  border-bottom: 4px solid #b02818;
  transition: all .2s ease;
  outline: none;
  text-transform: uppercase;
  font-weight: 700;
}

.remove-image:hover {
  background: #c13b2a;
  color: #ffffff;
  transition: all .2s ease;
  cursor: pointer;
}

.remove-image:active {
  border: 0;
  transition: all .2s ease;
}
</style>
<script>
    function readURL(input) {
  if (input.files && input.files[0]) {

    var reader = new FileReader();

    reader.onload = function(e) {
      $('.image-upload-wrap').hide();

      $('.file-upload-image').attr('src', e.target.result);
      $('.file-upload-content').show();

      $('.image-title').html(input.files[0].name);
    };

    reader.readAsDataURL(input.files[0]);

  } else {
    removeUpload();
  }
}

function removeUpload() {
  $('.file-upload-input').replaceWith($('.file-upload-input').clone());
  $('.file-upload-content').hide();
  $('.image-upload-wrap').show();
}
$('.image-upload-wrap').bind('dragover', function () {
    $('.image-upload-wrap').addClass('image-dropping');
  });
  $('.image-upload-wrap').bind('dragleave', function () {
    $('.image-upload-wrap').removeClass('image-dropping');
});
</script>
<?php
ob_start();
$tendn = $_SESSION["tendangnhap"];
$makt = $_SESSION["makt"];
//lay ma hoc sinh
include_once("controller/chocsinh.php");
$phocsinh = new controlhocsinh();
$tablehocsinh = $phocsinh->lay1hs($tendn);
$rowhocsinh =  mysqli_fetch_assoc($tablehocsinh);
$mahs = $rowhocsinh['MaHS'];
//lay ma bai lam
include_once("controller/cbailam.php");
$pbailam = new controlbailam();
$tablebailam = $pbailam->laybai1lamvan($makt, $mahs);
$rowbailam =  mysqli_fetch_assoc($tablebailam);
$mabl = $rowbailam['MaBL'];
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đề trắc nghiệm</title>
    <link rel="stylesheet" href="css/lich_day.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/bootstrap.min.js"></script>
</head>

<body>

    <?php

    // chọn 1 bài kiểm tra
    include_once("controller/ckiemtra.php");
    $p = new controlkiemtra();
    $table = $p->chonktravan($makt);
    $row = mysqli_fetch_assoc($table);
    //danh sách câu trắc nghiệm
    $table1 = $p->layktratn($makt);
    $i = 1;
    ?>
    <div class="popular page_section">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="section_title text-center">
                            <h1 style="margin-bottom: 50px;">Đề bài: <?php echo $row["TieuDe"] ?></h1>
                        </div>
                    </div>
                </div>
    <p style='text-align:center;'>Thời gian làm bài: <?php echo $row["Time"] ?> phút</p> 

    <!-- tính thời gian -->
    <div id="response"></div>

    <script type="text/javascript">
        setInterval(function() {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.open("GET", "view/response.php", false);
            xmlhttp.send(null);
            if (xmlhttp.responseText == "00:00:01") {
                window.location = "HS.php?xemdethichitiet&lamxongbai";
            }
            document.getElementById("response").innerHTML = xmlhttp.responseText;
        }, 1000)
    </script>
    <a style="color: #FF9966; margin: auto;" href="/do_an_nhom14/file/DeThi/<?php echo  $row["FileDe"]; ?>">
        <h5><?php echo "Xem đề"; ?></h5>
    </a>

    <script class="jsbin" src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<form method="POST" action="" enctype="multipart/form-data">
    <div class="file-upload">
  <button class="file-upload-btn" type="button" onclick="$('.file-upload-input').trigger( 'click' )">Chọn file bài nộp</button>

  <div class="image-upload-wrap">
    <input class="file-upload-input" type='file' name="filede" onchange="readURL(this);" accept=".doc,.docx,.xml,.pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document" />
    <div class="drag-text">
      <h3>Kéo thẻ bài nộp</h3>
    </div>
  </div>
  <div class="file-upload-content">
    <div></div>
    <div class="image-title-wrap">
      <button type="button" onclick="removeUpload()" class="remove-image">Remove <span class="image-title">Uploaded Image</span></button>
    </div>
  </div>
  <div class="image-title-wrap">
  <button class="file-upload-btn" style="width: auto; margin-top: 20px;" type="submit" name="nopbai">Nộp bài</button>
      </div>
    </div>
    

</form>


</div> </div>
</body>
<?php
if (isset($_REQUEST["nopbai"])) {
    $file = $_FILES["filede"]["tmp_name"];
    $tenfile = $_FILES["filede"]["name"];
    $kq = $pbailam->nopbaivan($mabl, $file, $tenfile);
    if ($kq == 0) {
        echo "<script>alert('Không thể thêm lỗi')</script>";
    } else {
        echo header("refresh:0; url='HS.php?xemdethichitiet=".$makt."'");
    }
}
?>

</html>