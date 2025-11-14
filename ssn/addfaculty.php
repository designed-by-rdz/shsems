<?php
include 'connector.php';
if (!isset($_POST['f-fname'])) {
    header("location:bridge.php?rel=faculty");   
    return;
}
$fid = urlencode($_POST['f-id']);

$getduplicate = mysqli_query($connect,"SELECT * FROM tblEmployees WHERE employee_id = '$fid'");
if (mysqli_num_rows($getduplicate) != 0) {
    $_SESSION['msg'] = "Employee ID already exists!";
    $_SESSION['code'] = "error";
    header("location:bridge.php?rel=faculty");
    return;
}

$ffname = urlencode($_POST['f-fname']);
$fgname = urlencode($_POST['f-gname']);
$fmname = urlencode($_POST['f-mname']);
$fename = urlencode($_POST['f-ename']);
$fdob = $_POST['f-dob'];
$fgender = urlencode($_POST['f-gender']);
$freligion = urlencode($_POST['f-religion']);
$fstreet = urlencode($_POST['f-street']);
$fcity = urlencode($_POST['f-city']);
$fprovince = urlencode($_POST['f-province']);
$fcp = $_POST['f-cp'];
$femail = urlencode($_POST['f-email']);
$fdesignation = urlencode($_POST['f-designation']);

$lsign = $_SESSION['uid'];
$query = "INSERT INTO tblEmployees(employee_id, employee_surname, employee_givenname, employee_middlename, employee_extname, employee_birthdate, employee_gender, employee_religion, address_street, address_city, address_province, employee_cp, employee_email, employee_designation, account_username) VALUES ('$fid','$ffname','$fgname','$fmname','$fename','$fdob','$fgender','$freligion','$fstreet','$fcity','$fprovince','$fcp','$femail','$fdesignation','')";
mysqli_query($connect,$query);
savelogs($connect,$lsign,"user created faculty $fid",$datenow);
$_SESSION['msg'] = "New faculty added!";
$_SESSION['code'] = "info";
header("location:bridge.php?rel=faculty");
mysqli_close($connect);
?>