<?php
include 'connector.php';
if (!isset($_POST['s-name'])) {
    header("location:bridge.php?rel=strands");   
    return;
}
$sname = urlencode($_POST['s-name']);

$getduplicate = mysqli_query($connect,"SELECT * FROM tblStrands WHERE strand_name = '$sname'");
if (mysqli_num_rows($getduplicate) != 0) {
    $_SESSION['msg'] = "Strand already exists!";
    $_SESSION['code'] = "error";
    header("location:bridge.php?rel=strands");
    return;
}

$sdesc = urlencode($_POST['s-desc']);
$smax = urlencode($_POST['s-max']);
$lsign = $_SESSION['uid'];
$query = "INSERT INTO tblStrands (strand_name,strand_description,strand_max_section) VALUES ('$sname','$sdesc',$smax)";
mysqli_query($connect,$query);
savelogs($connect,$lsign,"user created $sname strand",$datenow);
$_SESSION['msg'] = "New strand created!";
$_SESSION['code'] = "info";
header("location:bridge.php?rel=strands");
mysqli_close($connect);
?>