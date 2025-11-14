<?php
include 'connector.php';
if (!isset($_GET['pid']) || !isset($_GET['typ'])) {
    header("location:bridge.php?rel=profile");   
    return;
}
$pid = $_GET['pid'];
$ltype = $_GET['typ'];
$lsign = $_SESSION['uid'];
$query = "";
if ($ltype == "stud") {
    $query = "UPDATE tblStudents SET contact_person = '".urlencode($_POST['c-name'])."', contact_number = '".urlencode($_POST['c-cp'])."', contact_address = '".urlencode($_POST['c-addr'])."', contact_relationship = '".urlencode($_POST['c-rel'])."' WHERE student_id = $pid";
}
mysqli_query($connect,$query);
savelogs($connect,$lsign,"user updated his/her emergency contact information",$datenow);
$_SESSION['msg'] = "Emergency contact information updated!";
$_SESSION['code'] = "info";
header("location:bridge.php?rel=profile");

mysqli_close($connect);
?>