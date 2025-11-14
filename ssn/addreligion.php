<?php
include 'connector.php';
if (!isset($_POST['r-name'])) {
    header("location:bridge.php?rel=settings");   
    return;
}
$rname = urlencode($_POST['r-name']);

$getduplicate = mysqli_query($connect,"SELECT * FROM tblReligions WHERE religion_code = '$rname'");
if (mysqli_num_rows($getduplicate) != 0) {
    $_SESSION['msg'] = "Religion already exists!";
    $_SESSION['code'] = "error";
    header("location:bridge.php?rel=settings");
    return;
}

$rdesc = urlencode($_POST['r-desc']);
$lsign = $_SESSION['uid'];
$query = "INSERT INTO tblReligions (religion_code,religion_description) VALUES ('$rname','$rdesc')";
mysqli_query($connect,$query);
savelogs($connect,$lsign,"user inserted $rname as new religion",$datenow);
$_SESSION['msg'] = "New religion added!";
$_SESSION['code'] = "info";
header("location:bridge.php?rel=settings");
mysqli_close($connect);
?>