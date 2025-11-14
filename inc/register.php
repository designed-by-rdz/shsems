<div>Enrollment</div>
<?php 
if (isset($_SESSION['code'])) {
    echo "<notice id='notification' class='". $_SESSION['code'] ."'>". $_SESSION['msg']."</notice>";
    unset($_SESSION['code']);
}
$getdetails = mysqli_query($connect,"SELECT * FROM tblStudents WHERE account_username = '$suser'");
$details = mysqli_fetch_array($getdetails);
if ($details['student_surname'] == "" || $details['contact_person'] == "" || $details['educ_primary'] == "") {
    $_SESSION['msg'] = "Complete profile information first!";
    $_SESSION['code'] = "error";
    header("location:ssn/bridge.php?rel=profile");   
    return;
}
$ext = $details['student_extname'];
if ($ext != "") {
    $ext = $ext . " ";
}
$fullname = $details['student_surname'] . ", " . $details['student_givenname'] . " " . $ext . $details['student_middlename'];
$fullname = urldecode($fullname);
?>
<br>
<article>
<div class="flex-horizontal">
    <div>Current Academic Year: <?= $data['ay'] ?></div>
    <div>Current Semester: <?= $data['sem'] ?></div>
</div>
<br>
<div><strong>Current Status:</strong></div>
<?php 
    $getcurrentenrolled = mysqli_query($connect,"SELECT * FROM tblEnrollment WHERE $current AND student_lrn = '".$details['student_lrn']."'");
    if (mysqli_num_rows($getcurrentenrolled) == 0) :
?>
    <div>You are not currently enrolled.</div>
    <?php if ($data['available'] == "Yes") : ?>
    <input type="button" value="Enroll Now" onclick="addEnroll()">
    <?php else: ?>
        <div><i>Enrollment is currently closed</i></div>
    <?php endif; ?>
    <?php else: 
        $currentenrolled = mysqli_fetch_array($getcurrentenrolled);
    ?>
    <div><?= urldecode($currentenrolled['enrollment_status']); ?></div>
    <?php 
        if ($currentenrolled['enrollment_flags'] != "") {
            echo "<br><div>Remarks: ".urldecode($currentenrolled['enrollment_flags'])."</div>";
        }
    ?>
    <br>
    <?php 
        if (urldecode($currentenrolled['enrollment_status']) == "ENROLLED") :
    ?>
    <div>Enrolled as: </div>
    <?php 
        $enrolleddata = urldecode($currentenrolled['enrollment_data']);
        $enrolleddata = str_replace("|"," - ",$enrolleddata);
    ?>
    <div><?= $enrolleddata." <i>last ".urldecode($currentenrolled['enrollment_date'])."</i>"; ?></div>
    <br>
    <div>Evaluated By: </div>
    <div><?= urldecode($currentenrolled['evaluator_id'])." <i>last ".urldecode($currentenrolled['evaluator_date'])."</i>"; ?></div><br>
    <div>Encoded By: </div>
    <div><?= urldecode($currentenrolled['encoder_id'])." <i>last ".urldecode($currentenrolled['encoder_date'])."</i>"; ?></div>
    <?php elseif (urldecode($currentenrolled['enrollment_status']) == "EVALUATED"): ?>
        <div>Evaluated as: </div>
    <?php 
        $enrolleddata = urldecode($currentenrolled['enrollment_data']);
        $enrolleddata = str_replace("|"," - ",$enrolleddata);
    ?>
    <div><?= $enrolleddata; ?></div>
    <br>
    <div>Evaluated By: </div>
    <div><?= urldecode($currentenrolled['evaluator_id'])." <i>last ".urldecode($currentenrolled['evaluator_date'])."</i>"; ?></div>
    <?php else: ?>
            <div>Enrolling as: </div>
    <?php 
        $enrolleddata = urldecode($currentenrolled['enrollment_data']);
        $enrolleddata = str_replace("|"," - ",$enrolleddata);
    ?>
    <div><?= $enrolleddata; ?></div>
    <?php endif; ?>
<?php endif; ?>
</article>

<article>
    <?php      
        $getEnrolled = mysqli_query($connect,"SELECT * FROM tblEnrollment WHERE student_lrn = '".$details['student_lrn']."'");
        $count = mysqli_num_rows($getEnrolled);
    ?>
    <summary>All Enrollment - <?= $count; ?></summary><br>
  <?php 
    if (mysqli_num_rows($getEnrolled) != 0) :
  ?>
  <div class="table-container"><table class="striped">
  <thead><tr><th scope="col">Academic Year</th><th scope="col">Semester</th><th scope="col">Actions</th></tr></thead>
  <tbody>
    <?php while ($enrolled = mysqli_fetch_array($getEnrolled)) : ?>
    <tr><th scope="row"><?= $enrolled['academic_year'] ?></th><td><?= $enrolled['academic_sem'] ?></td>
    <td><span class='table-button material-icons' title='View' onclick="viewDetails('<?= implode(';',$enrolled) ?>')">visibility</span></td>
    </tr>
    <?php endwhile;?>
  </tbody>
  </table></div>
<?php else: ?>
    <p>No previous enrollment recorded.</p>
<?php endif; ?>
</article>

<dialog id='modal'>
  <article>
    <header>
      <button aria-label="Close" rel="prev" onclick="document.getElementById('modal').close()"></button>
      <p><strong>User Account Details</strong></p>
    </header>
    <div class='modal-content' id='enrollment-details'>
        <div>Academic Year: <span id='ed-ay'></span></div>
        <div>Semester: <span id='ed-sem'></span></div>
        <div>Strand, Grade Level, & Section: <span id='ed-data'></span></div>
        <div>Status: <span id='ed-stax'></span></div>
        <div>Flags: <span id='ed-flags'></span></div>
        <div>Evaluator: <span id='ed-eval'></span></div>
        <div>Encoder: <span id='ed-enc'></span></div>
        <div>Enrolled Date: <span id='ed-date'></span></div>
    </div>
    <div class='modal-content' id='enrollment-add'>
        <form method="post" action="ssn/enrollnow.php" enctype="multipart/form-data" onsubmit="return confirm('Send enrollment form?');">
            <label>
                Student LRN<req>*</req>
                <input type="text" maxlength="12" value="<?= $details['student_lrn'] ?>" disabled>
                <input type="text" name="e-lrn" id="e-lrn" maxlength="12" value="<?= $details['student_lrn'] ?>" readonly hidden>
            </label>   
            <label>
                Name<req>*</req>
                <input type="text" name="e-name" id="e-name" maxlength="460" value="<?= $fullname ?>" disabled >
            </label> 
            <label>
                Strand<req>*</req>
                <select name="e-strand" id="e-strand" required>
                    <optgroup>
                        <?php 
                            $getstrands = mysqli_query($connect,"SELECT * FROM tblStrands ORDER BY strand_name DESC");
                            while ($strands = mysqli_fetch_array($getstrands)) {
                                $strand = urldecode($strands[1]);
                                echo "<option value='$strand'>$strand</option>";
                            }
                        ?>
                    </optgroup>
                </select>
            </label>  
            <label>
                Grade Level<req>*</req>
                <select name="e-grade" id="e-grade" required>
                    <optgroup>
                        <option value="11">11</option>
                        <option value="12">12</option>
                    </optgroup>
                </select>
            </label>      
            <label>
                Required Documents <i>in pdf format</i><req>*</req>
                <input type="file" name="e-file[]" id="e-file" accept="application/pdf" multiple required>
            </label>   
            <input type="submit" value="Enroll">
        </form>
    </div>
  </article>
</dialog>

<script>
function addEnroll() {
    clearAdd();
    viewModal('enrollment-add');
}
function viewDetails(params) {
    viewModal('enrollment-details');
    params = decodeCustomURL(params);
    var values = params.split(";");
    document.getElementById('ed-data').innerText = values[4].replace("|"," - ");
    document.getElementById('ed-ay').innerText = values[6];
    document.getElementById('ed-sem').innerText = values[8];
    document.getElementById('ed-stax').innerText = values[12];
    document.getElementById('ed-flags').innerText = values[14];
    if (values[16] != null) {
        values[16] = values[16] + " last " + values[18];
    }
    if (values[20] != null) {
        values[20] = values[20] + " last " + values[22];
    }
    if (values[12] != "ENROLLED") {
        values[10] = "";   
    }
    document.getElementById('ed-eval').innerText = values[16];
    document.getElementById('ed-enc').innerText = values[20];
    document.getElementById('ed-date').innerText = values[10];
}
function viewModal(shown) {
    document.getElementById('modal').open = true;
    document.getElementById('enrollment-details').style.display = "none";
    document.getElementById('enrollment-add').style.display = "none";
    document.getElementById(shown).style.display = "block";
}
function clearAdd() {
    document.getElementById('e-strand').selectedIndex = -1;
    document.getElementById('e-grade').selectedIndex = -1;
    document.getElementById('e-file').value = ""; //test
}
</script>