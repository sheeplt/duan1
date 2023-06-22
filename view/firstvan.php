<?php 
$makt = $_REQUEST["xdevan"];
include_once("controller/ckiemtra.php");
$p = new controlkiemtra();
$table = $p->chonktravan($makt);
$row = mysqli_fetch_assoc($table);

$_SESSION["makt"] = $makt;

$duration = $row["Time"];


date_default_timezone_set('Asia/Ho_Chi_Minh');

$_SESSION["duration"] = $duration;
$_SESSION["start-time"] = date("Y-m-d H:i:s");

$end_time=date("Y-m-d H:i:s", strtotime('+'. $_SESSION["duration"].'minutes', strtotime($_SESSION["start-time"])));

$_SESSION["end_time"] = $end_time;
?>
<script type="text/javascript">
window.location = "HS.php?bailamvan";
</script>