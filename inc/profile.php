<div>My Profile</div>
<?php 
if (isset($_SESSION['code'])) {
    echo "<notice id='notification' class='". $_SESSION['code'] ."'>". $_SESSION['msg']."</notice>";
    unset($_SESSION['code']);
}
?>
<br>
<?php if ($spersonal != "") :?>
<?php if ($srole == "Student") :?>
<article>
<details name="Status" class='accordion' open>
  <summary>Personal Information</summary>
  <?php 
    $getdetails = mysqli_query($connect,"SELECT * FROM tblStudents WHERE account_username = '$suser'");
    $details = mysqli_fetch_array($getdetails);
    if ($spersonal == "") {
        if (strlen($details['student_lrn']) > 1) {
            mysqli_query($connect,"UPDATE tblUserAccounts SET account_user = '".$details['student_lrn']."' WHERE account_username = '$suser'");
        }
        $spersonal = $details['student_lrn'];
    }
  ?>
  <form method="post" action="ssn/savepinfo.php?typ=stud&pid=<?= $details['student_id'] ?>" onsubmit="return confirm('Save made changes?');">
  <?php 
    if (mysqli_num_rows($getdetails) != 0) :
  ?>
    <label>
        Family Name<req>*</req>
        <input type="text" name="p-fname" id="p-fname" maxlength="150" value="<?= urldecode($details['student_surname']) ?>" required>
    </label>  
    <label>
        Given Name<req>*</req>
        <input type="text" name="p-gname" id="p-gname" maxlength="150" value="<?= urldecode($details['student_givenname']) ?>" required>
    </label>  
    <label>
        Middle Name<req>*</req>
        <input type="text" name="p-mname" id="p-mname" maxlength="150" value="<?= urldecode($details['student_middlename']) ?>" required>
    </label>  
    <label>
        Extension (if any)
        <input type="text" name="p-ename" id="p-ename" maxlength="10" value="<?= urldecode($details['student_extname']) ?>">
    </label>  
    <label>
        Date of Birth<req>*</req>
        <input type="date" name="p-dob" id="p-dob" max=<?= date("Y-m-d"); ?> value="<?= $details['student_birthdate'] ?>" required>
    </label>  
    <label>
        Gender<req>*</req>
        <select name="p-gender" id="p-gender" required>
            <optgroup>
                <?php 
                    $getgenders = mysqli_query($connect,"SELECT * FROM tblGenders");
                    while ($genders = mysqli_fetch_array($getgenders)) {
                        $selected = "";
                        $gender = urldecode($genders[0]);
                        if ($gender == $details['student_gender']) {
                            $selected = "selected";
                        }
                        echo "<option value='$gender' $selected>$gender</option>";
                    }
                ?>
            </optgroup>
        </select>
    </label>
    <label>
        Religion<req>*</req>
        <select name="p-religion" id="p-religion" required>
            <optgroup>
                <?php 
                    $getreligions = mysqli_query($connect,"SELECT * FROM tblReligions");
                    while ($religions = mysqli_fetch_array($getreligions)) {
                        $selected = "";
                        $religion = urldecode($religions[0]);
                        if ($religion == $details['student_religion']) {
                            $selected = "selected";
                        }
                        echo "<option value='$religion' $selected>$religion</option>";
                    }
                ?>
            </optgroup>
        </select>
    </label>
    <label>
        Street / Barangay<req>*</req>
        <input type="text" name="p-street" id="p-street" maxlength="200" value="<?= urldecode($details['address_street']) ?>" required>
    </label> 
    <label>
        Municipality / City<req>*</req>
        <input type="text" name="p-city" id="p-city" maxlength="200" value="<?= urldecode($details['address_city']) ?>" required>
    </label> 
    <label>
        Province<req>*</req>
        <input type="text" name="p-province" id="p-province" maxlength="200" value="<?= urldecode($details['address_province']) ?>" required>
    </label> 
    <label>
        Contact Number (09xx)<req>*</req>
        <input type="tel" name="p-cp" id="p-cp" maxlength="11" value="<?= $details['student_cpnumber'] ?>" required>
    </label> 
    <label>
        Email Address
        <input type="email" name="p-email" id="p-email" maxlength="100" value="<?= urldecode($details['student_email']) ?>">
    </label> 
<?php endif; ?>
<input type="submit" class='accordion-button' value="Save Changes">
    </form>
</details>
</article>

<article>
<details name="Status" class='accordion'>
  <summary>Emergency Contact Information</summary>
  <?php 
    $getdetails = mysqli_query($connect,"SELECT * FROM tblStudents WHERE account_username = '$suser'");
    $details = mysqli_fetch_array($getdetails);
  ?>
  <form method="post" action="ssn/savecinfo.php?typ=stud&pid=<?= $details['student_id'] ?>" onsubmit="return confirm('Save made changes?');">
  <?php 
    if (mysqli_num_rows($getdetails) != 0) :
  ?>
    <label>
        Contact Person<req>*</req>
        <input type="text" name="c-name" id="c-name" maxlength="200" value="<?= urldecode($details['contact_person']) ?>" required>
    </label>
    <label>
        Address<req>*</req>
        <input type="text" name="c-addr" id="c-addr" maxlength="500" value="<?= urldecode($details['contact_address']) ?>" required>
    </label> 
    <label>
        Contact Number<req>*</req>
        <input type="tel" name="c-cp" id="c-cp" maxlength="11" value="<?= urldecode($details['contact_number']) ?>" required>
    </label> 
    <label>
        Relationship<req>*</req>
        <select name="c-rel" id="c-rel" required>
            <optgroup>
                <option <?php if ($details['contact_relationship'] == "Parent") { echo "selected"; } ?> value="Parent">Parent</option>
                <option <?php if ($details['contact_relationship'] == "Relative") { echo "selected"; } ?> value="Relative">Relative</option>
                <option <?php if ($details['contact_relationship'] == "Legal+Guardian") { echo "selected"; } ?> value="Legal+Guardian">Legal Guardian</option>
                <option <?php if ($details['contact_relationship'] == "Sibling") { echo "selected"; } ?> value="Sibling">Sibling</option>
                <option <?php if ($details['contact_relationship'] == "Spouse") { echo "selected"; } ?> value="Spouse">Spouse</option>
                <option <?php if ($details['contact_relationship'] == "Son%2FDaughter") { echo "selected"; } ?> value="Son%2FDaughter">Son/Daughter</option>
                <option <?php if ($details['contact_relationship'] == "Others") { echo "selected"; } ?> value="Others">Others</option>
            </optgroup>
        </select>
    </label>
<?php endif; ?>
<input type="submit" class='accordion-button' value="Save Changes">
    </form>
</details>
</article>

<article>
<details name="Status" class='accordion'>
  <summary>Educational Information</summary>
  <?php 
    $getdetails = mysqli_query($connect,"SELECT * FROM tblStudents WHERE account_username = '$suser'");
    $details = mysqli_fetch_array($getdetails);
    $slrn = $details['student_lrn'];
    if ($details['educ_primary'] == "") {
        $slrn = "";
    }
  ?>
  <form method="post" action="ssn/saveeinfo.php?typ=stud&pid=<?= $details['student_id'] ?>" onsubmit="return confirm('Save made changes?');">
  <?php 
    if (mysqli_num_rows($getdetails) != 0) :
  ?>
    <label>
        Learner Reference Number<req>*</req>
        <input type="number" name="e-lrn" id="e-lrn" max="999999999999" value="<?= $slrn ?>" required>
    </label>
    <label>
        Primary School<req>*</req>
        <input type="text" name="e-elem" id="e-elem" maxlength="200" value="<?= urldecode($details['educ_primary']) ?>" required>
    </label> 
    <label>
        Year Graduated<req>*</req>
        <input type="number" name="e-elemyr" id="e-elemyr" min="1950" max="2025" value="<?= $details['educ_primary_year'] ?>" required>
    </label>
    <label>
        Junior High School<req>*</req>
        <input type="text" name="e-jhs" id="e-jhs" maxlength="200" value="<?= urldecode($details['educ_jhs']) ?>" required>
    </label> 
    <label>
        Year Graduated<req>*</req>
        <input type="number" name="e-jhsyr" id="e-jhsyr"  min="1950" max="2025" value="<?= $details['educ_jhs_year'] ?>" required>
    </label>
    <label>
        Final Average<req>*</req>
        <input type="number" name="e-ave" id="e-ave" max="100.00" step="0.01" value="<?= $details['educ_jhs_grade'] ?>" required>
    </label>
<?php endif; ?>
<input type="submit" class='accordion-button' value="Save Changes">
    </form>
</details>
</article>
<?php else: ?>

<article>
<details name="Status" class='accordion' open>
  <summary>Personal Information</summary>
  <?php 
    $getdetails = mysqli_query($connect,"SELECT * FROM tblEmployees WHERE account_username = '$suser'");
    $details = mysqli_fetch_array($getdetails);
    $empid = urldecode($details['employee_id']);
    if ($spersonal == "") {
        if (strlen($details['employee_id']) > 1) {
            mysqli_query($connect,"UPDATE tblUserAccounts SET account_user = '".$details['employee_id']."' WHERE account_username = '$suser'");
        }
        $spersonal = $details['employee_id'];
    }
    if ($details['employee_surname'] == "") {
        $empid = "";
    }
  ?>
  <form method="post" action="ssn/savepinfo.php?typ=emp&pid=<?= $details['employee_numid'] ?>" onsubmit="return confirm('Save made changes?');">
  <?php 
    if (mysqli_num_rows($getdetails) != 0) :
  ?>
    <label>
        Employee ID<req>*</req>
        <input type="text" name="e-id" id="e-id" maxlength="20" value="<?= $empid ?>" required>
    </label> 
    <label>
        Family Name<req>*</req>
        <input type="text" name="e-fname" id="e-fname" maxlength="150" value="<?= urldecode($details['employee_surname']) ?>" required>
    </label>  
    <label>
        Given Name<req>*</req>
        <input type="text" name="e-gname" id="e-gname" maxlength="150" value="<?= urldecode($details['employee_givenname']) ?>" required>
    </label>  
    <label>
        Middle Name<req>*</req>
        <input type="text" name="e-mname" id="e-mname" maxlength="150" value="<?= urldecode($details['employee_middlename']) ?>" required>
    </label>  
    <label>
        Extension (if any)
        <input type="text" name="e-ename" id="e-ename" maxlength="10" value="<?= urldecode($details['employee_extname']) ?>">
    </label>  
    <label>
        Date of Birth<req>*</req>
        <input type="date" name="e-dob" id="e-dob" max=<?= date("Y-m-d"); ?> value="<?= $details['employee_birthdate'] ?>" required>
    </label>  
    <label>
        Gender<req>*</req>
        <select name="e-gender" id="e-gender" required>
            <optgroup>
                <?php 
                    $getgenders = mysqli_query($connect,"SELECT * FROM tblGenders");
                    while ($genders = mysqli_fetch_array($getgenders)) {
                        $selected = "";
                        $gender = urldecode($genders[0]);
                        if ($gender == $details['employee_gender']) {
                            $selected = "selected";
                        }
                        echo "<option value='$gender' $selected>$gender</option>";
                    }
                ?>
            </optgroup>
        </select>
    </label>
    <label>
        Religion<req>*</req>
        <select name="e-religion" id="e-religion" required>
            <optgroup>
                <?php 
                    $getreligions = mysqli_query($connect,"SELECT * FROM tblReligions");
                    while ($religions = mysqli_fetch_array($getreligions)) {
                        $selected = "";
                        $religion = urldecode($religions[0]);
                        if ($religion == $details['employee_religion']) {
                            $selected = "selected";
                        }
                        echo "<option value='$religion' $selected>$religion</option>";
                    }
                ?>
            </optgroup>
        </select>
    </label>
    <label>
        Street / Barangay<req>*</req>
        <input type="text" name="e-street" id="e-street" maxlength="200" value="<?= urldecode($details['address_street']) ?>" required>
    </label> 
    <label>
        Municipality / City<req>*</req>
        <input type="text" name="e-city" id="e-city" maxlength="200" value="<?= urldecode($details['address_city']) ?>" required>
    </label> 
    <label>
        Province<req>*</req>
        <input type="text" name="e-province" id="e-province" maxlength="200" value="<?= urldecode($details['address_province']) ?>" required>
    </label> 
    <label>
        Contact Number (09xx)<req>*</req>
        <input type="tel" name="e-cp" id="e-cp" maxlength="11" value="<?= $details['employee_cp'] ?>" required>
    </label> 
    <label>
        Email Address<req>*</req>
        <input type="email" name="e-email" id="e-email" maxlength="100" value="<?= urldecode($details['employee_email']) ?>" required>
    </label> 
    <label>
        Designation<req>*</req>
        <input type="text" name="e-designation" id="e-designation" maxlength="200" value="<?= urldecode($details['employee_designation']) ?>" required>
    </label> 
<?php endif; ?>
<input type="submit" class='accordion-button' value="Save Changes">
    </form>
</details>
</article>

<?php endif; ?>
<?php else: ?>
<article>
    <summary>Account Status</summary>
    <div>Your account is currently under </div>
</article>
<?php endif; ?>

<article>
<details name="Status" class='accordion'>
  <summary>Account Information</summary>
  <?php 
    $getdetails = mysqli_query($connect,"SELECT * FROM tblUserAccounts WHERE account_username = '$suser'");
    $details = mysqli_fetch_array($getdetails);
  ?>
  <?php 
    if (mysqli_num_rows($getdetails) != 0) :
  ?>
    <label>
        Username
        <input type="text" value="<?= urldecode($details['account_username']) ?>" disabled>
    </label>
    <label>
        Password
        <input type="text" value="<?= openssl_decrypt(urldecode($details['account_password']), $ciphering,$encryption_key, $options, $encryption_iv) ?>" disabled>
    </label>
    <label>
        Role
        <input type="text" value="<?= urldecode($details['user_role']) ?>" disabled>
    </label>
    <?php if (str_contains($details['permission_rights'],"A")) : ?>
    <label>
        Permission
        <input type="text" value="<?= urldecode($details['permission_rights']) ?>" disabled>
    </label>
    <?php endif; ?>
<?php endif; ?>
</details>
</article>
    <input type="button" value="Sign Out" onclick="if (confirm('Are you sure?') == true) {goTo('ssn/signout.php')}">