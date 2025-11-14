<div>User Logs</div>
<?php 
if (isset($_SESSION['code'])) {
    echo "<notice id='notification' class='". $_SESSION['code'] ."'>". $_SESSION['msg']."</notice>";
    unset($_SESSION['code']);
}
?>
<br>
<article>
  <?php 
    $getlogs = mysqli_query($connect,"SELECT * FROM tblLogs ORDER BY log_date DESC");
    if (mysqli_num_rows($getlogs) != 0) :
  ?>
  <input type="search" name="search" id="searchbox" placeholder="Search by Date" oninput='searchTable()' placeholder="Search"/>
  <div class="table-container" style="max-height:35rem"><table class="striped">
  <thead><tr><th scope="col">Date</th><th scope="col">User</th><th scope="col">Action</th></tr></thead>
  <tbody>
    <?php while ($logs = mysqli_fetch_array($getlogs)) : ?>
    <tr class="row-selection"><th scope="row" class="row-unique"><?= $logs['log_date'] ?></th><td><?= $logs['log_user'] ?></td><td><?= $logs['log_action'] ?></td>
    </tr>
    <?php endwhile;?>
  </tbody>
</table></div>
<?php else: ?>
    <p>Nothing to show.</p>
<?php endif; ?>
</article>