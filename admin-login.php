<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('includes/config.php');

if (!empty($_SESSION['alogin'])) {
    header('Location: dashboard.php');
    exit;
}

$errorMessage = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    $uname = trim($_POST['username']);
    $password = trim($_POST['password']);
    if ($uname === '' || $password === '') {
        $errorMessage = 'Please enter both username and password.';
    } else {
        $passwordHash = md5($password);
        $sql = "SELECT UserName,Password FROM admin WHERE UserName=:uname and Password=:password";
        $query = $dbh->prepare($sql);
        $query->bindParam(':uname', $uname, PDO::PARAM_STR);
        $query->bindParam(':password', $passwordHash, PDO::PARAM_STR);
        try {
            $query->execute();
            if ($query->rowCount() > 0) {
                $_SESSION['alogin'] = $uname;
                header('Location: dashboard.php');
                exit;
            } else {
                $errorMessage = 'Invalid username or password.';
            }
        } catch (PDOException $e) {
            if (strpos($e->getMessage(), 'Base table or view not found') !== false) {
                $dbh->exec(
                    "CREATE TABLE IF NOT EXISTS `admin` (
                        `id` int(11) NOT NULL AUTO_INCREMENT,
                        `UserName` varchar(100) DEFAULT NULL,
                        `Password` varchar(100) DEFAULT NULL,
                        `updationDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
                        PRIMARY KEY (`id`)
                    ) ENGINE=InnoDB DEFAULT CHARSET=latin1;"
                );
                $dbh->exec("INSERT INTO `admin` (UserName,Password,updationDate) VALUES ('admin1','" . md5('admin1') . "', NOW())");
                $errorMessage = 'Admin table was missing and has been recreated. Please try logging in again with admin1/admin1.';
            } else {
                $errorMessage = 'Database error: ' . $e->getMessage();
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
        <title>Admin Login</title>
        <link rel="stylesheet" href="css/bootstrap.min.css" media="screen" >
        <link rel="stylesheet" href="css/font-awesome.min.css" media="screen" >
        <link rel="stylesheet" href="css/animate-css/animate.min.css" media="screen" >
        <link rel="stylesheet" href="css/prism/prism.css" media="screen" > <!-- USED FOR DEMO HELP - YOU CAN REMOVE IT -->
        <link rel="stylesheet" href="css/main.css" media="screen" >
        <script src="js/modernizr/modernizr.min.js"></script>
    </head>
    <body class="">
        <div class="main-wrapper">
            <div class="login-bg-color bg-black-300">
                <div class="row">
                    <div class="col-md-4 col-md-offset-4">
                        <div class="panel login-box">
                            <div class="panel-heading">
                                <div class="panel-title text-center">
                                    <h4>Admin Login</h4>
                                </div>
                            </div>
                            <div class="panel-body p-20">
                                <?php if (!empty($errorMessage)) : ?>
                                    <div class="alert alert-danger" role="alert"><?php echo htmlentities($errorMessage); ?></div>
                                <?php endif; ?>
                                <form action="admin-login.php" method="post">
                                    <div class="form-group">
                                        <label for="inputEmail3">Username</label>
                                        <input type="text" name="username" class="form-control" id="inputEmail3" placeholder="Enter your username" value="<?php echo isset($_POST['username']) ? htmlentities($_POST['username']) : ''; ?>" autocomplete="username">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPassword3">Password</label>
                                        <input type="password" name="password" class="form-control" id="inputPassword3" placeholder="Enter your password" autocomplete="current-password">
                                    </div>
                                    <div class="form-group mt-20 text-end">
                                        <button type="submit" name="login" class="btn btn-success btn-labeled">Sign in<span class="btn-label btn-label-right"><i class="fa fa-check"></i></span></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <p class="text-muted text-center"><small>Student Result Management System</small></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- ========== COMMON JS FILES ========== -->
        <script src="js/jquery/jquery-2.2.4.min.js"></script>
        <script src="js/jquery-ui/jquery-ui.min.js"></script>
        <script src="js/bootstrap/bootstrap.min.js"></script>
        <script src="js/pace/pace.min.js"></script>
        <script src="js/lobipanel/lobipanel.min.js"></script>
        <script src="js/iscroll/iscroll.js"></script>

        <!-- ========== THEME JS ========== -->
        <script src="js/main.js"></script>
        <?php include('includes/footer.php'); ?>
    </body>
</html>
