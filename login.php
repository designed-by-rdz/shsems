<!DOCTYPE html>
<?php 
    include 'con/con.php';
?>
<html lang="en" style="height:100%">
<head>
    <title><?= urldecode($data['school']) ?> | SHSEMS Sign In</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="img/logo.png">
    <link rel="stylesheet" type="text/css" href="css/pico.classless.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/icon.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body style="height:100%">
    <back>
        <card style="scale:0.9">
            <img src="img/logo.png" class="logo-card">
            <h1><?= urldecode($data['school']) ?></h1> 
            <h3>Sign In</h3>
            <form method="post" action="ssn/signin.php">
                <?php 
                    if (isset($_SESSION['code'])) {
                        echo "<notice id='notification' class='". $_SESSION['code'] ."'>". $_SESSION['msg']."</notice>";
                        unset($_SESSION['code']);
                    }
                ?>
                <label>
                    Username
                    <input type="text" name="l-sign" id="l-sign" maxlength="100" required>
                </label>   
                <label>
                    Password
                    <input type="password" name="l-pass" id="l-pass" maxlength="100" required>
                </label>   
                <label>
                    User Type
                    <select name="l-type" id="l-type" required>
                        <optgroup>
                            <?php 
                                $gettypes = mysqli_query($connect,"SELECT * FROM tblRoles ORDER BY role_code DESC");
                                while ($types = mysqli_fetch_array($gettypes)) {
                                    $type = $types[0];
                                    echo "<option value='$type'>$type</option>";
                                }
                            ?>
                        </optgroup>
                    </select>
                </label>
                <input type="submit" value="Sign In">
            </form>
            <div>Don't have an account? <a href="register.php">Create an Account</a></div>
            <div><a onclick="alert('coming soon!')">Forgot Password?</a></div>
        </card>
    </back>
</body>
<script src="js/script.js"></script>
</html>
