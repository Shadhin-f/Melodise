<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- CSS File Link -->
    <link rel="stylesheet" href="style.css">

    <title>Navbar</title>

    <style>
        /* Larger logo */
        .navbar-brand {
            font-size: 2rem !important;
            font-weight: bold;
        }

        .navbar-brand:hover {
            color: #1B8673 !important;
        }

        /* Larger nav items */
        .nav-link {
            font-size: 1.2rem;
        }

        /* Wider search bar for larger screens */
        .form-control {
            width: 300px;
        }

        /* Username button */
        .username-btn {
            border: none;
            background-color: transparent;
            font-size: 1.2rem;
            font-weight: bold;
            text-transform: uppercase;
            display: flex;
            align-items: center;
        }

        .username-btn:hover {
            color: #1B8673;
            cursor: pointer;
        }

        .search-btn-custom {
            color: #1B8673;
            border: 1px solid #1B8673;
            border-radius: 5px;
            padding: 4px 8px;
        }

        .search-btn-custom:hover {
            color: white;
            background-color: #1B8673;
            transition-duration: .3s;
        }

        /* Style for icon inside the button */
        .username-btn i {
            margin-left: 8px;
            font-size: 1.2rem;
            /* Adjust icon size */
        }

        /* Media queries for responsive design */
        @media (max-width: 576px) {

            /* Adjust search bar width on mobile screens */
            .form-control {
                width: 150px;
                /* Smaller width for mobile */
            }

            /* Make sure search bar and button stay on the same line */
            .form-inline {
                flex-direction: row;
                /* Keep elements in a single row */
                width: 100%;
                /* Ensure the form fits within available space */
            }

            /* Collapse username button to a new line on mobile screens */
            .username-btn {
                display: block;
                text-align: center;
                width: 100%;
                /* Full width to ensure it goes to a new line */
                margin-top: 10px;
                /* Add some space between the search bar and username button */
            }

            .username-btn i {
                margin-left: 0;
                /* Align icon with text in center */
            }
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light px-5 py-3">
        <div class="container-fluid">
            <a class="navbar-brand logo" href="index.php?unset_session=true">MELODISE</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse my-3" id="navbarScroll">
                <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 150px;">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="index.php?unset_session=true">Home</a>
                    </li>
                    <!-- <li class="nav-item">
                        <a class="nav-link" href="allmusic.php">Explore</a>
                    </li> -->
                    <?php
                    if (isset($_SESSION['userid'])) {
                        $userType = $_SESSION['usertype'];
                        if ($userType > 1) {
                            echo "
                                <li class='nav-item'>
                                    <a class='nav-link' href='view-playlist.php?playlistname=Favourite'>Favourite</a>
                                </li>
                            ";
                        } else {
                            echo "
                                <li class='nav-item'>
                                    <a class='nav-link' href='subscription-purchase.php'>Buy M+</a>
                                </li>
                            ";
                        }
                    } else {

                        echo "
                            <li class='nav-item'>
                                <a class='nav-link' href='subscription-purchase.php'>Buy M+</a>
                            </li>
                        ";
                    }
                    ?>
                </ul>



                <!-- Search bar -->



                <form class="d-flex form-inline" action="user-actions.php" method="get">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="search-key">
                    <button class="search-btn-custom" type="submit" name="search-btn"><i class="fas fa-search"></i></button>
                </form>

                <div class="d-flex justify-content-center align-items-center px-3">


                    <!-- Login button or User Profile Button Based on login session -->


                    <?php
                    if (!isset($_SESSION['username'])) {
                        echo "
                            <form action='user-actions.php' method='post'>
                                <button class='btn btn-outline-secondary' type='submit' name='user-login-btn'>Login</button>
                                <button class='btn btn-outline-primary mx-2' type='submit' name='user-register-btn'>Register</button>
                            </form>";
                    } else {
                        $firstName = (function ($string) {
                            return strtok($string, ' ');
                        })($_SESSION['username']);
                        echo "
                        <form action='user-actions.php' method='post'>
                            <button class='username-btn' name='user-profile-btn'>$firstName <i class='fa-solid fa-user'></i></button>
                        </form>";
                    }
                    ?>
                </div>

            </div>
        </div>
    </nav>
</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
<script src="https://kit.fontawesome.com/1621a0cc57.js" crossorigin="anonymous"></script>

</html>