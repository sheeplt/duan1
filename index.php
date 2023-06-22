<?php
ob_start();
session_start();
    include "view/header.php";

    if(isset($_REQUEST["page"])){
        $page=$_REQUEST["page"];
        switch ($page) {
            case "khoahoc" :
                include "view/khoahoc.php";
                break;
            
            case "tintuc" :
                include "view/tintuc.php";
                break;

            case "lienhe" :
                include "view/lienhe.php";
                break;

            default:
                include "view/home.php";
                break;
        }   
    }else{
        include "view/home.php";
    }
    include "view/footer.php";
?>