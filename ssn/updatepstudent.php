<?php
include 'connector.php';
if (!isset($_POST['pe-id'])) {
    header("location:bridge.php?rel=list");   
    return;
}
$pid = $_POST['pe-id'];
$lsign = $_SESSION['uid'];
$query = "UPDATE tblStudents SET student_surname = '".urlencode($_POST['pe-fname'])."', student_givenname = '".urlencode($_POST['pe-gname'])."', student_middlename = '".urlencode($_POST['pe-mname'])."', student_extname = '".urlencode($_POST['pe-ename'])."', student_gender = '".urlencode($_POST['pe-gender'])."', student_religion = '".urlencode($_POST['pe-religion'])."', student_birthdate = '".$_POST['pe-dob']."', address_street = '".urlencode($_POST['pe-street'])."', address_city = '".urlencode($_POST['pe-city'])."', address_province = '".urlencode($_POST['pe-province'])."', student_cpnumber = '".$_POST['pe-cp']."', student_email = '".urlencode($_POST['pe-email'])."' WHERE student_id = $pid";
mysqli_query($connect,$query);
savelogs($connect,$lsign,"user updated personal information of student ".$_POST['pe-lrn'],$datenow);
$_SESSION['msg'] = "Personal information updated!";
$_SESSION['code'] = "info";
header("location:bridge.php?rel=list");

mysqli_close($connect);
?>