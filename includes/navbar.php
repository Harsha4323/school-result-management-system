<?php
$currentPage = basename($_SERVER['PHP_SELF']);
function navActive($page) {
    global $currentPage;
    return $currentPage === $page ? ' active' : '';
}
?>
<nav class="navbar navbar-expand-lg navbar-modern sticky-top">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="index.php">
            <div class="brand-mark"><i class="fas fa-school"></i></div>
            <div class="brand-text">
                <span class="brand-title">Government School</span>
                <small class="brand-subtitle">Result Management</small>
            </div>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar" aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="mainNavbar">
            <ul class="navbar-nav ms-auto align-items-lg-center">
                <li class="nav-item"><a class="nav-link<?php echo navActive('index.php'); ?>" href="index.php">Home</a></li>
                <li class="nav-item"><a class="nav-link<?php echo navActive('find-result.php'); ?>" href="find-result.php">Student Result</a></li>
                <li class="nav-item"><a class="nav-link<?php echo navActive('admin-login.php'); ?>" href="admin-login.php">Admin Login</a></li>
                <li class="nav-item"><a class="nav-link<?php echo navActive('contact.php'); ?>" href="contact.php">Contact</a></li>
            </ul>
        </div>
    </div>
</nav>
