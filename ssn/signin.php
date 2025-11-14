<?php
include 'connector.php';
if (!isset($_POST['l-sign'])) {
    header("location:../login.php");   
    return;
}
$lsign = urlencode($_POST['l-sign']);
$lpass = $_POST['l-pass'];
$ltype = urlencode($_POST['l-type']);
$lpass = openssl_encrypt($lpass, $ciphering,$encryption_key, $options, $encryption_iv);
$lpass = urlencode($lpass);
$result = mysqli_query($connect,"SELECT * FROM tblUserAccounts WHERE account_username = '$lsign' AND account_password = '$lpass' AND user_role = '$ltype'");
if (mysqli_num_rows($result) != 0){
    while ($row = mysqli_fetch_array($result)){
        if ($row['account_status'] != "Active") {
            $_SESSION['msg'] = "User account is suspended!";
            $_SESSION['code'] = "error";
            header("location:../login.php");
            return;
        }
        $_SESSION['uid'] = $lsign;
        mysqli_query($connect,"UPDATE tblUserAccounts SET account_last_active = '$datenow' WHERE account_username = '$lsign'");
        savelogs($connect,$lsign,"user logged in",$datenow);
        header("location:bridge.php?rel=index");
    }
} else {
    $result = mysqli_query($connect,"SELECT * FROM tblUserAccounts WHERE account_username = '$lsign' AND user_role = '$ltype'");
    if (mysqli_num_rows($result) == 0) {
        $_SESSION['msg'] = "Account Not Found!";
    } else {
        $_SESSION['msg'] = "Incorrect Password!";
    }
    $_SESSION['code'] = "error";
    header("location:../login.php");
}
mysqli_close($connect);
?>