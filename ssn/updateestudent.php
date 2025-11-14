<?php
include 'connector.php';
if (!isset($_POST['ee-id'])) {
    header("location:bridge.php?rel=list");   
    return;
}
$pid = $_POST['ee-id'];
$lsign = $_SESSION['uid'];
$query = "UPDATE tblStudents SET educ_primary = '".urlencode($_POST['ee-elem'])."', educ_primary_year = '".urlencode(substr($_POST['ee-elemyr'],0,4))."', educ_jhs = '".urlencode($_POST['ee-jhs'])."', educ_jhs_year = '".urlencode(substr($_POST['ee-jhsyr'],0,4))."', educ_jhs_grade = '".urlencode($_POST['ee-ave'])."' WHERE student_id = $pid";
mysqli_query($connect,$query);
savelogs($connect,$lsign,"user updated educational information of student ".$_POST['ee-lrn'],$datenow);
$_SESSION['msg'] = "Educational information updated!";
$_SESSION['code'] = "info";
header("location:bridge.php?rel=list");

mysqli_close($connect);
?>