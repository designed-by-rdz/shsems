<div>Students for Evaluation</div>
<?php 
if (isset($_SESSION['code'])) {
    echo "<notice id='notification' class='". $_SESSION['code'] ."'>". $_SESSION['msg']."</notice>";
    unset($_SESSION['code']);
}
$getdetails = mysqli_query($connect,"SELECT * FROM tblEmployees WHERE account_username = '$suser'");
$details = mysqli_fetch_array($getdetails);
if ($details['employee_surname'] == "") {
    $_SESSION['msg'] = "Complete profile information first!";
    $_SESSION['code'] = "error";
    header("location:ssn/bridge.php?rel=profile");   
    return;
}
?>
<br>
<article>
<div class="flex-horizontal">
    <div>Current Academic Year: <?= $data['ay'] ?></div>
    <div>Current Semester: <?= $data['sem'] ?></div>
</div>
</article>


<article>
<details name="Pending" class='accordion' open>
    <?php
        $getpendingstuds = mysqli_query($connect,"SELECT * FROM tblEnrollment INNER JOIN tblStudents ON tblStudents.student_lrn = tblEnrollment.student_lrn WHERE $current AND enrollment_status = 'PENDING' ORDER BY student_surname");
        $count = mysqli_num_rows($getpendingstuds);
    ?>
  <summary>Students Pending Evaluation - <?= $count ?></summary>
  <?php 
    if (mysqli_num_rows($getpendingstuds) != 0) :
  ?>
  <input type="search" name="search" id="searchbox" placeholder="Search by Name"  oninput='searchTable()' placeholder="Search"/>
  <div class="table-container"><table class="striped">
  <thead><tr><th scope="col">Student LRN</th><th scope="col">Name</th><th scope="col">Strand</th><th scope="col">Grade Level</th><th scope="col">Submission Date</th><th scope="col">Actions</th></tr></thead>
  <tbody>
    <?php while ($pendingstuds = mysqli_fetch_array($getpendingstuds)) : 
        $ext = $pendingstuds['student_extname'];
        if ($ext != "") {
            $ext = $ext . " ";
        }
        $fullname = $pendingstuds['student_surname'] . ", " . $pendingstuds['student_givenname'] . " " . $ext . $pendingstuds['student_middlename'];
        $fullname = urldecode($fullname);
        $edata = explode("|",urldecode($pendingstuds['enrollment_data']));
        $strand = $edata[0];
        $grade = $edata[1];
    ?>
    <tr class="row-selection"><th scope="row"><?= urldecode($pendingstuds['student_lrn']) ?></th><td class="row-unique"><?= $fullname ?></td><td><?= $strand ?></td><td><?= $grade ?></td><td><?= urldecode($pendingstuds['enrollment_date']) ?></td>
    <td><span class='table-button material-icons' title='View' onclick="viewStudent('<?= implode(';',$pendingstuds) ?>')">visibility</span>
    <span class='table-button material-icons' title='Approve' onclick="if (confirm('Are you sure?') == true) {goTo('ssn/okeval.php?eid=<?= $pendingstuds['enrollment_id'] ?>&lrn=<?= $pendingstuds['student_lrn'] ?>')}">check</span>
    <span class='table-button material-icons' title='Set Remarks' onclick="viewRemarks('<?= implode(';',$pendingstuds) ?>')">bookmark_add</span>
    </td>
    </tr>
    <?php endwhile;?>
  </tbody>
  </table></div>
<?php else: ?>
    <p>Nothing to show.</p>
<?php endif; ?>
</details>
</article>


<article>
<details name="Pending" class='accordion'>
    <?php     
        $getstuds = mysqli_query($connect,"SELECT * FROM tblEnrollment INNER JOIN tblStudents ON tblStudents.student_lrn = tblEnrollment.student_lrn WHERE enrollment_status != 'PENDING' AND evaluator_id = '$suser' ORDER BY evaluator_date DESC, student_surname");
        $count = mysqli_num_rows($getstuds);
    ?>
  <summary>Student Enrollments Evaluated - <?= $count ?></summary>
  <?php 
    if (mysqli_num_rows($getstuds) != 0) :
  ?>
  <input type="search" name="search" id="searchbox" placeholder="Search by Name"  oninput='searchTable()' placeholder="Search"/>
  <div class="table-container"><table class="striped">
  <thead><tr><th scope="col">Student LRN</th><th scope="col">Name</th><th scope="col">Strand</th><th scope="col">Grade Level</th><th scope="col">Evaluation Date</th><th scope="col">Actions</th></tr></thead>
  <tbody>
    <?php while ($studs = mysqli_fetch_array($getstuds)) : 
        $ext = $studs['student_extname'];
        if ($ext != "") {
            $ext = $ext . " ";
        }
        $fullname = $studs['student_surname'] . ", " . $studs['student_givenname'] . " " . $ext . $studs['student_middlename'];
        $fullname = urldecode($fullname);
        if (str_contains(urldecode($studs['enrollment_data']),"|")) {
            $edata = explode("|",$studs['enrollment_data']);
            $strand = $edata[0];
            $grade = $edata[1];
        } else {
            $strand = urldecode($studs['enrollment_data']);
            $grade = "";
        }
    ?>
    <tr class="row-selection"><th scope="row"><?= urldecode($studs['student_lrn']) ?></th><td class="row-unique"><?= $fullname ?></td><td><?= $strand ?></td><td><?= $grade ?></td><td><?= urldecode($studs['evaluator_date']) ?></td>
    <td><span class='table-button material-icons' title='View' onclick="viewStudent('<?= implode(';',$studs) ?>')">visibility</span>
    </td>
    </tr>
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
        <div>Student LRN: <span id='s-lrn'></span></div>
        <div>Name: <span id='s-name'></span></div>
        <div>Date of Birth: <span id='s-dob'></span></div>
        <div>Gender: <span id='s-gender'></span></div>
        <div>Address: <span id='s-addr'></span></div>
        <div>Contact Number: <span id='s-cp'></span></div>
        <div><span id='s-strand'></span></div>
        <div><span id='s-grade'></span></div>
        <!-- 
        <div>Junior High School: <span id='s-jhs'></span></div>
        <div>Year Graduated: <span id='s-jhsyr'></span></div>
        <div>Final Average: <span id='s-jhsgrd'></span></div>
         -->
        <div>Status: <span id='s-stax'></span></div>
        <div>Remarks: <span id='s-rem'></span></div><br>
        <div><span id='s-date'></span></div><br>
        <input type="button" value="Download Documentary Requirements" id="s-files">
    </div>
    <div class='modal-content' id='student-remarks'>
        <form method="post" action="ssn/addevalremarks.php" onsubmit="return confirm('Save made changes?');">
            <label>
                Student LRN<req>*</req>
                <input type="text" maxlength="12" id="rv-lrn" disabled>
                <input type="text" name="r-lrn" id="r-lrn" maxlength="12" readonly hidden>
                <input type="text" name="r-eid" id="r-eid" readonly hidden>
                <input type="text" name="r-user" id="r-user" value="<?= $srole; ?>" readonly hidden>
            </label>   
            <label>
                Name<req>*</req>
                <input type="text" maxlength="460" id="rv-name" disabled>
            </label>   
            <label>
                Remarks
                <input type="text" name="r-rem" id="r-rem" maxlength="100">
                <div class="flag-container">
                <?php 
                    $getflags = mysqli_query($connect,"SELECT * FROM tblFlags");
                    while ($flags = mysqli_fetch_array($getflags)) :
                ?>
                <span class="flags" onclick="getFlag('<?= $flags['flag_code'] ?>')"><?= $flags['flag_code'] ?></span>
                <?php endwhile; ?>
                </div>
            </label> 
            <input type="submit" value="Update Remarks">
        </form>
    </div>
  </article>
</dialog>

<script>
function viewStudent(params) {
    //we need to inject sections in the sql code used here...
    viewModal('student-details');
    params = decodeCustomURL(params);
    var values = params.split(";");
    document.getElementById('s-lrn').innerText = values[2];
    var ext = values[34];
    if (ext.length != 0) {
        ext = ext + " ";
    }
    var educ = values[4];
    var strand = "";
    var grade = "";
    if (educ.includes("|")) {
        strand = "Strand: "+ educ.split("|")[0];
        grade = "Grade Level: " + educ.split("|")[1];
    } else {
        strand = "Strand and Grade Level: " + values[4];
    }
    var fullname = values[28] + ", " + values[30] + " " + ext + values[32];
    document.getElementById('s-name').innerText = fullname;
    document.getElementById('s-dob').innerText = values[40];
    document.getElementById('s-gender').innerText = values[36];
    document.getElementById('s-addr').innerText = values[42] + ", " + values[44] + ", " + values[46];
    document.getElementById('s-cp').innerText = values[48];
    document.getElementById('s-strand').innerText = strand;
    document.getElementById('s-grade').innerText = grade;
    document.getElementById('s-rem').innerText = values[14];
    document.getElementById('s-stax').innerText = values[12];
    if (values[12] == "PENDING") {
        document.getElementById('s-date').innerText = "Submission Date: " + values[10];
    } else {
        document.getElementById('s-date').innerText = "Evaluation Date: " + values[18];
    }
    // document.getElementById('s-jhs').innerText = values[64];
    // document.getElementById('s-jhsyr').innerText = values[66];
    // document.getElementById('s-jhsgrd').innerText = values[68];
    document.getElementById('s-files').onclick = function() {
        window.location.href = "ssn/createzip.php?rel=" + values[2] + values[6] + values[8];
    };
}
function viewRemarks(params) {
    viewModal('student-remarks');
    params = decodeCustomURL(params);
    var values = params.split(";");
    var ext = values[34];
    if (ext.length != 0) {
        ext = ext + " ";
    }
    var fullname = values[28] + ", " + values[30] + " " + ext + values[32];
    document.getElementById('r-eid').value = values[0];
    document.getElementById('r-lrn').value = values[2];
    document.getElementById('rv-lrn').value = values[2];
    document.getElementById('rv-name').value = fullname;
    document.getElementById('r-rem').value = values[14];
}
function viewModal(shown) {
    document.getElementById('modal').open = true;
    document.getElementById('student-details').style.display = "none";
    document.getElementById('student-remarks').style.display = "none";
    document.getElementById(shown).style.display = "block";
}
function getFlag(flag) {
    var remark = document.getElementById('r-rem');
    if (remark.value.includes(flag) == false) {
        if (remark.value.trim() == "") {
            remark.value = flag;
        } else {
            remark.value += ", " + flag;
        }
    }
}
</script>