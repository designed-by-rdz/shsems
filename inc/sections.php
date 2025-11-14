<div>Sections for <?= urldecode($_SESSION['section-session']); ?></div>
<?php 
if (isset($_SESSION['code'])) {
    echo "<notice id='notification' class='". $_SESSION['code'] ."'>". $_SESSION['msg']."</notice>";
    unset($_SESSION['code']);
}
$getmaxsection = mysqli_query($connect, "SELECT * FROM tblStrands WHERE strand_name = '".$_SESSION['section-session']."'");
$maxsections = mysqli_fetch_array($getmaxsection);
$maxsection = intval($maxsections['strand_max_section']);
?>
<br>
<article>
  <?php 
    $getsections = mysqli_query($connect,"SELECT * FROM tblSections WHERE section_strand = '".$_SESSION['section-session']."'");
    $numrows = mysqli_num_rows($getsections);
    if ($numrows != 0) :
  ?>
  <input type="search" name="search" id="searchbox" placeholder="Search by Section ID"  oninput='searchTable()' placeholder="Search"/>
  <div class="table-container"><table class="striped">
  <thead><tr><th scope="col">Section ID</th><th scope="col">Name</th><th scope="col">Maximum Student Count</th><th scope="col">Actions</th></tr></thead>
  <tbody>
    <?php while ($sections = mysqli_fetch_array($getsections)) : ?>
    <tr class="row-selection"><th scope="row" class="row-unique"><?= urldecode($sections['section_id']) ?></th><td><?= urldecode($sections['section_name']) ?></td><td><?= $sections['section_max_count'] ?></td>
    <td>
    <span class='table-button material-icons' title='View' onclick="viewSection('<?= implode(';',$sections) ?>')">visibility</span>
    <?php if (str_contains($spermission,"W")) : ?>
    <span class='table-button material-icons' title='Edit' onclick="editSection('<?= implode(';',$sections) ?>')">edit</span>
    <span class='table-button delete material-icons' title='Delete' onclick="if (confirm('Are you sure?') == true) {goTo('ssn/delete.php?rel=sections&tbl=tblSections&mid=section_id&typ=str&val=<?= $sections['section_id'] ?>')}">close</span>
    <?php endif; ?>
    </td>
    </tr>
    <?php endwhile;?>
  </tbody>
  </table></div>
<?php else: ?>
    <p>Nothing to show. Add one first!</p>
<?php endif; 
    if ($numrows < ($maxsection * 2)) :
?>
<input type="button" class='accordion-button' value="Create New Section" onclick="viewAdd()"> 
<?php endif; ?>
</article>
<input type="button" class='accordion-button' value="Go Back to Strands" onclick="goTo('ssn/bridge.php?rel=strands')"> 

<dialog id='modal'>
  <article>
    <header>
      <button aria-label="Close" rel="prev" onclick="document.getElementById('modal').close()"></button>
      <p><strong>Section Details</strong></p>
    </header>
    <div class='modal-content' id='section-details'>
        <div>Section ID: <span id='d-id'></span></div>
        <div>Name: <span id='d-name'></span></div>
        <div>Grade Level: <span id='d-grade'></span></div>
        <div>Strand: <span id='d-strand'></span></div>
        <div>Maximum Student Count: <span id='d-max'></span></div>
        <div>Adviser Information: <span id='d-adviser'></span></div>
    </div>
    <div class='modal-content' id='section-add'>
        <form method="post" action="ssn/addsection.php" onsubmit="return confirm('Save made changes?');"> 
            <label>
                Strand<req>*</req>
                <input type="text" maxlength="200" id="sv-strand" value="<?= urldecode($_SESSION['section-session']) ?>" disabled>
                <input type="text" name="s-strand" id="s-strand" maxlength="200" value="<?= urldecode($_SESSION['section-session']) ?>" readonly hidden>
            </label>   
            <label>
                Section ID<req>*</req>
                <input type="text" name="s-id" id="s-id" maxlength="25" required>
            </label>   
            <label>
                Section Name<req>*</req>
                <input type="text" name="s-name" id="s-name" maxlength="100" required>
            </label>   
            <label>
                Grade Level<req>*</req>
                <select name="s-grade" id="s-grade" required>
                    <optgroup>
                        <option value="11">11</option>
                        <option value="12">12</option>
                    </optgroup>
                </select>
            </label> 
            <label>
                Maximum Number of Student<req>*</req>
                <input type="number" name="s-max" id="s-max" max="100" required>
            </label>   
            <label>
                Adviser Employee ID
                <input type="text" name="s-adviser" id="s-adviser" maxlength="25">
            </label> 
            <input type="submit" value="Create New Section">
        </form>
    </div>
    <div class='modal-content' id='section-edit'>
        <form method="post" action="ssn/updatesection.php" onsubmit="return confirm('Save made changes?');"> 
            <label>
                Strand<req>*</req>
                <input type="text" maxlength="200" id="sev-strand" value="<?= urldecode($_SESSION['section-session']) ?>" disabled>
                <input type="text" name="se-strand" id="se-strand" maxlength="200" value="<?= urldecode($_SESSION['section-session']) ?>" readonly hidden>
            </label>   
            <label>
                Section ID<req>*</req>
                <input type="text" name="sev-id" id="sev-id" maxlength="25" disabled>
                <input type="text" name="se-id" id="se-id" maxlength="25" hidden required>
            </label>   
            <label>
                Section Name<req>*</req>
                <input type="text" name="se-name" id="se-name" maxlength="100" required>
            </label>   
            <label>
                Grade Level<req>*</req>
                <select name="se-grade" id="se-grade" required>
                    <optgroup>
                        <option value="11">11</option>
                        <option value="12">12</option>
                    </optgroup>
                </select>
            </label> 
            <label>
                Maximum Number of Student<req>*</req>
                <input type="number" name="se-max" id="se-max" max="100" required>
            </label>   
            <label>
                Adviser Employee ID
                <input type="text" name="se-adviser" id="se-adviser" maxlength="25">
            </label> 
            <input type="submit" value="Update Section">
        </form>
    </div>
  </article>
</dialog>

<script>
function viewSection(params) {
    viewModal('section-details');
    params = decodeCustomURL(params);
    var values = params.split(";");
    document.getElementById('d-id').innerText = values[0];
    document.getElementById('d-name').innerText = values[4];
    document.getElementById('d-grade').innerText = values[6];
    document.getElementById('d-strand').innerText = values[2];
    document.getElementById('d-max').innerText = values[8];
    document.getElementById('d-adviser').innerText = values[10];
}
function viewAdd() {
    clearAdd();
    viewModal('section-add');
}
function viewModal(shown) {
    document.getElementById('modal').open = true;
    document.getElementById('section-add').style.display = "none";
    document.getElementById('section-details').style.display = "none";
    document.getElementById('section-edit').style.display = "none";
    document.getElementById(shown).style.display = "block";
}
function editSection(params) {
    viewModal('section-edit');
    params = decodeCustomURL(params);
    var values = params.split(";");
    document.getElementById('se-id').value = values[0];
    document.getElementById('sev-id').value = values[0];
    document.getElementById('se-name').value = values[4];
    document.getElementById('se-grade').selectedIndex = (values[6].substring(1)) - 1;
    document.getElementById('se-max').value = values[8];
    document.getElementById('se-adviser').value = values[10];
}
function clearAdd() {
    document.getElementById('s-id').value = "";
    document.getElementById('s-name').value = "";
    document.getElementById('s-grade').selectedIndex = -1;
    document.getElementById('s-max').value = "";
    document.getElementById('s-adviser').value = "";
}
</script>