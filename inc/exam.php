<div>Strand Assessment Examination</div>
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
$letters = ["a","b","c","d","e"];
?>
<br>
<article>
    <?php 
    $getresults = mysqli_query($connect,"SELECT * FROM tblResults LEFT JOIN tblAssessments ON tblAssessments.assessment_id = tblResults.examination_id LEFT JOIN tblStudents ON tblStudents.student_lrn = tblResults.student_lrn WHERE tblResults.student_lrn = '$spersonal' ORDER BY result_date DESC");
    $count = mysqli_num_rows($getresults);
    ?>
  <?php 
    if (mysqli_num_rows($getresults) != 0) :
  ?>
  <input type="search" name="search" id="searchbox" placeholder="Search by Date"  oninput='searchTable()' placeholder="Search"/>
  <div class="table-container"><table class="striped">
  <thead><tr><th scope="col">Assessment Date and Time</th><th scope="col">Top Strand Result</th><th scope="col">Actions</th></tr></thead>
  <tbody>
    <?php while ($results = mysqli_fetch_array($getresults)) : 
        $topstrand = "";
        $topstrandfull = "";
        $topstranddesc = "";
        $resswstrand = "";
        $ress = explode(",",$results['result_points']);
        $strands = array_values(json_decode($results['assessment_strands'], true));
        for ($i=0; $i < 5; $i++) { 
            $resswstrand .= "\"".$i."\":{\"count\":".$ress[$i].",\"name\":\"".$strands[$i]['name']."\",\"desc\":\"".$strands[$i]['description']."\",\"fullname\":\"".$strands[$i]['fullname']."\"}, ";
        }
        $resswstrand = "{".substr($resswstrand,0,-2)."}";
        $ress = array_values(json_decode($resswstrand, true));
        $sortedRess = $ress;
        usort($sortedRess, function($a, $b) {
            return $b['count'] <=> $a['count'];
        });
        for ($i=0; $i < 3; $i++) { 
            $topstrand .= $sortedRess[$i]['name'].", ";
            $topstrandfull .= $sortedRess[$i]['fullname']." (".$sortedRess[$i]['name'].");";
            $topstranddesc .= $sortedRess[$i]['desc'].";";
        }
        $topstrand = substr($topstrand,0,-2);
    ?>
    <tr class="row-selection"><th scope="row"><?= $results['result_date'] ?></th><td class="row-unique"><?= $topstrand ?></td>
    <td><span class='table-button material-icons' title='View Report' onclick="viewReport('<?= $topstrandfull ?>','<?= $topstranddesc ?>')">visibility</span></td>
    </tr>
    <?php endwhile;?>
  </tbody>
  </table></div>
<?php else: ?>
    <p>Nothing to show. Take your assessment!</p>
<?php endif; ?>
<input type="button" class='accordion-button' value="Take the Assessment" onclick="takeExam()">
</article>


<dialog id='modal'>
  <article>
    <header>
      <button aria-label="Close" rel="prev" onclick="document.getElementById('modal').close()"></button>
      <p><strong>Strand Assessment</strong></p>
    </header>
    <div class='modal-content' id='exam-add'>
        <form method="post" action="ssn/sendresults.php" onsubmit="return confirm('Are you sure?');">
            <input type="text" name="slrn" id="slrn" value="<?= $spersonal ?>" hidden>
            <?php 
                $getassessments = mysqli_query($connect,"SELECT * FROM tblAssessments ORDER BY assessment_id DESC");   
                if (mysqli_num_rows($getassessments) == 0) {
                    $_SESSION['msg'] = "No examination template found!";
                    $_SESSION['code'] = "error";
                    header("location:ssn/bridge.php?rel=index");   
                }
                while ($assessments = mysqli_fetch_array($getassessments)) :
                    $questions = array_values(json_decode($assessments['assessment_questions'], true));
                    $choices =array_values(json_decode($assessments['assessment_choices'], true));
                    for ($i=0; $i < 10; $i++) :
                        $j = $i;
            ?>
                <input type="text" name="seid" id="seid" value="<?= $assessments['assessment_id'] ?>" hidden>
                <fieldset>
                    <legend><?= ($j + 1).". ".$questions[$j]['question']; ?></legend>
                    <?php for ($k=0; $k < 5; $k++) : ?>
                    <label>
                        <input type="radio" name="answer-<?= $j ?>" value="<?= $k ?>" required />
                        <?= $choices[$j][$letters[$k]] ?>
                    </label>
                    <?php endfor; ?>
                </fieldset>
            <?php endfor; endwhile; ?>
            <input type="submit" value="Submit Answers">
        </form>
    </div>
    <div class='modal-content' id='exam-view'>
        <div>Your Results</div>
        <div id='e-strand1' style="font-weight:bold"></div>
        <div id='e-desc1'></div><br>
        <div id='e-strand2' style="font-weight:bold"></div>
        <div id='e-desc2'></div><br>
        <div id='e-strand3' style="font-weight:bold"></div>
        <div id='e-desc3'></div>
    </div>
  </article>
</dialog>

<script>
function takeExam() {
    viewModal('exam-add');
}
function viewReport(strands, description) {
    viewModal('exam-view');
    var strand = strands.split(";");
    var desc = description.split(";");
    document.getElementById('e-strand1').innerText = "Top 1: " + strand[0];
    document.getElementById('e-desc1').innerText = desc[0];
    document.getElementById('e-strand2').innerText = "Top 2: " + strand[1];
    document.getElementById('e-desc2').innerText = desc[1];
    document.getElementById('e-strand3').innerText = "Top 3: " + strand[2];
    document.getElementById('e-desc3').innerText = desc[2];
}
function viewModal(shown) {
    document.getElementById('modal').open = true;
    document.getElementById('exam-add').style.display = "none";
    document.getElementById('exam-view').style.display = "none";
    document.getElementById(shown).style.display = "block";
}
function clearAdd() {
    document.getElementById('e-id').value = "";
}
</script>