<?php 
    require 'con/con.php';
    if(!ISSET($_SESSION['uid'])){
        header("location:login.php");
        return;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title><?= urldecode($data['school']) ?> | SHSEMS</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="img/logo.png">
    <link rel="stylesheet" type="text/css" href="css/pico.classless.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/icon.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="js/chart.js@4.5.0.js"></script>
    <script src="js/script.js"></script>
</head>
<body>
    <?php 
        include 'inc/header.php'; 
        echo "<div class='body'><div class='body-content'>";
        if ($_SESSION['rel'] == 'index') {
            include 'inc/home.php';
        } else {
            include 'inc/'.$_SESSION['rel'].'.php';
        }
        echo "</div></div>";
    ?>
</body>
</html>