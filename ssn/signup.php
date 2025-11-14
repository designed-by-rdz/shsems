<?php
include 'connector.php';
if (!isset($_POST['l-sign'])) {
    header("location:../login.php");   
    return;
}
if ($_POST['l-pass'] != $_POST['l-passt']) {
    $_SESSION['msg'] = "Password did not matched!";
    $_SESSION['code'] = "error";
    header("location:../register.php");
    return;
}
if ($_POST['l-capt'] != $_SESSION["captcha"]) {
    $_SESSION['msg'] = "Captcha incorrect!";
    $_SESSION['code'] = "error";
    header("location:../register.php");
    return;
}
$lsign = urlencode($_POST['l-sign']);

$getduplicate = mysqli_query($connect,"SELECT * FROM tblUserAccounts WHERE account_username = '$lsign'");
if (mysqli_num_rows($getduplicate) != 0) {
    $_SESSION['msg'] = "Username already taken!";
    $_SESSION['code'] = "error";
    header("location:../register.php");
    return;
}

$lpass = $_POST['l-pass'];
$ltype = urlencode($_POST['l-type']);
$lpass = openssl_encrypt($lpass, $ciphering,$encryption_key, $options, $encryption_iv);
$lpass = urlencode($lpass);

mysqli_query($connect,"INSERT INTO tblUserAccounts (account_username,account_password,user_role) VALUES ('$lsign','$lpass','$ltype')");
savelogs($connect,$lsign,"user registered an account",$datenow);
//create random number identifier here first
$temprandom = generateRandom();
if ($ltype == "Student") {
    $query = "INSERT INTO tblStudents (student_lrn,student_surname,student_givenname,student_middlename,student_gender,student_religion,student_birthdate,address_city,address_province,student_cpnumber,contact_person,contact_number,contact_address,contact_relationship,educ_primary,educ_primary_year,educ_jhs,educ_jhs_year,educ_jhs_grade,account_username) VALUES ($temprandom,'','','','','','','','','','','','','','','','','','','$lsign')";
} else {
    $query = "INSERT INTO tblEmployees (employee_id,employee_surname,employee_givenname,employee_middlename,employee_birthdate,employee_gender,employee_religion,address_street,address_city,address_province,employee_cp,employee_email,employee_designation,account_username) VALUES ('$temprandom','','','','','','','','','','','','','$lsign')";
}
mysqli_query($connect,$query);
mysqli_query($connect,"UPDATE tblUserAccounts SET account_user = '$temprandom' WHERE account_username = '$lsign'");
$_SESSION['msg'] = "Account generated!";
$_SESSION['code'] = "info";
header("location:../login.php");

mysqli_close($connect);
?>