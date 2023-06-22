<?php
ob_start();
session_start();
include "view/header_GV.php";

if (empty($_SESSION["tendangnhap"])) {
    include("dang_nhap.php");
}

if (isset($_REQUEST["dslich"])) {
    include("view/vlich.php");
} elseif (isset($_REQUEST["ttcn"])) {
    include("view/vttcnGV.php");
} elseif (isset($_REQUEST["xemdethichitiet"])) {
    include("view/vxemdethichitiet.php");
} elseif (isset($_REQUEST["xdetn"])) {
    include("view/vxemde.php");
} elseif (isset($_REQUEST["xbh"])) {
    include("view/vdsbaihoc.php");
} elseif (isset($_REQUEST["tbh"])) {
    include("view/vthembaihoc.php");
} elseif (isset($_REQUEST["updatebaihoc"])) {
    include("view/vupdatebaihoc.php");
} elseif (isset($_REQUEST["themdekt"])) {
    include("view/vthemdekt.php");
} elseif (isset($_REQUEST["vdsktraChthem"])) {
    include("view/vdsktChthem.php");
} elseif (isset($_REQUEST["themch"])) {
    include("view/vthemcauhoi.php");
} elseif (isset($_REQUEST["updatekiemtra"])) {
    include("view/vupdatedekt.php");
} elseif (isset($_REQUEST["updatechtn"])) {
    include("view/vupdatechtn.php");
} elseif (isset($_REQUEST["dmk"])) {
    include("view/vdoimk.php");
}elseif (isset($_REQUEST["chitietkiemtra"])) {
    include("view/vchitietkiemtra.php");
}elseif (isset($_REQUEST["dslop"])) {
    include("view/vdslophoc.php");
}elseif (isset($_REQUEST["themdechthem"])) {
    include("view/vthemdechthem.php");
} elseif (isset($_REQUEST["hoivadap"])) {
    include("chat_GV/users.php");
} elseif (isset($_REQUEST["hoithoai"])) {
    if($_SESSION["nguoidungOut"] == "hocsinh"){
        include("chat_GV/chat.php");
    }else{
        include("chat_GV/chatQL.php");
    }
    
} elseif (isset($_REQUEST["dangxuat"])) {
    include("dang_xuat.php");
}

else{
    include("view/home_GV.php");
}
include "view/footer_GV.php";
?>