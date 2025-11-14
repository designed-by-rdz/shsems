<?php
include 'connector.php';
if(ISSET($_SESSION['uid'])){
    savelogs($connect,$_SESSION['uid'],"user logged out",$datenow);
	unset($_SESSION['uid']);
	unset($_SESSION['rel']);
	unset($_SESSION['section-session']);
	}
header("location:../login.php");
?>