<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
include(__DIR__ . '/config.php');

function requireAdminLogin()
{
    if (empty($_SESSION['alogin'])) {
        header("Location: admin-login.php");
        exit;
    }
}

function redirectIfAdminLoggedIn()
{
    if (!empty($_SESSION['alogin'])) {
        header("Location: dashboard.php");
        exit;
    }
}

function ensureAppTables($dbh)
{
    $tableSql = [
        "CREATE TABLE IF NOT EXISTS `admin` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `UserName` varchar(100) DEFAULT NULL,
            `Password` varchar(100) DEFAULT NULL,
            `updationDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY (`id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;",
        "CREATE TABLE IF NOT EXISTS `tblclasses` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `ClassName` varchar(80) DEFAULT NULL,
            `ClassNameNumeric` int(4) DEFAULT NULL,
            `Section` varchar(5) DEFAULT NULL,
            `CreationDate` timestamp NULL DEFAULT current_timestamp(),
            `UpdationDate` timestamp NULL DEFAULT NULL,
            PRIMARY KEY (`id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;",
        "CREATE TABLE IF NOT EXISTS `tblresult` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `StudentId` int(11) DEFAULT NULL,
            `ClassId` int(11) DEFAULT NULL,
            `SubjectId` int(11) DEFAULT NULL,
            `marks` int(11) DEFAULT NULL,
            `PostingDate` timestamp NULL DEFAULT current_timestamp(),
            `UpdationDate` timestamp NULL DEFAULT NULL,
            PRIMARY KEY (`id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;",
        "CREATE TABLE IF NOT EXISTS `tblstudents` (
            `StudentId` int(11) NOT NULL AUTO_INCREMENT,
            `StudentName` varchar(100) DEFAULT NULL,
            `RollId` varchar(100) DEFAULT NULL,
            `StudentEmail` varchar(100) DEFAULT NULL,
            `Gender` varchar(10) DEFAULT NULL,
            `DOB` varchar(100) DEFAULT NULL,
            `ClassId` int(11) DEFAULT NULL,
            `RegDate` timestamp NULL DEFAULT current_timestamp(),
            `UpdationDate` timestamp NULL DEFAULT NULL,
            `Status` int(1) DEFAULT NULL,
            PRIMARY KEY (`StudentId`)
        ) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;",
        "CREATE TABLE IF NOT EXISTS `tblsubjects` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `SubjectName` varchar(100) DEFAULT NULL,
            `SubjectCode` varchar(100) DEFAULT NULL,
            `Creationdate` timestamp NULL DEFAULT current_timestamp(),
            `UpdationDate` timestamp NULL DEFAULT NULL,
            PRIMARY KEY (`id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;",
        "CREATE TABLE IF NOT EXISTS `tblsubjectcombination` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `ClassId` int(11) DEFAULT NULL,
            `SubjectId` int(11) DEFAULT NULL,
            `status` int(1) DEFAULT NULL,
            `CreationDate` timestamp NULL DEFAULT current_timestamp(),
            `Updationdate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
            PRIMARY KEY (`id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;",
        "CREATE TABLE IF NOT EXISTS `tblnotice` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `noticeTitle` varchar(255) DEFAULT NULL,
            `noticeDetails` mediumtext DEFAULT NULL,
            `postingDate` timestamp NULL DEFAULT current_timestamp(),
            PRIMARY KEY (`id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;"
    ];

    foreach ($tableSql as $sql) {
        $dbh->exec($sql);
    }

    try {
        $stmt = $dbh->query("SELECT COUNT(*) FROM `admin`");
        if ($stmt && $stmt->fetchColumn() == 0) {
            $defaultPassword = md5('admin1');
            $dbh->exec("INSERT INTO `admin` (`UserName`,`Password`,`updationDate`) VALUES ('admin1','{$defaultPassword}', NOW())");
        }
    } catch (PDOException $e) {
        // ignore if admin table cannot be queried
    }
}

ensureAppTables($dbh);
?>