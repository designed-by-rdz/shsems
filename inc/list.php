<div>Students</div>
<?php 
if (isset($_SESSION['code'])) {
    echo "<notice id='notification' class='". $_SESSION['code'] ."'>". $_SESSION['msg']."</notice>";
    unset($_SESSION['code']);
}
?>
<br>
<article>
  <?php 
    $getstudents = mysqli_query($connect,"SELECT * FROM tblStudents INNER JOIN tblEnrollment ON tblEnrollment.student_lrn = tblStudents.student_lrn WHERE $current AND student_surname != '' ORDER BY student_surname");
    $count = mysqli_num_rows($getstudents);
  ?>
  <summary>Current - <?= $count ?></summary><br>
  <?php 
    if (mysqli_num_rows($getstudents) != 0) :
  ?>
  <input type="search" name="search" id="searchbox" placeholder="Search by Name"  oninput='searchTable()' placeholder="Search"/>
  <div class="table-container"><table class="striped">
  <thead><tr><th scope="col">Student LRN</th><th scope="col">Name</th><th scope="col">Strand and Grade Level</th><th scope="col">Status</th><th scope="col">Actions</th></tr></thead>
  <tbody>
    <?php while ($students = mysqli_fetch_array($getstudents)) : 
        $ext = $students['student_extname'];
        if ($ext != "") {
            $ext = $ext . " ";
        }
        $fullname = $students['student_surname'] . ", " . $students['student_givenname'] . " " . $ext . $students['student_middlename'];
        $fullname = urldecode($fullname);
        if (str_contains(urldecode($students['enrollment_data']),"|")) {
            $edata = explode("|",$students['enrollment_data']);
            $strand = $edata[0] . " - " . $edata[1];
        } else {
            $strand = urldecode($students['enrollment_data']);
        }
    ?>
    <tr class="row-selection"><th scope="row"><?= urldecode($students['student_lrn']) ?></th><td class="row-unique"><?= $fullname ?></td><td><?= $strand ?></td><td><?= urldecode($students['enrollment_status']) ?></td>
    <td><span class='table-button material-icons' title='View' onclick="viewAccount('<?= implode(';',$students) ?>')">visibility</span>
    <?php if (str_contains($spermission,"W")) : ?>
    <span class='table-button material-icons' title='Edit Personal Information' onclick="viewEditPersonal('<?= implode(';',$students) ?>')">edit_document</span>
    <span class='table-button material-icons' title='Edit Emergency Contact Information' onclick="viewEditEmergency('<?= implode(';',$students) ?>')">edit_notifications</span>
    <span class='table-button material-icons' title='Edit Educational Information' onclick="viewEditEducational('<?= implode(';',$students) ?>')">edit_note</span>
    <!-- <span class='table-button delete material-icons' title='Delete' onclick="goTo('ssn/delete.php?rel=list&tbl=tblStudents&mid=student_id&typ=int&val=<?= $students['student_id'] ?>')">close</span> -->
    <?php endif; ?>
    </td>
    </tr>
    <?php endwhile;?>
  </tbody>
  </table></div>
<?php else: ?>
    <p>Nothing to show.</p>
<?php endif; ?>
</article>

<article>
<details name="Status" class='accordion'>
  <?php 
    $getstudents = mysqli_query($connect,"SELECT * FROM tblStudents LEFT JOIN tblEnrollment ON tblEnrollment.student_lrn = tblStudents.student_lrn WHERE student_surname != '' ORDER BY student_surname, enrollment_date DESC");
    $count = mysqli_num_rows($getstudents);
  ?>
  <summary>All Students
     <!-- - <?= $count ?> -->
    </summary>
  <?php 
    if (mysqli_num_rows($getstudents) != 0) :
      $lastlrn = "";
  ?>
  <input type="search" name="search" id="searchbox" placeholder="Search by Name"  oninput='searchTable()' placeholder="Search"/>
  <div class="table-container"><table class="striped">
  <thead><tr><th scope="col">Student LRN</th><th scope="col">Name</th><th scope="col">Last Attended</th><th scope="col">Academic Year and Semester</th><th scope="col">Actions</th></tr></thead>
  <tbody>
    <?php while ($students = mysqli_fetch_array($getstudents)) : 
        $ext = $students['student_extname'];
        if ($ext != "") {
            $ext = $ext . " ";
        }
        $fullname = $students['student_surname'] . ", " . $students['student_givenname'] . " " . $ext . $students['student_middlename'];
        $fullname = urldecode($fullname);
        if (str_contains(urldecode($students['enrollment_data']),"|")) {
            $edata = explode("|",$students['enrollment_data']);
            $strand = $edata[0] . " - " . $edata[1];
        } else {
            $strand = urldecode($students['enrollment_data']);
        }
        $acadsem = "1st Sem";
        if ($students['academic_sem'] == "2") {
          $acadsem = "2nd Sem";
        } elseif ($students['academic_sem'] == "3") {
          $acadsem = "Summer";
        }
        $acadyr = $acadsem . " " . $students['academic_year'];
        if ($students['enrollment_status'] != "ENROLLED") {
          $strand = "Not Enrolled";
        }
        $lrn = $students['student_lrn'];
        if ($lastlrn != $lrn) :
    ?>
    <tr class="row-selection"><th scope="row"><?= urldecode($students['student_lrn']) ?></th><td class="row-unique"><?= $fullname ?></td><td><?= $strand ?></td><td><?= $acadyr ?></td>
    <td><span class='table-button material-icons' title='View' onclick="viewAccount('<?= implode(';',$students) ?>')">visibility</span>
    <?php if (str_contains($spermission,"W")) : ?>
    <span class='table-button material-icons' title='Edit Personal Information' onclick="viewEditPersonal('<?= implode(';',$students) ?>')">edit_document</span>
    <span class='table-button material-icons' title='Edit Emergency Contact Information' onclick="viewEditEmergency('<?= implode(';',$students) ?>')">edit_notifications</span>
    <span class='table-button material-icons' title='Edit Educational Information' onclick="viewEditEducational('<?= implode(';',$students) ?>')">edit_note</span>
    <!-- <span class='table-button delete material-icons' title='Delete' onclick="goTo('ssn/delete.php?rel=list&tbl=tblStudents&mid=student_id&typ=int&val=<?= $students['student_id'] ?>')">close</span> -->
    <?php endif; ?>
    </td>
    </tr>
    <?php 
      $lastlrn = $lrn;
      endif; 
    ?>
    <?php endwhile;?>
  </tbody>
  </table></div>
<?php else: ?>
    <p>Nothing to show.</p>
<?php endif; ?>
</details>
</article>

<dialog id='modal'>
  <article>
    <header>
      <button aria-label="Close" rel="prev" onclick="document.getElementById('modal').close()"></button>
      <p><strong>Student Details</strong></p>
    </header>
    <div class='modal-content' id='student-details'>
        <div><strong>Personal Information</strong></div>
        <div>Student LRN: <span id='s-id'></span></div>
        <div>Name: <span id='s-name'></span></div>
        <div>Gender: <span id='s-gender'></span></div>
        <div>Religion: <span id='s-religion'></span></div>
        <div>Birthdate: <span id='s-dob'></span></div>
        <div>Address: <span id='s-addr'></span></div>
        <div>Contact Number: <span id='s-cp'></span></div>
        <div>Email Address: <span id='s-email'></span></div>

        <br><div><strong>Emergency Contact Information</strong></div>
        <div>Contact Name: <span id='s-cname'></span></div>
        <div>Contact Number: <span id='s-ccp'></span></div>
        <div>Address: <span id='s-caddr'></span></div>
        <div>Relationship: <span id='s-crel'></span></div>

        <br><div><strong>Educational Information</strong></div>
        <div>Primary School: <span id='s-elem'></span></div>
        <div>Year Graduated: <span id='s-elemyr'></span></div>
        <div>Junior High School: <span id='s-jhs'></span></div>
        <div>Year Graduated: <span id='s-jhsyr'></span></div>
        <div>Final Average: <span id='s-ave'></span></div>
        
        <br><input type="button" value="Download Documentary Requirements" id="s-files">
    </div>
    <div class='modal-content' id='student-edit-personal'>
        <form method="post" action="ssn/updatepstudent.php" onsubmit="return confirm('Save made changes?');">
            <label>
                Learner Reference Number<req>*</req>
                <input type="number" name="pev-lrn" id="pev-lrn" disabled>
                <input type="number" name="pe-lrn" id="pe-lrn" readonly hidden>
                <input type="number" name="pe-id" id="pe-id" readonly hidden>
            </label>
            <label>
                Family Name<req>*</req>
                <input type="text" name="pe-fname" id="pe-fname" maxlength="150" required>
            </label>  
            <label>
                Given Name<req>*</req>
                <input type="text" name="pe-gname" id="pe-gname" maxlength="150" required>
            </label>  
            <label>
                Middle Name<req>*</req>
                <input type="text" name="pe-mname" id="pe-mname" maxlength="150"  required>
            </label>  
            <label>
                Extension (if any)
                <input type="text" name="pe-ename" id="pe-ename" maxlength="10">
            </label>  
            <label>
                Date of Birth<req>*</req>
                <input type="date" name="pe-dob" id="pe-dob" max=<?= date("Y-m-d"); ?> required>
            </label>  
            <label>
                Gender<req>*</req>
                <select name="pe-gender" id="pe-gender" required>
                    <optgroup>
                        <?php 
                            $getgenders = mysqli_query($connect,"SELECT * FROM tblGenders");
                            while ($genders = mysqli_fetch_array($getgenders)) {
                                $gender = urldecode($genders[0]);
                                echo "<option value='$gender'>$gender</option>";
                            }
                        ?>
                    </optgroup>
                </select>
            </label>
            <label>
                Religion<req>*</req>
                <select name="pe-religion" id="pe-religion" required>
                    <optgroup>
                        <?php 
                            $getreligions = mysqli_query($connect,"SELECT * FROM tblReligions");
                            while ($religions = mysqli_fetch_array($getreligions)) {
                                $religion = urldecode($religions[0]);
                                echo "<option value='$religion'>$religion</option>";
                            }
                        ?>
                    </optgroup>
                </select>
            </label>
            <label>
                Street / Barangay<req>*</req>
                <input type="text" name="pe-street" id="pe-street" maxlength="200" required>
            </label> 
            <label>
                Municipality / City<req>*</req>
                <input type="text" name="pe-city" id="pe-city" maxlength="200"  required>
            </label> 
            <label>
                Province<req>*</req>
                <input type="text" name="pe-province" id="pe-province" maxlength="200" required>
            </label> 
            <label>
                Contact Number (09xx)<req>*</req>
                <input type="tel" name="pe-cp" id="pe-cp" maxlength="11" required>
            </label> 
            <label>
                Email Address
                <input type="email" name="pe-email" id="pe-email" maxlength="100" >
            </label> 
            <input type="submit" value="Update Student Personal Details">
        </form>
    </div>
    <div class='modal-content' id='student-edit-emergency'>
        <form method="post" action="ssn/updatecstudent.php" onsubmit="return confirm('Save made changes?');">
            <label>
                Learner Reference Number<req>*</req>
                <input type="number" name="cev-lrn" id="cev-lrn" disabled>
                <input type="number" name="ce-lrn" id="ce-lrn" readonly hidden>
                <input type="number" name="ce-id" id="ce-id" readonly hidden>
            </label>
            <label>
                Full Name<req>*</req>
                <input type="text" name="ce-fname" id="ce-fname" disabled>
            </label>
            <label>
                Contact Person<req>*</req>
                <input type="text" name="ce-name" id="ce-name" maxlength="200" required>
            </label>
            <label>
                Address<req>*</req>
                <input type="text" name="ce-addr" id="ce-addr" maxlength="500" required>
            </label> 
            <label>
                Contact Number<req>*</req>
                <input type="tel" name="ce-cp" id="ce-cp" maxlength="11" required>
            </label> 
            <label>
                Relationship<req>*</req>
                <select name="ce-rel" id="ce-rel" required>
                    <optgroup>
                        <option value="Parent">Parent</option>
                        <option value="Relative">Relative</option>
                        <option value="Legal+Guardian">Legal Guardian</option>
                        <option value="Sibling">Sibling</option>
                        <option value="Spouse">Spouse</option>
                        <option value="Son%2FDaughter">Son/Daughter</option>
                        <option value="Others">Others</option>
                    </optgroup>
                </select>
            </label>
            <input type="submit" value="Update Student Emergency Details">
        </form>
    </div>
    <div class='modal-content' id='student-edit-educational'>
        <form method="post" action="ssn/updateestudent.php" onsubmit="return confirm('Save made changes?');">
            <label>
                Learner Reference Number<req>*</req>
                <input type="number" name="eev-lrn" id="eev-lrn" disabled>
                <input type="number" name="ee-lrn" id="ee-lrn" readonly hidden>
                <input type="number" name="ee-id" id="ee-id" readonly hidden>
            </label>
            <label>
                Full Name<req>*</req>
                <input type="text" name="ee-fname" id="ee-fname" disabled>
            </label>
            <label>
                Primary School<req>*</req>
                <input type="text" name="ee-elem" id="ee-elem" maxlength="200" required>
            </label> 
            <label>
                Year Graduated<req>*</req>
                <input type="number" name="ee-elemyr" id="ee-elemyr" min="1950" max="2025" required>
            </label>
            <label>
                Junior High School<req>*</req>
                <input type="text" name="ee-jhs" id="ee-jhs" maxlength="200" required>
            </label> 
            <label>
                Year Graduated<req>*</req>
                <input type="number" name="ee-jhsyr" id="ee-jhsyr"  min="1950" max="2025" required>
            </label>
            <label>
                Final Average<req>*</req>
                <input type="number" name="ee-ave" id="ee-ave" max="100.00" step="0.01" required>
            </label>
            <input type="submit" value="Update Student Educational Details">
        </form>
    </div>
  </article>
</dialog>

<script>
function viewAccount(params) {
    viewModal('student-details');
    params = decodeCustomURL(params);
    var values = params.split(";");
    document.getElementById('s-id').innerText = values[2];
    var ext = values[10];
    if (ext.length != 0) {
        ext = ext + " ";
    }
    var fullname = values[4] + ", " + values[6] + " " + ext + values[8];
    document.getElementById('s-name').innerText = fullname;
    document.getElementById('s-dob').innerText = values[16];
    document.getElementById('s-gender').innerText = values[12];
    document.getElementById('s-religion').innerText = values[14];
    document.getElementById('s-addr').innerText = values[18] + ", " + values[20] + ", " + values[22];
    document.getElementById('s-cp').innerText = values[24];
    document.getElementById('s-email').innerText = values[26];
    document.getElementById('s-cname').innerText = values[28];
    document.getElementById('s-ccp').innerText = values[30];
    document.getElementById('s-caddr').innerText = values[32];
    document.getElementById('s-crel').innerText = values[34];
    document.getElementById('s-elem').innerText = values[36];
    document.getElementById('s-elemyr').innerText = values[38];
    document.getElementById('s-jhs').innerText = values[40];
    document.getElementById('s-jhsyr').innerText = values[42];
    document.getElementById('s-ave').innerText = values[44];
    
    document.getElementById('s-files').onclick = function() {
        window.location.href = "ssn/createzip.php?rel=" + values[50] + values[54] + values[56];
    };
}
function viewEditPersonal(params){
    viewModal('student-edit-personal');
    params = decodeCustomURL(params);
    var values = params.split(";");
    document.getElementById('pe-id').value = values[0];
    document.getElementById('pe-lrn').value = values[2];
    document.getElementById('pev-lrn').value = values[2];
    document.getElementById('pe-fname').value = values[4];
    document.getElementById('pe-gname').value = values[6];
    document.getElementById('pe-mname').value = values[8];
    document.getElementById('pe-ename').value = values[10];
    document.getElementById('pe-dob').value = values[16];
    document.getElementById('pe-gender').value = values[12];
    document.getElementById('pe-religion').value = values[14];
    document.getElementById('pe-street').value = values[18] ;
    document.getElementById('pe-city').value = values[20];
    document.getElementById('pe-province').value = values[22];
    document.getElementById('pe-cp').value = values[24];
    document.getElementById('pe-email').value = values[26];
}
function viewEditEmergency(params){
    viewModal('student-edit-emergency');
    params = decodeCustomURL(params);
    var values = params.split(";");
    var ext = values[10];
    if (ext.length != 0) {
        ext = ext + " ";
    }
    var fullname = values[4] + ", " + values[6] + " " + ext + values[8];
    document.getElementById('ce-fname').value = fullname;
    document.getElementById('ce-id').value = values[0];
    document.getElementById('ce-lrn').value = values[2];
    document.getElementById('cev-lrn').value = values[2];
    document.getElementById('ce-name').value = values[28];
    document.getElementById('ce-cp').value = values[30];
    document.getElementById('ce-addr').value = values[32];
    document.getElementById('ce-rel').value = values[34];

}
function viewEditEducational(params){
    viewModal('student-edit-educational');
    params = decodeCustomURL(params);
    var values = params.split(";");
    var ext = values[10];
    if (ext.length != 0) {
        ext = ext + " ";
    }
    var fullname = values[4] + ", " + values[6] + " " + ext + values[8];
    document.getElementById('ee-fname').value = fullname;
    document.getElementById('ee-id').value = values[0];
    document.getElementById('ee-lrn').value = values[2];
    document.getElementById('eev-lrn').value = values[2];
    document.getElementById('ee-elem').value = values[36];
    document.getElementById('ee-elemyr').value = values[38];
    document.getElementById('ee-jhs').value = values[40];
    document.getElementById('ee-jhsyr').value = values[42];
    document.getElementById('ee-ave').value = values[44];

}
function viewModal(shown) {
    document.getElementById('modal').open = true;
    document.getElementById('student-details').style.display = "none";
    document.getElementById('student-edit-personal').style.display = "none";
    document.getElementById('student-edit-emergency').style.display = "none";
    document.getElementById('student-edit-educational').style.display = "none";
    document.getElementById(shown).style.display = "block";
}
</script>