<?php 
    if (!isset($_GET['rel'])) {
        header("location:signout.php");
        return;
    }
    session_start();
    $_SESSION['rel'] = $_GET['rel'];
    header("location:../index.php");
?>