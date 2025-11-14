<?php 
include 'connector.php';
if (!isset($_GET['rel'])) {
    header("location:bridge.php?rel=index");   
    return;
}
$rel = $_GET['rel'];
$tbl = $_GET['tbl'];
$mid = $_GET['mid'];
$typ = $_GET['typ'];
$val = $_GET['val'];
if ($typ == "str") {
    $val = "'$val'";
}
$lsign = $_SESSION['uid'];
mysqli_query($connect,"DELETE FROM $tbl WHERE $mid = $val");
$val = str_replace("'","",$val);
savelogs($connect,$lsign,"user deleted $val from $tbl",$datenow);
$_SESSION['msg'] = "Selected entry deleted!";
$_SESSION['code'] = "info";
header("location:bridge.php?rel=$rel");
?>