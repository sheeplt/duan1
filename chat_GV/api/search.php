<?php

include_once "app/controller/UserController.php";
include_once "app/Config.php";

$user = new UserController();
$searchTerm = mysqli_real_escape_string($user->conn->connect(), $_POST['searchTerm']);

if($_SESSION["nguoidungOut"] == "hocsinh"){
    $user->searchUsertoHS($searchTerm);
}else{
    $user->searchUsertoQL($searchTerm);
}