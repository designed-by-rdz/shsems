<?php
include 'connector.php';
if (!isset($_POST['se-id'])) {
    header("location:bridge.php?rel=sections");   
    return;
}
$sid = urlencode($_POST['se-id']);
$sstrand = urlencode($_POST['se-strand']);
$sgrade = $_POST['se-grade'];
$sadviser = urlencode($_POST['se-adviser']);
if ($sadviser != "") {
    $query = "SELECT * FROM tblEmployees WHERE employee_id = '$sadviser'";
    $getuserdets = mysqli_query($connect,$query);
    if (mysqli_num_rows($getuserdets) == 0) {
        $_SESSION['msg'] = "No personal information found for $sadviser!";
        $_SESSION['code'] = "error";
        header("location:bridge.php?rel=sections");
        return;
    }
}
$sname = urlencode($_POST['se-name']);
$smax = urlencode($_POST['se-max']);
$lsign = $_SESSION['uid'];
$query = "UPDATE tblSections SET section_name = '$sname',section_grade = $sgrade,section_max_count = $smax,section_adviser = '$sadviser' WHERE section_id = '$sid'";
mysqli_query($connect,$query);
savelogs($connect,$lsign,"user updated section details $sname of $sstrand strand",$datenow);
$_SESSION['msg'] = "Section updated successfully!";
$_SESSION['code'] = "info";
header("location:bridge.php?rel=sections");
mysqli_close($connect);
?>