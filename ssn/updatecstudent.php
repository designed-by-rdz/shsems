<?php
include 'connector.php';
if (!isset($_POST['ce-id'])) {
    header("location:bridge.php?rel=list");   
    return;
}
$pid = $_POST['ce-id'];
$lsign = $_SESSION['uid'];
$query = "UPDATE tblStudents SET contact_person = '".urlencode($_POST['ce-name'])."', contact_number = '".urlencode($_POST['ce-cp'])."', contact_address = '".urlencode($_POST['ce-addr'])."', contact_relationship = '".urlencode($_POST['ce-rel'])."' WHERE student_id = $pid";
mysqli_query($connect,$query);
savelogs($connect,$lsign,"user updated emergency information of student ".$_POST['ce-lrn'],$datenow);
$_SESSION['msg'] = "Emergency information updated!";
$_SESSION['code'] = "info";
header("location:bridge.php?rel=list");

mysqli_close($connect);
?>