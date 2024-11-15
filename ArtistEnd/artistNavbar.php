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
            text-decoration: none;
            /* Remove underline from the link */
            color: inherit;
            /* Inherit the color of the parent element (default text color) */
        }

        .username-btn:hover {
            color: #1B8673;
            /* Color on hover */
            cursor: pointer;
        }

        /* Optional: Adjust color for the text on the profile button */
        .username-btn {
            color: #000;
            /* Set the initial color to black or any desired color */
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





                <div class="ms-auto d-flex align-items-center">
                    <?php if (!isset($_SESSION['artistid'])): ?>
                        <!-- If artist is not logged in, show login and register buttons -->
                        <a href="login.php" class="btn btn-outline-secondary mx-2">Login</a>
                        <a href="register.php" class="btn btn-outline-primary mx-2">Register</a>
                    <?php else: ?>
                        <?php
                        // Fetch artist first name from session (assuming artist name is stored in $_SESSION['artistname'])
                        $firstName = strtok($_SESSION['artistname'], ' ');  // Get first name by splitting at space
                        ?>
                        <!-- Display username button with first name -->
                        <button class="username-btn mx-2"><?php echo htmlspecialchars($firstName); ?> <i class="fa-solid fa-user"></i></button>
                    <?php endif; ?>
                </div>

            </div>
        </div>
    </nav>
</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://kit.fontawesome.com/1621a0cc57.js" crossorigin="anonymous"></script>

</html>