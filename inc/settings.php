<div>Settings</div>
<?php 
if (isset($_SESSION['code'])) {
    echo "<notice id='notification' class='". $_SESSION['code'] ."'>". $_SESSION['msg']."</notice>";
    unset($_SESSION['code']);
}
?>
<br>
<article>
<details name="Gender" class='accordion'>
  <summary>Genders</summary>
  <?php 
    $getgenders = mysqli_query($connect,"SELECT * FROM tblGenders");
    if (mysqli_num_rows($getgenders) != 0) :
  ?>
  <div class="table-container"><table class="striped">
  <thead><tr><th scope="col">Gender</th><th scope="col">Description</th><th scope="col">Actions</th></tr></thead>
  <tbody>
    <?php while ($genders = mysqli_fetch_array($getgenders)) : ?>
    <tr><th scope="row"><?= urldecode($genders['gender_code']) ?></th><td><?= urldecode($genders['gender_description']) ?></td>
    <td>
      <?php if ($genders['gender_code'] != 'Female' && $genders['gender_code'] != 'Male') : ?>
      <?php if (str_contains($spermission,"W")) : ?>
        <!-- <span class='table-button material-icons' title='Edit'>edit</span> -->
        <span class='table-button delete material-icons' title='Delete' onclick="if (confirm('Are you sure?') == true) {goTo('ssn/delete.php?rel=settings&tbl=tblGenders&mid=gender_code&typ=str&val=<?= $genders['gender_code'] ?>')}">delete</span><?php endif; endif; ?>
    </td>
    </tr>
    <?php endwhile;?>
  </tbody>
  </table></div>
<?php else: ?>
    <p>Nothing to show. Add one first!</p>
<?php endif; ?>
<input type="button" class='accordion-button' onclick="addGender()" value="Add New">
</details>
</article>

<article>
<details name="Status" class='accordion'>
  <summary>Religions</summary> 
  <?php 
    $getreligions = mysqli_query($connect,"SELECT * FROM tblReligions");
    if (mysqli_num_rows($getreligions) != 0) :
  ?>
  <div class="table-container"><table class="striped">
  <thead><tr><th scope="col">Religion</th><th scope="col">Description</th><th scope="col">Actions</th></tr></thead>
  <tbody>
    <?php while ($religions = mysqli_fetch_array($getreligions)) : ?>
    <tr><th scope="row"><?= urldecode($religions['religion_code']) ?></th><td><?= urldecode($religions['religion_description']) ?></td>
    <td><?php if (str_contains($spermission,"W")) : ?>
      <!-- <span class='table-button material-icons' title='Edit'>edit</span> -->
      <span class='table-button delete material-icons' title='Delete' onclick="if (confirm('Are you sure?') == true) {goTo('ssn/delete.php?rel=settings&tbl=tblReligions&mid=religion_code&typ=str&val=<?= $religions['religion_code'] ?>')}">delete</span><?php endif; ?></td>
    </tr>
    <?php endwhile;?>
  </tbody>
  </table></div>
<?php else: ?>
    <p>Nothing to show. Add one first!</p>
<?php endif; ?>
<input type="button" class='accordion-button' onclick="addReligion()" value="Add New">
</details>
</article>

<article>
<details name="Status" class='accordion'>
  <summary>Enrollment Flags</summary> 
  <?php 
    $getflags = mysqli_query($connect,"SELECT * FROM tblFlags");
    if (mysqli_num_rows($getflags) != 0) :
  ?>
  <div class="table-container"><table class="striped">
  <thead><tr><th scope="col">Religion</th><th scope="col">Description</th><th scope="col">Actions</th></tr></thead>
  <tbody>
    <?php while ($flags = mysqli_fetch_array($getflags)) : ?>
    <tr><th scope="row"><?= urldecode($flags['flag_code']) ?></th><td><?= urldecode($flags['flag_description']) ?></td>
    <td><?php if (str_contains($spermission,"W")) : ?>
      <!-- <span class='table-button material-icons' title='Edit'>edit</span> -->
      <span class='table-button delete material-icons' title='Delete' onclick="if (confirm('Are you sure?') == true) {goTo('ssn/delete.php?rel=settings&tbl=tblFlags&mid=flag_code&typ=str&val=<?= $flags['flag_code'] ?>')}">delete</span><?php endif; ?></td>
    </tr>
    <?php endwhile;?>
  </tbody>
  </table></div>
<?php else: ?>
    <p>Nothing to show. Add one first!</p>
<?php endif; ?>
<input type="button" class='accordion-button' onclick="addFlag()" value="Add New">
</details>
</article>

<article>
<details name="Permissions" class='accordion'>
  <summary>Permissions</summary>
  <div class="table-container"><table class="striped">
  <thead><tr><th scope="col">Code</th><th scope="col">Description</th>
  </tr></thead>
  <tbody>
    <tr><th scope="row">Read Access (R)</th><td>Can add and view data in the system.</td></tr>
    <tr><th scope="row">Write Access (W)</th><td>Can edit and delete data in the system.</td></tr>
    <tr><th scope="row">Special Access (A)</th><td>Special Administrative Access.</td></tr>
  </tbody>
  </table></div>
</details>
</article>

<article>
<details name="Roles" class='accordion'>
  <summary>Roles</summary>
  <?php 
    $getroles = mysqli_query($connect,"SELECT * FROM tblRoles");
    if (mysqli_num_rows($getroles) != 0) :
  ?>
  <div class="table-container"><table class="striped">
  <thead><tr><th scope="col">Code</th><th scope="col">Description</th>
  <!-- <th scope="col">Actions</th> -->
</tr></thead>
  <tbody>
    <?php while ($roles = mysqli_fetch_array($getroles)) : ?>
    <tr><th scope="row"><?= urldecode($roles['role_code']) ?></th><td><?= urldecode($roles['role_description']) ?></td>
    </tr>
    <?php endwhile;?>
  </tbody>
  </table></div>
<?php else: ?>
    <p>Nothing to show. Add one first!</p>
<?php endif; ?>
<!-- <input type="button" class='accordion-button' value="Add New"> -->
</details>
</article>

<?php if (str_contains($spermission,"A")) : ?>
<article>
<details name="Others" class='accordion'>
  <summary>Miscellaneous</summary>
  <?php 
    $getdatii = mysqli_query($connect,"SELECT * FROM tblData");
    if (mysqli_num_rows($getdatii) != 0) :
  ?>
  <div class="table-container"><table class="striped">
  <thead><tr><th scope="col">Key</th><th scope="col">Value</th><th scope="col">Actions</th></tr></thead>
  <tbody>
    <?php while ($datii = mysqli_fetch_array($getdatii)) :
      $key = $datii['dvalue'];
      $functionname = "alert";
      if ($datii['dvalue'] == "ay") {
        $key = "Academic Year";
        $functionname = "editDates";
      }  elseif ($datii['dvalue'] == "sem") {
        $key = "Semester";
        $functionname = "editSem";
      } elseif ($datii['dvalue'] == "available") {
        $key = "Is Open for Enrollment?";
        $functionname = "editAvail";
      } elseif ($datii['dvalue'] == "version") {
        $key = "Application Version";
        $functionname = "editVersion";
      } elseif ($datii['dvalue'] == "school") {
        $key = "School Name";
        $functionname = "editSchool";
      }
    ?>
    <tr><th scope="row"><?= $key ?></th><td><?= urldecode($datii['dkey']) ?></td>
    <td><?php if (str_contains($spermission,"W")) : ?>
      <span class='table-button material-icons' onclick="<?= $functionname ?>('<?= implode(';',$datii) ?>')" title='Edit'>edit</span>
      <?php endif; ?></td>
    </tr>
    <?php endwhile;?>
  </tbody>
  </table></div>
<?php else: ?>
    <p>Nothing to show</p>
<?php endif; ?>
<!-- <input type="button" class='accordion-button' value="Add New"> -->
</details>
</article>
<?php endif; ?>

<dialog id='modal'>
  <article>
    <header>
      <button aria-label="Close" rel="prev" onclick="document.getElementById('modal').close()"></button>
      <p><strong>Settings</strong></p>
    </header>
    <div class='modal-content' id='settings-ay'>
        <form method="post" action="ssn/editsettings.php?st=ay" onsubmit="return confirm('Save made changes?');">
              <input type="text" name="a-id" id="a-id" hidden required>
            <label>
                Current Academic Year<req>*</req>
                <br>Start
                <input type="number" name="a-dateone" id="a-dateone" min="2025" max="2100" required>
                End
                <input type="number" name="a-datetwo" id="a-datetwo" min="2025" max="2100" required>
            </label>   
            <input type="submit" value="Update Academic Year">
        </form>
    </div>
    <div class='modal-content' id='settings-sem'>
        <form method="post" action="ssn/editsettings.php?st=sem" onsubmit="return confirm('Save made changes?');">
              <input type="text" name="s-id" id="s-id" hidden required>
            <label>
                Current Semester<req>*</req>
                <select name="s-sem" id="s-sem" required>
                    <optgroup>
                        <option value="1">1st Semester</option>
                        <option value="2">2nd Semester</option>
                        <option value="3">Summer</option>
                    </optgroup>
                </select>
            </label> 
            <input type="submit" value="Update Semester">
        </form>
    </div>
    <div class='modal-content' id='settings-avail'>
        <form method="post" action="ssn/editsettings.php?st=av" onsubmit="return confirm('Save made changes?');">
              <input type="text" name="v-id" id="v-id" hidden required>
            <label>
                Is Enrollment Currently Open?<req>*</req>
                <select name="v-open" id="v-open" required>
                    <optgroup>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </optgroup>
                </select>
            </label> 
            <input type="submit" value="Update Availability">
        </form>
    </div>
    <div class='modal-content' id='settings-ver'>
        <form method="post" action="ssn/editsettings.php?st=ver" onsubmit="return confirm('Save made changes?');">
              <input type="text" name="r-id" id="r-id" hidden required>
            <label>
                Current Version<req>*</req>
                <input type="text" name="r-ver" id="r-ver" maxlength="10" required>
            </label>   
            <input type="submit" value="Update Version">
        </form>
    </div>
    <div class='modal-content' id='settings-skl'>
        <form method="post" action="ssn/editsettings.php?st=skl" onsubmit="return confirm('Save made changes?');">
              <input type="text" name="c-id" id="c-id" hidden required>
            <label>
                School Name<req>*</req>
                <input type="text" name="c-name" id="c-name" maxlength="500" required>
            </label>   
            <input type="submit" value="Update School Name">
        </form>
    </div>
    <div class='modal-content' id='genders-add'>
        <form method="post" action="ssn/addgender.php" onsubmit="return confirm('Save made changes?');">
            <label>
                Gender<req>*</req>
                <input type="text" name="g-name" id="g-name" maxlength="20" required>
            </label>   
            <label>
                Description<req>*</req>
                <input type="text" name="g-desc" id="g-desc" maxlength="100" required>
            </label>   
            <input type="submit" value="Add New Gender">
        </form>
    </div>
    <div class='modal-content' id='religion-add'>
        <form method="post" action="ssn/addreligion.php" onsubmit="return confirm('Save made changes?');">
            <label>
                Religion<req>*</req>
                <input type="text" name="r-name" id="r-name" maxlength="100" required>
            </label>   
            <label>
                Description<req>*</req>
                <input type="text" name="r-desc" id="r-desc" maxlength="200" required>
            </label>   
            <input type="submit" value="Add New Religion">
        </form>
    </div>
    <div class='modal-content' id='flag-add'>
        <form method="post" action="ssn/addflag.php" onsubmit="return confirm('Save made changes?');">
            <label>
                Flag<req>*</req>
                <input type="text" name="f-name" id="f-name" maxlength="100" required>
            </label>   
            <label>
                Description<req>*</req>
                <input type="text" name="f-desc" id="f-desc" maxlength="200" required>
            </label>   
            <input type="submit" value="Add New Flag">
        </form>
    </div>
  </article>
</dialog>
<script>
function editDates(params) {
    viewModal('settings-ay');
    params = decodeCustomURL(params);
    var values = params.split(";");
    var acadyear = values[4].split("-");
    document.getElementById('a-id').value = values[0];
    document.getElementById('a-dateone').value = acadyear[0];
    document.getElementById('a-datetwo').value = acadyear[1];
}
function editSem(params) {
    viewModal('settings-sem');
    params = decodeCustomURL(params);
    var values = params.split(";");
    document.getElementById('s-id').value = values[0];
    document.getElementById('s-sem').value = values[4];
}
function editAvail(params) {
    viewModal('settings-avail');
    params = decodeCustomURL(params);
    var values = params.split(";");
    document.getElementById('v-id').value = values[0];
    document.getElementById('v-open').value = values[4];
}
function editVersion(params) {
    viewModal('settings-ver');
    params = decodeCustomURL(params);
    var values = params.split(";");
    document.getElementById('r-id').value = values[0];
    document.getElementById('r-ver').value = values[4];
}
function editSchool(params) {
    viewModal('settings-skl');
    params = decodeCustomURL(params);
    var values = params.split(";");
    document.getElementById('c-id').value = values[0];
    document.getElementById('c-name').value = values[4];
}
function addGender() {
    clearAdds();
    viewModal('genders-add');
}
function addReligion() {
    clearAdds();
    viewModal('religion-add');
}
function addFlag() {
    clearAdds();
    viewModal('flag-add');
}
function viewModal(shown) {
    document.getElementById('modal').open = true;
    document.getElementById('settings-ay').style.display = "none";
    document.getElementById('settings-sem').style.display = "none";
    document.getElementById('settings-avail').style.display = "none";
    document.getElementById('settings-ver').style.display = "none";
    document.getElementById('settings-skl').style.display = "none";
    document.getElementById('genders-add').style.display = "none";
    document.getElementById('religion-add').style.display = "none";
    document.getElementById('flag-add').style.display = "none";
    document.getElementById(shown).style.display = "block";
}
function clearAdds(){
    document.getElementById('r-name').value = "";
    document.getElementById('r-desc').value = "";
    document.getElementById('g-name').value = "";
    document.getElementById('g-desc').value = "";
    document.getElementById('f-name').value = "";
    document.getElementById('f-desc').value = "";
}
</script>