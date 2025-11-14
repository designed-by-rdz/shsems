<div>User Accounts</div>
<?php 
if (isset($_SESSION['code'])) {
    echo "<notice id='notification' class='". $_SESSION['code'] ."'>". $_SESSION['msg']."</notice>";
    unset($_SESSION['code']);
}
?>
<br>
<article>
  <?php 
    $getaccounts = mysqli_query($connect,"SELECT * FROM tblUserAccounts LEFT JOIN tblEmployees ON tblUserAccounts.account_user = tblEmployees.employee_id  LEFT JOIN tblStudents ON tblUserAccounts.account_user = tblStudents.student_lrn ORDER BY tblUserAccounts.account_username");
    if (mysqli_num_rows($getaccounts) != 0) :
  ?>
  <input type="search" name="search" id="searchbox" placeholder="Search by Username"  oninput='searchTable()' placeholder="Search"/>
  <div class="table-container"><table class="striped">
  <thead><tr><th scope="col">Username</th><th scope="col">Password</th><th scope="col">Role</th><th scope="col">Status</th><th scope="col">Actions</th></tr></thead>
  <tbody>
    <?php while ($accounts = mysqli_fetch_array($getaccounts)) : 
        $stax = "Inactive";
        $staxttl = "Disable";
        $staxlogo = "block";
        $exposed_pass = $accounts['account_password'];  
        $exposed_pass = openssl_decrypt(urldecode($exposed_pass), $ciphering,$encryption_key, $options, $encryption_iv);  
    ?>
    <tr class="row-selection"><th scope="row" class="row-unique"><?= urldecode($accounts[1]) ?></th><td class='table-password'><?= $exposed_pass ?></td><td><?= $accounts['user_role'] ?></td><td><?= $accounts['account_status'] ?></td>
    <td><span class='table-button material-icons' title='View' onclick="viewAccount('<?= implode(';',$accounts) ?>')">visibility</span>
    <?php if (str_contains($spermission,"W")) : ?>
        <span class='table-button material-icons' title='Edit' onclick="editAccount('<?= implode(';',$accounts) ?>')">edit</span>
    <?php if ($accounts['account_status'] != "Active"){
        $stax = "Active";  
        $staxlogo = "check_circle";
        $staxttl = "Enable";  
    }
    ?>
    <span class='table-button delete material-icons' title='<?php $staxttl; ?>' onclick="if (confirm('Are you sure?') == true) {goTo('ssn/disableacct.php?id=<?= $accounts['account_id'] ?>&stax=<?= $stax ?>&stuser=<?= $accounts['account_username'] ?>')}"><?= $staxlogo; ?></span>
    <?php endif; ?>
    </td>
    </tr>
    <?php endwhile;?>
  </tbody>
  </table></div>
<?php else: ?>
    <p>Nothing to show. Add one first!</p>
<?php endif; ?>
<input type="button" class='accordion-button' value="Create User Account" onclick="viewAdd()">
</article>

<dialog id='modal'>
  <article>
    <header>
      <button aria-label="Close" rel="prev" onclick="document.getElementById('modal').close()"></button>
      <p><strong>User Account Details</strong></p>
    </header>
    <div class='modal-content' id='user-details'>
        <div>Username: <span id='m-sign'></span></div>
        <div>User Role: <span id='m-role'></span></div>
        <div>Permission: <span id='m-perm'></span></div>
        <div>Account Status: <span id='m-stax'></span></div>
        <div>User Information: <span id='m-acct'></span></div>
        <div>Last Accessed: <span id='m-last'></span></div>
    </div>
    <div class='modal-content' id='user-add'>
        <form method="post" action="ssn/addacct.php" onsubmit="return confirm('Save made changes?');">
            <label>
                Username<req>*</req>
                <input type="text" name="l-sign" id="l-sign" maxlength="100" required>
            </label>   
            <label>
                Password<req>*</req>
                <input type="password" name="l-pass" id="l-pass" maxlength="100" required>
            </label> 
            <label>
                Re-enter Password<req>*</req>
                <input type="password" name="l-passt" id="l-passt" maxlength="100" required>
            </label>   
            <label>
                User Type<req>*</req>
                <select name="l-type" id="l-type" required>
                    <optgroup>
                        <?php 
                            $gettypes = mysqli_query($connect,"SELECT * FROM tblRoles ORDER BY role_code DESC");
                            while ($types = mysqli_fetch_array($gettypes)) {
                                $type = $types[0];
                                echo "<option value='$type'>$type</option>";
                            }
                        ?>
                    </optgroup>
                </select>
            </label>              
            <fieldset required>
                <legend>Permission<req>*</req></legend>
                <input type="checkbox" id="pread" name="l-perm[]" value="R" checked/>
                <label htmlFor="pread">Read</label>
                <input type="checkbox" id="pwrite" name="l-perm[]" value="W" />
                <label htmlFor="pwrite">Write</label>
                <input type="checkbox" id="pax" name="l-perm[]" value="A" />
                <label htmlFor="pax">Special Access</label>
            </fieldset>
            <label>
                Employee ID or Learner Reference Number
                <input type="text" name="l-user" id="l-user" maxlength="20">
            </label>   
            <input type="submit" value="Create User Account">
        </form>
    </div>
    <div class='modal-content' id='user-edit'>
        <form method="post" action="ssn/updateacct.php" onsubmit="return confirm('Save made changes?');">
            <label>
                Username<req>*</req>
                <input type="text" name="lev-sign" id="lev-sign" maxlength="100" disabled>
                <input type="text" name="le-sign" id="le-sign" maxlength="100" hidden required>
                <input type="text" name="le-id" id="le-id"  hidden required>
            </label>   
            <label>
                Password<req>*</req>
                <input type="password" name="le-pass" id="le-pass" maxlength="100" required>
            </label> 
            <label>
                Re-enter Password<req>*</req>
                <input type="password" name="le-passt" id="le-passt" maxlength="100" required>
            </label>   
            <label>
                User Type<req>*</req>
                <select name="le-type" id="le-type" required>
                    <optgroup>
                        <?php 
                            $gettypes = mysqli_query($connect,"SELECT * FROM tblRoles ORDER BY role_code DESC");
                            while ($types = mysqli_fetch_array($gettypes)) {
                                $type = $types[0];
                                echo "<option value='$type'>$type</option>";
                            }
                        ?>
                    </optgroup>
                </select>
            </label>              
            <fieldset required>
                <legend>Permission<req>*</req></legend>
                <input type="checkbox" id="epread" name="le-perm[]" value="R" checked/>
                <label htmlFor="epread">Read</label>
                <input type="checkbox" id="epwrite" name="le-perm[]" value="W" />
                <label htmlFor="epwrite">Write</label>
                <input type="checkbox" id="epax" name="le-perm[]" value="A" />
                <label htmlFor="epax">Special Access</label>
            </fieldset>
            <label>
                Employee ID or Learner Reference Number
                <input type="text" name="le-user" id="le-user" maxlength="20">
            </label>  
            <label>
                Account Status<req>*</req>
                <select name="le-stax" id="le-stax" required>
                    <optgroup>
                        <option value="Active">Active</option>
                        <option value="Suspended">Suspended</option>
                    </optgroup>
                </select>
            </label>       
            <input type="submit" value="Update User Account">
        </form>
    </div>
  </article>
</dialog>

<script>
function viewAccount(params) {
    viewModal('user-details');
    params = decodeCustomURL(params);
    var values = params.split(";");
    var accountinfo = values[10];
    if (accountinfo != ""){
        if (values[6] == "Student") {
            var ext = values[58];
            if (ext.length != 0) {
                ext = ext + " ";
            }
            var fullname = values[52] + ", " + values[54] + " " + ext + values[56];
            accountinfo = "(" + values[50] + ") " + fullname;
        } else {
            var ext = values[26];
            if (ext.length != 0) {
                ext = ext + " ";
            }
            var fullname = values[20] + ", " + values[22] + " " + ext + values[24];
            accountinfo = "(" + values[18] + ") " + fullname;
        }
    }
    document.getElementById('m-sign').innerText = values[2];
    document.getElementById('m-role').innerText = values[6];
    document.getElementById('m-perm').innerText = values[8];
    document.getElementById('m-acct').innerText = accountinfo;
    document.getElementById('m-stax').innerText = values[14];
    document.getElementById('m-last').innerText = values[12];
}
function viewAdd() {
    clearAdd();
    viewModal('user-add');
}
function viewModal(shown) {
    document.getElementById('modal').open = true;
    document.getElementById('user-details').style.display = "none";
    document.getElementById('user-edit').style.display = "none";
    document.getElementById('user-add').style.display = "none";
    document.getElementById(shown).style.display = "block";
}
function editAccount(params) {
    viewModal('user-edit');
    params = decodeCustomURL(params);
    var values = params.split(";");
    document.getElementById('le-id').value = values[0];
    document.getElementById('le-sign').value = values[2];
    document.getElementById('lev-sign').value = values[2];
    document.getElementById('le-pass').value = "";
    document.getElementById('le-passt').value = "";
    var selectedVal = 0;
    if (values[6] == "Evaluator") {
        selectedVal = 1;
    } else if (values[6] == "Encoder") {
        selectedVal = 2;
    } else if (values[6] == "Administrator") {
        selectedVal = 3;
    }
    document.getElementById('le-type').selectedIndex = selectedVal;
    selectedVal = 0;
    if (values[12] == "Suspended") {
        selectedVal = 1;
    }
    document.getElementById('le-stax').selectedIndex = selectedVal;
    document.getElementById('epread').checked = false;
    document.getElementById('epwrite').checked = false;
    document.getElementById('epax').checked = false;
    if (values[8].includes('R')) {
        document.getElementById('epread').checked = true;
    }
    if (values[8].includes('W')) {
        document.getElementById('epwrite').checked = true;
    }
    if (values[8].includes('A')) {
        document.getElementById('epax').checked = true;
    }
    document.getElementById('le-user').value = values[10];
}
function clearAdd() {
    document.getElementById('l-sign').value = "";
    document.getElementById('l-pass').value = "";
    document.getElementById('l-passt').value = "";
    document.getElementById('l-type').selectedIndex = -1;
    document.getElementById('pread').checked = true;
    document.getElementById('pwrite').checked = false;
    document.getElementById('pax').checked = false;
    document.getElementById('l-user').value = "";
}
</script>