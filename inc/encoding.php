<div>Students for Encoding</div>
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
    $getpendingstuds = mysqli_query($connect,"SELECT * FROM tblEnrollment INNER JOIN tblStudents ON tblStudents.student_lrn = tblEnrollment.student_lrn WHERE $current AND enrollment_status = 'EVALUATED' ORDER BY student_surname");
    $count = mysqli_num_rows($getpendingstuds);
  ?>
  <summary>Students Pending Encoding - <?= $count ?></summary>
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
    <span class='table-button material-icons' title='Enroll' onclick="viewSections('<?= implode(';',$pendingstuds) ?>')">check</span>
    <!-- <span class='table-button material-icons' title='Set Remarks' onclick="viewRemarks('<?= implode(';',$pendingstuds) ?>')">bookmark_add</span> -->
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
      $getstuds = mysqli_query($connect,"SELECT * FROM tblEnrollment INNER JOIN tblStudents ON tblStudents.student_lrn = tblEnrollment.student_lrn INNER JOIN tblSections ON tblSections.section_id = tblEnrollment.enrollment_data WHERE enrollment_status = 'ENROLLED' AND encoder_id = '$suser' ORDER BY encoder_date DESC, student_surname;");
      $count = mysqli_num_rows($getstuds);
  ?>
  <summary>Student Enrollments Encoded - <?= $count ?></summary>
  <?php 
    if (mysqli_num_rows($getstuds) != 0) :
  ?>
  <input type="search" name="search" id="searchbox" placeholder="Search by Name"  oninput='searchTable()' placeholder="Search"/>
  <div class="table-container"><table class="striped">
  <thead><tr><th scope="col">Student LRN</th><th scope="col">Name</th><th scope="col">Strand</th><th scope="col">Grade Level</th><th scope="col">Section</th><th scope="col">Encoded Date</th><th scope="col">Actions</th></tr></thead>
  <tbody>
    <?php while ($studs = mysqli_fetch_array($getstuds)) : 
        $ext = $studs['student_extname'];
        if ($ext != "") {
            $ext = $ext . " ";
        }
        $fullname = $studs['student_surname'] . ", " . $studs['student_givenname'] . " " . $ext . $studs['student_middlename'];
        $fullname = urldecode($fullname);
            //get from the strand section table
        $strand = $studs['section_strand'];
        $grade = $studs['section_grade'];
        $section = $studs['section_name'];
    ?>
    <tr class="row-selection"><th scope="row"><?= urldecode($studs['student_lrn']) ?></th><td class="row-unique"><?= $fullname ?></td><td><?= $strand ?></td><td><?= $grade ?></td><td><?= $section ?></td><td><?= urldecode($studs['encoder_date']) ?></td>
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
        <div>Strand: <span id='s-strand'></span></div>
        <div>Grade Level: <span id='s-grade'></span></div>
        <!-- 
        <div>Junior High School: <span id='s-jhs'></span></div>
        <div>Year Graduated: <span id='s-jhsyr'></span></div>
        <div>Final Average: <span id='s-jhsgrd'></span></div>
         -->
        <div>Remarks: <span id='s-rem'></span></div>
        <div><span id='s-date'></span></div>
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
            </label> 
            <input type="submit" value="Update Remarks">
        </form>
    </div>
    <div class='modal-content' id='student-enroll'>
        <form method="post" action="ssn/enrollstudent.php" onsubmit="return confirm('Enroll the student?');">
            <label>
                Student LRN<req>*</req>
                <input type="text" maxlength="12" id="ev-lrn" disabled>
                <input type="text" name="e-lrn" id="e-lrn" maxlength="12" readonly hidden>
                <input type="text" name="e-eid" id="e-eid" readonly hidden>
            </label>   
            <label>
                Name<req>*</req>
                <input type="text" maxlength="460" id="ev-name" disabled>
            </label>   
            <label>
                Strand<req>*</req>
                <input type="text" maxlength="200" id="ev-strand" disabled>
                <input type="text" name="e-strand" id="e-strand" maxlength="200" readonly hidden>
            </label>   
            <label>
                Grade Level<req>*</req>
                <input type="text" maxlength="2" id="e-grade" disabled>
                <input type="text" name="e-grade" id="e-grade" maxlength="2" readonly hidden>
            </label>   
            <label>
                Section<req>*</req>
                <select name="e-section" id="e-section" required>
                    <optgroup>
                        <?php 
                            $getsections = mysqli_query($connect,"SELECT * FROM tblSections ORDER BY section_strand, section_name");
                            while ($sections = mysqli_fetch_array($getsections)) {
                                $section = urldecode($sections[0]);
                                $strandname = urldecode($sections[1]);
                                $sectionname = urldecode($sections[2]);
                                $sectiongrade = urldecode($sections[3]);
                                $sectionmaxcount = urldecode($sections[4]);
                                $getcurrentnumber = mysqli_query($connect,"SELECT * FROM tblEnrollment WHERE $current AND enrollment_data = '$section'");
                                $currentnumber = mysqli_num_rows($getcurrentnumber);
                                if ($currentnumber < intval($sectionmaxcount)) {
                                  echo "<option class='section-list $strandname| $sectiongrade|' value='$section'>$sectionname ($currentnumber/$sectionmaxcount students enrolled)</option>";
                                }
                            }
                        ?>
                    </optgroup>
                </select>
            </label>
            <input type="submit" value="Enroll Student">
        </form>
    </div>
  </article>
</dialog>

<script>
function viewStudent(params) {
    viewModal('student-details');
    params = decodeCustomURL(params);
    var values = params.split(";");
    document.getElementById('s-lrn').innerText = values[2];
    var educ = values[4];
    var strand = "";
    var grade = "";
    if (educ.includes("|")) {
        strand = educ.split("|")[0];
        grade = educ.split("|")[1];
    } else {
        strand = values[74];
        grade = values[78] + "     Section: " + values[76];
    }
    var ext = values[34];
    if (ext.length != 0) {
        ext = ext + " ";
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
    if (values[12] == "EVALUATED") {
        document.getElementById('s-date').innerText = "Evaluation Date: " + values[18];
    } else {
        document.getElementById('s-date').innerText = "Enrollment Date: " + values[10];
    }
    // document.getElementById('s-jhs').innerText = values[2];
    // document.getElementById('s-jhsyr').innerText = values[2];
    // document.getElementById('s-jhsgrd').innerText = values[2];
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
function viewSections(params) {
    viewModal('student-enroll');
    params = decodeCustomURL(params);
    var values = params.split(";");
    strand = values[4].split("|")[0];
    grade = values[4].split("|")[1];
    var ext = values[34];
    if (ext.length != 0) {
        ext = ext + " ";
    }
    var fullname = values[28] + ", " + values[30] + " " + ext + values[32];
    document.getElementById('e-eid').value = values[0];
    document.getElementById('e-lrn').value = values[2];
    document.getElementById('ev-lrn').value = values[2];
    document.getElementById('ev-name').value = fullname;
    document.getElementById('ev-strand').value = strand;
    document.getElementById('e-strand').value = strand;
    document.getElementById('e-grade').value = grade;
    document.getElementById('e-section').selectedIndex = -1;
    hideSections(strand, grade);
}
function viewModal(shown) {
    document.getElementById('modal').open = true;
    document.getElementById('student-details').style.display = "none";
    document.getElementById('student-remarks').style.display = "none";
    document.getElementById('student-enroll').style.display = "none";
    document.getElementById(shown).style.display = "block";
}
function hideSections(strand, grade) {
    let rows = document.querySelectorAll(".section-list");
    for (var i = 0; i < rows.length; i++) {
        if(rows[i].classList.value.includes(strand+"|") && rows[i].classList.value.includes(grade+"|")) {
            rows[i].classList.remove("is-hidden");
        } else {
            rows[i].classList.add("is-hidden");
        }
    } //don another one for grade level too
}
</script>