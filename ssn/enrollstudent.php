<?php 
include 'connector.php';
if (!isset($_POST['e-eid'])) {
    header("location:bridge.php?rel=encoding");   
    return;
}
$suser = $_SESSION['uid'];
$eid = $_POST['e-eid'];
$elrn = $_POST['e-lrn'];
$esection = urlencode($_POST['e-section']);
mysqli_query($connect,"UPDATE tblEnrollment SET enrollment_data = '$esection', enrollment_status = 'ENROLLED', encoder_id = '$suser', encoder_date = '$datenow', enrollment_date = '$datenow' WHERE enrollment_id = $eid");
savelogs($connect,$suser,"user enrolled student $elrn to $esection",$datenow);
$_SESSION['msg'] = "Student successfully enrolled!";
$_SESSION['code'] = "info";
header("location:bridge.php?rel=encoding");
?>