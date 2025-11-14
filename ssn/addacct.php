<?php
include 'connector.php';
if (!isset($_POST['l-sign'])) {
    header("location:bridge.php?rel=users");   
    return;
}
if ($_POST['l-pass'] != $_POST['l-passt']) {
    $_SESSION['msg'] = "Password did not matched!";
    $_SESSION['code'] = "error";
    header("location:bridge.php?rel=users");
    return;
}
$lsign = urlencode($_POST['l-sign']);

$getduplicate = mysqli_query($connect,"SELECT * FROM tblUserAccounts WHERE account_username = '$lsign'");
if (mysqli_num_rows($getduplicate) != 0) {
    $_SESSION['msg'] = "Username already taken!";
    $_SESSION['code'] = "error";
    header("location:bridge.php?rel=users");
    return;
}

$lpass = $_POST['l-pass'];
$ltype = urlencode($_POST['l-type']);
$lpass = openssl_encrypt($lpass, $ciphering,$encryption_key, $options, $encryption_iv);
$lpass = urlencode($lpass);
$luser = urlencode($_POST['l-user']);

if ($luser != ""){
    if ($ltype == "Student") {
        $query = "SELECT * FROM tblStudents WHERE student_lrn = $luser";
    } else {
        $query = "SELECT * FROM tblEmployees WHERE employee_id = '$luser'";
    }
    $getuserdets = mysqli_query($connect,$query);
    if (mysqli_num_rows($getuserdets) == 0) {
        $_SESSION['msg'] = "No personal information found for $luser!";
        $_SESSION['code'] = "error";
        header("location:bridge.php?rel=users");
        return;
    }
}

if (empty($_POST['l-perm'])){
    $_SESSION['msg'] = "Permission cannot be empty!";
    $_SESSION['code'] = "error";
    header("location:bridge.php?rel=users");
    return;
}

$lperm = implode("",$_POST['l-perm']);

mysqli_query($connect,"INSERT INTO tblUserAccounts (account_username,account_password,user_role,permission_rights,account_user) VALUES ('$lsign','$lpass','$ltype','$lperm','$luser')");
savelogs($connect,$_SESSION['uid'],"user registered account $lsign",$datenow);
if ($luser == ""){
    if ($ltype == "Student") {
        $query = "INSERT INTO tblStudents (student_lrn,student_surname,student_givenname,student_middlename,student_gender,student_religion,student_birthdate,address_city,address_province,student_cpnumber,educ_primary,educ_primary_year,educ_jhs,educ_jhs_year,educ_jhs_grade,account_username) VALUES (0,'','','','','','','','','','','','','','','$lsign')";
    } else {
        $query = "INSERT INTO tblEmployees (employee_id,employee_surname,employee_givenname,employee_middlename,employee_birthdate,employee_gender,address_street,address_city,address_province,employee_cp,employee_email,employee_designation,account_username) VALUES ('','','','','','','','','','','','','$lsign')";
    }
} else {
    if ($ltype == "Student") {
        $query = "UPDATE tblStudents SET account_username = '$lsign' WHERE student_lrn = '$luser'";
    } else {
        $query = "UPDATE tblEmployees SET account_username = '$lsign' WHERE employee_id = '$luser'";
    }
}
mysqli_query($connect,$query);
$_SESSION['msg'] = "New account generated!";
$_SESSION['code'] = "info";
header("location:bridge.php?rel=users");

mysqli_close($connect);
?>