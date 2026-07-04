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
if(isset($_GET['delid'])){
    $delid = intval($_GET['delid']);
    $sql = "DELETE FROM tblsubjectcombination WHERE id=:delid";
    $query = $dbh->prepare($sql);
    $query->bindParam(':delid',$delid,PDO::PARAM_INT);
    $query->execute();
    $msg = 'Combination deleted successfully.';
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Manage Class Combinations</title>
        <link rel="stylesheet" href="css/bootstrap.min.css" media="screen" >
        <link rel="stylesheet" href="css/font-awesome.min.css" media="screen" >
        <link rel="stylesheet" href="css/animate-css/animate.min.css" media="screen" >
        <link rel="stylesheet" href="css/lobipanel/lobipanel.min.css" media="screen" >
        <link rel="stylesheet" href="css/prism/prism.css" media="screen" >
        <link rel="stylesheet" href="css/main.css" media="screen" >
        <link rel="stylesheet" type="text/css" href="js/DataTables/datatables.min.css"/>
        <script src="js/modernizr/modernizr.min.js"></script>
        <style>
            .errorWrap { padding: 10px; margin: 0 0 20px 0; background: #fff; border-left: 4px solid #dd3d36; box-shadow: 0 1px 1px rgba(0,0,0,.1); }
            .succWrap{ padding: 10px; margin: 0 0 20px 0; background: #fff; border-left: 4px solid #5cb85c; box-shadow: 0 1px 1px rgba(0,0,0,.1); }
        </style>
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
                                    <h2 class="title">Manage Class Combinations</h2>
                                </div>
                            </div>
                            <div class="row breadcrumb-div">
                                <div class="col-md-6">
                                    <ul class="breadcrumb">
                                        <li><a href="dashboard.php"><i class="fa fa-home"></i> Home</a></li>
                                        <li><a href="manage-combination.php">Class Combinations</a></li>
                                        <li class="active">Manage Combination</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <section class="section">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="panel">
                                            <div class="panel-heading">
                                                <div class="panel-title">
                                                    <h5>Combination List</h5>
                                                </div>
                                            </div>
                                            <?php if($msg){ ?>
                                                <div class="alert alert-success left-icon-alert" role="alert">
                                                    <strong>Success!</strong> <?php echo htmlentities($msg); ?>
                                                </div>
                                            <?php } ?>
                                            <div class="panel-body p-20">
                                                <table id="combinationTable" class="display table table-striped table-bordered" cellspacing="0" width="100%">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Class</th>
                                                            <th>Subject</th>
                                                            <th>Status</th>
                                                            <th>Actions</th>
                                                        </tr>
                                                    </thead>
                                                    <tfoot>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Class</th>
                                                            <th>Subject</th>
                                                            <th>Status</th>
                                                            <th>Actions</th>
                                                        </tr>
                                                    </tfoot>
                                                    <tbody>
                                                    <?php
                                                    $sql = "SELECT tsc.id as scid, tsc.status, tc.ClassName, tc.Section, ts.SubjectName FROM tblsubjectcombination tsc JOIN tblclasses tc ON tc.id = tsc.ClassId JOIN tblsubjects ts ON ts.id = tsc.SubjectId ORDER BY tc.ClassName, ts.SubjectName";
                                                    $query = $dbh->prepare($sql);
                                                    $query->execute();
                                                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                                                    $cnt = 1;
                                                    if($query->rowCount() > 0){
                                                        foreach($results as $result){ ?>
                                                            <tr>
                                                                <td><?php echo htmlentities($cnt);?></td>
                                                                <td><?php echo htmlentities($result->ClassName . ' - Section ' . $result->Section);?></td>
                                                                <td><?php echo htmlentities($result->SubjectName);?></td>
                                                                <td><?php echo $result->status == 1 ? 'Active' : 'Inactive';?></td>
                                                                <td>
                                                                    <a href="edit-combination.php?cid=<?php echo htmlentities($result->scid);?>" class="btn btn-info btn-xs">Edit</a>
                                                                    <a href="manage-combination.php?delid=<?php echo htmlentities($result->scid);?>" class="btn btn-danger btn-xs" onclick="return confirm('Are you sure you want to delete this combination?');">Delete</a>
                                                                </td>
                                                            </tr>
                                                        <?php $cnt++; }
                                                    } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
        <script src="js/jquery/jquery-2.2.4.min.js"></script>
        <script src="js/bootstrap/bootstrap.min.js"></script>
        <script src="js/pace/pace.min.js"></script>
        <script src="js/lobipanel/lobipanel.min.js"></script>
        <script src="js/iscroll/iscroll.js"></script>
        <script src="js/DataTables/datatables.min.js"></script>
        <script src="js/main.js"></script>
        <script>
            $(function($) {
                $('#combinationTable').DataTable();
            });
        </script>
    </body>
</html>
