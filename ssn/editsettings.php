<?php 
include 'connector.php';
if (!isset($_GET['st'])) {
    header("location:bridge.php?rel=settings");   
    return;
}
$kid = "";
$kvalue = "";
$key = "";
if ($_GET['st'] == "ay") {
    $kid = $_POST['a-id'];
    $kvalue = $_POST['a-dateone']."-".$_POST['a-datetwo'];
    $key = "Academic Year";
} elseif ($_GET['st'] == "sem") {
    $kid = $_POST['s-id'];
    $kvalue = $_POST['s-sem'];
    $key = "Semester";
} elseif ($_GET['st'] == "av") {
    $kid = $_POST['v-id'];
    $kvalue = $_POST['v-open'];
    $key = "Availability";
} elseif ($_GET['st'] == "ver") {
    $kid = $_POST['r-id'];
    $kvalue = $_POST['r-ver'];
    $key = "Version";
} elseif ($_GET['st'] == "skl") {
    $kid = $_POST['c-id'];
    $kvalue = $_POST['c-name'];
    $key = "School";
}
$lsign = $_SESSION['uid'];
mysqli_query($connect,"UPDATE tblData SET dkey = '$kvalue' WHERE did = $kid");
savelogs($connect,$lsign,"user made changes with $key",$datenow);
$_SESSION['msg'] = "Settings successfully updated!";
$_SESSION['code'] = "info";
header("location:bridge.php?rel=settings");
?>