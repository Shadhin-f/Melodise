<?php
// Check if session is already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar</title>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/1621a0cc57.js" crossorigin="anonymous"></script>
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

        /* Responsive design adjustments */
        @media (max-width: 576px) {
            .form-control {
                width: 150px;
            }

            .username-btn {
                display: block;
                text-align: center;
                width: 100%;
                margin-top: 10px;
            }
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light px-5 py-3">
        <div class="container-fluid">
            <a class="navbar-brand logo" href="dashboard.php">MELODISE</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarScroll">
                <!-- Navigation links for logged-in users -->
                <div class="ms-auto d-flex align-items-center">
                    <?php if (!isset($_SESSION['artistid'])): ?>
                        <!-- If artist is not logged in, show login and register buttons -->
                        <a href="artistlogin.php" class="btn btn-outline-secondary mx-2">Login</a>
                        <a href="artistlogin.php" class="btn btn-outline-primary mx-2">Register</a>
                    <?php else: ?>
                        <?php
                        // Fetch artist first name from session
                        $firstName = isset($_SESSION['artistname']) ? strtok($_SESSION['artistname'], ' ') : 'Artist';
                        ?>
                        <!-- Display username button with a link to profile -->
                        <form method="post" action="artistlogin.php" class="d-inline">
                            <button name="logout-button" class="btn btn-danger mx-2">Logout</button>
                        </form>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>
</body>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</html>