<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==""){
    header("Location: admin-login.php");
    exit;
}
$msg = '';
$error = '';
if(isset($_POST['submit'])){
    $class = intval($_POST['class']);
    $subject = intval($_POST['subject']);

    if($class === 0 || $subject === 0){
        $error = 'Please select both class and subject.';
    } else {
        $sql = "SELECT id FROM tblsubjectcombination WHERE ClassId=:class AND SubjectId=:subject";
        $query = $dbh->prepare($sql);
        $query->bindParam(':class',$class,PDO::PARAM_INT);
        $query->bindParam(':subject',$subject,PDO::PARAM_INT);
        $query->execute();
        if($query->rowCount() > 0){
            $error = 'This class and subject combination already exists.';
        } else {
            $status = 1;
            $sql = "INSERT INTO tblsubjectcombination (ClassId, SubjectId, status) VALUES (:class, :subject, :status)";
            $query = $dbh->prepare($sql);
            $query->bindParam(':class',$class,PDO::PARAM_INT);
            $query->bindParam(':subject',$subject,PDO::PARAM_INT);
            $query->bindParam(':status',$status,PDO::PARAM_INT);
            $query->execute();
            if($dbh->lastInsertId()){
                $msg = 'Class combination added successfully.';
            } else {
                $error = 'Unable to save the combination. Please try again.';
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Class Combination Management</title>
        <link rel="stylesheet" href="css/bootstrap.min.css" media="screen" >
        <link rel="stylesheet" href="css/font-awesome.min.css" media="screen" >
        <link rel="stylesheet" href="css/animate-css/animate.min.css" media="screen" >
        <link rel="stylesheet" href="css/lobipanel/lobipanel.min.css" media="screen" >
        <link rel="stylesheet" href="css/prism/prism.css" media="screen" >
        <link rel="stylesheet" href="css/main.css" media="screen" >
        <script src="js/modernizr/modernizr.min.js"></script>
    </head>
    <body class="top-navbar-fixed">
        <div class="main-wrapper">
            <?php include('includes/topbar.php');?> 
            <div class="content-wrapper">
                <div class="content-container">
                   <?php include('includes/leftbar.php');?>  
                    <div class="main-page">
                        <div class="container-fluid">
                            <div class="row page-title-div">
                                <div class="col-md-6">
                                    <h2 class="title">Add Class Combination</h2>
                                </div>
                            </div>
                            <div class="row breadcrumb-div">
                                <div class="col-md-6">
                                    <ul class="breadcrumb">
                                        <li><a href="dashboard.php"><i class="fa fa-home"></i> Home</a></li>
                                        <li><a href="manage-combination.php">Class Combinations</a></li>
                                        <li class="active">Add Combination</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-10 col-md-offset-1">
                                    <div class="panel">
                                        <div class="panel-heading">
                                            <div class="panel-title">
                                                <h5>Create New Combination</h5>
                                            </div>
                                        </div>
                                        <div class="panel-body">
                                            <?php if($msg){ ?>
                                                <div class="alert alert-success left-icon-alert" role="alert">
                                                    <strong>Success!</strong> <?php echo htmlentities($msg); ?>
                                                </div>
                                            <?php } elseif($error){ ?>
                                                <div class="alert alert-danger left-icon-alert" role="alert">
                                                    <strong>Error!</strong> <?php echo htmlentities($error); ?>
                                                </div>
                                            <?php } ?>
                                            <form class="form-horizontal" method="post">
                                                <div class="form-group">
                                                    <label for="class" class="col-sm-2 control-label">Class</label>
                                                    <div class="col-sm-10">
                                                        <select name="class" id="class" class="form-control" required>
                                                            <option value="">Select Class</option>
                                                            <?php
                                                            $sql = "SELECT id, ClassName, Section FROM tblclasses ORDER BY ClassName, Section";
                                                            $query = $dbh->prepare($sql);
                                                            $query->execute();
                                                            $classes = $query->fetchAll(PDO::FETCH_OBJ);
                                                            foreach($classes as $classRow){ ?>
                                                                <option value="<?php echo htmlentities($classRow->id); ?>"><?php echo htmlentities($classRow->ClassName . ' - Section ' . $classRow->Section); ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="subject" class="col-sm-2 control-label">Subject</label>
                                                    <div class="col-sm-10">
                                                        <select name="subject" id="subject" class="form-control" required>
                                                            <option value="">Select Subject</option>
                                                            <?php
                                                            $sql = "SELECT id, SubjectName FROM tblsubjects ORDER BY SubjectName";
                                                            $query = $dbh->prepare($sql);
                                                            $query->execute();
                                                            $subjects = $query->fetchAll(PDO::FETCH_OBJ);
                                                            foreach($subjects as $subjectRow){ ?>
                                                                <option value="<?php echo htmlentities($subjectRow->id); ?>"><?php echo htmlentities($subjectRow->SubjectName); ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-sm-offset-2 col-sm-10">
                                                        <button type="submit" name="submit" class="btn btn-primary">Save Combination</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="js/jquery/jquery-2.2.4.min.js"></script>
        <script src="js/bootstrap/bootstrap.min.js"></script>
        <script src="js/pace/pace.min.js"></script>
        <script src="js/lobipanel/lobipanel.min.js"></script>
        <script src="js/iscroll/iscroll.js"></script>
        <script src="js/main.js"></script>
    </body>
</html>
