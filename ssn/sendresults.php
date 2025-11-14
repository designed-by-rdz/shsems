<?php
include 'connector.php';
if (!isset($_POST['slrn'])) {
    header("location:bridge.php?rel=exam");   
    return;
}
$slrn = $_POST['slrn'];
$seid = $_POST['seid'];
$results = [0,0,0,0,0];
$lsign = $_SESSION['uid'];
for ($i=0; $i < 10; $i++) { 
    $results[$_POST["answer-$i"]] += 1;
}
$results = implode(",",$results);
$query = "INSERT INTO tblResults (examination_id,result_points,result_date,student_lrn) VALUES ($seid,'$results','$datenow','$slrn')";
mysqli_query($connect,$query);
savelogs($connect,$lsign,"user took the strand assessment",$datenow);
$_SESSION['msg'] = "Assessment result tallied!";
$_SESSION['code'] = "info";
header("location:bridge.php?rel=exam");
mysqli_close($connect);
?>