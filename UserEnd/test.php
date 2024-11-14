<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome for icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <title>Document</title>


    <style>
        /* Footer Links */
        .footer-link {
            color: #1B8673;
            text-decoration: none;
            transition: color 0.3s;
        }

        .footer-link:hover {
            color: #14594F;
            /* Subtle darker shade on hover */
        }

        /* Social Media Icons */
        .footer-icon {
            color: #1B8673;
            font-size: 1.2rem;
            transition: color 0.3s;
        }

        .footer-icon:hover {
            color: #14594F;
            /* Subtle darker shade on hover */
        }
    </style>
</head>

<body>
    <!-- Minimal Footer Section -->
    <footer class="bg-light py-4">
        <div class="container">
            <div class="row">
                <!-- Logo and Brief Description -->
                <div class="col-md-4 mb-3">
                    <h4 class="logo mb-2">MELODISE</h4>
                    <p class="small text-muted">Discover and enjoy your favorite music with ease.</p>
                </div>

                <!-- Quick Links -->
                <div class="col-md-4 mb-3">
                    <h5 class="mb-2">Quick Links</h5>
                    <ul class="list-unstyled">
                        <li><a href="index.php?unset_session=true" class="footer-link">Home</a></li>
                        <li><a href="allmusic.php" class="footer-link">Explore</a></li>
                        <li><a href="allartist.php" class="footer-link">Favorite Artists</a></li>
                        <li><a href="contact.php" class="footer-link">Contact Us</a></li>
                    </ul>
                </div>

                <!-- Contact & Social Media Links -->
                <div class="col-md-4 mb-3">
                    <h5 class="mb-2">Contact Us</h5>
                    <p class="small text-muted">Email: support@melodise.com</p>
                    <p class="small text-muted">Phone: +123 456 7890</p>

                    <!-- Social Media Icons -->
                    <div class="d-flex mt-2">
                        <a href="#" class="footer-icon me-3"><i class="fa-brands fa-facebook-f"></i></a>
                        <a href="#" class="footer-icon me-3"><i class="fa-brands fa-twitter"></i></a>
                        <a href="#" class="footer-icon me-3"><i class="fa-brands fa-instagram"></i></a>
                        <a href="#" class="footer-icon"><i class="fa-brands fa-youtube"></i></a>
                    </div>
                </div>
            </div>

            <div class="text-center mt-4">
                <p class="small text-muted mb-0">&copy; 2024 MELODISE. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Font Awesome Kit -->
    <script src="https://kit.fontawesome.com/1621a0cc57.js" crossorigin="anonymous"></script>
</body>

</html>