<?php
include 'connector.php';
if (!isset($_POST['se-id'])) {
    header("location:bridge.php?rel=strands");   
    return;
}
$sid = urlencode($_POST['se-id']);
$sname = urlencode($_POST['se-name']);
$sdesc = urlencode($_POST['se-desc']);
$smax = urlencode($_POST['se-max']);
$lsign = $_SESSION['uid'];
$query = "UPDATE tblStrands SET strand_name =  '$sname', strand_description = '$sdesc', strand_max_section = $smax WHERE strand_id = $sid";
mysqli_query($connect,$query);
savelogs($connect,$lsign,"user updated $sname strand",$datenow);
$_SESSION['msg'] = "Strand updated successfully!";
$_SESSION['code'] = "info";
header("location:bridge.php?rel=strands");
mysqli_close($connect);
?>