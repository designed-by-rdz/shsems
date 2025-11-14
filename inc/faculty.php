<div>Faculty</div>
<?php 
if (isset($_SESSION['code'])) {
    echo "<notice id='notification' class='". $_SESSION['code'] ."'>". $_SESSION['msg']."</notice>";
    unset($_SESSION['code']);
}
?>
<br>
<article>
    <?php 
    $getfaculty = mysqli_query($connect,"SELECT tblEmployees.*, tblUserAccounts.user_role FROM tblEmployees LEFT JOIN tblUserAccounts ON tblUserAccounts.account_username = tblEmployees.account_username WHERE user_role != 'Student' ORDER BY employee_surname");
    $count = mysqli_num_rows($getfaculty);
    ?>
  <?php 
    if (mysqli_num_rows($getfaculty) != 0) :
  ?>
  <input type="search" name="search" id="searchbox" placeholder="Search by Name"  oninput='searchTable()' placeholder="Search"/>
  <div class="table-container"><table class="striped">
  <thead><tr><th scope="col">Employee ID</th><th scope="col">Name</th><th scope="col">Designation</th><th scope="col">System Role</th><th scope="col">Actions</th></tr></thead>
  <tbody>
    <?php while ($faculty = mysqli_fetch_array($getfaculty)) : 
        $ext = $faculty['employee_extname'];
        if ($ext != "") {
            $ext = $ext . " ";
        }
        $fullname = $faculty['employee_surname'] . ", " . $faculty['employee_givenname'] . " " . $ext . $faculty['employee_middlename'];
        $fullname = urldecode($fullname);
    ?>
    <tr class="row-selection"><th scope="row"><?= urldecode($faculty['employee_id']) ?></th><td class="row-unique"><?= $fullname ?></td><td><?= urldecode($faculty['employee_designation']) ?></td><td><?= urldecode($faculty['user_role']) ?></td>
    <td><span class='table-button material-icons' title='View' onclick="viewAccount('<?= implode(';',$faculty) ?>')">visibility</span>
    <?php if (str_contains($spermission,"W")) : ?>
    <span class='table-button material-icons' title='Edit' onclick="viewEdit('<?= implode(';',$faculty) ?>')">edit</span>
    <span class='table-button delete material-icons' title='Delete' onclick="if (confirm('Are you sure?') == true) {goTo('ssn/delete.php?rel=faculty&tbl=tblEmployees&mid=employee_id&typ=str&val=<?= $faculty['employee_id'] ?>')}">close</span>
    <?php endif; ?>
    </td>
    </tr>
    <?php endwhile;?>
  </tbody>
  </table></div>
<?php else: ?>
    <p>Nothing to show. Add one first!</p>
<?php endif; ?>
<input type="button" class='accordion-button' value="Create New Faculty" onclick="viewAdd()">
</article>

<dialog id='modal'>
  <article>
    <header>
      <button aria-label="Close" rel="prev" onclick="document.getElementById('modal').close()"></button>
      <p><strong>Faculty Details</strong></p>
    </header>
    <div class='modal-content' id='faculty-details'>
        <div>Employee ID: <span id='e-id'></span></div>
        <div>Full Name: <span id='e-name'></span></div>
        <div>Birthdate: <span id='e-dob'></span></div>
        <div>Gender: <span id='e-gender'></span></div>
        <div>Religion: <span id='e-religion'></span></div>
        <div>Address: <span id='e-addr'></span></div>
        <div>Contact Number: <span id='e-cp'></span></div>
        <div>Email: <span id='e-email'></span></div>
        <div>Designation: <span id='e-designation'></span></div>
        <div>Linked Account: <span id='e-account'></span></div>
    </div>
    <div class='modal-content' id='faculty-add'>
        <form method="post" action="ssn/addfaculty.php" onsubmit="return confirm('Save made changes?');">
            <label>
                Employee ID<req>*</req>
                <input type="text" name="f-id" id="f-id" maxlength="20" required>
            </label> 
            <label>
                Family Name<req>*</req>
                <input type="text" name="f-fname" id="f-fname" maxlength="150" required>
            </label>  
            <label>
                Given Name<req>*</req>
                <input type="text" name="f-gname" id="f-gname" maxlength="150" required>
            </label>  
            <label>
                Middle Name<req>*</req>
                <input type="text" name="f-mname" id="f-mname" maxlength="150" required>
            </label>  
            <label>
                Extension (if any)
                <input type="text" name="f-ename" id="f-ename" maxlength="10">
            </label>  
            <label>
                Date of Birth<req>*</req>
                <input type="date" name="f-dob" id="f-dob" max=<?= date("Y-m-d"); ?> required>
            </label>  
            <label>
                Gender<req>*</req>
                <select name="f-gender" id="f-gender" required>
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
                <select name="f-religion" id="f-religion" required>
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
                <input type="text" name="f-street" id="f-street" maxlength="200" required>
            </label> 
            <label>
                Municipality / City<req>*</req>
                <input type="text" name="f-city" id="f-city" maxlength="200" required>
            </label> 
            <label>
                Province<req>*</req>
                <input type="text" name="f-province" id="f-province" maxlength="200" required>
            </label> 
            <label>
                Contact Number (09xx)<req>*</req>
                <input type="tel" name="f-cp" id="f-cp" maxlength="11" required>
            </label> 
            <label>
                Email Address<req>*</req>
                <input type="email" name="f-email" id="f-email" maxlength="100" required>
            </label> 
            <label>
                Designation<req>*</req>
                <input type="text" name="f-designation" id="f-designation" maxlength="200" required>
            </label> 
            <input type="submit" value="Add New Faculty">
        </form>
    </div>
    <div class='modal-content' id='faculty-edit'>
        <form method="post" action="ssn/updatefaculty.php" onsubmit="return confirm('Save made changes?');">
            <label>
                Employee ID<req>*</req>
                <input type="text" name="fev-id" id="fev-id" maxlength="20" disabled>
                <input type="text" name="fe-id" id="fe-id" hidden>
                <input type="text" name="fe-numid" id="fe-numid" hidden>
            </label> 
            <label>
                Family Name<req>*</req>
                <input type="text" name="fe-fname" id="fe-fname" maxlength="150" required>
            </label>  
            <label>
                Given Name<req>*</req>
                <input type="text" name="fe-gname" id="fe-gname" maxlength="150" required>
            </label>  
            <label>
                Middle Name<req>*</req>
                <input type="text" name="fe-mname" id="fe-mname" maxlength="150" required>
            </label>  
            <label>
                Extension (if any)
                <input type="text" name="fe-ename" id="fe-ename" maxlength="10">
            </label>  
            <label>
                Date of Birth<req>*</req>
                <input type="date" name="fe-dob" id="fe-dob" max=<?= date("Y-m-d"); ?> required>
            </label>  
            <label>
                Gender<req>*</req>
                <select name="fe-gender" id="fe-gender" required>
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
                <select name="fe-religion" id="fe-religion" required>
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
                <input type="text" name="fe-street" id="fe-street" maxlength="200" required>
            </label> 
            <label>
                Municipality / City<req>*</req>
                <input type="text" name="fe-city" id="fe-city" maxlength="200" required>
            </label> 
            <label>
                Province<req>*</req>
                <input type="text" name="fe-province" id="fe-province" maxlength="200" required>
            </label> 
            <label>
                Contact Number (09xx)<req>*</req>
                <input type="tel" name="fe-cp" id="fe-cp" maxlength="11" required>
            </label> 
            <label>
                Email Address<req>*</req>
                <input type="email" name="fe-email" id="fe-email" maxlength="100" required>
            </label> 
            <label>
                Designation<req>*</req>
                <input type="text" name="fe-designation" id="fe-designation" maxlength="200" required>
            </label> 
            <input type="submit" value="Update Faculty Details">
        </form>
    </div>
  </article>
</dialog>

<script>
function viewAccount(params) {
    viewModal('faculty-details');
    params = decodeCustomURL(params);
    var values = params.split(";");
    document.getElementById('e-id').innerText = values[2];
    var ext = values[10];
    if (ext.length != 0) {
        ext = ext + " ";
    }
    var fullname = values[4] + ", " + values[6] + " " + ext + values[8];
    document.getElementById('e-name').innerText = fullname;
    document.getElementById('e-dob').innerText = values[12];
    document.getElementById('e-gender').innerText = values[14];
    document.getElementById('e-religion').innerText = values[16];
    document.getElementById('e-addr').innerText = values[18] + ", " + values[20] + ", " + values[22];
    document.getElementById('e-cp').innerText = values[24];
    document.getElementById('e-email').innerText = values[26];
    document.getElementById('e-designation').innerText = values[28];
    document.getElementById('e-account').innerText = values[30];
}
function viewAdd() {
    clearAdd();
    viewModal('faculty-add');
}
function viewEdit(params) {
    viewModal('faculty-edit');
    params = decodeCustomURL(params);
    var values = params.split(";");
    document.getElementById('fe-id').value = values[2];
    document.getElementById('fev-id').value = values[2];
    document.getElementById('fe-numid').value = values[0];
    document.getElementById('fe-fname').value = values[4];
    document.getElementById('fe-gname').value = values[6];
    document.getElementById('fe-mname').value = values[8];
    document.getElementById('fe-ename').value = values[10];
    document.getElementById('fe-dob').value = values[12];
    document.getElementById('fe-gender').value = values[14];
    document.getElementById('fe-religion').value = values[16];
    document.getElementById('fe-street').value = values[18];
    document.getElementById('fe-city').value = values[20];
    document.getElementById('fe-province').value = values[22];
    document.getElementById('fe-cp').value = values[24];
    document.getElementById('fe-email').value = values[26];
    document.getElementById('fe-designation').value = values[28];
    document.getElementById('fe-account').value = values[30];
}
function viewModal(shown) {
    document.getElementById('modal').open = true;
    document.getElementById('faculty-details').style.display = "none";
    document.getElementById('faculty-add').style.display = "none";
    document.getElementById('faculty-edit').style.display = "none";
    document.getElementById(shown).style.display = "block";
}
function clearAdd() {
    document.getElementById('f-id').value = "";
    document.getElementById('f-fname').value = "";
    document.getElementById('f-gname').value = "";
    document.getElementById('f-mname').value = "";
    document.getElementById('f-ename').value = "";
    document.getElementById('f-dob').value = "";
    document.getElementById('f-gender').selectedIndex = -1;
    document.getElementById('f-religion').selectedIndex = -1;
    document.getElementById('f-street').value = "";
    document.getElementById('f-city').value = "";
    document.getElementById('f-province').value = "";
    document.getElementById('f-cp').value = "";
    document.getElementById('f-email').value = "";
    document.getElementById('f-designation').value = "";

}
</script>