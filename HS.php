<?php
session_start();
ob_start();
include "view/header_HS.php";

if (isset($_REQUEST["trangchu"])) {
    include("view/vhstrangchu.php");
} elseif (isset($_REQUEST["lichhoc"])) {
    include("view/vhsxemlich.php");
} elseif (isset($_REQUEST["xembaihoc"])) {
    include("view/vhsxembaihoc.php");
} elseif (isset($_REQUEST["xemdethichitiet"])) {
    include("view/vhsxembaikiemtra.php");
} elseif (isset($_REQUEST["xdetn"])) {
    include("view/first.php");
} elseif (isset($_REQUEST["bailam"])) {
    include("view/vhsdetn.php");
} elseif (isset($_REQUEST["ttcn"])) {
    include("view/vhsttcn.php");
} elseif (isset($_REQUEST["dmk"])) {
    include("view/vhsdoimk.php");
} elseif (isset($_REQUEST["xdevan"])) {
    include("view/firstvan.php");
} elseif (isset($_REQUEST["bailamvan"])) {
    include("view/vhsxemdevan.php");
} elseif (isset($_REQUEST["hoivadap"])) {
    include("chat_app_php-main/users.php");
} elseif (isset($_REQUEST["hoithoai"])) {
    if($_SESSION["nguoidungOut"] == "giaovien"){
        include("chat_app_php-main/chat.php");
    }else{
        include("chat_app_php-main/chatQL.php");
    }
    
} elseif (isset($_REQUEST["dangxuat"])) {
    include("dang_xuat.php");
} else{
    include("view/vhstrangchu.php");
}  

include "view/footer_HS.php";
?>