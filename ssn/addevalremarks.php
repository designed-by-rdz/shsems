<?php 
include 'connector.php';
$ruser = strtolower(urlencode($_POST['r-user']));
$rel = "evaluation";
if ($ruser == "encoder") {
    $rel= "encoding";
}
if (!isset($_POST['r-eid'])) {
    header("location:bridge.php?rel=$rel");   
    return;
}
$suser = $_SESSION['uid'];
$reid = $_POST['r-eid'];
$rlrn = $_POST['r-lrn'];
$rrem = urlencode($_POST['r-rem']);
mysqli_query($connect,"UPDATE tblEnrollment SET enrollment_flags = '$rrem', ".$ruser."_id = '$suser', ".$ruser."_date = '$datenow' WHERE enrollment_id = $reid");
savelogs($connect,$suser,"user updated $rel remarks of student $rlrn",$datenow);
$_SESSION['msg'] = "Student $rel remarks updated!";
$_SESSION['code'] = "info";
header("location:bridge.php?rel=$rel");
?>