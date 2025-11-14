<?php
include 'connector.php';
if (!isset($_POST['g-name'])) {
    header("location:bridge.php?rel=settings");   
    return;
}
$gname = urlencode($_POST['g-name']);

$getduplicate = mysqli_query($connect,"SELECT * FROM tblGenders WHERE gender_code = '$gname'");
if (mysqli_num_rows($getduplicate) != 0) {
    $_SESSION['msg'] = "Gender already exists!";
    $_SESSION['code'] = "error";
    header("location:bridge.php?rel=settings");
    return;
}

$gdesc = urlencode($_POST['g-desc']);
$lsign = $_SESSION['uid'];
$query = "INSERT INTO tblGenders (gender_code,gender_description) VALUES ('$gname','$gdesc')";
mysqli_query($connect,$query);
savelogs($connect,$lsign,"user inserted $gname as new gender",$datenow);
$_SESSION['msg'] = "New gender added!";
$_SESSION['code'] = "info";
header("location:bridge.php?rel=settings");
mysqli_close($connect);
?>