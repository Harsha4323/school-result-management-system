<?php
// contact.php
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Government School</title>

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
            font-size:32px;
            font-weight:bold;
        }

        .nav-link{
            color:#fff !important;
            margin-left:20px;
            font-size:18px;
            transition:0.3s;
        }

        .nav-link:hover{
            color:#ffd60a !important;
        }

        /* HEADER */

        .contact-header{
            background:#ffffff;
            padding:60px 20px;
            text-align:center;
            color:#001f54;
            border-bottom:1px solid #ddd;
        }

        .contact-header h1{
            font-size:52px;
            font-weight:bold;
            color:#001f54;
        }

        .contact-header p{
            font-size:20px;
            margin-top:10px;
            color:#444;
        }

        /* CONTACT SECTION */

        .contact-section{
            padding:60px 0;
        }

        .contact-card{
            background:#fff;
            border-radius:15px;
            padding:35px;
            box-shadow:0 5px 15px rgba(0,0,0,0.1);
            height:100%;
        }

        .contact-card h3{
            color:#001f54;
            font-weight:bold;
            margin-bottom:25px;
        }

        .contact-info{
            margin-bottom:25px;
        }

        .contact-info i{
            color:#034078;
            font-size:22px;
            margin-right:10px;
        }

        .form-control{
            border-radius:10px;
            padding:12px;
            border:1px solid #ccc;
        }

        textarea{
            resize:none;
        }

        .btn-contact{
            background:#001f54;
            color:white;
            border:none;
            padding:12px 25px;
            border-radius:10px;
            font-size:16px;
        }

        .btn-contact:hover{
            background:#034078;
            color:white;
        }

        /* MAP */

        .map-section{
            margin-top:40px;
        }

        iframe{
            border-radius:15px;
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
            transition:0.3s;
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

            .navbar-brand{
                font-size:24px;
            }

            .contact-header h1{
                font-size:38px;
            }

            .contact-header p{
                font-size:16px;
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
                    <a class="nav-link" href="index.php">Home</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="find-result.php">Student Result</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="admin/index.php">Admin Login</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link active" href="contact.php">Contact</a>
                </li>

            </ul>

        </div>

    </div>

</nav>

<!-- HEADER -->

<section class="contact-header">

    <h1>Contact Us</h1>

    <p>
        Government School Result Management System
    </p>

</section>

<!-- CONTACT SECTION -->

<section class="contact-section">

    <div class="container">

        <div class="row g-4">

            <!-- SCHOOL INFORMATION -->

            <div class="col-md-5">

                <div class="contact-card">

                    <h3>School Information</h3>

                    <div class="contact-info">
                        <p>
                            <i class="fa-solid fa-school"></i>
                            <strong>School Name:</strong><br>
                            Government School
                        </p>
                    </div>

                    <div class="contact-info">
                        <p>
                            <i class="fa-solid fa-location-dot"></i>
                            <strong>Address:</strong><br>
                            Govt Colony
                        </p>
                    </div>

                    <div class="contact-info">
                        <p>
                            <i class="fa-solid fa-phone"></i>
                            <strong>Phone:</strong><br>
                            1234123412
                        </p>
                    </div>

                    <div class="contact-info">
                        <p>
                            <i class="fa-solid fa-envelope"></i>
                            <strong>Email:</strong><br>
                            govtschool@gmail.com
                        </p>
                    </div>

                    <div class="contact-info">
                        <p>
                            <i class="fa-solid fa-clock"></i>
                            <strong>Office Timing:</strong><br>
                            Morning 9:00 AM to Evening 5:00 PM
                        </p>
                    </div>

                </div>

            </div>

            <!-- CONTACT FORM -->

            <div class="col-md-7">

                <div class="contact-card">

                    <h3>Send Message</h3>

                    <form>

                        <div class="mb-3">
                            <input type="text" class="form-control" placeholder="Full Name" required>
                        </div>

                        <div class="mb-3">
                            <input type="email" class="form-control" placeholder="Email Address" required>
                        </div>

                        <div class="mb-3">
                            <input type="text" class="form-control" placeholder="Subject" required>
                        </div>

                        <div class="mb-3">
                            <textarea class="form-control" rows="5" placeholder="Write your message"></textarea>
                        </div>

                        <button type="submit" class="btn btn-contact">
                            Send Message
                        </button>

                    </form>

                </div>

            </div>

        </div>

        <!-- GOOGLE MAP -->

        <div class="map-section">

            <div class="contact-card">

                <h3>School Location</h3>

                <iframe
                    src="https://maps.google.com/maps?q=Mysore%20Government%20School&t=&z=13&ie=UTF8&iwloc=&output=embed"
                    width="100%"
                    height="400"
                    style="border:0;"
                    allowfullscreen=""
                    loading="lazy">
                </iframe>

            </div>

        </div>

    </div>

</section>

<!-- FOOTER -->

<footer>

    <div class="container">

        <div class="row">

            <!-- SCHOOL DETAILS -->

            <div class="col-md-4">

                <h4>Government School</h4>

                <p>Govt Colony</p>

                <p>Phone: 1234123412</p>

                <p>Email: govtschool@gmail.com</p>

            </div>

            <!-- QUICK LINKS -->

            <div class="col-md-4">

                <h4>Quick Links</h4>

                <p>
                    <a href="index.php" class="text-white text-decoration-none">
                        Home
                    </a>
                </p>

                <p>
                    <a href="find-result.php" class="text-white text-decoration-none">
                        Student Result
                    </a>
                </p>

                <p>
                    <a href="admin/index.php" class="text-white text-decoration-none">
                        Admin Login
                    </a>
                </p>

                <p>
                    <a href="contact.php" class="text-white text-decoration-none">
                        Contact
                    </a>
                </p>

            </div>

            <!-- SOCIAL MEDIA -->

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

<!-- Bootstrap JS -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>