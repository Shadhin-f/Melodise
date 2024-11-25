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
        .footer {
            font-size: 0.9rem;
            border-top: 1px solid #444;
        }

        .footer h6 {
            font-size: 0.95rem;
            letter-spacing: 0.5px;
        }

        .footer a {
            text-decoration: none;
        }

        .footer a:hover {
            color: #1B8673;
            /* Highlight hover color matching your theme */
        }

        .footer .btn-outline-light {
            border-color: #1B8673;
            color: #1B8673;
        }

        .footer .btn-outline-light:hover {
            background-color: #1B8673;
            color: white;
        }

        .footer i {
            font-size: 1.2rem;
        }

        @media (max-width: 767px) {
            .footer .row {
                text-align: center;
            }

            .footer .col-md-2,
            .footer .col-md-3 {
                margin-bottom: 15px;
            }
        }
    </style>
</head>

<body>
    <!--  Footer Section -->
    <footer class="footer mt-auto mb-5">
        <div class="container-fluid bg-dark text-white px-5 py-3">
            <div class="row text-center text-md-left py-4">
                <!-- Premium Features -->
                <div class="col-md-2 mb-3">
                    <h6 class="text-uppercase">Premium Features</h6>
                    <a href="#" class="text-white-50">Learn More</a>
                </div>

                <!-- Melodise Center -->
                <div class="col-md-2 mb-3">
                    <h6 class="text-uppercase">Melodise Center</h6>
                    <a href="#" class="text-white-50">Visit Center</a>
                </div>

                <!-- Favourites -->
                <div class="col-md-2 mb-3">
                    <h6 class="text-uppercase">Favourites</h6>
                    <a href="view-playlist.php?playlistname=Favourite" class="text-white-50">View Playlist</a>
                </div>

                <!-- Social Media -->
                <div class="col-md-3 mb-3">
                    <h6 class="text-uppercase">Follow Us</h6>
                    <div>
                        <a href="#" class="text-white-50 me-3"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="text-white-50 me-3"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="text-white-50 me-3"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="text-white-50"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>

                <!-- Profile -->
                <div class="col-md-3 mb-3">
                    <h6 class="text-uppercase">Profile</h6>
                    <a href="userprofile.php" class="btn btn-outline-light btn-sm">View Profile</a>
                </div>
            </div>

            <!-- Copyright -->
            <div class="row">
                <div class="col-12 text-center py-2">
                    <p class="mb-0 text-white-50">&copy; 2024 MELODISE. All Rights Reserved.</p>
                </div>
            </div>
        </div>
    </footer>


    <!-- Font Awesome Kit -->
    <script src="https://kit.fontawesome.com/1621a0cc57.js" crossorigin="anonymous"></script>
</body>

</html>