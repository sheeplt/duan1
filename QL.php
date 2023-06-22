<?php
session_start();
ob_start();
include "view/header_admin.php";

if (isset($_REQUEST["lichhoc"])) {
    include("view/vqlxemlich.php");
} elseif (isset($_REQUEST["themlichbu"])) {
    include("view/vqlthemlichbu.php");
} elseif (isset($_REQUEST["chitietlichtheotiet"])) {
    include("view/vqlxemlichtheotiet.php");
} elseif (isset($_REQUEST["updatelich1"])) {
    include("view/vqlupdatelich1.php");
} elseif (isset($_REQUEST["updatelich12"])) {
    include("view/vqlupdatelich12.php");
} elseif (isset($_REQUEST["updatelich13"])) {
    include("view/vqlupdatelich13.php");
} elseif (isset($_REQUEST["updatelich2"])) {
    include("view/vqlupdatelich2.php");
} elseif (isset($_REQUEST["updatelich3"])) {
    include("view/vqlupdatelich3.php");
} elseif (isset($_REQUEST["tncn"])) {
    include("view/home_admin.php");
} elseif (isset($_REQUEST["dmk"])) {
    include("view/vqldoimk.php");
} elseif (isset($_REQUEST["baiviet"])) {
    include("view/vqldsbaiviet.php");
} elseif (isset($_REQUEST["thembaiviet"])) {
    include("view/vqlthembaiviet.php");
} elseif (isset($_REQUEST["updatebaiviet"])) {
    include("view/vqlupdatebaiviet.php");
} elseif (isset($_REQUEST["hocsinh"])) {
    include("view/vqldshocsinh.php");
} elseif (isset($_REQUEST["tatcahocsinh"])) {
    include("view/vqldstatcahocsinh.php");
} elseif (isset($_REQUEST["ctdshs"])) {
    include("view/vqldshocsinhct.php");
} elseif (isset($_REQUEST["themlophoc"])) {
    include("view/vqlthemlophoc.php");
} elseif (isset($_REQUEST["themhocsinh"])) {
    include("view/vqlthemhocsinh.php");
} elseif (isset($_REQUEST["themhocsinhvaolop"])) {
    include("view/vqlthemhsvaolop.php");
} elseif (isset($_REQUEST["updatelop"])) {
    include("view/vqlupdatelophoc.php");
} elseif (isset($_REQUEST["updatehs"])) {
    include("view/vqlupdatehocsinh.php");
} elseif (isset($_REQUEST["giangvien"])) {
    include("view/vqldsgiangvien.php");
} elseif (isset($_REQUEST["themgiaovien"])) {
    include("view/vqlthemgiaovien.php");
} elseif (isset($_REQUEST["updategv"])) {
    include("view/vqlupdategiaovien.php");
} elseif (isset($_REQUEST["quanli"])) {
    include("view/vqldsquanli.php");
} elseif (isset($_REQUEST["themquanli"])) {
    include("view/vqlthemquanli.php");
} elseif (isset($_REQUEST["updateql"])) {
    include("view/vqlupdatequanli.php");
} elseif (isset($_REQUEST["ngaythi"])) {
    include("view/vqlngaythi.php");
}
// ql hóa đơn
elseif (isset($_REQUEST["hoadonhoctap"])) {
    include("view/vqldshoadonhs.php");
}elseif (isset($_REQUEST["hoadongiaovien"])) {
    include("view/vqldshoadongv.php");
}elseif (isset($_REQUEST["cthoadongiaovien"])) {
    include("view/vqldshoadongvct.php");
}elseif (isset($_REQUEST["hoadonnhanvien"])) {
    include("view/vqldshoadonnv.php");
}elseif (isset($_REQUEST["updatehoadonql"])) {
    include("view/vqlupdatehoadonnv.php");
}elseif (isset($_REQUEST["bangluong"])) {
    include("view/vqldsbangluong.php");
}elseif (isset($_REQUEST["updatebangluong"])) {
    include("view/vqlupdatebangluong.php");
}
//hội thoại
elseif (isset($_REQUEST["hoivadap"])) {
    include("chat_QL/users.php");
}
elseif (isset($_REQUEST["hoithoai"])) {
    if($_SESSION["nguoidungOut"] == "hocsinh"){
        include("chat_QL/chat.php");
    }else{
        include("chat_QL/chatGV.php");
    }
    
} elseif (isset($_REQUEST["dangxuat"])) {
    include("dang_xuat.php");
}


else {
    include("view/home_admin.php");
} 
include "view/footer_admin.php";
?>