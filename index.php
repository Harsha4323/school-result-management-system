<?php
include('includes/header.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Student Result Management System</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
        }

        body{
            background:#f4f6f9;
            font-family:Arial, sans-serif;
            padding-top:80px;
        }

        /* NAVBAR */

        .navbar{
            background:#001f54;
            padding:15px 0;
            position:fixed;
            top:0;
            width:100%;
            z-index:1000;
        }

        .navbar-brand{
            color:#fff !important;
            font-size:30px;
            font-weight:bold;
        }

        .nav-link{
            color:#fff !important;
            margin-left:20px;
            font-size:17px;
        }

        .nav-link:hover{
            color:#ffd60a !important;
        }

        /* HERO IMAGE */

        .hero-image{
            width:100%;
            height:500px;
            overflow:hidden;
        }

        .hero-image img{
            width:100%;
            height:100%;
            object-fit:cover;
            display:block;
        }

        /* NOTICE BOARD */

        .notice-section{
            padding:60px 0;
        }

        .notice-title{
            color:#001f54;
            font-weight:bold;
            margin-bottom:20px;
        }

        .notice-board{
            background:#fff;
            border-radius:12px;
            padding:20px;
            box-shadow:0 4px 10px rgba(0,0,0,0.1);
        }

        .notice-item{
            border-bottom:1px solid #eee;
            padding:15px 0;
        }

        .notice-header{
            display:flex;
            justify-content:space-between;
            align-items:center;
            cursor:pointer;
        }

        .notice-header h5{
            margin:0;
            color:#001f54;
            font-size:18px;
        }

        .notice-date{
            color:#666;
            font-size:14px;
            white-space:nowrap;
        }

        .notice-details{
            display:none;
            margin-top:10px;
            color:#444;
            line-height:1.6;
        }

        /* FOOTER */

        footer{
            background:#001233;
            color:white;
            padding:40px 0 20px;
            margin-top:60px;
        }

        footer h4{
            margin-bottom:15px;
        }

        footer p{
            margin-bottom:8px;
        }

        .social-icons a{
            color:white;
            font-size:22px;
            margin-right:15px;
            text-decoration:none;
        }

        .social-icons a:hover{
            color:#ffd60a;
        }

        .footer-bottom{
            border-top:1px solid rgba(255,255,255,0.2);
            margin-top:20px;
            padding-top:15px;
            text-align:center;
        }

        @media(max-width:768px){

            .hero-image{
                height:250px;
            }

            .navbar-brand{
                font-size:24px;
            }

            .notice-header{
                flex-direction:column;
                align-items:flex-start;
            }

            .notice-date{
                margin-top:5px;
            }

        }

    </style>

</head>

<body>

<!-- NAVBAR -->

<nav class="navbar navbar-expand-lg navbar-dark">

    <div class="container">

        <a class="navbar-brand" href="index.php">
            Government School
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">

            <ul class="navbar-nav ms-auto">

                <li class="nav-item">
                    <a class="nav-link active" href="index.php">Home</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="result.php">Student Result</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="admin-login.php">Admin Login</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="contact.php">Contact</a>
                </li>

            </ul>

        </div>

    </div>

</nav>

<!-- HERO IMAGE -->

<section class="hero-image">

    <img src="images/background-image.jpg" alt="School Banner">

</section>

<!-- NOTICE BOARD -->

<section class="notice-section">

    <div class="container">

        <h2 class="notice-title">
            Notice Board
        </h2>

        <div class="notice-board">

            <?php

            $sql = "SELECT * FROM tblnotice ORDER BY postingDate DESC";
            $query = $dbh->prepare($sql);
            $query->execute();
            $results = $query->fetchAll(PDO::FETCH_OBJ);

            if($query->rowCount() > 0)
            {
                foreach($results as $result)
                {

            ?>

            <div class="notice-item">

                <div class="notice-header notice-toggle">

                    <h5>
                        <?php echo htmlentities($result->noticeTitle); ?>
                    </h5>

                    <span class="notice-date">
                        <?php echo date('F d, Y', strtotime($result->postingDate)); ?>
                    </span>

                </div>

                <div class="notice-details">

                    <?php echo nl2br(htmlentities($result->noticeDetails)); ?>

                </div>

            </div>

            <?php }} else { ?>

                <p>No notices available.</p>

            <?php } ?>

        </div>

    </div>

</section>

<!-- FOOTER -->

<footer>

    <div class="container">

        <div class="row">

            <div class="col-md-4">

                <h4>Government School</h4>

                <p>Govt Colony</p>

                <p>Phone: 1234123412</p>

                <p>Email: govtschool@gmail.com</p>

            </div>

            <div class="col-md-4">

                <h4>Quick Links</h4>

                <p>
                    <a href="index.php" class="text-white text-decoration-none">
                        Home
                    </a>
                </p>

                <p>
                    <a href="result.php" class="text-white text-decoration-none">
                        Student Result
                    </a>
                </p>

                <p>
                    <a href="admin-login.php" class="text-white text-decoration-none">
                        Admin Login
                    </a>
                </p>

                <p>
                    <a href="contact.php" class="text-white text-decoration-none">
                        Contact
                    </a>
                </p>

            </div>

            <div class="col-md-4">

                <h4>Follow Us</h4>

                <div class="social-icons">

                    <a href="#">
                        <i class="fab fa-facebook"></i>
                    </a>

                    <a href="#">
                        <i class="fab fa-instagram"></i>
                    </a>

                    <a href="#">
                        <i class="fa-solid fa-envelope"></i>
                    </a>

                </div>

            </div>

        </div>

        <div class="footer-bottom">

            <p>
                © 2026 Government School | All Rights Reserved
            </p>

        </div>

    </div>

</footer>

<!-- NOTICE TOGGLE SCRIPT -->

<script>

document.querySelectorAll('.notice-toggle').forEach(function(item){

    item.addEventListener('click', function(){

        let details = this.nextElementSibling;

        if(details.style.display === "block"){

            details.style.display = "none";

        } else {

            document.querySelectorAll('.notice-details').forEach(function(el){
                el.style.display = "none";
            });

            details.style.display = "block";
        }

    });

});

</script>

<!-- Bootstrap JS -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>