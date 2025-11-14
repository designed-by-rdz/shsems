<div>Welcome <?= $suser ?></div>
<?php 
if (isset($_SESSION['code'])) {
    echo "<notice id='notification' class='". $_SESSION['code'] ."'>". $_SESSION['msg']."</notice>";
    unset($_SESSION['code']);
}
?>
<br>
<?php if ($srole == "Administrator") : ?>
<div class="value-groups">
    <article>
        <summary>Number of Students Registered</summary>
        <div class="value">
            <?php 
                $gettotalstudents = mysqli_query($connect,"SELECT * FROM tblStudents WHERE student_surname != ''");
                echo mysqli_num_rows($gettotalstudents);
            ?>
        </div>
    </article>
    <article>
        <summary>Number of Faculty Registered</summary>
        <div class="value">
            <?php 
                $gettotalstudents = mysqli_query($connect,"SELECT * FROM tblEmployees");
                echo mysqli_num_rows($gettotalstudents);
            ?>
        </div>
    </article>
    <article>
        <summary>Number of Accounts</summary>
        <div class="value">
            <?php 
                $gettotalstudents = mysqli_query($connect,"SELECT * FROM tblUserAccounts");
                echo mysqli_num_rows($gettotalstudents);
            ?>
        </div>
    </article>
    <!-- <article>
        <summary>Number of Strands</summary>
        <div class="value">
            <?php 
                $gettotalstudents = mysqli_query($connect,"SELECT * FROM tblStrands");
                echo mysqli_num_rows($gettotalstudents);
            ?>
        </div>
    </article>
    <article>
        <summary>Number of Classes</summary>
        <div class="value">
            <?php 
                $gettotalstudents = mysqli_query($connect,"SELECT * FROM tblSections");
                echo mysqli_num_rows($gettotalstudents);
            ?>
        </div>
    </article> -->
</div>
    <article>
        <summary>Number of Students for the Last 5 Years</summary>
        <canvas id="lineChart" class="chart" style="width:100%;max-width:700px"></canvas><br>
    </article>
    <article>
        <summary>Distribution of Students by Strand</summary>
        <canvas id="pieChart" class="chart" style="width:100%;max-width:700px"></canvas><br>
    </article>

    <?php 
        $years = ["","","","",""];
        $pendings = ["","","","",""];
        $evaluated = ["","","","",""];
        $enrolled = ["","","","",""];
        $currentYear = date('Y');
        for ($i = 0; $i < 5; $i++) {
            $pastYear = $currentYear - ($i);
            $years[$i] = $pastYear;
            $gettotalstudents = mysqli_query($connect,"SELECT * FROM tblEnrollment WHERE enrollment_status = 'PENDING' AND academic_year LIKE '$pastYear-%'");
            $pendings[$i] = mysqli_num_rows($gettotalstudents);
            $gettotalstudents = mysqli_query($connect,"SELECT * FROM tblEnrollment WHERE enrollment_status = 'EVALUATED' AND academic_year LIKE '$pastYear-%'");
            $evaluated[$i] = mysqli_num_rows($gettotalstudents);
            $gettotalstudents = mysqli_query($connect,"SELECT * FROM tblEnrollment WHERE enrollment_status = 'ENROLLED' AND academic_year LIKE '$pastYear-%'");
            $enrolled[$i] = mysqli_num_rows($gettotalstudents);
        }

        $strands = [];
        $strandpops = [];
        $getstrands = mysqli_query($connect,"SELECT * FROM tblStrands ORDER BY strand_name");
        while ($strandss = mysqli_fetch_array($getstrands)) {
            $currentStrand = $strandss['strand_name'];
            $strands[] = $currentStrand;
            $getcounts = mysqli_query($connect, "SELECT * FROM tblEnrollment LEFT JOIN tblSections ON tblSections.section_id = tblEnrollment.enrollment_data WHERE $current AND section_strand = '$currentStrand'");
            $strandpops[] = mysqli_num_rows($getcounts);
        }
    ?>

<script>
    const xValues = [<?=implode(",",array_reverse($years))?>];
    new Chart("lineChart", {
    type: "line",
    data: {
        labels: xValues,
        datasets: [{
        data: [<?=implode(",",array_reverse($pendings))?>],
        borderColor: "lightcoral",
        fill: false,
        label: "Total Pending"
        },{
        data: [<?=implode(",",array_reverse($evaluated))?>],
        borderColor: "cornflowerblue",
        fill: false,
        label: "Total Evaluated Only"
        },{
        data: [<?=implode(",",array_reverse($enrolled))?>],
        borderColor: "lightgreen",
        fill: false,
        label: "Total Enrolled"
        }]
    },
    options: {
        legend: {display: false}
    }
    });
    const pValues = ['<?=implode("','",array_reverse($strands))?>'];
    var cValues = ["lightgreen","seagreen","mediumseagreen","green","darkseagreen","lightseagreen","mediumspringgreen","palegreen"];
    cValues = shuffleArray(cValues);
    const nValues = [<?=implode(",",array_reverse($strandpops))?>];
    new Chart("pieChart", {
    type: "doughnut",
    data: {
        labels: pValues,
        datasets: [{
        data: nValues,
        backgroundColor: cValues
        }]
    },
    options: {
        legend: {display: false}
    }
    });
</script>

<?php elseif ($srole == "Evaluator") : ?>
<div class="value-groups">
    <article>
        <summary>Number of Student Enrollments Evaluated</summary>
        <div class="value">
            <?php 
                $gettotalstudents = mysqli_query($connect,"SELECT * FROM tblEnrollment WHERE evaluator_id = '$suser'");
                echo mysqli_num_rows($gettotalstudents);
            ?>
        </div>
    </article>
    <article>
        <summary>Student Enrollments Evaluated who Enrolled</summary>
        <div class="value">
            <?php 
                $gettotalstudents = mysqli_query($connect,"SELECT * FROM tblEnrollment WHERE evaluator_id = '$suser' AND enrollment_status = 'ENROLLED'");
                echo mysqli_num_rows($gettotalstudents);
            ?>
        </div>
    </article>
</div>
<?php elseif ($srole == "Encoder") : ?>
    <article>
        <summary>Number of Students Enrolled</summary>
        <div class="value">
            <?php 
                $gettotalstudents = mysqli_query($connect,"SELECT * FROM tblEnrollment WHERE encoder_id = '$suser'");
                echo mysqli_num_rows($gettotalstudents);
            ?>
        </div>
    </article>
<?php endif; ?>
<article>
    <summary><strong style="font-size:x-large"><?= urldecode($data['school']) ?></strong><br><strong>Senior High School Enrollment Management System</strong></summary><br>
    <div>This is a project in-progress. Please be wary of bugs. There might also be some needed features not yet implemented or mislooked. This website is mobile-friendly and can be viewed on most browsers in any display size.</div>
    <div>Frameworks and plugins used:</div>
    <ul>
        <li>Pico Classless CSS</li>
        <li>Google Material Icons Font</li>
        <li>Chart.js</li>
        <li>ZipArchive</li>
    </ul>
    <div>Copyright &copy 2025</div>
    <div><a href="https://designedbyrdz.com">designed.by.rdz</a></div>
</article>