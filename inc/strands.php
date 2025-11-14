<div>Strands</div>
<?php 
if (isset($_SESSION['code'])) {
    echo "<notice id='notification' class='". $_SESSION['code'] ."'>". $_SESSION['msg']."</notice>";
    unset($_SESSION['code']);
}
?>
<br>
<article>
  <?php 
    $getstrands = mysqli_query($connect,"SELECT * FROM tblStrands");
    $count = mysqli_num_rows($getstrands);
  ?>
  <?php 
    if (mysqli_num_rows($getstrands) != 0) :
  ?>
  <input type="search" name="search" id="searchbox" placeholder="Search by Name"  oninput='searchTable()' placeholder="Search"/>
  <div class="table-container"><table class="striped">
  <thead><tr><th scope="col">Name</th><th scope="col">Description</th><th scope="col">Maximum Section Count</th><th scope="col">Actions</th></tr></thead>
  <tbody>
    <?php while ($strands = mysqli_fetch_array($getstrands)) : ?>
    <tr class="row-selection"><th scope="row" class="row-unique"><?= urldecode($strands['strand_name']) ?></th><td><?= urldecode($strands['strand_description']) ?></td><td><?= $strands['strand_max_section'] ?></td>
    <td><?php if (str_contains($spermission,"W")) : ?>
    <span class='table-button material-icons' title='Sections' onclick="goTo('ssn/sections.php?rel=<?= $strands['strand_name']; ?>')">arrow_forward</span>
    <span class='table-button material-icons' title='Edit' onclick="editStrand('<?= implode(';',$strands) ?>')">edit</span>
    <span class='table-button delete material-icons' title='Delete' onclick="if (confirm('Are you sure?') == true) {goTo('ssn/delete.php?rel=strands&tbl=tblStrands&mid=strand_id&typ=int&val=<?= $strands['strand_id'] ?>')}">close</span>
    <?php endif; ?>
    </td>
    </tr>
    <?php endwhile;?>
  </tbody>
  </table></div>
<?php else: ?>
    <p>Nothing to show. Add one first!</p>
<?php endif; ?>
<input type="button" class='accordion-button' value="Create New Strand" onclick="viewAdd()">
</article>

<dialog id='modal'>
  <article>
    <header>
      <button aria-label="Close" rel="prev" onclick="document.getElementById('modal').close()"></button>
      <p><strong>Strand Details</strong></p>
    </header>
    <div class='modal-content' id='strand-add'>
        <form method="post" action="ssn/addstrand.php" onsubmit="return confirm('Save made changes?');">
            <label>
                Name<req>*</req>
                <input type="text" name="s-name" id="s-name" maxlength="200" required>
            </label>   
            <label>
                Description<req>*</req>
                <input type="text" name="s-desc" id="s-desc" maxlength="500" required>
            </label> 
            <label>
                Maximum Number of Section<req>*</req>
                <input type="number" name="s-max" id="s-max" max="20" required>
            </label>   
            <input type="submit" value="Create New Strand">
        </form>
    </div>
    <div class='modal-content' id='strand-edit'>
        <form method="post" action="ssn/updatestrand.php" onsubmit="return confirm('Save made changes?');">
            <label>
                Name<req>*</req>
                <input type="text" name="se-id" id="se-id" readonly hidden>
                <input type="text" name="sev-name" id="sev-name" maxlength="200" disabled>
                <input type="text" name="se-name" id="se-name" maxlength="200" hidden required>
            </label>   
            <label>
                Description<req>*</req>
                <input type="text" name="se-desc" id="se-desc" maxlength="500" required>
            </label> 
            <label>
                Maximum Number of Section<req>*</req>
                <input type="number" name="se-max" id="se-max" max="20" required>
            </label>   
            <input type="submit" value="Update Strand">
        </form>
    </div>
  </article>
</dialog>

<script>
function viewAdd() {
    clearAdd();
    viewModal('strand-add');
}
function viewModal(shown) {
    document.getElementById('modal').open = true;
    document.getElementById('strand-add').style.display = "none";
    document.getElementById('strand-edit').style.display = "none";
    document.getElementById(shown).style.display = "block";
}
function editStrand(params) {
    viewModal('strand-edit');
    params = decodeCustomURL(params);
    var values = params.split(";");
    document.getElementById('se-id').value = values[0];
    document.getElementById('se-name').value = values[2];
    document.getElementById('sev-name').value = values[2];
    document.getElementById('se-desc').value = values[4];
    document.getElementById('se-max').value = values[6];
}
function clearAdd() {
    document.getElementById('s-name').value = "";
    document.getElementById('s-desc').value = "";
    document.getElementById('s-max').value = "";
}
</script>