<?php
include 'connector.php';
if (!isset($_GET['pid']) || !isset($_GET['typ'])) {
    header("location:bridge.php?rel=profile");   
    return;
}
$pid = $_GET['pid'];
$ltype = $_GET['typ'];
$lsign = $_SESSION['uid'];
$query = "";
if ($ltype == "stud") {
    $getduplicate = mysqli_query($connect,"SELECT * FROM tblStudents WHERE student_lrn = '".urlencode($_POST['e-lrn'])."' AND student_id != $pid");
    if (mysqli_num_rows($getduplicate) != 0) {
        $_SESSION['msg'] = "LRN already exists!";
        $_SESSION['code'] = "error";
        header("location:bridge.php?rel=profile");
        return;
    }
    $query = "UPDATE tblStudents SET student_lrn = '".urlencode(substr($_POST['e-lrn'],0,12))."', educ_primary = '".urlencode($_POST['e-elem'])."', educ_primary_year = '".urlencode(substr($_POST['e-elemyr'],0,4))."', educ_jhs = '".urlencode($_POST['e-jhs'])."', educ_jhs_year = '".urlencode(substr($_POST['e-jhsyr'],0,4))."', educ_jhs_grade = '".urlencode($_POST['e-ave'])."' WHERE student_id = $pid";
}
mysqli_query($connect,$query);
savelogs($connect,$lsign,"user updated his/her educational information",$datenow);
$_SESSION['msg'] = "Educational information updated!";
$_SESSION['code'] = "info";
header("location:bridge.php?rel=profile");

mysqli_close($connect);
?>