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
    $query = "UPDATE tblStudents SET student_surname = '".urlencode($_POST['p-fname'])."', student_givenname = '".urlencode($_POST['p-gname'])."', student_middlename = '".urlencode($_POST['p-mname'])."', student_extname = '".urlencode($_POST['p-ename'])."', student_gender = '".urlencode($_POST['p-gender'])."', student_religion = '".urlencode($_POST['p-religion'])."', student_birthdate = '".$_POST['p-dob']."', address_street = '".urlencode($_POST['p-street'])."', address_city = '".urlencode($_POST['p-city'])."', address_province = '".urlencode($_POST['p-province'])."', student_cpnumber = '".$_POST['p-cp']."', student_email = '".urlencode($_POST['p-email'])."' WHERE student_id = $pid";
} else {
    $getduplicate = mysqli_query($connect,"SELECT * FROM tblEmployees WHERE employee_id = '".urlencode($_POST['e-id'])."' AND employee_numid != $pid");
    if (mysqli_num_rows($getduplicate) != 0) {
        $_SESSION['msg'] = "Employee id already exists!";
        $_SESSION['code'] = "error";
        header("location:bridge.php?rel=profile");
        return;
    }
    $query = "UPDATE tblEmployees SET employee_id = '".urlencode($_POST['e-id'])."', employee_surname = '".urlencode($_POST['e-fname'])."', employee_givenname = '".urlencode($_POST['e-gname'])."', employee_middlename = '".urlencode($_POST['e-mname'])."', employee_extname = '".urlencode($_POST['e-ename'])."', employee_birthdate = '".$_POST['e-dob']."', employee_gender = '".urlencode($_POST['e-gender'])."', employee_religion = '".urlencode($_POST['e-religion'])."', address_street = '".urlencode($_POST['e-street'])."', address_city = '".urlencode($_POST['e-city'])."', address_province = '".urlencode($_POST['e-province'])."', employee_cp = '".$_POST['e-cp']."', employee_email = '".urlencode($_POST['e-email'])."', employee_designation = '".urlencode($_POST['e-designation'])."' WHERE employee_numid = $pid";
}
mysqli_query($connect,$query);
savelogs($connect,$lsign,"user updated his/her personal information",$datenow);
$_SESSION['msg'] = "Personal information updated!";
$_SESSION['code'] = "info";
header("location:bridge.php?rel=profile");

mysqli_close($connect);
?>