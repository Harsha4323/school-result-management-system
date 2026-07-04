<?php
include('includes/config.php');
if(!empty($_POST["classid"])) 
{
    $cid = intval($_POST['classid']);
    if($cid <= 0){
        echo '<option value="">Select Student</option>';
        exit;
    }
    $stmt = $dbh->prepare("SELECT StudentName,StudentId FROM tblstudents WHERE ClassId = :id ORDER BY StudentName");
    $stmt->execute(array(':id' => $cid));
    $students = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if(count($students) > 0) {
        echo '<option value="">Select Student</option>';
        foreach($students as $row) {
            echo '<option value="'.htmlentities($row['StudentId']).'">'.htmlentities($row['StudentName']).'</option>';
        }
    } else {
        echo '<option value="">No students found</option>';
    }
}
// Code for Subjects
// classid1 is no longer used here, subjects are loaded by get_subject.php


?>

<?php

if(!empty($_POST["studclass"])) 
{
    header('Content-Type: application/json; charset=utf-8');
    $id = $_POST['studclass'];
    $dta = explode('$', $id);
    if(count($dta) === 2) {
        $classId = intval($dta[0]);
        $studentId = intval($dta[1]);
        $query = $dbh->prepare("SELECT StudentId,ClassId FROM tblresult WHERE StudentId=:id1 AND ClassId=:id");
        $query->bindParam(':id1', $studentId, PDO::PARAM_INT);
        $query->bindParam(':id', $classId, PDO::PARAM_INT);
        $query->execute();
        if($query->rowCount() > 0) {
            echo json_encode([
                'exists' => true,
                'html' => '<p><span style="color:red">Result already declared.</span></p>'
            ]);
        } else {
            echo json_encode([
                'exists' => false,
                'html' => ''
            ]);
        }
    } else {
        echo json_encode([
            'exists' => true,
            'html' => '<p><span style="color:red">Invalid selection.</span></p>'
        ]);
    }
    exit;
}


