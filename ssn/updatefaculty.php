<?php
include 'connector.php';
if (!isset($_POST['fe-fname'])) {
    header("location:bridge.php?rel=faculty");   
    return;
}
$fid = urlencode($_POST['fe-id']);
$fnumid = urlencode($_POST['fe-numid']);
$ffname = urlencode($_POST['fe-fname']);
$fgname = urlencode($_POST['fe-gname']);
$fmname = urlencode($_POST['fe-mname']);
$fename = urlencode($_POST['fe-ename']);
$fdob = $_POST['fe-dob'];
$fgender = urlencode($_POST['fe-gender']);
$freligion = urlencode($_POST['fe-religion']);
$fstreet = urlencode($_POST['fe-street']);
$fcity = urlencode($_POST['fe-city']);
$fprovince = urlencode($_POST['fe-province']);
$fcp = $_POST['fe-cp'];
$femail = urlencode($_POST['fe-email']);
$fdesignation = urlencode($_POST['fe-designation']);

$lsign = $_SESSION['uid'];
$query = "UPDATE tblEmployees SET employee_surname = '$ffname', employee_givenname = '$fgname', employee_middlename = '$fmname', employee_extname = '$fename', employee_birthdate = '$fdob', employee_gender = '$fgender', employee_religion = '$freligion', address_street = '$fstreet', address_city = '$fcity', address_province = '$fprovince', employee_cp = '$fcp', employee_email = '$femail', employee_designation = '$fdesignation' WHERE employee_numid = $fnumid";
mysqli_query($connect,$query);
savelogs($connect,$lsign,"user updated faculty $fid",$datenow);
$_SESSION['msg'] = "Faculty details updated!";
$_SESSION['code'] = "info";
header("location:bridge.php?rel=faculty");
mysqli_close($connect);
?>