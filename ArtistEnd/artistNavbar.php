<?php
session_start();
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
            font-size: 2rem;
            font-weight: bold;
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

        /* Style for icon inside the button */
        .username-btn i {
            margin-left: 8px;
            font-size: 1.2rem;
        }

        /* Change link color to #1B8673 when hovered */
        .custom-nav-link:hover {
            color: #1B8673;
        }

        /* Responsive design adjustments */
        @media (max-width: 576px) {
            .form-control {
                width: 150px;
            }

            .form-inline {
                flex-direction: row;
                width: 100%;
            }

            .username-btn {
                display: block;
                text-align: center;
                width: 100%;
                margin-top: 10px;
            }

            .username-btn i {
                margin-left: 0;
            }
        }
    </style>

</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light px-5 py-3">
        <div class="container-fluid">
            <a class="navbar-brand logo" href="index.php">MELODISE</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarScroll">


                <!-- Navigation links for logged-in users -->


                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <?php if (isset($_SESSION['username'])): ?>
                        <li class="nav-item">
                            <a class="nav-link custom-nav-link" href="artistHome.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link custom-nav-link" href="tanveer-dashboard.php">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link custom-nav-link" href="settings.php">Profile</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link custom-nav-link" href="feedback.php">Feedback</a>
                        </li>
                    <?php endif; ?>
                </ul>


                <div class="ms-auto d-flex align-items-center">


                    <!-- Search bar -->


                    <!-- <form class="d-flex" action="user-actions.php" method="get">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="search-key">
                        <button class="btn btn-outline-success" type="submit" name="search-btn">Search</button>
                    </form> -->



                    <!-- User Profile or Login/Register Buttons -->


                    <?php if (!isset($_SESSION['username'])): ?>
                        <a href="login.php" class="btn btn-outline-secondary mx-2">Login</a>
                        <a href="register.php" class="btn btn-outline-primary mx-2">Register</a>
                    <?php else: ?>
                        <?php $firstName = strtok($_SESSION['username'], ' '); ?>
                        <button class="username-btn mx-2"><?php echo $firstName; ?> <i class="fa-solid fa-user"></i></button>
                        <form action="logout.php" method="post" class="d-inline">
                            <button type="submit" class="btn btn-outline-danger mx-2">Logout</button>
                        </form>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>
</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://kit.fontawesome.com/1621a0cc57.js" crossorigin="anonymous"></script>

</html>