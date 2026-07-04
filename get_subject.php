<?php
include('includes/config.php');
header('Content-Type: text/html; charset=utf-8');

if(!empty($_POST['classid'])) {
    $cid = intval($_POST['classid']);
    if($cid <= 0) {
        echo '<p class="text-danger">Invalid class selected.</p>';
        exit;
    }

    $stmt = $dbh->prepare(
        "SELECT tblsubjects.SubjectName, tblsubjects.id
         FROM tblsubjectcombination
         JOIN tblsubjects ON tblsubjects.id = tblsubjectcombination.SubjectId
         WHERE tblsubjectcombination.ClassId = :cid
         AND tblsubjectcombination.status != 0
         ORDER BY tblsubjects.SubjectName"
    );
    $stmt->execute([':cid' => $cid]);
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if(count($rows) > 0) {
        foreach($rows as $row) {
            echo '<div class="form-group">';
            echo '  <label class="col-sm-2 control-label">'.htmlentities($row['SubjectName']).'</label>';
            echo '  <div class="col-sm-10">';
            echo '      <input type="text" name="marks[]" class="form-control" required placeholder="Enter marks out of 100" autocomplete="off">';
            echo '  </div>';
            echo '</div>';
        }
    } else {
        echo '<p class="text-warning">No active subjects configured for this class. Add subject combinations first.</p>';
    }
}
