<?php
    $suser = $_SESSION['uid'];
    $getaccountdetails = mysqli_query($connect,"SELECT * FROM tblUserAccounts WHERE account_username = '$suser'");
    $accountdetails = mysqli_fetch_array($getaccountdetails);
    $srole = urldecode($accountdetails['user_role']);
    $spermission = $accountdetails['permission_rights'];
    $spersonal = urldecode($accountdetails['account_user']); #get the details of user after, segregate by type kai different db
?>
<div class="header">
    <div class="header-objects">
        <div class="header-buttons" onclick="goTo('ssn/bridge.php?rel=index')">
            <img src="img/logo.png" class="logo-header">
            <span class="logo-banner"><?= urldecode($data['school']) ?></span>
        </div>
        <div class="header-buttons">
            <input type="button" value="Home" onclick="goTo('ssn/bridge.php?rel=index')">
            <?php if ($srole != "Student") : ?>
            <input type="button" value="Students" onclick="goTo('ssn/bridge.php?rel=students')">
            <?php endif; ?>
            <?php if ($srole == "Administrator") : ?>
            <input type="button" value="Faculty" onclick="goTo('ssn/bridge.php?rel=faculty')">
            <input type="button" value="Strands" onclick="goTo('ssn/bridge.php?rel=strands')">
            <input type="button" value="Accounts" onclick="goTo('ssn/bridge.php?rel=users')">
            <?php if (str_contains($spermission,"A")) : ?>
            <input type="button" value="Settings" onclick="goTo('ssn/bridge.php?rel=settings')">
            <input type="button" value="Logs" onclick="goTo('ssn/bridge.php?rel=logs')">
            <?php endif; ?>
            <?php endif; ?>
            <?php if ($srole == "Student") : ?>
            <input type="button" value="Enrollment" onclick="goTo('ssn/bridge.php?rel=register')">
            <input type="button" value="Assessment" onclick="goTo('ssn/bridge.php?rel=exam')">
            <?php endif; ?>
        </div>
        <div class="header-buttons">
        <input type="button" value='My Profile' onclick="goTo('ssn/bridge.php?rel=profile')">
        </div>
        <!-- <img src="img/portrait.png" class="logo-header" onmouseenter="document.getElementById('submenu').style.display='flex'"> -->
    </div>
<div class="submenu" id='submenu' style="display:none" onmouseleave="this.style.display='none'" onclick="this.style.display='none'">
    <input type="button" value='<?= $suser ?>' onclick="goTo('ssn/bridge.php?rel=profile')">
    <input type="button" value="Logout" onclick="goTo('ssn/signout.php')">
</div>
</div>