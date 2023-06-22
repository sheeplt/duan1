<?php 
include_once("controller/ctaikhoan.php");
$p = new controlTaiKhoan();
$tendangnhap = $_SESSION["tendangnhap"];
$table = $p->laytaikhoan($tendangnhap);
$row = mysqli_fetch_assoc($table);
if ($row["LoaiTK"] == 'GV') {
    $p->statusgv1($tendangnhap);
} elseif ($row["LoaiTK"] == 'HS') {
    $p->statushs1($tendangnhap);
} elseif ($row["LoaiTK"] == 'QL') {
    $p->statusql1($tendangnhap);
}
session_destroy();
echo header("refresh:0; url='index.php'");
?>