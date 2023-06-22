<?php
class AuthController{
    private Config $conn;

    public function __construct()
    {
        if(!isset($_SESSION)){
            session_start();
        }
        $this->conn = new Config();
    }

    public function checkAuth(){
        if(!isset($_SESSION['unique_id'])){
           // header("location: login.php");
        }
    }
}