<?php 
    if (!isset($_GET['rel'])) {
        header("location:bridge.php?rel=strands");
        return;
    }
    session_start();
    $_SESSION['section-session'] = $_GET['rel'];
    header("location:bridge.php?rel=sections");
?>