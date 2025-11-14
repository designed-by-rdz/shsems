<?php
include 'connector.php';
if (!isset($_POST['s-id'])) {
    header("location:bridge.php?rel=sections");   
    return;
}
$sid = urlencode($_POST['s-id']);
$getduplicate = mysqli_query($connect,"SELECT * FROM tblSections WHERE section_id = '$sid'");
if (mysqli_num_rows($getduplicate) != 0) {
    $_SESSION['msg'] = "Section already exists!";
    $_SESSION['code'] = "error";
    header("location:bridge.php?rel=sections");
    return;
}

$sstrand = urlencode($_POST['s-strand']);
$getmaxsections = mysqli_query($connect,"SELECT * FROM tblStrands WHERE strand_name = '$sstrand'");
$getmax = mysqli_fetch_array($getmaxsections);
$sgrade = $_POST['s-grade'];
$getcurrentsections = mysqli_query($connect,"SELECT * FROM tblSections WHERE section_strand = '$sstrand' AND section_grade = $sgrade");
if (mysqli_num_rows($getcurrentsections) >= intval($getmax['strand_max_section'])) {
    $_SESSION['msg'] = "Section count limit reached!";
    $_SESSION['code'] = "error";
    header("location:bridge.php?rel=sections");
    return;
}

$sadviser = urlencode($_POST['s-adviser']);
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

$sname = urlencode($_POST['s-name']);
$smax = urlencode($_POST['s-max']);
$lsign = $_SESSION['uid'];
$query = "INSERT INTO tblSections (section_id,section_strand,section_name,section_grade,section_max_count,section_adviser) VALUES ('$sid','$sstrand','$sname',$sgrade,$smax,'$sadviser')";
mysqli_query($connect,$query);
savelogs($connect,$lsign,"user created section $sname for $sstrand $sgrade",$datenow);
$_SESSION['msg'] = "New section created!";
$_SESSION['code'] = "info";
header("location:bridge.php?rel=sections");
mysqli_close($connect);
?>