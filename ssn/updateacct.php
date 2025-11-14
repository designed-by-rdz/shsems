<?php
include 'connector.php';
if (!isset($_POST['le-sign'])) {
    header("location:bridge.php?rel=users");   
    return;
}
if ($_POST['le-pass'] != $_POST['le-passt']) {
    $_SESSION['msg'] = "Password did not matched!";
    $_SESSION['code'] = "error";
    header("location:bridge.php?rel=users");
    return;
}
$lsign = urlencode($_POST['le-sign']);
$lpass = $_POST['le-pass'];
$ltype = urlencode($_POST['le-type']);
$lpass = openssl_encrypt($lpass, $ciphering,$encryption_key, $options, $encryption_iv);
$lpass = urlencode($lpass);
$luser = urlencode($_POST['le-user']);
$lid = urlencode($_POST['le-id']);
$lstax = urlencode($_POST['le-stax']);
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
if (empty($_POST['le-perm'])){
    $_SESSION['msg'] = "Permission cannot be empty!";
    $_SESSION['code'] = "error";
    header("location:bridge.php?rel=users");
    return;
}
$lperm = implode("",$_POST['le-perm']);
mysqli_query($connect,"UPDATE tblUserAccounts SET account_password = '$lpass',user_role = '$ltype',permission_rights = '$lperm',account_user = '$luser', account_status = '$lstax' WHERE account_id = $lid");
savelogs($connect,$_SESSION['uid'],"user updated details of account $lsign",$datenow);
if ($luser != ""){
    if ($ltype == "Student") {
        $query = "UPDATE tblStudents SET account_username = '$lsign' WHERE student_lrn = '$luser'";
    } else {
        $query = "UPDATE tblEmployees SET account_username = '$lsign' WHERE employee_id = '$luser'";
    }
}
mysqli_query($connect,$query);
$_SESSION['msg'] = "Account details successfully updated!";
$_SESSION['code'] = "info";
header("location:bridge.php?rel=users");
mysqli_close($connect);
?>