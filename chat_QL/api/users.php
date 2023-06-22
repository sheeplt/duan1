<?php

include_once "app/controller/UserController.php";
include_once "app/Config.php";
$user = new UserController();
if($_SESSION["nguoidungOut"] == "hocsinh"){
    $user->getDatatoHS();
}elseif($_SESSION["nguoidungOut"] == "giaovien"){
    $user->getDatatoGV();
}