<?php 
include 'connector.php';
if (!isset($_GET['eid'])) {
    header("location:bridge.php?rel=evaluation");   
    return;
}
$suser = $_SESSION['uid'];
$eid = $_GET['eid'];
$lrn = $_GET['lrn'];
mysqli_query($connect,"UPDATE tblEnrollment SET enrollment_status = 'EVALUATED', evaluator_id = '$suser', evaluator_date = '$datenow' WHERE enrollment_id = $eid");
savelogs($connect,$suser,"user approved evaluation of student $lrn",$datenow);
$_SESSION['msg'] = "Student successfully evaluated!";
$_SESSION['code'] = "info";
header("location:bridge.php?rel=evaluation");
?>