<?php
include 'connector.php';
if (!isset($_POST['f-name'])) {
    header("location:bridge.php?rel=settings");   
    return;
}
$fname = urlencode($_POST['f-name']);

$getduplicate = mysqli_query($connect,"SELECT * FROM tblFlags WHERE flag_code = '$fname'");
if (mysqli_num_rows($getduplicate) != 0) {
    $_SESSION['msg'] = "Enrollment flag already exists!";
    $_SESSION['code'] = "error";
    header("location:bridge.php?rel=settings");
    return;
}

$fdesc = urlencode($_POST['f-desc']);
$lsign = $_SESSION['uid'];
$query = "INSERT INTO tblFlags (flag_code,flag_description) VALUES ('$fname','$fdesc')";
mysqli_query($connect,$query);
savelogs($connect,$lsign,"user inserted $fname as new enrollment flag",$datenow);
$_SESSION['msg'] = "New enrollment flag added!";
$_SESSION['code'] = "info";
header("location:bridge.php?rel=settings");
mysqli_close($connect);
?>