<?php 
include 'connector.php';
if (!isset($_GET['id'])) {
    header("location:bridge.php?rel=users");   
    return;
}
$aid = $_GET['id'];
$stax = $_GET['stax'];
$stuser = $_GET['stuser'];
$lsign = $_SESSION['uid'];
mysqli_query($connect,"UPDATE tblUserAccounts SET account_status = '$stax' WHERE account_id = '$aid'");
savelogs($connect,$lsign,"user set user $stuser status to $stax",$datenow);
$_SESSION['msg'] = "User account set to $stax!";
$_SESSION['code'] = "info";
header("location:bridge.php?rel=users");
?>